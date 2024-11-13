<?php
include "./header.php";
include "./menu.php";
?>
        <div id="user-page">
          <div class="widget banner" id="user-area-banner"></div>

          <div class="widget" id="item2">
            <h3>Area clienti</h3>
            
            <form action="./flights.php" method="POST" id="user">
              <div class="fields">
                <div class="form-label" id="first-name">
                  <label for="name">Nome</label>
                  <input
                    type="text"
                    id="name"
                    name="name"
                    placeholder="Inserisci il tuo nome"
                    required
                  />
                </div>

                <div class="form-label" id="last-name">
                  <label for="surname">Cognome</label>
                  <input
                    type="text"
                    id="surname"
                    name="surname"
                    placeholder="Inserisci il tuo cognome"
                    required
                  />
                </div>

                <div class="form-label" id=user-id>
                  <label for="userid">Codice utente</label>
                  <input
                    type="text"
                    id="userid"
                    name="userid"
                    placeholder="Inserisci il tuo codice utente"
                    required
                  />
                </div>
              </div>
              <input type="submit" value="Invia" />
            </form>
          </div>
        </div>
        <?php include "./footer.php";
?>
