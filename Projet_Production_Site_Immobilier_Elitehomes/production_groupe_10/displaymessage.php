<?php
// $date = FILTER_INPUT(INPUT_GET,"date");
// var_dump($date);echo "<br>";
session_start();
$id_res = FILTER_INPUT(INPUT_GET,"res");
// var_dump($id_res);echo "<br>";
// $sender = FILTER_INPUT(INPUT_GET,"sender");
$senders = FILTER_INPUT(INPUT_GET,"senders");
// var_dump($senders);echo "<br>";
$senders = json_decode($senders,true);
// var_dump($senders);echo "<br>";
// var_dump($senders);
$list = "";
foreach($senders as $sender){
    $list = $list.$sender.",";
}
// var_dump($list);echo "<br>";
$list = substr_replace($list,"",-1,1);

$user= "root";
$password1 = "";
$pdo = new PDO("mysql:host=localhost:3306;dbname=elitehomes", $user , $password1);
// $requete = $pdo->query("SELECT CURRENT_TIMESTAMP AS date");
// $date = $requete->fetch(PDO::FETCH_ASSOC);
// $_SESSION["messages"]

$request = $pdo->prepare("SELECT messages.*,users.name FROM messages INNER JOIN users ON messages.expeditor_id = users.id WHERE expeditor_id IN ($list) AND reservations_id = :id_res ORDER BY sending_date ASC");
$request->execute([
    ":id_res" => $id_res 
]);
$response = $request->fetchAll(PDO::FETCH_ASSOC);
// count($response);
echo json_encode(["Message" => $response, "old" => $_SESSION["messages"], "new" => count($response)]);

$_SESSION["messages"] = count($response);

?>