<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Accès au billet</title>
</head>
<body>
    <h1>Accès au billet</h1>
    <form action="affichage_billet.php" method="post">
        <label for="nom">Nom du visiteur :</label>
        <input type="text" name="nom" id="nom"><br>
        <label for="id_prive">Identifiant privé du billet :</label>
        <input type="text" name="id_prive" id="id_prive"><br>
        <input type="submit" value="Accéder au billet">
    </form>
</body>
</html>