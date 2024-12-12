<?php require_once __DIR__ . '/../includes/config.php'; ?>
<?php include TEMPLATES_PATH . 'database.php'; ?>
<?php
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

<?php include TEMPLATES_PATH . 'header.php'; ?>
<?php include TEMPLATES_PATH . 'menu.php'; ?>
<div class="scroll-container" id="home-page">
    <div class="widget banner" id="most-used-aircraft">
        <div class="banner-overlay">
            <?php if ($mostUsedAircraft) {
                if (mysqli_num_rows($mostUsedAircraft) > 0) {
                    while ($row = mysqli_fetch_assoc($mostUsedAircraft)) { ?>
            <h6>Aereo più utilizzato</h6>
            <span><?php
            echo htmlspecialchars($row['Modello']);
            $imageLink = $row['Immagine'];
            ?>
            </span>
            <style>
            #most-used-aircraft {
                background-image: url(<?php echo $imageLink; ?>) !important;
            }
            </style>
            <?php }
                } else {
                    echo 'Nessuna prenotazione associata a questo codice utente.';
                }
            } else {
                echo 'Errore nella query: ' . mysqli_error($conn);
            } ?>
        </div>
    </div>
    <div class="widget" id="most-departures-airport">
        <h3>Aeroporti con più partenze</h3>
        <ol>
            <?php if ($mostDeparturesAirport) {
                if (mysqli_num_rows($mostDeparturesAirport) > 0) {
                    while (
                        $row = mysqli_fetch_assoc($mostDeparturesAirport)
                    ) { ?>
            <li><?php
            echo '<b>';
            echo htmlspecialchars($row['Codice_iata']);
            echo '</b>: ';
            echo htmlspecialchars($row['Nome']);
            ?></li>
            <?php }
                } else {
                    echo 'Nessuna prenotazione associata a questo codice utente.';
                }
            } else {
                echo 'Errore nella query: ' . mysqli_error($conn);
            } ?>
        </ol>
    </div>
    <div class="widget" id="most-arrivals-airport">
        <h3>Aeroporti con più arrivi</h3>
        <ol>
            <?php if ($mostArrivalsAirport) {
                if (mysqli_num_rows($mostArrivalsAirport) > 0) {
                    while ($row = mysqli_fetch_assoc($mostArrivalsAirport)) { ?>
            <li><?php
            echo '<b>';
            echo htmlspecialchars($row['Codice_iata']);
            echo '</b>: ';
            echo htmlspecialchars($row['Nome']);
            ?></li>
            <?php }
                } else {
                    echo 'Nessuna prenotazione associata a questo codice utente.';
                }
            } else {
                echo 'Errore nella query: ' . mysqli_error($conn);
            } ?>
        </ol>
    </div>
    <div class="widget" id="widget5">
        <h3>Quanto dura il volo?</h3>
        <form class="flight-duration" action="<?= INCLUDES_PATH ?>flight-duration.php" method="POST">
            <div class="form-label">
                <label for="from">Partenza</label>
                <input type="text" name="from" list="cities" placeholder="Roma" required>
                <datalist id="cities">
                    <?php if ($Cities) {
                        if (mysqli_num_rows($Cities) > 0) {
                            while ($row = mysqli_fetch_assoc($Cities)) { ?>
                    <option value="<?php echo htmlspecialchars(
                        $row['Città'],
                    ); ?>"><?php echo htmlspecialchars($row['Città']); ?>
                    <option>
                        <?php }
                        } else {
                            echo 'Nessuna non ci sono suggerimenti.';
                        }
                    } else {
                        echo 'Errore nella query: ' . mysqli_error($conn);
                    } ?>
                </datalist>
            </div>
            <div class="form-label">
                <label for="to">Destinazione</label>
                <input type="text" name="to" list="cities" placeholder="New York" required>
            </div>
            <input type="submit" value="Invio">
        </form>
    </div>
</div>

<?php include TEMPLATES_PATH . 'footer.php'; ?>
<?php mysqli_close($conn); ?>
