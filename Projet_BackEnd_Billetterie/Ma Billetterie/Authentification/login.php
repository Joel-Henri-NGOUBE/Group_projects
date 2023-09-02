<?php
// require "vendor/autoload.php";
// use GuzzleHttp\Client;
// http://localhost:80/exercices-syntaxe1/Log/loginServer.php
    
    require "../Composer_packages/guzzle.php";
    session_start();
    if ((isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)){
        header("Location: dashboard.php");
        exit();
     }
    
    $methode2 = filter_input(INPUT_SERVER,"REQUEST_METHOD");
    if($methode2 == "POST"){
    $username2 = FILTER_INPUT(INPUT_POST,"username");
    $password2 = FILTER_INPUT(INPUT_POST,"password");
    // $data2 = "{'username': $username2, 'password': $password2}";
    $data2 = ["username" => "$username2", "password" => "$password2"];
    $data2 = json_encode($data2);

     
    $client2 = new GuzzleHttp\Client();
    $res2 = $client2->request('POST', 'http://localhost:80/Authentification/Server/loginServer.php',
    ["form_params" => ["body" => $data2]]);

    $body = $res2->getBody()->getContents();
    $body = json_decode($body,true);
    var_dump($body);
   

    if ($body["Statut"] == "Succès"){
        $_SESSION["loggedin"] = true;
        setcookie("Jeton",$body["Message"]);
        header("Location: dashboard.php");
    }
    else if ($body["Statut"] == "Erreur"){
        if ($body["Message"] == "Identifiants incorrects"){
            http_response_code(401);
           ?> <div><p> <?php echo $body["Message"]; ?> </p></div> <?php

        }
        else if ($body["Message"] == "JSON incorrect"){
            http_response_code(400);
            ?> <div> <p> <?php echo "Erreur Système"; ?> </p></div> <?php
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
<form method="POST" >
        <label for="username">Nom d'utilisateur</label>
        <input type="text" name="username" id="username">
        <label for="password">Mot de Passe</label>
        <input type="password" name="password" id="password">
<input type="submit" value = "Se connecter">
</form>
</body>
</html>