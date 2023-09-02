<?php 
$methode = FILTER_INPUT(INPUT_SERVER,"REQUEST_METHOD");
// if ($methode == "GET"){
//     header("Location: inscription.php");
// }
// $json = ["username" => "Jun", "password" => "Jun", "email" => ""];

$json = FILTER_INPUT(INPUT_POST,"body");

$json = json_decode($json,true);
// var_dump($json);

if (!array_key_exists("username",$json) || !array_key_exists("password",$json) || !array_key_exists("email",$json) || count(array_keys($json)) != 3){
    echo json_encode(["Statut" => "Erreur", "Message" => "JSON incorrect"]);
    exit();
}

if(!$json["email"] || !$json["username"] || !$json["password"]){
    echo json_encode(["Statut" => "Erreur", "Message" => "Un ou plusieurs champs vides"]);
    exit();
}

if($json["email"] == "Vide"){
    echo json_encode(["Statut" => "Erreur", "Message" => "Adresse mail incorrecte"]);
    exit();
}

$user= "root";
$pass = "";
$pdo = new PDO("mysql:host=localhost:3306;dbname=application", $user , $pass);

$notdouble = $pdo -> prepare("SELECT username FROM users WHERE username = :username");
$notdouble -> execute([
":username" => $json["username"]
]);
$result = $notdouble->fetch(PDO::FETCH_ASSOC);

if ($result){
    echo json_encode(["Statut" => "Erreur","Message" => "Nom d'utilisateur déjà attribué"]);
    exit();
}

$request2 = $pdo -> prepare("INSERT INTO users (username,password,email) VALUES(:username,:password,:email)");
$request2 -> execute([
":username" => $json["username"],
":password" => $json["password"],
":email" => $json["email"]
]);

echo json_encode((["Statut" => "Succès","Message" => "Bravo"]));
exit();