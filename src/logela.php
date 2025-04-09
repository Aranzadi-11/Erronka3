<?php
include 'dbKonexioa.php';
 
$idLogela = isset($_GET['idLogela']) ? $_GET['idLogela'] : 0;
 
$sql = "SELECT idLogela, izena, gelaEdukiera, telebista, sukaldea, balkoia, sofa_ohea, deskripzioa, prezioa, irudia, irudia1, irudia2, irudia3, irudia4, irudia5 FROM Logelak WHERE idLogela = $idLogela";
$result = $conn->query($sql);
 
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "<p>" . trans("Ez da logelarik aurkitu.") . "</p>";
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
    <?php include 'header.php'; ?>
    <?php include 'layout.php'; ?>
    <script>
    $(document).ready(function() {
        var idLogela = <?php echo $idLogela; ?>;
        var bookedDates = [];
 
        // Okupatutako egunak lortzeko funtzioa
        function getBookedDates() {
            return $.ajax({
                url: 'okupatutakoEgunak.php',
                type: 'GET',
                data: { idLogela: idLogela },
                dataType: 'json'
            });
        }
 
        // Data bat egon badagoen egiaztatzen du, checkin edo checkout dela kontuan hartuta
        function isDateBooked(date, forCheckin) {
            for (var i = 0; i < bookedDates.length; i++) {
                var start = new Date(bookedDates[i].start);
                var end = new Date(bookedDates[i].end);
 
                // Checkin: ezin da data `end`-ekin bat egon
                if (forCheckin && date >= start && date < end) {
                    return true;
                }
 
                // Checkout: data `start`-ekin bat egon daiteke
                if (!forCheckin && date > start && date < end) {
                    return true;
                }
            }
            return false;
        }
 
        // Datepicker eguneratzeko funtzioa
        function updateDatepickers() {
            // Checkin data egiaztatzeko
            $('#checkin').datepicker('option', 'beforeShowDay', function(date) {
                return [!isDateBooked(date, true)];
            });
            // Checkout data egiaztatzeko
            $('#checkout').datepicker('option', 'beforeShowDay', function(date) {
                return [!isDateBooked(date, false)];
            });
        }
 
        // Okupatutako egunak berriztatzeko funtzioa
        function refreshBookedDates() {
            getBookedDates().done(function(dates) {
                bookedDates = dates;
                updateDatepickers();
            });
        }
 
        // Hasieran okupatutako egunak kargatu
        refreshBookedDates();
        // Minutu bakoitzean berriztu
        setInterval(refreshBookedDates, 60000);
 
        // Checkin data aukeratzeko konfigurazioa
        $('#checkin').datepicker({
            minDate: -1,
            dateFormat: 'dd/mm/yy',
            onSelect: function(dateText) {
                $('#checkin').val(dateText);
                var parts = dateText.split('/');
                var selectedDate = new Date(parts[2], parts[1] - 1, parts[0]);
                selectedDate.setDate(selectedDate.getDate() + 1);
                $('#checkout').datepicker('option', 'minDate', selectedDate);
            }
        });
 
        // Checkout data aukeratzeko konfigurazioa
        $('#checkout').datepicker({
            minDate: 1,
            dateFormat: 'dd/mm/yy',
            onSelect: function(dateText) {
                $('#checkout').val(dateText);
                var parts = dateText.split('/');
                var selectedDate = new Date(parts[2], parts[1] - 1, parts[0]);
                selectedDate.setDate(selectedDate.getDate() - 1);
                $('#checkin').datepicker('option', 'maxDate', selectedDate);
            }
        });
 
        // Formularioa bidaltzean, egon daitezkeen datak balidatzeko funtzioa
        $("#form-reserva").submit(function(event) {
            var checkin = $("#checkin").datepicker("getDate");
            var checkout = $("#checkout").datepicker("getDate");
 
            for (var i = 0; i < bookedDates.length; i++) {
                var start = new Date(bookedDates[i].start);
                var end = new Date(bookedDates[i].end);
 
                // Checkin edo checkout datak okupatutako egunen artean badaude, errore mezua emango da
                if (
                    (checkin >= start && checkin < end) ||
                    (checkout > start && checkout < end) ||
                    (checkin < start && checkout > end)
                ) {
                    alert("<?= trans('Ezin dira aukeratu egiten diren datak. Mesedez, hautatu beste data batzuk.') ?>");
                    event.preventDefault(); // Formularioa ez da bidaltzen
                    return false;
                }
            }
        });
    });
    </script>
