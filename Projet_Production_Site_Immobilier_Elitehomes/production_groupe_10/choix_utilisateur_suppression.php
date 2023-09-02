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
    <title>Suppression d'un utilisateur</title>
</head>
<body>
    <h1>Suppression d'un utilisateur</h1>

    <form action="suppression.php" method="post">
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

                $sql = "SELECT id, mail FROM users";
                $requete = $pdo->query($sql);
                while ($row = $requete->fetch(PDO::FETCH_ASSOC)) {
                    echo '<option value="' . $row['mail'] . '">' . $row['mail'] . '</option>';
                }
            } catch (PDOException $e) {
                die("La connexion à la base de données a échoué : " . $e->getMessage());
            }
            ?>
        </select>

        <input type="submit" value="Supprimer l'utilisateur">
    </form>
    <a href="administrateur.php">Retourner à l'espace administrateur</a>
    <br>
    <a href="deconnexion.php">Déconnectez-vous!</a>
</body>
</html>
