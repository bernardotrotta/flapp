<?php
require_once __DIR__ . '/../includes/config.php';
include INCLUDES_PATH . 'staff-area.php';
include TEMPLATES_PATH . 'header.php';
include TEMPLATES_PATH . 'employee-menu.php';
?>

<div id="staff-area">
    <div class="widget">
        <span>
            Ciao!
            <?php
            echo htmlspecialchars($_SESSION['first-name']) . ' ';
            echo htmlspecialchars($_SESSION['last-name']);
            ?>
            <br>
            Ore lavorate: <?php echo htmlspecialchars($hours_worked); ?>
        </span>
    </div>
    <div class="widget">
    </div>
</div>

<?php include TEMPLATES_PATH . 'footer.php'; ?>
