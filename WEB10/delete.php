<?php
include 'db.php';
session_start();

// Проверяем, что пользователь авторизован и имеет роль "admin"
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    die("Доступ запрещён!");
}

// Получаем ID пользователя из GET-запроса
if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    // Удаляем пользователя
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
    $stmt->execute(['id' => $id]);

    echo "Пользователь удалён!";
    header('Location: admin.php'); // Возвращаемся в админ-панель
    exit;
} else {
    echo "Некорректный запрос!";
}
?>
