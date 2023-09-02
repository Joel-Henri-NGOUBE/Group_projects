<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Modification de l'événement sélectionné</title>
</head>
<body>
    <h1>Modification de l'événement sélectionné</h1>
    <?php
    $nom_bdd = 'mysql:host=localhost;dbname=oui;charset=utf8';
    $utilisateur = 'root';
    $mot_de_passe = '';

    try {
        $bdd = new PDO($nom_bdd, $utilisateur, $mot_de_passe);
    } catch (PDOException $e) {
        echo 'Connexion échouée : ' . $e->getMessage();
    }  
    $id_evenement = isset($_POST['id_evenement']) ? $_POST['id_evenement'] : '';
    
    $query = "SELECT * FROM evenements WHERE id = :id";
    $requete = $bdd->prepare($query);
    $requete->bindParam(':id', $id_evenement);
    $requete->execute();
    $resultat = $requete->fetch(PDO::FETCH_ASSOC);


    if ($id_evenement != '') {

        $query = "SELECT * FROM evenements WHERE id = :id";
        $requete = $bdd->prepare($query);
        $requete->bindParam(':id', $id_evenement);
        $requete->execute();
        $result = $requete->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            echo '<form action="traitement_modification_evenement.php" method="post">';
            echo '<input type="hidden" name="id_evenement" value="' . htmlspecialchars($result['id']) . '">';
            echo '<label for="nom">Nom :</label>';
            echo '<input type="text" name="nom" id="nom" value="' . htmlspecialchars($result['nom']) . '"><br>';
            echo '<label for="description">Description :</label>';
            echo '<textarea name="description" id="description">' . htmlspecialchars($result['description']) . '</textarea><br>';
            echo '<label for="date_debut">Date de début :</label>';
            echo '<input type="datetime-local" name="date_debut" id="date_debut" value="' . htmlspecialchars(date('Y-m-d\TH:i', strtotime($result['date_debut']))) . '"><br>';
            echo '<label for="date_fin">Date de fin :</label>';
            echo '<input type="datetime-local" name="date_fin" id="date_fin" value="' . htmlspecialchars(date('Y-m-d\TH:i', strtotime($result['date_fin']))) . '"><br>';
            echo '<input type="submit" value="Modifier">';
            echo '</form>';
        } else {
            echo 'L\'événement sélectionné n\'existe pas.';
        }
    } else {
        echo 'Aucun événement sélectionné.';
    }
    ?>
</body>
</html>