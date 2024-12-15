<?php
if (!$_SERVER['REQUEST_METHOD'] === 'POST') {
    die('Errore: Accesso non autorizzato.');
}

session_start();
include 'database.php';

$sql = "SELECT
    V.Data_partenza,
    DATE_FORMAT(V.Orario_partenza, '%H:%i') AS Orario_partenza,
    A1.Città AS Città_partenza,
    A1.Codice_iata AS Aeroporto_partenza,
    V.Data_arrivo,
    DATE_FORMAT(V.Orario_arrivo, '%H:%i') AS Orario_arrivo,
    A2.Città AS Città_arrivo,
    A2.Codice_iata AS Aeroporto_arrivo,
    V.Durata,
    V.ID_Volo
FROM
    Voli AS V
JOIN
    Aeroporti A1 ON V.Aeroporto_partenza = A1.ID_AEROPORTO
JOIN
    Aeroporti A2 ON V.Aeroporto_arrivo = A2.ID_AEROPORTO
WHERE
    A1.Codice_iata = ?
AND
    A2.Codice_iata = ?
AND V.Data_partenza > CURRENT_DATE()";

$sql = $stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'ss', $_POST['departure'], $_POST['arrival']);
mysqli_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>
