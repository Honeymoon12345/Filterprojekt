<?php

declare(strict_types=1);

class BankAccount{
    function __construct (
        public string $account_number,
        public string $type,
        public float $balance,
    ){}

    public function deposit (float $amount){
        $this->balance += $amount;
        return $this->balance;
    }
    
    public function withdraw(float $amount){
        $this->balance -= $amount;
        return $this->balance;
    }
}
