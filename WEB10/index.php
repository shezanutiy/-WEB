<?php 
include 'db.php';
session_start();

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];

    $stmt = $pdo->query("SELECT * FROM services");
    $services = $stmt->fetchAll();
} else {
    $stmt = $pdo->query("SELECT * FROM services");
    $services = $stmt->fetchAll();
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles/main.css">
    <title>Главная страница</title>
</head>
<body>
<div class="header">
    <div class="header-left">
        <h1 class="logo">ПСИХОЛОГИЯ</h1>
    </div>
    <div class="header-right">
        <?php if (!isset($_SESSION['user'])): ?>
            <a href="login.php" class="button">Войти</a>
            <a href="register.php" class="button">Зарегистрироваться</a>
        <?php else: ?>
            <a href="logout.php" class="logout-link">Выйти</a>
        <?php endif; ?>
    </div>
</div>

<div class="container">
    <?php if (isset($_SESSION['user'])): ?>
        <h1>Добро пожаловать, <?= htmlspecialchars($user['username']) ?></h1>
        <a href="dashboard.php" class="button">Перейти в личный кабинет</a>
    <?php else: ?>
        <h1>Добро пожаловать на сайт</h1>
        <p>Пожалуйста, войдите в аккаунт или зарегистрируйтесь для получения доступа к личному кабинету и услугам.</p>
    <?php endif; ?>

    <div class="main-content">
        <h2 class="services-title">УСЛУГИ:</h2>
        <?php if (!empty($services)): ?>
            <?php foreach ($services as $service): ?>
                <div class="service">
                    <?php if ($service['image']): ?>
                        <img src="<?= htmlspecialchars($service['image']) ?>" alt="<?= htmlspecialchars($service['title']) ?>" class="service-image">
                    <?php endif; ?>

                    <h3><?= htmlspecialchars($service['title']) ?></h3>
                    <p><?= htmlspecialchars($service['description']) ?></p>
                    <p><strong>Цена:</strong> <?= htmlspecialchars($service['price']) ?> руб.</p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Услуги пока не добавлены.</p>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
