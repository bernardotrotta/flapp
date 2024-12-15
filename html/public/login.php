<?php
require_once __DIR__ . '/../includes/config.php';
include INCLUDES_PATH . 'login.php';
include TEMPLATES_PATH . 'header.php';
include TEMPLATES_PATH . 'menu.php';
?>

<div id="login-page">
    <div class="widget">
        <h2>Area Staff</h2>
        <form action="" method="POST">
            <div>
                <label for="empolyee-id">ID Dipendente</label>
                <input type="text" name="employee-id" id="employee-id" required>
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" name="pass" id="password" required>
            </div>
            <input type="submit" value="Invia" name="login">
        </form>
    </div>
</div>

<?php include TEMPLATES_PATH . 'footer.php'; ?>
