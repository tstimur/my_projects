<?php

session_start();
if (!isset($_SESSION['user_id'])) {                     //Проверка user_id в механизме сессии
    header('Location: /get_login.php');         //get TRUE, do redirect on login page
}

print_r ("Welcome to main page!");