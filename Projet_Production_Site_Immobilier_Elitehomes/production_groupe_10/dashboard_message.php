<?php
session_start();
// session_destroy();
// echo $_SESSION["id"];
$user= "root";
$password1 = "";
$pdo = new PDO("mysql:host=localhost:3306;dbname=elitehomes", $user , $password1);

$request = $pdo->query("SELECT reservations.*,users.name FROM reservations INNER JOIN users ON reservations.users_id = users.id ORDER BY starts_at ASC");
$response = $request ->fetchAll(PDO::FETCH_ASSOC);
// var_dump($response);
?> 


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/style.css">
    <title>Dashboard Messages</title>
    <style>
        :root{
        --sable: #C9A769;
        --blanccasse: #F5EFE0;
        --marron: #704E2E;
        --noir: #000000
        }
       body{
        display: flex;
        flex-direction: column;
       }
       div.reserve{
        display: flex;
        flex-direction: row;
        justify-content: space-between;
       }
       p{
        margin: 0;
        font-family: 'container';
       }
       td#head{
        font-weight: bold;
        font-family: 'container';
       }
       td{
       height: 20px;
       font-family: 'container';
       }
       .tableau{
        border-collapse: collapse;
        min-width: 500px;
        border: 2px solid var(--marron);
       }
       tbody tr:nth-child(even){
             background-color: var(--sable);
       }
       thead tr{
        background-color: var(--marron);
        color: white;
       }
       tr{
        text-align: center;
        background-color: var(--blanccasse);
        font-family: 'container';
       }
       th,td{
         padding: 20px;
       }

       a.property{
        color: var(--marron);
        text-decoration: none;
        font-family: 'container';
       }
       a.property:hover{
        color: var(--marron);
        text-decoration: underline;
       }
       tbody tr:nth-child(even) .property,tbody tr:nth-child(even) .message{
       color: white;
       }
       tbody tr:nth-child(even) .message{
       background-color: var(--marron);
       }
       tbody tr:nth-child(even) .message:hover{
       background-color: var(--sable);
       color: var(--marron);
       outline: 2px solid white;
       }
       a.message{
        color: var(--marron);
        text-decoration: none;
        display: flex;
        /* border:  */
        justify-content: center;
        align-items: center;
        height: 25px;
        border-radius: 15px;
        background-color: var(--sable);
       }
       a.message:hover{
          color: white;
          background-color: var(--marron);
       }

    </style>
    <?php include "./header.php"; ?>
</head>
<body>
<?php
if($_SESSION["roles"] == "admin" || $_SESSION["roles"] == "superadmin"){
   ?> <table class="tableau"> 
       <thead>
        <tr>
        <td id="head">id</td>
        <td id="head">Propriété</td>
        <td id="head">Début</td>
        <td id="head">Fin</td>
        <td id="head">Correspondant</td>
        <td id="head">Action</td>
</tr>
       </thead>
       <tbody>  
    <?php
    foreach ($response as $reserve){
        ?> 
         <tr>
          <td><?= $reserve["id"];?></td>
          <td><a href="clients.php?id_res=<?= $reserve["id"] ?>" class="property"><?= $reserve["properties_name"];?></a></td>
          <td><?= $reserve["starts_at"];?></td>
          <td><?= $reserve["ends_at"];?></td>
          <td><?= $reserve["name"];?></td>
          <td><a href="messagesadmin.php?id_res=<?= $reserve["id"]?>&id=<?= $reserve["users_id"]?>&name=<?= $reserve["name"]?>" class="message">Messages</a></td>
        <!-- <a href="avisadmin.php?id_res=<?php // $reserve["id"]?>">Avis</a> -->
        </tr><?php
    }
} ?>
       </tbody>
      </table>
































































<?php
if($_SESSION["roles"] == "client"){
$request1 = $pdo->prepare("SELECT * FROM reservations WHERE users_id = :id AND starts_at > CURRENT_TIMESTAMP");
$request1->execute([
    ":id" => $_SESSION["id"]
]);
$response1 = $request1->fetchAll(PDO::FETCH_ASSOC);
if($response1){
    ?> <div><p> Les réservations futures:</p></div> <?php
foreach ($response1 as $reserve){
    ?> <a href="messages.php?id=<?= $reserve["id"];?>" role="link"><div><p><?= $reserve["properties_name"];?></p></div></a> <?php
}
}

$request2 = $pdo->prepare("SELECT * FROM reservations WHERE users_id = :id AND starts_at <= CURRENT_TIMESTAMP AND ends_at <= CURRENT_TIMESTAMP");
$request2->execute([
    ":id" => $_SESSION["id"]
]);
$response2 = $request2->fetchAll(PDO::FETCH_ASSOC);
if($response2){
    ?> <div><p> Les réservations présentes:</p></div> <?php
foreach ($response2 as $reserve){
    ?> 
    <a href="messages.php?id=<?= $reserve["id"];?>" role="link"><div><p><?= $reserve["properties_name"];?></p></div></a>
    
    <?php

}
}

$request3 = $pdo->prepare("SELECT * FROM reservations WHERE users_id = :id AND ends_at < CURRENT_TIMESTAMP");
$request3->execute([
    ":id" => $_SESSION["id"]
]);
$response3 = $request3->fetchAll(PDO::FETCH_ASSOC);
if($response3){
    ?> <div><p> Les réservations passées:</p></div> <?php
foreach ($response3 as $reserve){
    ?> <a href="avis.php?id_res=<?= $reserve["id"];?>" role="link"><div><p><?= $reserve["properties_name"];?></p></div></a> <?php
}
}
}
?>
    <?php include "./footer.php"; ?>
</body>
</html>






















