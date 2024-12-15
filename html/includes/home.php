<?php
require_once 'config.php';
include 'database.php';

$query1 = "SELECT
a.Modello,
a.Immagine,
COUNT(v.ID_VOLO) AS Numero_voli
FROM
Aerei a
JOIN
Voli v ON a.ID_AEREO = v.Aereo
GROUP BY
a.ID_AEREO, a.Modello
ORDER BY
Numero_voli DESC
LIMIT 1";
$query2 = "SELECT
a.ID_AEROPORTO,
a.Nome,
a.Codice_iata,
(SELECT COUNT(v1.ID_VOLO)
FROM Voli v1
WHERE v1.Aeroporto_arrivo = a.ID_AEROPORTO) AS Numero_arrivi
FROM
Aeroporti a
WHERE
(SELECT COUNT(v2.ID_VOLO)
FROM Voli v2
WHERE v2.Aeroporto_arrivo = a.ID_AEROPORTO) >= ALL
(SELECT COUNT(v3.ID_VOLO)
FROM Voli v3
GROUP BY v3.Aeroporto_arrivo)
ORDER BY Numero_arrivi DESC";
$query3 = "SELECT
a.ID_AEROPORTO,
a.Nome,
a.Codice_iata,
(SELECT COUNT(v1.ID_VOLO)
FROM Voli v1
WHERE v1.Aeroporto_partenza = a.ID_AEROPORTO) AS Numero_partenze
FROM
Aeroporti a
WHERE
(SELECT COUNT(v2.ID_VOLO)
FROM Voli v2
WHERE v2.Aeroporto_partenza = a.ID_AEROPORTO) >= ALL
(SELECT COUNT(v3.ID_VOLO)
FROM Voli v3
GROUP BY v3.Aeroporto_partenza)
ORDER BY Numero_partenze DESC";
$query4 = 'SELECT `Città` FROM `Aeroporti`';
$mostUsedAircraft = mysqli_query($conn, $query1);
$mostDeparturesAirport = mysqli_query($conn, $query2);
$mostArrivalsAirport = mysqli_query($conn, $query3);
$Cities = mysqli_query($conn, $query4);
?>
