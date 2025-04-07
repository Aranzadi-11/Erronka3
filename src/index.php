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
    <h1>Hotelaren Logelak</h1>
 
    <!-- Filtroa pertsonen kopuruaren arabera -->
    <div style="text-align: center; margin-top: 20px;">
        <form method="GET" action="">
            <label for="kopuruaIzenburu">Pertsonen kopurua: </label>
            <select name="kopurua" id="kopurua">
                <option value="-">- Gela guztiak -</option>
                <option value="2">2 pertsonentzat</option>
                <option value="3">3 pertsonentzat</option>
                <option value="4">4 pertsonentzat</option>
                <option value="5">5 pertsonentzat</option>
                <option value="6">6 pertsonentzat</option>
            </select>
            <button type="submit">Bilatu</button>
            <br><br>
 
            <!-- Karakteristikak -->
            <label><input type="checkbox" name="balkoia" value="1"> <img src="../public/balkoia.png" style="width: 30px; height: 30px;"></label>
            <label><input type="checkbox" name="sofa_ohea" value="1"> <img src="../public/sofa-ohea.png" style="width: 30px; height: 30px;"></label>
            <label><input type="checkbox" name="telebista" value="1"> <img src="../public/telebista.png" style="width: 30px; height: 30px;"></label>
            <label><input type="checkbox" name="sukaldea" value="1"> <img src="../public/sukaldea.png" style="width: 30px; height: 30px;"></label>
        </form>
    </div>
 
    <!-- Mensaje si no se encuentran habitaciones -->
    <div id="no-rooms-message">
        <p>Ez da logelarik aurkitu ezaugarri hauekin</p>
    </div>
 
    <div id="rooms-container">
       
        <?php
        include 'dbKonexioa.php';
 
        // Filtroak jasotzea
        $kopurua = isset($_GET['kopurua']) && is_numeric($_GET['kopurua']) ? $_GET['kopurua'] : '';
        $balkoia = isset($_GET['balkoia']) ? "balkoia = 1" : '';
        $sofa_ohea = isset($_GET['sofa_ohea']) ? "sofa_ohea = 1" : '';
        $telebista = isset($_GET['telebista']) ? "telebista = 1" : '';
        $sukaldea = isset($_GET['sukaldea']) ? "sukaldea = 1" : '';
 
        // Kontsulta prestatu
        $sql = "SELECT idLogela, izena, gelaEdukiera, telebista, sukaldea, balkoia, sofa_ohea, deskripzioa, prezioa, irudia, irudia1, irudia2, irudia3, irudia4, irudia5 FROM Logelak WHERE 1=1";
 
        // Pertsonen kopurua filtratu
        if ($kopurua && $kopurua !== '-') {
            $sql .= " AND gelaEdukiera = $kopurua";
        }
 
        // Karakteristikak filtratu
        if ($balkoia) {
            $sql .= " AND $balkoia";
        }
        if ($sofa_ohea) {
            $sql .= " AND $sofa_ohea";
        }
        if ($telebista) {
            $sql .= " AND $telebista";
        }
        if ($sukaldea) {
            $sql .= " AND $sukaldea";
        }
 
        // Kontsulta exekutatu
        $result = $conn->query($sql);
 
        // Logelak erakutsi
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                // Filtrar imágenes
                $images = array_filter([$row["irudia"], $row["irudia1"], $row["irudia2"], $row["irudia3"], $row["irudia4"], $row["irudia5"]]);
 
                echo '<div class="room">';  
                echo '<div class="room-image">';
                echo '<div class="carousel" data-images="' . implode(",", $images) . '">';
                if (count($images) > 1) {
                    echo '<button class="prev">&#9664;</button>'; // Aurreko irudia ikusteko botoia
                }
                echo '<img src="' . $row["irudia"] . '" alt="Logelaren irudia" class="carousel-image" style="width: 400px; height: 250px;">';
                if (count($images) > 1) {
                    echo '<button class="next">&#9654;</button>'; // Hurrengo irudia ikusteko botoia
                }
                echo '</div>';
                echo '</div>';
                echo '<div class="room-details">'; // Logelaren xehetasunak
                echo '<div class="logela-links a">';
                echo '<h2><a href="logela.php?idLogela=' . $row["idLogela"] . '" title="Hemen klikatu informazio gehiago lortzeko">' . $row["izena"] . '</a></h2>';
                echo '</div>';
                echo '<p><strong>' . $row["gelaEdukiera"] . ' pertsonentzako</strong></p>';
               
                // Deskripzioa logelaren azpian
                echo '<p>' . $row["deskripzioa"] . '</p>';
 
                // Logelaren ezaugarriak erakusteko (balkoia, sukaldea, telebista, sofa-ohea)
                echo '<p>';
                echo ($row["balkoia"] ? '<img src="../public/balkoia.png" style="width: 30px; height: 30px;">  ' : '') .
                     ($row["sukaldea"] ? '<img src="../public/sukaldea.png" style="width: 30px; height: 30px;">  ' : '') .
                     ($row["telebista"] ? '<img src="../public/telebista.png" style="width: 30px; height: 30px;">  ' : '') .  
                     ($row["sofa_ohea"] ? '<img src="../public/sofa-ohea.png" style="width: 30px; height: 30px;">  ' : '' );
                echo '</p>';
               
                // Logelaren prezioa eskuinean erakusteko
                echo '<p class="room-price" style="text-align: right; font-weight: bold;">' . $row["prezioa"] . '€ / gaua</p>';
 
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "<script>document.getElementById('no-rooms-message').style.display = 'block';</script>"; // Mostrar el mensaje si no se encuentran habitaciones
        }
 
        $conn->close(); // Datu basea itxi
        ?>
    </div>
 
    <?php include 'footer.php'; ?>
</body>
</html>
 
 