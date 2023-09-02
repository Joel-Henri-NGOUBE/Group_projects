<?php
    session_start();

    if (!isset($_SESSION['id'])) {
        header("Location: connexion.php");
        exit();
    } 
    if ($_SESSION['roles'] != "admin" && $_SESSION['roles'] != "superadmin" ) {
        header("Location: pageaccueil.php");
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

    $sql = "SELECT * FROM properties";
    $requete = $pdo->prepare($sql);
    $requete->execute();
    $properties = $requete->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des propriétés</title>
    <link rel="stylesheet" href="liste_logement.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/footer.css">
     <link rel="stylesheet" href="./css/style.css">

</head>
<body>
    <h1>Liste des propriétés</h1>
    <div>
        <a href="ajouter_un_logement.php" class = 'test'> Ajouter un nouveau logement.</a> 
    </div>
    <section class = table-container>
        <table>
            <thread>
                <tr>
                    <th>Nom</th>
                    <th>Arrondissement</th>
                    <th>Capacité</th>
                    <th>Prix</th>
                    <th>Catégorie</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($properties as $property) : ?>
                <tr>
                    <td><?php echo $property['name']; ?></td>
                    <td><?php echo $property['district']; ?></td>
                    <td><?php echo $property['capacity']; ?></td>
                    <td><?php echo $property['price']; ?>€</td>
                    <td><?php echo $property['category']; ?></td>
                    <td>
                        <a href="modification_logement.php?property_id=<?php echo $property['id']; ?>">Modifier</a>
                        <a href="supression_logement.php?property_id=<?php echo $property['id']; ?>">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</body>
</html>