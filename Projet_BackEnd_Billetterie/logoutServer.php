<?php 
$data = FILTER_INPUT(INPUT_GET,"body");
$data = json_decode($data,true);

$user= "root";
$password1 = "";


if (array_key_exists("Jeton",$data) && count(array_keys($data)) == 1){
    
 $pdo = new PDO("mysql:host=localhost:3306;dbname=connexion", $user , $password1);
 $request1 = $pdo->prepare("SELECT chips_user FROM chips WHERE chips_user = :jeton");
 $request1->execute([
 ":jeton" => $data["Jeton"]
 ]);
 $result1 = $request1->fetch(PDO::FETCH_ASSOC);

 if ($result1){
    $request2 = $pdo->prepare("UPDATE chips SET chips_user = :rien WHERE chips_user = :jeton");
    $request2->execute([
        ":rien" => "",
        ":jeton" => $data["Jeton"]
        ]);
    echo json_encode(["Statut" => "Succès", "Message" => "Vous êtes bien déconnecté"]);
    exit();
 }
 else {
    echo json_encode(["Statut" => "Erreur", "Message" => "Jeton inconnu: Intrusion"]);
    exit();
 }

}

else if (array_key_exists("Jeton",$data) && array_key_exists("Origin",$data) && count(array_keys($data)) == 2){
    $request3 = $pdo -> prepare("SELECT chips_user FROM chips WHERE chips_user = :jeton");
    $request3 -> execute([
    ":jeton" => $data["Jeton"]
    ]);
    $result3 = $request3->fetch(PDO::FETCH_ASSOC);
   
    if ($result3){
       echo json_encode(["Statut" => "Succès", "Message" => "Vous êtes bien déconnecté"]);
       exit();
    }
    else {
       echo json_encode(["Statut" => "Erreur", "Message" => "Jeton inconnu: Intrusion"]);
       exit();
    }

}

else{
echo json_encode(["Statut" => "Erreur", "Message" => "JSON incorrect"]);
exit();
}
?>