<?php
declare( strict_types=1 );

class Stock{
    public function __construct(
        public string $id = '',
        public string $label = '',
        public float $price = 0.0,
        public int $amount = 0
    )
    {
        
    }
}