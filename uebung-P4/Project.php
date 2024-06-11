<?php
declare(strict_types=1);
include_once 'interface.php';

class Project implements IProject{
    private string $id;
    private string $name;
    private array $developers = [];
    private int $progress = 0;
    private bool $status = false;

    public function __construct($name)
    {
        $this->id = uniqid('prj_');
        $this->name = $name;
    }

    public function addDeveloper(object $developer): void
    {
        $this->developers[] = $developer;
    }

    public function getDevelopers(): array
    {
        return $this->developers;
    }

    public function getProgress(): int
    {
        return $this->progress;
    }

    public function setProgress(int $progress): void
    {
        $this->progress = $progress;
    }

    public function getStatus(): bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): void
    {
        $this->status = $status;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}