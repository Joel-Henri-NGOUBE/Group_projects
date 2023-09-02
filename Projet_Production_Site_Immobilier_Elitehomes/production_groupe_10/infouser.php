<?php
session_start();

$pdo = new PDO("mysql:host=localhost:3306;dbname=elitehomes", "root", "");

function infoclient($pdo){
    // Récupérer les informations du client
    $userId = $_SESSION['id']; // l'ID du client actuel

    $recupinfoclient = $pdo->prepare("
    SELECT *
    FROM `users`
    WHERE id = :id

    ");

    $recupinfoclient->execute([
        ":id" => $userId

    ]);

    $datainfo = $recupinfoclient->fetch(PDO::FETCH_ASSOC);

    if ($datainfo) {
        echo "Nom : " . $datainfo["name"] . "<br>";
        echo "Prénom : " . $datainfo["first_name"] . "<br>";
        echo "Date de naissance : " . $datainfo["birthday"] . "<br>";
        echo "E-mail : " . $datainfo["mail"] . "<br>";
        // Afficher d'autres informations personnelles du client
    } else {
        echo "Client introuvable.";
    }
}

function showreservation($pdo){
// Récupérer les réservations passées et futures du client
    $userId = $_SESSION['id'];
    $recupresaclient = $pdo->prepare("
    SELECT * 
    FROM `reservations`
    WHERE users_id = :id
    ORDER BY 
    CASE 
        WHEN ends_at < CURDATE() THEN 1  -- Réservations passées
        WHEN starts_at <= CURDATE() AND ends_at >= CURDATE() THEN 2  -- Réservations en cours
        ELSE 3  -- Réservations futures
    END,
    starts_at ASC  -- Trier par date de début croissante
");


    $recupresaclient->execute([
        ":id" => $userId

    ]);

    $dataresa = $recupresaclient->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($dataresa)) {
        // Regrouper les réservations par statut
        $reservationsEnCours = array();
        $reservationsPassees = array();
        $reservationsFutures = array();

        foreach ($dataresa as $reservation) {
            if ($reservation["ends_at"] < date("Y-m-d")) {
                $reservationsPassees[] = $reservation;
            } elseif ($reservation["starts_at"] <= date("Y-m-d") && $reservation["ends_at"] >= date("Y-m-d")) {
                $reservationsEnCours[] = $reservation;
            } else {
                $reservationsFutures[] = $reservation;
            }
        }

        // Afficher les réservations par statut
        if (!empty($reservationsEnCours)) {
            echo '<div class="reservation-group">
                    <h3>Réservations en cours</h3>';
            foreach ($reservationsEnCours as $reservation) {
                echo '<div class="reservation">
                        Propriété : ' . $reservation["properties_name"] . '<br>
                        Date de début : ' . $reservation["starts_at"] . '<br>
                        Date de fin : ' . $reservation["ends_at"] . '<br>
                        Voyageur: ' . $reservation["passenger"] . '<br>
                        Option : ' . $reservation["option"] . '<br>
                        </div>';
            }
            echo '</div>';
            }


    if (!empty($reservationsPassees)) {
        echo '<div class="reservation-group">
                <h3>Réservations passées</h3>';
        foreach ($reservationsPassees as $reservation) {
            echo '<div class="reservation">
                    Propriété : ' . $reservation["properties_name"] . '<br>
                    Date de début : ' . $reservation["starts_at"] . '<br>
                    Date de fin : ' . $reservation["ends_at"] . '<br>
                    Voyageur: ' . $reservation["passenger"] . '<br>
                    Option : ' . $reservation["option"] . '<br>
                  </div>';
        }
        echo '</div>';
    }

    if (!empty($reservationsFutures)) {
        echo '<div class="reservation-group">
                <h3>Réservations futures</h3>';
        foreach ($reservationsFutures as $reservation) {
            echo '<div class="reservation">
                    Propriété : ' . $reservation["properties_name"] . '<br>
                    Date de début : ' . $reservation["starts_at"] . '<br>
                    Date de fin : ' . $reservation["ends_at"] . '<br>
                    Voyageur: ' . $reservation["passenger"] . '<br>
                    Option : ' . $reservation["option"] . '<br>
                  </div>';
        }
        echo '</div>';
    }
} else {
    echo "Aucune réservation trouvée.";
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informations client</title>
    <link rel="stylesheet" href="./css/info.css">
</head>

<h1>MES INFORMATIONS PERSONNELLES</h1>
<body>
    
        <?php
        echo infoclient($pdo);
        echo showreservation($pdo);
        echo "<a href='./listproprieties.php'>Retour à l'acceuil</a>";
         ?>
     



</body>
</html>