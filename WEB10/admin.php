<?php
include 'db.php';
session_start();

// Проверяем, что текущий пользователь - администратор
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    die("Доступ запрещён!");
}

// Получаем список всех пользователей
$stmt = $pdo->query("SELECT * FROM users");
$users = $stmt->fetchAll();

// Получаем список всех услуг
$stmt = $pdo->query("SELECT * FROM services");
$services = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles/main.css">
    <title>Админ панель</title>
</head>
<body>
<div class="container">
    <!-- Ссылка на главную -->
    <p><a href="index.php" class="back-to-home">На главную</a></p>

    <h1>Админ панель</h1>
    
    <!-- Добавление нового пользователя и услуги -->
    <a href="adduser.php" class="back-to-home">Добавить нового пользователя</a><br><br>
    <br>
    <a href="add_service.php" class="back-to-home">Добавить новую услугу</a><br><br>

    <!-- Список пользователей -->
    <div class="section-title">Список пользователей</div>
    <?php if (!empty($users)): ?>
        <table>
            <thead>
                <tr>
                    <th>Логин</th>
                    <th>Роль</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= htmlspecialchars($user['username']) ?></td>
                        <td><?= htmlspecialchars($user['role']) ?></td>
                        <td>
                            <a href="edit.php?id=<?= $user['id'] ?>">Редактировать</a> |
                            <a href="delete.php?id=<?= $user['id'] ?>">Удалить</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Нет пользователей.</p>
    <?php endif; ?>

        <br>
    <div class="section-title">Список услуг</div>
    <?php if (!empty($services)): ?>
        <table>
            <thead>
                <tr>
                    <th>Название</th>
                    <th>Описание</th>
                    <th>Цена</th>
                    <th>Изображение</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($services as $service): ?>
                    <tr>
                        <td><?= htmlspecialchars($service['title']) ?></td>
                        <td><?= htmlspecialchars($service['description']) ?></td>
                        <td><?= htmlspecialchars($service['price']) ?> руб.</td>
                        <td>
                            <?php if ($service['image']): ?>
                                <img src="<?= htmlspecialchars($service['image']) ?>" alt="Изображение услуги" class="service-image">
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="edit_service.php?id=<?= $service['id'] ?>">Редактировать</a> |
                            <a href="delete_service.php?id=<?= $service['id'] ?>">Удалить</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Услуги пока не добавлены.</p>
    <?php endif; ?>
</div>
</body>
</html>
