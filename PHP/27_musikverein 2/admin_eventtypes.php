<?php
/*
- Enthält ein Formular zum Erstellen eines neuen EventTypes
- Listet alle EventTypes tabellarisch auf mit Link zur Bearbeiten-Seite
  sowie Button um einen EventType zu löschen
*/

// Hier sind alle Includes, die DB-Conn, sowie das Erzeugen der Service-Objekte enthalten
require_once 'utils/maininclude.inc.php';

// Seite darf nur von Admins geöffnet werden
$userService->redirectIfNotAdmin();

// Lade alle EventTypes zur Darstellung in der Tabelle (unten im HTML)
$eventTypes = $eventService->getEventTypes();

$errors = [];
// Soll ein neuer EventType erstellt werden?
if(isset($_POST['bt_create_event_type']))
{
    $name = trim($_POST['name']);
    if($name == NULL || strlen($name) == 0){
        $errors[] = 'Name eingeben!';
    }

    if(count($errors) == 0){
        $eventTypeId = $eventService->createEventType($name);
        header('Location: ./admin_eventtypes.php?created_event_type_id='.$eventTypeId);
        return;
    }
}

// Soll ein EventType gelöscht werden?
if(isset($_POST['bt_delete_event_type']))
{
    $eventTypeId = $_POST['event_type_id'];
    $eventService->deleteEventType($eventTypeId);
    header('Location: ./admin_eventtypes.php?deleted_event_type_id='.$eventTypeId);
    return;
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

    <h1>Event Types (Veranstaltungsarten)</h1>
    <?php
    // Fehlermeldungen $errors darstellen
    include 'utils/errormessages.inc.php';
    ?>
    <h2>Neue Veranstaltungsart hinzufügen</h2>
    <form action="admin_eventtypes.php" method="POST">
        <label>Name:</label><br>
        <input type="text" name="name"><br>
        <button name="bt_create_event_type">Erstellen</button>
    </form>

    <h2>Event Types</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Bearbeiten</th>
                <th>Löschen</th>
            </tr>
        </thead>
        <tbody>
        <?php
        foreach($eventTypes as $e)
        {
            echo '<tr>';
            
            echo '<td>' . htmlspecialchars($e->id) .'</td>';
            echo '<td>' . htmlspecialchars($e->name) .'</td>';

            // Bearbeiten-Link
            echo '<td><a href="admin_update_eventtype.php?id=' . $e->id .'">Bearbeiten</a></td>'; 

            // Löschen-Button
            echo '<td>';
            echo '<form action="admin_eventtypes.php" method="POST">';
            echo '<input type="hidden" name="event_type_id" value="'.$e->id.'">';
            echo '<button name="bt_delete_event_type">Löschen</button>';
            echo '</form>';
            echo '</td>';

            echo '</tr>';
        }
        ?>
        </tbody>
    </table>

</main>

</body>
</html>