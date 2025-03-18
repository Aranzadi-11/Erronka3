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

    <h1 style="text-align: center; margin-top: 20px;">Hotelaren Logelak</h1>
    <div id="rooms-container">
        <?php
        include 'dbKonexioa.php';

        $sql = "SELECT idLogela, izena, gelaEdukiera, telebista, sukaldea, balkoia, sofa_ohea, deskripzioa, irudia, irudia1, irudia2, irudia3, irudia4, irudia5 FROM Logelak";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                // Filtratzen irudiak
                $images = array_filter([$row["irudia"], $row["irudia1"], $row["irudia2"], $row["irudia3"], $row["irudia4"], $row["irudia5"]]);

                echo '<div class="room">';  // Logelaaren containerra
                echo '<div class="room-image">'; // Irudiaren containerra
                echo '<div class="carousel" data-images="' . implode(",", $images) . '">'; // Karrusela
                echo '<button class="prev">&#9664;</button>';
                echo '<img src="' . $row["irudia"] . '" alt="Logelaren irudia" style="width: 400px; height: 250px;">'; // Lehenengo irudia, txikia
                echo '<button class="next">&#9654;</button>';
                echo '</div>';
                echo '</div>';
                echo '<div class="room-details">'; // Logelaren xehetasunak
                echo '<h2>' . $row["izena"] . '</h2>';

                // Capacidad de personas
                echo '<p><strong>' . $row["gelaEdukiera"] . ' pertsonentzako</strong></p>';
                
                // Deskripzioa logelaren azpian
                echo '<p>' . $row["deskripzioa"] . '</p>';

                // Ikusten dira ezaugarriak (balkoia, sukaldea, telebista, sofa-ohea)
                echo '<p>';
                echo ($row["balkoia"] ? '<img src="../public/balkoia.png" style="width: 30px; height: 30px;">  ' : '') . 
                     ($row["sukaldea"] ? '<img src="../public/sukaldea.png" style="width: 30px; height: 30px;">  ' : '') .
                     ($row["telebista"] ? '<img src="../public/telebista.png" style="width: 30px; height: 30px;">  ' : '') .  
                     ($row["sofa_ohea"] ? '<img src="../public/sofa-ohea.png" style="width: 30px; height: 30px;">  ' : '');
                echo '</p>';

                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "<p style='text-align: center;'>Ez dago logelarik eskuragarri.</p>";
        }

        $conn->close();
        ?>
    </div>

</body>
</html>
