<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: connexion.php");
    exit();
} 

if ($_SESSION['roles'] !== "superadmin") {
    header("Location: accueil.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $district = $_POST['district'];
    $capacity = $_POST['capacity'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $surface = $_POST['surface'];
    $position = $_POST['address'];

    $nom_bdd = 'elitehomes';
    $admin = 'root';
    $mdp = '';

    try {
        $pdo = new PDO("mysql:host=localhost;dbname=$nom_bdd", $admin, $mdp);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $includedServicesArray = [];
        if (isset($_POST['includedServices']) && is_array($_POST['includedServices'])) {
            foreach ($_POST['includedServices'] as $service) {
                $service = trim($service);
                if (!empty($service)) {
                    $includedServicesArray[] = $service;
                }
            }
        }
        $includedServices = implode(", ", $includedServicesArray);
        
        $caracteristiqueArray = [];
        if (isset($_POST['caracteristique']) && is_array($_POST['caracteristique'])) {
            foreach ($_POST['caracteristique'] as $caracteristique) {
                $caracteristique = trim($caracteristique);
                if (!empty($caracteristique)) {
                    $caracteristiqueArray[] = $caracteristique;
                }
            }
        }
        $caracteristique = implode(", ", $caracteristiqueArray);

        $sql = "INSERT INTO properties (name, district, capacity, includedServices, price, availability, category, caracteristique, surface, position)
            VALUES (:name, :district, :capacity, :includedServices, :price, 'available', :category, :caracteristique, :surface, :address)";
        $requete = $pdo->prepare($sql);
        $requete->bindParam(':name', $name);
        $requete->bindParam(':district', $district);
        $requete->bindParam(':capacity', $capacity);
        $requete->bindParam(':includedServices', $includedServices);
        $requete->bindParam(':price', $price);
        $requete->bindParam(':category', $category);
        $requete->bindParam(':caracteristique', $caracteristique);
        $requete->bindParam(':surface', $surface);
        $requete->bindParam(':address', $position);
        $requete->execute();

        $propertyId = $pdo->lastInsertId(); // Get the ID of the inserted property
        
        if (isset($_FILES['profil']) && $_FILES['profil']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'pics/';
            $tempName = $_FILES['profil']['tmp_name'];
            $fileName = $_FILES['profil']['name'];
            $targetPath = $uploadDir . $fileName;
            move_uploaded_file($tempName, $targetPath);
            $profil = $fileName;

            // Insertion of the profile image into the pictures table
            $requeteSave = $pdo->prepare("  
                INSERT INTO `pictures` (properties_id, profil)
                VALUES (:properties_id, :profil)
            ");
                
            $requeteSave->execute([
                ":properties_id" => $propertyId,
                ":profil" => $profil,
            ]);
        }

        if (isset($_FILES['description1']) && $_FILES['description1']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'pics/';
            $tempName = $_FILES['description1']['tmp_name'];
            $fileName = $_FILES['description1']['name'];
            $targetPath = $uploadDir . $fileName;
            move_uploaded_file($tempName, $targetPath);
            $description1 = $fileName;

            // Insertion of the first description image into the pictures table
            $requeteSave1 = $pdo->prepare("
                INSERT INTO `pictures` (properties_id, description1)
                VALUES (:properties_id, :description1)
            ");
                
            $requeteSave1->execute([
                ":properties_id" => $propertyId,
                ":description1" => $description1,
            ]);
        }

        if (isset($_FILES['description2']) && $_FILES['description2']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'pics/';
            $tempName = $_FILES['description2']['tmp_name'];
            $fileName = $_FILES['description2']['name'];
            $targetPath = $uploadDir . $fileName;
            move_uploaded_file($tempName, $targetPath);
            $description2 = $fileName;

            // Insertion de la deuxième image de description dans la table pictures
            $requeteSave2 = $pdo->prepare("
            INSERT INTO `pictures` (properties_id, description2)
            VALUES (:properties_id, :description2)
            ");
            
            $requeteSave2->execute([
                ":properties_id" => $propertyId,
                ":description2" => $description2,
            ]);

        }

        if (isset($_FILES['description3']) && $_FILES['description3']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'pics/';
            $tempName = $_FILES['description3']['tmp_name'];
            $fileName = $_FILES['description3']['name'];
            $targetPath = $uploadDir . $fileName;
            move_uploaded_file($tempName, $targetPath);
            $description3 = $fileName;

            // Insertion de la deuxième image de description dans la table pictures
            $requeteSave3 = $pdo->prepare("
            INSERT INTO `pictures` (properties_id, description3)
            VALUES (:properties_id, :description3)
        ");
            
        $requeteSave3->execute([
            ":properties_id" => $propertyId,
            ":description3" => $description3,
        ]);

        }    

        if (isset($_FILES['description4']) && $_FILES['description4']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'pics/';
            $tempName = $_FILES['description4']['tmp_name'];
            $fileName = $_FILES['description4']['name'];
            $targetPath = $uploadDir . $fileName;
            move_uploaded_file($tempName, $targetPath);
            $description4 = $fileName;


            // Insertion de la deuxième image de description dans la table pictures
            $requeteSave4 = $pdo->prepare("
            
            INSERT INTO `pictures` (properties_id, description4)
            VALUES (:properties_id, :description4)

            ");
            
            $requeteSave4->execute([
                ":properties_id" => $propertyId,
                ":description4" => $description4,
            ]);
            

                // Recupérer les donnéesde la page dans la bases de données
                $requeteRecup = $pdo->prepare("
                SELECT profil, description1, description2, description3, description4
                FROM `pictures`
                WHERE profil = :profil AND description1 = :description1 AND description2 = :description2 AND description3 = :description3 AND description4 = :description4 
            ");
            
            $requeteRecup->execute([
                ":profil" => $profil,
                ":description1" => $description1,
                ":description2" => $description2,
                ":description3" => $description3,
                ":description4" => $description4,
            ]);
            
            }
        echo "Propriété ajoutée avec succès!";
        header("Location: traitement_ajout_propriete.php");
        exit();
    } catch (PDOException $e) {
        echo "Erreur: " . $e->getMessage();
    }
}
?>





<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une propriété</title>
     <link rel="stylesheet" href="./css/ajouter_un_logement.css">
     <link rel="stylesheet" href="./css/style.css">


    <script>
        function addField(containerId) {
            var container = document.getElementById(containerId);
            var index = container.getElementsByTagName('input').length + 1;

            var newInput = document.createElement('input');
            newInput.type = 'text';
            newInput.name = containerId.slice(0, -9) + '[]';
            newInput.required = true;
            var patterns = {
                'includedServicesContainer': '[A-Za-zÀ-ÖØ-öø-ÿ]+',
                'caracteristiqueContainer': '[A-Za-zÀ-ÖØ-öø-ÿ]+',
                'priceContainer': '[1-9][0-9]*'
            };
            newInput.pattern = patterns[containerId];

            container.appendChild(newInput);
            container.appendChild(document.createElement('br'));
        }
    </script>
</head>
<body>
    <h1>Ajouter une propriété</h1>
    
    <form method="POST" action="" enctype="multipart/form-data">
        <label for="name">Nom :</label>
        <input type="text" name="name" id="name" required pattern="[A-Za-zÀ-ÖØ-öø-ÿ\s]+"><br>

        <label for="address">Adresse :</label>
        <input type="text" name="address" required><br>

        <label for="district">Arrondissement :</label>
        <select name="district" id="district">
            <option value="1">1ER ARRONDISSEMENT</option>
            <option value="2">2EME ARRONDISSEMENT</option>
            <option value="3">3EME ARRONDISSEMENT</option>
            <option value="4">4EME ARRONDISSEMENT</option>
            <option value="5">5EME ARRONDISSEMENT</option>
            <option value="6">6EME ARRONDISSEMENT</option>
            <option value="7">7EME ARRONDISSEMENT</option>
            <option value="8">8EME ARRONDISSEMENT</option>
            <option value="9">9EME ARRONDISSEMENT</option>
            <option value="10">10EME ARRONDISSEMENT</option>
            <option value="11">11EME ARRONDISSEMENT</option>
            <option value="12">12EME ARRONDISSEMENT</option>
            <option value="13">13EME ARRONDISSEMENT</option>
            <option value="14">14EME ARRONDISSEMENT</option>
            <option value="15">15EME ARRONDISSEMENT</option>
            <option value="16">16EME ARRONDISSEMENT</option>
            <option value="17">17EME ARRONDISSEMENT</option>
            <option value="18">18EME ARRONDISSEMENT</option>
            <option value="19">19EME ARRONDISSEMENT</option>
            <option value="20">20EME ARRONDISSEMENT</option>
            <option value="77">SEINE-ET-MARNE</option>
            <option value="922">NEUILLY-SUR-SEINE</option>
        </select><br>
        <label for="capacity">Capacité :</label>
        <input type="text" name="capacity" required pattern="[1-9][0-9]?"><br>

        <label for="includedServices">Services inclus :</label>
        <div id="includedServicesContainer">
            <input type="text" name="includedServices[]" required pattern="[A-Za-zÀ-ÖØ-öø-ÿ\s]+"><br>
        </div>
        <button type="button" onclick="addField('includedServicesContainer')">Ajouter un service</button><br>

        <label for="price">Prix :</label>
        <input type="text" name="price" required pattern="[1-9][0-9]*"><br>

        <label for="category">Catégorie :</label>
        <input type="text" name="category" required pattern="[A-Za-zÀ-ÖØ-öø-ÿ\s]+"><br>

        <label for="caracteristique">Caractéristiques :</label>
        <div id="caracteristiqueContainer">
            <input type="text" name="caracteristique[]" required pattern="[A-Za-zÀ-ÖØ-öø-ÿ\s]+"><br>
        </div>
        <button type="button" onclick="addField('caracteristiqueContainer')">Ajouter une caractéristique</button><br>

        <label for="surface">Surface :</label>
        <input type="text" name="surface" required placeholder="en m²" pattern="[1-9][0-9]*"><br>

        <label for="profil">Photo de profil :</label>
        <input type="file" id="profil" name="profil"><br><br>

        <label for="description1">Photo de description 1:</label>
        <input type="file" id="description1" name="description1"><br><br>

        <label for="description2">Photo de description 2:</label>
        <input type="file" id="description2" name="description2"><br><br>

        <label for="description3">Photo de description 3:</label>
        <input type="file" id="description3" name="description3"><br><br>

        <label for="description4">Photo de description 4:</label>
        <input type="file" id="description4" name="description4"><br><br>

        <input type="submit" value="Ajouter la propriété">
        <a href="administrateur.php">Retour vers la page administrateur</a>

    </form>
</body>
</html>
