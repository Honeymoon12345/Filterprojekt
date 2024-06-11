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
    <h1>Verwenden von GET-Parametern</h1>
    <p>GET-Parameter werden über die URL übertragen.</p>
    <p>Sie stehen immer nach einem Fragezeichen, z.B. http://127.0.0.1/test.php?alter=17</p>
    <p>Diese URL hat einen GET-Parameter: alter mit dem Wert 17.</p>

    <?php
        $vorname = $_GET['vorname'];
        $nachname = $_GET['nachname'];
        $alter = $_GET['alter'];
        $diffAuf100 = 100 - $alter;

        echo "Herzlich Willkommen $nachname, $vorname!<br>";
        echo "Du bist $alter Jahre alt - es fehlen noch $diffAuf100 Jahre auf die 100!<br>";

        echo $vorname . '<br>';
        echo $nachname . '<br>';
        echo $alter . '<br>';

    ?>
    
</body>
</html>