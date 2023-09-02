<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Sélection de l'événement à modifier</title>
</head>
<body>
    <h1>Sélection de l'événement à modifier</h1>
    <form action="modification_evenement.php" method="post">
        <label for="id_evenement">Sélectionnez l'événement à modifier :</label>
        <select name="id_evenement" id="id_evenement">
            <?php
     
            $pdo = new PDO('mysql:host=localhost;dbname=oui', 'root', '');

            $query = "SELECT id, nom FROM evenements";
            $result = $pdo->query($query);

            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo '<option value="' . $row['id'] . '">' . htmlspecialchars($row['nom']) . '</option>';
            }
            ?>
        </select>
        <br>
        <input type="submit" value="Modifier l'événement sélectionné">
    </form>
</body>
</html>
