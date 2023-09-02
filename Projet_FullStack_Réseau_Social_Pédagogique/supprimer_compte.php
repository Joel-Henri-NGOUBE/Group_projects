<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm'])) {
    // Récupérer l'identifiant de l'utilisateur
    //$user_id = 1; // Remplacez 1 par l'identifiant de l'utilisateur actuel
    // Connexion à la base de données
    $id = $_SESSION["id"];
    $bdd = "votre_base_de_donnees";
    $username = "root";
    $password = "";

    try {
        $pdo = new PDO("mysql:host=localhost;dbname=$bdd, $username, $password");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Supprimer le compte de l'utilisateur
        $query = "DELETE FROM users WHERE id = :id";
        $requete = $pdo->prepare($query);
        $requete->bindParam(':id', $user_id);
        $requete->execute();

        // Rediriger vers une page de confirmation ou de déconnexion
        header("Location: confirmation.php");
        exit();
    } catch (PDOException $e) {
        echo "Erreur lors de la suppression du compte : " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Supprimer mon compte</title>
</head>
<body>
    <h1>Supprimer mon compte</h1>
    <p>Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.</p>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="submit" name="confirm" value="Confirmer la suppression">
    </form>
</body>
</html>
