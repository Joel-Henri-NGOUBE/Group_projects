<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "elitehomes";

$districtId = $_GET['district'];

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $requete = $pdo->prepare("SELECT * FROM properties WHERE district = :districtId");
    $requete->bindParam(':districtId', $districtId, PDO::PARAM_STR);
    $requete->execute();

    $apartments = $requete->fetchAll(PDO::FETCH_ASSOC);

    $pdo = null;

    header('Content-Type: application/json');
    echo json_encode($apartments);
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Paris et environs...</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
  integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
  crossorigin=""/>
  <script> src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
  integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
  crossorigin=""</script>
  <link rel="stylesheet" href="map.css">
  <script src="map.js"></script>

</head>
<body>
  <div id="map"></div>
  <div id="apartments-info"></div>

</body>
</html>

