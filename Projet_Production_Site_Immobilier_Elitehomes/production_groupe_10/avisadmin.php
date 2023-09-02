<?php
$id_prop = FILTER_INPUT(INPUT_GET,"id_prop");
// echo $id_prop;

$user= "root";
$password1 = "";
$pdo = new PDO("mysql:host=localhost:3306;dbname=elitehomes", $user , $password1);

$request1 = $pdo->prepare("SELECT name FROM properties WHERE id = :id_prop");
$request1->execute([
    ":id_prop" => $id_prop
    // ":content" => $content
]);
$property = $request1->fetch(PDO::FETCH_ASSOC);
// var_dump($response1);

$request2 = $pdo->prepare("SELECT views.*,users.name FROM views INNER JOIN users ON views.users_id = users.id WHERE properties_id = :id_prop");
$request2->execute([
    ":id_prop" => $id_prop
    // ":content" => $content
    
]);
$response2 = $request2->fetchAll(PDO::FETCH_ASSOC);
// var_dump($response2);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/header.css">
    <title>Avis admin</title>
    <style>
        :root{
        --sable: #C9A769;
        --blanccasse: #F5EFE0;
        --marron: #704E2E;
        --noir: #000000
        }
        html{
            background-color: var(--blanccasse);
        }
        div.buttons button{
            border-radius: 20px;
            background-color: var(--marron);
            color: var(--blanccasse);
            padding: 0 5px;
            border: none;
            height: 25px;
        }
        p.name{
            color: var(--marron);
            font-size: 1.1em;
            font-weight: bold;
        }
        .view{
            width: 300px;
            background-color: var(--sable);
            padding: 15px;
            border-radius: 20px;
            margin: 10px;
        }
        p{
            margin: 0;
        }
        .date{
            padding-bottom: 15px;
            font-size: 0.8em;
            text-decoration: underline;
        }
        .cont{
            padding-bottom: 20px;
        }
        .contain{
              display: flex;
              flex-flow: row wrap;
              /* align-content: center; */
              justify-content: center;
              padding: 30px 0;
              height: 65vh;
              overflow: auto;
        }
        div.title{
            font-size: 2em;
            display: flex;
            justify-content: center;
            padding: 20px;
            background-color: var(--sable);
        }
        span{
            color: var(--marron);
        }
        textarea.modify{
            resize: none;
            padding: 5px;
            border: 2px solid;
            border-radius: 15px;
            border-color: var(--marron);
            margin: 10px;
            /* overflow: hidden; */
        }
        .contain::-webkit-scrollbar{
            /* height: 5px; */
            width: 8px;
        }
        .contain::-webkit-scrollbar-thumb{
            border-radius: 10px;
            background-color: var(--marron);
        }
        button.modify{
            border: none;
            border-radius: 15px;
            padding: 0 5px;
            background-color: var(--marron);
            height: 20px;
            color: var(--blanccasse)
        }
        .edit{
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            margin: 10px 0 40px 0 ;

        }
    </style>
    <?php include "./header.php"; ?>
</head>
<body>
</script>
    <div class="title"><p>L'ensemble des avis de la propriété <span>"<?= $property["name"] ?>"</span></p></div>
    <div class="allviews">
    <div class="contain">
    <?php
    foreach($response2 as $view){
        // $view
        ?> 
        <div class="view<?= $view["id"] ?> view">
        <div><p class="name<?= $view["id"] ?> name"> <?= $view["name"]; ?> </p></div>
        <div><p class="date<?= $view["id"] ?> date"> <?= $view["creation_date"]; ?> </p></div>
        <div ><p class="content<?= $view["id"] ?> cont"><?= $view["content"]; ?></p></div>
        <div class="buttons">
        <button class="modify<?= $view["id"] ?> mod">Modifier</button> 
        <button class="delete<?= $view["id"] ?> del">Supprimer</button> 
        <button class="highlight<?= $view["id"] ?> high">Mettre en évidence</button> 
        </div>
        </div><?php
        
    } 
    ?>
    </div>
    </div>
    <!-- <div class="edit">  -->
</body>
<script>
    <?php foreach($response2 as $view){ ?>
        document.querySelector(".modify<?= $view["id"]?>").addEventListener("click",() => {
            buttonModify = document.querySelector("button.modify")
            textareaModify = document.querySelector("textarea.modify")
            if(buttonModify){
                document.querySelector("button.modify").remove()
            }
            if(textareaModify){
                document.querySelector("textarea.modify").remove()
            }
            div = document.createElement("div")
            div.setAttribute("class","edit")
            document.querySelector(".allviews").appendChild(div)
            valeur = document.querySelector("p.content<?= $view["id"] ?>").innerHTML
            console.dir(document.querySelector("p.content<?= $view["id"] ?>"))
            text = document.createElement("textarea")
            text.setAttribute("class","modify")
            text.setAttribute("cols","25")
            text.setAttribute("rows","1")
            // text.setAttribute("placeholder","")
            // text.setAttribute("value","Hey")
            valeur = document.createTextNode(valeur)
            text.appendChild(valeur)
            document.querySelector(".edit").appendChild(text)
            button = document.createElement("button")
            button.setAttribute("class","modify")
            valeurButton = document.createTextNode("Modifier")
            document.querySelector(".edit").appendChild(button)
            document.querySelector("button.modify").appendChild(valeurButton)
            document.querySelector("button.modify").addEventListener("click",() => {
               content = document.querySelector("textarea.modify").value 
               if (content){           
               fetch("edit.php?action=modify&id_view=<?= $view["id"]?>&content="+content)
               .then((result) => {
                    return result.json()
               })
               .then((res) => {
                if(res.Message == "Avis modifié"){
                   document.querySelector("p.content<?= $view["id"] ?>").innerHTML = content
                   document.querySelector("button.modify").remove()
                   document.querySelector("textarea.modify").remove()
                   
                }
               })
            }
            })
            
        })
        document.querySelector(".delete<?= $view["id"]?>").addEventListener("click",() => {
            fetch("edit.php?action=delete&id_view=<?= $view["id"]?>")
            .then(() => {
                document.querySelector(".modify<?= $view["id"]?>").remove()
                document.querySelector(".delete<?= $view["id"]?>").remove()
                document.querySelector(".highlight<?= $view["id"]?>").remove()
                document.querySelector("p.content<?= $view["id"]?>").remove()
                document.querySelector("p.name<?= $view["id"]?>").remove()
                document.querySelector("div.view<?= $view["id"]?>").remove()
                document.querySelector("p.date<?= $view["id"]?>").remove()
            })
        })
        document.querySelector(".highlight<?= $view["id"]?>").addEventListener("click",() => {
            fetch("edit.php?action=highlight&id_view=<?= $view["id"]?>&id_prop=<?= $id_prop?>")
        })


        <?php } ?>
    </script>
    <?php include "./footer.php"; ?>
</html>




