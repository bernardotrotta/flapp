<!-- Index Menù  -->
<?php require_once __DIR__ . '/../includes/config.php'; ?>
<div class="menu">
    <h2><a href="<?= BASE_URL ?>index.php">Flapp</a></h2>
    <nav>
        <ul>
            <li>
                <a href="<?= BASE_URL ?>home.php"><img src="<?= BASE_URL ?>img/icons/uil_user.svg" alt="" />Area
                    utente</a>
            </li>
            <li>
                <a href="<?= BASE_URL ?>login.php"><img src="<?= BASE_URL ?>img/icons/uil_headphones.svg" alt="" />Area
                    staff</a>
            </li>
            <hr>
            <h3>Contributors</h3>
            <li>
                <img class="user-avatar" src="<?= BASE_URL ?>img/doina-cauliuc.jpg" alt="" />
                <a href="https://github.com/doinacauliuc">Doina Cauliuc</a>
            </li>
            <li>
                <img class="user-avatar" src="<?= BASE_URL ?>img/bernardo-trotta.jpg" alt="" />
                <a href="https://github.com/bernardotrotta">Bernardo Trotta

                </a>
            </li>
        </ul>
    </nav>
    <span class="review">Ti piace il nostro servizio?
        <a href="<?= BASE_URL ?>feedback.php">Lascia una recensione</a></span>
</div>