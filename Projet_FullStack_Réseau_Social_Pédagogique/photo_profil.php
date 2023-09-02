<?php
require "vendor/autoload.php";
use GuzzleHttp\Client;
session_start();

if (!(isset($_SESSION["loggedin"]))){
  header("Location: connexion.php");
  exit();
}

$methode = FILTER_INPUT(INPUT_SERVER,"REQUEST_METHOD");
if($methode == "POST"){
if (isset($_FILES)){
// var_dump($_FILES);
var_dump($_SESSION["id"]);
$id = $_SESSION["id"];
$title = FILTER_INPUT(INPUT_POST,"title");
$image = $_FILES["image"]["tmp_name"];
$image_type = $_FILES["image"]["type"];
$description = FILTER_INPUT(INPUT_POST,"description");
}

$data = ["id" => "$id","title" => "$title", "image" => "$image", "description" => "$description", "image_type" => "$image_type"];
// var_dump($data);
$data = json_encode($data);
// $publish = false;
// var_dump($data);
     
$client = new GuzzleHttp\Client();
$res = $client->request('POST','http://localhost:80/Projet_FullStack/Server/publish.php',
["form_params" => ["body" => $data]]);

$body = $res->getBody()->getContents();
$body = json_decode($body,true);

if ($body["Statut"] == "Succès" && $title && $image && $description){
// echo $body["Message"]["extension"];
$nameImage = "image".$id."-".$body["Message"]["id_image"].$body["Message"]["extension"];
// echo $che;
$image = move_uploaded_file(rename($_FILES["image"]["tmp_name"],$nameImage),'Projet_FullStack/uploads/');
// echo $image;
$cheminImages = "./".$nameImage;
}
else if($body["Statut"] == "Erreur"){
  if($body["Message"] == "Champs incomplets"){
  ?> <div> <p> <?php echo $body["Message"]; ?> </p></div> <?php
  }else{
  ?> <div> <p> <?php echo "Erreur Système"; ?> </p></div> <?php
  }
  exit();
}

$data2 = ["id_user" => $id, "id_image" => $body["Message"]["id_image"], "chemin" => $cheminImages];
$data2 = json_encode($data2);

$client2 = new GuzzleHttp\Client();
$res2 = $client2->request('POST','http://localhost:80/Projet_FullStack/Server/cheminImages.php',
["form_params" => ["body" => $data2]]);

$body2 = $res2->getBody()->getContents();
$body2 = json_decode($body2,true);

if ($body2["Statut"] == "Succès"){
  
  }
  else if($body2["Statut"] == "Erreur"){
    ?> <div> <p> <?php echo "Erreur Système"; ?> </p></div> <?php
    exit();
  }
//   $publish = true;
// }
// else if ($body["Message"] == "JSON incorrect"){
//       http_response_code(400);
      ?> <div> <p> <?php //echo "Erreur Système"; ?> </p></div> <?php
  //}
// }
}

$id_array = ["id" => $_SESSION["id"]];
$id_array = json_encode($id_array);
// var_dump($id_array);

$client3 = new GuzzleHttp\Client();
$res3 = $client3->request('POST','http://localhost:80/Projet_FullStack/Server/page.php',
["form_params" => ["body" => $id_array]]);
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test</title>
    <style>
        body{
          display: flex;
          flex-direction: column;
          margin: 0;
          /* height: 90%;
          width: 100%; */          
        }

        div.content{
          display: flex;
          justify-content: flex-start;
          /* padding: 2px; */
          height: 90%;
          width: 100%;
        }

        div div.none1{
          /* stroke-width: 10px; */
          /* padding: 2px; */
          position: fixed;
          left: 0;
          background-color: yellow;
          height: 100%;
          width: 10%;
        }
        div div.page{
          /* padding: 2px; */
          position: relative;
          left: 10%;
          display: flex;
          align-items: center;
          flex-direction: column;     
          background-color: white;
          height: 100%;
          width: 80%;
        }

        div.page > div.pub1{
          display: flex;
          align-items: center;
          flex-direction: column;
        }
        div div.none2{
          /* padding: 2px; */
          position: fixed;
          right: 0;
          background-color: yellow;
          height: 100%;
          width: 10%;
        }

        div.navbar{
          /* padding: 2px; */
          position: fixed;
          bottom: 0;
          display: flex;
          justify-content: space-around;
          align-items: center;
          background-color: red;
          height: 10%;
          width: 100%;
        }

        div.navbar > div{
            width: 30px;
            height: 30px;
        }
        div.content > div.page > div.banner{
          height: 25%;
          /* position: fixed;
          top: 0; */
          background-color: purple;
          width: 100%;
        }
        div.content > div.page > div.image{
          /* position: fixed;
          top: 20%; */
          height: 30%;
          background-color: chartreuse;
          width: 15%;
        }
        div.page > div#titre1{
          box-sizing: border-box;
          display: flex;
          justify-content: center;
          flex-direction: column;
          background-color: blue;   
          width: 400px; 
          height: 10%; 
        }
        div.page > div#image1{
          background-color: brown; 
          width: 400px; 
          height: 400px; 
        }
        div.page > div#description1{
          background-color: green;
          width: 400px; 
          height: 25%; 
        }
        p{
          margin: 0;
          padding-left: 10px;
        }
        div.navbar > div#messages > a.lien5{
          width: 30px;
          height: 30px;
        }
        div.publication{
          display: flex;
          flex-direction: column;
          justify-content: center;
          align-items: center;
          position: fixed;
          width: 100%;
          height: 100%;
          background-color: #000000AA;
          z-index: 1;
        }
        div.publication > div.options{
          box-sizing: border-box;
          display: flex;
          flex-direction: column;
          justify-content: space-between;
          width: 400px;
          height: 400px;
          background-color: white;
          border-radius: 0 0 25px 25px;
          padding: 20px;
          /* outline-style: solid;
          outline-color: blue; */
          /* border: 5px 0 0 0 solid gray; */
        }
        div.publication > div.options > form{
        display: flex;
          flex-direction: column;
          justify-content: space-between;
        }
        div.publication > div.add{
          display: flex;
          justify-content: center;
          align-items: center;
          width: 400px;
          height: 40px;
          background-color: white;
          border-radius: 25px 25px 0 0 ;
          /* outline: 0 0 5px 0 solid gray; */

        }

    </style>
