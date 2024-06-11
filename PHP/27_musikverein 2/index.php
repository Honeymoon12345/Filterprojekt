<?php
/*
Startseite
*/

// Hier sind alle Includes, die DB-Conn, sowie das Erzeugen der Service-Objekte enthalten
require_once 'utils/maininclude.inc.php';

$errors = [];

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

    <h1>Index</h1>

    <?php
    if(isset($_GET['require_admin'])){
        $errors[] = 'Keine Admin-Rechte für den Zugriff auf die gewünschte Seite!';
    }

    // Fehlermeldungen anzeigen
    include 'utils/errormessages.inc.php';
    ?>

    <p>Lösung zum Beispiel "<a href="https://docs.google.com/document/d/1lH3oBHD8xhmaspRsStrwnvpqtuiPf4QuvDoASj15FBY/edit?usp=sharing">Musikverein</a>"</p>

</main>

</body>
</html>