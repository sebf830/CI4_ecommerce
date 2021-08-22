<?= $this->extend('web/layouts/admin_layout') ?>
<?= $this->section('body-contents') ?>
<?= $this->include('web/inc/sidebar_customer') ?>

<main>
    <?php if ($_SERVER['PATH_INFO'] == '/profile/history') : ?>

        <div class="cards_history" style="width:80%;margin:20px auto;text-align:center;min-height:70vh;">
            <div class=" card-single" style="background-color:white;padding:5px 20px;margin:0 auto;text-align:center;min-height:70vh;">
                <div class="history-page" style="width:80%;margin:50px auto;text-align:center; ">
                    <h5 class="history-page__title">Historique des commandes</h5>
                    <div class="search">
                        <div class="search_history_form" style="margin-bottom:15px;">
                            <form>
                                <input type="text" name="search_history" style="padding:2px 5px;border:1px solid lightgrey;height:30px;border-radius:20px;" placeholder="search_order" />
                            </form>
                        </div>
                    </div>
                    <hr />
                    <?php if (count($listOrder) > 0) : ?>
                        <?php foreach ($listOrder as $list) : ?>
                            <div class="history-list">
                                <img src="<?= base_url('assets/web/images/shopping.png') ?>" width="40" height="40">
                                <div class='infos_history'>
                                    <p>Commande du <?= substr($list['created_at'], 0, 10) ?></p>
                                    <a class="button_history" href="<?= base_url('profile/history/' . $list['order_id']) ?>">Détails</a>
                                </div>
                                <p style="font-size:18px; color:grey"><?= number_format($list['order_total'], 2) ?>€</p>
                            </div>
                            <hr>
                        <?php endforeach ?>
                    <?php else : ?>
                        <p>Vous n'avez pas encore de commande</p>
                    <?php endif ?>
                </div>
            </div>
        </div>
    <?php else : ?>
        <?php foreach ($order_details as $details) :  ?>
            <p><?= $details['product_name'] ?></p>
        <?php endforeach ?>

    <?php endif ?>

</main>

<?= $this->endSection() ?>