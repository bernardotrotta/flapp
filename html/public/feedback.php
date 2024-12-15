<?php require_once __DIR__ . '/../includes/config.php'; ?>
<?php include TEMPLATES_PATH . 'header.php'; ?>
<?php include TEMPLATES_PATH . 'menu.php'; ?>

<div id="feedback-page">
    <div class="widget banner" id="feedback-page-banner"></div>
    <div class="widget" id="feedback-page-form">
        <h3>La tua opinione conta!</h3>
        <form action="feedback-submit.php" method="POST">
            <div class="fields">
                <div class="form-label">
                    <label for="author">Nome</label>
                    <input type="text" name="author" id="author" required />
                </div>
                <div class="form-label">
                    <label for="content">Contenuto</label>
                    <input type="text" name="content" id="content" required />
                </div>
            </div>
            <div class="rating">
                <input type="radio" name="rating" id="star-5" class="rating-radio" value="5" />
                <label for="star-5"><i class="fa-solid fa-star"></i></label>
                <input type="radio" name="rating" id="star-4" class="rating-radio" value="4" />
                <label for="star-4"><i class="fa-solid fa-star"></i></label>
                <input type="radio" name="rating" id="star-3" class="rating-radio" value="3" />
                <label for="star-3"><i class="fa-solid fa-star"></i></label>
                <input type="radio" name="rating" id="star-2" class="rating-radio" value="2" />
                <label for="star-2"><i class="fa-solid fa-star"></i></label>
                <input type="radio" name="rating" id="star-1" class="rating-radio" value="1" />
                <label for="star-1"><i class="fa-solid fa-star"></i></label>
            </div>
            <input type="submit" value="Invia" />
        </form>
    </div>
</div>

<?php include TEMPLATES_PATH . 'footer.php'; ?>
