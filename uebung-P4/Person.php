<?php
declare(strict_types=1);

abstract class Person{
    public function __construct(
        protected string $name,
        protected string $email
    ){
    }

    public function getName(): string{
        return $this->name;
    }

    public function setEmail( string $email): void {
        $this->email = $email;
    }

    public function getEmail(): string{
        return $this->email;
    }
}