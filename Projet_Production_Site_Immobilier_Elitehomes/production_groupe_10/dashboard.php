<?php
session_start();

// Vérifier si l'utilisateur est connecté
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

 $propertyname = isset($propertydata['name']) ? $propertydata['name'] : '';
$propertyposition = isset($propertydata['position']) ? $propertydata['position'] : '';
$propertycapacity = isset($propertydata['capacity']) ? $propertydata['capacity'] : '';
$propertyprice = isset($propertydata['price']) ? $propertydata['price'] : '';
$propertycaracteristic = isset($propertydata['caracteristique']) ? $propertydata['caracteristique'] : '';
$propertycategory = isset($propertydata['category']) ? $propertydata['category'] : '';


// Récupérer les informations de l'utilisateur connecté
$query = "SELECT * FROM users WHERE id = :userId";
$requete = $pdo->prepare($query);
$requete->bindParam(':userId', $userId);
$requete->execute();
$user = $requete->fetch(PDO::FETCH_ASSOC);

// Vérifier si l'utilisateur existe
if (!$user) {
    header("Location: connexion.php");
    exit();
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Logement</title>
    <link rel="stylesheet" href="./css/dashboard.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/style.css">
</head>
<style>
    :root{
    --sable: #C9A769;
    --blanccasse: #F5EFE0;
    --marron: #704E2E;
    --noir: #000000
    }
    body{
        margin: 0;
    }
    
    .avis{
        /* box-sizing: border-box; */
        display: flex;
        flex-direction: column;
        width: 300px;
        background-color: var(--sable);
        border-radius: 20px;
        padding: 15px;
        /* outline: 5px solid; */
        /* outline-color: var(--blanccasse); */
        color: #FFF;
        box-shadow: 10px 10px 25px var(--marron);
        margin: 10px;
    }
    
    .allviews{
        width: 100vw;
        box-sizing: border-box;
        display: flex;
        flex-direction: row;
        justify-content: space-around;
        background-color: #C9A769;
        padding: 20px;
        /* box-shadow: 5px; */
    }
    p{
    margin: 0;
    }
    .date{
        padding-bottom: 15px;
        font-size: 0.8em;
        text-decoration: underline;
        color: #FFF;
        /* font-weight: bold; */
    }
    .nom{
        font-size: 1.1em;
        color: white;
        color: var(--marron);
        /* font-weight: bold; */
    }
    .titre{
        width: 100vw;
        height: 25px;
        padding: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: var(--sable);
        color: var(--marron);
        /* box-sizing: border-box; */
        /* text-decoration: underline; */
        font-size: 1.5em;
        font-weight: bold;
    }
    @media screen and (max-width: 800px) {
       .allviews{
        /* box-sizing: border-box; */
        width: 100vw;
        display: flex;
        flex-flow: column wrap;
        align-items: center;
        justify-content: space-around;
        /* justify-items: space-around; */
        background-color: #C9A769;
        padding: 20px;
        /* box-shadow: 5px; */
       }
       .avis{
        /* box-sizing: border-box; */
        display: flex;
        flex-direction: column;
        width: 350px;
        background-color: var(--sable);
        border-radius: 20px;
        padding: 15px;
        /* outline: 5px solid; */
        /* outline-color: var(--blanccasse); */
        /* border: 10px solid;
        border-color: var(--sable); */
        color: #FFF;
        box-shadow: 10px 10px 25px var(--marron);
        margin: 20px;
    }
    }
    </style>
<body>
 <?php include 'header.php'; ?>
    <title>Détail de la propriété</title>
    <div class="property-info">
        <!-- <h2>Bienvenue <?php echo $user['first_name'] . ' ' . $user['name']; ?></h2> -->
        <?php echo "<a href='./dashboard.php?properties_name=$propertyname"."&id=$id'></a>"; ?>
        <div class="page-actions">
                <form action="" method="POST">
                    <input type="hidden" name="properties_id" value="<?= $id ?>">

                </form>
    </div>
    <section>
            </div>
<div class="info-logement">
                <h3 class="page-category"><?=$propertyname ?></h3>
                <p class="page-bio"><?= $propertyposition ?></p>
                <p class="page-bio"><?= $propertycapacity ?></p>
                <p class="page-bio"><?= $propertyprice ?></p>
                <p class="page-bio"><?= $propertycaracteristic ?></p>
                <p class="page-bio"><?= $propertycategory ?></p>
                </div>
             </div>



    </section>
    
    <?php
    if (isset($message)) {
        echo "<p>$message</p>";
    }
    ?>

        <form class="reservation-form" action="reservation.php" method="POST">
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

        <input type="submit" value="Réserver">
    </form>
    <a href='./pageaccueil.php'>Retour à l'acceuil</a>

    <?php $request = $pdo->prepare("SELECT views.*,users.name FROM views INNER JOIN users ON views.users_id = users.id WHERE properties_id = :id_prop ORDER BY evidence DESC LIMIT 3");
    $request->execute([
        ":id_prop" => $id
    ]);
    $response = $request->fetchAll(PDO::FETCH_ASSOC); 
    // var_dump($response);
    if($response){
    ?>
    <div class="titre"><p> AVIS </p></div>
    <div class="allviews"> <?php
    foreach($response as $avis){
    ?>
    <div class="avis">
       <p class="nom"><?= $avis["name"] ?></p>
       <p class="date"><?= $avis["creation_date"] ?></p>
       <p class="content"><?= $avis["content"] ?></p> 
    </div>
    <?php }
    } ?>
    </div>

 <?php include 'footer.php'; ?>
</body>
</html>





