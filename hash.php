<?php
include "./database.php";
$sql = "SELECT Password FROM Personale";
$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>


<?php while ($row = mysqli_fetch_assoc($result)) {
    echo "Password: " . $row["Password"] . "<br>";
    $hashed = password_hash($row["Password"], PASSWORD_DEFAULT);
    echo "Hashed: " . $hashed . "<br>";
    echo "<br>";
}
?>
