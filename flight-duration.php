<?php
include "./header.php";
include "./menu.php";
include "./database.php";

$from = mysqli_real_escape_string($con, $_POST["from"]);
$to = mysqli_real_escape_string($con, $_POST["to"]);
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

$result = mysqli_query($con, $sql);
?>
            <div class="scroll-container" id="flight-duration-page">
                <div class="widget banner" id="flight-duration-banner">
                </div>
                <div class="widget">
                    <?php if ($result) {
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) { ?>
                    <h3>Durata del volo </h3>
                    <span>Volo da:  <b><?php echo $from; ?></b></span>                   
                    <span>A: <b><?php echo $to; ?></b></span>           
                    <span>Durata stimata del volo: <b><?php echo htmlspecialchars(
                        $row["Durata"]
                    ); ?> </b></span>                    
                    <?php }
                        } else {
                            $message =
                                "Non è disponibile una durata stimata per questa tratta.";
                            include "./warning.php";
                        }
                    } ?>
                </div>
            </div>

<?php include "./footer.php"; ?>
