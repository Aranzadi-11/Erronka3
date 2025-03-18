<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotela</title>
    <link rel="stylesheet" type="text/css" href="../public/styles.css">
</head>
<body>
    <h1>Hotelaren Logelak</h1>
    <div id="rooms-container">
        <?php
        include 'dbKonexioa.php';

        $sql = "SELECT idLogela, gelaEdukiera, telebista, sukaldea, balkoia, irudia, irudia1, irudia2, irudia3, irudia4, irudia5 FROM Logelak";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="room">';
                echo '<img src="' . $row["Irudia"] . '" alt="Logelaren irudia">';
                echo '<div>';
                echo '<h2>' . $row["idLogela"] . '. ' . $row["logela"] . '</h2>';
                echo '<p>';
                echo ($row["balkoia"] ? 'Balkoia ' : '') . 
                     ($row["sukaldea"] ? 'Sukaldea ' : '') . 
                     ($row["telebista"] ? 'Telebista' : '');
                echo '</p>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "Ez dago logelarik eskuragarri.";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>