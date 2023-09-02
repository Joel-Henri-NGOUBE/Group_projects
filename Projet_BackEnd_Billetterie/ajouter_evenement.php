<?php

$nom_bdd = 'mysql:host=localhost;dbname=oui;charset=utf8';
$utilisateur = 'root';
$mot_de_passe = '';

try {
    $bdd = new PDO($nom_bdd, $utilisateur, $mot_de_passe);
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
}
if (isset($_POST['creer'])) {
    $nom = $_POST['nom'];
    $description = ['description'];
    $date_debut = $_POST['date_debut'];
    $date_fin = $_POST['date_fin'];
    $id = $_POST['id'];


    $requete = $bdd->prepare('INSERT INTO evenements (nom, description ,date_debut, date_fin) VALUES (:nom, :descrption, :date_debut, :date_fin)');
    $requete->bindParam(':nom', $nom);
    $requete->bindParam(':description', $description);
    $requete->bindParam(':date_debut', $date_debut);
    $requete->bindParam(':date_fin', $date_fin);
    $requete->bindParam(':statut', $statut);
    $requete->execute();
    echo 'L\'événement a bien été créé !';

}

$requete = $bdd->query('SELECT * FROM evenements');
$evenements = $requete->fetchAll();
?>
<form method="POST" action="creation_evenement.php">
    <label for="nom">Nom de l'événement :</label>
    <input type="text" name="nom" id="nom" required>
    
    <label for="description">description de l'événement :</label>
    <input type="text" name="description" id="description" required>
    
    <label for="date_debut">Date de debut de l'événement :</label>
    <input type="date" name="date_debut" id="date_debut" required>

    <label for="date_fin">Date de fin de l'événement :</label>
    <input type="date" name="date_fin" id="date_fin" required>

    <label for="statut">Statut:</label>
    <select name="statut" id="statut">
    <option value="ouvert">Ouvert</option>
    <option value="fini">Fini</option>
    <option value="annulé">Annulé</option>
    </select>

    <button type="submit">Ajouter</button>
</form>