<?php
include 'dbKonexioa.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Si no está logueado, redirige a login
    exit();
}

// Recogemos los datos de la compra
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idLogela = $_POST['idLogela'];
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];
    $user_id = $_SESSION['user_id'];

    // Insertamos la compra en la base de datos
    $sql = "INSERT INTO Erosketak (user_id, idLogela, checkin, checkout) VALUES ('$user_id', '$idLogela', '$checkin', '$checkout')";

    if ($conn->query($sql) === TRUE) {
        $success = "Erosketa arrakastatsua izan da!";
    } else {
        $error = "Errorea gertatu da erosketan: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erosketa - Logela</title>
    <link rel="stylesheet" href="../public/styles.css">
</head>
<body>

    <?php include 'header.php'; ?>

    <div id="purchase-container">
        <h2>Erreserba - Logela</h2>

        <?php
        if (isset($success)) {
            echo "<p style='color:green;'>$success</p>";
        } elseif (isset($error)) {
            echo "<p style='color:red;'>$error</p>";
        }
        ?>

        <form action="erosketa.php" method="POST">
            <input type="hidden" name="idLogela" value="<?php echo $_GET['idLogela']; ?>">

            <label for="checkin">Sarrera data:</label>
            <input type="date" id="checkin" name="checkin" required>

            <label for="checkout">Irteera data:</label>
            <input type="date" id="checkout" name="checkout" required>

            <button type="submit">Erosketa egin</button>
        </form>
    </div>

</body>
</html>
