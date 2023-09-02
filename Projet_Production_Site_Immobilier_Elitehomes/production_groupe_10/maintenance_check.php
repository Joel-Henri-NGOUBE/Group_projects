<!DOCTYPE html>
<html>
<head>
     <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <link rel="stylesheet" href="./css/maintenance_check.css">
    <link rel="stylesheet" href="./css/footer.css">
     <link rel="stylesheet" href="./css/header.css">
     <link rel="stylesheet" href="./css/style.css">

</head>
<body>
     <?php include 'header.php'; ?>
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
        $date = date('Y-m-d H:i:s');

        $sql = "INSERT INTO maintenance_checklist (reservations_id, properties_id, note, cleaning, pressing, verification, inventary, status, date_field)
        VALUES (:reservationsId, :propertiesId, :note, :cleaning, :pressing, :verification, :inventary, :status, :date)";

        // Préparation de la requête
        $requete = $conn->prepare($sql);

        // Liaison des valeurs aux paramètres de la requête
        $requete->bindParam(':reservationsId', $reservationsId);
        $requete->bindParam(':propertiesId', $propertiesId);
        $requete->bindParam(':note', $note);
        $requete->bindParam(':cleaning', $cleaning);
        $requete->bindParam(':pressing', $pressing);
        $requete->bindParam(':verification', $verification);
        $requete->bindParam(':inventary', $inventary);
        $requete->bindParam(':status', $status);
        $requete->bindParam(':date', $date);

        // Exécution de la requête
        $requete->execute();

      
    }
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}

// Récupérer les réservations futures avec les logements correspondants
$currentDate = date('Y-m-d');
$query = "SELECT properties.name AS property_name, DATE_FORMAT(reservations.starts_at, '%Y-%m-%d') AS start_date, DATE_FORMAT(reservations.ends_at, '%Y-%m-%d') AS end_date
          FROM reservations
          INNER JOIN properties ON reservations.properties_id = properties.id
          WHERE reservations.starts_at >= :currentDate
          ORDER BY reservations.starts_at ASC";
$requete = $conn->prepare($query);
$requete->bindParam(':currentDate', $currentDate);
$requete->execute();
$reservations = $requete->fetchAll(PDO::FETCH_ASSOC);

// Afficher la vision des réservations à venir pour l'entretien
echo "<h2>Vision des dates de réservations anonymisées de chaque logement</h2>";
echo "<table>";
echo "<thead>";
echo "<tr>";
echo "<th>Logement</th>";
echo "<th>Date de la réservation</th>";
echo "<th>Date de passage</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";

foreach ($reservations as $reservation) {
    echo "<tr>";
    echo "<td>" . anonymize($reservation['property_name']) . "</td>";
    echo "<td>" . $reservation['start_date'] . " - " . $reservation['end_date'] . "</td>";
    
     // Date de passage
    $passageDate = date('Y-m-d', strtotime('-2 days', strtotime($reservation['start_date'])));
    echo "<td>" . $passageDate . "</td>";

    echo "</tr>";
}

echo "</tbody>";
echo "</table>";


function anonymize($property_name) {
   
    $replacement = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 5);
    // Concaténer la chaîne de remplacement avec "XXX"
    return $replacement . "XXX";
}


// Récupérer les données à afficher à partir de la base de données
$query = "SELECT maintenance_checklist.*, properties.name AS property_name
          FROM maintenance_checklist
          INNER JOIN properties ON maintenance_checklist.properties_id = properties.id";
$requete = $conn->query($query);
$results = $requete->fetchAll(PDO::FETCH_ASSOC);

// Afficher les réservations sous forme de tableau
echo "<table>";
echo "<tr>
        <th>ID de réservation</th>
        <th>Propriété</th>
        <th>Statut</th>
        <th>Date</th>
        <th>Action</th>
    </tr>";

foreach ($results as $row) {
    echo "<tr>";
    echo "<td>" . $row['reservations_id'] . "</td>";
    echo "<td>" . $row['property_name'] . "</td>";
    echo "<td>";
    
    // Afficher le statut avec couleur
    if ($row['status'] == 'Terminé') {
        echo "<span style=\"color: green;\">Terminé</span>";
    } elseif ($row['status'] == 'En cours') {
        echo "<span style=\"color: orange;\">En cours</span>";
    } elseif ($row['status'] == 'À faire') {
        echo "<span style=\"color: red;\">À faire</span>";
    }
    
    echo "</td>";
    echo "<td>" . $row['date_field'] . "</td>";
    echo "<td>";
    
    // Formulaire pour mettre à jour le statut
    echo "<form method=\"POST\" action=\"\">";
    echo "<input type=\"hidden\" name=\"reservations_id\" value=\"" . $row['reservations_id'] . "\">";
    echo "<select name=\"status\">
            <option value=\"Terminé\"" . ($row['status'] == 'Terminé' ? ' selected' : '') . ">Terminé</option>
            <option value=\"En cours\"" . ($row['status'] == 'En cours' ? ' selected' : '') . ">En cours</option>
            <option value=\"À faire\"" . ($row['status'] == 'À faire' ? ' selected' : '') . ">À faire</option>
        </select>";
    echo "<input type=\"submit\" value=\"Mettre à jour\">";
    echo "</form>";
    
    echo "</td>";
    echo "</tr>";
}

echo "</table>";
?>
 <?php include 'footer.php'; ?>
</body>
</html>
