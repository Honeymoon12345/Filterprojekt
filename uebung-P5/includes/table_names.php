<?php
include_once './includes/functions.php';

?>


<table>
    <tr>
        <th>Name</th>
        <th>Lastname</th>
        <th>Birthday</th>
    </tr>

    <?php foreach ($filtered_persons as $key => $person) : ?>
        <tr>
            <td><?= e($person['first_name']); ?></td>
            <td><?= e($person['last_name']); ?></td>
            <td><?= e($person['birthdate']); ?></td>
        </tr>
    <?php endforeach; ?>

</table>