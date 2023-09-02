<?php
session_start();
$_SESSION ['save_page']  =5 ; 
?>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "elitehomes";

$id = isset($_GET['id']) ? $_GET['id'] : null;

$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Nos témoignages</title>
    <link rel="stylesheet" href="./css/header.css">
     <link rel="stylesheet" href="./css/footer.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./css/testimonial.css" />
  </head>
  <!-- <header><?php include 'header.php'; ?></header> -->
  <body>
    <section class="testimonial"> 
    <div class="wrapper">
      <div class="testimonial-container" id="testimonial-container"></div>
      <button id="prev">&lt;</button>
      <button id="next">&gt;</button>
    </div>
    </section>
    <script src="testimonial.js"></script>
    <a href="pageaccueil.php">Retour à l'accueil</a>
  </body>
  <!-- <footer>
  <?php include 'footer.php'; ?>
  </footer> -->
  
</html>
