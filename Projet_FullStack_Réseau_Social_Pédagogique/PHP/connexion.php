<?php 
session_start();

$erreur = "";
$email = isset($_POST["email"]) ? $_POST["email"] : "";
$password = isset($_POST["password"]) ? $_POST["password"] : "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($email == "" || $password == "") {
        $erreur = "Veuillez saisir une adresse e-mail et un mot de passe.";
    } else {
        $utilisateurs = json_decode(file_get_contents("users.json"), true);
        if ($utilisateurs === null) {
            $erreur = "Erreur lors de la récupération des utilisateurs";
        } else {
            $utilisateurTrouve = false;
            foreach($utilisateurs as &$utilisateur){
                if($utilisateur['email'] === $email && password_verify($password, $utilisateur['password'])){
                    $utilisateurTrouve = true;
                    $_SESSION['email'] = $email;
                    header("Location: dashboard.php");
                    exit();
                }
            }
            
            if(!$utilisateurTrouve){
                $erreur = "Email ou mot de passe incorrect";
            }
        }   
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Connexion</title>
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
        <h1>Connexion</h1>
        <form method="POST" action="connexion.php">
            <label for="email">Adresse e-mail :</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Se connecter">
            <a href="inscription.php">Pas encore inscrit ? Inscrivez-vous ici</a>
        </form>
    </div>
</body>
</html>