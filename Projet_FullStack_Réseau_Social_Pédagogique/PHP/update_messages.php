<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: connexion.php");
    exit();
}

$currentEmail = $_SESSION['email'];

$users = json_decode(file_get_contents('users.json'), true);

$currentUser = null;
foreach ($users as $index => $user) {
    if ($user['email'] === $currentEmail) {
        $currentUser = &$users[$index];
        break;
    }
}

$selectedUser = null;
if (isset($_GET['user'])) {
    $selectedEmail = urldecode($_GET['user']);
    foreach ($users as $user) {
        if ($user['email'] === $selectedEmail) {
            $selectedUser = $user;
            break;
        }
    }
}

$response = [
    'currentUser' => $currentUser,
    'selectedUser' => $selectedUser
];

header('Content-Type: application/json'); 
echo json_encode($response);
?>
