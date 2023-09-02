<?php
session_start();
$id = $_SESSION["id"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $id; // Remplacez par l'identifiant de l'utilisateur

    // Connexion à la base de données
    $bdd = "mysql:host=localhost;dbname=application";
    $user = "root";
    $mdp = "";
    
    try {
        $pdo = new PDO($bdd, $user, $mdp);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Traitement des données du formulaire
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $birth_date = $_POST['birth_date'];
        $password = $_POST['password'];
        $username = $_POST['username'];
        
        

        // Gestion des fichiers uploadés (banner et profile_pic)
        $uploadDir = __DIR__ . '/uploads/';

        // Traitement de la bannière
        if (!empty($_FILES['banniere']['tmp_name'])) {
            $ext = str_replace("/",".",strrchr($_FILES['banniere']['type'],"/"));
            move_uploaded_file(rename($_FILES['banniere']['tmp_name'],"banniere".$ext),"Projet_FullStack/");
            // $bannerName = $_FILES['banniere']['name'];
            // $bannerName = str_replace(' ', '_', $bannerName); // Remplace les espaces par des underscores (_)
            // $bannerPath = $uploadDir . basename($bannerName);
            // if (move_uploaded_file($_FILES['banniere']['tmp_name'], $bannerPath)) {
            //     echo "La bannière a été téléchargée avec succès.";
            // } else {
            //     echo "Erreur lors du téléchargement de la bannière.";
            // }
        }

        // Traitement de la photo de profil
        if (!empty($_FILES['photo_profil']['tmp_name'])) {
            $ext = str_replace("/",".",strrchr($_FILES['photo_profil']['type'],"/"));
            move_uploaded_file(rename($_FILES['photo_profil']['tmp_name'],"photodeprofil".$ext),"Projet_FullStack/");
            
            
            // $profilePicName = $_FILES['photo_profil']['name'];
            // $profilePicName = str_replace(' ', '_', $profilePicName); // Remplace les espaces par des underscores (_)
            // $profilePicPath = $uploadDir . basename($profilePicName);
            // if (move_uploaded_file($_FILES['photo_profil']['tmp_name'], $profilePicPath)) {
            //     echo "La photo de profil a été téléchargée avec succès.";
            // } else {
            //     echo "Erreur lors du téléchargement de la photo de profil.";
            // }
        }


        // Requête UPDATE pour mettre à jour les données de l'utilisateur
        $query = "UPDATE users SET ";
        $params = array();

        if (!empty($first_name)) {
            $query .= "first_name = :first_name, ";
            $params['first_name'] = $first_name;
        }

        if (!empty($last_name)) {
            $query .= "last_name = :last_name, ";
            $params['last_name'] = $last_name;
        }

        if (!empty($email)) {
            $query .= "email = :email, ";
            $params['email'] = $email;
        }

        if (!empty($birth_date)) {
            $query .= "birth_date = :birth_date, ";
            $params['birth_date'] = $birth_date;
        }

        if (!empty($bannerName)) {
            $query .= "banner = :banner, ";
            $params['banner'] = $bannerName;
        }

        if (!empty($profilePicName)) {
            $query .= "profile_pic = :profile_pic, ";
            $params['profile_pic'] = $profilePicName;
        }

        // Supprimer la virgule et l'espace supplémentaires à la fin de la requête
        $query = rtrim($query, ", ");

        // Ajouter la clause WHERE
        $query .= " WHERE id = :id";
        $params['id'] = $user_id;

        // Préparation de la requête
        $requete = $pdo->prepare($query);

        // Liaison des paramètres
        foreach ($params as $key => $value) {
            $requete->bindValue(':' . $key, $value);
        }

        // Exécution de la requête
        $requete->execute();

        echo "Les données ont été mises à jour avec succès.";

        // Redirection vers la page de modification du profil
        header("Location: modification_profil.php");
        echo "Les données ont été mises à jour avec succès.";
        exit();
    } catch (PDOException $e) {
        echo "Erreur lors de la mise à jour des données : " . $e->getMessage();
    }
}
?>
