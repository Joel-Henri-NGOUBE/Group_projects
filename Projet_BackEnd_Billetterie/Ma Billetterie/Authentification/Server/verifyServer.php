<?php
$methode = FILTER_INPUT(INPUT_SERVER,"REQUEST_METHOD");
if ($methode == "GET"){
    header("Location: login.php");
}

$json = FILTER_INPUT(INPUT_POST,"body");
$json = json_decode($json,true);

if (!array_key_exists("username",$json) || !array_key_exists("password",$json) || !array_key_exists("jeton",$json) || count(array_keys($json)) != 3){
    echo json_encode(["Statut" => "Erreur", "Message" => "JSON incorrect"]);
    exit();
}

$user= "root";
$password1 = "";
$pdo = new PDO("mysql:host=localhost:3306;dbname=connexion", $user , $password1);
$request1 = $pdo->prepare("SELECT username,password FROM users WHERE username = :username");
$request1->execute([
    ":username" => $json["username"]
    ]);
$result1 = $request1->fetch(PDO::FETCH_ASSOC);

if ($result1){
    if (!(password_verify($json["password"],$result1["password"]))){
        echo json_encode(["Statut" => "Erreur","Message" => "Identifiants incorrects"]);
        exit();
    }
}
else{
    echo json_encode(["Statut" => "Erreur","Message" => "Identifiants incorrects"]);
    exit();
}
// if (!($json["Session"])){
//     echo json_encode(["Statut" => "Erreur", "Message" => "Jeton inconnu"]);
// }

$request2 = $pdo->prepare("SELECT chips_user FROM chips WHERE chips_user = :jeton");
$request2->execute([
":jeton" => $json["jeton"]
]);
$result2 = $request2->fetch(PDO::FETCH_ASSOC);

// Faire une requête et produire un résultat pour les identifiants incorrects

if ($result2){
 echo json_encode(["Statut" => "Succès", "Message" => "Félicitations", "Utilisateur" => ["Identifiant" => $json["username"]]]);
 exit();
}
else{
 echo json_encode(["Statut" => "Erreur", "Message" => "Jeton inconnu"]);
 exit();
}




?>