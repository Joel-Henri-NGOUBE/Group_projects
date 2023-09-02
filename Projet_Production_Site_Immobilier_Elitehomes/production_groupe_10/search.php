<?php
session_start();
$_SESSION ['save_page']  =3 ; 
?>


<!DOCTYPE html>
<html>
<head>
   <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Rechercher</title>
  <link rel="stylesheet" href="./css/search.css">
 <link rel="stylesheet" href="./css/footer.css">
  <link rel="stylesheet" href="./css/header.css">
  <link rel="stylesheet" href="./css/style.css">

</head>
<body>
   <?php include 'header.php'; ?>
  <section id="search">
    <form method="GET">
      <select name="destination" id="destination">
        <option value="1"<?php if(isset($_GET['destination']) && $_GET['destination'] == '1ER') echo ' selected'; ?>>1ER ARRONDISSEMENT</option>
        <option value="2"<?php if(isset($_GET['destination']) && $_GET['destination'] == '2') echo ' selected'; ?>>2EME ARRONDISSEMENT</option>
        <option value="3"<?php if(isset($_GET['destination']) && $_GET['destination'] == '3') echo ' selected'; ?>>3EME ARRONDISSEMENT</option>
        <option value="4"<?php if(isset($_GET['destination']) && $_GET['destination'] == '4') echo ' selected'; ?>>4EME ARRONDISSEMENT</option>
        <option value="5"<?php if(isset($_GET['destination']) && $_GET['destination'] == '5') echo ' selected'; ?>>5EME ARRONDISSEMENT</option>
        <option value="6"<?php if(isset($_GET['destination']) && $_GET['destination'] == '6') echo ' selected'; ?>>6EME ARRONDISSEMENT</option>
        <option value="7"<?php if(isset($_GET['destination']) && $_GET['destination'] == '7') echo ' selected'; ?>>7EME ARRONDISSEMENT</option>
        <option value="8"<?php if(isset($_GET['destination']) && $_GET['destination'] == '8') echo ' selected'; ?>>8EME ARRONDISSEMENT</option>
        <option value="9"<?php if(isset($_GET['destination']) && $_GET['destination'] == '9') echo ' selected'; ?>>9EME ARRONDISSEMENT</option>
        <option value="10"<?php if(isset($_GET['destination']) && $_GET['destination'] == '10') echo ' selected'; ?>>10EME ARRONDISSEMENT</option>
        <option value="11"<?php if(isset($_GET['destination']) && $_GET['destination'] == '11') echo ' selected'; ?>>11EME ARRONDISSEMENT</option>
        <option value="12"<?php if(isset($_GET['destination']) && $_GET['destination'] == '12') echo ' selected'; ?>>12EME ARRONDISSEMENT</option>
        <option value="13"<?php if(isset($_GET['destination']) && $_GET['destination'] == '13') echo ' selected'; ?>>13EME ARRONDISSEMENT</option>
        <option value="14"<?php if(isset($_GET['destination']) && $_GET['destination'] == '14') echo ' selected'; ?>>14EME ARRONDISSEMENT</option>
        <option value="15"<?php if(isset($_GET['destination']) && $_GET['destination'] == '15') echo ' selected'; ?>>15EME ARRONDISSEMENT</option>
        <option value="16"<?php if(isset($_GET['destination']) && $_GET['destination'] == '16') echo ' selected'; ?>>16EME ARRONDISSEMENT</option>
        <option value="17"<?php if(isset($_GET['destination']) && $_GET['destination'] == '17') echo ' selected'; ?>>17EME ARRONDISSEMENT</option>
        <option value="18"<?php if(isset($_GET['destination']) && $_GET['destination'] == '18') echo ' selected'; ?>>18EME ARRONDISSEMENT</option>
        <option value="19"<?php if(isset($_GET['destination']) && $_GET['destination'] == '19') echo ' selected'; ?>>19EME ARRONDISSEMENT</option>
        <option value="20"<?php if(isset($_GET['destination']) && $_GET['destination'] == '20') echo ' selected'; ?>>20EME ARRONDISSEMENT</option>
        <option value="SEINE-ET-MARNE"<?php if(isset($_GET['destination']) && $_GET['destination'] == 'SEINE-ET-MARNE') echo ' selected'; ?>>SEINE-ET-MARNE</option>
        <option value="NEUILLY-SUR-SEINE"<?php if(isset($_GET['destination']) && $_GET['destination'] == 'NEUILLY-SUR-SEINE') echo ' selected'; ?>>NEUILLY-SUR-SEINE</option>
      </select>
      </select>
      <input type="date" name="checkin" id="checkin" placeholder="Check-in" min="<?php echo date('Y-m-d' ); ?>" required>
      <input type="date" name="checkout" id="checkout" placeholder="Check-out" <?php if(!isset($_GET['checkin']) || empty($_GET['checkin'])) echo 'disabled'; ?> required>
<button type="submit">Rechercher</button>
</form>
</section>
<script>
  var checkinInput = document.getElementById('checkin');
  var checkoutInput = document.getElementById('checkout');
  <?php if(isset($_GET['checkin']) && !empty($_GET['checkin'])): ?>
    checkinInput.value = '';
    checkoutInput.disabled = true;
  <?php endif; ?>
  checkinInput.addEventListener('change', function() {
    var checkinDate = new Date(this.value);
    var minCheckoutDate = new Date(checkinDate.getTime() + (24 * 60 * 60 * 1000));
    var formattedMinCheckoutDate = minCheckoutDate.toISOString().split('T')[0];
    checkoutInput.min = formattedMinCheckoutDate;
    checkoutInput.disabled = false;
  });
</script>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "elitehomes";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['destination'])) {
        $destination = $_GET['destination'];
        $sql = "SELECT * FROM properties WHERE district = :destination";
        $requete = $pdo->prepare($sql);
        $requete->bindParam(':destination', $destination);
        $requete->execute();

        if ($requete->rowCount() > 0) {
            while ($row = $requete->fetch(PDO::FETCH_ASSOC)) {
                echo $row['name'] . '</p>';
                echo $row['capacity'] . ' Personnes</p>';
                echo $row['price'] . ' €</p>';
                echo '<a href="details.php?id=' . $row['id'] . '">En savoir plus</a>';
                echo '<hr>';
            }
        } else {
            echo "Aucun appartement disponible à cette destination.";
        }
    }
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>
<a href='pageaccueil.php'>Retour à l'acceuil</a>
  </div>

   <?php include 'footer.php'; ?>
</body>
</html>
</body>
</html>

