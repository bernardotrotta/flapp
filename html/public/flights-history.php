<?php
include __DIR__ . '/../includes/config.php';
include INCLUDES_PATH . 'flights-history.php';
include TEMPLATES_PATH . 'header.php';
include TEMPLATES_PATH . 'employee-menu.php';
?>

<div class="widget">
    <?php
    if ($result) {
        if (mysqli_num_rows($result) > 0) { ?>
    <table>
        <tbody>
            <tr>
                <th>ID Volo</th>
                <th>Aeroporto di partenza</th>
                <th>Aeroporto di arrivo</th>
                <th>Data partenza</th>
                <th>Ora partenza</th>
                </td>
                <?php while ($row = mysqli_fetch_assoc($result)) {
                    include TEMPLATES_PATH . 'results-table.php';
                } ?>
        </tbody>
    </table>
    <?php } else {echo 'Nessuna prenotazione associata a questo codice utente.';}
    } else {
        echo 'Errore nella query: ' . mysqli_error($conn);
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    ?>
</div>


<?php include TEMPLATES_PATH . 'footer.php';
?>
