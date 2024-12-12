<!-- Menù  -->

<?php require_once __DIR__ . '/../includes/config.php'; ?>

<div class="menu">
    <h2><a href="<?= BASE_URL ?>index.php">Flapp</a></h2>
    <nav>
        <ul>
            <li>
                <a href="<?= BASE_URL ?>home.php"><img src="<?= BASE_URL ?>img/icons/uil_plane-departure.svg"
                        alt="" />Home</a>
            </li>
            <li>
                <a href="<?= BASE_URL ?>user-area.php"><img src="<?= BASE_URL ?>img/icons/uil_user.svg" alt="" />Area
                    utente</a>
            </li>
            <li>
                <a href="<?= BASE_URL ?>reservations.php"><img src="<?= BASE_URL ?>img/icons/uil_calender.svg"
                        alt="" />Cerca una
                    prenotazione</a>
            </li>
        </ul>
    </nav>
    <span class="review">Ti piace il nostro servizio?
        <a href="<?= BASE_URL ?>feedback.php">Lascia una recensione</a></span>
</div>