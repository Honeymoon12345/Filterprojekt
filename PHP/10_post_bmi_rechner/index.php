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

    <?php
        if(isset($_POST['bt_calculate'])){
            $kg = (float)$_POST['kg'];
            $m = (float)$_POST['m'];
            $bmi = $kg / ($m * $m);
            echo "<p>$bmi</p>";


        }
    ?>

    <form action="index.php" method="POST">
        <label for="kg">Gewicht in kg:</label><br>
        <input type="text" name="kg"><br>
        <label for="m">Körpergröße in m:</label><br>
        <input type="text" name="m"><br>
        <button name="bt_calculate">BMI berechnen</button>
    
</body>
</html>