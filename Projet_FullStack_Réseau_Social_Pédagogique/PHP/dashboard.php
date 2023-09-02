<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Tableau de bord</title>
    <style>
        body {
            background-color: #f1f1f1;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .header {
            background-color: #333;
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
        }
        .header h1 {
            margin: 0;
        }
        .header button {
            background-color: #4CAF50;
            border-radius: 5px;
            border: none;
            color: #fff;
            cursor: pointer;
            font-size: 1.2rem;
            padding: 10px 20px;
            transition: background-color 0.3s ease;
        }
        .header button:hover {
            background-color: #3e8e41;
        }
        .container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.2);
            margin: 0 auto;
            max-width: 800px;
            padding: 20px;
            text-align: center;
        }
        h2 {
            color: #555;
            margin: 0;
        }
        button {
            background-color: #4CAF50;
            border-radius: 5px;
            border: none;
            color: #fff;
            cursor: pointer;
            font-size: 1.1rem;
            margin-top: 15px;
            padding: 10px 20px;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #3e8e41;
        }
        .form-group {
            display: flex;
            flex-direction: column;
            margin-top: 20px;
            text-align: left;
        }
        label {
            font-size: 1.1rem;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="date"] {
            border-radius: 5px;
            border: none;
            font-size: 1.1rem;
            padding: 10px;
            margin-top: 5px;
        }
        textarea {
            border-radius: 5px;
            border: none;
            font-size: 1.1rem;
            padding: 10px;
            margin-top: 5px;
            resize: none;
        }
        .success-message {
            background-color: #4CAF50;
            border-radius: 5px;
            color: #fff;
            margin-top: 20px;
            padding: 10px;
            text-align: center;
        }
        .error-message {
            background-color: #f44336;
            border-radius: 5px;
            color: #fff;
            margin-top: 20px;
            padding: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="header">
</div>

<?php
session_start();

if (!isset($_SESSION['email'])) {
    header('Location: connexion.php');
    exit();
}

$loggedInUser = $_SESSION['email'];

$recipient = isset($_GET['recipient']) ? $_GET['recipient'] : '';

if (!empty($recipient) && $recipient !== $loggedInUser) {
    header("Location: messages.php?recipient=$recipient");
    exit();
}
?>

<button onclick="redirectToMessages('<?php echo urlencode($recipient); ?>')">Messages privés</button>

<button onclick="window.location.href='connexion.php'">Se déconnecter</button>

<script>
    function redirectToMessages(recipient) {
        window.location.href = 'messages.php?recipient=' + recipient;
    }
</script>
</body>
</html>