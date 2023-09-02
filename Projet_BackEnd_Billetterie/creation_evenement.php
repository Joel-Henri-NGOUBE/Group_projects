<?php
// Connexion à la base de données

$nom_bdd = "oui";
$utilisateur = "root";
$mot_de_passe = "";

try {
    $pdo = new PDO("mysql:host=localhost; dbname=$nom_bdd", $utilisateur, $mot_de_passe);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Erreur de connexion à la base de données: " . $e->getMessage();
    exit();
}

// Récupération des données du formulaire
$nom = $_POST['nom'];
$description = $_POST['description'];
$date_debut = $_POST['date_debut'];
$date_fin = $_POST['date_fin'];
$statut = $_POST['statut'];

// Préparation de la requête SQL pour insérer un enregistrement dans la table 'evenements'
$sql = "INSERT INTO evenements (nom, description, date_debut, date_fin, statut) VALUES (:nom, :description, :date_debut, :date_fin, :statut)";
$requete = $pdo->prepare($sql);

// Exécution de la requête SQL avec les paramètres correspondants
$requete->execute(array(
    ':nom' => $nom,
    ':description' => $description,
    ':date_debut' => $date_debut,
    ':date_fin' => $date_fin,
    'statut' => $statut
));
$sql = 'SELECT * FROM evenements';
$requete = $pdo->query($sql);

header("Location: gestion_evenements.php");
exit();