<?php

class Produkte
{
    public int $id;
    public string $title;
    public float $price;
    public int $order_id;

    public function __construct(int $id, string $title, float $price, int $order_id)
    {
        $this->id = $id;
        $this->title = $title;
        $this->price = $price;
        $this->order_id = $order_id;
    }
}

class User
{
    public int $id;
    public bool $is_admin;
    public string $firstname;
    public string $lastname;
    public string $email;
    public string $password;

    public function __construct(int $id, bool $is_admin, string $firstname, string $lastname, string $email, string $password)
    {
        $this->id = $id;
        $this->is_admin = $is_admin;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->password = $password;
    }
}

class Bestellungen
{
    public int $id;
    public DateTime $order_date;
    public float $order_value;
    public int $user_id;

    public function __construct(int $id, DateTime $order_date, float $order_value, int $user_id)
    {
        $this->id = $id;
        $this->order_date = $order_date;
        $this->order_value = $order_value;
        $this->user_id = $user_id;
    }
}

?>