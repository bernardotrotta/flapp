<?php session_start(); ?>
<?php require_once __DIR__ . '/../includes/config.php'; ?>
<?php include TEMPLATES_PATH . 'database.php'; ?>

<?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    if (!isset($_POST['employee-id'])) {
        echo 'ID Dipendente non fornito.';
        exit();
    }
    $sql = 'SELECT * FROM Personale WHERE ID_DIPENDENTE = ?';
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 's', $_POST['employee-id']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($result && ($row = mysqli_fetch_assoc($result))) {
        if (password_verify($_POST['pass'], $row['Password'])) {
            $_SESSION['employee-id'] = $_POST['employee-id'];
            $_SESSION['first-name'] = $row['Nome'];
            $_SESSION['last-name'] = $row['Cognome'];
            $_SESSION['role'] = $row['Ruolo'];
            header('Location: ./staff-area.php');
        } else {
            echo 'Password sbagliata.';
        }
    } else {
        echo 'ID Dipendente non trovato.';
    } // Chiudi statement e connessione
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} ?>

<?php
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
