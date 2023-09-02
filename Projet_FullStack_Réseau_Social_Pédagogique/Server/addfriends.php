<?php
$json = FILTER_INPUT(INPUT_POST,"body");
$json = json_decode($json,true);
// $id = 3;
// $friend = 1;
$user= "root";
$password1 = "";
$pdo = new PDO("mysql:host=localhost:3306;dbname=application", $user , $password1);

$request1 = $pdo->prepare("SELECT * FROM relationships WHERE id = :id AND friend_id = :id_friend");
$request1->execute([
":id" => $json["id"],
":id_friend" => $json["friend_id"]
]);
$result1 = $request1->fetch(PDO::FETCH_ASSOC);

if($result1){
    echo json_encode(["Statut" => "Succès", "Message" => "Abonné"]);
    exit();
}
else{
echo json_encode(["Statut" => "Succès", "Message" => "Non abonné"]);
exit();
}
?>