<?php
/*
Login-Seite
*/

require_once 'utils/maininclude.inc.php';

// wenn User bereits angemeldet ist, zum Dashboard weiterleiten
if($userService->isLoggedIn()){
    header('Location: welcome.php');
    return;
}

$errors = [];
if(isset($_POST['bt_login']))
{
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if($email == NULL || strlen($email) == 0){
        $errors[] = 'Email eingeben!';
    }
    if($password == NULL || strlen($password) == 0){
        $errors[] = 'Passwort eingeben!';
    }

    if(count($errors) == 0){
        $loginSuccess = $userService->login($email, $password);
        if($loginSuccess){
            // Weiterleitung zum Dashboard
            header('Location: ./welcome.php?login_successful=true');
            return;
        } else {
            $errors[] = 'Login fehlgeschlagen!';
        }
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Login</title>
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

    <h1>Login</h1>

    <?php
    // Fehlermeldungen ausgeben
    include 'utils/errormessages.inc.php';
    ?>

    <form action="login.php" method="POST">
        <label>E-Mail</label><br>
        <input type="text" name="email"><br>
        <label>Passwort</label><br>
        <input type="password" name="password"><br>
        <button name="bt_login">Login</button>
    </form>

</main>

</body>
</html>