<?php 
include 'db.php';
session_start();

$stmt = $pdo->query("SELECT * FROM services");
$services = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles/main.css">
    <title>Главная страница</title>
</head>
<body>
    <?php include 'header.php'; ?> 

    <div class="container">

        <?php if (isset($_SESSION['user'])): ?>
            <h1>Добро пожаловать, <?= htmlspecialchars($_SESSION['user']['username']) ?></h1>
            <a href="dashboard.php" class="button">Перейти в личный кабинет</a>
        <?php else: ?>
            <h1>Добро пожаловать на сайт</h1>
            <p>Войдите или зарегистрируйтесь, чтобы получить доступ к личному кабинету.</p>
        <?php endif; ?>

        <div class="main-content">
            <h2 class="services-title">Услуги:</h2>
            <?php if (!empty($services)): ?>
                <div class="services-grid">
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
                </div>
            <?php else: ?>
                <p>Услуги пока не добавлены.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
