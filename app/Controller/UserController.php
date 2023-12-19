<?php

class UserController
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO("pgsql:host=db;port=5432;dbname=postgres;",  "postgres",  "postgres");
    }

    public function getRegistrate()
    {
        require_once './../View/registrate.php';
    }

    public function registrate()
    {
        $errors = $this->validateRegistData($_POST);

        if (empty($errors)) {
            $password = $_POST['psw'];
            $name = $_POST['name'];
            $email = $_POST['email'];

            $password = password_hash($password, PASSWORD_DEFAULT);     //encrypt the password
            //Подготавливаем наш запрос, экранируя в нем значения. Подготовка запроса идет только для записи в таблицу.
            //Если нужно просто выполнить команду, то exec
            $statement = $this->pdo->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
            //выполнение запроса без возврата данных с помощью команды execute
            $statement->execute(['name' => $name, 'email' => $email, 'password' => $password]);

            header('Location: /login');
        } else {
            require_once './../View/registrate.php';
        }
    }

    private function validateRegistData(array $data): array
    {
        $errors = [];      //создаем массив для ошибок

        $name = $data['name'];
        $email = $data['email'];

        $password = $data['psw'];
        $pswRepeat = $data['psw-repeat'];

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
        }

        return $errors;
    }

    public function getLogin()
    {
        require_once './../View/login.php';
    }

    public function login()
    {
        // create array for errors
        $errors = [];


        $email = $_POST['email'];
        $password = $_POST['psw'];


        if (strlen($email) < 2){
            $errors['email'] = "!The email or password is incorrect!";
        }


        if (empty($errors)) {
            //Подготавливаем наш запрос, экранируя в нем значения
            $statement = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
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

        require_once './../View/login.php';         //if the password is wrong, then the user is sent to the login page
    }

//    public function validateLoginData()
//    {
//
//    }

    public function logout()
    {
        session_start();
        unset($_SESSION['user_id']);
        header('Location: /login');
    }
}