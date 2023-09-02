<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    session_start();
    if ($_SESSION["loggedin"] == true && isset($_SESSION["loggedin"])){
        ?>
       <h1>Vous êtes connecté</h1>
       <a href="./logout.php">Se déconnecter</a>
       <?php
    }
    else {
        header("Location: login.php");
    }
 ?>
</body>
</html>