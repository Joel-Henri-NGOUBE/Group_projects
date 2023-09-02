<?php
$content = FILTER_INPUT(INPUT_POST,"content");
$sender = FILTER_INPUT(INPUT_POST,"sender");
// $id_res = FILTER_INPUT(INPUT_POST,"res");
$id_prop = FILTER_INPUT(INPUT_POST,"id_prop");

$user= "root";
$password1 = "";
$pdo = new PDO("mysql:host=localhost:3306;dbname=elitehomes", $user , $password1);

$request1 = $pdo->prepare("INSERT INTO views (properties_id,users_id,content,creation_date,evidence) VALUES(:id_prop,:sender,:content,CURRENT_TIMESTAMP,0)");
$request1->execute([
    ":id_prop" => $id_prop,
    ":sender" => $sender,
    ":content" => $content
]);
$id_prop = $request1->fetch(PDO::FETCH_ASSOC);

echo json_encode(["Message" => "Succès"]);
