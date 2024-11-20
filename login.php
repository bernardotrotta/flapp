<?php
session_start();
include "./database.php";
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["login"])) {
    if (!isset($_POST["employee-id"])) {
        echo "ID Dipendente non fornito.";
        exit();
    }

    $sql = "SELECT Password FROM Personale WHERE ID_DIPENDENTE = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "s", $_POST["employee-id"]);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && ($row = mysqli_fetch_assoc($result))) {
        if (password_verify($_POST["pass"], $row["Password"])) {
            $_SESSION["employee-id"] = $_POST["employee-id"];
            echo "Benvenuto!";
        } else {
            echo "Password sbagliata.";
        }
    } else {
        echo "ID Dipendente non trovato.";
    }

    // Chiudi statement e connessione
    mysqli_stmt_close($stmt);
    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST">
        <label for="empolyee-id">ID Dipendente</label>
        <input type="text" name="employee-id" id="employee-id" required>
        <label for="password">Password</label>
        <input type="password" name="pass" id="password" required>
        <input type="submit" value="Invia" name="login">
    </form>
</body>
</html>
