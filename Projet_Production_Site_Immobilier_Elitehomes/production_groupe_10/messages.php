<?php
session_start();
$id_res = FILTER_INPUT(INPUT_GET,"id");
// $id_client = FILTER_INPUT(INPUT_GET,"id");
// echo $id_client;
$id = (int)$_SESSION["id"];
// var_dump($id);
$role = $_SESSION["roles"];
$user= "root";
$password1 = "";

$pdo = new PDO("mysql:host=localhost:3306;dbname=elitehomes", $user , $password1);

$req= $pdo->query("SELECT id FROM users WHERE roles = 'admin' OR roles = 'superadmin'");
$resp = $req->fetchAll(PDO::FETCH_ASSOC);
$list = "$id,";
foreach($resp as $ids){
    $list = $list.$ids["id"].",";
}

$list = substr_replace($list,"",-1,1);
// $liste = ["liste" => $list];
// $liste = json_encode($liste);
// var_dump($list);
// $list = array();
// $id_client = 1;

// var_dump($list);

// $list = substr_replace($list,"",-1,1);
// $list = "(".$list.")";

$request = $pdo->prepare("SELECT messages.*,users.name AS expeditor FROM messages INNER JOIN users ON messages.expeditor_id = users.id WHERE reservations_id = :id_res AND expeditor_id IN ($list) ORDER BY sending_date ASC");
// SELECT messages.*,users.name AS expeditor FROM messages INNER JOIN users ON messages.expeditor_id = users.id WHERE reservations_id = :id_res AND expeditor_id IN :list OR receiver_id IN :list ORDER BY sending_date ASC;
// (SELECT *,users.name AS expeditor FROM messages LEFT JOIN users ON messages.expeditor_id = users.id WHERE reservations_id = 31 AND expeditor_id = 8 OR receiver_id = 9 ORDER BY sending_date ASC)
// UNION 
// (SELECT *,users.name AS receiver FROM messages LEFT JOIN users ON messages.receiver_id = users.id WHERE reservations_id = 31 AND expeditor_id = 8 OR receiver_id = 9 ORDER BY sending_date ASC);
$request->execute([
    ":id_res" => $id_res,
    // ":list" => $list
]);
$response = $request->fetchAll(PDO::FETCH_ASSOC);
// count($response);
$_SESSION["messages"] = count($response);


$list = [(int)$id];
// $list[] = $id_client;
// var_dump($list);
foreach($resp as $ids){
    $list[] = $ids["id"];
}
// var_dump($list);
$list = json_encode($list);
// var_dump($list);


