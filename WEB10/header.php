<div class="header">
    <div class="header-left">
    <a href="index.php" class="logo">ПСИХОЛОГИЯ</a>
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
