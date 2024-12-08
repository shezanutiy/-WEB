<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = trim($_POST['full_name']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $birthdate = $_POST['birthdate'];

    $currentYear = date('Y');
    $birthYear = date('Y', strtotime($birthdate));

    if (empty($fullName) || empty($username) || empty($password) || empty($birthdate)) {
        $error = "Все поля обязательны для заполнения.";
    } elseif ($birthYear > $currentYear) {
        
        $error = "Год рождения не может быть больше текущего года.";
    } else {

        $success = "Регистрация прошла успешно!";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация пользователя</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Регистрация пользователя</h1>

        <?php if (isset($error)): ?>
            <div class="alert error"><?php echo $error; ?></div>
        <?php endif; ?>

        <?php if (isset($success)): ?>
            <div class="alert success"><?php echo $success; ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="full_name">ФИО:</label>
                <input type="text" id="full_name" name="full_name" >
            </div>

            <div class="form-group">
                <label for="username">Логин:</label>
                <input type="text" id="username" name="username" >
            </div>

            <div class="form-group">
                <label for="password">Пароль:</label>
                <input type="password" id="password" name="password" >
            </div>

            <div class="form-group">
                <label for="birthdate">Дата рождения:</label>
                <input type="date" id="birthdate" name="birthdate" >
            </div>

            <button type="submit">Зарегистрироваться</button>
        </form>
    </div>
</body>
</html>