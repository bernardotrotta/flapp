<?php require_once __DIR__ . '/../includes/config.php'; ?>
<?php include INCLUDES_PATH . 'reservations-list.php'; ?> -->
<?php include TEMPLATES_PATH . 'header.php'; ?>
<?php include TEMPLATES_PATH . 'menu.php'; ?>

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
                            $row['Orario_partenza'],
                        ); ?></span>
                    <span>
                        <?php echo htmlspecialchars(
                            $row['Aeroporto_partenza'],
                        ); ?></span>
                    <span>
                        <?php echo htmlspecialchars(
                            $row['Città_partenza'],
                        ); ?></span>
                </div>
                <img src="<?= BASE_URL ?>img/airplane.svg" alt="" />
                <div class="flight-card-item flight-card-arrival">
                    <span id="time"><?php echo htmlspecialchars(
                        $row['Orario_arrivo'],
                    ); ?></span>
                    <span><?php echo htmlspecialchars(
                        $row['Aeroporto_arrivo'],
                    ); ?></span>
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
                    <h6>Codice prenotazione</h6>
                    <span><?php echo htmlspecialchars($reservationid); ?></span>
                </div>
                <span id="price">€<?php echo htmlspecialchars(
                    $row['Prezzo_biglietto'],
                ); ?></span>
            </div>
        </div>
        <?php }
            } else {
                $message =
                    'Nessuna prenotazione associata a questo codice utente.';
                include TEMPLATES_PATH . 'warning.php';
            }
        } else {
            echo 'Errore nella query: ' . mysqli_error($conn);
        }
        mysqli_close($conn);
        ?>
    </div>
</div>
<?php include TEMPLATES_PATH . 'footer.php'; ?>
