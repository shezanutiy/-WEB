<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    die("Доступ запрещён!");
}

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    $stmt = $pdo->prepare("SELECT * FROM services WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $service = $stmt->fetch();

    if (!$service) {
        die("Услуга не найдена!");
    }
} else {
    die("Некорректный запрос.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $service['image']; 

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageTmpName = $_FILES['image']['tmp_name'];
        $imageName = basename($_FILES['image']['name']);
        $imagePath = 'uploads/' . $imageName;

        if (move_uploaded_file($imageTmpName, $imagePath)) {
            $image = $imagePath;
        }
    }

    $stmt = $pdo->prepare("UPDATE services SET title = :title, description = :description, price = :price, image = :image WHERE id = :id");
    $stmt->execute(['title' => $title, 'description' => $description, 'price' => $price, 'image' => $image, 'id' => $id]);

    $successMessage = "Услуга успешно обновлена!";
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles/main.css">
    <title>Редактировать услугу</title>
</head>
<body>
<?php include 'header.php'; ?>
<div class="container">
    <p><a href="admin.php" class="back-to-home">Назад в админ-панель</a></p>
    <h1>Редактировать услугу</h1>

    <?php if (isset($successMessage)): ?>
        <p class="success"><?= htmlspecialchars($successMessage) ?></p>
    <?php endif; ?>

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
