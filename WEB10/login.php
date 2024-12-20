<?php
include 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($action === 'login') {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            header('Location: dashboard.php');
            exit;
        } else {
            $error = "Неверный логин или пароль!";
        }
}
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles/main.css">
    <title>Авторизация</title>
</head>
<body>
<?php include 'header.php'; ?>
<div class="container">
<div class="container">
    <h1>Авторизация</h1>

    <?php if (!empty($error)): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <?php if (!empty($success)): ?>
        <p class="success"><?= htmlspecialchars($success) ?></p>
    <?php endif; ?>

    <div class="form-container">
        <div class="form-section">
            <h2>Войти</h2>
            <form method="post">
                <input type="hidden" name="action" value="login">
                <label for="login-username">Логин</label>
                <input type="text" name="username" id="login-username" required>

                <label for="login-password">Пароль</label>
                <input type="password" name="password" id="login-password" required>

                <input type="submit" value="Войти">
            </form>
        </div>
    </div>
</div>
</body>
</html>