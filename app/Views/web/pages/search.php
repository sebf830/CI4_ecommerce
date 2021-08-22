<?= $this->extend('web/layouts/main_layout') ?>

<?= $this->section('body-contents') ?>
<div class="wrapper_search">
    <div class="content">
        <div class="content_top">

        </div>

        <h3 class="titre_section_home">Résultats concernant : <?= $value ?></h3>

    </div>
    <div class="card_section_home">
        <?php foreach ($result_search as $result) : ?>
            <!--- card nouveautés---->
            <div class="card_home">
                <div class="imgCardHome">
                    <a href="produit/<?= $result['product_id'] ?>">
                        <img style="width:250px;height:250px" src="<?= base_url('public/uploads/' . $result['product_image']) ?>" alt="" />
                    </a>
                </div>
                <div class="texteCardHome">
                    <h3><?= $result['product_title'] ?></h3>
                    <p class="desc"><?= word_limiter($result['short_description'], 10) ?></p>
                    <p class="price"><?= format_number($result['product_price'], 2); ?>€</p>
                    <a class="buttonHomeCard" href="produit/<?= $result['product_id'] ?>">détails</a>
                </div>
            </div>
            <!---- fin de card nouveautés ----->
        <?php endforeach ?>
    </div>
</div>


<?= $this->endSection() ?>