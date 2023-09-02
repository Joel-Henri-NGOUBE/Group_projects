<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>suppresssion de l'événement sélectionné</title>
</head>
<body>
    <h1>suppression de l'événement sélectionné</h1>
    <?php
// // Vérification de l'authentification de l'utilisateur
// session_start();
// if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
//     header('Location: login.php');
//     exit;
// }

    // Connexion à la base de données avec PDO
    $nom_bdd = 'mysql:host=localhost;dbname=oui;charset=utf8';
    $utilisateur = 'root';
    $mot_de_passe = '';

    try {
        $bdd = new PDO($nom_bdd, $utilisateur, $mot_de_passe);
    } catch (PDOException $e) {
        echo 'Connexion échouée : ' . $e->getMessage();
    }  
    // Récupération de l'id de l'événement sélectionné
    $id_evenement = isset($_POST['id_evenement']) ? $_POST['id_evenement'] : '';
    
    // Récupération des informations de l'événement sélectionné
    $query = "SELECT * FROM evenements WHERE id = :id";
    $requete = $bdd->prepare($query);
    $requete->bindParam(':id', $id_evenement);
    $requete->execute();
    $resultat = $requete->fetch(PDO::FETCH_ASSOC);


    if ($id_evenement != '') {
        // Récupération des informations de l'événement sélectionné
        $query = "SELECT * FROM evenements WHERE id = :id";
        $requete = $bdd->prepare($query);
        $requete->bindParam(':id', $id_evenement);
        $requete->execute();
        $result = $requete->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            // Affichage du formulaire de modification avec les informations de l'événement sélectionné
            echo '<form action="traitement_suppression_evenement.php" method="post">';
            echo '<input type="hidden" name="id_evenement" value="' . htmlspecialchars($result['id']) . '">';
            echo '<label for="statut">Statut:</label>
                <select name="statut" id="statut">
                <option value="annulé">Annulé</option>
                </select>';
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