<?php 
require "vendor/autoload.php";
use GuzzleHttp\Client;

$methode = filter_input(INPUT_SERVER,"REQUEST_METHOD");
echo $methode;
if($methode == "POST"){
$username = FILTER_INPUT(INPUT_POST,"username");
$password = password_hash(FILTER_INPUT(INPUT_POST,"password"),PASSWORD_DEFAULT);
// $password = "bonjour";
// $data = ["infos" => "{'username':$username,'password':$password}"];
$data = ["username" => "$username", "password" => "$password"];
$data = json_encode($data);
// $data10 = '{"username":"'.$username.'","password":"'. $password.'"}';
// $data10 = strval($data10);
// $data10 = "{'username':'$username','password':'$password'}";
// $data = json_encode($data);
// $data10 = "{'username':$username,'password':$password}";



// $data10 = json_encode($data10,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
// $data10 = str_replace("\\","",$data10);
// $data10 = json_decode($data10,true,200,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);



$client = new GuzzleHttp\Client();
$res = $client->request('POST', 'http://localhost:80/backend/signinServer.php',
["form_params" => ["body" => $data]]);

// $json = json_encode($res->getBody());
// $json = json_decode($json,true);
// echo $json["username"];
$json2 = $res->getBody()->getContents();
// $json2 = json_encode($json2);
// $json2 = json_decode($json2,true);
// echo $json2["Statut"];
// echo $json2;
// echo $json2["Statut"];
$json2 = json_decode($json2,true);
if ($json2["Statut"] == "Succès"){
    // echo $json2["Message"];
    header("Location: login.php");
}
else if ($json2["Statut"] == "Erreur"){
    if ($json2["Message"] == "Nom d'utilisateur déjà attribué"){
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
        <label for="password">Mot de Passe</label>
        <input type="password" name="password" id="password">
<input type="submit" value = "Se connecter">
</form>
</body>
</html>