<?php
if (!$_SERVER['REQUEST_METHOD'] === 'POST') {
    die('Errore: Accesso non autorizzato.');
}

include 'database.php';

$sql = "DELETE FROM Prenotazioni
WHERE ID_PRENOTAZIONE = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 's', $_POST['reservation_id']);
$message = '';
if (isset($_POST['delete-button'])) {
    mysqli_stmt_execute($stmt);
    $message = 'Prenotazione eliminata con successo!';
    // echo 'Prenotazione eliminata con successo!';
}
?>
