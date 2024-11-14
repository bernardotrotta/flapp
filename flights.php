<?php
include "./database.php";

$name = mysqli_real_escape_string($con, $_POST["name"]);
$surname = mysqli_real_escape_string($con, $_POST["surname"]);
$userid = mysqli_real_escape_string($con, $_POST["userid"]);

$sql = "SELECT
        P.Nome AS Nome_Passeggero,
        P.Cognome AS Cognome_Passeggero,
        Pr.ID_PRENOTAZIONE AS Codice_prenotazione,
        V.Data_partenza,
        DATE_FORMAT(V.Orario_partenza, '%H:%i') AS Orario_partenza,
        DATE_FORMAT(V.Orario_arrivo, '%H:%i') AS Orario_arrivo,
        A1.Città AS Città_partenza,
        A1.Nome AS Aeroporto_partenza,
        A2.Città AS Città_arrivo,
        A2.Nome AS Aeroporto_arrivo,
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
        WHERE P.ID_PASSEGGERO = '$userid'";

$result = mysqli_query($con, $sql);

include "./header.php";
include "./menu.php";
?>
            <div id="user-page">
                <div class="widget scroll-container" id="user-badge">
                    <?php if (mysqli_num_rows($result) > 0) {
                        echo '<div class="user-badge">';
                        echo '<img id="userIcon" src="./img/icons/user.jpg" alt="">';
                        echo "<span>Ciao, <b>$name</b>!</span>";
                        echo "</div>";
                    } ?>
                </div>
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
                                <span><?php echo htmlspecialchars(
                                    $row["Aeroporto_partenza"]
                                ); ?></span>
                                <span><?php echo htmlspecialchars(
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
                                    $row["Codice_prenotazione"]
                                ); ?></span>
                            </div>
                            <span id="price">€<?php echo htmlspecialchars(
                                $row["Prezzo_biglietto"]
                            ); ?></span>
                        </div>
                    </div>
                    <?php }
                        } else {
                            // echo "Nessuna prenotazione associata a questo codice utente.";
                            header("Location: ./no-results.php");
                        }
                    } else {
                        echo "Errore nella query: " . mysqli_error($con);
                    }
                    mysqli_close($con);
                    ?>
                </div>
            </div>
<?php include "./footer.php"; ?>

