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
    $statement->execute(['email' => $email]);
    $res = $statement->fetch();            //get a value from the table (users)

    if (empty($res)) {
        $errors['email'] = "The user doesn't exist! Try again.";
    } else {
        if (password_verify($password, $res['password'])) { //check our password with data from the DB
            session_start();    //start session
            $_SESSION['user_id'] = $res['id'];  //assign ID from the DB
            header('Location: /main');  //in case of successful login, then go to the main page
        } else {
            $errors['password'] = "The email or password is wrong! Try again.";
        }
    }
}

require_once './html/login.php';         //if the password is wrong, then the user is sent to the login page