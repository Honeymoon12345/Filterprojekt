<?php

include 'header.php';
require_once 'account.php';
$giro = new BankAccount('1234567', 'Giro', 1000.00);
$savings = new BankAccount('654321', 'Savings', 5000.00);
?>
<main style="padding: 0">
    <table>
        <tr>
            <th>Date</th>
            <th><?=$giro->type?></th>
            <th><?=$savings->type?></th>
        </tr>
        <tr>
            <th>19. September</th>
            <th><?=$giro->balance?></th>
            <th><?=$savings->balance?></th>
        </tr>
        <tr>
            <th>11. November</th>
            <th><?=$giro->deposit(800)?></th>
            <th><?=$savings->deposit(1233)?></th>
        </tr>
        <tr>
            <th>15. November</th>
            <th><?=$giro->withdraw(1455)?></th>
            <th><?=$savings->withdraw(657)?></th>
        </tr>
    </table>
</main>
<?php include 'footer.php'; ?>