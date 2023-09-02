<?php

// Générer un code privé unique
function Generation_code_prive($length) {
    $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $caracteres_length = strlen($caracteres);
    $code_priv = '';
    for ($i = 0; $i < $length; $i++) {
      $code_priv .= $caracteres[rand(0, $caracteres_length - 1)];
    }
    return $code_priv;
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

$nom_prenom = $_POST['nom_prenom'];
$nom_evenement = $_POST['nom_evenement'];
$date_evenement = $_POST['date_evenement'];
$date_creation_billet = date("Y-m-d H:i:s");
$code_public = bin2hex(random_bytes(30));
$code_prive = Generation_code_prive(6);

$sql = "INSERT INTO billets (nom_prenom, nom_evenement, date_evenement, date_creation_billet, code_public, code_prive) VALUES (:nom_prenom, :nom_evenement, :date_evenement, :date_creation_billet, :code_public, :code_prive)";
$requete = $pdo->prepare($sql);

$requete->execute(array(
    ':nom_prenom' => $nom_prenom,
    ':nom_evenement' => $nom_evenement,
    ':date_evenement' => $date_evenement,
    ':date_creation_billet' => $date_creation_billet,
    ':code_public' => $code_public,
    ':code_prive' => $code_prive
));

header("Location:accueil_gestion.php");
exit();
?>