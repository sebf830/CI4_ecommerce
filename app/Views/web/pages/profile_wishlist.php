<?= $this->extend('web/layouts/admin_layout') ?>
<?= $this->section('body-contents') ?>
<?= $this->include('web/inc/sidebar_customer') ?>

<main>
    <?php if (count($liked_product) == 0) : ?>
        <p style="text-align:center;margin-top:80px;">Vous n'avez pas ajouté d'article à votre liste d'envie</p>
    <?php else : ?>
        <div class="cards">
            <?php foreach ($liked_product as $liked) : ?>
                <div class="card-single" style="background-color:white;">
                    <div style="text-align:center">
                        <h5 style='font-size:16px;'><?= $liked['product_title'] ?></h5>
                        <img src="<?= base_url('public/uploads/' . $liked['product_image']) ?>" height="140" width="140">
                        <p><?= word_limiter($liked['short_description'], 8) ?></p>
                        <p style="font-size:18px; color:grey"><?= number_format($liked['product_price'], 2) ?>€</p>
                        <br>
                        <form action="" method="post">
                            <button type="submit" id="paw" class="liked paw" style='border:none;background:none;'>
                                <i class="pink-text text-lighten-2 material-icons" style="font-size:35px;">pets</i>
                            </button>
                            <br><br>
                            <input type="hidden" id="idProd" name="idProd" value="<?= $liked['product_id'] ?>" />
                        </form>
                        <a href="<?= base_url('panier/ajouter/' . $liked['product_id']) ?>" class="btn">
                            Ajouter au panier <i class="fas fa-shopping-cart"></i>

                        </a>
                    </div>
                </div>
            <?php endforeach ?>
        <?php endif ?>
        </div>
</main>


<?= $this->endSection() ?>