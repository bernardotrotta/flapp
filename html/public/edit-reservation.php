<?php
require_once __DIR__ . '/../includes/config.php';
include INCLUDES_PATH . 'edit-reservation.php';
include TEMPLATES_PATH . 'header.php';
include TEMPLATES_PATH . 'menu.php';
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
                        $row['Orario_partenza'],
                    ); ?></span>
                    <span><b><?php echo htmlspecialchars(
                        $row['Aeroporto_partenza'],
                    ); ?></b></span>
                    <span><?php echo htmlspecialchars(
                        $row['Città_partenza'],
                    ); ?></span>
                </div>

                <img src="./img/airplane.svg" alt="" />

                <div class="flight-card-item flight-card-arrival">
                    <span id="time"><?php echo htmlspecialchars(
                        $row['Orario_arrivo'],
                    ); ?></span>
                    <span><b><?php echo htmlspecialchars(
                        $row['Aeroporto_arrivo'],
                    ); ?></b></span>
                    <span><?php echo htmlspecialchars(
                        $row['Città_arrivo'],
                    ); ?></span>
                </div>

            </div>

            <div class="flight-card-item flight-card-check">
                <div>
                    <h6>Data</h6>
                    <span><?php echo htmlspecialchars(
                        $row['Data_partenza'],
                    ); ?></span>
                </div>
                <div>
                    <form action="confirm-edit-reservation.php" method="POST">
                        <input type="hidden" name="flight_id" id="flight_id" value="<?php echo htmlspecialchars(
                            $row['ID_Volo'],
                        ); ?>">
                        <input type="hidden" name="reservation_id" id="reservation_id" value="<?php echo htmlspecialchars(
                            $_POST['reservation_id'],
                        ); ?>">
                        <input type="hidden" name="price" id="price" value="<?php echo htmlspecialchars(
                            $_POST['price'],
                        ); ?>">
                        <input type="submit" value="Conferma" name="confirm">
                    </form>
                </div>
            </div>
        </div>

        <?php }
            } else {
                echo 'Nessuna prenotazione associata a questo codice utente.';
                // header("Location: ./no-results.php");
                // exit();
            }
        } else {
            echo 'Errore nella query: ' . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        ?>
    </div>
</div>
</div>


<?php include TEMPLATES_PATH . 'footer.php'; ?>
