<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotela</title>
    <link rel="stylesheet" type="text/css" href="../public/styles.css">
    <script defer src="../public/scripts.js"></script>
</head>
<body>

    <?php include 'header.php'; ?>

    <!-- Títulua -->
    <h1 style="text-align: center; margin-top: 20px;">Hotelaren Zerbitzuak</h1>

    <!-- Prezioaren arabera ordenatzeko filtroa -->
    <div style="text-align: center; margin-top: 20px;">
    <form method="GET">
        <label for="ordenatu">Ordenatu prezioaren arabera:</label>
        <select name="ordenatu" id="ordenatu" onchange="this.form.submit()">
            <option value="asc" <?php echo (isset($_GET['ordenatu']) && $_GET['ordenatu'] == 'asc') ? 'selected' : ''; ?>>Prezio baxuenetik altuenera</option>
            <option value="desc" <?php echo (isset($_GET['ordenatu']) && $_GET['ordenatu'] == 'desc') ? 'selected' : ''; ?>>Prezio altuenetik baxuenera</option>
        </select>
    </form>

    <div id="services-container">
        
        <?php
        include 'dbKonexioa.php'; // Datubasearekin konektatzen

        // Prezioaren arabera ordenatzeko logika
        $ordenatu = 'ASC'; // Lehenetsitako balioa
        if (isset($_GET['ordenatu'])) {
            if ($_GET['ordenatu'] == 'desc') {
                $ordenatu = 'DESC'; // Handiagoa txikienetik
            } else {
                $ordenatu = 'ASC'; // Txikiagoa handienetik
            }
        }

        // Kontsulta prestatu (zerbitzuen izena, deskribapena, prezioa eta argazkia)
        $sql = "SELECT izena, deskribapena, prezioa, argazkia FROM Zerbitzuak ORDER BY prezioa $ordenatu";

        // Kontsulta exekutatu
        $result = $conn->query($sql);

        // Zerbitzuak erakutsi
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="service">';  
                echo '<h2>' . $row["izena"] . '</h2>'; // Zerbitzuaren izena
                echo '<div class="service-image">'; 
                echo '<img src="' . $row["argazkia"] . '" alt="Zerbitzuaren argazkia" style="width: 400px; height: 250px;">'; 
                echo '</div>';
                echo '<div class="service-details">'; // Zerbitzuaren xehetasunak
                echo '<p>' . $row["deskribapena"] . '</p>';
                echo '<p class="room-price" style="text-align: right; font-weight: bold;">' . $row["prezioa"] . '€</p>'; // Prezioa erakutsi
                echo '</div>';
                echo '</div>';
            }
        } else {
            // Zerbitzuak ez badira aurkitzen, mezu bat erakutsiko da
            echo "<script>document.getElementById('no-rooms-message').style.display = 'block';</script>";
        }

        $conn->close(); // Datubasea itxi
        ?>
    </div>

    <?php include 'footer.php'; ?> 
</body>
</html>