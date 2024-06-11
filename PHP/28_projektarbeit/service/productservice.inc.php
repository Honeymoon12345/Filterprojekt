<?php
class ProductService
{
    private PDO $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    public function createProduct(string $title, float $price, int $order_id)
    {
        $ps = $this->conn->prepare('
            INSERT INTO produkte
            (title, price, order_id)
            VALUES
            (:title, :price, :order_id)');

            $ps->bindValue("title", $title);
            $ps->bindValue("price", $price);
            $ps->bindValue("order_id", $order_id);

            $ps->execute();

            $id = $this->conn->lastInsertId();

            return $id;
    }
}
?>