?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/footer.css">
    <title>Messagerie</title>

    <style>
        html{
            background-color: var(--sable);
        }
        body{
            margin: 0;
            margin: 0;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            box-sizing: border-box;
        }
        p{
            margin: 0;
            display: table-cell;
        }
        p#moi{
            color: #C9A769;
            padding-bottom: 10px;

        }
        p#admin{
            color: #f7f7c4;
            padding-bottom: 10px;

        }
        p#admin2{
            color: white;

        }
        div.messages{
            display: flex;
            align-items: center;
            flex-direction: column;
            align-self: center;
            /* justify-self: flex-end; */
            background-color: #FEFEE2;
            
        }
        .messagesContain::-webkit-scrollbar{
           width: 10px;
        }
        .messagesContain::-webkit-scrollbar-thumb{
           /* width: 10px; */
           background-color: #f7f7c4;
           border-radius: 10px;
        }
        .messagesContain{
            display: flex;
            background-color: #FEFEE2;
            flex-direction: column;
            /* justify-content: space-around; */
            width: 350px;
            height: 65vh;
            overflow: hidden;
            overflow-y: auto;
            /* overflow-wrap: ; */
        }
        .moi{
            display: flex;
            /* display:  */
            box-sizing: border-box;
            margin: 5px;
            padding: 10px;
            flex-direction: column;
            align-self: flex-end;
            width: 200px;
            border-radius: 15px;
            background-color: #f7f7c4;
        }
        p{
            /* width: 100%; */
            /* text-wrap: wrap; */
            word-break: break-word;
            
        }
        .admin{
            display: flex;
            box-sizing: border-box;
            margin: 5px;
            padding: 10px;
            flex-flow: column nowrap;
            /* word-wrap: break-word; */
            align-self: flex-start;
            width: 200px;
            border-radius: 15px;
            background-color: #C9A769;
        }
        textarea{
            border-radius: 20px 0 0 20px;
            background-color: #FEFEE2;
            padding-left: 20px;
            padding-top: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            resize: none;
            outline: 2px solid;
            outline-color: #C9A769;
            border: none;
        }
        input[type="submit"]{
            border-radius: 0 20px 20px 0;
            border: none;
            height: 30px;
            background-color: #C9A769;
            outline: 2px solid;
            outline-color: #C9A769;
        }
        form{
            display: flex;
            flex-direction: row;    
        }
        .texte{          
            padding: 10px;
        }

    </style>
    <?php include "./header.php"; ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    function send(){
        let message = document.querySelector(".message").value
        // setInterval(() => {
        if(message){
        // console.log(message)
        
        $.ajax({
            type: 'post',
            url: './addmessage.php',
            dataType: 'json',
            data:{
                res:<?= $id_res ?>,
                sender:<?= $id ?>,
                content:message
            }
        ,success: function(result){
            console.log(result)
                
            // A mettre hors d'ajax
            // penser à faire la messagerie côté administrateur en veillant à bien utiliser reveiver et expeditor
            // console.log('displaymessageadmin.php?id_message='+result.Message+'<'&res='.$id_res.'&senders='.$list?>')
            
            
        }
        })
    }
// }, 800);
        return false;
    }
    
    setInterval(() => {
        fetch('<?='displaymessage.php?res='.$id_res.'&senders='.$list?>')
            .then((res) => {
                // console.log(res.json())
                if(res){
                return res.json();
                }
            })
            .then((r) => {
                console.log(r)
            if(r){
             for (let i = r.old ; i < r.new ; i++){
                // console.log(r.old)
                // console.log(r.new)
               if(r.Message[i].name == "<?= $_SESSION["name"] ?>"){
                let content = document.createTextNode(r.Message[i].name)
                let paragraphe = document.createElement("p")
                paragraphe.setAttribute("id","moi")
                paragraphe.appendChild(content)

                let message = document.createElement("div")
                message.setAttribute("class","moi")
                message.appendChild(paragraphe)

                content = document.createTextNode(r.Message[i].content)
                paragraphe = document.createElement("p")
                paragraphe.appendChild(content)
                message.appendChild(paragraphe)

                let container = document.querySelector("div.messagesContain")

                container.appendChild(message)
                document.querySelector(".message").value = ""
            }  
               else{
                let content = document.createTextNode("L'administration")
                let paragraphe = document.createElement("p")
                paragraphe.setAttribute("id","admin")
                paragraphe.appendChild(content)

                let message = document.createElement("div")
                message.setAttribute("class","admin")
                message.appendChild(paragraphe)

                content = document.createTextNode(r.Message[i].content)
                paragraphe = document.createElement("p")
                paragraphe.setAttribute("id","admin2")
                paragraphe.appendChild(content)
                message.appendChild(paragraphe)

                let container = document.querySelector("div.messagesContain")

                container.appendChild(message)
                document.querySelector(".message").value = ""
               }
                        }  
            // nombre = r.Message.length
            
        }
            })
    }, 300)

    </script>
    <style>
        p{
            margin: 0;
        }
        p.title{
            font-size: 2em;
            color: var(--blanc-casse);
            /* display: flex; */
            /* align-self: center; */
        }
        span{
            color: var(--sable);
        }
        div.title{
            display: flex;
            justify-content: center;
            padding: 10px;
            background-color: var(--marron-fonce);
        }
  
    </style>
</head>
<body>
<div class="title"><p class="title">Communiquez à <span>l'administration</span> vos besoins</p></div>  
<div class="messages">
<div class="messagesContain">
<?php
if($response){
    // var_dump($id)."<br>";

    foreach ($response as $message){
    //  if($expeditor["roles"] == "client"){
    //    echo $message["expeditor_id"];
       if($message["expeditor_id"] == $id){
    ?>
    <div class="moi">
    <div><p id="moi"><?= $message["expeditor"];?></p></div>
    <div><p><?= $message["content"];?></p></div>
    </div>
    <?php
    }
       else if($message["receiver_id"] == $id){
        ?>
        <div class="admin">
        <div><p id="admin"><?= "L'administration";?></p></div>
        <div><p id="admin2"><?= $message["content"];?></p></div>
        </div>
        <?php
        }
    }
    
}
// }
else{
    ?> <div><p>Vous n'avez aucun message</p></div> <?php
}
?>
</div>
<div class="texte">
<form method="POST" onsubmit="return send();">
    <textarea class="message" placeholder="Votre message" cols="35" rows="1"></textarea>
    <input type="submit" value="Envoyer">
</form>
</div>
</div>
<?php include "./footer.php"; ?>
</body>
</html>