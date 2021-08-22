<?= $this->extend('web/layouts/main_layout') ?>

<?= $this->section('body-contents') ?>

<!-- debuts section tous les produits  -->
<div class="wrapper_home">

    <div class="content-products" style="padding:5px 1%;">

        <div class="content_pagination">
            <div class="pagination ">
                <?= $pager->links() ?>
            </div>
        </div>

        <div class="section_category card_section_home">

            <?php if (count($produits) > 0) : ?>
                <?php foreach ($produits as $index => $produit) : ?>
                    <div class="card_home" style="margin-top:15px;">
                        <div class="imgCardHome">
                            <a href="<?= base_url('produit/' . $produit['product_id']) ?>">
                                <img style="width:250px;height:250px" src="<?= base_url('public/uploads/' . $produit['product_image']) ?>" alt="" />
                            </a>
                        </div>
                        <div class="texteCardHome">
                            <h3><?= $produit['product_title'] ?></h3>
                            <p class="desc"><?= word_limiter($produit['short_description'], 10) ?></p>
                            <p class="price"><?= number_format($produit['product_price'], 2); ?>€</p>
                            <a class="buttonHomeCard" href="<?= base_url('produit/' . $produit['product_id']) ?>">détails</a>
                        </div>
                    </div>
                <?php endforeach ?>
            <?php endif ?>
        </div>
    </div>
</div>
<style>
    .content_pagination {
        padding: 20px;
    }
</style>

<?= $this->endSection() ?>