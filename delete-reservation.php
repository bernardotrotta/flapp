<?php
include "./header.php";
include "./menu.php";
?>
<div class="" id="delete-reservation">
    <div class="warning">
        <h4>Stai eliminando la prenotazione!</h4>
        <p>Stai per eliminare la prenotazione con ID = <?php echo htmlspecialchars(
            $_GET["reservation_code"]
        ); ?></p>
    </div>
</div>
<?php include "./footer.php"; ?>
