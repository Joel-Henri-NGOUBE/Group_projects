<?php
session_start();
$id_res = FILTER_INPUT(INPUT_GET,"id_res");

$user= "root";
$password1 = "";
$pdo = new PDO("mysql:host=localhost:3306;dbname=elitehomes", $user , $password1);

$request1 = $pdo->prepare("SELECT properties_id,properties_name FROM reservations WHERE id = :id_res");
$request1->execute([
    // ":id" => $_SESSION["id"],
    "id_res" => $id_res
]);
$prop = $request1->fetch(PDO::FETCH_ASSOC);

$request2 = $pdo->prepare("SELECT views.*,users.name FROM views INNER JOIN users ON views.users_id = users.id WHERE users_id = :id AND properties_id = :id_prop ORDER BY creation_date ASC");
$request2->execute([
    ":id" => $_SESSION["id"],
    "id_prop" => $prop["properties_id"]
]);
$views = $request2->fetchAll(PDO::FETCH_ASSOC);
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/header.css">

    <title>Avis</title>
    <style>
        :root{
        --sable: #C9A769;
        --blanccasse: #F5EFE0;
        --marron: #704E2E;
        --noir: #000000
        }
        html{
            background-color: var(--blanccasse);
            /* margin: 0; */
            box-sizing: border-box;
        }
        .views{
            display: flex;
            flex-flow: row wrap;
            overflow: auto;
            height: 70vh;
            padding: 30px;
            justify-content: center;
            /* scroll-behavior: auto; */
        }
        .views::-webkit-scrollbar{
            /* height: 5px; */
            width: 8px;
        }
        .views::-webkit-scrollbar-thumb{
            border-radius: 10px;
            background-color: var(--marron);
        }
        .view{
            width: 300px;
            /* box-sizing: inherit; */
            background-color: var(--sable);
            border-radius: 20px;
            padding: 15px;
            margin: 10px;

        }
        .date{
        padding-bottom: 15px;
        font-size: 0.8em;
        text-decoration: underline;
        }
        p.name{
            color: var(--blanccasse);
            font-size: 1.1em;
        }
        p{
            margin: 0;
            color: #000
        }
        .addview{
            padding: 15px 0 45px 0;
        }
        .addview form{
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
        }

        .avis{
            resize: none;
            border-radius: 50px;
            padding: 10px;
            display: flex;
            margin: 10px;
            border: 2px solid;
            border-color: var(--marron);
            
        }
        input[type="submit"]{
            font-size: 1.4em;
            padding: 0 6px;
            background-color: var(--marron);
            color: var(--blanccasse);
            border-radius: 50px;
            border: none;
        }
        span{
            color: var(--marron);
            /* padding-left: 5px; */
        }
        p.title{
            font-size: 2em;
            width: auto;
            /* display: flex;
            justify-content: center; */
            padding: 15px;
            /* padding-left: 20vw; */
        }
        div.title{
            display: flex;
            justify-content: center;
            background-color: var(--sable)
        }
    </style>

<?php include "./header.php"; ?>
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    function send(){
           avis = document.querySelector(".avis").value
           console.log(avis)
           if(avis){
        // console.log(message)
        
        $.ajax({
            type: 'post',
            url: './addview.php',
            dataType: 'json',
            data:{
                // res:<?= $id_res ?>,
                sender:<?= $_SESSION["id"] ?>,
                content:avis,
                id_prop:<?= $prop["properties_id"] ?>
            }
        ,success: function(result){
            console.log(result.Message)
            document.querySelector(".avis").value = "";
          }
        }) 
    }
    return true;
    }
</script>
<body>
<div class="title"><p class="title">Vos avis sur la propriété <span>"<?= $prop["properties_name"] ?>"</span></p></div>
<div class="allviews">
<div class="views">
    <?php
foreach($views as $avis){
    ?> <div class="view">
     <div><p class="name"> <?= $avis["name"]; ?> </p></div>
     <div><p class="date"> <?= $avis["creation_date"]; ?> </p></div>
       <div><p class="content"> <?= $avis["content"]; ?> </p></div> 
     </div> <?php
}
?>
</div>
<div class="addview">
<form method="POST" onsubmit="return send();">
    <textarea class="avis" cols="35" rows="1" placeholder="Ajouter un avis"></textarea>
    <input type="submit" value="+">
</form>
</div>
</div>
<?php include "./footer.php"; ?>
</body>
</html>
