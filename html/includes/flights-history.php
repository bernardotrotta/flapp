<?php
session_start();
include 'database.php';

$query = "SELECT 
V.ID_VOLO, 
AP.Codice_iata AS Codice_Iata_Partenza, 
AP1.Codice_iata AS Codice_Iata_Arrivo, 
V.Data_partenza,
V.Orario_partenza
FROM 
Servizio S
JOIN 
Voli V ON S.ID_volo = V.ID_VOLO
JOIN 
Aeroporti AP ON V.Aeroporto_partenza = AP.ID_AEROPORTO
JOIN 
Aeroporti AP1 ON V.Aeroporto_arrivo = AP1.ID_AEROPORTO
WHERE 
S.ID_dipendente = ? AND
V.Data_partenza <= CURRENT_DATE";

$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 's', $_SESSION['employee-id']);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>