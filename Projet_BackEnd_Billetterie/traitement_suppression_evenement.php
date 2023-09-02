<?php
$id_evenement = isset($_POST['id_evenement']) ? $_POST['id_evenement'] : '';
$statut = isset($_POST['statut']) ? $_POST['statut'] : '';

if ($id_evenement == '' || $statut == '' ) {
    echo 'Tous les champs sont obligatoires.';
} else {
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=oui', 'root', '');
        $query = "UPDATE evenements SET statut = :statut WHERE id = :id";
        $requete = $bdd->prepare($query);
        $requete->bindParam(':id', $id_evenement);
        $requete->bindParam(':statut', $statut);
        $requete->execute();

        header('Location: gestion_evenements.php');
    } catch (PDOException $e) {
        echo 'Erreur : ' . $e->getMessage();
    }
}
?>