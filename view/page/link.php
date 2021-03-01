<div class="row m-3 mb-5">
    <div class="col">
        <a href="/"> Go to index. </a>
    </div>
</div>

<div class="row m-3">
    <div class="col">
        <form action="/link/" method="post">
            <label for="target_link"> Target link: </label>
            <input type="text" name="target_link" required>

            <label for="expiration_date"> Expiration date: </label>
            <input type="datetime-local" name="expiration_date" required>

            <input type="submit" name="generate_short_link" value="Generate short link">
        </form>
    </div>
</div>

<div class="row m-3">
    <div class="col">
        <?php if (isset($shortLink)): ?>
            <p>Short link: <?= $shortLink; ?></p>
        <?php endif; ?>

        <?php if (isset($errorMessages)): ?>
            <h2 class="text-danger">Errors:</h2>
            <?php foreach ($errorMessages as $errorMessage): ?>
                <p class="text-danger"><?= $errorMessage; ?></p>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
