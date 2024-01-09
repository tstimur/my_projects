<?php

class User
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO("pgsql:host=db;port=5432;dbname=postgres;", "postgres", "postgres");
    }

    public function getOneByEmail(string $email): array
    {
        //Подготавливаем наш запрос, экранируя в нем значения
        $statement = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $statement->execute(['email' => $email]);
        //get a value from the table (users)
        return $statement->fetch();
    }

    public function createUser(string $name, string $email, string $password)
    {
        //Подготавливаем наш запрос, экранируя в нем значения. Подготовка запроса идет только для записи в таблицу.
        //Если нужно просто выполнить команду, то exec
        $statement = $this->pdo->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
        //выполнение запроса без возврата данных с помощью команды execute
        $statement->execute(['name' => $name, 'email' => $email, 'password' => $password]);
    }
}