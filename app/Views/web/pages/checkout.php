 <?= $this->extend('web/layouts/main_layout') ?>

 <?= $this->section('body-contents') ?>

 <?= $this->include('web/inc/loader') ?>


 <div class="wrapper_home">
     <div class="content" style="text-align: center">

         <div class="form_checkout">
             <form class="formCheckout" method="post" action="">
                 <fieldset>
                     <h3>Choisissez un mode de paiement</h3><br>
                     <label>
                         <input class="with-gap" name="payment" type="radio" value="paypal" />
                         <span><img src="<?= base_url('assets/web/images/paypal.png') ?>" alt="paypal" width="80" height="30" /></span>
                     </label>
                     <label>
                         <input class="with-gap" name="payment" type="radio" value="card" />
                         <span><img src="<?= base_url('assets/web/images/visa.png') ?>" alt="visa" width="80" height="30" /></span>
                     </label>
                     <label>
                         <input class="with-gap" name="payment" type="radio" value="bitcoin" />
                         <span><img src="<?= base_url('assets/web/images/bitcoin.png') ?>" alt="bitcoin" width="30" height="30" /></span>

                     </label>
                     <p class="purple-text text-lighten-3" style="font-size:13px;"><?= isset($validation) ? $validation->getError("payment") : '' ?></p>

                 </fieldset>
                 <div class="section_form">
                     <div style="width:50%;">
                         <fieldset style="min-height:320px">
                             <h3 style="font-size:16px;">Votre adresse de livraison</h3><br>
                             <label>
                                 <input class="with-gap" name="adress" type="radio" checked value="client_address" />
                                 <span>Utiliser mon adresse client</span>
                             </label><br><br>
                             <label class="apparition_form">
                                 <input class="with-gap " name="adress" type="radio" value="new_address" />
                                 <span>Renseigner une autre adresse</span>
                             </label>
                             <div class="form_adress">
                                 <input class="input_checkout" type="text" name="nom" placeholder="Nom*" value="<?= isset($values['nom']) ? $values['nom'] : '' ?>" />
                                 <span class="purple-text text-lighten-3" style="font-size:13px;"><?= isset($validation) ? $validation->getError("nom") : '' ?></span>

                                 <input class="input_checkout" type="text" name="adresse" placeholder="Adresse*" value="<?= isset($values['adresse']) ? $values['adresse'] : '' ?>" />
                                 <span class="purple-text text-lighten-3" style="font-size:13px;"><?= isset($validation) ? $validation->getError("adresse") : '' ?></span>

                                 <input class="input_checkout" type="text" name="adresse_complement" placeholder="Complément adresse(bât,code,escalier..)" value="<?= isset($values['adresse_complement']) ? $values['adresse_complement'] : '' ?>" />

                                 <input class="input_checkout" type="text" name="zip" placeholder="Code_postal*" value="<?= isset($values['zip']) ? $values['zip'] : '' ?>" />
                                 <span class="purple-text text-lighten-3" style="font-size:13px;"><?= isset($validation) ? $validation->getError("zip") : '' ?></span>

                                 <input class="input_checkout" type="text" name="city" placeholder="Ville*" value="<?= isset($values['city']) ? $values['city'] : '' ?>" />
                                 <span class="purple-text text-lighten-3" style="font-size:13px;"><?= isset($validation) ? $validation->getError("city") : '' ?></span>


                             </div>
                         </fieldset>
                     </div>
                     <div style="width:50%;">
                         <fieldset>
                             <div class="recommendation">
                                 <h3 style="font-size:16px;">Ajouter une recommendation pour le livreur</h3>
                                 <input class="input_checkout" type="text" name="msg_livreur" placeholder="Message adréssé au livreur" value="<?= isset($values['msg_livreur']) ? $values['msg_livreur'] : '' ?>" />
                             </div>
                         </fieldset>

                         <fieldset style=" margin-top:10px;">
                             <h3 style="font-size:16px;">Votre adresse de facturation</h3><br>
                             <label>
                                 <input class="with-gap" name="facturation" type="radio" checked />
                                 <span>Adresse client</span>
                             </label>
                             <label>
                                 <input class="with-gap " name="facturation" type="radio" />
                                 <span>Adresse renseignée</span>
                             </label>
                         </fieldset>
                     </div>
                 </div>
                 <br>
                 <span> <label>
                         <input type="checkbox" name="accept" />
                         <span>J'ai lu et j'accepte les conditions d'utilisation du site</span>
                         <p class="purple-text text-lighten-3" style="font-size:13px;"><?= isset($validation) ? $validation->getError("payment") : '' ?></p>

                     </label>
                 </span>

                 <button class="button_payment" type="submit" name="submit_payment" onclick="loader()">payer</button>
             </form>
         </div>
     </div>
 </div>

 <script>
     document.querySelector('.apparition_form').addEventListener('change', function() {
         document.querySelector('.form_adress').classList.add('checked');
     });

     function hide() {
         document.getElementById('masque_loader').style.display = "none";
         window.location.href = '<?= base_url('order_confirmation') ?>';
     }

     function loader() {
         document.getElementById('masque_loader').style.display = "block";

         setTimeout(hide, 5000);
     }
 </script>
 <?= $this->endSection() ?>