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
    <h1>Additionsrechner</h1>

    <?php
        if(isset($_POST['btCalculate'])){
            $z1 = $_POST['z1'];
            $z2 = $_POST['z2'];
            $ergebnis = $z1 + $z2;
            echo "<p>$ergebnis</p>";

        }
    ?>

    <form action="index.php" method="POST">
        <label for="z1"><br>
        <input type="text" name="z1"><br>
        <label for="z2"><br>
        <input type="text" name="z2"><br>
        <button name="btCalculate">Addieren</button>
    
</body>
</html>