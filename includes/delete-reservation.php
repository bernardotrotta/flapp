<?php

require_once 'config.php';

if (!$_SERVER['REQUEST_METHOD'] === 'POST') {
    die('Errore: Accesso non autorizzato.');
}
?>

<?php include './database.php'; ?>
<?php include './header.php'; ?>
<?php include './menu.php'; ?>

<?php
$sql = "DELETE FROM Prenotazioni
WHERE ID_PRENOTAZIONE = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 's', $_POST['reservation_id']);
if (isset($_POST['delete-button'])) {
    mysqli_stmt_execute($stmt);
    echo 'Prenotazione eliminata con successo!';
}
?>

<div class="" id="delete-reservation">
    <div class="warning">
        <h4>Stai eliminando la prenotazione!</h4>
        <p>Stai per eliminare la prenotazione con ID = <?php echo htmlspecialchars(
            $_POST['reservation_id'],
        ); ?></p>
        <form method="POST" action="<?= INCLUDES_PATH ?>delete-reservation.php">
            <input type="hidden" name="reservation_id" value="<?php echo htmlspecialchars(
                $_POST['reservation_id'],
            ); ?>">
            <input type="submit" name="delete-button" value="Elimina">
        </form>
    </div>
</div>

<?php include './footer.php'; ?>