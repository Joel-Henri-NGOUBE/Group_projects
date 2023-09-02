<?php

$pdo = new PDO('mysql:host=localhost;dbname=oui;charset=utf8', 'root', '');


$sql = 'SELECT id, nom, description, date_debut, date_fin FROM evenements WHERE statut = "ouvert"';
$requete = $pdo->query($sql);
$evenements = $requete->fetchAll(PDO::FETCH_ASSOC);


echo '<table>';
echo '<thead><tr><th>ID</th><th>Nom</th><th>Description</th><th>Date de début</th><th>Date de fin</th></tr></thead>';
echo '<tbody>';
foreach ($evenements as $evenement) {
    echo '<tr>';
    echo '<td>' . htmlspecialchars($evenement['id']) . '</td>';
    echo '<td>' . htmlspecialchars($evenement['nom']) . '</td>';
    echo '<td>' . htmlspecialchars($evenement['description']) . '</td>';
    echo '<td>' . htmlspecialchars($evenement['date_debut']) . '</td>';
    echo '<td>' . htmlspecialchars($evenement['date_fin']) . '</td>';
    echo '</tr>';
}
echo '</tbody>';
echo '</table>';

?>
