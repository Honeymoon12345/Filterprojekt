<?php
/*
Willkommen wird nach dem Login angezeigt. 
Zeigt Vor- und Nachname des angemeldeten User an
*/

// Hier sind alle Includes, die DB-Conn, sowie das Erzeugen der Service-Objekte enthalten
require_once 'utils/maininclude.inc.php';

// User muss angemeldet sein um die Seite aufrufen zu können.
$userService->redirectIfNotLoggedIn();

// Aktuellen User laden
$user = $userService->getLoggedInUser();

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Index</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/style.css'>
    <script src='main.js'></script>
</head>
<body>
    
<main class="center-wrapper">

    <?php 
    // Header mit Navigation einbinden
    include 'utils/nav.inc.php'; 
    ?>
    
    <h1>Herzlich willkommen <?php echo htmlspecialchars($user->firstname . ' ' . $user->lastname); ?>!</h1>
</main>

</body>
</html>