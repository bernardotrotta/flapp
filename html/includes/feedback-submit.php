<?php require_once 'config.php'; ?>
<?php include 'database.php'; ?>

<?php
$author = mysqli_real_escape_string($conn, $_POST['author']);
$content = mysqli_real_escape_string($conn, $_POST['content']);
$rating = mysqli_real_escape_string($conn, $_POST['rating']);
$sql = "INSERT INTO Recensioni (Nome_utente,Contenuto,Valutazione) VALUES ('$author','$content',$rating)";
?>


