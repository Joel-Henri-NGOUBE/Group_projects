<?php 
require "vendor/autoload.php";
use GuzzleHttp\Client;

$methode = filter_input(INPUT_SERVER,"REQUEST_METHOD");

if($methode == "POST"){
$username = FILTER_INPUT(INPUT_POST,"username");
$password = password_hash(FILTER_INPUT(INPUT_POST,"password"),PASSWORD_DEFAULT);
$email = FILTER_INPUT(INPUT_POST,"email",FILTER_VALIDATE_EMAIL);
$email2 = FILTER_INPUT(INPUT_POST,"email");
// echo $email;
// echo $email2;
if (!$email && $email2){
    $email = "Vide";
}
// echo $email;
$data = ["username" => "$username", "password" => "$password", "email" => "$email"];
$data = json_encode($data);

$client = new GuzzleHttp\Client();
$res = $client->request('POST', 'http://localhost:80/Projet_FullStack/inscriptionServeur.php',
["form_params" => ["body" => $data]]);

$json2 = $res->getBody();

$json2 = json_decode($json2,true);
//var_dump($json2);

if ($json2["Statut"] == "Succès"){
    header("Location: connexion.php");
}
else if ($json2["Statut"] == "Erreur"){
    if ($json2["Message"] == "Nom d'utilisateur déjà attribué"){
        http_response_code(401);
        ?> <div> <p> <?php echo $json2["Message"];  ?> </div></p> <?php
    }
    else if ($json2["Message"] == "Adresse mail incorrecte"){
        http_response_code(401);
        ?> <div> <p> <?php echo $json2["Message"];  ?> </div></p> <?php
    }
    else if ($json2["Message"] == "Un ou plusieurs champs vides"){
        http_response_code(401);
        ?> <div> <p> <?php echo $json2["Message"];  ?> </div></p> <?php
    }
    else{
        http_response_code(400);
       ?> <div> <p> <?php echo "Erreur Système"; ?> </p> <?php
    }
}
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method="POST">
        <label for="username">Nom d'utilisateur</label>
        <input type="text" name="username" id="username">
        <br>
        <label for="password">Mot de Passe</label>
        <input type="password" name="password" id="password">
        <br>
        <label for="email">Adresse Mail</label>
        <input type="type" name="email" id="email">
        <br>
        <a href="./connexion.php">deja inscrit ? connectez-vous</a>
        <input type="submit" value = "Se connecter">
</form>
</body>
</html>