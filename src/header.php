<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
define("APP_DIR", __DIR__); 
require_once(APP_DIR . '/itzulpenak/translations.php');

if (isset($_POST["selectedLang"])) {
    $_SESSION["_LANGUAGE"] = $_POST["selectedLang"];
}
?>
<header class="navbar">
    <div class="logo-container">
        <img src="../public/BBC_Grand_Hotel_Logo.png" alt="BBC Grand Hotel logoa">
        <h1>BBC GRAND HOTEL</h1>
    </div>

    <nav class="nav-links">
        <a href="index.php"><?= trans("Logelak") ?></a>
        <a href="erreserbak.php"><?= trans("Erreserbak") ?></a>
        <a href="zerbitzuak.php"><?= trans("Zerbitzuak") ?></a>
        <a href="kontaktuak.php"><?= trans("Kontaktua") ?></a>
        <a href="kolorePost.php"><?= trans("Web Konfigurazioa") ?></a>

        <form id="langForm" method="post" action="" style="display:none;">
            <input type="hidden" name="selectedLang" id="selectedLangInput">
        </form>

        <a href="#" id="languageSwitcher" class="icon-link">
            <img id="langIcon" 
                src="../public/<?=
                    match ($_SESSION["_LANGUAGE"] ?? 'eus') {
                        'es' => 'espanol.png',
                        'en' => 'ingles.png',
                        default => 'euskera.png'
                    }
                ?>" 
                alt="Hizkuntza" class="lang-icon">
        </a>

        <?php if (isset($_SESSION['idBezeroa'])): ?>
            <div class="erabiltzailea">
                <span><?= htmlspecialchars($_SESSION['erabiltzaileIzena']) ?></span>
                <a href="logout.php">
                    <img class="login-icon" src="../public/logout.png" alt="<?= trans("Saioa itxi") ?>">
                </a>
            </div>
        <?php else: ?>
            <a href="login.php">
                <img class="login-icon" src="../public/login.png" alt="<?= trans("Saioa hasi") ?>">
            </a>
        <?php endif; ?>
    </nav>
</header>

<script>
document.getElementById('languageSwitcher').addEventListener('click', function(e) {
    e.preventDefault();

    const img = document.getElementById('langIcon');
    const langInput = document.getElementById('selectedLangInput');
    let currentLang = img.src.split("/").pop();
    let nextLang = "";

    if (currentLang === "euskera.png") {
        img.src = "../public/espanol.png";
        nextLang = "es";
    } else if (currentLang === "espanol.png") {
        img.src = "../public/ingles.png";
        nextLang = "en";
    } else {
        img.src = "../public/euskera.png";
        nextLang = "eus";
    }

    langInput.value = nextLang;
    document.getElementById('langForm').submit();
});
</script>
