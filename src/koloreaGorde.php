<?php
 
function changeConfig($inputValue)
{
    // XML konfigurazio fitxategiaren bidea definitu
    $xmlFile = '../public/koloreAldaketa.xml';
 
    // XML konfigurazioa kargatu
    $config = simplexml_load_file($xmlFile);
    if ($config === false) {
        die("Errorea: Ezin da XML fitxategia kargatu.");
    }
 
    $config->headerColor = $inputValue["headerColor"];
    $config->footerColor = $inputValue["footerColor"];
   
    if (!$config->asXML($xmlFile)) {
        die("Errorea: Ezin da XML fitxategia gorde.");
    }
}
 
// Egiaztatu formularioa bidali dela eta ekintza zuzena dela
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'changeConfig') {
    $xmlFile = '../public/koloreAldaketa.xml';
    $config = simplexml_load_file($xmlFile);
   
    if ($config === false) {
        die("Errorea: XML fitxategia ezin da kargatu.");
    }
 
    $headerColor = $_POST['headerColor'] ?? '#00008b';
    $footerColor = $_POST['footerColor'] ?? '#222';
   
    $config->headerColor = $headerColor;
    $config->footerColor = $footerColor;
 
    if (!$config->asXML($xmlFile)) {
        die("Errorea: Ezin izan da XML fitxategia gorde.");
    }
 
    // Birbideratu orri nagusira
    header('Location: index.php');
    exit();
}
?>
 