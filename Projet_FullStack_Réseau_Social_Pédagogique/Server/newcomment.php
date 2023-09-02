<?php 
$id_pub = FILTER_INPUT(INPUT_POST,"id_pub");
// $id_pub = 1;
$id = FILTER_INPUT(INPUT_POST,"id");
// $id = 3;
$comment = FILTER_INPUT(INPUT_POST,"comment");
// $comment = 'Hey';
$id_comments = FILTER_INPUT(INPUT_POST,"id_comments");
// $id_comments = 0;

$user= "root";
$password1 = "";
$pdo = new PDO("mysql:host=localhost:3306;dbname=application", $user , $password1);

$request1 = $pdo->prepare("INSERT INTO commentaires (id_pub, id_user, comment) VALUES(:id_pub,:id, :comment )");
$request1->execute([
":id_pub" => $id_pub,
":id" => $id,
":comment" => $comment
]);
if($id_comments){
$request2 = $pdo->prepare("SELECT username,commentaires.* FROM commentaires INNER JOIN users ON users.id = commentaires.id_user WHERE id_pub = :id_pub AND id_com NOT IN :id_comments");
$request2->execute([
":id_pub" => $id_pub,
":id_comments" => $id_comments
]);
$result2 = $request2->fetchAll(PDO::FETCH_ASSOC);
}
else{
    $request2 = $pdo->prepare("SELECT username,commentaires.* FROM commentaires INNER JOIN users ON users.id = commentaires.id_user WHERE id_pub = :id_pub");
    $request2->execute([
    ":id_pub" => $id_pub
    // ":id_comments" => $id_comments
    ]);
    $result2 = $request2->fetchAll(PDO::FETCH_ASSOC);
}
echo json_encode(["Statut" => "Succès", "Message" => $result2]);
exit();
