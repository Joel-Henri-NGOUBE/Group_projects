<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "elitehomes";

session_start();


$id = isset($_GET['id']) ? $_GET['id'] : null;

$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);


function showproperties($pdo) {
    $showproperties = $pdo->prepare("
        SELECT properties.*, pictures.profil
        FROM `properties`
        LEFT JOIN `pictures` ON properties.id = pictures.properties_id
    ");
    $showproperties->execute();

    $properties = $showproperties->fetchAll(PDO::FETCH_ASSOC);

    return $properties;
}

$properties = showproperties($pdo);

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil</title>
       <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap"
      rel="stylesheet"
    />
    <!-- Stylesheet -->
    <link rel="stylesheet" href="./css/style.css" />
    <link rel="stylesheet" href="./css/boutique.css">
    <link rel="stylesheet" href="./css/footer.css">
     <link rel="stylesheet" href="./css/header.css">

</head>
<body> 
 <?php include 'header.php'; ?>
    <section class="photo-section">
        <div class="photo-container">
            <img src="image_tour.jpg" alt="Appartement parisien">
        </div>
        <div id="text-overlay">
            <h1><i>Découvrez l'appartement qui vous correspond...</i></h1>
        </div>
    </section>
       
  <section id="menu">
    <h2 class="title">NOS 200 APPARTEMENTS</h2>
 <div class="dishes">
    <?php
if (!empty($properties)) {
    foreach ($properties as $property) {
        $id = $property['id'];
        $name = $property['name'];
        $pic = $property['profil']; 
        $district = $property['district'];
        
        echo "<div class='dish'>";
        echo "<div class='image-container'>";
        echo "<a href='dashboard.php?id={$id}'><br><img src='{$pic}' alt='{$name}'></a>";
        echo "</div>";
        echo "<br>";
        echo "<a href='dashboard.php?id={$id}'>{$name}</a>";
        echo "</div>";
    }
} else {
    echo "Il n'y a pas de propriété";
}
    ?>

    </div>
</section>
 <?php include 'footer.php'; ?>
</body>
</html>
