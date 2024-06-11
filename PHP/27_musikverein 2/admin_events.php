<?php
/*
Diese Seite ist für Administratoren um Events anzulegen, zu bearbeiten, und zu löschen

Diese Seite enthält den Upload einer Bild-Datei: 
Bei einem Formular mit Datei-Upload muss der "enctype" gesetzt werden:
enctype="multipart/form-data"
*/

// Hier sind alle Includes, die DB-Conn, sowie das Erzeugen der Service-Objekte enthalten
require_once 'utils/maininclude.inc.php';

// Seite darf nur von Admins geöffnet werden
$userService->redirectIfNotAdmin();

// Alle EventTypes laden um diese in der HTML Selectbox darzustellen
// $eventTypes ist ein Array von Objekten der Klasse EventType
$eventTypes = $eventService->getEventTypes();

// Alle Events laden um diese in der Tabelle darzustellen
// $events ist ein Array von Objekten der Klasse Event
$events = $eventService->getEvents();

$errors = [];

// Soll ein neues Event angelegt werden?
if(isset($_POST['bt_create_event']))
{
    $title = trim($_POST['title']);
    $dateAndTime = trim($_POST['date_and_time']);
    $eventTypeId = $_POST['eventtype_id'];

    $eventDate = DateTime::createFromFormat('d.m.Y H:i', $dateAndTime);

    /*
    Formularvalidierung
    */
    if($title == NULL || strlen($title) == 0){
        $errors[] = 'Titel eingeben!';
    }
    if($dateAndTime == NULL || strlen($dateAndTime) == 0){
        $errors[] = 'Zeitpunkt eingeben!';
    } else if($eventDate == FALSE){
        $errors[] = 'Zeitpunkt Format ungültig!';
    }
    if($eventTypeId == NULL || strlen($eventTypeId) == 0){
        $errors[] = 'Eventtyp wählen!';
    }

    /*
    Datei-Upload
    */
    // Die hochgeladene Datei soll im uploads-Ordner gespeichert werden
    $filename = $_FILES['imagefile']['name'];
    $uploaddir = 'uploads\\';
    // wo soll die hochgeladene Datei hingespeichert werden?
    $uploadpath = $uploaddir . $filename;

    // verschiebt die hochgeladene Datei vom temporären Upload-Ordner in 
    // unseren Upload-Ordner
    if(move_uploaded_file($_FILES['imagefile']['tmp_name'], $uploadpath))
    {
        // alles OK mit der Datei!
    } else {
        // Beim Upload gab es ein Problem!
        $errors[] = 'Upload fehlgeschlagen. Keine Datei?'; 
    }


    // Prüfen ob es bei der Formularvalidierung keine Fehler gab
    if(count($errors) == 0){
        $eventId = $eventService->createEvent($title, $eventDate, 
                                            $eventTypeId, $uploadpath, $filename);
        header('Location: ./admin_events.php?created_event_id='.$eventId);
        return;
    }
}


// Wurde der Löschen-Button in der Event-Tabelle gedrückt?
if(isset($_POST['bt_delete_event']))
{
    $eventId = $_POST['event_id'];
    $eventService->deleteEvent($eventId);
    header('Location: ./admin_events.php?deleted_event_id='.$eventId);
    return;
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Veranstaltungen</title>
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

    <h1>Veranstaltungen (Admin-Übersicht)</h1>
    <?php
    // Ausgabe der Fehlermeldungen
    include 'utils/errormessages.inc.php';
    ?>
    <h2>Veranstaltung anlegen</h2>
    <form action="admin_events.php" method="POST" enctype="multipart/form-data">
        <label>Name</label><br>
        <input type="text" name="title"><br>

        <label>Zeitpunkt (TT.MM.JJJJ HH:MM)</label><br>
        <input type="text" name="date_and_time"><br>

        <label>Veranstaltungstyp</label><br>
        
        <p>
        <select name="eventtype_id">
            <?php 
            // für jeden EventType eine SELECT-Option generieren
            foreach($eventTypes as $eventType)
            {
                echo '<option value="'.$eventType->id.'">' . htmlspecialchars($eventType->name) . '</option>';
            }
            ?>
        </select>
        </p>

        <p>
        <label>Bild upload:</label>
        <input type="file" name="imagefile"><br>
        </p>

        <button name="bt_create_event">Veranstaltung anlegen</button>

    </form>


    <h2>Events</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Titel</th>
                <th>Zeitpunkt</th>
                <th>Veranstaltungstyp</th>
                <th>Bild</th>
                <th>Bearbeiten</th>
                <th>Löschen</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        foreach($events as $e)
        {
            echo '<tr>';
            echo '<td>'.htmlspecialchars($e->id).'</td>';
            echo '<td>'.htmlspecialchars($e->title).'</td>';
            echo '<td>'.htmlspecialchars($e->date_and_time->format('d.m.Y H:i')).'</td>';

            // für die EventType-ID den Namen des EventTypes darstellen!
            // Dazu zuerst EventType anhand der im Event hinterlegten EventTypeId suchen!
            $eventType = $eventService->getEventTypeById($e->eventtype_id);
            echo '<td>'.htmlspecialchars($eventType->name).'</td>';

            // Bild darstellen
            // im Event wurde der Dateiname des Bildes gespeichert
            echo '<td><img style="max-width: 200px;" src="uploads/'.$e->img_filename.'"></td>';
            

            // Bearbeiten-Link
            // Die ID des Events als GET-Parameter an die Seite übergeben!
            echo '<td><a href="admin_update_event.php?id='.$e->id.'">Bearbeiten</a></td>';


            // Löschen-Button
            echo '<td>
            <form action="admin_events.php" method="POST">
                <input type="hidden" name="event_id" value="'.$e->id.'">
                <button name="bt_delete_event">Löschen</button>
            </form>
            </td>';


            echo '</tr>';
        }
        ?>
        </tbody>
    </table>

</main>

</body>
</html>