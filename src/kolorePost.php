<?php
require_once("header.php");
require_once("dbKonexioa.php");
 
require_once("layout.php");

$defaultHeaderColor = "#00008b";
$defaultFooterColor = "#222";
 
 
$config = simplexml_load_file('../public/koloreAldaketa.xml');
$headerColor = isset($config->headerColor) ? (string) $config->headerColor : $defaultHeaderColor;
$footerColor = isset($config->footerColor) ? (string) $config->footerColor : $defaultFooterColor;
?>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotela</title>
    <link rel="stylesheet" type="text/css" href="../public/styles.css">
    <script defer src="../public/scripts.js"></script>
    <?php include 'layout.php'; ?>
</head>
<body>
    <div class="color-change-container">
        <h1><?= trans("Kolore Aldaketa") ?></h1>
        <br><br>
        <form action="koloreaGorde.php" method="POST" class="color-change-form">
            <input type="hidden" value="changeConfig" name="action"/>
            <div class="form-group">
                <label for="headerColor"><?= trans("Header kolorea") ?>:</label>
                <br>
                <input type="color" id="headerColor" name="headerColor" value="<?= $headerColor ?>" />
            </div>
           
            <div class="form-group">
                <label for="footerColor"><?= trans("Footer kolorea") ?>:</label>
                <br>
                <input type="color" id="footerColor" name="footerColor" value="<?= $footerColor ?>" />
            </div>
            <br>    
            <button type="submit" class="submit-button"><?= trans("Gorde") ?></button>
        </form>
    </div>
    <?php require_once "footer.php"; ?>
</body>
</html>