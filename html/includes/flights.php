<?php

if (!$_SERVER['REQUEST_METHOD'] === 'POST') {
    die('Errore: Accesso non autorizzato.');
}

session_start();

include 'database.php';

$_SESSION['first-name'] = $_POST['first-name'];
$_SESSION['last-name'] = $_POST['last-name'];
$_SESSION['user-id'] = $_POST['user-id'];
$sql = "SELECT
P.Nome AS Nome_Passeggero,
P.Cognome AS Cognome_Passeggero,
Pr.ID_PRENOTAZIONE AS Codice_prenotazione,
V.Data_partenza,
DATE_FORMAT(V.Orario_partenza, '%H:%i') AS Orario_partenza,
DATE_FORMAT(V.Orario_arrivo, '%H:%i') AS Orario_arrivo,
A1.Città AS Città_partenza,
A1.Nome AS Aeroporto_partenza,
A1.Codice_iata AS Iata_partenza,
A2.Città AS Città_arrivo,
A2.Nome AS Aeroporto_arrivo,
A2.Codice_iata AS Iata_arrivo,
Pr.Prezzo_biglietto
FROM
Prenotazioni Pr
JOIN
Passeggeri P ON Pr.Passeggero = P.ID_PASSEGGERO
JOIN
Voli V ON Pr.Volo = V.ID_VOLO
JOIN
Aeroporti A1 ON V.Aeroporto_partenza = A1.ID_AEROPORTO
JOIN
Aeroporti A2 ON V.Aeroporto_arrivo = A2.ID_AEROPORTO
WHERE P.ID_PASSEGGERO = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 's', $_SESSION['user-id']);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>
