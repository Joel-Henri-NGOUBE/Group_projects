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
                 <a href="messages.php?id='.$reservation["id"].'" role="link"><div><p>'."Envoyer un message".'</p></div></a>

                        </div>';
            }
            echo '</div>';
            echo '</br>';
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
                 <a href="avis.php?id_res='.$reservation["id"].'" role="link"><div><p>'."Donner votre avis".'</p></div></a>

                  </div>';
        }
        echo '</div>';
        echo '</br>';
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
                 <a href="messages.php?id='.$reservation["id"].'" role="link"><div><p>'."Envoyer un message".'</p></div></a>
                  </div>';
        }
        echo '</div>';
        echo '</br>';
        //if($_SESSION["roles"] == "client"){
        //  $request1 = $pdo->prepare("SELECT * FROM reservations WHERE users_id = :id AND starts_at > CURRENT_TIMESTAMP ORDER BY starts_at ASC ");
        //  $request1->execute([
         //     ":id" => $_SESSION["id"]
        //  ]);
        //  $response1 = $request1->fetchAll(PDO::FETCH_ASSOC);
         // if($response1){
          // foreach ($response1 as $reserve){
          // }
          // }
    }
} else {
    echo "Aucune réservation trouvée.";
}
}
//}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Votre profil</title>

    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
    <link rel="stylesheet" href="./css/profil.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
   <?php include 'header.php'; ?>
<section>
  <div class="profile_title">
    <div class="col-rt-12">
        <div class="profile_name">
          </div>
      </div>
  </div>
    <div class="profile_container">
          <div class="col-rt-12">
              <div class="content">
              
<div class="profile">
  <div class="container">
    <div class="row">
      <div class="col-lg-4">
        <div class="card">
          <div class="card-header bg-transparent text-center">
            <h3> <?php echo $_SESSION['first_name'] . " ". $_SESSION['name']; ?></h3>
          </div>
          <div class="card-body">
            <p class="mb-0"><strong class="pr-1">Nom:</strong><?php echo $_SESSION['name']; ?></p>
            <p class="mb-0"><strong class="pr-1">Prénom:</strong><?php echo $_SESSION['first_name']; ?></p>
            <p class="mb-0"><strong class="pr-1">Mail:</strong><?php echo $_SESSION['mail']; ?></p>
            <p class="mb-0"><strong class="pr-1">Telephone:</strong><?php echo $_SESSION['phone']; ?></p>
            <p class="mb-0"><strong class="pr-1">Genre:</strong><?php if ($_SESSION['gender'] == 'Male'){
              echo'H';
              } else {
              echo 'F';
              }
              ?></p>
            <p class="mb-0"><strong class="pr-1">Date de naissance:</strong> <?php echo $_SESSION['birthday']; ?></p>
            <div class="inputBx">
              <a href="modification_profil.php">Modifier le profil</a>
          </div>
          </div>
          
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card">
          <div class="card-header bg-transparent">
            <h3 class="mb-0"> Informations Générales</h3>
          </div>
          <div class="card-body">
            <table class="table">
              <tr>
                <th width="30%">Préférences alimentaires</th>
                <td width="2%">:</td>
                <td>Végétarien</td>
              </tr>
              <tr>
                <th width="30%">Activités et loisirs</th>
                <td width="2%">:</td>
                <td>Bateau, Tennis, Golf</td>
              </tr>
              <tr>
                <th width="30%">Préférences culturelles</th>
                <td width="2%">:</td>
                <td>Visite de musées</td>
              </tr>
              <tr>
                <th width="30%">Préférences de décoration</th>
                <td width="2%">:</td>
                <td>Style ancien</td>
              </tr>
              <tr>
                <th width="30%">Services favoris</th>
                <td width="2%">:</td>
                <td>Spa, Hammam, Salle de Sport</td>
              </tr>
            </table>
          </div>
        </div>
          <div style="height: 26px"></div>
        <div class="card">
          <div class="card-header bg-transparent">
            <h3 class="mb-0">Mes Réservations</h3>
          </div>
          <div class="card-body">

              <p><?php showreservation($pdo)?>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>    
    		</div>
		</div>
    </div>
</section>
  <a href='./pageaccueil.php' class="button">Retour à l'acceuil</a>

 <?php include 'footer.php'; ?>
	</body>
</html>