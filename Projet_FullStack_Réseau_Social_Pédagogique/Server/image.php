<?php $id = FILTER_INPUT(INPUT_GET,"id");

$user= "root";
$password1 = "";
$pdo = new PDO("mysql:host=localhost:3306;dbname=application", $user , $password1);

$request3 = $pdo->prepare("SELECT image,type FROM publications WHERE id = :id");
$request3->execute([
            ":id" => $id
            ]);
$result3 = $request3->fetch(PDO::FETCH_ASSOC);
header("Content-type: ".$result3["type"]);

echo $result3["image"];

?>