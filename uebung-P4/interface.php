<?php

interface ITeamleader{
    public function addProject(object $project): void;
    public function getProjects(): array;
    public function setDeveloper(object $developer, string $prjId): void;
    public function changeProjectStatus(bool $status, string $prjId): void;
}

interface IDeveloper{
    public function progress(object $project, int $progress): void;
    public function getAssignedProjects(array $projects): array;
    public function getSkills(): array;
    public function addSkill(string $skill): void;
}

interface IProject{
    public function addDeveloper(object $developer): void;
    public function getDevelopers(): array;
    public function setProgress(int $progress): void;
    public function getProgress(): int;
    public function setStatus(bool $status): void;
    public function getStatus(): bool;
    public function getId(): string;
    public function getName(): string;
}