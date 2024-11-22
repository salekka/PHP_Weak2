<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

$userData = [
    'username' => $_SESSION['user']['username'],
    'role' => $_SESSION['user']['role'],
    'login_time' => $_SESSION['login_time'],
    'feedback' => $_SESSION['feedback']
];

if ($_SESSION['user']['role'] === 'admin') {
    $userData['server_info'] = $_SERVER;
    $userData['login_history'] = file_get_contents('login_history.txt');
}

include 'about.html';