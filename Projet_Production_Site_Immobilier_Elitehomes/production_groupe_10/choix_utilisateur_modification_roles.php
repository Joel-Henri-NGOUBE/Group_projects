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
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="./css/style.css">
    <title>Modification des rôles</title>
</head>
<body>
    <h1>Modification des rôles</h1>
    <form action="modification_roles.php" method="post">
        <label for="mail">Sélectionnez un mail :</label>
        <select name="mail" id="mail">
            <option value="">-- Sélectionnez un mail --</option>
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
        <label for="roles">Nouveau rôle :</label>
        <select name="roles" id="roles">
            <option value="">-- Sélectionnez un rôle --</option>
            <option value="client">Client</option>
            <option value="entretien">Entretien</option>
            <option value="admin">Admin</option>
        </select>

        <input type="submit" value="Modifier le rôle">
    </form>
    <a href="administrateur.php">Retourner à l'espace administrateur</a>
    <a href="deconnexion.php">Déconnectez-vous!</a>
</body>
</html>
