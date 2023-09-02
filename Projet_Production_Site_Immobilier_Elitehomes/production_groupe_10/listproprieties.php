<?php
session_start();

$id = isset($_GET['id']) ? $_GET['id'] : null;

$pdo = new PDO("mysql:host=localhost:3306;dbname=elitehomes", "root", "");

function showproperties($pdo) {
    $showproperties = $pdo->prepare("
        SELECT properties.*, pictures.pics
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
     <link rel="stylesheet" href="./css/dashboard.css">
          <link rel="stylesheet" href="./css/listeproprieties.css">

    <title>Page d'accueil</title>
</head>
<body> 
    <section>
        <?php
        echo "<a href='./connexion.php'>Connectez-vous</a> "; 
        echo "<br>";
        echo "<a href='./search_1.php'>Rechercher</a>";
        echo "<br>";
        echo "<a href='./infouser.php'>information personel</a>";
        echo "<br>";
        echo "<a href='./deconnexion.php'>Se déconnacter</a>"; 
        ?>
    </section>
    <section>
        <?php
        if (!empty($properties)) {
            foreach ($properties as $row) {
                $id = isset($row['id']) ? $row['id'] : null;
                $name = isset($row['name']) ? $row['name'] : null;
                $pic = isset($row['pics']) ? $row['pics'] : null;
                $district = isset($row['district']) ? $row['district'] : null;
                echo "<br>";
                echo "<a href='dashboard.php?id={$id}'><br><img src='./pics/{$pic}' alt='{$name}'></a>";
                echo "<br>";
                echo "<a href='dashboard.php?id={$id}'>{$name}</a>";
            }
        } else {
            echo "Il n'y a pas de propriété";
        }
        ?>
    </section>
</body>
</html>

