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
    <?php

    $a = $_GET['z1'];
    $b = $_GET['z2'];
    echo "<p>$a+$b = " . ($a + $b) . "</p>";
    echo "<p>$a-$b = " . ($a - $b) . "</p>";
    echo "<p>$a*$b = " . ($a + $b) . "</p>";
    echo "<p>$a/$b = " . ($a / $b) . "</p>";

    ?>
    
</body>
</html>