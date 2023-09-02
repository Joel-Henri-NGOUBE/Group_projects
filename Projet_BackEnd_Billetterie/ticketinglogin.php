<?php
session_start();
if ((isset($_SESSION["loggedinticket"]) && $_SESSION["loggedinticket"] = true)){
    header("Location: Billetterie.php");
    exit();
 }
$jeton = FILTER_INPUT(INPUT_COOKIE, "Jeton");
require "vendor/autoload.php";
use GuzzleHttp\Client;
$methode2 = filter_input(INPUT_SERVER,"REQUEST_METHOD");
if($methode2 == "POST"){
$username = FILTER_INPUT(INPUT_POST,"username");
$password = FILTER_INPUT(INPUT_POST,"password");
$data = ["username" => $username, "password" => $password ,"jeton" => $jeton];
$data = json_encode($data);

$client = new GuzzleHttp\Client;
$res = $client->request('POST', 'http://localhost:80/backend/verify.php',
["form_params" => ["body" => $data]]);

$response = $res->getBody();
$response = $response->getContents();
$response = json_decode($response,true);

echo $response["Statut"];

if ($response["Statut"] == "Succès"){
    // session_start();
    $_SESSION["loggedinticket"] = true;
    $_SESSION["chip"] = $jeton;
    header("Location: Billetterie.php");
}
else if ($response["Statut"] == "Erreur"){
    if ($response["Message"] == "Identifiants incorrects"){
        http_response_code(401);
        ?> <div><p> <?php echo $response["Message"]; ?> </p></div> <?php

    }
    else if ($response["Message"] == "JSON incorrect"){
        http_response_code(400);
        ?> <div> <p> <?php echo "Erreur Système"; ?> </p></div> <?php
    }
    else if ($response["Message"] == "Jeton inconnu"){
        http_response_code(401);
        ?> <div> <p> <?php echo "Veuillez vous connectez à l'espace d'authentification"; ?> </p></div> <?php
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
        <label for="password">Mot de Passe</label>
        <input type="password" name="password" id="password">

    <input type="submit" value = "Se connecter">
    </form>
</body>
</html>