<?php
include 'db.php';
session_start();

// Проверка, что пользователь авторизован
if (!isset($_SESSION['user'])) {
    die("Доступ запрещён!");
}

// Обработка формы добавления услуги
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = null; // Изначально пустое изображение

    // Проверка и загрузка изображения
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageTmpName = $_FILES['image']['tmp_name'];
        $imageName = basename($_FILES['image']['name']);
        $imagePath = 'uploads/' . $imageName; // Путь для хранения изображения

        // Перемещаем загруженное изображение в нужную папку
        if (move_uploaded_file($imageTmpName, $imagePath)) {
            $image = $imagePath; // Если изображение загружено, сохраняем его путь
        } else {
            $imageError = "Ошибка при загрузке изображения.";
        }
    } else {
        $imageError = "Не выбрано изображение или ошибка при загрузке.";
    }

    // Если изображение загружено, добавляем услугу в базу данных
    if (empty($imageError)) {
        $stmt = $pdo->prepare("INSERT INTO services (title, description, price, image, user_id) VALUES (:title, :description, :price, :image, :user_id)");
        $stmt->execute(['title' => $title, 'description' => $description, 'price' => $price, 'image' => $image, 'user_id' => $_SESSION['user']['id']]);

        // Сообщение об успешном добавлении
        $successMessage = "Услуга успешно добавлена!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles/main.css">
    <title>Добавить услугу</title>
</head>
<body>
<div class="container">
    <h1>Добавить услугу</h1>

    <!-- Выводим сообщение об успешном добавлении или ошибке -->
    <?php if (isset($successMessage)): ?>
        <p class="success"><?= htmlspecialchars($successMessage) ?></p>
    <?php endif; ?>

    <?php if (isset($imageError)): ?>
        <p class="error"><?= htmlspecialchars($imageError) ?></p>
    <?php endif; ?>

    <!-- Форма добавления услуги -->
    <form method="post" enctype="multipart/form-data">
        <label for="title">Название услуги:</label>
        <input type="text" name="title" id="title" required>

        <label for="description">Описание услуги:</label>
        <textarea name="description" id="description" required></textarea>

        <label for="price">Цена:</label>
        <input type="number" name="price" id="price" step="0.01" required>

        <label for="image">Изображение услуги:</label>
        <input type="file" name="image" id="image" accept="image/*" required>

        <button type="submit">Добавить услугу</button>
    </form>
</div>
</body>
</html>
