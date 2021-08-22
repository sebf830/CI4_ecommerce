 <?= $this->extend('web/layouts/main_layout') ?>

 <?= $this->section('body-contents') ?>
 <div class="wrapper_home">
     <div class="content" style=padding-bottom:20px;>
         <div class="cartoption">
             <div class="cartpage">
                 <h2>Mon panier</h2>
                 <?php if (session()->has('cart') && !empty(session('cart'))) : ?>
                     <table class="tblone">
                         <tr>
                             <th width="5%"></th>
                             <th width="30%">Article</th>
                             <th width="10%">Image</th>
                             <th width="15%">Prix</th>
                             <th width="20%">Quantité</th>
                             <th width="15%">total article</th>
                             <th width="5%">Enlever</th>
                         </tr>
                         <?php $i = 0; ?>
                         <?php foreach ($items as $index => $item) : ?>
                             <?php $i++ ?>
                             <tr <?= $items > 1 ? 'style="border-bottom:1px solid #ededed;"' : '' ?>>
                                 <td><?= $i; ?></td>
                                 <td><?= $item['title'] ?></td>
                                 <td><img src=" <?= base_url('public/uploads/' . $item['image']) ?>" alt="" />
                                 </td>
                                 <td><span class="m-query">Prix unitaire : </span><?= number_format($item['price'], 2) ?>€</td>
                                 <td>
                                     <form action="<?= base_url('panier/modifier') ?>" method="post">
                                         <input type="number" name="qte" value="<?= $item['quantite'] ?>" />
                                         <input type="hidden" name="id_item" value="<?= $item['id'] ?>" />
                                         <input type="submit" name="submit" value="recalculer" />
                                     </form>
                                 </td>
                                 <td><span class="m-query">Total article : </span><?= number_format($item['price'] * $item['quantite'], 2) ?>€</td>
                                 <td>
                                     <form class="delete_item" action="<?= base_url('panier/supprimer/' . $item['id']); ?>" method="post">
                                         <input type="hidden" name="id_item" value="<?= $item['id'] ?>" />
                                         <button type="submit" name="submit" value="Supprimer"><i class="fas fa-trash-alt"></i></button>
                                     </form>
                                 </td>
                             </tr>
                         <?php endforeach ?>
                     </table>
                     <br>
             </div>
             <table class="tbltwo" width="40%">
                 <tr>
                     <th>Sous-total : </th>
                     <td><?= number_format($subtotal, 2) ?>€</td>
                 </tr>
                 <tr>
                     <th>TVA: </th>
                     <td><?= number_format(($subtotal * 1.2) - $subtotal, 2) ?>€</td>
                 </tr>
                 <tr>
                     <th>Total TTC:</th>
                     <td><span><?= number_format($subtotal * 1.2, 2) ?>€</span></td>
                 </tr>
             </table>
             <div class="shopping">
                 <div class="shopright">
                     <?php if (session()->get('customer_id')) : ?>
                         <a class="button_cart" href="<?php echo base_url('produits') ?>">Poursuivre les achats</a>
                         <a class="button_cart" href="<?php echo base_url('checkout') ?>">Valider le panier</a>
                     <?php else : ?>
                         <a class="button_cart" href="<?php echo base_url('produits') ?>">Poursuivre les achats</a>
                         <a class="button_cart" href="<?php echo base_url('client/connexion') ?>">Valider le panier</a>
                     <?php endif ?>
                 </div>
             </div>
         <?php else : ?>
             <img src="<?= base_url('public/uploads/empty2.jpg') ?>" />
             <p class="grey-text text-lighten-1">Votre panier est vide, n'hésitez pas à explorer notre catalogue</p>
         <?php endif ?>
         </div>
     </div>
 </div>

 <?= $this->endSection() ?>