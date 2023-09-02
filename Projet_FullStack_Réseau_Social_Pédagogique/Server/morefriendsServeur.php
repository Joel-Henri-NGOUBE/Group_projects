<?php
$json = FILTER_INPUT(INPUT_POST,"body");
$json = json_decode($json,true);
// session_start();
// $json = ["id" => $_SESSION["id"]];


$user= "root";
$password1 = "";
$pdo = new PDO("mysql:host=localhost:3306;dbname=application", $user , $password1);

$request1 = $pdo->prepare("SELECT username FROM users WHERE id = :id");
$request1->execute([
            ":id" => $json["id"]
            ]);
$result1 = $request1->fetch(PDO::FETCH_ASSOC);
// var_dump($result1);


$request2 = $pdo->prepare("SELECT username FROM users WHERE username <> :username");
$request2->execute([
            ":username" => $result1["username"]
            ]);
$result2 = $request2->fetchAll(PDO::FETCH_ASSOC);
$lenght = count($result2);
// var_dump($result2);
if($lenght > 15){
    $limit = 15;
}
else{
    $limit = $lenght;
}
$array = [$json["id"]];
// echo json_encode(["in" => in_array(1,$array)]);
// echo json_encode(["in" => in_array(2,$array)]);
// echo json_encode(["in" => in_array(3,$array)]);
// echo $limit;
// $num = 0;
for($i = 0; $i <= $limit -1; $i++){
$num = rand(1,$lenght+1);
while (in_array($num,$array,true) || $num == $json["id"] && count($array) != $limit){
    $num = rand(1,$lenght+1);
}
$array[] = $num;
}
// var_dump($array);
for($i = 1; $i <= count($array) - 1; $i++){
$request3 = $pdo->prepare("SELECT username,id FROM users WHERE id = :id");
$request3->execute([
            ":id" => $array[$i]
            ]);
$result3 = $request3->fetch(PDO::FETCH_ASSOC);
$result4[] = $result3;
}
echo json_encode(["Statut" => "Succès", "Message" => $result4]); 
exit();
?>