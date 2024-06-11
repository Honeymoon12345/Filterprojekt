<?php
/*
Logout-Seite
*/

require_once 'utils/maininclude.inc.php';

// User muss angemeldet sein um die Seite aufrufen zu können.
$userService->redirectIfNotLoggedIn();


if(isset($_POST['bt_logout']))
{
    $userService->logout();

    header('Location: index.php?logged_out=true');
    return;
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Logout</title>
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

    <h1>Logout</h1>
    <form action="logout.php" method="POST">
        <button name="bt_logout">Logout</button>
    </form>
</main>

</body>
</html>