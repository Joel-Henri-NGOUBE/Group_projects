<?php
require "vendor/autoload.php";
use GuzzleHttp\Client;

session_start();

if (!(isset($_SESSION["loggedin"]))){
    header("Location: connexion.php");
    exit();
  }

$id = ["id" => $_SESSION["id"]];
$id = json_encode($id);
// var_dump($id);

$client = new GuzzleHttp\Client();
$res = $client->request('POST','http://localhost:80/Projet_FullStack/Server/morefriendsServeur.php',
["form_params" => ["body" => $id]]);
?>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        div.container{
            display: flex;
            flex-direction: column;
            width: 100%;
            height: 100%;
        }
        div.contain{
            display: flex;
            flex-direction: column;
            width: 500px;
            height: 90%;
        }
        div.navbar{
            display: flex;
            justify-content: space-around;
            width: 100%;
            height: 10%;
        }
        div.contain > div.newfriend{
            display: flex;
            justify-content: space-between;

        }
    </style>
</head>
<body>
    <div class="container">
     <div class="contain">

        <?php   
        $body = $res->getBody()->getContents();  
        $body = json_decode($body,true);
        
        if($body["Statut"] == "Succès" && $body["Message"]){
            $i = 0;
            foreach($body["Message"] as $user){
            $data2 = ["id" => $_SESSION["id"], "friend_id" => $user["id"]];
            $data2 = json_encode($data2);
            $client2 = new GuzzleHttp\Client();
            $res2 = $client2->request('POST', 'http://localhost:80/Projet_FullStack/Server/addfriends.php',
            ["form_params" => ["body" => $data2]]);
            $body2 = $res2->getBody();
            $body2 = json_decode($body2,true);
            // var_dump($body2);
            if($body2["Message"] == "Non abonné"){
                ?> 
    <div class="newfriend">
        <p> <span><?php echo $user["username"] ?></span> </p>
         <button class="suivre" id="<?php echo "id".$i ?>">Suivre</button> 
    </div>
    
    <?php
     }else if($body2["Message"] == "Abonné"){
        ?> 
        <div class="newfriend">
            <p> <span><?php echo $user["username"] ?></span> </p>
            <button class="neplussuivre" id="<?php echo "id".$i ?>">Ne plus suivre</button>
        </div>
        
        <?php

    }
   $i = $i + 1; 
}
        
    ?>
    </div>
    <div class="navbar">

    </div>
    </div>
</body>
<script>

    <?php
    $i = 0;
     foreach($body["Message"] as $user){
        $data3 = ["id" => $_SESSION["id"], "friend_id" => $user["id"]];
            $data3 = json_encode($data3);
            $client3 = new GuzzleHttp\Client();
            $res3 = $client3->request('POST', 'http://localhost:80/Projet_FullStack/Server/addfriends.php',
            ["form_params" => ["body" => $data3]]);
            $body3 = $res3->getBody();
            $body3 = json_decode($body3,true);
            if($body3["Message"] == "Non abonné"){
                ?>
        
    document.querySelector("button.suivre#<?php echo "id".$i ?>").addEventListener("click",() => {
        fetch("<?php echo "./Server/addfriendsdo.php?id=".$_SESSION["id"]."&id_friend=".$user["id"] ?>");
        document.querySelector("button.suivre#<?php echo "id".$i ?>").outerHTML = "<button class='neplussuivre' id='<?php echo "id".$i ?>'>Ne plus suivre</button>"
    //console.dir(document.querySelector("button.suivre#<?php echo "id".$i ?>"))
    });
    
    <?php } else if($body3["Message"] == "Abonné"){?>
        document.querySelector("button.neplussuivre#<?php echo "id".$i ?>").addEventListener("click",() => {
        fetch("<?php echo "./Server/addfriendsdo.php?id=".$_SESSION["id"]."&id_friend=".$user["id"] ?>");
        document.querySelector("button.neplussuivre#<?php echo "id".$i ?>").outerHTML = "<button class='suivre' id='<?php echo "id".$i ?>'>Suivre</button>"   
    })
    <?php } 
   $i = $i + 1; 

    }
} 
?>
</script>
</html>