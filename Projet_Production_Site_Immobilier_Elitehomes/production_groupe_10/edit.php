<?php
$action = FILTER_INPUT(INPUT_GET,"action");
$id_view = FILTER_INPUT(INPUT_GET,"id_view");
$id_prop = FILTER_INPUT(INPUT_GET,"id_prop");
$content = FILTER_INPUT(INPUT_GET,"content");

$user= "root";
$password1 = "";
$pdo = new PDO("mysql:host=localhost:3306;dbname=elitehomes", $user , $password1);

if($action == "delete"){
    $request1 = $pdo->prepare("DELETE FROM views WHERE id = :id_view");
    $request1->execute([
        ":id_view" => $id_view
    ]);
    // $response1 = $request1->fetchAll(PDO::FETCH_ASSOC);
}
else if($action == "modify"){
    $request2 = $pdo->prepare("UPDATE views SET content = :content WHERE id = :id_view");
    $request2->execute([
        ":content" => $content,
        ":id_view" => $id_view
    ]);
    echo json_encode(["Message" => "Avis modifié"]);
}
else if($action == "highlight"){
    $request3 = $pdo->prepare("SELECT MAX(evidence) AS max FROM views WHERE properties_id = :id_prop");
    $request3->execute([
        // ":id_view" => $id_view,
        ":id_prop" => $id_prop
    ]);
    $response3 = $request3->fetch(PDO::FETCH_ASSOC);    

    $request4 = $pdo->prepare("UPDATE views SET evidence = :evidence WHERE id = :id_view");
    $request4->execute([
        ":evidence" => $response3["max"] + 1,
        ":id_view" => $id_view
    ]);
    // $response1 = $request1->fetchAll(PDO::FETCH_ASSOC);
}