<?php 
session_start();

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

if (isset($_POST['login'])) {
    $mail = $_POST['mail'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE mail = :mail";
    $requete = $pdo->prepare($sql);
    $requete->bindParam(':mail', $mail);
    $requete->execute();
    $user = $requete->fetch(PDO::FETCH_ASSOC);
    
    if ($user && $user['status'] == 'activé' && password_verify($password, $user['password']) ) {
        $_SESSION['id'] = $user['id'];
        $_SESSION['roles'] = $user['roles'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['mail'] = $user['mail'];
        $_SESSION['phone'] = $user['phone'];
        $_SESSION['gender'] = $user['gender'];
        $_SESSION['birthday'] = $user['birthday'];
        if (isset($_SESSION['save_page'])){
            if($_SESSION['save_page'] == 2){
                header('Location: story.php');
                exit();
            } elseif($_SESSION['save_page'] == 3){
                header('Location: search.php');
                exit();
            } elseif($_SESSION['save_page'] == 4){
                header('Location: arrondissement.php');
                exit();
            } elseif($_SESSION['save_page'] == 5){
                header('Location: testimonial.php');
                exit();
            } elseif($_SESSION['save_page'] == 6){
                header("Location:" . $_SESSION['id_logement']);
                exit();
            } else {
                header('Location: pageaccueil.php');
                exit();
            }
        }header('Location: pageaccueil.php');
        exit();
    } else if ($user && $user['status'] == 'désactivé' && password_verify($password, $user['password'])){
        echo "votre compte a été desactivé, contacter le support pour en savoir plus";
    }else {
        echo "Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Se connecter</title>
    <link rel="stylesheet" href="./css/connexion.css">
    <link rel="stylesheet" href="./css/style.css">

</head>
<body>
    <section>
        <div class="imgBox"></div>
        <div class="contentBox">
            <div  class="formBox">
                <h2>Connexion</h2>
                <form method="POST" action="">
                    <div class="inputBx">
                        <span>Adresse mail</span>
                        <input type="text" name="mail" placeholder="Adresse mail" required pattern="[a-zA-Z0-9À-ÿ._%+-]+@[a-zA-Z0-9.-]+\.[a-z]{2,}"><br>
                    </div>
                     <div class="inputBx">
                        <span>Mot de passe</span>
                        <input type="password" name="password" placeholder="Mot de passe" required pattern="^(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[A-Z])[a-zA-Z0-9!@#$%^&*]{8,20}$" title="Le mot de passe doit comporter entre 8 et 20 caractères, dont au moins un numéro, une majuscule et un caractère spécial, les caractères speciaux autorisé sont:(!,@,#,$,%,^,&,*) "><br>
                     </div>
                    </div>
                    <div class="inputBx">
                        <input type="submit" name="login" value="Se connecter">
                    </div>
                    <div class="inputBx">
                       <p>Pas encore de compte ?<a href="inscription.php">Inscrivez-vous.</a></p>
                    </div>
                </form>
        </div>
        </div>
    </section>
</body>
</html>