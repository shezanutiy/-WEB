<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    die("Доступ запрещён!");
}

$stmt = $pdo->query("SELECT * FROM users");
$users = $stmt->fetchAll();

echo "<h1>Админ панель</h1>";

echo "<a href='adduser.php' style='display: inline-block; margin-bottom: 20px; padding: 10px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 5px;'>Добавить нового пользователя</a><br><br>";

echo "<table border='1' cellpadding='10' cellspacing='0'>";
echo "<tr><th>Логин</th><th>Роль</th><th>Действия</th></tr>";

foreach ($users as $user) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($user['username']) . "</td>";
    echo "<td>" . htmlspecialchars($user['role']) . "</td>";
    echo "<td>";
    echo "<a href='edit.php?id={$user['id']}'>Редактировать</a> | ";
    echo "<a href='delete.php?id={$user['id']}'>Удалить</a>";
    echo "</td>";
    echo "</tr>";
}

echo "</table>";
?>
