<?php 
session_start();
if (!(isset($_SESSION["loggedin"]))){
    header("Location: connexion.php");
    exit();
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
        div.container{
            display: flex;
            flex-direction: column;
        }
    </style>
</head>
<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    function send(){
        let research = document.querySelector(".research").value
        document.querySelector("div.container").innerHTML = ""
        if(research){
        console.log(research)
        $.ajax({
            type: 'post',
            url: './Server/fetch.php',
            dataType: 'json',
            data:{
                data:research
            }
        , success: function(result){
            console.log(result)
            long = result.Message.length
            for (let i = 0; i <= long - 1; i++){
            document.querySelector("div.container").innerHTML += "<div> <p>"+result.Message[i].username+"</p> </div>"
            }
            // forEach(result.Message as resultat){
            //     document.querySelector("div.container").innerHTML += "<div> <p>"+resultat.username+"</p> </div>"
            // }
            // result.Message.forEach(function(result){
            //     document.querySelector("div.container").innerHTML += "<div> <p>"+resultat.username+"</p> </div>"
            // })
        }
        })
        }
        return false;
    }

</script>
    <form method="POST" onsubmit="return send();" onkeyup="return send();">
        <input type="text" name="research" class="research">
        <input type="submit" value="Envoyer" >
    </form>
    <div class="container">

    </div>
</body>
</html>