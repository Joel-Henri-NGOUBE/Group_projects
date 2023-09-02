<?php
require "vendor/autoload.php";
use GuzzleHttp\Client;

$client1 = new GuzzleHttp\Client;
$data1 = FILTER_INPUT(INPUT_POST,"body"); // Ou isset

if ($data1){
    $res = $client1->request('GET', 'http://localhost:80/backend/logoutServer.php',
    ["form_params" => ["body" => $data1]]);

    $response = $res->getBody();
    echo $response;
    exit();
}

$client2 = new GuzzleHttp\Client;
$cookie = FILTER_INPUT(INPUT_COOKIE,"Jeton");
$data2 = ["Jeton" => $cookie];
$data2 = json_encode($data2);

$res = $client2->request('GET', 'http://localhost:80/backend/logoutServer.php',
["form_params" => ["body" => $data2]]);


$body = $res->getBody();

$body = json_decode($body,true);

if ($body["Statut"] = "Succès"){
session_start();
session_destroy();
header('Location: login.php');
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
</body>
</html>