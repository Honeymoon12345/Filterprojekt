<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

</head>

<body>
    <h1>Zahlenbereiche mit switch-case</h1>

    <?php

    $zahl = 6;

    switch ($zahl) {
        case 1:
            echo '<p>Die Zahl ist zwischen 1 und 5.</p>';
            break;
        case 2:
            echo '<p>Die Zahl ist zwischen 1 und 5.</p>';
            break;
        case 3:
            echo '<p>Die Zahl ist zwischen 1 und 5.</p>';
            break;
        case 4:
            echo '<p>Die Zahl ist zwischen 1 und 5.</p>';
            break;
        case 5:
            echo '<p>Die Zahl ist zwischen 1 und 5.</p>';
            break;
        case 6:
            echo '<p>Die Zahl ist zwischen 6 und 10.</p>';
            break;
        case 7:
            echo '<p>Die Zahl ist zwischen 6 und 10.</p>';
            break;
        case 8:
            echo '<p>Die Zahl ist zwischen 6 und 10.</p>';
            break;
        case 9:
            echo '<p>Die Zahl ist zwischen 6 und 10.</p>';
            break;
        case 10:
            echo '<p>Die Zahl ist zwischen 6 und 10.</p>';
            echo '<p>Jackpot!!!</p>';
            break;
        case 0:
            echo '<p>Keine 0!!!</p>';
        default:
           echo '<p>Zahl ist zu groß/klein!</p>';
            break;
    }


    ?>

</body>

</html>