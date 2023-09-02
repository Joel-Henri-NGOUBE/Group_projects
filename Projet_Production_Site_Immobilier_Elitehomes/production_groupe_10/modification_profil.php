<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: connexion.php");
    exit();
}

$userId = $_SESSION['id'];

$nom_bdd = 'elitehomes';
$admin = 'root';
$mdp = '';

try {
    $pdo = new PDO("mysql:host=localhost;dbname=$nom_bdd", $admin, $mdp);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
    exit();
}

// Récupérer les informations de l'utilisateur depuis la base de données
$sql = "SELECT name, first_name, mail, phone, gender, birthday FROM users WHERE id = :id";
$requete = $pdo->prepare($sql);
$requete->bindParam(':id', $userId);
$requete->execute();
$user = $requete->fetch(PDO::FETCH_ASSOC);

$name = $user['name'] ?? '';
$first_name = $user['first_name'] ?? '';
$mail = $user['mail'] ?? '';
$phone = $user['phone'] ?? '';
$gender = $user['gender'] ?? '';
$birthday = $user['birthday'] ?? '';

if (isset($_POST['update'])) {
    $password = $_POST['password'];
    $new_password = $_POST['new_password'];
    $new_password2 = $_POST['new_password2'];
    
    if (!empty($new_password) && !empty($new_password2) && !empty($password)) {
        $sql = "SELECT * FROM users WHERE id = :id";
        $requete = $pdo->prepare($sql);
        $requete->bindParam(':id', $userId);
        $requete->execute();
        $user = $requete->fetch(PDO::FETCH_ASSOC);
        
        if ($user && password_verify($password, $user['password'])) {
            if ($new_password == $new_password2) {
                $hashedPassword = password_hash($new_password, PASSWORD_DEFAULT);
            } else {
                echo 'Vous avez saisi 2 mots de passe différents pour la confirmation de la modification.';
            }
        } else {
            echo 'Votre mot de passe est différent du mot de passe actuel.';
        }
    } else {
        echo 'Vous n\'avez pas rempli tous les champs pour changer le mot de passe.';
    }
    if (isset($hashedPassword)){
        $sql = "UPDATE users SET name = :name, first_name = :first_name, mail = :mail, phone = :phone, gender = :gender, birthday = :birthday, password = :password WHERE id = :id";
        $requete = $pdo->prepare($sql);
        $requete->bindParam(':name', $_POST['name']);
        $requete->bindParam(':first_name', $_POST['first_name']);
        $requete->bindParam(':mail', $_POST['mail']);
        $requete->bindParam(':phone', $_POST['phone']);
        $requete->bindParam(':gender', $_POST['gender']);
        $requete->bindParam(':birthday', $_POST['birthday']);
        $requete->bindParam(':password', $hashedPassword);
        $requete->bindParam(':id', $userId);
    } else {
        $sql = "UPDATE users SET name = :name, first_name = :first_name, mail = :mail, phone = :phone, gender = :gender, birthday = :birthday WHERE id = :id";
        $requete = $pdo->prepare($sql);
        $requete->bindParam(':name', $_POST['name']);
        $requete->bindParam(':first_name', $_POST['first_name']);
        $requete->bindParam(':mail', $_POST['mail']);
        $requete->bindParam(':phone', $_POST['phone']);
        $requete->bindParam(':gender', $_POST['gender']);
        $requete->bindParam(':birthday', $_POST['birthday']);
        $requete->bindParam(':id', $userId);
    }

    try {
        if ($requete->execute()) {
            echo "Les informations du profil ont été mises à jour avec succès.";
            $_SESSION['name'] = $_POST['name'];
            $_SESSION['first_name'] = $_POST['first_name'];
            $_SESSION['mail'] = $_POST['mail'];
            $_SESSION['phone'] = $_POST['phone'];
            $_SESSION['gender'] = $_POST['gender'];
            $_SESSION['birthday'] = $_POST['birthday'];
        } else {
            echo "Une erreur s'est produite lors de la mise à jour des informations du profil.";
        }
    } catch (PDOException $e) {
        echo "Une erreur s'est produite : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modification du profil</title>
</head>
<body>
    <h1>Modification du profil</h1>
    <form method="POST" action="">
        <input type="text" name="name" placeholder="Nom" value="<?php echo $name; ?>" required pattern="[a-zA-ZÀ-ÿ\s]+" title="Veuillez entrer un nom valide (lettres uniquement)"><br>
        <input type="text" name="first_name" placeholder="Prénom" value="<?php echo $first_name; ?>" required pattern="[a-zA-ZÀ-ÿ\s]+" title="Veuillez entrer un prénom valide (lettres uniquement)"><br>
        <input type="email" name="mail" placeholder="Adresse e-mail" value="<?php echo $mail; ?>" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-z]{2,}" title="Veuillez entrer une adresse email valide"><br>
        <input type="password" name="password" placeholder="Mot de Passe" pattern="^(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[A-Z])[a-zA-Z0-9!@#$%^&*]{8,20}$" title="Le mot de passe doit comporter entre 8 et 20 caractères, dont au moins un numéro, une majuscule et un caractère spécial, les caractères spéciaux autorisés sont : (!, @, #, $, %, ^, &, *)"><br>
        <input type="password" name="new_password" placeholder="Nouveau Mot de Passe" pattern="^(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[A-Z])[a-zA-Z0-9!@#$%^&*]{8,20}$" title="Le mot de passe doit comporter entre 8 et 20 caractères, dont au moins un numéro, une majuscule et un caractère spécial, les caractères spéciaux autorisés sont : (!, @, #, $, %, ^, &, *)"><br>
        <input type="password" name="new_password2" placeholder="Confirmer le Nouveau Mot de Passe" pattern="^(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[A-Z])[a-zA-Z0-9!@#$%^&*]{8,20}$" title="Le mot de passe doit comporter entre 8 et 20 caractères, dont au moins un numéro, une majuscule et un caractère spécial, les caractères spéciaux autorisés sont : (!, @, #, $, %, ^, &, *)"><br>
        <input type="tel" name="phone" placeholder="Numéro de téléphone" value="<?php echo $phone; ?>" required pattern="[0-9]{6,15}"><br>
        <input type="radio" name="gender" value="Male" <?php echo ($gender == 'Male') ? 'checked' : ''; ?> required> Homme
        <input type="radio" name="gender" value="Femelle" <?php echo ($gender == 'Femelle') ? 'checked' : ''; ?> required> Femme<br>
        <input type="date" name="birthday" value="<?php echo $birthday; ?>" required max="<?php echo date('Y-m-d', strtotime('-16 years')); ?>">Date de naissance<br>
        <input type="submit" name="update" value="Mettre à jour">
        <br>
        <a href="page_profil.php">Retour</a>
        <br>
        <a href="accueil.php">Retourner à l'accueil</a>
        <br>
        <a href="deconnexion.php">Déconnectez-vous!</a>
    </form>
</body>
</html>
