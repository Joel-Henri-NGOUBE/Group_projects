<?php
if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $id = $_GET["id"];
    $pdo = new PDO("mysql:host=localhost;bdname=oui", "root", "");
    $stmt = $pdo->prepare("UPDATE evenements SET statut = 'annule' WHERE id = :id");
    $stmt->execute([$id]);
    header("Location: index.php");
    exit;
}
?>