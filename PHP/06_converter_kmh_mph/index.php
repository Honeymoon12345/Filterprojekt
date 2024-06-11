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
    <h1> Bitte die km/h als GET-Parameter "kmh" übergeben. </h1>
    <p>index.php?kmh=100</p>
    <?php
    $a = $_GET['kmh'];
    $mph = 0.621371 * $a;

    echo $mph;
    echo "<p>$a kmh sind $mph mph</p>";

    ?>
    
</body>
</html>