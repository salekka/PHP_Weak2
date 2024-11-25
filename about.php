<?php
session_start();
// Проверяем, установлен ли пользователь в сессии
if (!isset($_SESSION['user']))
{
    header('Location: index.php'); // Если пользователь не установлен, перенаправляем его на главную страницу
    exit;
}

// Создаем массив $userData для хранения информации о пользователе
$userData = [
    'username' => $_SESSION['user']['username'],
    'role' => $_SESSION['user']['role'],
    'login_time' => $_SESSION['login_time'],
    'feedback' => $_SESSION['feedback']
];

// Проверяем, является ли роль пользователя 'admin'
if ($_SESSION['user']['role'] === 'admin') 
{
    $userData['server_info'] = $_SERVER;
    $userData['login_history'] = file_get_contents('login_history.txt');
}

include 'about.html';
