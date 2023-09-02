<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deconnexion</title>
</head>
<body>
<?php
session_start();
session_destroy();
echo '<p>Vous êtes deconnecté</p>';
echo '<br>';
echo '<a href="pageaccueil.php">Retouner à l\'accueil</a>';
?>
</body>
</html>