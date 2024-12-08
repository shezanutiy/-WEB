<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    die("Доступ запрещён!");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = $_POST['role'];

    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);

    if ($stmt->fetchColumn() > 0) {
        die("Логин уже существует. Выберите другой.");
    }

    $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (:username, :password, :role)");
    $stmt->execute(['username' => $username, 'password' => $password, 'role' => $role]);

    echo "Новый пользователь добавлен!";
    header('Location: admin.php'); 
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles/main.css">
    <title>Название страницы</title>
</head>
<body>
<div class="container">
    <p><a href="index.php" class="back-to-home">На главную</a></p>
<div class="container">
<h1>Добавление нового пользователя</h1>
<form method="post">
    <label for="username">Логин:</label>
    <input type="text" name="username" id="username" required><br><br>

    <label for="password">Пароль:</label>
    <input type="password" name="password" id="password" required><br><br>

    <label for="role">Роль:</label>
    <select name="role" id="role">
        <option value="user">User</option>
        <option value="admin">Admin</option>
    </select><br><br>

    <button type="submit">Добавить пользователя</button>
</form>
</div>
</body>
</html>
