<?php
session_start();
$id_res = FILTER_INPUT(INPUT_POST,"res");
$content = FILTER_INPUT(INPUT_POST,"content");
$id_client = FILTER_INPUT(INPUT_POST,"client");

$user= "root";
$password1 = "";
$pdo = new PDO("mysql:host=localhost:3306;dbname=elitehomes", $user , $password1);

// $request = $pdo->query("SELECT id FROM users WHERE roles = 'superadmin'");
// $response = $request->fetch(PDO::FETCH_ASSOC);

// if($response){
$request1 = $pdo->prepare("INSERT INTO messages (reservations_id,expeditor_id,receiver_id,content,discr) VALUES (:reservation_id,:expeditor_id,:receiver_id,:content,1)");
$request1->execute([
    ":reservation_id" => $id_res,
    ":expeditor_id" => $_SESSION["id"],
    ":receiver_id" => $id_client,
    ":content" => $content
    
]);

$request2 = $pdo->prepare("SELECT sending_date FROM messages WHERE expeditor_id = :id AND discr = 1 AND content = :content");
$request2->execute([
    ":id" => $_SESSION["id"],
    ":content" => $content
    
]);
$response2 = $request2->fetch(PDO::FETCH_ASSOC);
// echo json_encode(["Message" => $response2]);

$request3 = $pdo->prepare("UPDATE messages SET discr = 0 WHERE expeditor_id = :id AND discr = 1 AND content = :content AND sending_date = :date");
$request3->execute([
    ":id" => $_SESSION["id"],
    ":content" => $content,
    ":date" => $response2["sending_date"]
]);
  
echo json_encode(["Message" => $response2["sending_date"]]);
// }