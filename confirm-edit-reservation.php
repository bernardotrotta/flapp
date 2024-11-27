<?php
session_start();
include "./header.php";
include "./menu.php";
include "./database.php";

$sql = "SELECT 
    V.ID_VOLO,
    A.Capacità - IFNULL(COUNT(P.ID_PRENOTAZIONE), 0) AS Posti_disponibili
FROM 
    Voli V
JOIN 
    Aerei A ON V.Aereo = A.ID_AEREO
LEFT JOIN 
    Prenotazioni P ON V.ID_VOLO = P.Volo
WHERE 
    V.ID_VOLO = ?
GROUP BY 
    V.ID_VOLO, A.Capacità";

$sql2 = "DELETE FROM Prenotazioni
WHERE ID_PRENOTAZIONE = ?";

$sql3 = "SELECT CONCAT('BK',LPAD(CAST(MAX(CAST(SUBSTRING(ID_PRENOTAZIONE, 3) AS UNSIGNED)) + 1 AS CHAR), 8, '0')) AS NuovoID_Prenotazione
FROM Prenotazioni";

$sql4 = "INSERT INTO `Prenotazioni` (`ID_PRENOTAZIONE`, `Passeggero`, `Volo`, `Prezzo_biglietto`) VALUES
(?, ?, ?, ?);";

$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, "s", $_POST["flight_id"]);
$stmt2 = mysqli_prepare($con, $sql2);
$stmt3 = mysqli_prepare($con, $sql4);
mysqli_stmt_bind_param(
    $stmt3,
    "sssd",
    $nuovoID,
    $_SESSION["user-id"],
    $_POST["flight_id"],
    $_POST["price"]
);
mysqli_stmt_bind_param($stmt2, "s", $_POST["reservation_id"]);
mysqli_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$result2 = mysqli_query($con, $sql3);
?>

<div class="scroll-container">
    <div class="widget">
        <?php
        echo "ID volo selezionato: " . $_POST["flight_id"] . "<br>";
        $row = mysqli_fetch_assoc($result);
        if ($row && $row["Posti_disponibili"] > 0) {
            echo "Posti disponibili: " . $row["Posti_disponibili"] . "<br>";
            if (mysqli_execute($stmt2)) {
                echo "Vecchia prenotazione eliminata con successo!" . "<br>";
                if ($result2) {
                    $row2 = mysqli_fetch_assoc($result2);
                    if ($row2) {
                        $nuovoID = $row2["NuovoID_Prenotazione"];
                        echo "Il nuovo ID prenotazione è: " . $nuovoID . "<br>";
                        mysqli_execute($stmt3);
                        echo "Nuova prenotazione creata con successo!";
                    } else {
                        echo "Nessun risultato trovato.";
                    }
                } else {
                    echo "Errore nella query: " . mysqli_error($mysqli);
                }
            } else {
                echo "Errore nella query: " . mysqli_error($mysqli);
            }
        } else {
            echo "Nessun posto disponibile sull'aereo!";
        }
        ?>
    </div>
</div>

<?php include "./footer.php";
?>
