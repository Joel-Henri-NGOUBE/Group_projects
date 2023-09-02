<?php
$methode = FILTER_INPUT(INPUT_SERVER,"REQUEST_METHOD");

$json = FILTER_INPUT(INPUT_POST,"body");
$json = json_decode($json, true);

if (!array_key_exists("id",$json) || !array_key_exists("title",$json) || !array_key_exists("image",$json) || !array_key_exists("description",$json) || !array_key_exists("image_type",$json) || count(array_keys($json)) != 5){
    echo json_encode(["Statut" => "Erreur", "Message" => "JSON incorrect"]);
    exit();
}

if (!$json["title"] || !$json["image"] || !$json["description"]){
    echo json_encode(["Statut" => "Erreur", "Message" => "Champs incomplets"]);
    exit();
}

$user= "root";
$password1 = "";
$pdo = new PDO("mysql:host=localhost:3306;dbname=application", $user , $password1);

$request2 = $pdo->prepare("INSERT INTO publications (id_user,title,image,type,description,discr) VALUES (:id,:titre,:image,:type,:description,:discriminant)");
$request2->execute([
":id" => $json["id"],
":titre" => $json["title"],
":image" => $json["image"],
":type" => $json["image_type"],
":description" => $json["description"],
":discriminant" => 1
]);

$request3 = $pdo->prepare("SELECT id,type FROM publications WHERE id_user = :id AND discr = :un");
$request3->execute([
            ":id" => $json["id"],
            ":un" => 1
            ]);
$result3 = $request3->fetch(PDO::FETCH_ASSOC);

$ext = str_replace("/",".",strrchr($result3["type"],"/"));

$request4 = $pdo->prepare("UPDATE publications SET discr = :zero WHERE id_user = :id AND discr = :un");
$request4->execute([
            ":zero" => 0,
            ":id" => $json["id"],
            ":un" => 1
            ]);

echo json_encode(["Statut" => "Succès", "Message" => ["id_image" => $result3["id"], "extension" => $ext]]);
exit();
?>