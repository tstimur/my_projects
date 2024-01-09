<?php

class MainController
{
    private Product $productModel;

    function __construct()
    {
        $this->productModel = new Product();
    }
    public function getProducts()
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {                     //Проверка user_id в механизме сессии
            header('Location: /login');         //get TRUE, do redirect on login page
        }

        $products = $this->productModel->getAll();

        require_once "./../View/main.php";
    }
}