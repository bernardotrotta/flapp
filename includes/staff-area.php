<?php session_start(); ?>
<?php include TEMPLATES_PATH . 'database.php'; ?>

<?php
$query = "SELECT SUM(V.Durata) AS Totale_ore
FROM Voli V
JOIN Servizio S ON V.ID_VOLO = S.ID_volo
JOIN Personale P ON S.ID_dipendente = P.ID_DIPENDENTE
WHERE P.ID_DIPENDENTE = ? 
  AND MONTH(V.Data_partenza) = MONTH(CURDATE())
  AND YEAR(V.Data_partenza) = YEAR(CURDATE())
  AND V.Data_partenza <= CURRENT_DATE;";
$stmt = mysqli_prepare($conn, $query);
if ($stmt) {
    mysqli_stmt_bind_param($stmt, 's', $_SESSION['employee-id']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $hours_worked = 0;
    if ($row = mysqli_fetch_assoc($result)) {
        $hours_worked = $row['Totale_ore'] ?? 0;
    }
    mysqli_stmt_close($stmt);
} else {
    die('Errore nella preparazione della query: ' . mysqli_error($conn));
}
mysqli_close($conn);
?>

<?php include TEMPLATES_PATH . 'header.php'; ?>
<?php include TEMPLATES_PATH . 'employee-menu.php'; ?>

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
        <!-- Altri widget qui -->
    </div>
</div>

<?php include TEMPLATES_PATH . 'footer.php'; ?>
