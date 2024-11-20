<?php
include "./header.php"; ?>

<div id="staff-area">

          <div class="widget banner" id="bookings-page-banner"></div>
          <div class="widget" id="bookings-page-form">
            <h3>Area Staff</h3>
            <form action="" method="POST">
              <div class="form-label">
                <label for="employeeId">Codice dipendente</label>
                <input
                  type="text"
                  id="employeeId"
                  name="employeeId"
                  placeholder="Inserisci il codice dipendente"
                />
              </div>
              <input type="submit" value="Invia" />
            </form>
          </div>
        </div>

<?php include "./footer.php"; ?>
