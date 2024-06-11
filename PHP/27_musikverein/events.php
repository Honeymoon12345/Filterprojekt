<?php
// Bei einem Formular mit Datei-Upload muss der "enctype" gesetzt werden mit enctype="multipart/form-data"
require_once 'utils/maininclude.inc.php';

$eventTypes = $eventService->getEventTypes();

$errors = [];

if(isset($_POST['bt_create_event']))
{
    $title =trim($_POST['title']);
    $dateAndTime = trim($_POST['date_and_time']);
    $eventTypeId = $_POST['eventtype_id'];

    $eventDate = DateTime::createFromFormat('Y.m.d H:i', $dateAndTime);

    //Die hochgeladene Datei soll im upoads-Ordner gespeichert werden
    $filename = $_FILES['imagefile']['name'];
    $uploaddir = 'uploads\\';
    //wo soll die hochgeladene Datei gespeichert werden?
    $uploadpath = $uploaddir . $filename;

    //verschiebt die hochgeladen Datei in unseren Upload-Ordner
    if(move_uploaded_file($_FILES['imagefile']['tmp_name'], $uploadpath))
    {

    }else {
        $errors[] = 'Upload fehlgeschlagen.';
    }
}

// DB-Verbindung aufbauen und in der Variable $conn speichern
$conn = db_connection();


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

    <h1>Veranstaltungen</h1>
    //Ausgabe der Fehlermeldungen
    <h2>Veranstaltung anlegen</h2>
    <form action="events.php" method="POST" enctype="multipart/form-data">
        <label>Name</label><br>
        <input type="text" name="title"><br>

        <label>Zeitpunkt (TT.MM.JJJJ HH:MM)</label><br>
        <input type="text" name="date_and_time"><br>

        <label>Veranstaltungstyp</label><br>
        <select name="eventtype_id">
            <?php
            //für jeden EventType eine SELECT-Option generieren
            foreach($eventTypes as $eventType)
            {
                echo '<option value="'.$eventType->id.'">' . htmlspecialchars($eventType->name) . '</option>';
            }
            ?>
        </select>

        <label>Bild upload:</label><br>
        <input type="file" name="imagefile"><br>
        <button name="bt_create_event">Veranstaltung anlegen</button>
    </form>

</main>

</body>
</html>