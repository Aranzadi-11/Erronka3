<?php
include 'dbKonexioa.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $email = $_POST['email'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql_check = "SELECT * FROM bezeroak WHERE erabiltzaileIzena = '$username'";
    $result_check = $conn->query($sql_check);

    if ($result_check->num_rows > 0) {
        $error = "Erabiltzailea erregistratuta dago.";
    } else {

        $sql = "INSERT INTO bezeroak (izena, abizena, erabiltzaileIzena, password, jaiotzeEguna, emaila) 
                VALUES ('$nombre', '$apellido', '$username', '$hashed_password', '$fecha_nacimiento', '$email')";
        
        if ($conn->query($sql) === TRUE) {
            header('Location: login.php');
            exit();
        } else {
            $error = "Akats bat gertatu da erregistroa egitean.";
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erregistratu</title>
    <link rel="stylesheet" href="../public/styles.css">
</head>
<body>

    <?php include 'header.php'; ?>

    <div id="register-container">
        <h2>Erregistratu</h2>
        <?php
        if (isset($error)) {
            echo "<p class='error-message'>$error</p>";
        }
        ?>
        <form action="registratu.php" method="POST" class="register-form">
            <label for="nombre">Izena:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="apellido">Abizena:</label>
            <input type="text" id="apellido" name="apellido" required>

            <label for="username">Erabiltzaile izena:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Pasahitza:</label>
            <input type="password" id="password" name="password" required>

            <label for="fecha_nacimiento">Jaiotze eguna:</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>

            <label for="email">Emaila:</label>
            <input type="email" id="email" name="email" required>

            <button type="submit" class="submit-button">Erregistratu</button>
        </form>

        <br>
        <div class="login-link">
            <p>Kontua duzu? <a href="login.php">Logeatu hemen</a></p>
        </div>
    </div>
   

</body>
</html>
