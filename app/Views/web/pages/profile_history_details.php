<?= $this->extend('web/layouts/admin_layout') ?>
<?= $this->section('body-contents') ?>
<?= $this->include('web/inc/sidebar_customer') ?>

<main>

    <div class="cards_history" style="width:80%;margin:20px auto;text-align:center; ">
        <div class=" card-single" style="background-color:white;padding:5px 20px;margin:0 auto;text-align:center;">
            <div class="history-page" style="width:80%;margin:50px auto;text-align:center; ">
                <h5 class="history-page__title">Détail de la commande</h5>

                <hr />
                <?php foreach ($order_details as $details) :  ?>
                    <div class="history-list">
                        <img src="<?= base_url('public/uploads/' . $details['product_image']) ?>" width="40" height="40">
                        <p><?= $details['product_sales_quantity'] ?> X <?= $details['product_name'] ?></p>
                        <p style="font-size:18px; color:grey"><?= number_format($details['product_price'] * $details['product_sales_quantity'], 2) ?>€</p>
                    </div>
                    <hr>
                <?php endforeach ?>
                <h5 class="history-page__title">Montant total de la commande</h5>
                <p style="font-size:24px;color:grey"><?= number_format($order_info['order_total'], 2) ?>€</p>
                <hr />
                <h5 class="history-page__title">Nombre de points gagnés</h5>
                <p style="font-size:24px;color:grey"><?= $points ?> points</p>
                <hr />
                <h5 class="history-page__title">Statut de la commande</h5>
                <p>
                    <spanp><i class="tiny material-icons green-text text-accent-2">check</i></span> Livrée
                </p>
                <hr />
                <h5 class="history-page__title">Adresse de livraison</h5>

                <?= $shipping_details['shipping_name'] ?><br>
                <?= $shipping_details['shipping_address'] ?><br>
                <?= $shipping_details['shipping_city'] ?><br>
                <?= $shipping_details['shipping_zipcode'] ?><br>




            </div>
        </div>
    </div>
</main>


<?= $this->endSection() ?>