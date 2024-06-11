<?php
// Hier steht der Formular-Validierung-Code


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/pico.classless.min.css">
    <title>Document</title>
</head>
<body>
<main>
    <form action="simple-form.php" method="POST">
        <label for="name">Name
            <input type="text" id="name" name="name" placeholder="Fullname">
        </label>
        <label for="age">Age
            <input type="text" id="age" name="age" placeholder="Your age">
        </label>
        <label for="terms">I agree to the terms and conditions
            <input type="checkbox" id="terms" name="terms">
        </label>
        <button type="submit">Absenden</button>
    </form>
</main>
</body>
</html>