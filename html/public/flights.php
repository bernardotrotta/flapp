<?php
require_once __DIR__ . '/../includes/config.php';
include INCLUDES_PATH . 'flights.php';
include TEMPLATES_PATH . 'header.php';
include TEMPLATES_PATH . 'menu.php';
?>

<div class="scroll-container" id="user-page">
    <div class="widget" id="user-badge">
        <?php if ($row = mysqli_num_rows($result) > 0) {
            include TEMPLATES_PATH . 'user-badge.php';
        } ?>
    </div>
    <div class="widget" id="results-table">
        <?php
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    include TEMPLATES_PATH . 'flights-card.php';
                }
            } else {
                echo 'Nessuna prenotazione associata a questo codice utente.';
            }
        } else {
            echo 'Errore nella query: ' . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        ?>
    </div>
</div>

<?php include TEMPLATES_PATH . 'footer.php'; ?>
