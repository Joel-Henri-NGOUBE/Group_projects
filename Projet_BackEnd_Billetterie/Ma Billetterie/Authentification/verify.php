<?php
// require "vendor/autoload.php";
// use GuzzleHttp\Client;
// http://localhost:80/exercices-syntaxe1/Log/verifyServer.php

$methode = FILTER_INPUT(INPUT_SERVER,"REQUEST_METHOD");
if ($methode == "GET"){
    header("Location: login.php");
}

require "../Composer_packages/guzzle.php";
$data = FILTER_INPUT(INPUT_POST,"body");

$client = new GuzzleHttp\Client;
$res = $client->request('POST', 'http://localhost:80/Authentification/Server/verifyServer.php',
["form_params" => ["body" => $data]]);

echo $res->getBody();
?>