<?php
// require "vendor/autoload.php";
// use GuzzleHttp\Client;
// http://localhost:80/exercices-syntaxe1/Log/logoutServer.php?body='.$data2

$methode = FILTER_INPUT(INPUT_SERVER,"REQUEST_METHOD");

if ($methode == "GET"){
    header("Location: login.php");
    exit();
}

require "../Composer_packages/guzzle.php";
$client1 = new GuzzleHttp\Client;
$data1 = FILTER_INPUT(INPUT_POST,"body"); // Ou isset
// echo $data1;

if ($data1){
    // $data1 = json_encode($data1);
    $res = $client1->request('GET', 'http://localhost:80/Authentification/Server/logoutServer.php?body='.$data1,
    ["form_params" => ["body" => $data1]]);

    $response = $res->getBody();
    echo $response;
    exit();
}

$client2 = new GuzzleHttp\Client;
$cookie = FILTER_INPUT(INPUT_COOKIE,"Jeton");
$data2 = ["Jeton" => $cookie];
$data2 = json_encode($data2);

$res = $client2->request('GET', 'http://localhost:80/Authentification/Server/logoutServer.php?body='.$data2,
["form_params" => ["body" => $data2]]);


$body = $res->getBody();

$body = json_decode($body,true);

if ($body["Statut"] == "Succès"){
// echo $body["Message"];
session_start();
session_destroy();
// echo $_SESSION["loggedin"];
header("Location: login.php");
exit();
}
?>
