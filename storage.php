<?php
session_start();

$users = [];
// Админ
$users[] = [
    'username' => 'admin',
    'password' => 'admin123',
    'role' => 'admin'
];

// 100 пользователей
for ($i = 1; $i <= 100; $i++) {
    $users[] = [
        'username' => "user$i",
        'password' => "pass$i",
        'role' => 'user'
    ];
}