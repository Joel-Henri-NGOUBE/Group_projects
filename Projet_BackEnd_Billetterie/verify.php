<?php
require "vendor/autoload.php";
use GuzzleHttp\Client;

$data = FILTER_INPUT(INPUT_POST,"body");

$client = new GuzzleHttp\Client;
$res = $client->request('POST', 'http://localhost:80/backend/verifyServer.php',
["form_params" => ["body" => $data]]);

echo $res->getBody();
?>