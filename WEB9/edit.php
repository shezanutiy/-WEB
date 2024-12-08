<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user'])) {
    die("Доступ запрещён!");
}

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    if ($_SESSION['user']['role'] !== 'admin' && $_SESSION['user']['id'] !== $id) {
        die("У вас нет прав для редактирования этого пользователя!");
    }
} else {
    $id = $_SESSION['user']['id']; 
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
$stmt->execute(['id' => $id]);
$user = $stmt->fetch();

if (!$user) {
    die("Пользователь не найден!");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_BCRYPT) : $user['password'];
    $role = $_POST['role']; 

    if ($username !== $user['username']) {
        $checkStmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :username AND id != :id");
        $checkStmt->execute(['username' => $username, 'id' => $id]);
        if ($checkStmt->fetchColumn() > 0) {
            die("Логин уже занят!");
        }
    }

    $stmt = $pdo->prepare("UPDATE users SET username = :username, password = :password, role = :role WHERE id = :id");
    $stmt->execute(['username' => $username, 'password' => $password, 'role' => $role, 'id' => $id]);

    echo "Данные обновлены!";
    header('Location: dashboard.php');
    exit;
}
?>

<form method="post">
    <label for="username">Логин:</label>
    <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" placeholder="Логин" required>

    <label for="password">Пароль (оставьте пустым, если не меняете):</label>
    <input type="password" name="password" placeholder="Пароль">

    <?php if ($_SESSION['user']['role'] === 'admin'): ?>
        <label for="role">Роль:</label>
        <select name="role" required>
            <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>Пользователь</option>
            <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Администратор</option>
        </select>
    <?php endif; ?>

    <button type="submit">Сохранить</button>
</form>
