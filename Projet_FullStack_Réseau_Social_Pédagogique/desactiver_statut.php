<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];

    // Connexion à la base de données
    $bdd = "application";
    $username = "root";
    $password = "";

    try {
        $pdo = new PDO("mysql:host=localhost;dbname=$bdd, $username, $password");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Requête UPDATE pour désactiver le statut
        $query = "UPDATE users SET status = 'désactivé' WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $user_id);
        $stmt->execute();

        echo "Le statut a été désactivé avec succès.";
    } catch (PDOException $e) {
        echo "Erreur lors de la désactivation du statut : " . $e->getMessage();
    }
}
session_start();
session_destroy();
header("Location: connexion.php");
?>
