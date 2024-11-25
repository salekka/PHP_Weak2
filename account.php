<?php
session_start();
// Проверяем, установлен ли пользователь в сессии и является ли он администратором
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') 
{
    header('Location: index.php');
    exit;
}
// Подключаем файл 'storage.php', который должен содержать данные пользователей
include 'storage.php';

// Получаем параметр 'limit' из URL, если он установлен, иначе устанавливаем значение по умолчанию 100
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 100;
// Извлекаем пользователей из массива $users, ограничивая количество выводимых пользователей значением $limit
$displayed_users = array_slice($users, 0, $limit);

include 'account.html';
