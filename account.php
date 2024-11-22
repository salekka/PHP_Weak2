<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: index.php');
    exit;
}

include 'storage.php';

$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 100;
$displayed_users = array_slice($users, 0, $limit);

include 'account.html';