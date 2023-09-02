<?php
require "vendor/autoload.php";
use GuzzleHttp\Client;

session_start();
if (!(isset($_SESSION["loggedin"]))){
  header("Location: connexion.php");
  exit();
}
$id_array = ["id" => $_SESSION["id"]];
// var_dump($id_array);
$id_array = json_encode($id_array);

$client = new GuzzleHttp\Client();
$res = $client->request('GET','http://localhost:80/Projet_FullStack/Server/friends.php?id='.$id_array);

$body = $res->getBody()->getContents();
$body = json_decode($body,true);
// var_dump($body);
// var_dump($body);
if($body["Statut"] == "Succès"){
  // echo $body["Message"];
  if(isset($body["Message"]["friends"])){
    $friends = ["friends" => $body["Message"]];
    // echo "100000000000";
    // var_dump($friends);
    $friends = json_encode($friends);

    $client2 = new GuzzleHttp\Client();
    $res2 = $client2->request('POST','http://localhost:80/Projet_FullStack/Server/newsfeed.php',
    ["form_params" => ["body" => $friends]]);
    
    

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

        div div.details{
          /* stroke-width: 10px; */
          /* padding: 2px; */
          position: fixed;
          left: 0;
          background-color: blue;
          height: 100%;
          width: 20%;
        }
        div div.page{
          /* padding: 2px; */
          position: relative;
          left: 20%;
          display: flex;
          align-items: center;
          flex-direction: column;     
          background-color: yellow;
          height: 100%;
          width: 60%;
        }

        div.nofriend{
          position: relative;
          left: 20%;
          display: flex;
          align-items: center;
          justify-content: center;     
          background-color: white;
          height: 100%;
          width: 60%;
        }

        div.page > div.pub1{
          display: flex;
          align-items: center;
          flex-direction: column;
        }
        div div.discussions{
          /* padding: 2px; */
          position: fixed;
          right: 0;
          background-color: green;
          height: 100%;
          width: 20%;
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

        div.page > div#titre1{
          box-sizing: border-box;
          display: flex;
          justify-content: center;
          flex-direction: column;
          background-color: blue;   
          width: 60%; 
          height: 10%; 
        }
        div.page > div#image1{
          background-color: brown; 
          width: 60%; 
          height: 65%; 
        }
        div.page > div#description1{
          background-color: green;
          width: 60%; 
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

    </style>
</head>

<body>
    <div class="content">
        <div class="details">

        </div>

        <div class="page">

        <?php 
           $body2 = $res2->getBody()->getContents();
           $body2 = json_decode($body2,true);
           var_dump($body2["Message"]);
      if(isset($body2["Message"])){
          
           if($body2["Message"] == "Aucun ami n'a publié récemment"){
             ?> <div class="nofriend">
               <p>Aucun de vos actuels amis ne possède de publication.</p>
              <button class="getfriend"> Ajouter un(des) ami(e)s</button>
              <button class="searchfriend"> Rechercher un ami</button>
                </div> <?php
               $publish = 1;
           }
           else{
            $i = 0;
            foreach ($body2["Message"] as $partie){ 
              foreach($partie as $element)
              if ($element["marge"] == 0){
                $date = "Aujourd'hui à ";}
              else if ($element["marge"] == 1){
                $date = "Hier à ";}
              else{
                $date = "Le ".$element["jour"]."à ";}
                ?>
           <div id="titre1">

            <p><?php echo $element["username"] ?></p><p><?php echo $date.$element["heure"] ?></p>
            <p><?php echo $element["title"] ?></p>
          </div>
          <div id="image1">
            <img src="<?php echo $element["image"] ?>" width="400px" height="400px" alt="">  
          </div>
          <div class="communication">
              <div class="coeur" id="id".$i></div><p><?php echo $element["likes"] ?></p>
              <div class="commentaires"></div><p><?php echo $element["comments"] ?></p>
              <div class="emote1"></div><p><?php echo $element["emote1"] ?></p>
              <div class="emote2"></div><p><?php echo $element["emote2"] ?></p>
              <div class="emote3"></div><p><?php echo $element["emote3"] ?></p>
          </div>
          <div id="description1">
            <p><?php echo $element["description"] ?></p>
          </div>
          <?php
              $i = $i + 1;

            }
       
           
               ?>
              
             <?php 
              }
            }
            }
            
            else if($body["Message"] == "Aucun ami"){
            //  echo $body["Message"];
             ?> <div class="nofriend">
               <p>Vous ne possédez jusqu'ici aucun ami</p>
               <button class="getfriend"> Ajouter un ami</button>
               <button class="searchfriend"> Rechercher un ami</button>
              </div> <?php
            }
          }
          // else{
          //   exit();
          // }
             ?>
        </div>     
    </div>
    <div class= "navbar">
      <div id="leadingpage" aria-label="Accueil">
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
        <a href="./messages.php"><?php include "./telegram.svg"; ?></a>
      </div>
    </div>
</body>
</html>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script>
      <?php 
      $i = 0;
      if(isset($body2["Message"])){
      foreach ($body2["Message"] as $element){ 
?>
    document.querySelector("div.commentaires").addEventListener(() => {
      //  fetch("./comments.php?id_pub=".<?php //$element["id"] ?>)
       window.location.href="./comments.php?id_pub=".<?php $element["id"] ?>"
    })
    <?php $i = $i + 1; }
    }?>
    document.querySelector("div button.searchfriend").addEventListener("click", () => {
      window.location.href="./research.php";
    })
    document.querySelector("div button.getfriend").addEventListener("click", () => {
      window.location.href="./morefriends.php";
    })

    //   let b = document.querySelector("div.navbar > div#messages > a.lien5")
    //   console.log(b)
    //   document.querySelector("div.navbar > div#messages > a.lien5").addEventListener("mouseleave",() => {
        // b.innerHTML = '<?php  //include "./telegram.svg"; ?>'
    //   })
    </script>