<?php
require_once __DIR__ . '/../includes/config.php';
include INCLUDES_PATH . 'staff-area.php';
include TEMPLATES_PATH . 'header.php';
include TEMPLATES_PATH . 'employee-menu.php';
?>

<div id="staff-area">
    <?php
    include TEMPLATES_PATH . 'user-badge.php';
    include TEMPLATES_PATH . 'staff-statistics.php';
    ?>
    <div class="widget">
    </div>
</div>

<?php include TEMPLATES_PATH . 'footer.php'; ?>