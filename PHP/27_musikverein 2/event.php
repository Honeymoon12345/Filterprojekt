<?php
/*
Zeigt angemeldeten Usern die Details zu einem Event an.
Enthält das Formular zur Anmeldung eines Users zu einem Event.
Zeigt an welche User an diesem Event teilnehmen.
Welches Event dargestellt werden soll, wird als GET-Parameter "id" übergeben
*/

// Hier sind alle Includes, die DB-Conn, sowie das Erzeugen der Service-Objekte enthalten
require_once 'utils/maininclude.inc.php';

$errors = [];

// User muss angemeldet sein um die Seite aufrufen zu können.
$userService->redirectIfNotLoggedIn();

// Prüfen ob die ID des Events als GET-Parameter angegeben wurde
if(!isset($_GET['id']) || !is_numeric($_GET['id']))
{
    exit('GET-Parameter ID fehlt oder ist keine Zahl!');
}

$eventId = trim($_GET['id']);

// Lade Event anhand der ID aus der Datenbank
$event = $eventService->getEventById($eventId);
if($event === FALSE){
    exit('Event nicht gefunden!');
}

// Lade Teilnehmer für dieses Event
$participants = $eventService->getEventParticipants($event->id);

// Möchte sich der aktuelle User zu diesem Event anmelden?
if(isset($_POST['bt_participate']))
{
    // Der aktuelle User möchte sich zu diesem Event anmelden
    // Aktuellen User herausfinden:
    $user = $userService->getLoggedInUser();

    // Diesen User zum Event anmelden
    $eventService->participateEvent($eventId, $user->id);

    header("Location: event.php?id=$event->id&participation=true");
    return; 
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Event</title>
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

    <p>
        Woher weiß die Seite welches Event dargestellt werden soll? Die Event-ID wird
        als GET-Parameter "id" in der URL übertragen. Diese ID wird ausgelesen, und das 
        Event mit dieser ID wird aus der Datenbank geladen.
    </p>

    <h1>Event: <?php echo $event->title; ?></h1>
    <?php
        include 'utils/errormessages.inc.php';

        // GET-Parameter participation wird gesetzt wenn Anmeldung erfolgreich war!
        if(isset($_GET['participation']))
        {
            echo '<p><strong>Anmeldung erfolgreich!</strong></p>';
        }
    ?>
    <p>
        <?php echo $eventService->getEventTypeById($event->eventtype_id)->name; ?>
    </p>

    <p>
        <img style="max-width:100%" src="uploads/<?php echo $event->img_filename; ?>">
    </p>

    <p>
        Veranstaltungsbeginn: <?php echo $event->date_and_time->format('d.m.Y H:i:s'); ?>
    </p>

    <h2>Anmeldung</h2>
    <p>Möchtest Du dich zu dieser Veranstaltung anmelden?</p>
    <p>Für die Anmeldung wird die Zwischentabelle "participation" mit der Event-ID und der User-ID befüllt.</p>
    <p>Die Event-ID wird als GET-Parameter übertragen, als User-ID wird die ID des aktuell angemeldeten 
        User verwendet. 
    </p>
    <form action="event.php?id=<?php echo htmlspecialchars($event->id); ?>" method="POST">
        <button name="bt_participate">Teilnehmen</button>
    </form>

    <h2>Teilnehmer</h2>
    <p>Wer hat sich bereits zu dieser Veranstaltung angemeldet?</p>
    <?php
    echo '<p>Diese Veranstaltung hat '.count($participants).' Teilnehmer.</p>';
    if(count($participants) == 0){
        echo '<p><strong>Diese Veranstaltung hat noch keine Teilnehmer :(</strong></p>';
    }
    foreach($participants as $p){
        echo '<p>' . htmlspecialchars($p->firstname . ' ' . $p->lastname) . '</p>';
    }
    ?>


</main>

</body>
</html>