<?php 
// require "vendor/autoload.php";
// use GuzzleHttp\Client;
// http://localhost:80/exercices-syntaxe1/Log/logout.php

$methode = FILTER_INPUT(INPUT_SERVER,"REQUEST_METHOD");
if ($methode == "GET"){
    header("Location: ticketinglogin.php");
    exit();
}
require "../Composer_packages/guzzle.php";

$client = new GuzzleHttp\Client;
$cookie = FILTER_INPUT(INPUT_COOKIE,"Jeton");

$data = ["Jeton" => $cookie, "Origin" => "Ticketing"];
json_encode($data);

$res = $client->request('POST', 'http://localhost:80/Authentification/logout.php',
["form_params" => ["body" => $data]]);

$response= $res->getBody();
$response = json_decode($response,true);

if ($response["Statut"] == "Succès"){
    session_start();
    session_destroy();
    header("Location: ticketinglogin.php");
}
?>