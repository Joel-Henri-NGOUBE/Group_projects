<?php
// $a = ["bonjour" => "1"];
// var_dump($a);
// $a[] = ["bonsoir" => "2"];
// $a[] = ["bonne après-midi" => "3"];
// var_dump($a);
// $a = [[0] => "pourpre"];
// var_dump($a);







$user= "root";
$password1 = "";
$pdo = new PDO("mysql:host=localhost:3306;dbname=application", $user , $password1);

$request3 = $pdo->prepare("SELECT friend_id FROM relationships WHERE id = 1");
$request3->execute([
            // ":id" => 2,
            // ":un" => 1
            ]);
$result3 = $request3->fetchAll(PDO::FETCH_ASSOC);

// var_dump($result3);
// echo count($result3);
// $result4 = [$result3,$result3];
// $result4 = [$result4,$result3];
// var_dump($result4);
for ($i = 0; $i <= 5; $i++){
    $result4[] = $result3;
}
var_dump($result4);



// $result3 = ["type" => "image/jpeg"];
// $ext = str_replace("/",".",strrchr($result3["type"],"/"));
// echo $ext;

// $request1 = $pdo->prepare("SELECT * FROM publications WHERE id_user = :id");
// $request1->execute([
// ":id" => 2
// ]);
// $result1 = $request1->fetchAll(PDO::FETCH_ASSOC);

// var_dump($result1);








// $_FILES["fichier"]["tmp_name"];
//$image = move_uploaded_file(rename($_FILES["fichier"]["tmp_name"],"image1.svg"),'Projet_FullStack/');
//$a = file_get_contents("./plus.png");
//echo $a;
//header("Content-type: image/png")
?> 
<!-- <img src="<?php //echo $a ?>" alt=""> -->
<form method="POST" enctype="multipart/form-data">
    <input type="file" name="fichier">
    <input type="submit" value="Donner un fichier">
</form>
