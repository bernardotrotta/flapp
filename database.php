<?php
include "var.php";

$con = mysqli_connect("$DB", "root", "root", "flapp");

// Verifica della connessione
// if (!$con) {
//     die("Connessione fallita: " . mysqli_connect_error());
// } else {
//     echo "Connessione riuscita!";
// }
