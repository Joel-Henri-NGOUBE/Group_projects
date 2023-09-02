<?php
$id_res = FILTER_INPUT(INPUT_GET,"id_res");

$user= "root";
$password1 = "";
$pdo = new PDO("mysql:host=localhost:3306;dbname=elitehomes", $user , $password1);
// (SELECT users.name,users.id FROM users INNER JOIN messages ON users.id = messages.expeditor_id WHERE reservations_id = :id_res ) UNION (SELECT users.name,users.id FROM users INNER JOIN messages ON users.id = messages.receiver_id WHERE reservations_id = :id_res)
// SELECT users.name,users.id FROM users INNER JOIN reservations ON users.id = reservations.users_id WHERE reservations.id = 31;

$request1 = $pdo->prepare("SELECT properties_id FROM reservations WHERE id = :id_res");
$request1->execute([
    ":id_res" => $id_res
]);
$response1 = $request1->fetch(PDO::FETCH_ASSOC);

$request2 = $pdo->prepare("SELECT users.name,users.id AS id_user,reservations.id AS id_res FROM users INNER JOIN reservations ON users.id = reservations.users_id WHERE reservations.properties_id = :id_prop");
$request2->execute([
    ":id_prop" => $response1["properties_id"]
]);
$response2 = $request2->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/header.css">
    <title>Client</title>
    <?php include "./header.php"; ?>
</head>
<body>
<?php
foreach ($response2 as $client){
    ?> <a href="messagesadmin.php?id=<?= $client["id_user"]."&id_res=".$client["id_res"];?>&name=<?= $client["name"] ?>" role="link"><div><p><?= $client["name"];?></p></div></a> <?php
}  ?>
<?php include "./footer.php" ?>
</body>
</html>







