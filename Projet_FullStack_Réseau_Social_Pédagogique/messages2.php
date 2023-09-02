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
        div div.newsfeed{
          /* padding: 2px; */
          position: relative;
          left: 20%;
          display: flex;
          align-items: center;
          flex-direction: column;     
          background-color: yellow;
          height: 300%;
          width: 60%;
        }

        div.newsfeed > div.pub1{
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

        div.newsfeed > div#titre1{
          box-sizing: border-box;
          display: flex;
          justify-content: center;
          flex-direction: column;
          background-color: blue;   
          width: 60%; 
          height: 10%; 
        }
        div.newsfeed > div#image1{
          background-color: brown; 
          width: 60%; 
          height: 65%; 
        }
        div.newsfeed > div#description1{
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
        <div class="newsfeed">
          <div id="titre1">
            <p>Pseudo de celui a envoyé la publication</p>
            <p>Titre de la publication ou Date et heure</p>
          </div>
          <div id="image1">
              
          </div>
          <div id="description1">
                
          </div>

          <div id="titre1">
            <p>Tigresse Pourpre</p>
            <p>Aujourd'hui à 16h27</p>
          </div>
          <div id="image1">
              <p>This should be an image</p>
          </div>
          <div id="description1">
                
          </div>

          <div id="titre1">
           <p>This should be an image</p>
          </div>
          <div id="image1">
              
          </div>
          <div id="description1">
                
          </div>
            
        </div>
        <div class="discussions">
            
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
        <a href="./messages.php"><?php include "./telegram.svg"; ?></a>
      </div>
    </div>
</body>
</html>