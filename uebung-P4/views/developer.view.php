<?php
$css_path = '../pico.classless.min.css';
include '../header.php';
include_once dirname(__DIR__) . '/inc/objects.php';
if (isset($_GET['name']) && isset($claudia)){
    foreach ($claudia->getProjects() as $project) {
        foreach ($project->getDevelopers() as $current_dev) {
            if(str_replace(" ", "", $current_dev->getName()) === $_GET['name']){
                $dev = $current_dev;
            }
        }
    }
}else{
    $dev = null;
}
?>

<main style="padding: 0">
    <h3><?= $dev->getName(); ?></h3>
    <a href="mailto:<?= str_replace(" ", ".", strtolower($dev->getName()))?>@company.at">E-Mail: <?= $dev->getEmail();?></a>
    <p>Skills: <?= implode(', ', $dev->getSkills()); ?></p>
    <h4>Assigned Projects:</h4>
    <ul>
        <?php
        if (isset($claudia)) {
            foreach ($dev->getAssignedProjects($claudia->getProjects()) as $project) {
                echo '<li>' . $project->getName() . ' - Fortschritt: <progress value="' . $project->getProgress() . '" max="100"></progress></li>';
            }
        }
        ?>
    </ul>
    <a href="../index.php"><-- Back to Main</a>
</main>
<?php include dirname(__DIR__) . '/footer.php' ?>