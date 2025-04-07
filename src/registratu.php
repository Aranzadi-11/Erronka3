<?php
include 'dbKonexioa.php';
 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $izena = $_POST['izena'];
    $abizena = $_POST['abizena'];
    $erabiltzaileIzena = $_POST['erabiltzaileIzena'];
    $pasahitza = $_POST['pasahitza'];
    $jaiotzeEguna = $_POST['jaiotzeEguna'];
    $emaila = $_POST['emaila'];
 
    $hashed_password = password_hash($pasahitza, PASSWORD_DEFAULT);
 
    // Erabiltzailea existitzen den egiaztatu
    $stmt_check = $conn->prepare("SELECT * FROM bezeroak WHERE erabiltzaileIzena = ?");
    $stmt_check->bind_param("s", $erabiltzaileIzena);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();
 
    if ($result_check->num_rows > 0) {
        $error = "Erabiltzailea erregistratuta dago.";
    } else {
        // Erabiltzailea gehitu
        $stmt_insert = $conn->prepare("INSERT INTO bezeroak (izena, abizena, erabiltzaileIzena, pasahitza, jaiotzeEguna, emaila)
                                       VALUES (?, ?, ?, ?, ?, ?)");
        $stmt_insert->bind_param("ssssss", $izena, $abizena, $erabiltzaileIzena, $hashed_password, $jaiotzeEguna, $emaila);
 
        if ($stmt_insert->execute()) {
            header('Location: login.php');
            exit();
        } else {
            $error = "Akats bat gertatu da erregistroa egitean.";
        }
 
        $stmt_insert->close();
    }
 
    $stmt_check->close();
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
            <label for="izena">Izena:</label>
            <input type="text" id="izena" name="izena" required>
 
            <label for="abizena">Abizena:</label>
            <input type="text" id="abizena" name="abizena" required>
 
            <label for="erabiltzaileIzena">Erabiltzaile izena:</label>
            <input type="text" id="erabiltzaileIzena" name="erabiltzaileIzena" required>
 
            <label for="pasahitza">Pasahitza:</label>
            <input type="password" id="pasahitza" name="pasahitza" required>
 
            <label for="jaiotzeEguna">Jaiotze eguna:</label>
            <input type="date" id="jaiotzeEguna" name="jaiotzeEguna" required>
 
            <label for="emaila">Emaila:</label>
            <input type="email" id="emaila" name="emaila" required>
 
            <button type="submit" class="submit-button">Erregistratu</button>
        </form>
 
        <br>
        <div class="login-link">
            <p>Kontua duzu? <a href="login.php">Logeatu hemen</a></p>
        </div>
    </div>
   
 
</body>
</html>
 
 