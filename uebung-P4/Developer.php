<?php
declare(strict_types=1);
require_once 'Person.php';
require_once 'interface.php';

class Developer extends Person implements IDeveloper{
    private array $skills = [];

    public function __construct(
        string $name,
        string $email,
        array $skills = []
    )
    {
        parent::__construct($name, $email);
        $this->skills = $skills;
    }

    public function progress(object $project, int $progress): void
    {
        $project->setProgress($progress);
    }

    public function getSkills(): array
    {
        return $this->skills;
    }

    public function addSkill(string $skill): void
    {
        $this->skills[] = $skill;
    }

    public function getAssignedProjects(array $projects): array
    {
        $assignedProjects = [];
        foreach($projects as $project){
            if (in_array($this, $project->getDevelopers(), true)) {
                $assignedProjects[] = $project;
            }
        }
        return $assignedProjects;
    }
}