<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotela</title>
    <link rel="stylesheet" type="text/css" href="../public/styles.css">
    <script defer src="../public/scripts.js"></script>
    <?php include 'layout.php'; ?>
</head>
<body>
 
    <?php include 'header.php'; ?>
 
    <!-- Títulua -->
    <h1><?= trans("Hotelaren Erreserbak") ?></h1>
 
    <!-- Erabiltzailea erregistratuta ez badago -->
    <?php
    if (!isset($_SESSION['idBezeroa'])) {
        echo '<div style="text-align: center; margin-top: 20px;">
                <p>' . trans("Zure erreserbak ikusteko erregistratu zaitez.") . '</p>
                <a href="login.php"><button type="submit">' . trans("Login") . '</button></a>
              </div>';
    } else {
        include 'dbKonexioa.php';
        $user_id = $_SESSION['idBezeroa'];
 
        // Reserbak eskuratzeko SQL kontsulta
        $sql = "SELECT E.idErreserba, L.izena AS logelaIzena, B.erabiltzaileIzena, E.erreserbaEguna, E.sarreraEguna, E.irteeraEguna, E.sarreraOrdua, E.irteeraOrdua, E.iruzkina, E.prezioa 
                FROM Erreserbak E 
                JOIN Logelak L ON E.idLogela = L.idLogela 
                JOIN Bezeroak B ON E.idBezeroa = B.idBezeroa 
                WHERE E.idBezeroa = $user_id";
        $result = $conn->query($sql);
 
        // Erreserbak aurkitu ez badira mezua
        if ($result->num_rows == 0) {
            echo '<div style="text-align: center; margin-top: 20px;">
                    <p>' . trans("Ez duzu erreserbarik kontu honetan.") . '</p>
                  </div>';
        } else {
            echo '<div id="booking-container">';
 
            // Erreserbak irudikatzea
            while($row = $result->fetch_assoc()) {
                echo '<div class="booking">';  
                echo '<div class="booking-details">';
                echo '<p><strong>' . trans("Erreserba Zenbakia") . ': ' . $row["idErreserba"] . '</strong></p>';
                echo '<p>' . trans("Logela Izena") . ': ' . $row["logelaIzena"] . '</p>';
                echo '<p>' . trans("Bezeroa Izena") . ': ' . $row["erabiltzaileIzena"] . '</p>';
                echo '<p>' . trans("Erreserba Eguna") . ': ' . $row["erreserbaEguna"] . '</p>';
                echo '<p>' . trans("Sarrera Eguna") . ': ' . $row["sarreraEguna"] . '</p>';
                echo '<p>' . trans("Irteera Eguna") . ': ' . $row["irteeraEguna"] . '</p>';
                echo '<p>' . trans("Sarrera Ordua") . ': ' . $row["sarreraOrdua"] . '</p>';
                echo '<p>' . trans("Irteera Ordua") . ': ' . $row["irteeraOrdua"] . '</p>';
                echo '<p>' . trans("Iruzkina") . ': ' . $row["iruzkina"] . '</p>';
                echo '<p><strong>' . trans("Prezioa") . ': ' . $row["prezioa"] . '€</strong></p>';
                echo '</div>';
                echo '</div>';
            }

            echo '<div style="text-align: center; margin-top: 20px;">
                    <p>' . trans("Zure erreserbak editatzeko gure aplikazioa instalatu.") . '</p>
                  </div>';
 
            echo '</div>';
        }
 
        $conn->close(); // Datu basearekin lotura itxi
    }
    ?>
 
    <?php include 'footer.php'; ?>
</body>
</html>