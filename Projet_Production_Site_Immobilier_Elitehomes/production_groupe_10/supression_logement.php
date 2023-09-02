<?php
    session_start();

    if (!isset($_SESSION['id'])) {
        header("Location: connexion.php");
        exit();
    } 
    if (($_SESSION['roles'] !== "superadmin")) {
        header("Location: accueil.php");
        exit();
    }
$nom_bdd = 'elitehomes';
$admin = 'root';
$mdp = '';
try {
    $pdo = new PDO("mysql:host=localhost;dbname=$nom_bdd", $admin, $mdp);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
    exit();
}

if (isset($_GET['property_id'])) {
    $property_id = $_GET['property_id'];

    $sql = "SELECT * FROM properties WHERE id=:property_id";
    $requete = $pdo->prepare($sql);
    $requete->bindParam(':property_id', $property_id);
    $requete->execute();
    $property = $requete->fetch(PDO::FETCH_ASSOC);

    if (isset($_GET['confirm']) && $_GET['confirm'] == '1') {
        $sql = "DELETE FROM properties WHERE id=:property_id";
        $requete = $pdo->prepare($sql);
        $requete->bindParam(':property_id', $property_id);
        $requete->execute();

        header("Location: administrateur.php");
        exit();
    }
} else {
    header("Location: administrateur.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/footer.css">


    <title>Confirmation de suppression</title>
</head>
<body>
    <h1>Confirmation de suppression</h1>
    <p>Êtes-vous sûr de vouloir supprimer la propriété '<?php echo $property['name']; ?>' qui est a l'adresse '<?php echo $property['position']; ?>' ?</p>
    <form action="supression_logement.php" method="GET">
        <input type="hidden" name="property_id" value="<?php echo $property_id; ?>">
        <input type="hidden" name="confirm" value="1">
        <button type="submit">Confirmer la suppression</button>
        <a href="liste_logement.php">Annuler</a>
    </form>
</body>
</html>
