<?php require_once 'config.php'; ?>
<?php include TEMPLATES_PATH . 'database.php'; ?>

<?php
$author = mysqli_real_escape_string($conn, $_POST['author']);
$content = mysqli_real_escape_string($conn, $_POST['content']);
$rating = mysqli_real_escape_string($conn, $_POST['rating']);
$sql = "INSERT INTO Recensioni (Nome_utente,Contenuto,Valutazione) VALUES ('$author','$content',$rating)";
?>

<?php include TEMPLATES_PATH . 'header.php'; ?>
<?php include TEMPLATES_PATH . 'menu.php'; ?>

<div id="feedback-page">
    <div class="widget banner" id="feedback-page-banner">
    </div>
    <div class="widget" id="feedback-page-form">
        <?php if ($conn->query($sql) === true) {
            echo '<h3>Recensione inviata con successo!</h3>';
        } else {
            echo 'Errore: ' . $sql . '<br>' . $conn->error;
        } ?>
    </div>
</div>

<?php include TEMPLATES_PATH . 'footer.php'; ?>
