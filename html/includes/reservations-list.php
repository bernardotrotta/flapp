<?php
require_once 'config.php';
include 'database.php';

$reservationid = mysqli_real_escape_string($conn, $_POST['reservationID']);
$sql = "SELECT
V.Data_partenza,
DATE_FORMAT(V.Orario_partenza, '%H:%i') AS Orario_partenza,
A1.Città AS Città_partenza,
A1.Nome AS Aeroporto_partenza,
V.Data_arrivo,
DATE_FORMAT(V.Orario_arrivo, '%H:%i') AS Orario_arrivo,
A2.Città AS Città_arrivo,
A2.Nome AS Aeroporto_arrivo,
V.Durata,
Pr.Prezzo_biglietto
FROM
Prenotazioni Pr
JOIN
Voli V ON Pr.Volo = V.ID_VOLO
JOIN
Aeroporti A1 ON V.Aeroporto_partenza = A1.ID_AEROPORTO
JOIN
Aeroporti A2 ON V.Aeroporto_arrivo = A2.ID_AEROPORTO
WHERE
Pr.ID_PRENOTAZIONE = '$reservationid'";

$result = mysqli_query($conn, $sql);
?>
