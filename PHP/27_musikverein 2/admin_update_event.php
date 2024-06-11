<?php
/*
Administratoren können auf dieser Seite ein Event bearbeiten.
Die ID des zu bearbeitenden Event wird als GET-Parameter "id" übergeben.
*/

// Hier sind alle Includes, die DB-Conn, sowie das Erzeugen der Service-Objekte enthalten
require_once 'utils/maininclude.inc.php';

// Seite darf nur von Admins geöffnet werden
$userService->redirectIfNotAdmin();

// Welches Event soll bearbeitet werden? ID aus GET-Parameter einlesen:
$eventId = $_GET['id'];
if($eventId == NULL || strlen($eventId) == 0 || !is_numeric($eventId)){
    exit('GET-Parameter "id" fehlt oder ist ungültig!');
}
// Lade Event, $event ist ein Objekt der Klasse Event 
$event = $eventService->getEventById($eventId);
if($event === FALSE){
    exit('Event nicht gefunden!');
}

// Lade EventTypes für die Auswahl im HTML Select
$eventTypes = $eventService->getEventTypes();

$errors = [];

// Sollen Event-Daten (ohne Bild) aktualisiert werden?
if(isset($_POST['bt_update_event']))
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

    if(count($errors) == 0){
        // Werte im Objekt aktualisieren
        $event->title = $title;
        $event->date_and_time = $eventDate;
        $event->eventtype_id = $eventTypeId;

        // Über EventService in der Datenbank aktualisieren
        $eventService->updateEvent($event);

        header('Location: ./admin_events.php?updated_event_id='.$event->id);
        return;
    }
}


// Soll das Bild des Events aktualisiert werden?
if(isset($_POST['bt_update_event_image']))
{
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

    if(count($errors) == 0){
        // Feld im Objekt aktualisieren
        $event->img_filename = $filename;

        // Objekt in der Datenbank aktualisieren
        $eventService->updateEvent($event);

        header('Location: ./admin_events.php?updated_event_id='.$event->id);
        return;
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Event bearbeiten</title>
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

    <h1>Veranstaltung bearbeiten: <?php echo $event->title; ?></h1>
    <?php
    // Fehlermeldungen
    include 'utils/errormessages.inc.php';
    ?>
    <h2>Veranstaltung aktualisieren</h2>
    <p>Verändert nur die Veranstaltungsdaten, Bild wird nicht aktualisiert.</p>
    <form action="admin_update_event.php?id=<?php echo $event->id; ?>" method="POST" enctype="multipart/form-data">
        <label>Name</label><br>
        <input type="text" name="title" value="<?php echo $event->title; ?>"><br>

        <label>Zeitpunkt (TT.MM.JJJJ HH:MM)</label><br>
        <input type="text" name="date_and_time" value="<?php echo $event->date_and_time->format('d.m.Y H:i'); ?>"><br>

        <label>Veranstaltungstyp</label><br>
        
        <p>
        <select name="eventtype_id">
            <?php 
            // für jeden EventType eine SELECT-Option generieren
            // --> Vorselektieren!
            foreach($eventTypes as $eventType)
            {
                echo '<option value="'.$eventType->id.'"';

                // selected-attribut bei vorselektiertem Element!
                if($event->eventtype_id == $eventType->id){
                    echo ' selected';
                }
                echo '>';

                echo htmlspecialchars($eventType->name);
                echo '</option>';
            }
            ?>
        </select>
        </p>

        <button name="bt_update_event">Veranstaltung aktualisieren</button>

    </form>
    
    <h2>Bild aktualisieren</h2>
    <p>Verändert nur das Bild für die Veranstaltung</p>
    <form action="admin_update_event.php?id=<?php echo $event->id; ?>" method="POST" enctype="multipart/form-data">
        <p>
            <label>Bild upload:</label>
            <input type="file" name="imagefile"><br>
        </p>
        <button name="bt_update_event_image">Bild aktualisieren</button>
    </form>

</main>

</body>
</html>