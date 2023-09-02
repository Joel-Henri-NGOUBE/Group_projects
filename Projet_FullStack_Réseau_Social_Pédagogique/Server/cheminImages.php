<?php
$json = FILTER_INPUT(INPUT_POST,"body");
$json = json_decode($json,true);

$user= "root";
$password1 = "";
$pdo = new PDO("mysql:host=localhost:3306;dbname=application", $user , $password1);

$request3 = $pdo->prepare("UPDATE publications SET image = :chemin WHERE id_user = :id_user AND id = :id_image");
$request3->execute([
            "chemin" => $json["chemin"],
            ":id_user" => $json["id_user"],
            ":id_image" => $json["id_image"]
            ]);
// $result3 = $request3->fetch(PDO::FETCH_ASSOC);
echo json_encode(["Statut" => "Succès", "Message" => "Félicitations"]);