<?php

class Product
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO("pgsql:host=db;port=5432;dbname=postgres;", "postgres", "postgres");
    }
    public function getAll(): array
    {
        $stmt = $this->pdo->query("SELECT *FROM products");
        $products = $stmt->fetchAll();

        return $products;
    }
}