<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une propriété</title>
     <link rel="stylesheet" href="./css/modification_logement.css">
     <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/footer.css">
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

            var deleteButton = document.createElement('button');
            deleteButton.type = 'button';
            deleteButton.innerText = 'X';
            deleteButton.addEventListener('click', function() {
                container.removeChild(newInput);
                container.removeChild(deleteButton);
            });

            container.appendChild(newInput);
            container.appendChild(deleteButton);
            container.appendChild(document.createElement('br'));
        }
    </script>
</head>
<body>
    <h1>Modifier une propriété</h1>
    <?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: connexion.php");
    exit();
} 
if ($_SESSION['roles'] !== "superadmin") {
    header("Location: pageaccueil.php");
    exit();
}

    if (!isset($_GET['property_id'])) {
        echo "L'ID de propriété n'est pas spécifié.";
        exit();
    }

    $propertyId = $_GET['property_id'];

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

            $sql = "UPDATE properties SET name = :name, district = :district, capacity = :capacity, includedServices = :includedServices, price = :price, category = :category, caracteristique = :caracteristique, surface = :surface, position = :address WHERE id = :propertyId";
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
            $requete->bindParam(':propertyId', $propertyId);
            $requete->execute();

            echo "Propriété mise à jour avec succès !";
            header("Location: traitement_modification_logement.php");
            exit();
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    } else {
        $nom_bdd = 'elitehomes';
        $admin = 'root';
        $mdp = '';

        try {
            $pdo = new PDO("mysql:host=localhost;dbname=$nom_bdd", $admin, $mdp);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM properties WHERE id = :propertyId";
            $requete = $pdo->prepare($sql);
            $requete->bindParam(':propertyId', $propertyId);
            $requete->execute();
            $property = $requete->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            exit();
        }
    }
    ?>
    <form method="POST" action="">
        <label for="name">Nom :</label>
        <input type="text" name="name" id="name" required pattern="[A-Za-zÀ-ÖØ-öø-ÿ\s]+" value="<?php echo $property['name']; ?>"><br>

        <label for="address">Adresse :</label>
        <input type="text" name="address" required value="<?php echo $property['position']; ?>"><br>

        <label for="district">Arrondissement :</label>
        <select name="district" id="district">
            <?php
            $districts = [
                '1' => '1ER ARRONDISSEMENT',
                '2' => '2EME ARRONDISSEMENT',
                '3' => '3EME ARRONDISSEMENT',
                '4' => '4EME ARRONDISSEMENT',
                '5' => '5EME ARRONDISSEMENT',
                '6' => '6EME ARRONDISSEMENT',
                '7' => '7EME ARRONDISSEMENT',
                '8' => '8EME ARRONDISSEMENT',
                '9' => '9EME ARRONDISSEMENT',
                '10' => '10EME ARRONDISSEMENT',
                '11' => '11EME ARRONDISSEMENT',
                '12' => '12EME ARRONDISSEMENT',
                '13' => '13EME ARRONDISSEMENT',
                '14' => '14EME ARRONDISSEMENT',
                '15' => '15EME ARRONDISSEMENT',
                '16' => '16EME ARRONDISSEMENT',
                '17' => '17EME ARRONDISSEMENT',
                '18' => '18EME ARRONDISSEMENT',
                '19' => '19EME ARRONDISSEMENT',
                '20' => '20EME ARRONDISSEMENT',
                '77' => 'SEINE-ET-MARNE',
                '922' => 'NEUILLY-SUR-SEINE'
            ];
            foreach ($districts as $value => $label) {
                $selected = ($value == $property['district']) ? 'selected' : '';
                echo "<option value=\"$value\" $selected>$label</option>";
            }
            ?>
        </select><br>
        <label for="capacity">Capacité :</label>
        <input type="text" name="capacity" required pattern="[1-9][0-9]?" value="<?php echo $property['capacity']; ?>">Personnes<br>

        <label for="includedServices">Services inclus :</label>
        <div id="includedServicesContainer">
            <?php
            $includedServices = explode(", ", $property['includedServices']);
            foreach ($includedServices as $service) {
                echo "<input type=\"text\" name=\"includedServices[]\" required pattern=\"[A-Za-zÀ-ÖØ-öø-ÿ\s]+\" value=\"$service\"><button type=\"button\" onclick=\"removeField(this)\">X</button><br>";
            }
            ?>
        </div>
        <button type="button" onclick="addField('includedServicesContainer')">Ajouter un service</button><br>

        <label for="price">Prix :</label>
        <input type="text" name="price" required pattern="[1-9][0-9]*" value="<?php echo intval($property['price']); ?>">€<br>

        <label for="category">Catégorie :</label>
        <input type="text" name="category" required pattern="[A-Za-zÀ-ÖØ-öø-ÿ\s]+" value="<?php echo $property['category']; ?>"><br>

        <label for="caracteristique">Caractéristiques :</label>
        <div id="caracteristiqueContainer">
            <?php
            $caracteristiques = explode(", ", $property['caracteristique']);
            foreach ($caracteristiques as $caracteristique) {
                echo "<input type=\"text\" name=\"caracteristique[]\" required pattern=\"[A-Za-zÀ-ÖØ-öø-ÿ\s]+\" value=\"$caracteristique\"><button type=\"button\" onclick=\"removeField(this)\">X</button><br>";
            }
            ?>
        </div>
        <button type="button" onclick="addField('caracteristiqueContainer')">Ajouter une caractéristique</button><br>

        <label for="surface">Surface :</label>
        <input type="text" name="surface" required placeholder="en m²" pattern="[1-9][0-9]*" value="<?php echo intval($property['surface']); ?>">m²<br>

        <input type="submit" value="Mettre à jour la propriété">
        <a href="administrateur.php">Retour vers la page de gestion de propriété</a>
    </form>
    <script>
        function removeField(button) {
            var container = button.parentNode;
            container.removeChild(button.previousSibling);
            container.removeChild(button);
        }
    </script>
</body>
</html>