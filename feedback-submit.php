<?php
include "./database.php";
include "./header.php";
include "./menu.php";

$author = $_POST["author"];
$content = $_POST["content"];
$rating = $_POST["rating"];
$sql = "INSERT INTO Recensioni (Nome_utente,Contenuto,Valutazione) VALUES ('$author','$content',$rating)";
?>
        
        <div id="feedback-page">
          <div class="widget banner" id="feedback-page-banner">
          </div>
          <div class="widget" id="feedback-page-form">
            <?php if ($con->query($sql) === true) {
                echo "<h3>Recensione inviata con successo!</h3>";
            } else {
                echo "Errore: " . $sql . "<br>" . $con->error;
            } ?>
          </div>
        </div>

<?php include "./footer.php";
?>
