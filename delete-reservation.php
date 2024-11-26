<?php
include "./database.php";
include "./header.php";
include "./menu.php";

$sql = "DELETE FROM Prenotazioni
WHERE ID_PRENOTAZIONE = ?";
$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, "s", $_POST["reservation_id"]);
mysqli_stmt_execute($stmt);
?>

<div class="" id="delete-reservation">
    <div class="warning">
        <h4>Stai eliminando la prenotazione!</h4>
        <p>Stai per eliminare la prenotazione con ID = <?php echo htmlspecialchars(
            $_POST["reservation_id"]
        ); ?></p>
        <button>Elimina</button>
    </div>
</div>

<?php include "./footer.php"; ?>
