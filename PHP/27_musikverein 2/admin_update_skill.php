<?php
/*
Administratoren können auf dieser Seite einen Skill bearbeiten.
Welcher Skill bearbeitet wird, wird anhand des GET-Parameters "skill_id" beim Seitenaufruf übergeben
*/

// Hier sind alle Includes, die DB-Conn, sowie das Erzeugen der Service-Objekte enthalten
require_once 'utils/maininclude.inc.php';

// Seite darf nur von Admins geöffnet werden
$userService->redirectIfNotAdmin();

// Beendet das Script wenn der GET-Parameter mit der Skill-ID fehlt!
if(isset($_GET['skill_id']) === FALSE)
{
    exit('GET-Parameter skill_id fehlt!');
}

$skillId = $_GET['skill_id'];

// Skill mit der ID laden
$skill = $skillService->getSkillById($skillId);
// Prüfen ob Skill gefunden wurde
if($skill === FALSE){
    exit('Skill nicht gefunden!');
}

$errors = [];

if(isset($_POST['bt_update_skill']))
{
    $name = trim($_POST['skill_name']);
    
    if($name == NULL || strlen($name) == 0){
        $errors[] = 'Name eingeben!';
    }

    // wenn es keine Fehler bei der Formularvalidierung gab, dann Update durchführen
    if(count($errors) == 0){
        // im Objekt der Klasse Skill den neuen Namen setzen
        $skill->name = $name;

        $skillService->updateSkill($skill);

        header('Location: ./admin_skills.php');
        return; 
    }
    
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Fähigkeit bearbeiten</title>
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

    <h1>Fähigkeit bearbeiten</h1>
    <form action="admin_update_skill.php?skill_id=<?php echo htmlspecialchars($skillId); ?>" method="POST">
        <label>Name der Fähigkeit:</label><br>
        <input type="text" name="skill_name" value="<?php echo htmlspecialchars($skill->name); ?>"><br>
        <button name="bt_update_skill">Fähigkeit aktualisieren</button>
    </form>

</main>

</body>
</html>