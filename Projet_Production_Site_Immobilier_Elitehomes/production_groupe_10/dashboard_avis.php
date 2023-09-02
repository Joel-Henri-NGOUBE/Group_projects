<?php
session_start();
// session_destroy();
// echo $_SESSION["id"];
$user= "root";
$password1 = "";
$pdo = new PDO("mysql:host=localhost:3306;dbname=elitehomes", $user , $password1);

$request = $pdo->query("SELECT * FROM properties");
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
    <title>Modérer les avis</title>
    <style>
        :root{
        --sable: #C9A769;
        --blanccasse: #F5EFE0;
        --marron: #704E2E;
        --noir: #000000
        }
        html{
            background-color: var(--blanccasse)
        }
       body{
        display: flex;
        flex-direction: column;
       }
       div.properties{
        display: flex;
        flex-direction: row;
        justify-content: space-between;
       }
       p{
        margin: 0;
       }
       td#head{
        font-weight: bold;
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
        background-color: var(--blanccasse)
       }
       th,td{
         padding: 20px;
       }
       tbody tr:nth-child(even) .avis{
       color: white;
       }
       tbody tr:nth-child(even) .avis{
       background-color: var(--marron);
       }
       tbody tr:nth-child(even) .avis:hover{
       background-color: var(--sable);
       color: var(--marron);
       outline: 2px solid white;
       }
       a.avis{
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
       a.avis:hover{
          color: white;
          background-color: var(--marron);
       }

    </style>
<?php include "./header.php"; ?>
</head>
<body>
<?php
if($_SESSION["roles"] == "admin" || $_SESSION["roles"] == "superadmin"){
    ?><table class="tableau"> 
       <thead>
        <tr>
        <td id="head">id</td>
        <td id="head">Propriété</td>
        <td id="head">Action</td>
       </tr>
       </thead>
       <tbody> <?php
    foreach ($response as $properties){
        ?> 
        <tr>
        <td><?= $properties["id"];?></td>
        <td><?= $properties["name"];?></td>
        <!-- <a href="clients.php?id_res=<?php //$properties["id"]?>">aviss</a> -->
        <td><a href="avisadmin.php?id_prop=<?= $properties["id"]?>" class="avis">Avis</a></td>
        </tr>
       
       <?php
    }
}
?>
</tbody>
</table>
<?php include "./footer.php"; ?>
</body>
</html>