</head>
 
<body>
    <div id="room-details-container" class="room-details-container">
        <h1 class="room-title"><?php echo $row["izena"]; ?></h1>
 
        <div class="room-images">
            <div class="image-gallery">
                <img src="<?php echo $row["irudia"]; ?>" alt="<?= trans("Logelaren irudia") ?>" class="room-main-image">
                <?php
                for ($i = 1; $i <= 5; $i++) {
                    if (!empty($row["irudia$i"])) {
                        echo '<img src="' . $row["irudia$i"] . '" alt="' . trans("Logelaren irudia") . '" class="room-gallery-image">';
                    }
                }
                ?>
            </div>
        </div>
 
        <div class="room-details">
            <p class="room-description"><strong><?= trans("Prezioa") ?>: </strong><?php echo $row["prezioa"]; ?>€ / <?= trans("gau") ?></p>
            <p class="room-description"><strong><?= trans("Deskripzioa") ?>: </strong> <?php echo $row["deskripzioa"]; ?></p>
            <p class="room-description"><strong><?= trans("Kapazitatea") ?>: </strong> <?php echo $row["gelaEdukiera"]; ?> <?= trans("pertsonentzako") ?></p>
 
            <p class="room-description"><strong><?= trans("Ezaugarriak") ?>:</strong></p>
            <ul class="features-list">
                <?php
                if ($row["balkoia"]) echo "<li><img src='../public/balkoia.png' style='width: 30px; height: 30px;'> " . trans("Balkoia") . "</li>";
                if ($row["sukaldea"]) echo "<li><img src='../public/sukaldea.png' style='width: 30px; height: 30px;'> " . trans("Sukaldea") . "</li>";
                if ($row["telebista"]) echo "<li><img src='../public/telebista.png' style='width: 30px; height: 30px;'> " . trans("Telebista") . "</li>";
                if ($row["sofa_ohea"]) echo "<li><img src='../public/sofa-ohea.png' style='width: 30px; height: 30px;'> " . trans("Sofa-Ohea") . "</li>";
                ?>
            </ul>
        </div>

            <div class="room-comments">
                <h3><?= trans("Bezeroen iruzkinak:") ?></h3>
                <?php
                include 'dbKonexioa.php';

                // JOIN egiten dugu erabiltzaile izena lortzeko
                $stmt = $conn->prepare("
                    SELECT bezeroak.erabiltzaileIzena, erreserbak.iruzkina
                    FROM erreserbak
                    JOIN bezeroak ON erreserbak.idBezeroa = bezeroak.idBezeroa
                    WHERE erreserbak.idLogela = ? AND erreserbak.iruzkina IS NOT NULL AND erreserbak.iruzkina != ''
                ");
                $stmt->bind_param("i", $idLogela);
                $stmt->execute();
                $result_iruzkinak = $stmt->get_result();

                if ($result_iruzkinak->num_rows > 0) {
                    while ($iruzkina = $result_iruzkinak->fetch_assoc()) {
                        echo '<div class="comment-box">';
                        echo '<div class="comment-header"><strong>' . htmlspecialchars($iruzkina["erabiltzaileIzena"]) . '</strong></div>';
                        echo '<div class="comment-body">' . htmlspecialchars($iruzkina["iruzkina"]) . '</div>';
                        echo '</div>';
                    }
                } else {
                    echo "<p>" . trans("Ez dago iruzkinik.") . "</p>";
                }

                $stmt->close();
                $conn->close();
                ?>
            </div>

 
        <div class="room-reservation">
            <h3><?= trans("Erreserba egin") ?></h3>
            <form id="form-reserva" action="erosketa.php" method="GET">
                <input type="hidden" name="idLogela" value="<?php echo $row["idLogela"]; ?>">
                <input type="hidden" name="prezioa" value="<?php echo $row["prezioa"]; ?>">
                <input type="hidden" name="izena" value="<?php echo $row["izena"]; ?>">
 
                <label for="checkin"><?= trans("Sarrera data") ?>:</label>
                <input type="text" id="checkin" name="checkin" required readonly>
 
                <label for="checkout"><?= trans("Irteera data") ?>:</label>
                <input type="text" id="checkout" name="checkout" required readonly>
 
                <button type="submit" id="confirmar-fechas"><?= trans("Erreserbatu") ?></button>
            </form>
        </div>
    </div>

 
    <?php include 'footer.php'; ?>
</body>
</html>