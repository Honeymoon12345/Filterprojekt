<?php

include_once './includes/functions.php';
include './includes/persons_data.php';

function filtered_names ($persons, $char): array{

    return array_filter($persons, function($person) use ($char){
        return substr($person['first_name'], 0, 1) === $char;
    });
}

$filtered_persons = [];
if (!empty($_GET['char'])) {
    $char = $_GET['char'];
    $persons = [];
    if (isset($data)) {
        $persons = $data;
    }
    $filtered_persons = filtered_names($persons, $char);
}
$is_table = $_GET['view'] ?? null;

?>

<?php if($is_table !== 'table') : ?>
<ul>
    <?php foreach ($filtered_persons as $person): ?>
        <li>
            <a href="#">
                <?php echo e($person['first_name']).' '.e($person['last_name']) ?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>
<?php else : ?>
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
<?php endif; ?>
