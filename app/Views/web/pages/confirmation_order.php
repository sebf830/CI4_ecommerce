<?= $this->extend('web/layouts/order_confirmation_layout') ?>

<?= $this->section('body-contents') ?>

<div class='wrapper_home' style="margin: 30px auto;">
    <div class="container_order">
        <div class='order_info'>
            <span> <img src="<?= base_url('assets/web/images/paw.png'); ?>" width="50" height="50" />Venus-Shop</span>
            <span class="back_home"><a href="<?= base_url('exit_order') ?>"><i class="fas fa-home"></i></a></span>
        </div>

        <div class="order_info_body">
            <h5>Chèr(e) <?= session()->get('customer_name') ?>,</h5>
            <p class="check"><i class="fas fa-check"></i> Votre commande est confirmée</p>
            <p class="check" style="font-size:18px;"> Félicitation vous avez gagné <?= session()->get('points') ?> points Vénus!</p>

            <p>Merci de nous accorder votre confiance. Voici le récapitulatif de votre achat : </p>
        </div>
        <?php $total = 0 ?>

        <div class="order_details">
            <?php for ($i = 0; $i < count($items); $i++) : ?>
                <div style="display:flex;justify-content:space-between">
                    <div class='img_order'>
                        <img src="<?= base_url('public/uploads/' . $items[$i]['image']) ?>" width="50" height="50" />
                    </div>
                    <p class='title_order'><?= $items[$i]['quantite'] ?> x <?= $items[$i]['title'] ?> </p>
                    <p class='price_order'> <?= number_format($items[$i]['quantite'] * $items[$i]['price'], 2) ?>€</p><br>
                    <?php $total += $items[$i]['quantite'] * $items[$i]['price'] ?><br>
                </div>
            <?php endfor ?>
        </div>

        <div class="order_details_2">
            <div>
                <p>Commande n° <?= session()->get('numero_commande') ?></p>
                <a class="bouton_dl" href="<?= base_url('exit_order') ?>">Retourner à la boutique</a>
            </div>
            <div style="margin-right:100px;">
                <p>Montant total HT : <?= number_format($total, 2) ?>€</p>
                <p>TVA 20% : <?= number_format(($total * 1.20) - $total, 2) ?>€</p>
                <p style="font-weight:bold;">Montant total TTC : <?= $total * 1.20 ?>€</p>
            </div>
        </div>
        <div class="shipping">
            <div>
                <h5>Livraison</h5>
                <p>Envoyer à :</p><br>
                <span><?= $shipping_infos['shipping_name'] ?></span><br>
                <span><?= $shipping_infos['shipping_address'] ?></span><br>
                <span><?= $shipping_infos['shipping_zipcode'] ?> <?= $shipping_infos['shipping_city'] ?></span><br>
                <span>France</p>


            </div>
            <div style="margin-right:20px;">
                <h5>Date de livraison estimée</h5>
                <?php $date = date('d-m-Y')  ?>
                <p>Le <?= date('d-m-Y', strtotime($date . '+ 7 days'))  ?></p>
            </div>
        </div>
        <div class="terms">
            <small>Lorem ipsum dolor sit amet, <span class="link_terms">condition d'utilisation</span> elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</small><br>
            <small>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                Excepteur sint occaecat <span class="link_terms">respect de la vie privée</span> proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</small><br>
            <small>Duis <span class="link_terms">Venus-Shop</span>
                aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat>non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</small>
        </div>




    </div>





</div>
<?= $this->endSection() ?>