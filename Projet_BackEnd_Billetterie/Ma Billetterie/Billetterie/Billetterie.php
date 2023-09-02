<?php 
session_start();
if ( $_SESSION["loggedinticket"] == true && isset($_SESSION["loggedinticket"])){
    ?>
    <h1>Vous êtes connecté à la billetterie</h1>
    <a href="./ticketinglogout.php">Se déconnecter</a>
    <?php
}
else {
    header("Location: ticketinglogin.php");
}
?>