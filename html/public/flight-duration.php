<?php
require_once __DIR__ . '/../includes/config.php';
include INCLUDES_PATH . 'flight-duration.php';
include TEMPLATES_PATH . 'header.php';
include TEMPLATES_PATH . 'menu.php';
?>

<div class="scroll-container" id="flight-duration-page">
    <div class="widget banner" id="flight-duration-banner">
    </div>
    <div class="widget">
        <?php if ($result) {
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) { ?>
        <h3>Durata del volo </h3>
        <span>Volo da: <b><?php echo $from; ?></b></span>
        <span>A: <b><?php echo $to; ?></b></span>
        <span>Durata stimata del volo: <b><?php echo htmlspecialchars(
            $row['Durata'],
        ); ?> </b></span>
        <?php }
            } else {
                $message =
                    'Non è disponibile una durata stimata per questa tratta.';
                include TEMPLATES_PATH . 'warning.php';
            }
        } ?>
    </div>
</div>

<?php include TEMPLATES_PATH . 'footer.php'; ?>
