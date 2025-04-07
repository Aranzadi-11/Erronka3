<?php
include 'dbKonexioa.php';

$idLogela = isset($_GET['idLogela']) ? $_GET['idLogela'] : 0;

$booked_dates = array();
$booking_sql = "SELECT sarreraEguna, irteeraEguna FROM erreserbak WHERE idLogela = $idLogela";
$booking_result = $conn->query($booking_sql);

if ($booking_result->num_rows > 0) {
    while ($booking_row = $booking_result->fetch_assoc()) {
        $start_date = date('Y-m-d', strtotime($booking_row['sarreraEguna']));
        $end_date = date('Y-m-d', strtotime($booking_row['irteeraEguna'] . ' -1 day'));
        $booked_dates[] = array(
            'start' => $start_date,
            'end' => $end_date
        );
    }
}

$conn->close();

echo json_encode($booked_dates);
?>