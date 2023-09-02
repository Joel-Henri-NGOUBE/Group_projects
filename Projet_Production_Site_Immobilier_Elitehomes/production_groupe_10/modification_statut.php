<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: connexion.php");
    exit();
} 
if ($_SESSION['roles'] != "superadmin" ) {
    header("Location: pageaccueil.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userMail = $_POST['mail'];
    $Status = $_POST['status'];

    if (!empty($userMail) && !empty($Status)) {
        $nom_bdd = 'elitehomes';
        $admin = 'root';
        $mdp = '';
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=$nom_bdd", $admin, $mdp);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT id FROM users WHERE mail = :userMail";
            $requete = $pdo->prepare($sql);
            $requete->bindParam(':userMail', $userMail);
            $requete->execute();

            if ($requete->rowCount() > 0) {
                $sql = "UPDATE users SET status = :Status WHERE mail = :userMail";
                $requete = $pdo->prepare($sql);
                $requete->bindParam(':Status', $Status);
                $requete->bindParam(':userMail', $userMail);
                $requete->execute();

                echo "Le status de l'utilisateur a été modifié avec succès.";
            } else {
                echo "Utilisateur non trouvé.";
            }
        } catch (PDOException $e) {
            die("La connexion à la base de données a échoué : " . $e->getMessage());
        }
    } else {
        echo "Veuillez sélectionner un utilisateur et un status.";
    }
} else {
    echo "Cette page ne peut être accédée directement.";
}
echo '<br>';
echo '<a href="administrateur.php">Accéder à l\'espace administrateur</a>';
echo '<br>';
echo '<a href="deconnexion.php">Déconnectez-vous!</a>';
?>
