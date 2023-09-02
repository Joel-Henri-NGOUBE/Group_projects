<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    header("Location: connexion.php");
    exit();
}

// Récupérer l'ID de l'utilisateur connecté
$userId = $_SESSION['id'];

// Connexion à la base de données
$nom_bdd = 'elitehomes';
$admin = 'root';
$mdp = '';

try {
    $pdo = new PDO("mysql:host=localhost;dbname=$nom_bdd", $admin, $mdp);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
    exit();
}

// Récupérer les informations de l'utilisateur connecté
$query = "SELECT * FROM users WHERE id = :userId";
$requete = $pdo->prepare($query);
$requete->bindParam(':userId', $userId);
$requete->execute();
$user = $requete->fetch(PDO::FETCH_ASSOC);

// Vérifier si l'utilisateur existe
if (!$user) {
    header("Location: connexion.php");
    exit();
}

// Récupérer les réservations existantes dans la base de données
$reservationsQuery = "SELECT id FROM reservations ";
$reservations = $pdo->query($reservationsQuery)->fetchAll(PDO::FETCH_COLUMN);

$propertiesQuery = "SELECT id, name FROM properties";
$properties = $pdo->query($propertiesQuery)->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html>
<head>
     <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Ajouter une action d'entretien</title>
    <link rel="stylesheet" href="./css/entretien.css">
     <link rel="stylesheet" href="./css/header.css">
     <link rel="stylesheet" href="./css/footer.css">

</head>
<body>
     <header>
  <nav>
    <ul class="navbar"> 
      <?php
      echo '<li><a href="pageaccueil.php">Accueil</a></li>';
      echo '<li><a href="pageaccueil.php" class="brand">ELITE HOMES</a></li>';
      if (isset($_SESSION['id'])) {
        echo '<li><a href="profil.php"><i class=\' bx bxs-user\' width="50px"></i></a></li>';
    } else {
        echo '<li><a href="connexion.php"><i class=\' bx bxs-user\' width="50px"></i></a></li>';
    }
    echo '</ul>';
  echo '</div>';
  
    echo '<ul class="pages">';
          if (isset($_SESSION['id'])){
           if (isset($_SESSION['roles']) && ($_SESSION['roles'] == "admin" || $_SESSION['roles'] == "superadmin")) {
              echo '<li><a href="administrateur.php">accueil administrateur</a></li>';
              echo '<li><a href="maintenance_check.php">maintenance</a></li>';
              echo '<li><a href="messagesadmin.php">messagerie</a></li>';
              echo '<li><a href="avisadmin.php">modération des avis</a></li>';
              echo '<li><a href="gestion_users.php">gestion des comptes</a></li>';
            
            } else if (isset($_SESSION['roles']) && $_SESSION['roles'] === "entretien") {

             echo '<li><a href="maintenance_check.php">maintenance</a></li>';
            }else{
              echo '<li><a href="page_boutique.php">Accéder a la boutique</a></li>';
              echo '<li><a href="story.php">Notre histoire</a></li>'; 
              echo "<li><a href='./search_1.php'>Rechercher</a></li>";
              echo '<li><a href="testimonial.php">temoignages</a></li>';
            }
            echo '<li><a href="profil.php">Profil</a>';
              echo '<li><a href="deconnexion.php">Déconnectez-vous!</a>';  
          } else {
             echo '<li><a href="page_boutique.php">Accéder a la boutique</a></li>';
              echo '<li><a href="story.php">Notre histoire</a></li>'; 
              echo "<li><a href='./search_1.php'>Rechercher</a></li>";
              echo '<li><a href="testimonial.php">temoignages</a></li>';
            echo '<li><a href="connexion.php">Connectez-vous!</a></li>';
            echo '<li><a href="inscription.php">Vous n\'avez pas de compte? inscrivez-vous!</a></li>';
          }
        
          ?>
    </ul>
  </nav>
</header>
    <h1>Ajouter une action d'entretien</h1>
    <form method="POST" action="maintenance_check.php">
        <label for="reservations_id">ID de réservation :</label>
        <select name="reservations_id" id="reservations_id">
            <?php foreach ($reservations as $reservation) { ?>
                <option value="<?php echo $reservation; ?>"><?php echo $reservation; ?></option>
            <?php } ?>
        </select><br>
       <label for="properties_id">Propriété :</label>
       <select name="properties_id" id="properties_id">
       <?php foreach ($properties as $property) { ?>
       <option value="<?php echo $property['id']; ?>"><?php echo $property['name']; ?></option>
       <?php } ?>
       </select><br><br>

      </select><br><br>

        </select><br><br>

        <label for="note">Note :</label>
        <textarea name="note" id="note"></textarea><br><br>

        <label for="cleaning">Nettoyage :</label>
        <input type="checkbox" name="cleaning" id="cleaning"><br><br>

        <label for="pressing">Repassage des draps :</label>
        <input type="checkbox" name="pressing" id="pressing"><br><br>

        <label for="verification">Vérification des équipements :</label>
       

        <input type="checkbox" name="verification" id="verification"><br><br>

        <label for="inventary">Inventaire des fournitures :</label>
        <input type="checkbox" name="inventary" id="inventary"><br><br>

        <label for="status">Statut :</label>
       <select name="status" id="status">
       <option value="Terminé" class="status-termine">Terminé</option>
      <option value="En cours" class="status-en-cours">En cours</option>
      <option value="À faire" class="status-a-faire">À faire</option>
</select><br><br>


        <label for="date">Date :</label>
        <input type="date" name="date" id="date"><br><br>

        <input type="submit" value="Ajouter">
    </form>
     <?php include 'footer.php'; ?>
</body>
</html>

