<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/style.css'>
    <script src='main.js'></script>
</head>
<body>
    <h1>Umrechner</h1>

    <?php
        if(isset($_POST['btCalculate'])){
            $eur = $_POST['eur'];
            $ergebnis = $eur * 1.11;
            echo "<p class='result'>$eur € sind $ergebnis $</p>";
        }

        if(isset($_POST['bt_Calculate'])){
            $dollar = $_POST['dollar'];
            $Ergebnis = $dollar / 1.11;
            echo "<p class='result'>$dollar $ sind $Ergebnis €</p>";
        }
    ?>
<h2>Euro in Dollar</h2>
<form action="index.php" method="POST">
        <label for="eur">Euro:<br>
        <input type="text" name="eur"><br>
        <button name="btCalculate">Berechnen</button><br>
<h2>Dollar in Euro</h2>
<form action="index.php" method="POST">
        <label for="dollar">Dollar:<br>
        <input type="text" name="dollar"><br>
        <button name="bt_Calculate">Berechnen</button>
    
</body>
</html>