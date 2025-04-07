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

    <div id="services-container">
        
        <?php
        include 'dbKonexioa.php';

        // Kontsulta prestatu
        $sql = "SELECT izena, deskribapena, prezioa, argazkia FROM Zerbitzuak";

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
                echo '<p class="room-price" style="text-align: right; font-weight: bold;">' . $row["prezioa"] . '€</p>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "<script>document.getElementById('no-rooms-message').style.display = 'block';</script>"; // Mostrar el mensaje si no se encuentran servicios
        }

        $conn->close(); // Datu basea itxi
        ?>
    </div>

    <?php include 'footer.php'; ?> 
</body>
</html>
