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
    <h1>BMI-Rechner</h1>
    <p>Die folgenden Informationen als GET-Parameter übergeben:</p>
    <p>2 GET-Parameter: kg, m</p>

    <?php
        $kg = $_GET['kg'];
        $m = $_GET['m'];
      
        $bmi = $kg / pow($m, 2);

        echo $bmi;


    ?>


    
</body>
</html>