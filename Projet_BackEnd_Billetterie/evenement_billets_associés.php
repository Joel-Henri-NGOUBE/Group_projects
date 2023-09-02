<?php
$bdd = new PDO('mysql:host=localhost;dbname=oui', 'root', '');

$query = "SELECT * FROM evenements";
$requete = $bdd->query($query);
$evenements = $requete->fetchAll(PDO::FETCH_ASSOC);

foreach ($evenements as $evenement) {
    echo '<h2>' . htmlspecialchars($evenement['nom']) . '</h2>';

        $query = "SELECT evenements.nom AS nom_evenement, evenements.date_evenement, billets.nom AS nom_billet";
        $requetes = $bdd->prepare($query);
        $requetes->bindParam(':nom', $nom);
        $requetes->execute();
        $resultats = $requetes->fetchAll(PDO::FETCH_ASSOC);

    if ($resultats) {
        echo '<h1>Événement et billets associés :</h1>';
        echo '<h2>' . htmlspecialchars($resultats[0]['nom_evenement']) . '</h2>';
        echo '<table>';
        echo '<thead><tr><th>Nom du billet</th></thead>';
        echo '<tbody>';
        foreach ($resultats as $resultat) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($resultat['nom_billet']) . '</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    } else {
        echo 'Aucun résultat trouvé.';
    }
}
?>
