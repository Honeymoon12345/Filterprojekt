<?php

// Hier sind alle Includes, die DB-Conn, sowie das Erzeugen der Service-Objekte enthalten
require_once 'utils/maininclude.inc.php';

// Seite darf nur von Admins geöffnet werden
$userService->redirectIfNotAdmin();

// Lade alle Produkte
$products = $productService->getProducts();

$errors = [];

// Prüfe ob der Button zum Hinzufügen eines neuen Skill gedrückt wurde
if(isset($_POST['bt_add_product']))
{
    // Formulardaten einlesen
    $title = trim($_POST['product_title']);

    // Formularvalidierung
    if($title == NULL || strlen($title) == 0)
    {
        $errors[] = 'Produkt hinzufügen!';
    }

    // Prüfen ob es Fehler bei der Formularvalidierung gab
    if(count($errors) == 0)
    {
        // ... versuchen die neue Fähigkeit in die Datenbank zu speichern 
        $productId = $productService->createProduct(string $title, float $price, int $order_id);

        // Weiterleitung um von der POST Request --> GET-Request
        header('Location: ./produkte.php?new_product_id=' . $productId);
        return; 
    }
}

// Soll ein Produkt gelöscht werden? 
if(isset($_POST['bt_delete_product']))
{
    $productId = $_POST['product_id'];
    $productService->deleteProduct($productId);

    header('Location: ./produkte.php?new_product_id=' . $productId);
    return; 
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Produkte</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/style.css'>
    <script src='main.js'></script>
</head>
<body>
    
<main class="center-wrapper">

    <?php 
    // Header mit Navigation einbinden
    include 'utils/nav.inc.php'; 
    ?>

    <h1>Unser Angebot:</h1>
    <?php
    // Inkludieren wir die Ausgabe der Fehlermeldungen
    include 'utils/errormessages.inc.php';
    ?>
    <h2>Neue Instrumente eintragen</h2>
    <form action="produkte.php" method="POST">
        <label>Name des Instruments:</label><br>
        <input type="text" name="product_name"><br>
        <button name="bt_add_product">Instrument speichern</button>
    </form>

    <h2>Alle Musikintrumente</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Löschen</th>
                <th>Bearbeiten</th>
            </tr>
        </thead>
        <tbody>
        <?php
        for($i = 0; $i < count($products); $i++)
        {
            $product = $products[$i];
            echo '<tr>';
            echo '<td>'. htmlspecialchars($product->id) . '</td>';
            echo '<td>'. htmlspecialchars($product->name) . '</td>';
            echo '<td>';
            echo '<form action="produkt.php" method="POST">';
            echo '<input type="hidden" name="product_id" value="'.$product->id.'">';
            echo '<button name="bt_delete_product">Löschen</button>';
            echo '</form>';
            echo '</td>';

            /* Link zur Bearbeiten-Seite
            echo '<td>';
            echo '<a href="admin_update_skill.php?skill_id=' . $skill->id . '">Bearbeiten</a>';
            echo '</td>';

            echo '</tr>';*/
        }
        ?>
        </tbody>
    </table>

</main>

</body>
</html>