<?php
include 'dbKonexioa.php';

$idLogela = isset($_GET['idLogela']) ? $_GET['idLogela'] : 0;

$sql = "SELECT idLogela, izena, gelaEdukiera, telebista, sukaldea, balkoia, sofa_ohea, deskripzioa, prezioa, irudia, irudia1, irudia2, irudia3, irudia4, irudia5 FROM Logelak WHERE idLogela = $idLogela";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "<p>Ez da logelarik aurkitu.</p>";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logela - <?php echo $row["izena"]; ?></title>
    <link rel="stylesheet" type="text/css" href="../public/styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script defer src="../public/scripts.js"></script>
    
</head>


<body>

    <?php include 'header.php'; ?>
   

    <div id="room-details-container" class="room-details-container">
        <h1 class="room-title"><?php echo $row["izena"]; ?></h1>

        <div class="room-images">
            <div class="image-gallery">
                <img src="<?php echo $row["irudia"]; ?>" alt="Logelaren irudia" class="room-main-image">
                <?php
                for ($i = 1; $i <= 5; $i++) {
                    if (!empty($row["irudia$i"])) {
                        echo '<img src="' . $row["irudia$i"] . '" alt="Logelaren irudia" class="room-gallery-image">';
                    }
                }
                ?>
            </div>
        </div>

        <div class="room-details">
            <p class="room-description"><strong>Prezioa: </strong><?php echo $row["prezioa"]; ?>€ / gaua</p>
            <p class="room-description"><strong>Deskripzioa: </strong> <?php echo $row["deskripzioa"]; ?></p>
            <p class="room-description"><strong>Kapazitatea: </strong> <?php echo $row["gelaEdukiera"]; ?> pertsonentzako</p>

            <p class="room-description"><strong>Ezaugarriak:</strong></p>
            <ul class="features-list">
                <?php
                if ($row["balkoia"]) echo "<li><img src='../public/balkoia.png' style='width: 30px; height: 30px;'> Balkoia</li>";
                if ($row["sukaldea"]) echo "<li><img src='../public/sukaldea.png' style='width: 30px; height: 30px;'> Sukaldea</li>";
                if ($row["telebista"]) echo "<li><img src='../public/telebista.png' style='width: 30px; height: 30px;'> Telebista</li>";
                if ($row["sofa_ohea"]) echo "<li><img src='../public/sofa-ohea.png' style='width: 30px; height: 30px;'> Sofa-Ohea</li>";
                ?>
            </ul>
        </div>

        <div class="room-reservation">
            <h3>Erreserba egin</h3>
            <form id="form-reserva" action="reserva.php" method="POST">
                <input type="hidden" name="idLogela" value="<?php echo $row["idLogela"]; ?>">

                <label for="checkin">Sarrera data:</label>
                <input type="text" id="checkin" name="checkin" required readonly>

                <label for="checkout">Irteera data:</label>
                <input type="text" id="checkout" name="checkout" required readonly>

                <button type="submit" id="confirmar-fechas">Erreserbatu</button>
            </form>
        </div>
    </div>
    


    <script>
        $(document).ready(function() {
            // Kalendarioa
            $('#checkin').datepicker({
                minDate: 1,  // Bihartik aurrerako data bakarrik
                onSelect: function(dateText) {
                    $('#checkin').val(dateText);
                },
                beforeShowDay: function(date) {
                    return [!isDateOccupied(date)];  // Okupatutako datuak desgaitu
                }
            });

            // Kalendarioa
            $('#checkout').datepicker({
                minDate: 2,  // Bi egunetik aurrerako data bakarrik
                onSelect: function(dateText) {
                    $('#checkout').val(dateText);
                },
                beforeShowDay: function(date) {
                    return [!isDateOccupied(date)];  // Datu okupatuak desgaitu
                }
            });

            // Funtzio honek datu okupatuak itzultzen ditu
            function isDateOccupied(date) {
                var occupiedDates = getOccupiedDates();
                return occupiedDates.includes($.datepicker.formatDate('yy-mm-dd', date));
            }

            // Funtzio honek datu okupatuak eskuratzen ditu
            function getOccupiedDates() {
                var occupiedDates = [];
                $.ajax({
                    url: 'check_reservations.php',  
                    method: 'GET',
                    async: false,  
                    success: function(response) {
                        occupiedDates = JSON.parse(response);  
                    }
                });
                return occupiedDates;
            }

            // Eguneratu kalendarioak 5 segunduro
            setInterval(function() {
                $('#checkin').datepicker('refresh');
                $('#checkout').datepicker('refresh');
            }, 5000);

            // Erreserba formularioa bidaltzeko
            $('#form-reserva').submit(function(e) {
                e.preventDefault(); 
                var fechaEntrada = $('#checkin').val();
                var fechaSalida = $('#checkout').val();

                if (fechaEntrada === '' || fechaSalida === '') {
                    alert('Mesedez, hautatu data guztiak.');
                    return;
                }

                // Erreserba konfirmazio orrira bidali
                <?php if (isset($_SESSION['usuario_id'])): ?>
                    window.location.href = 'erosketa.php?fecha_entrada=' + fechaEntrada + '&fecha_salida=' + fechaSalida;
                <?php else: ?>
                    // Erabiltzailea ez bada logeatuta, login orrira bidali
                    window.location.href = 'login.php';
                <?php endif; ?>
            });
        });
    </script>
    <?php include 'footer.php'; ?>
</body>
</html>
