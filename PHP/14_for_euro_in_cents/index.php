<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/stlyle.css'>
    <script src='main.js'></script>
</head>

<body>
    <h1>Euro in Münzen umrechnen</h1>

    <?php
    $errors = [];
    if (isset($_POST['bt_calculate'])) {
        $betrag = trim($_POST['betrag']);
        if (strlen($betrag) == 0) {
            $errors[] = 'Einen Betrag eingeben!';
        }
        if (!is_numeric($betrag)) {
            $errors[] = 'Nur Zahlen!';
        }
        if ($betrag < 0) {
            $errors[] = 'Nur positive Zahlen!';
        }
        if (count($errors) == 0) {
            $betrag *= 100;
            $anz200 = 0;
            $anz100 = 0;
            $anz50 = 0;
            $anz20 = 0;
            $anz10 = 0;
            $anz5 = 0;
            $anz1 = 0;

            while ($betrag > 0) {
                $anz =  (int)($betrag / 200.0);
                if ($anz > 0) {
                    $anz200 += $anz;
                    $betrag -= $anz * 200;
                }
                $anz = (int)($betrag / 100.0);
                if ($anz > 0) {
                    $anz100 += $anz;
                    $betrag -= $anz * 100;
                }
                $anz = (int)($betrag / 50.0);
                if ($anz > 0) {
                    $anz100 += $anz;
                    $betrag -= $anz * 50;
                }
                $anz = (int)($betrag / 20.0);
                if ($anz > 0) {
                    $anz100 += $anz;
                    $betrag -= $anz * 20;
                }
            }
            $anz = (int)($betrag / 10.0);
            if ($anz > 0) {
                $anz100 += $anz;
                $betrag -= $anz * 10;
            }
            $anz = (int)($betrag / 5.0);
            if ($anz > 0) {
                $anz100 += $anz;
                $betrag -= $anz * 5;
            }
            $anz = (int)($betrag / 1.0);
            if ($anz > 0) {
                $anz100 += $anz;
                $betrag -= $anz * 1;
            }
        }
        echo "<div class='result'>
            <p>$anz200 x 2 €</p>
            <p>$anz100 x 1 €</p>
            <p>$anz50 x 50 Cent</p>
            <p>$anz20 x 20 Cent</p>
            <p>$anz10 x 10 Cent</p>
            <p>$anz5 x 5 Cent</p>
            <p>$anz1 x 1 Cent</p>
            </div>";
    }
    if (count($errors) > 0) {
        echo '<div class="errors">';
        echo '<ul>';
        for ($i = 0; $i < count($errors); $i++) {
            echo '<li>' . htmlspecialchars($errors[$i]) . '</li>';
        }
        echo '</ul>';
        echo '</div>';
    }
    ?>

    <form action="index.php" method="POST">
        <label for="betrag">Betrag in Euro:</label><br>
        <input type="text" id="betrag" name="betrag"><br>
        <button name="bt_calculate">Euro in Münzen umrechnen</button>
    </form>
</body>

</html>