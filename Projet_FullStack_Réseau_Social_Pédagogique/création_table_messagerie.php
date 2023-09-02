<?php

$host = "localhost";
$utilisateur = "root";
$mot_de_passe = "";

try {
    $pdo = new PDO("mysql:host=$host", $utilisateur, $mot_de_passe);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Création de la base de données "application"
    $sql = "CREATE DATABASE IF NOT EXISTS application";
    $pdo->exec($sql);

    echo "La base de données 'application' a été créée avec succès.";

} catch(PDOException $e) {
    echo "Erreur lors de la création de la base de données : " . $e->getMessage();
}

// Fermeture de la connexion à la base de données
$pdo = null;

$nom_bdd = "application";
$utilisateur = "root";
$mot_de_passe = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$nom_bdd", $utilisateur, $mot_de_passe);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Erreur de connexion à la base de données: " . $e->getMessage();
    exit();
}

$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    first_name text ,
    last_name text ,
    birth_date date ,
    profile_pic text ,
    banner text ,
    status ENUM('activé', 'désactivé') DEFAULT 'activé' NOT NULL
  )";
if ($pdo->query($sql) !== false) {
    echo "La table 'users' a été créée avec succès.";
}


$sql = "CREATE TABLE IF NOT EXISTS messagerie (
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_envoyeur INT NOT NULL,
  id_receveur INT NOT NULL,
  message TEXT NOT NULL,
  date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (id_envoyeur) REFERENCES users(id),
  FOREIGN KEY (id_receveur) REFERENCES users(id)
)";

if ($pdo->query($sql) !== false) {
    echo "La table 'messagerie' a été créée avec succès.";
}

$sql = "CREATE TABLE IF NOT EXISTS publications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_user int,
    title text,
    image text,
    type text,
    description text,
    date datetime not null default current_timestamp,
    discr int,
    likes int,
    emote1 int,
    emote2 int,
    emote3 int,
    comments int
  )";

if ($pdo->query($sql) !== false) {
    echo "La table 'publications' a été créée avec succès.";
}

$sql = "CREATE TABLE IF NOT EXISTS relationships (
    id INT,
    friend_id int
  )";

if ($pdo->query($sql) !== false) {
    echo "La table 'relationships' a été créée avec succès.";
}

$pdo = null;
?>
