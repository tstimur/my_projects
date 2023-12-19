<?php

$errors = [];      //создаем массив для ошибок

$name = $_POST['name'];
$email = $_POST['email'];

$password = $_POST['psw'];
$pswRepeat = $_POST['psw-repeat'];

if (strlen($name) < 2) {        //проверка имени на количество символов
    $errors['name'] = "!Name must be more than 2 symbols!";
}
if (strlen($email) < 2) {       //проверка почты на количество символов
    $errors['email'] = "!Email must be more than 2 symbols!";
}
if (strlen($password) < 4) {                    //проверка пароля на количество символов
    $errors['password'] = "!Password must be more than 4 symbols!";
} elseif ($password !== $pswRepeat) {            //compare the password and pswRepeat
    $errors['pswRepeat'] = "!Password must be more than 4 symbols!";
} else {
    $password = password_hash($password, PASSWORD_DEFAULT);     //encrypt the password
}

if (empty($errors)) {
//Connect with Data Base
    $pdo = new PDO("pgsql:host=db;port=5432;dbname=postgres;",  "postgres",  "postgres");

//Подготавливаем наш запрос, экранируя в нем значения. Подготовка запроса идет только для записи в таблицу.
//Если нужно просто выполнить команду, то exec
    $statement = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
//выполнение запроса без возврата данных с помощью команды execute
    $statement->execute(['name' => $name, 'email' => $email, 'password' => $password]);

    header('Location: ./login');
} else {
    require_once './html/registrate.php';
}



?>

