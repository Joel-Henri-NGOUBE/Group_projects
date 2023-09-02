<?php 
$methode = FILTER_INPUT(INPUT_SERVER,"REQUEST_METHOD");
if ($methode == "GET"){
    header("Location: login.php");
}

$json = FILTER_INPUT(INPUT_POST,"body");
// header("Content-Type: application/json");
// echo $json;
// if ($json){
//     exit();
// }
// $json = file_get_contents("data.json");
// $json1 = json_encode($json1);
// $json = json_encode($json);
$json = json_decode($json,true);
// $json = json_decode($json, true);
// $json = json_encode($json);
// echo $json["username"];

// $json = json_decode($json, true);

// $json = $json["infos"];
// $json = json_encode($json);
// $json = json_decode($json, true);

// $json = json_decode($json, true);
// var_dump($json);
if (!array_key_exists("username",$json) || !array_key_exists("password",$json) || count(array_keys($json)) != 2){
    echo json_encode(["Statut" => "Erreur", "Message" => "JSON incorrect"]);
    exit();
}

$user= "root";
$pass = "";
$pdo = new PDO("mysql:host=localhost:3306;dbname=connexion", $user , $pass);

$notdouble = $pdo -> prepare("SELECT username FROM users WHERE username = :username");
$notdouble -> execute([
":username" => $json["username"]
]);
$result = $notdouble->fetch(PDO::FETCH_ASSOC);

if ($result){
    echo json_encode(["Statut" => "Erreur","Message" => "Nom d'utilisateur déjà attribué"]);
    exit();
}

$request2 = $pdo -> prepare("INSERT INTO users (username,password) VALUES(:username,:password)");
$request2 -> execute([
":username" => $json["username"],
":password" => $json["password"]
]);

echo json_encode((["Statut" => "Succès","Message" => "Bravo"]));
exit();















// $origin = filter_input(INPUT_POST, "origin");
// $json = filter_input(INPUT_POST, "javascriptON");
// //include "data.json";
// $json = json_decode($json,true);
// echo "$json+";
// echo "$username + $password + $json";
?>