<?php
require_once dirname(__DIR__) . '/TeamLeader.php';
require_once dirname(__DIR__) . '/Developer.php';
require_once dirname(__DIR__) . '/Project.php';

//Teamleader erstellen
$claudia = new TeamLeader('Claudia Leader', 'claudia.leader@company.at');

//Projekte zuweisen
for ($i=1; $i <= 5; $i++) { 
    $claudia->addProject(new Project("Project $i"));
}


//Developer erstellen
$henrik_dev = new Developer('Henrik Dev', 'henrik.dev@company.at');
$amilia_dev = new Developer('Amalia Dev', 'amalia.dev@company.at');

//Skills zuweisen
$henrik_dev->addSkill('PHP');
$henrik_dev->addSkill('Backend');
$amilia_dev->addSkill('JavaScript');
$amilia_dev->addSkill('Frontend');

//Projekte zuweisen
$claudia->setDeveloper($henrik_dev, $claudia->getProjects()[0]->getId());
$claudia->setDeveloper($amilia_dev, $claudia->getProjects()[1]->getId());
$claudia->setDeveloper($henrik_dev, $claudia->getProjects()[3]->getId());
$claudia->setDeveloper($amilia_dev, $claudia->getProjects()[4]->getId());

//Projektfortschritt ändern
$henrik_dev->progress($henrik_dev->getAssignedProjects($claudia->getProjects())[0], 50);
$amilia_dev->progress($amilia_dev->getAssignedProjects($claudia->getProjects())[1], 76);