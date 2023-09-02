<?php
$json = FILTER_INPUT(INPUT_GET,"id");
$json = json_decode($json,true);

if (!array_key_exists("id",$json) || count(array_keys($json)) != 1){
    echo json_encode(["Statut" => "Erreur", "Message" => "JSON incorrect"]);
    exit();
}

$user= "root";
$password1 = "";
$pdo = new PDO("mysql:host=localhost:3306;dbname=application", $user , $password1);

$request1 = $pdo->prepare("SELECT friend_id FROM relationships WHERE id = :id");
$request1->execute([
":id" => $json["id"]
]);
$result1 = $request1->fetchAll(PDO::FETCH_ASSOC);

if($result1){
  $lenght = count($result1);
  echo json_encode(["Statut" => "Succès", "Message" => ["friends" => $result1, "longueur" => $lenght]]);
  exit();
}
else{
  echo json_encode(["Statut" => "Succès", "Message" => "Aucun ami"]);
}
