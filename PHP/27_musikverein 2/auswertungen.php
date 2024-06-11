<?php
/*
Auswertungen laut Angabe
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

    <h1>Auswertungen</h1>

    <?php
    // Fehlermeldungen anzeigen
    include 'utils/errormessages.inc.php';
    ?>


    <h2>Zeigen Sie wie viele Mitarbeiter im Verein registriert sind:</h2>
    <p>Lade alle User und gebe den count() aus:</p>
    <?php
    $users = $userService->getUsers();
    echo '<p>Im Verein sind '.count($users).' Mitglieder registriert.</p>'
    ?>


    <h2>Welches Instrument (Kenntnis) wird von den meisten Mitgliedern beherrscht?</h2>
    <?php
    $skill = $skillService->getSkillWithMaxUsers();
    if($skill === false){
        echo '<p><strong>Es wurde noch keinem Mitglied ein Skill zugewiesen!</strong></p>';
    } else {
        echo '<p>Die Fähigkeit die von den meisten Usern beherrscht wird ist '.htmlspecialchars($skill->name).'</p>';
    }
    ?>


    <h2>Zeigen Sie für jedes Instrument wie viele Mitglieder es spielen können?</h2>
    <table>
        <thead>
            <tr>
                <th>Skill-ID</th>
                <th>Skill-Name</th>
                <th>Mitglieder-Counter</th>
            </tr>
        </thead>
        <tbody>
    	<?php
        $userPerSkill = $skillService->getUsersPerSkill();
        foreach($userPerSkill as $key => $value){
            echo '<tr>';
            echo '<td>'.htmlspecialchars($value->skill->id).'</td>';
            echo '<td>'.htmlspecialchars($value->skill->name).'</td>';
            echo '<td>'.htmlspecialchars($value->userCount).'</td>';
            echo '</tr>';
        }
        ?>
        </tbody>
    </table>


    <h2>Welche ist die beliebteste Veranstaltung?</h2>
    <?php 
    $eventWithMaxParticipants = $eventService->getEventWithMaxParticipation();
    if($eventWithMaxParticipants === false){
        echo '<p>Es gibt keine Veranstaltung mit Teilnehmern!</p>';
    } else {
        echo '<p>Die beliebteste Veranstaltung ist '
            .htmlspecialchars($eventWithMaxParticipants->event->title)
            .' mit '.$eventWithMaxParticipants->count.' Teilnehmern.</p>';
    }
    ?>
    <?php

    ?>

    <h2>Welche Veranstaltungen haben noch keine Teilnehmer?</h2>
    <?php  
    $eventsWithNoParticipants = $eventService->getEventsWithNoParticipants();
    if(count($eventsWithNoParticipants) == 0){
        echo '<p>Alle Veranstaltungen haben Teilnehmer!</p>';
    }
    foreach($eventsWithNoParticipants as $event)
    {
        echo '<p>Veranstaltung ohne Teilnehmer: '.htmlspecialchars($event->title).'</p>';
    }
    ?>

    <h2>Wie viele Mitglieder sind jünger als 18 Jahre?</h2>
    <p>Es gibt <?php echo $userService->getNumberOfUsersAgedBelow18(); ?> Mitglieder die jünger als 18 Jahre sind.</p>
    
    
    <h2>Zeigen Sie das durchschnittliche Alter aller Mitglieder?</h2>
    <?php
    $avgAge = $userService->getAverageUserAge();
    echo "<p>Das Durchschnittsalter aller Mitglied ist $avgAge Jahre.</p>";
    ?>


    <h2>Wie viele Administratoren gibt es? Zeigen Sie auch deren Name und E-Mail Adresse.</h2>
    <?php
    // Lade Admins
    $admins = $userService->getAdmins();
    echo '<p>Es gibt '.count($admins).' Administratoren!</p>';
    ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
        <?php
        foreach($admins as $admin){
            echo '<tr>';
            echo '<td>'.htmlspecialchars($admin->id).'</td>';
            echo '<td>'.htmlspecialchars($admin->firstname . ' ' . $admin->lastname).'</td>';
            echo '<td>'.htmlspecialchars($admin->email).'</td>';
            echo '</tr>';
        }
        ?>
        </tbody>
    </table>
</main>

</body>
</html>