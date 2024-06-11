<?php

class Customer{
    public string $forename;
    public string $surname;
    public string $email;
    public string $password;
}

class BankAccount{
    public string $account_number;
    public string $type;
    public float $balance = 0;

    public function deposit (float $amount){
        $this->balance += $amount;
        return $this->balance;
    }

    public function withdraw(float $amount){
        $this->balance -= $amount;
        return $this->balance;
    }
}


$customer = new Customer();
$account = new BankAccount('AT123456789', 'Biro', 10000.00);

$customer->forename = 'John';
$customer->surname = 'Doe';

$account->balance = 100000.00;

echo '<div style:"padding: 20px; background-color: #afbbc4; border-radius: 5px; width: fit-content">';
echo "Name: $customer->forename $customer->surname";
echo '<br>';
echo "Balance: € $account->balance";
echo '</div>';

echo '<br><br>';

$bank_account = new BankAccount('AT123456789', 'Biro', 10000.00);
$bank_account->deposit(1000);
echo $bank_account->balance;
echo '<br>';
$bank_account->withdraw(500);
echo $bank_account->balance;