<?php
include 'dbKonexioa.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT idBezeroa, erabiltzaileIzena, pasahitza FROM bezeroak WHERE erabiltzaileIzena = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        if (password_verify($password, $user['pasahitza'])) {
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
</head>
<body>

    <?php include 'header.php'; ?>

    <div id="login-container">
        <h2>Logeatu</h2>
        <?php
        if (isset($error)) {
            echo "<p class='error-message'>$error</p>";
        }
        ?>
        <form action="login.php" method="POST" class="login-form">
            <label for="username">Erabiltzaile izena:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Pasahitza:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit" class="submit-button">Sartu</button>
        </form>

        <br>
        <div class="register-link">
            <p>Ez daukazula konturik? <a href="registratu.php">Erregistratu hemen</a></p>
        </div>
    </div>

</body>
</html>
