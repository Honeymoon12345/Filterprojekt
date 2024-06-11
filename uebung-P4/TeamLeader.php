<?php

declare(strict_types=1);
require_once 'Person.php';
require_once 'interface.php';

class TeamLeader extends Person implements ITeamleader{
    private array $projects = [];
    public function __construct(
        string $name,
        string $email,
        array $projects = []
    )
    {
        parent::__construct($name, $email);
        $this->projects = $projects;
    }

    public function addProject(object $project): void
    {
        $this->projects[] = $project;
    }

    public function getProjects(): array
    {
        return $this->projects;
    }

    public function setDeveloper(object $developer, string $prjId): void{
        foreach ($this->projects as $project){
            if($project->getId() === $prjId){
                $project->addDeveloper($developer);
            }
        }
    }

    public function changeProjectStatus(bool $status, string $prjId): void
    {
        foreach ($this->projects as $project){
            if($project-> getId() === $prjId){
                $project->setStatus($status);
            }
        }
    }
}