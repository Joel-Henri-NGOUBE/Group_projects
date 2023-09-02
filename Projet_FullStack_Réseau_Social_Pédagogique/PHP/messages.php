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
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $destinataire = isset($_POST['destinataire']) ? $_POST['destinataire'] : '';
    $contenu = isset($_POST['contenu']) ? $_POST['contenu'] : '';
    if ($destinataire !== '' && $contenu !== '') {
        $destinataireTrouve = false;
        foreach ($users as $index => &$user) {
            if ($user['email'] === $currentEmail) {
                $expediteur = &$users[$index];
                $message = [
                    'expediteur' => $currentEmail,
                    'destinataire' => $destinataire,
                    'contenu' => $contenu,
                    'timestamp' => date('Y-m-d H:i:s')
                ];
                $expediteur['messages_envoyes'][] = $message;
                foreach ($users as $destIndex => &$destUser) {
                    if ($destUser['email'] === $destinataire) {
                        $destUser['messages_recus'][] = $message;
                        break;
                    }
                }
                file_put_contents('users.json', json_encode($users, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
                $destinataireTrouve = true;
                header('Location: messages.php?user=' . urlencode($destinataire));
                exit();
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Messagerie</title>
    <link rel="stylesheet" type="text/css" href="messages.css">
    <style>
    </style>
</head>
<body>
    <h1>Messagerie</h1>
    <h2>Liste des utilisateurs</h2>
    <?php displayUsers($users, $currentEmail); ?>
    <?php if ($selectedUser) : ?>
    <h2>Messages avec <?php echo $selectedUser['email']; ?></h2>
    <div class="messages-container" id="messages-container">
        <?php displayMessages($currentUser, $selectedUser); ?>
    </div>
    <h3>Envoyer un message</h3>
    <form method="POST" action="">
        <input type="hidden" name="destinataire" value="<?php echo $selectedUser['email']; ?>">
        <textarea name="contenu" placeholder="Entrez votre message" rows="4" cols="50" onkeydown="sendMessage(event)"></textarea>
        <input type="submit" value="Envoyer">
    </form>
    <?php endif; ?>
    <a href="dashboard.php">Retour au tableau de bord</a>
    <script>
        function updateMessages() {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'update_messages.php?user=' + encodeURIComponent('<?php echo $selectedUser['email']; ?>'), true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    displayMessages(response.currentUser, response.selectedUser);
                    setTimeout(updateMessages, 1000);
                }
            };
            xhr.send();
        }
        function displayMessages(currentUser, selectedUser) {
  var messages = [];
  currentUser.messages_envoyes.forEach(function (message) {
    if (message.destinataire === selectedUser.email) {
      messages.push({
        expediteur: currentUser.email,
        destinataire: selectedUser.email,
        contenu: message.contenu,
        timestamp: message.timestamp
      });
    }
  });
  currentUser.messages_recus.forEach(function (message) {
    if (message.expediteur === selectedUser.email) {
      messages.push({
        expediteur: selectedUser.email,
        destinataire: currentUser.email,
        contenu: message.contenu,
        timestamp: message.timestamp
      });
    }
  });
  messages.sort(function (a, b) {
    return new Date(a.timestamp) - new Date(b.timestamp);
  });
  var container = document.getElementById('messages-container');
  container.innerHTML = '';
  var previousSender = null;
  messages.forEach(function (message) {
    var sender = message.expediteur;
    var content = message.contenu;
    var timestamp = message.timestamp;
    var messageElement = document.createElement('p');
    if (sender !== previousSender) {
      var senderHeader = document.createElement('strong');
      senderHeader.innerText = sender + ' — ' + formatDate(timestamp);
      container.appendChild(senderHeader);
      previousSender = sender; 
    }
    var contentElement = document.createElement('p');
    contentElement.innerText = content;
    messageElement.appendChild(contentElement);

    container.appendChild(messageElement);
    document.getElementById("messages-container").scrollTop = document.getElementById("messages-container").scrollHeight;
  });
}
        function formatDate(timestamp) {
            var dateObj = new Date(timestamp);
            var day = dateObj.getDate();
            var month = dateObj.getMonth() + 1;
            var year = dateObj.getFullYear();
            var hours = dateObj.getHours();
            var minutes = dateObj.getMinutes();

            return day + '/' + month + '/' + year + ' ' + formatTime(hours, minutes);
        }

        function formatTime(hours, minutes) {
            var formattedHours = hours < 10 ? '0' + hours : hours;
            var formattedMinutes = minutes < 10 ? '0' + minutes : minutes;

            return formattedHours + ':' + formattedMinutes;
        }
document.addEventListener("DOMContentLoaded", function() {
    var messageInput = document.querySelector("textarea[name='contenu']");
    var form = document.querySelector("form");

    messageInput.addEventListener("keydown", function(event) {
        if (event.keyCode === 13 && !event.shiftKey) {
            event.preventDefault();
            form.submit();
        }
    });
});
        updateMessages();
    </script>
</body>
</html>
<?php
function displayUsers($users, $currentEmail)
{
    foreach ($users as $user) {
        if ($user['email'] !== $currentEmail) {
            echo '<a href="?user=' . urlencode($user['email']) . '">' . $user['email'] . '</a><br>';
        }
    }
}
function displayMessages($currentUser, $selectedUser)
{
    $uniqueMessages = [];
    foreach ($currentUser['messages_envoyes'] as $message) {
        if ($message['destinataire'] === $selectedUser['email']) {
            $uniqueMessages[] = $message;
        }
    }
    foreach ($selectedUser['messages_recus'] as $message) {
        if ($message['expediteur'] === $selectedUser['email']) {
            $uniqueMessages[] = $message;
        }
    }
    usort($uniqueMessages, function ($a, $b) {
        return strtotime($a['timestamp']) - strtotime($b['timestamp']);
    });
    foreach ($uniqueMessages as $message) {
        $sender = $message['expediteur'];
        $content = $message['contenu'];
        $timestamp = $message['timestamp'];
        echo "<p>$sender — " . date('d/m/Y H:i', strtotime($timestamp)) . "</p>";
        echo "<p>$content</p>";
    }
}
?>