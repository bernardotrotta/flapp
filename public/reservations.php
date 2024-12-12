<?php require_once __DIR__ . '/../includes/config.php'; ?>

<?php include TEMPLATES_PATH . 'header.php'; ?>
<?php include TEMPLATES_PATH . 'menu.php'; ?>


<div id="bookings-page">
    <div class="widget banner" id="bookings-page-banner"></div>

    <div class="widget" id="bookings-page-form">
        <h3>Cerca una prenotazione</h3>
        <form action="<?= INCLUDES_PATH ?>reservation-list.php" method="POST">
            <div class="form-label" id="field4">
                <label for="reservationID">Codice prenotazione</label>
                <input type="text" id="reservationID" name="reservationID"
                    placeholder="Inserisci codice prenotazione" />
            </div>
            <input type="submit" value="Invia" />
        </form>
    </div>
</div>

<?php include TEMPLATES_PATH . 'footer.php'; ?>
