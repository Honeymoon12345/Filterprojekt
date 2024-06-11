<?php
$letter = $_GET['char'] ?? '';
$is_table = $_GET['view'] ?? 'list';
?>
<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="pico.classless.min.css">
    <style>
        .selected{
            background-color: red;
        }
    </style>
    <title>Statistik</title>
</head>
<body>
<main class="container">
    <header>
        <h1>Namen filtern</h1>
        <a role="button" href="index.php?char=<?= $letter ?>&view=table">Tabellenansicht</a>
        <a role="button" href="index.php?char=<?= $letter ?>&view=list">Listenansicht</a>
        <nav style="display: flex; flex-wrap: wrap">
            <?php include './includes/letters.php'; ?>
        </nav>
    </header>
    <section>
        <hr>
        <?php
        include_once './includes/functions.php';
        $is_table = $_GET['view'] ?? null;
        $first_letter = $_GET['char'] ?? '';
        echo "<h3>Namen die mit " . e($first_letter) . " beginnen</h3>";
        include_once dirname(__DIR__) . '/uebung-P5/includes/filtered_names.php';
        ?>
    </section>
</main>
</body>
</html>



