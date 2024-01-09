<?php

require_once './../Model/User.php';

class UserController
{
    private User $modelUser;
    private array $errors = []; //create array for validation errors

    public function __construct()
    {
        $this->modelUser = new User();
    }

    public function getRegistrate()
    {
        require_once './../View/registrate.php';
    }

    public function registrate()
    {
//        $data = $_POST;
//        $this->validateName($data['name']);
//        $this->validateEmail($data['email']);
//        $this->validatePassword($data['psw'], $data['psw-repeat']);

        $errors = $this->validateRegistData($_POST);


        if (empty($errors)) {
            $password = $_POST['psw'];
            $name = $_POST['name'];
            $email = $_POST['email'];

            $password = password_hash($password, PASSWORD_DEFAULT);     //encrypt the password

            $this->modelUser->createUser($name, $email, $password);

            header('Location: /login');
        } else {
            require_once './../View/registrate.php';
        }
    }

//    public function validateEmail($email): void
//    { //check that the entered email is valid
//        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//            $this->errors['email'] = '!The email is incorrect!';
//        }
//    }
//
//    public function validatePassword($password, $pswRepeat): void
//    { // check that the password contains at least 8 characters
//        if (strlen($password) < 8) {
//            $this->errors['password'] = "!Password must be more than 8 symbols!";
//        } elseif ($password !== $pswRepeat) { //compare the password and pswRepeat
//            $this->errors['pswRepeat'] = "!Passwords do not match! Try again!";
//        }
//    }
//
//    public function validateName($name): void
//    { //check that the name contains only letters, numbers, underscore and dot
//        $pattern = '/^[A-Za-z0-9_.]+$/';
//        if (strlen($name) < 2) {
//            $this->errors['name'] = '!Name must be more than 2 symbols!';
//        }elseif (!preg_match($pattern, $name)) {
//            $this->errors['name'] = 'The name is incorrect!';
//        }
//    }
//
//    public function getErrors(): array
//    {
//        return $this->errors;
//    }

    public function validateRegistData(array $data): array
    {
        $errors = [];      //создаем массив для ошибок

        $name = $data['name'];
        $email = $data['email'];
        $password = $data['psw'];
        $pswRepeat = $data['psw-repeat'];

        //check that the name contains only letters, numbers, underscore and dot
        $pattern = '/^[A-Za-z0-9_.]+$/';
        if (strlen($name) < 2) {
            $errors['name'] = '!Name must be more than 2 symbols!';
        }elseif (!preg_match($pattern, $name)) {
            $errors['name'] = 'The name is incorrect!';
        }

        //check that the entered email is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = '!The email is incorrect!';
        }


        // check that the password contains at least 8 characters
        if (strlen($password) < 8) {
            $errors['password'] = "!Password must be more than 8 symbols!";
        } elseif ($password !== $pswRepeat) { //compare the password and pswRepeat
            $errors['pswRepeat'] = "!Passwords do not match! Try again!";
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
            $res = $this->modelUser->getOneByEmail($email);

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