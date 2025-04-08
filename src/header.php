<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
 
<header class="navbar">
    <div class="logo-container">
        <img src="../public/BBC_Grand_Hotel_Logo.png" alt="BBC Grand Hotel logoa">
        <h1>BBC GRAND HOTEL</h1>
    </div>
    <nav class="nav-links">
        <a href="index.php">Logelak</a>
        <a href="erreserbak.php">Erreserbak</a>
        <a href="zerbitzuak.php">Zerbitzuak</a>
        <a href="kontaktuak.php">Kontaktua</a>
        <a href="koloreAldaketa.php">Koloreak Aldatu</a>
 
        <?php if (isset($_SESSION['idBezeroa'])): ?>
            <div class="user-info">
                <span><?= htmlspecialchars($_SESSION['erabiltzaileIzena']) ?></span>
                <a href="logout.php">
                    <img class="login-icon" src="../public/logout.png" alt="Logout">
                </a>
            </div>
        <?php else: ?>
            <a href="login.php">
                <img class="login-icon" src="../public/login.png" alt="Login">
            </a>
        <?php endif; ?>
    </nav>
</header>
 