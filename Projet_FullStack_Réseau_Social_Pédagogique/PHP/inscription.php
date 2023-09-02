<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Inscription</title>
    <style>
        body {
            background-color: #FFF;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            background-color: #FFF;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.2);
            margin: 0 auto;
            max-width: 500px;
            padding: 20px;
            text-align: center;
            margin-top: 250px;
        }
        h1 {
            color: #555;
            margin: 0;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            font-size: 1.1rem;
            margin-top: 10px;
        }
        input[type="email"], input[type="password"] {
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 1.1rem;
            padding: 10px;
            margin-top: 5px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            border-radius: 5px;
            border: none;
            color: #fff;
            cursor: pointer;
            font-size: 1.2rem;
            margin-top: 15px;
            padding: 10px;
            width: 300px;
            margin-left: 100px;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #3e8e41;
        }
        a {
            color: #4CAF50;
            display: block;
            margin-top: 10px;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        a:hover {
            color: #3e8e41;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Inscription</h1>
        <form method="POST">
            <label for="email">Adresse e-mail :</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="S'inscrire">
            <a href="connexion.php">Déjà inscrit ? Connectez-vous ici</a>
        </form>
    </div>
</body>
</html>
<?php
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST["email"];
    $password = $_POST["password"];

    if(empty($email) || empty($password)){
        die("Veuillez remplir tous les champs");
    }

    if(!file_exists("users.json")){
        file_put_contents("users.json", "[]");
    }

    $utilisateurs = json_decode(file_get_contents("users.json"), true);

    foreach($utilisateurs as $utilisateur){
        if($utilisateur['email'] === $email){
            die("Cet email est déjà utilisé");
        }
    }

    $hash = password_hash($password, PASSWORD_BCRYPT);

    $utilisateur = [
        'email' => $email,
        'password' => $hash,
        'messages_recus' => [],
        "messages_envoyes"=> []
    ];

    $utilisateurs[] = $utilisateur;

    $json = json_encode($utilisateurs, JSON_PRETTY_PRINT);
    if ($json === false) {
        die("Erreur lors de l'encodage JSON");
    }

    if (file_put_contents("users.json", $json) === false) {
        die("Erreur lors de l'écriture du fichier");
    }

    header("Location: connexion.php");
    exit();
}
?>