</head>

<body>
  <!-- <div class="publication">
       <div class="add"> <p>Ajouter une publication</p> </div>
       <div class="options">
          <form method="POST" enctype="multipart/form-data">
            <label for="title">Titre:</label><br>
            <input type="text" name="title" id="title"><br>
            <label for="image">Image:</label><br>
            <input type="file" name="image" id="image"><br>
            <label for="description">Description</label><br>
            <textarea type="text" name="description" id="description" cols="30" rows="10" placeholder="Descrption">
            </textarea>
            <input type="submit" value="Publier" class="publier">
       </div>
  </div> -->
    <div class="content">
        <div class="none1">
        <button id="logout">
              Se déconnecter
            </button>
        </div>
        <div class="page">
          <div class="banner">           
          </div>
          <div class="image">
          </div>
          <?php 
           $page = $res3->getBody()->getContents();
           $page = json_decode($page,true);
           $i = 0;
           if(isset($page["Statut"])){
           if($page["Statut"] == "Succès"){ 
            foreach ($page["Message"]["infos"] as $element){ 
              $i = $i + 1;
              if ($element["marge"] == 0){
                $date = "Aujourd'hui à ";}
              else if ($element["marge"] == 1){
                $date = "Hier à ";}
              else{
                $date = "Le ".$element["jour"]."à ";}
                ?>
           <div id="titre1">

            <p><?php echo $page["Message"]["utilisateur"] ?></p><p><?php echo $date.$element["heure"] ?></p>
            <p><?php echo $element["title"] ?></p>
          </div>
          <div id="image1">
            <img src="<?php echo $element["image"] ?>" width="400px" height="400px" alt="">  
          </div>
          <div id="description1">
            <p><?php echo $element["description"] ?></p>
          </div>
          <?php
            }
          }
          else if($page["Statut"] == "Erreur"){
            echo "Erreur";
          }
        }
          ?>
          </div>
        <div class="none2">
            <button id="publish">
             Publier
            </button>
            
        </div>     
    </div>
    <div class= "navbar">
      <div id="leadingpage">
        <a href="./Accueil.php"><?php include "./home.svg"; ?></a>
      </div>
      <div id="notify">
        <a href="./notifications.php"><?php include "./chat1.svg"; ?></a>
      </div>
      <div id="profile">
        <a href="./profil.php"><?php include "./profile-user.svg"; ?></a>
      </div>
      <div id="groups">
        <a href="./groupes.php"><?php include "./search.svg"; ?></a>
      </div>
      <div id="messages">
        <a href="./PHP/messages.php"><?php include "./telegram.svg"; ?></a>
      </div>
    </div>
    <script>
      document.querySelector("div.none2 button#publish").addEventListener("click", () => {
        document.querySelector("div.content").innerHTML += '<div class="publication"><div class="add"> <p>Ajouter une publication</p> </div><div class="options"><form method="POST" enctype="multipart/form-data"><label for="title">Titre:</label><br><input type="text" name="title" id="title"><br><label for="image">Image:</label><br><input type="file" name="image" id="image"><br><label for="description">Description</label><br><textarea type="text" name="description" id="description" cols="30" rows="10" placeholder="Description"></textarea><input type="submit" value="Publier" name="publier"></div>'
      })

      document.querySelector("button#logout").addEventListener("click", () => {
        window.location.href="./logout.php"
      })
      //document.querySelector("button#publish").addEventListener("click", () => {
          // console.dir(document.querySelector("body"))
           document.querySelector("div div.page").classList.clientHeight = "<?php echo $i*100 ?>%" 
      // })
    // }
    <?php 
     $i = 0;
     if(isset($page["Statut"])){
      if($page["Statut"] == "Succès"){ 
        foreach ($page["Message"]["infos"] as $element){ 
          $i = $i + 1;?>
  document.querySelector("div.communication > div.commentaires#<?php echo "id".$i ?>").addEventListener("click", () => {
    // fetch("./comments.php?id_pub=<?php  //echo $element["id"] ?>")
    window.location.href="./comments.php?id_pub=<?php  echo $element["id"] ?>"
  })
<?php }
  }
}
?>


    </script>
</body>
</html>