<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles/main.css">
    <title>Личный кабинет</title>
</head>
<body>
<div class="container">
    <!-- Ссылка на главную -->
    <p><a href="index.php" class="back-to-home">На главную</a></p>
<div class="container">
    <h1>Личный кабинет</h1>
    <p>Добро пожаловать, <strong><?= htmlspecialchars($user['username']) ?></strong></p>
    <p>Роль: <?= htmlspecialchars($user['role']) ?></p>
    
    <!-- Проверяем роль пользователя -->
    <?php if ($user['role'] === 'admin'): ?>
        <p><a href="admin.php">Перейти в админ-панель</a></p>
    <?php endif; ?>
    
    <a href="edit.php">Редактировать профиль</a> |
    <a href="logout.php">Выйти</a>
</div>
</body>
</html>
