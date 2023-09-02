<?php
$id_pub = FILTER_INPUT(INPUT_POST,"body");

$user= "root";
$password1 = "";
$pdo = new PDO("mysql:host=localhost:3306;dbname=application", $user , $password1);


$request1 = $pdo -> prepare("SELECT username,commentaires.* FROM commentaires INNER JOIN users ON commentaires.id_user = users.id WHERE id_pub = :id_pub");
$request1 -> execute([
":id_pub" => $id_pub
]);
$result1 = $request1->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(["Statut" => "Succès", "Message" => $result1]);