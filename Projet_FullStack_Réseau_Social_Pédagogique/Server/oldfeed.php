<?php 
$friends = FILTER_INPUT(INPUT_GET,"friends");
$friends = json_decode($friends);

$user = "root";
$password1 = "";
$pdo = new PDO("mysql:host=localhost:3306;dbname=application", $user , $password1);

// $request1 = $pdo->prepare("SELECT DATE_SUB(CURRENT_TIMESTAMP, INTERVAL 7 DAY) AS reference");
// $request1->execute();
// $result1 = $request1->fetch(PDO::FETCH_ASSOC);

// requête avec noms d'utilisateur:  SELECT username, publications.* FROM users INNER JOIN publications ON users.id = publications.id_user;
// SELECT username, publications.* FROM users INNER JOIN publications ON users.id = publications.id_user WHERE DATEDIFF(CURRENT_TIMESTAMP,"2023-05-23 15:35:25") <= 7
foreach ($friends as $ami){
    $request2 = $pdo->prepare("SELECT username, publications.* FROM users INNER JOIN publications ON users.id = publications.id_user WHERE id_user = :id AND DATEDIFF(CURRENT_TIMESTAMP,publications.date) > 7");
    $request2->execute([
        ":id" => $ami["friend_id"]
        // ":date" => $result1["reference"]
    ]);
    $result2 = $request2->fetchAll(PDO::FETCH_ASSOC);
    $result3[] = $result2;
}

if(!empty($result3)){

echo json_encode(["Statut" => "Succès", "Message" => $result3]);
}
else{
echo json_encode(["Statut" => "Succès", "Message" => "Aucun ami n'a publié"]);
}
