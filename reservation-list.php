<?php
include("./database.php");

$sql = "SELECT 
V.Data_partenza,
V.Orario_partenza,
A1.Città AS Città_partenza,
A1.Nome AS Aeroporto_partenza,
V.Data_arrivo,
V.Orario_arrivo,
A2.Città AS Città_arrivo,
A2.Nome AS Aeroporto_arrivo,
V.Durata
FROM 
Prenotazioni Pr
JOIN 
Voli V ON Pr.Volo = V.ID_VOLO
JOIN 
Aeroporti A1 ON V.Aeroporto_partenza = A1.ID_AEROPORTO
JOIN 
Aeroporti A2 ON V.Aeroporto_arrivo = A2.ID_AEROPORTO
WHERE 
Pr.ID_PRENOTAZIONE = 'BK00000003'";

$result = mysqli_query($con, $sql);

?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Flapp</title>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="shortcut icon" href="./img/icons/favicon.ico" type="image/x-icon" />
</head>

<body>
    <img src=img/vector.svg alt="" class="cloud">
    <div class="wrapper">
        <div class="container">
            <div class="menu">
                <h2>Flapp</h2>
                <nav>
                    <ul>
                        <li>
                            <a href="./home.html">
                                <img src="./img/icons/uil_plane-departure.svg" alt="" />
                                Home
                            </a>
                        </li>

                        <li>
                            <a href="./user.html">
                                <img src="./img/icons/uil_user.svg" alt="" />
                                Area utente
                            </a>
                        </li>

                        <li>
                            <a href="./reservations.html">
                                <img src="./img/icons/uil_calender.svg" alt="" />
                                Cerca una prenotazione
                            </a>
                        </li>

                        <li>
                            <a href="">
                                <img src="./img/icons/uil_headphones.svg" alt="" />
                                Supporto
                            </a>
                        </li>
                    </ul>
                </nav>
                <span class="review">Ti piace il nostro servizio?
                    <a href="">Lascia una recensione</a></span>
            </div>
            <div id="user-page">

                <div class="widget" id="user-badge">

                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        echo '<div class="user-badge">';
                        echo '<img id="userIcon" src="./img/icons/user.jpg" alt="">';
                        echo "<span>Ciao, <b>$name</b>!</span>";
                        echo '</div>';
                    }
                    ?>

                </div>
                <div class="widget" id="results-table">



                    <?php
                    if ($result) {
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <div class="flight-card">
                                    <div class="flight-card-info">

                                        <div class="flight-card-item flight-card-departure">
                                            <span id="time"><?php echo htmlspecialchars($row['Orario_partenza']); ?></span>
                                            <span><?php echo htmlspecialchars($row['Aeroporto_partenza']); ?></span>
                                            <span><?php echo htmlspecialchars($row['Città_partenza']); ?></span>
                                        </div>

                                        <div class="flight-card-item flight-card-arrival">
                                            <span id="time"><?php echo htmlspecialchars($row['Orario_arrivo']); ?></span>
                                            <span><?php echo htmlspecialchars($row['Aeroporto_arrivo']); ?></span>
                                            <span><?php echo htmlspecialchars($row['Città_arrivo']); ?></span>
                                        </div>

                                    </div>

                                    <div class="flight-card-item flight-card-check">
                                        <span><?php echo htmlspecialchars($row['Data_partenza']); ?></span>
                                        <span>Codice prenotazione:
                                            <?php echo htmlspecialchars($row['Codice_prenotazione']); ?></span>
                                        <span>€<?php echo htmlspecialchars($row['Prezzo_biglietto']); ?></span>
                                    </div>

                                </div>
                                <?php
                            }
                        } else {
                            echo "Nessuna prenotazione associata a questo codice utente.";
                        }
                    } else {
                        echo "Errore nella query: " . mysqli_error($con);
                    }
                    mysqli_close($con);
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>