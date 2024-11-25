<?php
session_start();

$users = [];
// Админ
$users[] = [
    'username' => 'admin',
    'password' => 'admin123',
    'role' => 'admin'
];

// Генерируем 100 обычных пользователей и добавляем их в массив
for ($i = 1; $i <= 100; $i++)
    {
    $users[] = [
        'username' => "user$i",
        'password' => "pass$i",
        'role' => 'user'
    ];
}
