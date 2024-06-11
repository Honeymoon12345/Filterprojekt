<!doctype html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../pico.classless.min.css" type="text/css">
    <title><?php if (!empty($title)) echo $title; ?></title>
</head>

<body>
    <header>
        <h1>Cities</h1>
        <nav>
            <a href="./index.php">Home</a>
            <a href="./london.php">London</a>
            <a href="./paris.php">Paris</a>
            <a href="./berlin.php">Berlin</a>
        </nav>
    </header>
    <main>
        <h2><?php echo $title; ?></h2>
        <p>Willkommen auf der Seite <?php echo $title; ?>.</p>