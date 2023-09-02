<?php

// Configuration de la connexion à la base de données
$host = 'localhost'; // Hôte de la base de données
$dbname = ''; // Nom de la base de données à créer
$user = 'root'; // Nom d'utilisateur pour se connecter
$pass = ''; // Mot de passe de l'utilisateur

// Connexion à la base de données MySQL
try {
    $pdo = new PDO("mysql:host=$host", $user, $pass);
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage() . "<br/>";
    die();
}

// Création de la base de données "oui"
$sql = "CREATE DATABASE IF NOT EXISTS oui;";
if ($pdo->exec($sql) !== false) {
    echo "création de la bdd reussi";
} else {
    echo "Erreur lors de la création de la bdd ";
}
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

$sql = "CREATE TABLE IF NOT EXISTS oui.billets (
        id INT(11) NOT NULL AUTO_INCREMENT,
        nom_prenom VARCHAR(255) NOT NULL,
        nom_evenement VARCHAR(255) NOT NULL,
        date_evenement DATE NOT NULL,
        date_creation_billet TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        code_public VARCHAR(30) NOT NULL,
        code_prive VARCHAR(10) NOT NULL,
        PRIMARY KEY (id),
        UNIQUE KEY (code_public)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        
if ($pdo->exec($sql) !== false) {
    echo "création des tables reussi";
} else {
    echo "Erreur lors de la créationdes tables ";
}   
$sql = "CREATE TABLE IF NOT EXISTS oui.evenements (
    id INT NOT NULL AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    date_debut DATE NOT NULL,
    date_fin DATE NOT NULL,
    PRIMARY KEY (id));";
if ($pdo->exec($sql) !== false) {
echo "création des tables reussi";
} else {
echo "Erreur lors de la créationdes tables ";
}

// Fermeture de la connexion à la base de données
$pdo = null;

?>
