<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
    $stmt->execute(['username' => $username, 'password' => $password]);

    $success = "Регистрация успешна!";
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles/main.css">
    <title>Регистрация</title>
</head>
<body>
    <div class="container">

    <p><a href="index.php" class="back-to-home">На главную</a></p>
<div class="container">
    <h1>Регистрация</h1>
    <form method="post">
        <label for="username">Логин</label>
        <input type="text" name="username" id="username" required>
        
        <label for="password">Пароль</label>
        <input type="password" name="password" id="password" required>
        
        <input type="submit" value="Зарегистрироваться">
    </form>
</div>
</body>
</html>
