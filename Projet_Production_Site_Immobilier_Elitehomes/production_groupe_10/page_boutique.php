<?php
session_start();
 
if (!isset($_SESSION['id'])) {
    header("Location: connexion.php");
    exit();
}

$username = "root";
$password = "";
$database = "elitehomes";

function checkAvailability($starts_date, $ends_date, $pdo, $properties) {
    try {
        $sql = "SELECT COUNT(*) AS count FROM reservations WHERE properties_id = :properties_id AND starts_at <= :ends_date AND ends_at >= :starts_date";
        $requete = $pdo->prepare($sql);
        $requete->bindParam(':properties_id', $properties);
        $requete->bindParam(':starts_date', $starts_date);
        $requete->bindParam(':ends_date', $ends_date);
        $requete->execute();

        $count = $requete->fetchColumn();

        if ($count > 0) {
            return false; // Le logement n'est pas disponible pour les dates sélectionnées
        } else {
            return true; // Le logement est disponible pour les dates sélectionnées
        }
    } catch (PDOException $e) {
        echo "Une erreur s'est produite lors de la vérification de disponibilité : " . $e->getMessage();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $destination = $_POST['destination'];
    $nombre_places = $_POST['nombre_places'];
    $date_debut = $_POST['date_debut'];
    $date_fin = $_POST['date_fin'];

    try {
        $pdo = new PDO("mysql:host=localhost;dbname=$database", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       
        $sql = "SELECT * FROM properties WHERE district = :destination AND capacity >= :nombre_places";

        $requete = $pdo->prepare($sql);
        $requete->bindParam(':destination', $destination);
        $requete->bindParam(':nombre_places', $nombre_places);
        $requete->execute();
        $property = $requete->fetchAll(PDO::FETCH_ASSOC);

        if ($requete->rowCount() > 0) {
            foreach ($property as $property) {
                $is_available = checkAvailability($date_debut, $date_fin, $pdo, $property['id']);

                if ($is_available) {
                    echo "Nom du bien : " . $property['name'] . "<br>";
                    echo "Arrondissement : " . $property['district'] . "<br>";
                    echo "Nombre de personnes : " . $property['capacity'] . "<br>";
                    echo "Prix : " . $property['price'] . "€" . "<br>";
                    echo "Type : " . $property['category'] . "<br>";
                    echo "<br>";
                }
            }
        } else {
            echo "Aucune propriété trouvée pour les critères sélectionnés.";
        }
    } catch (PDOException $e) {
        echo "Une erreur s'est produite lors de la connexion à la base de données : " . $e->getMessage();
    }
}

?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="./css/style.css">
    <title>Boutiques</title>
</head>
<body>
    <h1>filtres</h1>
    <form method="POST" action="">
    <select name="destination" id="destination">
        <option value="1"<?php if(isset($_GET['destination']) && $_GET['destination'] == '1ER ARRONDISSEMENT') echo ' selected'; ?>>1ER ARRONDISSEMENT</option>
        <option value="2"<?php if(isset($_GET['destination']) && $_GET['destination'] == '2EME ARRONDISSEMENT') echo ' selected'; ?>>2EME ARRONDISSEMENT</option>
        <option value="3"<?php if(isset($_GET['destination']) && $_GET['destination'] == '3EME ARRONDISSEMENT') echo ' selected'; ?>>3EME ARRONDISSEMENT</option>
        <option value="4"<?php if(isset($_GET['destination']) && $_GET['destination'] == '4EME ARRONDISSEMENT') echo ' selected'; ?>>4EME ARRONDISSEMENT</option>
        <option value="5"<?php if(isset($_GET['destination']) && $_GET['destination'] == '5EME ARRONDISSEMENT') echo ' selected'; ?>>5EME ARRONDISSEMENT</option>
        <option value="6"<?php if(isset($_GET['destination']) && $_GET['destination'] == '6EME ARRONDISSEMENT') echo ' selected'; ?>>6EME ARRONDISSEMENT</option>
        <option value="7"<?php if(isset($_GET['destination']) && $_GET['destination'] == '7EME ARRONDISSEMENT') echo ' selected'; ?>>7EME ARRONDISSEMENT</option>
        <option value="8"<?php if(isset($_GET['destination']) && $_GET['destination'] == '8EME ARRONDISSEMENT') echo ' selected'; ?>>8EME ARRONDISSEMENT</option>
        <option value="9"<?php if(isset($_GET['destination']) && $_GET['destination'] == '9EME ARRONDISSEMENT') echo ' selected'; ?>>9EME ARRONDISSEMENT</option>
        <option value="10"<?php if(isset($_GET['destination']) && $_GET['destination'] == '10EME ARRONDISSEMENT') echo ' selected'; ?>>10EME ARRONDISSEMENT</option>
        <option value="11"<?php if(isset($_GET['destination']) && $_GET['destination'] == '11EME ARRONDISSEMENT') echo ' selected'; ?>>11EME ARRONDISSEMENT</option>
        <option value="12"<?php if(isset($_GET['destination']) && $_GET['destination'] == '12EME ARRONDISSEMENT') echo ' selected'; ?>>12EME ARRONDISSEMENT</option>
        <option value="13"<?php if(isset($_GET['destination']) && $_GET['destination'] == '13EME ARRONDISSEMENT') echo ' selected'; ?>>13EME ARRONDISSEMENT</option>
        <option value="14"<?php if(isset($_GET['destination']) && $_GET['destination'] == '14EME ARRONDISSEMENT') echo ' selected'; ?>>14EME ARRONDISSEMENT</option>
        <option value="15"<?php if(isset($_GET['destination']) && $_GET['destination'] == '15EME ARRONDISSEMENT') echo ' selected'; ?>>15EME ARRONDISSEMENT</option>
        <option value="16"<?php if(isset($_GET['destination']) && $_GET['destination'] == '16EME ARRONDISSEMENT') echo ' selected'; ?>>16EME ARRONDISSEMENT</option>
        <option value="17"<?php if(isset($_GET['destination']) && $_GET['destination'] == '17EME ARRONDISSEMENT') echo ' selected'; ?>>17EME ARRONDISSEMENT</option>
        <option value="18"<?php if(isset($_GET['destination']) && $_GET['destination'] == '18EME ARRONDISSEMENT') echo ' selected'; ?>>18EME ARRONDISSEMENT</option>
        <option value="19"<?php if(isset($_GET['destination']) && $_GET['destination'] == '19EME ARRONDISSEMENT') echo ' selected'; ?>>19EME ARRONDISSEMENT</option>
        <option value="20"<?php if(isset($_GET['destination']) && $_GET['destination'] == '20EME ARRONDISSEMENT') echo ' selected'; ?>>20EME ARRONDISSEMENT</option>
        <option value="SEINE-ET-MARNE"<?php if(isset($_GET['destination']) && $_GET['destination'] == 'SEINE-ET-MARNE') echo ' selected'; ?>>SEINE-ET-MARNE</option>
        <option value="NEUILLY-SUR-SEINE"<?php if(isset($_GET['destination']) && $_GET['destination'] == 'NEUILLY-SUR-SEINE') echo ' selected'; ?>>NEUILLY-SUR-SEINE</option>
      </select>

    <label for="nombre_places">Nombre de places :</label>
    <input type="number" name="nombre_places" id="nombre_places" required><br>

    <label for="date_debut">Date de début :</label>
    <input type="date" name="date_debut" id="date_debut" required><br>

    <label for="date_fin">Date de fin :</label>
    <input type="date" name="date_fin" id="date_fin" required><br>

    <input type="submit" value="Rechercher">
</form>
</body>
</html>
