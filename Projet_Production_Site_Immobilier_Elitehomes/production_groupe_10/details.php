<?php
session_start();
$_SESSION ['save_page']  =6 ;
$id = $_GET['id'];
$_SESSION ['id_logement'] ="dashboard.php?id={$id}";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du logement</title>
    <link rel="stylesheet" href="./css/details.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/style.css">

</head>
<body>
     
    <div class="container">
    <div class="details-container">
   
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "elitehomes";

        try {
            $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $id = $_GET['id'];

            $sql = "SELECT * FROM properties WHERE id = :id";
            $requete = $pdo->prepare($sql);
            $requete->bindParam(':id', $id);
            $requete->execute();

            if ($requete->rowCount() > 0) {
                $row = $requete->fetch(PDO::FETCH_ASSOC);
                echo '<h1>Détails du logement</h1>';
                echo '<p>' . $row['name'] . '</p>';
                echo '<p>Emplacement : ' . $row['position'] . '</p>';
                echo '<p>Capacité : ' . $row['capacity'] . ' Personnes</p>';
                echo '<p>Services inclus : ' . $row['includedServices'] . '</p>';
                echo '<p>Prix : ' . $row['price'] . ' €</p>';
                echo '<p>Disponibilité : ' . $row['availability'] . '</p>';
                echo '<p>Catégorie : ' . $row['category'] . '</p>';
                echo '<p>Caractéristiques : ' . $row['caracteristique'] . '</p>';
                echo '<p>Surface : ' . $row['surface'] . ' m²</p>';
                echo '<p><a href="javascript:history.back()">Revenir à la recherche</a></p>';

                echo "<a href='dashboard.php?id={$id}'>Reserver ce logement</a>";

            } else {
                echo "Aucun logement trouvé.";
            }
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    
            $sql_images = "SELECT  profil, description1, description2, description3, description4 FROM pictures WHERE properties_id = :id";
            $requete_images = $pdo->prepare($sql_images);
            $requete_images->bindParam(':id', $id);
            $requete_images->execute();
            $images = $requete_images->fetchAll(PDO::FETCH_ASSOC);

                
        if (!empty($images)) {
            foreach ($images as $image) {
                echo '<div class="image-container">';
                echo '<img src="./pics/' . $image['profil'] . '" alt="">';
                echo '</div>';

                
            }
        }
        ?>
    </div>
    </div>

</body>

</html>
