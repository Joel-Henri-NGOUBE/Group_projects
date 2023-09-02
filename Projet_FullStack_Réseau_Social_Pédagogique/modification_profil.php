<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>modification profil</title>
</head>
<body>
  <form action="traitement.php" method="POST" enctype="multipart/form-data">
    <label for="first_name">Prénom:</label>
    <input type="text" id="first_name" name="first_name"><br><br>

    <label for="last_name">Nom:</label>
    <input type="text" id="last_name" name="last_name"><br><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email"><br><br>

    <label for="birth_date">Date de naissance:</label>
    <input type="date" id="birth_date" name="birth_date"><br><br>

    <label for="banner">Bannière:</label>
    <input type="file" id="banner" name="banner"><br><br>

    <label for="profile_pic">Photo de profil:</label>
    <input type="file" id="profile_pic" name="profile_pic"><br><br>

    <label for="username">Nom d'utilisateur:</label>
    <input type="text" id="username" name="username"><br><br>

    <label for="password">Mot de passe:</label>
    <input type="password" id="password" name="password"><br><br>

    <input type="submit" value="Envoyer">
  </form>
  <form action="desactiver_statut.php" method="post">
    <input type="hidden" name="user_id" value=<?php echo $_SESSION["id"]?>> <!-- Remplacez 1 par l'identifiant de l'utilisateur -->
    <input type="submit" name="desactiver" value="Désactiver le compte">
  </form>
  <form action="supprimer_compte.php" method="post">
    <input type="hidden" name="user_id" value=<?php echo $_SESSION["id"]?>> <!-- Remplacez 1 par l'identifiant de l'utilisateur -->
    <input type="submit" name="supprimer" value="supprimer le compte">
  </form>
</body>
</html>
