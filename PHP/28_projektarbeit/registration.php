<?php

require_once 'utils/maininclude.inc.php';


$errors = []; 

if(isset($_POST['bt_create_user']))
{
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // todo: Rest der Formularvalidierung... 

    if(count($errors) == 0)
    {
        echo 6;
        // dann Registrierung durchführen 
        $userId = $userService->createUser($firstname, $lastname, $email, $password, false);
        header('Location: ./index.php?created_user_id=' .$userId);
        return;
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Registrierung</title>
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

    <h1>Registrierung</h1>
    <?php
    // Ausgabe der Fehlermeldungen
    include 'utils/errormessages.inc.php';
    ?>
    <form action="registration.php" method="POST">
        <label>Vorname:</label><br>
        <input type="text" name="firstname"><br>

        <label>Nachname:</label><br>
        <input type="text" name="lastname"><br>

        <label>Email:</label><br>
        <input type="text" name="email"><br>

        <label>Passwort:</label><br>
        <input type="password" name="password"><br>

        <button name="bt_create_user">Registrieren</button>
    </form>

</main>

</body>
</html>