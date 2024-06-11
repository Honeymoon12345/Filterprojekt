<?php
/*
Zeigt einen ausgewählten EventType an
Die ID des ausgewählten EventType wird als GET-Parameter übertragen
Die Seite enthält ein Formular um den gezeigten EventType zu bearbeiten. 
*/

// Hier sind alle Includes, die DB-Conn, sowie das Erzeugen der Service-Objekte enthalten
require_once 'utils/maininclude.inc.php';

// Seite darf nur von Admins geöffnet werden
$userService->redirectIfNotAdmin();

// Welcher EventType soll dargestellt werden?
// --> GET-Parameter "id" einlesen!
$eventTypeId = $_GET['id'];

// Prüfen ob der GET-Parameter gesetzt wurde!
if($eventTypeId == NULL || strlen($eventTypeId) == 0 || !is_numeric($eventTypeId))
{
    exit('GET-Parameter "id" fehlt oder ist ungültig!');
}

// Lade EventType anhand der ID 
$eventType = $eventService->getEventTypeById($eventTypeId);

// Wurde ein EventType gefunden?
// --> wenn nicht, Script abbrechen
if($eventType === FALSE){
    exit('EventType nicht gefunden!');
}

$errors = [];
// Soll ein EventType bearbeitet werden?
if(isset($_POST['bt_update_event_type']))
{
    $name = trim($_POST['name']);
    if($name == NULL || strlen($name) == 0){
        $errors[] = 'Name eingeben!';
    }

    if(count($errors) == 0){

        // Daten im Objekt der Klasse EventType mit den Daten
        // aus dem Formular aktualisieren
        $eventType->name = $name;

        // Das Objekt an die Methode updateEventType übergeben
        // und in der Methode die Daten in der Datenbank aktualisieren lassen
        $eventService->updateEventType($eventType);

        header('Location: ./admin_eventtypes.php?updated_event_type_id='.$eventType->id);
        return;
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Event Types</title>
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

    <h1>Event Type (Veranstaltungsart) bearbeiten</h1>
    <?php
    // Fehlermeldungen $errors darstellen
    include 'utils/errormessages.inc.php';
    ?>
    
    <form action="admin_update_eventtype.php?id=<?php echo htmlspecialchars($eventType->id); ?>" method="POST">
        <label>Name:</label><br>
        <input type="text" name="name" value="<?php echo htmlspecialchars($eventType->name); ?>"><br>
        <button name="bt_update_event_type">Bearbeiten</button>
    </form>

</main>

</body>
</html>