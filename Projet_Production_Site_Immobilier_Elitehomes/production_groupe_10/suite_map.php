<?php
session_start();

if (!isset($_SESSION['id']) || empty($_SESSION['id'])) {

    header("Location: connexion.php");
    exit();
}


$userId = $_SESSION['id'];


$nom_bdd = 'elitehomes';
$admin = 'root';
$mdp = '';

try {
    $pdo = new PDO("mysql:host=localhost;dbname=$nom_bdd", $admin, $mdp);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
    exit();
}

    $id = $_GET['id'];

    $recupdetail = $pdo->prepare("
    SELECT *
    FROM `properties`
    WHERE properties.id = :id

    ");

    $recupdetail->execute([
        ":id" => $id
    ]); 

    $propertydata = $recupdetail->fetch(PDO::FETCH_ASSOC);

    $propertyname = $propertydata['name'];
    $propertyposition = $propertydata['position'];
    $propertycapacity = $propertydata['capacity'];
    $propertyprice = $propertydata['price'];
    $propertycaracteristic = $propertydata['caracteristique'];
    $propertycategory = $propertydata['category'];



$query = "SELECT * FROM users WHERE id = :userId";
$requete = $pdo->prepare($query);
$requete->bindParam(':userId', $userId);
$requete->execute();
$user = $requete->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    header("Location: connexion.php");
    exit();
}

?>
<!DOCTYPE html>
<html>
<head>
     <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Détail du logement</title>
    <link rel="stylesheet" href="./css/dashboard.css">
    <link rel="stylesheet" href="./javascript/javascript.js">

</head>
<body>
    <title>Détail de la propriété</title>
    <!-- <h2>Bienvenue <?php echo $user['first_name'] . ' ' . $user['name']; ?></h2> -->

    <section>
        <?php echo "<a href='./dashboard.php?properties_name=$propertyname"."&id=$id'></a>"; ?>
        <div class="page-actions">
                <form action="" method="POST">
                    <input type="hidden" name="properties_id" value="<?= $id ?>">

                </form>
        </div>
            </div>

                <p class="page-category"><?=$propertyname ?></p>
                <p class="page-bio"><?= $propertyposition ?></p>
                <p class="page-bio"><?= $propertycapacity ?></p>
                <p class="page-bio"><?= $propertyprice ?></p>
                <p class="page-bio"><?= $propertycaracteristic ?></p>
                <p class="page-bio"><?= $propertycategory ?></p>

             </div>

    </section>
    
    <?php
    if (isset($message)) {
        echo "<p>$message</p>";
    }
    ?>

    <form action="reservation.php" method="POST">
        <input type="hidden" name="property_id" value="<?= $id ?>">

        <label for="start_date">Date de début :</label>
        <input type="date" name="starts_at" id="start_date" required>
        <br>

        <label for="end_date">Date de fin :</label>
        <input type="date" name="ends_at" id="end_date" required>
        <br>
    

    <label for="passenger">Nombre de voyageurs :</label>
<div class="passenger-container">
    <div class="passenger-inputs">
        <button type="button" onclick="decrementPassenger()">-</button>
        <input type="number" name="passenger" id="passenger" value="1" min="0" required>
        <button type="button" onclick="incrementPassenger()">+</button>
</div>

        <script>
        function incrementPassenger() {
        var passengerInput = document.getElementById("passenger");
        var currentValue = parseInt(passengerInput.value);
        passengerInput.value = currentValue + 1;
    }

    function decrementPassenger() {
        var passengerInput = document.getElementById("passenger");
        var currentValue = parseInt(passengerInput.value);
        if (currentValue > 0) {
            passengerInput.value = currentValue - 1;
        }
    }

    </script>
  
        <label for="option">Option :</label>
        <select name="option" id="option" required>
        <option value="ElitehomesPASS">ElitehomesPASS</option>
        <option value="ElitehomesESSENTIEL">ElitehomesESSENTIEL</option>
        <option value="ElitehomesVIP">ElitehomesVIP</option>
        </select>
        <br>

        <input type="submit" value="Réserver" >
    </form>
    
    <button onclick="goBack()">Retour</button>

    <script>
        function goBack() {
            history.back();
        }
    </script>

</body>
</html>
