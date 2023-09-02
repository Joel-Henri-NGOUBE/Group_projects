<?php
$methode = FILTER_INPUT(INPUT_SERVER,"REQUEST_METHOD");
// if ($methode == "GET"){
//     header("Location: login.php");
// }

$json = filter_input(INPUT_POST,"body");
$json = json_decode($json, true);


if (!array_key_exists("username",$json) || !array_key_exists("password",$json) || !array_key_exists("email",$json) || count(array_keys($json)) != 3){
    echo json_encode(["Statut" => "Erreur", "Message" => "JSON incorrect"]);
    exit();
}

if(!$json["email"] || !$json["username"] || !$json["password"]){
    echo json_encode(["Statut" => "Erreur", "Message" => "Un ou plusieurs champs vides"]);
    exit();
}

if($json["email"] == "Vide"){
    echo json_encode(["Statut" => "Erreur", "Message" => "Adresse mail incorrecte"]);
    exit();
}

$user= "root";
$password1 = "";
$pdo = new PDO("mysql:host=localhost:3306;dbname=application", $user , $password1);


$request1 = $pdo -> prepare("SELECT password,id FROM users WHERE username = :username AND email = :email");
$request1 -> execute([
":username" => $json["username"],
":email" => $json["email"]
]);
$result1 = $request1->fetch(PDO::FETCH_ASSOC);

if ($result1){
    $passtrue = password_verify($json["password"],$result1["password"]);
    if ($passtrue){
        echo json_encode(["Statut" => "Succès", "Message" => $result1["id"]]); 
        exit();
    }
}
else {
    echo json_encode(["Statut" => "Erreur", "Message" => "Identifiants incorrects"]);
    exit();
}
?>