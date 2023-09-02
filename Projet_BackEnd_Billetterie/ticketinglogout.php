<?php 
require "vendor/autoload.php";
use GuzzleHttp\Client;

$client = new GuzzleHttp\Client;
$cookie = FILTER_INPUT(INPUT_COOKIE,"Jeton");

$data = ["Jeton" => $cookie, "Origin" => "Ticketing"];
json_encode($data);

$res = $client->request('POST', 'http://localhost:80/backend/logout.php',
["form_params" => ["body" => $data]]);

$response= $res->getBody();
$response = json_decode($response,true);

if ($response["Statut"] = "Succès"){
    session_start();
    session_destroy();
    header("Location: ticketinglogin.php");
}
?>