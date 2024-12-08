<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

echo "Добро пожаловать, " . $_SESSION['user']['username'];
if ($_SESSION['user']['role'] === 'admin') {
    echo "<a href='admin.php'>Админ панель</a>";
} else {
    echo "<a href='edit.php'>Редактировать профиль</a>";
}
?>
