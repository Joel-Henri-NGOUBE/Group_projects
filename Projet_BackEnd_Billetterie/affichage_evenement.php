<!DOCTYPE html>
<html>
<head>
    <title>Affichage des evenements</title>
</head>
<body>
    <h1>evenements</h1>
    <?php       
    
    $nom_bdd = 'mysql:host=localhost;dbname=oui;charset=utf8';
    $utilisateur = 'root';
    $mot_de_passe = '';
try {
    $pdo = new PDO($nom_bdd, $utilisateur, $mot_de_passe);
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
    exit;
}


$sql = 'SELECT * FROM evenements';
$requete = $pdo->query($sql);
$evenements = $requete->fetchAll(PDO::FETCH_ASSOC);

echo '<table>';
echo "<thead><tr><th>ID</th><th>Nom </th><th>Evenement</th><th>Date de l'evenement </th></tr></thead>";
echo '<tbody>';
foreach ($evenements as $evenement) {
    echo '<tr>';
    echo '<td>' . htmlspecialchars($evenement['id']) . '</td>';
    echo '<td>' . htmlspecialchars($evenement['nom']) . '</td>';
    echo '<td>' . htmlspecialchars($evenement['description']) . '</td>';
    echo '<td>' . htmlspecialchars($evenement['date_debut']) . '</td>';
    echo '<td>' . htmlspecialchars($evenement['date_fin']) . '</td>';
    echo '<td>' . htmlspecialchars($evenement['statut']) . '</td>';
    echo '</tr>';
}
echo '</tbody>';
echo '</table>';

?>
</body>
</html> 