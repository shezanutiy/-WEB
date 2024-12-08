<?php
include 'db.php';
session_start();

// Проверка, что пользователь авторизован
if (!isset($_SESSION['user'])) {
    die("Доступ запрещён!");
}

// Получаем ID услуги из URL
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    // Загружаем информацию о услуге по ID
    $stmt = $pdo->prepare("SELECT * FROM services WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $service = $stmt->fetch();

    // Проверяем, что услуга существует и принадлежит текущему пользователю
    if (!$service || $service['user_id'] !== $_SESSION['user']['id']) {
        die("Вы не можете редактировать эту услугу!");
    }
} else {
    die("Некорректный запрос.");
}

// Обработка формы редактирования услуги
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $service['image']; // Если изображение не меняется, оставляем старое

    // Загружаем новое изображение, если выбрано
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageTmpName = $_FILES['image']['tmp_name'];
        $imageName = basename($_FILES['image']['name']);
        $imagePath = 'uploads/' . $imageName;

        // Перемещаем загруженное изображение в нужную папку
        if (move_uploaded_file($imageTmpName, $imagePath)) {
            $image = $imagePath;
        }
    }

    // Обновляем данные услуги в базе данных
    $stmt = $pdo->prepare("UPDATE services SET title = :title, description = :description, price = :price, image = :image WHERE id = :id");
    $stmt->execute(['title' => $title, 'description' => $description, 'price' => $price, 'image' => $image, 'id' => $id]);

    echo "Услуга успешно обновлена!";
    header('Location: dashboard.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles/main.css">
    <title>Редактировать услугу</title>
</head>
<body>
<div class="container">
    <h1>Редактировать услугу</h1>

    <!-- Форма редактирования услуги -->
    <form method="post" enctype="multipart/form-data">
        <label for="title">Название услуги:</label>
        <input type="text" name="title" id="title" value="<?= htmlspecialchars($service['title']) ?>" required>

        <label for="description">Описание услуги:</label>
        <textarea name="description" id="description" required><?= htmlspecialchars($service['description']) ?></textarea>

        <label for="price">Цена:</label>
        <input type="number" name="price" id="price" value="<?= htmlspecialchars($service['price']) ?>" step="0.01" required>

        <label for="image">Изображение услуги:</label>
        <input type="file" name="image" id="image" accept="image/*">

        <?php if ($service['image']): ?>
            <p>Текущее изображение:</p>
            <img src="<?= htmlspecialchars($service['image']) ?>" alt="Изображение услуги" class="service-image">
        <?php endif; ?>

        <button type="submit">Обновить услугу</button>
    </form>
</div>
</body>
</html>
