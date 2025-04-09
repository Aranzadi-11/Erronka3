<?php

include 'dbKonexioa.php';
session_start();
include 'header.php'; // Barran erabiltzailearen egoera egiaztatzeko

if (!isset($_SESSION['idBezeroa'])) {
    header('Location: login.php');
    exit();
}

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

$success = "";
$error = "";
$checkin = "";
$checkout = "";
$logelaIzena = "";
$gauak = 0;
$prezioTotala = 0.0;

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['checkin'], $_GET['checkout'], $_GET['idLogela'], $_GET['izena'], $_GET['prezioa'])) {
        $checkin = $_GET['checkin'];
        $checkout = $_GET['checkout'];
        $idLogela = $_GET['idLogela'];
        $logelaIzena = $_GET['izena'];
        $room_price = $_GET['prezioa'];

        $sarrera = DateTime::createFromFormat('d/m/Y', $checkin);
        $irteera = DateTime::createFromFormat('d/m/Y', $checkout);

        if ($sarrera && $irteera) {
            $checkin = $sarrera->format('Y-m-d');
            $checkout = $irteera->format('Y-m-d');
            $interval = $sarrera->diff($irteera);
            $gauak = $interval->days;
            $prezioTotala = $room_price * $gauak;
        } else {
            $error = "Data formatua ez da zuzena.";
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirm'])) {
    if (isset($_POST['idLogela'], $_POST['checkin'], $_POST['checkout'])) {
        $idLogela = $_POST['idLogela'];
        $checkin = $_POST['checkin'];
        $checkout = $_POST['checkout'];
        $user_id = $_SESSION['idBezeroa'];

        $sql_room = "SELECT * FROM logelak WHERE idLogela = ?";
        $stmt = $conn->prepare($sql_room);
        $stmt->bind_param("i", $idLogela);
        $stmt->execute();
        $result_room = $stmt->get_result();

        if ($result_room->num_rows > 0) {
            $room = $result_room->fetch_assoc();
            $logelaIzena = $room['izena'];
            $room_price = $room['prezioa'];
        } else {
            $error = "Logela ez da aurkitu.";
        }

        $sarrera = DateTime::createFromFormat('Y-m-d', $checkin);
        $irteera = DateTime::createFromFormat('Y-m-d', $checkout);

        if ($sarrera && $irteera) {
            $interval = $sarrera->diff($irteera);
            $gauak = $interval->days;

            if ($gauak <= 0) {
                $error = "Data ezberdinduak ez dira baliozkoak.";
            }

            $prezioTotala = $room_price * $gauak;
        } else {
            $error = "Data formatua ez da zuzena.";
        }

        if (empty($error)) {
            $erreserbaEguna = date('Y-m-d');
            $sarreraOrdua = $checkin . " 16:00:00";
            $irteeraOrdua = $checkout . " 11:00:00";
            $iruzkina = "";

            $sql_insert = "INSERT INTO erreserbak (idLogela, idBezeroa, erreserbaEguna, sarreraEguna, irteeraEguna, sarreraOrdua, irteeraOrdua, iruzkina, prezioa) 
                           VALUES (?, (SELECT idBezeroa FROM bezeroak WHERE idBezeroa = ?), ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql_insert);
            $stmt->bind_param("iissssssd", $idLogela, $user_id, $erreserbaEguna, $checkin, $checkout, $sarreraOrdua, $irteeraOrdua, $iruzkina, $prezioTotala);

            if ($stmt->execute() === TRUE) {
                $success = "Erosketa arrakastatsua izan da";
            } else {
                $error = "Errorea gertatu da erreserban: " . $conn->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="eu">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Erreserba - Logela</title>
<link rel="stylesheet" href="../public/styles.css">
<?php include 'layout.php'; ?>
</head>
<body>

<div id="reservation-container">
<h2>Logela erreserba</h2>
<?php
    if (!empty($success)) {
        echo "<p style='color:green;'>$success</p>";
    } elseif (!empty($error)) {
        echo "<p style='color:red;'>$error</p>";
    }
?>

<h3>Erreserba informazioa</h3>
<p><strong class="highlight">Logela:</strong> <?php echo htmlspecialchars($logelaIzena); ?></p>
<p><strong class="highlight">Sarrera data:</strong> <?php echo htmlspecialchars($checkin); ?></p>
<p><strong class="highlight">Irteera data:</strong> <?php echo htmlspecialchars($checkout); ?></p>
<p><strong class="highlight">Prezioa:</strong> <?php echo $prezioTotala; ?> €</p>

<form method="POST" action="">
    <input type="hidden" name="idLogela" value="<?php echo htmlspecialchars($idLogela); ?>">
    <input type="hidden" name="checkin" value="<?php echo htmlspecialchars($checkin); ?>">
    <input type="hidden" name="checkout" value="<?php echo htmlspecialchars($checkout); ?>">
    <button type="submit" name="confirm">Erreserba ordaindu</button>
</form>
</div>

<?php if (!empty($success)) : ?>
<script>
    alert("<?php echo $success; ?>");
    window.location.href = "index.php";
</script>
<?php endif; ?>

</body>
</html>
