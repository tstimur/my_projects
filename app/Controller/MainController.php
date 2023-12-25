<?php

class MainController
{
    public function getProducts()
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {                     //Проверка user_id в механизме сессии
            header('Location: /login');         //get TRUE, do redirect on login page
        }

        $pdo = new PDO("pgsql:host=db;port=5432;dbname=postgres;", "postgres", "postgres");

        $stmt = $pdo->query("SELECT *FROM products");
        $products = $stmt->fetchAll();


        require_once "./../View/main.php";
    }
}