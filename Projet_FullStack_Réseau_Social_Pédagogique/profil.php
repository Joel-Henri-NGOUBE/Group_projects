<?php
require "vendor/autoload.php";
use GuzzleHttp\Client;
session_start();

$methode = FILTER_INPUT(INPUT_SERVER,"REQUEST_METHOD");

if ($methode == "POST") {
    if (isset($_FILES)) {
        var_dump($_FILES);
        $id = $_SESSION["id"];
        $title = FILTER_INPUT(INPUT_POST,"title");
        $image = $_FILES["image"]["tmp_name"];
        $image_type = $_FILES["image"]["type"];
        $description = FILTER_INPUT(INPUT_POST,"description");

        $data = [
            "id" => $id,
            "title" => $title,
            "image" => $image,
            "description" => $description,
            "image_type" => $image_type
        ];

        $data = json_encode($data);

        $client = new GuzzleHttp\Client();
        $res = $client->request('POST','http://localhost:80/Projet_FullStack/Server/publish.php', [
            "form_params" => ["body" => $data]
        ]);

        $body = $res->getBody()->getContents();
        $body = json_decode($body,true);

        if ($body["Statut"] == "Succès" && $title && $image && $description) {
            $nameImage = "image".$id."-".$body["Message"]["id_image"].$body["Message"]["extension"];
            $image = move_uploaded_file(rename($_FILES["image"]["tmp_name"],$nameImage),'Projet_FullStack/');
            $cheminImages = "./".$nameImage;
        } else if ($body["Statut"] == "Erreur") {
            if ($body["Message"] == "Champs incomplets") {
                echo "<div><p>".$body["Message"]."</p></div>";
            } else {
                echo "<div><p>Erreur Système</p></div>";
            }
            exit();
        }

        $data2 = [
            "id_user" => $id,
            "id_image" => $body["Message"]["id_image"],
            "chemin" => $cheminImages
        ];

        $data2 = json_encode($data2);

        $client2 = new GuzzleHttp\Client();
        $res2 = $client2->request('POST','http://localhost:80/Projet_FullStack/Server/cheminImages.php', [
            "form_params" => ["body" => $data2]
        ]);

        $body2 = $res2->getBody()->getContents();
        $body2 = json_decode($body2,true);

        if ($body2["Statut"] == "Succès") {
            // Actions à effectuer en cas de succès
        } else if ($body2["Statut"] == "Erreur") {
            echo "<div><p>Erreur Système</p></div>";
            exit();
        }
    }
}

$id_array = ["id" => $_SESSION["id"]];
$client3 = new GuzzleHttp\Client();
$res3 = $client3->request('POST','http://localhost:80/Projet_FullStack/Server/page.php', [
    "form_params" => ["body" => $id_array]
]);
$id = 1;
$user = "root";
$password1 = "";
$pdo = new PDO("mysql:host=localhost:3306;dbname=application", $user , $password1);

$sql = "SELECT * FROM users WHERE id = :id";
$requete = $pdo->prepare($sql);
$requete->bindParam(':id', $id);
$requete->execute();
$user = $requete->fetch(PDO::FETCH_ASSOC);

if ($user) {
    $banner = $user['banner'];
    $profile_pic = $user['profile_pic'];
    $email = $user['email'];
    $first_name = $user['first_name'];
    $last_name = $user['last_name'];
} else {
    echo "Utilisateur non trouvé";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Responsive Profile Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
    <div class="header__wrapper">
        <header></header>
        <div class="cols__container">
            <div class="left__col">
                <div class="img__container">
                    <?php echo "<img src='$profile_pic' alt='$first_name $last_name'>"; ?>
                    <!-- <img src="img/user.jpeg" alt="Anna Smith" /> -->
                    <span></span>
                </div>
                <h2><?php echo $first_name . " " . $last_name; ?></h2>
                <p>Email: <?php echo $email; ?></p>
                <ul class="about">
                    <li><span>34</span>Publications</li>
                    <li><span>673</span>Abonnés</li>
                    <li><span>322</span>Abonnements</li>
                </ul>
                <div class="content">
                    <ul>
                        <li><i class="fab fa-twitter"></i></li>
                        <i class="fab fa-pinterest"></i>
                        <i class="fab fa-facebook"></i>
                        <i class="fab fa-dribbble"></i>
                    </ul>
                </div>
            </div>
            <div class="right__col">
                <nav>
                    <ul>
                        <li><a href="http://localhost/projet_fullstack/photo_profil.php">photos</a></li>
                        <li><a href="">videos</a></li>
                        <li><a href="">commentaires</a></li>
                    </ul>
                    <form action="modification_profil.php" method="POST">
                        <input type="submit" value="Modifier le profil">
                    </form>
                </nav>
                <div class="photos">
                    <?php
                    $sql = "SELECT title,image FROM publications where id_user = 1";
                    $requete = $pdo->prepare($sql);
                    $requete->execute();
                    $publications = $requete->fetchAll(PDO::FETCH_ASSOC);

                    if ($publications) {
                        echo "<h2>Liste des publications :</h2>";
                        echo "<ul>";

                        foreach ($publications as $publication) {
                            $image_publication = $publication['image'];
                            $title_publication = $publication['title'];

                            echo "<li>";
                            echo "<img src='$image_publication' alt='$title_publication' />";
                            echo "<h3>$title_publication</h3>";
                            echo "</li>";
                        }

                        echo "</ul>";
                    } else {
                        echo "<p>Aucune publication trouvée</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
