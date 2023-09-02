<?php 
$research = FILTER_INPUT(INPUT_POST,"data");

$user= "root";
$password1 = "";
$pdo = new PDO("mysql:host=localhost:3306;dbname=application", $user , $password1);

$request1 = $pdo->prepare("SELECT username FROM users WHERE username LIKE CONCAT(:wanteddata,'%')");
$request1->execute([
":wanteddata" => $research
]);
$result1 = $request1->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(["Statut" => "Succès", "Message" => $result1]);
exit();