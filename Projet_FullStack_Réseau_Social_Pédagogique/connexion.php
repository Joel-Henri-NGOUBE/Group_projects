<?php
require "vendor/autoload.php";
use GuzzleHttp\Client;
    
    session_start();
    if ((isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)){
        header("Location: Accueil.php");
        exit();
     }
    
    $methode2 = filter_input(INPUT_SERVER,"REQUEST_METHOD");
    if($methode2 == "POST"){
    $username2 = FILTER_INPUT(INPUT_POST,"username");
    $password2 = FILTER_INPUT(INPUT_POST,"password");
    $email = FILTER_INPUT(INPUT_POST,"email",FILTER_VALIDATE_EMAIL);
    $email2 = FILTER_INPUT(INPUT_POST,"email");

if (!$email && $email2){
    $email = "Vide";
}
    // $data2 = "{'username': $username2, 'password': $password2}";
    $data2 = ["username" => "$username2", "password" => "$password2", "email" => "$email"];
    $data2 = json_encode($data2);

     
    $client2 = new GuzzleHttp\Client();
    $res2 = $client2->request('POST', 'http://localhost:80/Projet_FullStack/connexionServeur.php',
    ["form_params" => ["body" => $data2]]);

    $body = $res2->getBody();
    
    $body = json_decode($body,true);
//    var_dump($body);

    if ($body["Statut"] == "Succès"){
        $_SESSION["loggedin"] = true;
        $_SESSION["id"] = $body["Message"];
        header("Location: profil.php");
    }
    else if ($body["Statut"] == "Erreur"){
        if ($body["Message"] == "Nom d'utilisateur déjà attribué"){
            http_response_code(401);
            ?> <div> <p> <?php echo $body["Message"];  ?> </div></p> <?php
        }
        else if ($body["Message"] == "Adresse mail incorrecte"){
            http_response_code(401);
            ?> <div> <p> <?php echo $body["Message"];  ?> </div></p> <?php
        }
        else if ($body["Message"] == "Un ou plusieurs champs vides"){
            http_response_code(401);
            ?> <div> <p> <?php echo $body["Message"];  ?> </div></p> <?php
        }
        else if($body["Message"] == "Identifiants incorrects"){
            ?> <div> <p> <?php echo $body["Message"];  ?> </div></p> <?php
        }
        else if($body["Message"] == "JSON incorrect"){
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
<form method="POST" >
        <label for="username">Nom d'utilisateur</label>
        <input type="text" name="username" id="username">
        <label for="password">Mot de Passe</label>
        <input type="password" name="password" id="password">
        <label for="email">Adresse mail</label>
        <input type="email" name="email" id="email">
<input type="submit" value = "Se connecter">
</form>
</body>
<script>
    fetch("jeton.json")
    .then((result) => {
        result = result.json()
    })
    .then((result) => {
        if (!result.jeton){
           result.jeton = "0"
        }
    })
</script>
</html>