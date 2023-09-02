<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: connexion.php");
    exit();
}
if ($_SESSION['roles'] != "admin" && $_SESSION['roles'] != "superadmin" ) {
    header("Location: accueil.php");
    exit();
}
?>


<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="./css/style.css">
    <title>Espace Administrateur</title>
</head>
<body>
    <h1>Espace Administrateur</h1>

    <h2>Options d'administration</h2>
    
    <?php
    if ($_SESSION['roles'] == "superadmin" ) {
        echo '<ul>';
            echo '<li><a href="choix_utilisateur_modification_roles.php">Modifier les rôles des utilisateurs</a></li>';
            echo '<li><a href="choix_utilisateur_modification_statut.php">Modifier le statut des utilisateurs</a></li>';
            echo '<li><a href="choix_utilisateur_suppression.php">Supprimer un compte utilisateur</a></li><br>';    
    }

    ?>

</body>
</html>