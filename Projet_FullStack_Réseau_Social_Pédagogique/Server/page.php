<?php
$id = FILTER_INPUT(INPUT_POST,"body");
$id = json_decode($id,true);

if (!array_key_exists("id",$id) || count(array_keys($id)) != 1){
    echo json_encode(["Statut" => "Erreur", "Message" => "JSON incorrect"]);
    exit();
}


if(!$id["id"]){
    echo json_encode(["Statut" => "Erreur", "Message" => "Pas d'id"]);
    exit();
}


$user= "root";
$password1 = "";
$pdo = new PDO("mysql:host=localhost:3306;dbname=application", $user , $password1);


$request1 = $pdo->prepare("SELECT *,DATE(publications.date) AS jour,DATE_FORMAT(publications.date,'%Hh%i') AS heure,DATEDIFF(CURRENT_TIMESTAMP,publications.date) AS marge FROM publications WHERE id_user = :id");
$request1->execute([
":id" => $id["id"]
]);
$result1 = $request1->fetchAll(PDO::FETCH_ASSOC);

$request2 = $pdo->prepare("SELECT username FROM users WHERE id = :id");
$request2->execute([
":id" => $result1[0]["id_user"]
]);
$result2 = $request2->fetch(PDO::FETCH_ASSOC);

echo json_encode(["Statut" => "Succès", "Message" => ["infos" => $result1, "utilisateur" => $result2["username"]]]);
exit();