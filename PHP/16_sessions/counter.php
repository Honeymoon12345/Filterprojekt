<?php
session_start();
if(isset($_SESSION['counter']))
{
    $_SESSION['counter'] = $_SESSION['counter'] + 1;
}else
{
    $_SESSION['counter'] = 1;
}
if(isset($_POST['bt_reset_counter']))
{
    $_SESSION['counter'] = 0;
    header('Location: counter.php');
}
?>
<!DOCTYPE html>
 <html>
 <head>
     <meta charset='utf-8'>
     <meta http-equiv='X-UA-Compatible' content='IE=edge'>
     <title>Page Title</title>
     <meta name='viewport' content='width=device-width, initial-scale=1'>
     <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
     <script src='main.js'></script>
 </head>
 <body>
     <h1>Counter: Zählen wie oft die Seite besucht wurde</h1>
     <p>In einer Session-Variable wird gespeichert wie oft die Seite besucht wurde</p>
     <p>Du hast diese Seite bereits <?php echo $_SESSION['counter'];?> x aufgerufen.</p>
     <form action="counter.php" method="POST">
        <button name="bt_reset_counter">Counter zurücksetzen</button>
     </form>
 </body>
 </html>