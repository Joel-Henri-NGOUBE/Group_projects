<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
	<title>Page de connexion</title>
</head>
<body>
	<div style="display: flex; justify-content: center;">
	<h1>Page de connexion</h1>
	</div>

	<div style="display: flex; justify-content: center;">
	<form method="post" action="">
		<label for="email">Adresse e-mail :</label>
		<input type="email" id="email" name="email" required><br>

		<label for="password">Mot de passe:</label>
		<input type="password" id="password" name="password" required><br>

		<button type="submit">Se connecter</button><br>
		<a href="inscription.html">Pas encore inscrit ? Inscrivez-vous ici</a>
	</form>
	</div>
	<?php
		$erreur = "";
		$email = isset($_POST["email"]) ? $_POST["email"] : "";
		$password = isset($_POST["password"]) ? $_POST["password"] : "";

		if(empty($email) || empty($password)){
			$erreur = "Veuillez remplir tous les champs";
		}

		if(!file_exists("utilisateurs.json")){
			$erreur = "Aucun utilisateur enregistré";
		}

		if ($erreur == "") {
			$utilisateurs = json_decode(file_get_contents("utilisateurs.json"));
			$utilisateurTrouve = false;

			foreach($utilisateurs as $utilisateur){
    			if($utilisateur->email === $email && password_verify($password, $utilisateur->password)){
        		$utilisateurTrouve = true;
        		break;
    			}
			}

			if(!$utilisateurTrouve){
   				 $erreur = "Email ou mot de passe incorrect";
			} else {
    			header("Location: page_d'accueil.php");
    			exit();
			}	

		}
	?>
	<?php if ($erreur != "") : ?>
			<div style="text-align:center;">
				<p><?php echo $erreur ?></p>
			</div>
	<?php endif; ?>
</body>
</html>