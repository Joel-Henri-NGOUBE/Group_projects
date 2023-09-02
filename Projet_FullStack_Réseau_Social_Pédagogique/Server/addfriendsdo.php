<?php
$id = FILTER_INPUT(INPUT_GET,"id");
$friend = FILTER_INPUT(INPUT_GET,"id_friend");

$user= "root";
$password1 = "";
$pdo = new PDO("mysql:host=localhost:3306;dbname=application", $user , $password1);

$request1 = $pdo->prepare("SELECT * FROM relationships WHERE id = :id AND friend_id = :id_friend");
$request1->execute([
":id" => $id,
":id_friend" => $friend
]);
$result1 = $request1->fetch(PDO::FETCH_ASSOC);

if($result1){
    $request2 = $pdo->prepare("DELETE FROM relationships WHERE id = :id AND friend_id = :id_friend");
    $request2->execute([
    ":id" => $id,
    ":id_friend" => $friend
    ]);
    $result2 = $request2->fetch(PDO::FETCH_ASSOC);
    echo json_encode(["Statut" => "Succès", "Message" => "Désabonné"]);
    exit();
}
else{
$request3 = $pdo->prepare("INSERT INTO relationships VALUES(:id,:id_friend)");
$request3->execute([
":id" => $id,
":id_friend" => $friend
]);
$result3 = $request3->fetch(PDO::FETCH_ASSOC);
echo json_encode(["Statut" => "Succès", "Message" => "Abonné"]);
exit();
}