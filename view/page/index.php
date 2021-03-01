<div class="row m-3 pb-5">
    <div class="col">
        <a href="/link/"> Generate short link. </a>
    </div>
</div>

<div class="row m-3">
    <div class="col">
        <?php if (!empty($links)): ?>
            <h2>Links: </h2>
            <?php foreach ($links as $link): ?>
                <div class="mb-5">
                    <div class="row m-3">
                        <div class="col">
                            <div>
                                Target link: <?php echo $link->getTargetLink(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row m-3">
                        <div class="col">
                            <div>
                                Short link: <?php echo $link->getShortLink(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row m-3">
                        <div class="col">
                            <div>
                                Expiration date: <?php echo $link->getExpirationDate()->format('Y-m-d\TH:i:s\Z'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <? endif; ?>
    </div>
</div>
