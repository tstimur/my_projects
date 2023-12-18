<?php
            // create array for errors
$errors = [];


$email = $_POST['email'];
$password = $_POST['psw'];


if (strlen($email) < 2){
    $errors['email'] = "!The email or password is incorrect!";
}


if (empty($errors)) {
//Connect with Data Base
    $pdo = new PDO("pgsql:host=db;port=5432;dbname=postgres;", "postgres", "postgres");
            //Подготавливаем наш запрос, экранируя в нем значения
    $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
            //выполнение запроса без возврата данных с помощью команды execute
    $statement->execute(['email' => $email]);
    $data = $statement->fetch();            //get a value from the table (users)

    if (password_verify($password, $data['password'])) {                //check our password with data from the DB
        session_start();
        $_SESSION['user_id'] = $data['id'];                 //assign ID from the DB

        header('Location: /main.php');              //in case of successful login, then go to the main page
    }
} else {
    require_once './get_login.php';         //if the password is wrong, then the user is sent to the login page
}