<?php

declare(strict_types=1);

$data = [
    'balance' => 3000.00,
    'iban' => 'AT123456789',
    'owner' => 'Lukas Ludwig',
    'stocks' => [
        ['label' => 'MSFT', 'price' => 240.0, 'amount' => 10],
        ['label' => 'AAPL', 'price' => 304.0, 'amount' => 5],
        ['label' => 'PYPL', 'price' => 102.0, 'amount' => 2],
        ['label' => 'NVDA', 'price' => 756.0, 'amount' => 1],
    ]
];

$my_depot = Depot::fromArray($data);
var_dump($my_depot);

class Depot
{
    public function __construct(
        private array $stocks = [],
        public float $balance = 0.0,
        public string $iban = '',
        public string $owner = ''
    ) {
    }
    public function deposit(float $amount): void
    {
        $this->balance += $amount;
    }

    public function getStocks(): array
    {
        return $this->stocks;
    }

    public function buyStock(object $stock, int $amount): void
    {
        $price = $stock->price * $amount;
        if ($this->balance >= $price) {
            $this->balance -= $price;
            $stock->amount += $amount;
            $this->stocks[$stock->label] = $stock;
        }
    }

    public function sellStock(string $lable, int $amount): void
    {
        $stock = $this->stocks[$lable];
        if (!isset($stock)) {
            return;
        }
        if ($stock->amount >= $amount) {
            $stock->amount -= $amount;
            $this->balance += $stock->price * $amount;
        }
    }

    public static function fromArray(array $data)
    {
        return new self($data['stocks'], $data['balance'],$data['iban'], $data['owner']);
    }
}

