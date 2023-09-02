<?php
$methode = FILTER_INPUT(INPUT_SERVER,"REQUEST_METHOD");
// if ($methode == "GET"){
//     header("Location: login.php");
// }
$json = ["username" => "Junior", "password" => "Junior"];

//$json = filter_input(INPUT_POST,"body");
//$json = json_decode($json, true);


if (!array_key_exists("username",$json) || !array_key_exists("password",$json) || count(array_keys($json)) != 2){
    echo json_encode(["Statut" => "Erreur", "Message" => "JSON incorrect"]);
    exit();
}


$user= "root";
$password1 = "";
$pdo = new PDO("mysql:host=localhost:3306;dbname=connexion", $user , $password1);


$request1 = $pdo -> prepare("SELECT username,password FROM users WHERE username = :username");
$request1 -> execute([
":username" => $json["username"]
]);
$result1 = $request1->fetch(PDO::FETCH_ASSOC);

if ($result1){
    $passtrue = password_verify($json["password"],$result1["password"]);
    if ($passtrue){
        $jeton = bin2hex(strval(random_bytes(15)));
        // echo $jeton;
        $i = 0;
        while ($i == 0){
        $request2 = $pdo->prepare("SELECT chips_user FROM chips WHERE chips_user = :chip");
        $request2-> execute([
        ":chip" => $jeton
        ]);
        $result2 = $request2->fetch(PDO::FETCH_ASSOC);
        if ($result2){
            $jeton = bin2hex(strval(random_bytes(15)));
        }
        else {
            $i = $i + 1;
        }
        }
        echo json_encode(["Statut" => "Succès", "Message" => $jeton]);

        $request3 = $pdo->prepare("SELECT id FROM users WHERE username = :username");
        $request3-> execute([
            ":username" => $json["username"]
            ]);
        $result3 = $request3->fetch(PDO::FETCH_ASSOC);
        // var_dump($result3);
        // $pdo2 = new PDO("mysql:host=localhost:3306;dbname=connexion", $user , $password1);
        
        $request4 = $pdo->prepare("SELECT id_user,chips_user FROM chips WHERE id_user = :id");
        $request4-> execute([
            ":id" => $result3["id"]
            ]);
        $result4 = $request4->fetch(PDO::FETCH_ASSOC);

        // var_dump($result4);
        if ($result4){
            $request5 = $pdo->prepare("UPDATE chips SET chips_user = :jeton WHERE id_user = :id");
            $request5->execute([
                ":jeton" => $jeton,
                ":id" => $result4["id_user"]
        ]);
        }

        else{
        $request6 = $pdo->prepare("INSERT INTO chips VALUES (:id,:jeton)");
        $request6->execute([
            ":id" => $result3["id"],
            ":jeton" => $jeton
            ]);
        }
        exit();
    }
}
else {
    echo json_encode(["Statut" => "Erreur", "Message" => "Identifiants incorrects"]);
    exit();
}
?>