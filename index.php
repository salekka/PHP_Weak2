<?php
session_start();
include 'storage.php';

// Проверяем, был ли отправлен POST-запрос (т.е. форма была отправлена)
if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    // Получаем значения из POST-запроса, если они установлены, иначе устанавливаем пустую строку
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $feedback = $_POST['feedback'] ?? '';
    
    // Массив для хранения ошибок валидации
    $errors = [];
    
    if (empty($username)) 
    {
        $errors[] = "Необходимо ввести имя пользователя";
    }
    if (empty($password)) 
    {
        $errors[] = "Необходимо ввести пароль";
    }
    if (empty($feedback)) 
    {
        $errors[] = "Необходимо оставить отзыв";
    }
    
    if (empty($errors))
    {
        $user = null;// Переменная для хранения найденного пользователя
        foreach ($users as $u)// Ищем пользователя в массиве $users по имени пользователя и паролю
            {
            if ($u['username'] === $username && $u['password'] === $password)
            {
                $user = $u;
                break;
            }
        }
        
        if ($user) 
        {
            $_SESSION['user'] = $user;
            $_SESSION['login_time'] = date('Y-m-d H:i:s');
            $_SESSION['feedback'] = $feedback;
            
            $login_info = date('Y-m-d H:i:s') . " - Пользователь: $username\n";
            file_put_contents('login_history.txt', $login_info, FILE_APPEND);
            
            header('Location: about.php');
            exit;
        } 
        else 
        {
            $errors[] = "Неверное имя пользователя или пароль";
        }
    }
}

$_SESSION['errors'] = $errors ?? [];
include 'login.html';
