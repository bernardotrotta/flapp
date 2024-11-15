<?php
include "./database.php";

$reservationid = mysqli_real_escape_string($con, $_POST["reservationID"]);

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

$result = mysqli_query($con, $sql);
?>

<?php
include "./header.php";
include "./menu.php";
?>
            <div class="widget scroll-container" id="reservation-list-page">                
                <div>
                    <?php
                    if ($result) {
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) { ?>
                    <div class="flight-card">
                        <div class="flight-card-info">
                            <div class="flight-card-item flight-card-departure">
                                <span id="time">
                                    <?php echo htmlspecialchars(
                                        $row["Orario_partenza"]
                                    ); ?></span>
                                <span>
                                    <?php echo htmlspecialchars(
                                        $row["Aeroporto_partenza"]
                                    ); ?></span>
                                <span>
                                    <?php echo htmlspecialchars(
                                        $row["Città_partenza"]
                                    ); ?></span>
                            </div>
                            <img src="./img/airplane.svg" alt="" />
                            <div class="flight-card-item flight-card-arrival">
                                <span id="time"><?php echo htmlspecialchars(
                                    $row["Orario_arrivo"]
                                ); ?></span>
                                <span><?php echo htmlspecialchars(
                                    $row["Aeroporto_arrivo"]
                                ); ?></span>
                                <span><?php echo htmlspecialchars(
                                    $row["Città_arrivo"]
                                ); ?></span>
                            </div>
                        </div>
                        <div class="flight-card-item flight-card-check">
                            <div>
                                <h6>Data</h6>
                                <span><?php echo htmlspecialchars(
                                    $row["Data_partenza"]
                                ); ?></span>
                            </div>
                            <div>
                                <h6>Codice prenotazione</h6>
                                <span><?php echo htmlspecialchars(
                                    $reservationid
                                ); ?></span>
                            </div>
                            <span id="price">€<?php echo htmlspecialchars(
                                $row["Prezzo_biglietto"]
                            ); ?></span>
                        </div>
                    </div>
                    <?php }
                        } else {
                            $message =
                                "Nessuna prenotazione associata a questo codice utente.";
                            include "./warning.php";
                        }
                    } else {
                        echo "Errore nella query: " . mysqli_error($con);
                    }
                    mysqli_close($con);
                    ?>
                </div>
            </div>
<?php include "./footer.php"; ?>
