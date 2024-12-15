<?php
require_once __DIR__ . '/../includes/config.php';
include INCLUDES_PATH . 'delete-reservation.php';
include TEMPLATES_PATH . 'header.php';
include TEMPLATES_PATH . 'menu.php';
?>

<div class="" id="delete-reservation">
    <?php if (!$message) { ?>
    <div class="warning">
        <h4>Stai eliminando la prenotazione!</h4>
        <p>Stai per eliminare la prenotazione con ID = <?php echo htmlspecialchars(
            $_POST['reservation_id'],
        ); ?></p>
        <form method="POST" action="">
            <input type="hidden" name="reservation_id" value="<?php echo htmlspecialchars(
                $_POST['reservation_id'],
            ); ?>">
            <input type="submit" name="delete-button" value="Elimina">
        </form>
    </div>
    <?php } else {include TEMPLATES_PATH . 'success.php';} ?>

</div>

<?php include TEMPLATES_PATH . 'footer.php'; ?>
