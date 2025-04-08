<?php
include 'dbKonexioa.php';
session_start();

$error = ""; // Hutsik hasieran, error mezua erakusteko gero

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['logeatu'])) {
    // Egiaztatu POST datuak daudela
    $erabiltzaileIzena = isset($_POST['erabiltzaileIzena']) ? $_POST['erabiltzaileIzena'] : '';
    $pasahitza = isset($_POST['pasahitza']) ? $_POST['pasahitza'] : '';

    // Prestaturiko kontsulta segurtasunerako
    $stmt = $conn->prepare("SELECT idBezeroa, erabiltzaileIzena, pasahitza FROM bezeroak WHERE erabiltzaileIzena = ?");
    $stmt->bind_param("s", $erabiltzaileIzena);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($pasahitza, $user['pasahitza'])) {
            $_SESSION['idBezeroa'] = $user['idBezeroa'];
            $_SESSION['erabiltzaileIzena'] = $user['erabiltzaileIzena'];
            header('Location: index.php');
            exit();
        } else {
            $error = "Erabiltzaile izena edo pasahitz okerrak.";
        }
    } else {
        $error = "Erabiltzailea ez da aurkitu.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logeatu</title>
    <link rel="stylesheet" href="../public/styles.css">
    <?php include 'layout.php'; ?>
</head>
<body>

    <?php include 'header.php'; ?>

    <div id="login-container">
        <h2><?= trans("Logeatu") ?></h2>
        <?php
        if (!empty($error)) {
            echo "<p class='error-message'>$error</p>";
        }
        ?>
        <form action="login.php" method="POST" class="login-form">
            <label for="erabiltzaileIzena"><?= trans("Erabiltzaile Izena") ?>:</label>
            <input type="text" id="erabiltzaileIzena" name="erabiltzaileIzena" required>

            <label for="pasahitza"><?= trans("Pasahitza") ?>:</label>
            <input type="password" id="pasahitza" name="pasahitza" required>

            <button type="submit" name="logeatu" class="submit-button"><?= trans("Sartu") ?></button>
        </form>

        <br>
        <div class="register-link">
            <p><?= trans("Ez daukazula konturik?") ?> <a href="registratu.php"><?= trans("Erregistratu hemen") ?></a></p>
        </div>
    </div>

</body>
</html>
