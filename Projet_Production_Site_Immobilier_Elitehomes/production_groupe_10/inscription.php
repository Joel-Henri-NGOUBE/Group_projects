<?php
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

if (isset($_POST['signup'])) {
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $name = $_POST['name'];
    $first_name = $_POST['first_name'];
    $mail = $_POST['mail'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $birthday = $_POST['birthday'];

    if ($password === $confirm_password) {

        $sql = "SELECT COUNT(*) FROM users WHERE mail = :mail";
        $requete = $pdo->prepare($sql);
        $requete->bindParam(':mail', $mail);
        $requete->execute();
        $count = $requete->fetchColumn();

        if ($count > 0) {
            echo "Le nom d'utilisateur existe déjà. Veuillez en choisir un autre.";
        } else {
            $sql = "INSERT INTO users (password, name, first_name, mail, phone, gender, birthday) VALUES (:password, :name, :first_name, :mail, :phone, :gender, :birthday)";
            $requete = $pdo->prepare($sql);
            $requete->bindParam(':password', $hashedPassword);
            $requete->bindParam(':name', $name);
            $requete->bindParam(':first_name', $first_name);
            $requete->bindParam(':mail', $mail);
            $requete->bindParam(':phone', $phone);
            $requete->bindParam(':gender', $gender);
            $requete->bindParam(':birthday', $birthday);

            if ($requete->execute()) {
                header("Location: connexion.php");
                exit();
            } else {
                echo "Une erreur s'est produite lors de la création du compte client.";
            }
        }
    } else {
        echo "Les mots de passe ne correspondent pas. Veuillez réessayer.";
    }
}   
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S'inscrire</title>
    <link rel="stylesheet" href="./css/inscription.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/footer.css">
     <link rel="stylesheet" href="./css/style.css">


</head>
<body>
     <?php include 'header.php'; ?>

    <section>
        <div class="imgBox"></div>
        <div class="contentBox">
            <div  class="formBox">
                <h2>Inscription</h2>
                <form method="POST" action="">
                    <div class="inputBx">
                        <span>Nom</span>
                        <input type="name" name="name" id="name" required placeholder="Nom" pattern="[a-zA-ZÀ-ÖØ-öø-ÿ\s]+" title="Veuillez entrer un nom valide (lettres uniquement)"><br>
                     </div>
                     <div class="inputBx">
                        <span>Prénom</span>
                        <input type="first_name" name="first_name" id="first_name" required placeholder="Prénom" pattern="[A-Za-zÀ-ÖØ-öø-ÿ\s]+" title="Veuillez entrer un prénom valide (lettres uniquement)"><br>
                     </div>
                     <div class="inputBx">
                        <span>Email</span>
                        <input type="email" name="mail" id="mail" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+.[a-z]{2,}+" required placeholder="Adresse e-mail" title="Veuillez entrer une adresse email valide"><br>
                     </div>
                     <div class="inputBx">
                        <span>Mot de passe</span>
                        <input type="password" name="password" id="password" required placeholder="Mot de Passe" pattern="^(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[A-Z])[a-zA-Z0-9!@#$%^&*]{8,20}$" title="Le mot de passe doit comporter entre 8 et 20 caractères, dont au moins un numéro, une majuscule et un caractère spécial, les caractères speciaux autorisé sont:(!,@,#,$,%,^,&,*) "><br>
                     </div>
                     <div class="inputBx">
                        <span>Confirmation du mot passe</span>
                        <input type="password" name="confirm_password" placeholder="Confirmer mot de passe">
                     </div>
                     <div class="inputBx">
                        <span>Numéro de téléphone</span>
                        <input type="tel" name="phone" id="phone" required placeholder="Numéro de Téléphone" pattern="[0-9]{6,15}" title="Veuillez entrer un numéro de téléphone valide"><br>
                     </div>
                     
                     <div class="inputBx">
                        <span>Naissance</span>
                        <input type="date" name="birthday" id="birthday" required max="<?php echo date('Y-m-d', strtotime('-18 years')); ?>" title="Veuillez entrer une date de naissance valide"><br>
                     </div>
                    </div>
                        <input type="radio" name="gender" value="Male" required> Homme
                        <input type="radio" name="gender" value="Female" required> Femme
                    <div class="inputBx">
                     <input type="submit" name="signup" value="Créer un compte">
                    </div>
                    <div class="inputBx">
                     <a href="connexion.php">Déja inscrit? Connectez-vous.</a>
                    </div>
                </form>
        </div>
        </div>
    </section>
</body>
</html>