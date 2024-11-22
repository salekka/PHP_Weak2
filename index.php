<?php
session_start();
include 'storage.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $feedback = $_POST['feedback'] ?? '';
    
    $errors = [];
    
    if (empty($username)) {
        $errors[] = "Необходимо ввести имя пользователя";
    }
    if (empty($password)) {
        $errors[] = "Необходимо ввести пароль";
    }
    if (empty($feedback)) {
        $errors[] = "Необходимо оставить отзыв";
    }
    
    if (empty($errors)) {
        $user = null;
        foreach ($users as $u) {
            if ($u['username'] === $username && $u['password'] === $password) {
                $user = $u;
                break;
            }
        }
        
        if ($user) {
            $_SESSION['user'] = $user;
            $_SESSION['login_time'] = date('Y-m-d H:i:s');
            $_SESSION['feedback'] = $feedback;
            
            $login_info = date('Y-m-d H:i:s') . " - Пользователь: $username\n";
            file_put_contents('login_history.txt', $login_info, FILE_APPEND);
            
            header('Location: about.php');
            exit;
        } else {
            $errors[] = "Неверное имя пользователя или пароль";
        }
    }
}

$_SESSION['errors'] = $errors ?? [];
include 'login.html';
