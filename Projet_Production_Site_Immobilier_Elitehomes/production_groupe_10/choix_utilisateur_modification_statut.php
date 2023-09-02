<?php 
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: connexion.php");
    exit();
} 
if ($_SESSION['roles'] != "superadmin" ) {
    header("Location: accueil.php");
    exit();
}
echo $_SESSION['id'];
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="./css/style.css">
    <title>Modification du statut</title>
</head>
<body>
    <h1>Modification du statut</h1>

    <form method="post" action="modification_statut.php">
        <label for="mail">Sélectionnez un utilisateur :</label>
        <select name="mail" id="mail">
            <option value="">-- Sélectionnez un utilisateur --</option>
            <?php
            $nom_bdd = 'elitehomes';
            $admin = 'root';
            $mdp = '';

            try {
                $pdo = new PDO("mysql:host=localhost;dbname=$nom_bdd", $admin, $mdp);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "SELECT mail FROM users";
                $requete = $pdo->query($sql);

                while ($row = $requete->fetch(PDO::FETCH_ASSOC)) {
                    echo '<option value="' . $row['mail'] . '">' . $row['mail'] . '</option>';
                }
            } catch (PDOException $e) {
                die("La connexion à la base de données a échoué : " . $e->getMessage());
            }
            ?>
        </select>

        <label for="status">Nouveau statut :</label>
        <select name="status" id="status">
            <option value="">-- Sélectionnez un statut --</option>
            <option value="activé">activé</option>
            <option value="désactivé">désactivé</option>
        </select>

        <input type="submit" value="Modifier le statut">
    </form>
    <a href="administrateur.php">Retourner à l'espace administrateur</a>
    <br>
    <a href="deconnexion.php">Déconnectez-vous!</a>
</body>
</html>
