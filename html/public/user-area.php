<?php
require_once __DIR__ . '/../includes/config.php';
include TEMPLATES_PATH . 'header.php';
include TEMPLATES_PATH . 'menu.php';
?>

<div id="user-page">
    <div class="widget banner" id="user-area-banner"></div>
    <div class="widget" id="user-area-form">
        <h3>Area clienti</h3>
        <form action="flights.php" method="POST" id="user">
            <div class="fields">
                <div class="form-label" id="first-name">
                    <label for="first-name">Nome</label>
                    <input type="text" id="first-name" name="first-name" placeholder="Inserisci il tuo nome" required />
                </div>
                <div class="form-label" id="last-name">
                    <label for="last-name">Cognome</label>
                    <input type="text" id="last-name" name="last-name" placeholder="Inserisci il tuo cognome"
                        required />
                </div>
                <div class="form-label" id="user-id">
                    <label for="user-id">Codice utente</label>
                    <input type="text" id="user-id" name="user-id" placeholder="Inserisci il tuo codice utente"
                        required />
                </div>
            </div>
            <input type="submit" value="Invia" />
        </form>
    </div>
</div>

<?php include TEMPLATES_PATH . 'footer.php'; ?>
