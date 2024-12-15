<div class="flight-card">

    <!-- Flight Card Header -->
    <div class="flight-card-header">

        <form action="edit-reservation.php" method="POST" id="edit-reservation">
            <input type="hidden" name="reservation_id" id="reservation_id" value="<?php echo htmlspecialchars(
                $row['Codice_prenotazione'],
            ); ?>">
            <input type="hidden" name="departure" id="departure" value="<?php echo htmlspecialchars(
                $row['Iata_partenza'],
            ); ?>">
            <input type="hidden" name="arrival" id="arrival" value="<?php echo htmlspecialchars(
                $row['Iata_arrivo'],
            ); ?>">
            <input type="hidden" name="price" id="price" value="<?php echo htmlspecialchars(
                $row['Prezzo_biglietto'],
            ); ?>">
            <input type="submit" value="Modifica" name="edit-reservation">
        </form>

        <form action="delete-reservation.php" method="POST" id="delete_reservation">
            <input type="hidden" name="reservation_id" id="reservation_id" value="<?php echo htmlspecialchars(
                $row['Codice_prenotazione'],
            ); ?>">
            <input type="submit" value="Cancella" name="delete-reservation">
        </form>

    </div>

    <!-- Flight Card Info -->
    <div class="flight-card-info">

        <div class="flight-card-item flight-card-departure">
            <span id="time"><?php echo htmlspecialchars(
                $row['Orario_partenza'],
            ); ?></span>
            <span><b><?php echo htmlspecialchars(
                $row['Iata_partenza'],
            ); ?></b></span>
            <span><?php echo htmlspecialchars($row['Città_partenza']); ?></span>
        </div>

        <img src="<?= BASE_URL ?>img/airplane.svg" alt="" />

        <div class="flight-card-item flight-card-arrival">
            <span id="time"><?php echo htmlspecialchars(
                $row['Orario_arrivo'],
            ); ?></span>
            <span><b><?php echo htmlspecialchars(
                $row['Iata_arrivo'],
            ); ?></b></span>
            <span><?php echo htmlspecialchars($row['Città_arrivo']); ?></span>
        </div>

    </div>

    <div class="flight-card-item flight-card-check">

        <div>
            <h6>Data</h6>
            <span><?php echo htmlspecialchars($row['Data_partenza']); ?></span>
        </div>

        <div>
            <h6>Codice prenotazione</h6>
            <span><?php echo htmlspecialchars(
                $row['Codice_prenotazione'],
            ); ?></span>
        </div>

        <span id="price">€<?php echo htmlspecialchars(
            $row['Prezzo_biglietto'],
        ); ?>
        </span>

    </div>

</div>