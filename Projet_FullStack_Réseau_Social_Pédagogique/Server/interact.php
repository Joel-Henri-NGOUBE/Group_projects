<?php
$id = FILTER_INPUT(INPUT_GET,"id");
$id_pub = FILTER_INPUT(INPUT_GET,"id_pub");
$coeur = FILTER_INPUT(INPUT_GET,"id_coeur");
$emote1 = FILTER_INPUT(INPUT_GET,"id_emote1");
$emote2 = FILTER_INPUT(INPUT_GET,"id_emote2");
$emote3 = FILTER_INPUT(INPUT_GET,"id_emote3");

$user= "root";
$password1 = "";
$pdo = new PDO("mysql:host=localhost:3306;dbname=application", $user , $password1);

$request1 = $pdo->prepare("SELECT * FROM clicks WHERE id_pub = :id_pub AND likers = :id OR emoters1 = :id OR emoters2 = :id OR emoters3 = :id");
$request1->execute([
":id_pub" => $id,
":id" => $id
]);
$result1 = $request1->fetch(PDO::FETCH_ASSOC);

if(!$result1){
if($id && $coeur){
$request1 = $pdo->prepare("INSERT INTO clicks (pub,likers,click1) VALUES(:id_pub,:id,oui)");
$request1->execute([
":id_pub" => $id,
":id" => $id
]);
}
if($id && $emote1){
    $request1 = $pdo->prepare("INSERT INTO clicks (pub,emoters1,click2) VALUES(:id_pub,:id,oui)");
    $request1->execute([
    ":id_pub" => $id,
    ":id" => $id
    ]);
    }
if($id && $emote2){
        $request1 = $pdo->prepare("INSERT INTO clicks (pub,emoters2,click3) VALUES(:id_pub,:id,oui)");
        $request1->execute([
        ":id_pub" => $id,
        ":id" => $id
        ]);
        }
if($id && $emote3){
            $request1 = $pdo->prepare("INSERT INTO clicks (pub,emoters3,click4) VALUES(:id_pub,:id,oui)");
            $request1->execute([
            ":id_pub" => $id,
            ":id" => $id
            ]);
            }
}
else{
    if($id && $coeur){
    $request1 = $pdo->prepare("UPDATE clicks SET  click1 = 'oui' WHERE pub = :id_pub AND likers = :id");
    $request1->execute([
    ":id_pub" => $id,
    ":id" => $id
    ]);
    }
    if($id && $coeur){
        $request1 = $pdo->prepare("UPDATE clicks SET  click2 = 'oui' WHERE pub = :id_pub AND emoters1 = :id");
        $request1->execute([
        ":id_pub" => $id,
        ":id" => $id
        ]);
        }
    if($id && $coeur){
            $request1 = $pdo->prepare("UPDATE clicks SET  click3 = 'oui' WHERE pub = :id_pub AND emoters2 = :id");
            $request1->execute([
            ":id_pub" => $id,
            ":id" => $id
            ]);
            }
    if($id && $coeur){
                $request1 = $pdo->prepare("UPDATE clicks SET  click1 = 'oui' WHERE pub = :id_pub AND emoters = :id");
                $request1->execute([
                ":id_pub" => $id,
                ":id" => $id
                ]);
                }   
}