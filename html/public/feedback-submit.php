<?php
require_once __DIR__ . '/../includes/config.php';
include INCLUDES_PATH . 'feedback-submit.php';
include TEMPLATES_PATH . 'header.php';
include TEMPLATES_PATH . 'menu.php';
?>

<div id="feedback-page">
    <div class="widget banner" id="feedback-page-banner">
    </div>
    <div class="widget" id="feedback-page-form">
        <?php if ($conn->query($sql) === true) {
            echo '<h3>Recensione inviata con successo!</h3>';
        } else {
            echo 'Errore: ' . $sql . '<br>' . $conn->error;
        } ?>
    </div>
</div>

<?php include TEMPLATES_PATH . 'footer.php'; ?>
