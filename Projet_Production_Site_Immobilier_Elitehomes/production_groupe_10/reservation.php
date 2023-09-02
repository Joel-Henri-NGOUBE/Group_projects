<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma réservation</title>
    <link rel="stylesheet" href="./css/reservation.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/footer.css">



</head>
<body>
    <div class="container"> 
<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    // L'utilisateur n'est pas connecté, rediriger vers la page de connexion
    header("Location: connexion.php");
    exit();
}

// Configuration de la connexion PDO à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$database = "elitehomes";

// Fonction pour vérifier la disponibilité du logement
function checkAvailability($start_date, $end_date, $conn) {
    try {
        // Requête SQL pour vérifier la disponibilité du logement
        $sql = "SELECT COUNT(*) AS count FROM reservations WHERE properties_id = :properties_id AND starts_at <= :end_date AND ends_at >= :start_date";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':properties_id', $_POST['property_id']);
        $stmt->bindParam(':start_date', $start_date);
        $stmt->bindParam(':end_date', $end_date);
        $stmt->execute();

        $count = $stmt->fetchColumn();

        if ($count > 0) {
            return false; // Le logement n'est pas disponible pour les dates sélectionnées
        } else {
            return true; // Le logement est disponible pour les dates sélectionnées
        }
    } catch (PDOException $e) {
        echo "Une erreur s'est produite lors de la vérification de disponibilité : " . $e->getMessage();
    }
}

function showDetailsReservation($reservationId, $conn) {
    try {
        $stmt = $conn->prepare("SELECT * FROM reservations WHERE id = :reservation_id");
        $stmt->bindParam(':reservation_id', $reservationId);
        $stmt->execute();
        $reservation = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Vérifier si la réservation existe
        if ($reservation) {
            // Afficher les détails de la réservation
            echo "Numéro de réservation : " . $reservation['id'] . "<br>";
            echo "Date de début : " . $reservation['starts_at'] . "<br>";
            echo "Date de fin : " . $reservation['ends_at'] . "<br>";
            echo "Propriété : " . $reservation['properties_name'] . "<br>";
            echo "Option : " . $reservation['option'] . "<br>";
            echo "Nombre de voyageurs : " . $reservation['passenger'] . "<br>";



        } else {
            echo "La réservation n'existe pas.";
        }
    } catch (PDOException $e) {
        echo "Une erreur s'est produite lors de la récupération des détails de la réservation : " . $e->getMessage();
    }
}


// Traitement du formulaire de réservation
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $start_date = $_POST['starts_at'];
    $end_date = $_POST['ends_at'];
    $passenger = $_POST['passenger'];

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       
        // Vérifier la disponibilité du logement
        $is_available = checkAvailability($start_date, $end_date, $conn);

        if ($is_available) {
            // Effectuer la réservation
            $users_id = $_SESSION['id']; // ID de l'utilisateur

            // Récupérer l'ID et le nom de la propriété à partir de la base de données
            $property_id = $_POST['property_id'];
            $stmt = $conn->prepare("SELECT id, name FROM properties WHERE id = :property_id");
            $stmt->bindParam(':property_id', $property_id);
            $stmt->execute();
            $property = $stmt->fetch(PDO::FETCH_ASSOC);

            $properties_id = $property['id'];
            $properties_name = $property['name'];

            // Requête SQL pour insérer la réservation dans la base de données
            $sql = "INSERT INTO reservations (properties_id, users_id, starts_at, ends_at, properties_name, passenger, `option`) VALUES (:properties_id, :users_id, :start_date, :end_date, :properties_name, :passenger, :option)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':properties_id', $properties_id);
            $stmt->bindParam(':users_id', $users_id);
            $stmt->bindParam(':start_date', $start_date);
            $stmt->bindParam(':end_date', $end_date);
            $stmt->bindParam(':properties_name', $properties_name);
            $stmt->bindParam(':passenger', $passenger);
            $stmt->bindParam(':option', $_POST['option']);
            $stmt->execute();

            echo "Réservation effectuée avec succès.<br>";
            $reservationId = $conn->lastInsertId();
            showDetailsReservation($reservationId, $conn);
        } else {
            echo "Le logement n'est pas disponible pour les dates sélectionnées.";
        }
    } catch (PDOException $e) {
        echo "Une erreur s'est produite lors de la connexion à la base de données : " . $e->getMessage();
    }
}

?>
 <a href='./pageaccueil.php' class='home-button'>Retour à l'accueil</a>
</body>
</html>


