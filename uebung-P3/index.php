<?php
// Hier kommt der PHP-Code
/* require_once 'Depot.php';
require_once 'Stock.php'; */

spl_autoload_register(function($class){
    include $class . '.php';
});

$microsoft = new Stock(1, 'MSFT', 240.00);
$apple = new Stock(2, 'AAPL', 340.00);
$paypal = new Stock(3, 'PYPL', 182.00);
$nvidia = new Stock(4, 'NVDA', 756.00);

$depot = new Depot([], 1000.0, 'AT123456789', 'Lucia Ludwig');

$depot->deposit(4000.00);

$depot->buyStock($microsoft, 10);
$depot->buyStock($apple, 5);
$depot->buyStock($paypal, 2);
$depot->buyStock($nvidia, 1);

include 'header.php';
?>
<!-- Hier kommt die Tabelle -->
<main style="padding: 0;">
    <table>
        <tr>
            <th>Label</th>
            <th>Price/Piece</th>
            <th>Amount</th>
            <th>Value</th>
        </tr>
        <?php foreach($depot->getStocks() as $stock): ?>
        <tr>
            <th><?= $stock->label ?></th>
            <th><?= $stock->price ?></th>
            <th><?= $stock->amount ?></th>
            <th><?= $stock->price * $stock->amount ?></th>
        </tr>
        <?php endforeach; ?>
        <tr>
            <th>Balance</th>
            <th></th>
            <th></th>
            <th><?= $depot->balance ?></th>
        </tr>
    </table>
</main>

<?php include 'footer.php'; ?>