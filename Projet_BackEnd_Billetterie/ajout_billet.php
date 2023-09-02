<?php

 $host = "localhost";
 $nom_bdd = "oui";
 $utilisateur = "root";
 $mot_de_passe = "";
 
 try {
     $pdo = new PDO("mysql:host=$host;dbname=$nom_bdd", $utilisateur, $mot_de_passe);
     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 } catch(PDOException $e) {
     echo "Erreur de connexion à la base de données: " . $e->getMessage();
 }

?>

<form method="POST" action="creation_billet.php">
    <label for="nom_prenom">Nom et prénom :</label>
    <input type="text" name="nom_prenom" id="nom_prenom" required>
    
    <label for="nom_evenement">Nom de l'événement :</label>
		<select name="nom_evenement" id="nom_evenement">
			<?php
			try {
				$pdo = new PDO('mysql:host=localhost;dbname=oui;charset=utf8', 'root', '');
			} catch (PDOException $e) {
				echo 'Connexion échouée : ' . $e->getMessage();
				exit;
			}
			
			$sql = "SELECT DISTINCT nom FROM evenements where statut = 'ouvert'";
			$requete = $pdo->query($sql);
			
			while ($row = $requete->fetch(PDO::FETCH_ASSOC)) {
				echo '<option value="' . $row['nom'] . '">' . $row['nom'] . '</option>';
			}
			?>
		</select>
    
    <label for="date_evenement">Date de l'événement :</label>
    <input type="date" name="date_evenement" id="date_evenement" required>
    
    <button type="submit">Ajouter</button>
</form>
