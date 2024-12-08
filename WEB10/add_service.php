<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    die("Доступ запрещён!");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = null; 
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {

        $imageTmpName = $_FILES['image']['tmp_name'];
        $imageName = basename($_FILES['image']['name']);
        $imagePath = 'uploads/' . $imageName; 

        if (move_uploaded_file($imageTmpName, $imagePath)) {
            $image = $imagePath; 
        } else {
            $imageError = "Ошибка при загрузке изображения.";
        }
    } else {
        $imageError = "Не выбрано изображение или ошибка при загрузке.";
    }

    if (empty($imageError)) {
        $stmt = $pdo->prepare("INSERT INTO services (title, description, price, image) VALUES (:title, :description, :price, :image)");
        $stmt->execute(['title' => $title, 'description' => $description, 'price' => $price, 'image' => $image]);

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
    <p><a href="admin.php" class="back-to-home">Назад в админ-панель</a></p>
    <h1>Добавить новую услугу</h1>

    <?php if (isset($successMessage)): ?>
        <p class="success"><?= htmlspecialchars($successMessage) ?></p>
    <?php endif; ?>

    <?php if (isset($imageError)): ?>
        <p class="error"><?= htmlspecialchars($imageError) ?></p>
    <?php endif; ?>

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
