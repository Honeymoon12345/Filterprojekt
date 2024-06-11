<?php
/*
Darstellung aller Events für die Mitglieder
*/

// Hier sind alle Includes, die DB-Conn, sowie das Erzeugen der Service-Objekte enthalten
require_once 'utils/maininclude.inc.php';

// User muss angemeldet sein um die Seite aufrufen zu können.
$userService->redirectIfNotLoggedIn();

// Lade alle Events um sie unten im HTML in der Tabelle darstellen zu können
$events = $eventService->getEvents();


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Eventübersicht</title>
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

    <h1>Eventübersicht</h1>
    <p>Wähle eine Veranstaltung aus um dich anzumelden!</p>
    <?php 
    if(count($events) == 0){
        echo '<p><strong>Es gibt noch keine Veranstaltungen - ein Admin muss diese erst eintragen!</strong></p>';
    }
    ?>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Titel</th>
                <th>Wann?</th>
                <th>Bild</th>
                <th>Details und Anmeldung</th>
            </tr>
        </thead>
        <tbody>
        <?php
        foreach($events as $event)
        {
            echo '<tr>';

            echo '<td>'.htmlspecialchars($event->id).'</td>';
            echo '<td>'.htmlspecialchars($event->title).'</td>';
            echo '<td>'.htmlspecialchars($event->date_and_time->format('d.m.Y H:i')).'</td>';
            echo '<td><img style="max-width:200px" src="uploads/'.$event->img_filename.'"></td>';
            echo '<td><a href="event.php?id='.$event->id.'">Zur Veranstaltung</a></td>';

            echo '</tr>';
        }
        ?>
        </tbody>
    </table>

</main>

</body>
</html>