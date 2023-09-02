<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "elitehomes";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Vérifier si le formulaire a été soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupérer les données du formulaire
        $reservationsId = $_POST['reservations_id'];
        $propertiesId = $_POST['properties_id'];
        $note = $_POST['note'];
        $cleaning = $_POST['cleaning'];
        $pressing = $_POST['pressing'];
        $verification = $_POST['verification'];
        $inventary = $_POST['inventary'];
        $status = $_POST['status'];
       $date =  $date = date('Y-m-d H:i:s');

       $sql = "INSERT INTO maintenance_checklist (reservations_id, properties_id, note, cleaning, pressing, verification, inventary, status, date_field)
        VALUES (:reservationsId, :propertiesId, :note, :cleaning, :pressing, :verification, :inventary, :status, :date)";

        // Préparation de la requête
        $stmt = $conn->prepare($sql);

        // Liaison des valeurs aux paramètres de la requête
        $stmt->bindParam(':reservationsId', $reservationsId);
        $stmt->bindParam(':propertiesId', $propertiesId);
        $stmt->bindParam(':note', $note);
        $stmt->bindParam(':cleaning', $cleaning);
        $stmt->bindParam(':pressing', $pressing);
        $stmt->bindParam(':verification', $verification);
        $stmt->bindParam(':inventary', $inventary);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':date', $date);
       

        // Exécution de la requête
        $stmt->execute();

        echo "Action d'entretien ajoutée avec succès.";
    }
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Traitement des données du formulaire

    // Effectuer la redirection après le traitement
    header("Location: maintenance_check.php");
    exit;
}


// Fermer la connexion à la base de données
$conn = null;
?>





