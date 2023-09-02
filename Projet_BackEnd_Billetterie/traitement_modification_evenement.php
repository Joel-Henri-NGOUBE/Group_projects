<?php
$id_evenement = isset($_POST['id_evenement']) ? $_POST['id_evenement'] : '';
$nom = isset($_POST['nom']) ? $_POST['nom'] : '';
$description = isset($_POST['description']) ? $_POST['description'] : '';
$date_debut = isset($_POST['date_debut']) ? $_POST['date_debut'] : '';
$date_fin = isset($_POST['date_fin']) ? $_POST['date_fin'] : '';

if ($id_evenement == '' || $nom == '' || $description == '' || $date_debut == '' || $date_fin == '' ) {
    echo 'Tous les champs sont obligatoires.';
} else {
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=oui', 'root', '');

        $query = "UPDATE evenements SET nom = :nom, description = :description, date_debut = :date_debut, date_fin = :date_fin WHERE id = :id";
        $requete = $bdd->prepare($query);
        $requete->bindParam(':id', $id_evenement);
        $requete->bindParam(':nom', $nom);
        $requete->bindParam(':description', $description);
        $requete->bindParam(':date_debut', $date_debut);
        $requete->bindParam(':date_fin', $date_fin);

        $requete->execute();

        header('Location: evenements_actuel.php');
    } catch (PDOException $e) {
        echo 'Erreur : ' . $e->getMessage();
    }
}
?>
