<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="./css/style.css">
    <script src="script.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Header</title>
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
              echo '<li><a href="administrateur.php">Accueil administrateur</a></li>';
              echo '<li><a href="maintenance_check.php">Maintenance</a></li>';
              echo '<li><a href="dashboard_message.php">Messagerie</a></li>';
              echo '<li><a href="dashboard_avis.php">Modérer des avis</a></li>';
             echo '<li><a href="gestion_users.php">Gérer les comptes</a></li>';
             echo '<li><a href="dashboard_admin.php">Entretien</a></li>';

            } else if (isset($_SESSION['roles']) && $_SESSION['roles'] === "entretien") {

             echo '<li><a href="maintenance_check.php">Maintenance</a></li>';
             echo '<li><a href="dashboard_admin.php">Entretien</a></li>';
            }else{
              echo '<li><a href="story.php">Notre histoire</a></li>'; 
              echo "<li><a href='search.php'>Rechercher</a></li>";
              echo '<li><a href="arrondissement.php">Arrondissements</a></li>';
              echo '<li><a href="testimonial.php">Temoignages</a></li>';
              
              
            }
              echo'<li><a href="profil.php">Profil</a>';
              echo '<li><a href="deconnexion.php">Se déconnecter</a>';  
          } else {
            echo '<li><a href="story.php">Notre histoire</a></li>'; 
            echo "<li><a href='search.php'>Rechercher</a></li>";
            echo '<li><a href="arrondissement.php">Arrondissements</a></li>';
            echo '<li><a href="testimonial.php">Temoignages</a></li>';
            echo '<li><a href="connexion.php">Se connecter</a></li>';
            echo '<li><a href="inscription.php">S\'inscrire</a></li>';
          }
        
          ?>
    </ul>
  </nav>
</header>
</body>
</html>