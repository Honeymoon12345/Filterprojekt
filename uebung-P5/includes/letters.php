<?php

include_once './includes/functions.php';

include './includes/persons_data.php';
$persons = [];
if (! empty($data)){
    $persons = $data;
}

function getFirstLetterOnce(array $data, string $key): array{
    $first_letters = [];
    foreach ($data as $person){
        if (! array_key_exists(substr($person[$key], 0, 1), $first_letters)){
            $first_letters[substr($person[$key], 0, 1)] = true;
        }
    }
    ksort($first_letters);
    return $first_letters;
}
$current_letter = $_GET['char'] ?? '';

?>

<?php foreach(getFirstLetterOnce($persons, 'first_name') as $letter => $_) : ?>
    <a href="/uebung-P5/index.php?char=<?php echo $letter ?>&view=table" role="button" style="margin: 10px 0" class="<?= $current_letter === $letter ? 'selected' : ''?>"><?php echo e($letter); ?></a>
<?php endforeach; ?>