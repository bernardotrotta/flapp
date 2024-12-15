<?php require_once 'config.php'; ?>
<?php include 'database.php'; ?>

<?php
$from = mysqli_real_escape_string($conn, $_POST['from']);
$to = mysqli_real_escape_string($conn, $_POST['to']);
$sql = "SELECT
        v.Durata
        FROM 
            Voli v
        JOIN 
            Aeroporti a_partenza ON v.Aeroporto_partenza = a_partenza.ID_AEROPORTO
        JOIN 
            Aeroporti a_arrivo ON v.Aeroporto_arrivo = a_arrivo.ID_AEROPORTO
        WHERE 
            a_partenza.Città = '$from'
            AND a_arrivo.Città = '$to'
        LIMIT 1";
$result = mysqli_query($conn, $sql);
?>

