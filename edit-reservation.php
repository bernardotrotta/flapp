<?php
session_start();
include "./header.php";
include "./menu.php";
include "./database.php";

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

$sql = $stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, "ss", $_POST["departure"], $_POST["arrival"]);
mysqli_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>

<div class="scroll-container">
<div class="widget" id="results-table">
                    <?php
                    if ($result) {
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) { ?>
                                <div class="flight-card">
                                    <div class="flight-card-info">
                                        <div class="flight-card-item flight-card-departure">
                                            <span id="time"><?php echo htmlspecialchars(
                                                $row["Orario_partenza"]
                                            ); ?></span>
                                            <span><b><?php echo htmlspecialchars(
                                                $row["Aeroporto_partenza"]
                                            ); ?></b></span>
                                            <span><?php echo htmlspecialchars(
                                                $row["Città_partenza"]
                                            ); ?></span>
                                        </div>

                                    <img src="./img/airplane.svg" alt="" />

                                    <div class="flight-card-item flight-card-arrival">
                                        <span id="time"><?php echo htmlspecialchars(
                                            $row["Orario_arrivo"]
                                        ); ?></span>
                                        <span><b><?php echo htmlspecialchars(
                                            $row["Aeroporto_arrivo"]
                                        ); ?></b></span>
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
                                        <form action="./update-result.php" method="POST">
                                            <input type="hidden" name="flight_id" id="flight_id" value="<?php echo htmlspecialchars(
                                                $row["ID_Volo"]
                                            ); ?>">
                                            <input type="hidden" name="reservation_id" id="reservation_id" value="<?php echo htmlspecialchars(
                                                $_POST["reservation_id"]
                                            ); ?>">
                                            <input type="hidden" name="price" id="price" value="<?php echo htmlspecialchars(
                                                $_POST["price"]
                                            ); ?>">
                                            <input type="submit" value="Conferma" name="confirm">
                                        </form>
                                    </div>
                                </div>
                            </div>

                    <?php }
                        } else {
                            echo "Nessuna prenotazione associata a questo codice utente.";
                            // header("Location: ./no-results.php");
                            // exit();
                        }
                    } else {
                        echo "Errore nella query: " . mysqli_error($con);
                    }
                    mysqli_stmt_close($stmt);
                    mysqli_close($con);
                    ?>
                </div>
            </div>
</div>


<?php include "./footer.php";
?>
