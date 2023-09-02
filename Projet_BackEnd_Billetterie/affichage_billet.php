<!DOCTYPE html>
<html>
<head>
    <title>Affichage des billets</title>
</head>
<body>
    <h1>Billets</h1>
    <?php 
    function generateQRCode($code) {
      }
      
   
    $nom_bdd = 'mysql:host=localhost;dbname=oui;charset=utf8';
    $utilisateur = 'root';
    $mot_de_passe = '';
try {
    $pdo = new PDO($nom_bdd, $utilisateur, $mot_de_passe);
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
    exit;
}

$sql = 'SELECT * FROM billets WHERE nom_prenom = :nom AND code_prive = :id_prive';
$requete = $pdo->prepare($sql);
$requete->execute(array(
    'nom' => $_POST['nom'],
    'id_prive' => $_POST['id_prive']
));
$billet = $requete->fetch(PDO::FETCH_ASSOC);

if ($billet) {
    
    echo '<h1>Billet trouvé :</h1>';
    echo '<p>Nom et prénom : ' . htmlspecialchars($billet['nom_prenom']) . '</p>';
    echo '<p>Événement : ' . htmlspecialchars($billet['nom_evenement']) . '</p>';
    echo '<p>Date de l\'événement : ' . htmlspecialchars($billet['date_evenement']) . '</p>';
    echo '<img src="' . htmlspecialchars(generateQRCode($billet['code_public'])) . '" alt="QR Code">';
} else {
    
    echo '<h1>Billet non trouvé</h1>';
    echo '<p>Veuillez vérifier les informations entrées et réessayer.</p>';
}
echo '</tbody>';
echo '</table>';

?>
</body>
</html> 