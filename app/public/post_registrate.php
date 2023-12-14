<?php

//print_r($_POST);

$Errors = [];      //создаем массив для ошибок

$name = $_POST['name'];
if (strlen($name) < 2) {        //проверка имени на количество символов
    $Errors['name'] = "!Name must be more than 2 symbols!";
}

$email = $_POST['email'];
if (strlen($email) < 2) {       //проверка почты на количество символов
    $Errors['email'] = "!Email must be more than 2 symbols!";
}

$password = $_POST['psw'];
if (strlen($password) < 7) {        //проверка пароля на количество символов
    $Errors['password'] = "!Password must be more than 8 symbols!";
}

$pswRepeat = $_POST['psw-repeat'];
if ($pswRepeat !== $password) {     //проверка на корректность пароля
    $Errors['pswRepeat'] = "!Passwords don't match!";
}

print_r($Errors);

if (empty($Errors)) {
//Connect with Data Base
    $pdo = new PDO("pgsql:host=db;port=5432;dbname=testdb;",  "testuser",  "qwerty");

//Подготавливаем наш запрос, экранируя в нем значения. Подготовка запроса идет только для записи в таблицу.
//Если нужно просто выполнить команду, то exec
    $statement = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
//выполнение запроса без возврата данных с помощью команды execute
    $statement->execute(['name' => $name, 'email' => $email, 'password' => $password]);

//Возвращаем только что заполненные данные на экран
    $statement = $pdo->prepare("SELECT * FROM users WHERE name = :name");
    $statement->execute(['name' => $name]);
    $data = $statement->fetch();

    print_r($data);
}