<?php
require "vendor/autoload.php";
use GuzzleHttp\Client;

session_start();
$id_pub = FILTER_INPUT(INPUT_GET,"id_pub");

if (!(isset($_SESSION["loggedin"]))){
    header("Location: connexion.php");
    exit();
  }
  
$client = new GuzzleHttp\Client();
$res = $client->request('POST', 'http://localhost:80/Projet_FullStack/Server/commentsServeur.php',
["form_params" => ["body" => $id_pub]]);

$body = $res->getBody();
$body = json_decode($body,true);

$id_coms = "";
foreach ($body["Message"] as $element){
    $id_coms = $id_coms.$element['id_com'].",";
}
if($id_coms){
    $id_coms = substr_replace($id_coms,"",-1,1);
    $id_coms = "(".$id_coms.")";
}
else{
    $id_coms = 0;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        div.container,div.surround{
            display: flex;
            flex-direction: column;
        }
        p{
            margin: 0;
        }
    </style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
    function add(){
        let com = document.querySelector(".coms").value
        // document.querySelector("div.container").innerHTML = ""
        console.log(com)
        if(com){
        // console.log(com)
        $.ajax({
            type: 'post',
            url: './Server/newcomment.php',
            dataType: 'json',
            data:{
                id_pub:<?php echo $id_pub ?>,
                id:<?php echo $_SESSION["id"] ?>,
                comment:com,
                id_comments:<?php echo $id_coms ?>
            }
        , success: function(result){
            //Effectuer un fetch qui ajoutera le nouveau commentaire  ou les nouveaux commentaires
            console.log(result)
            if(result){
            long = result.Message.length
            for (let i = 0; i <= long - 1; i++){
            document.querySelector("div.container").innerHTML += "<div class='surround'> <p><span>"+result.Message[i].username+"</span><span>"+result.Message[i].date+"</span></p><p>"+result.Message[i].comment+"</p> </div>"
            }
        }
        }
        })
        }
        return false;
    }

</script>
</head>
<body>
    <div class="container">
    <?php 

    if($body["Statut"] == "Succès"){
        foreach ($body["Message"] as $message){
            ?>
            <div class="surround">
                <p><span><?php echo $message["username"] ?></span><span><?php echo $message["date"] ?></span></p>
                <p><?php echo $message["comment"] ?></p>
            </div>
        
        <?php } ?>
        <?php
    }
    ?>
    </div>
    <form method="POST" onsubmit="return add();">
        <textarea class="coms" cols="30" rows="4"></textarea>
        <input type="submit" value="Envoyer">
    </form>
</body>
</html>