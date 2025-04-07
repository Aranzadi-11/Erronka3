<?php

include 'dbKonexioa.php';

session_start();

include 'header.php'; // Barran erabiltzailearen egoera egiaztatzeko
 
// Erabiltzailea logeaturik ez badago, login.php-ra bideratu

if (!isset($_SESSION['idBezeroa'])) {

    header('Location: login.php');

    exit();

}
 
// Deshabilitar el caché para evitar que la página se pueda volver a cargar al retroceder

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");

header("Pragma: no-cache");

header("Expires: 0");
 
// Mezuak hasieratu

$success = "";

$error = "";

$checkin = "";

$checkout = "";

$logelaIzena = "";

$gauak = 0;

$prezioTotala = 0.0;
 
// GET metodoa erabiltzen da datuak jasotzeko

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    // Get bidezko datuak jasotzen dira

    if (isset($_GET['checkin'], $_GET['checkout'], $_GET['idLogela'], $_GET['izena'], $_GET['prezioa'])) {

        $checkin = $_GET['checkin'];

        $checkout = $_GET['checkout'];

        $idLogela = $_GET['idLogela'];

        $logelaIzena = $_GET['izena'];

        $room_price = $_GET['prezioa'];
 
        // Sarrera eta irteera datak kalkulatu eta gau kopurua eta prezioa lortu

        $sarrera = DateTime::createFromFormat('d/m/Y', $checkin);

        $irteera = DateTime::createFromFormat('d/m/Y', $checkout);

        if ($sarrera && $irteera) {

            $checkin = $sarrera->format('Y-m-d');

            $checkout = $irteera->format('Y-m-d');

            $interval = $sarrera->diff($irteera);

            $gauak = $interval->days;

            $prezioTotala = $room_price * $gauak; // Prezioa kalkulatu

        } else {

            $error = "Data formatua ez da zuzena.";

        }

    }

}
 
// Erreserba prozesatzen da "Erreserba ordaindu" botoia sakatzen denean

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirm'])) {

    // Formularioan sartzen diren datuak

    if (isset($_POST['idLogela'], $_POST['checkin'], $_POST['checkout'])) {

        $idLogela = $_POST['idLogela'];

        $checkin = $_POST['checkin'];

        $checkout = $_POST['checkout'];

        $user_id = $_SESSION['idBezeroa'];
 
        // Logela datuak "logelak" taulatik berreskuratzea

        $sql_room = "SELECT * FROM logelak WHERE idLogela = ?";

        $stmt = $conn->prepare($sql_room);

        $stmt->bind_param("i", $idLogela);

        $stmt->execute();

        $result_room = $stmt->get_result();

        if ($result_room->num_rows > 0) {

            $room = $result_room->fetch_assoc();

            $logelaIzena = $room['izena'];       // Logelaren izena

            $room_price = $room['prezioa'];    // Logelaren prezioa

        } else {

            $error = "Logela ez da aurkitu.";

        }
 
        // Sarrera eta irteera data kalkulatzea eta gau kopurua ateratzea

        $sarrera = DateTime::createFromFormat('Y-m-d', $checkin);

        $irteera = DateTime::createFromFormat('Y-m-d', $checkout);

        if ($sarrera && $irteera) {

            $interval = $sarrera->diff($irteera);

            $gauak = $interval->days;

            if ($gauak <= 0) {

                $error = "Data ezberdinduak ez dira baliozkoak.";

            }

            $prezioTotala = $room_price * $gauak; // Prezioa kalkulatzea (logelaren prezioa * gauak)

        } else {

            $error = "Data formatua ez da zuzena.";

        }
 
        if (empty($error)) {

            // "erreserbak" taulatik datuak sartuko diren datuak

            $erreserbaEguna = date('Y-m-d'); // Gaurko data

            $sarreraOrdua = $checkin . " 16:00:00"; // Sarrera ordua

            $irteeraOrdua = $checkout . " 11:00:00"; // Irteera ordua

            $iruzkina = ""; // Iruzkina hutsik uzten dugu
 
            // Erreserba taulatik datuak sartzea

            $sql_insert = "INSERT INTO erreserbak (idLogela, idBezeroa, erreserbaEguna, sarreraEguna, irteeraEguna, sarreraOrdua, irteeraOrdua, iruzkina, prezioa) 

                           VALUES (?, (SELECT idBezeroa FROM bezeroak WHERE idBezeroa = ?), ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($sql_insert);

            $stmt->bind_param("iissssssd", $idLogela, $user_id, $erreserbaEguna, $checkin, $checkout, $sarreraOrdua, $irteeraOrdua, $iruzkina, $prezioTotala);
 
            if ($stmt->execute() === TRUE) {

                $success = "Erreserba arrakastatsua izan da!";

                echo "<script>

                        alert('Erosketa arrakastatsua izan da');

                        window.location.href = 'index.php';
</script>";

                exit();

            } else {

                $error = "Errorea gertatu da erreserban: " . $conn->error;

                echo "<script>

                        alert('Erosketa egiterakoan akats bat gertatu da, saiatu berriro');

                        window.location.href = 'index.php';
</script>";

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
</head>
<body>
 
    <div id="reservation-container">
<h2>Logela erreserba</h2>
<?php

            // Erreserba edo errore mezua erakusteko

            if (!empty($success)) {

                echo "<p style='color:green;'>$success</p>";

            } elseif (!empty($error)) {

                echo "<p style='color:red;'>$error</p>";

            }

        ?>
 
        <!-- Erreserbaren informazioa ikusteko -->
<h3>Erreserba informazioa</h3>
<p><strong class="highlight">Logela:</strong> <?php echo htmlspecialchars($logelaIzena); ?></p>
<p><strong class="highlight">Sarrera data:</strong> <?php echo htmlspecialchars($checkin); ?></p>
<p><strong class="highlight">Irteera data:</strong> <?php echo htmlspecialchars($checkout); ?></p>
<p><strong class="highlight">Prezioa:</strong> <?php echo $prezioTotala; ?> €</p>
 
        <!-- Formulario para confirmar la reserva -->
<form method="POST" action="">
<input type="hidden" name="idLogela" value="<?php echo htmlspecialchars($idLogela); ?>">
<input type="hidden" name="checkin" value="<?php echo htmlspecialchars($checkin); ?>">
<input type="hidden" name="checkout" value="<?php echo htmlspecialchars($checkout); ?>">
<button type="submit" name="confirm">Erreserba ordaindu</button>
</form>
</div>
</body>
</html>

 