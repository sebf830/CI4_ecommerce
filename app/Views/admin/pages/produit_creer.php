 <?= $this->extend('web/layouts/admin_layout') ?>

 <?= $this->section('body-contents') ?>


 <?= $this->include('admin/inc/sidebar') ?>


 <div class="card" style="margin:160px auto 50px auto;width:90%;min-height:150vh">
     <div class="card-header">
         <h2>Nouveau produit</h2>
         <a href="<?= base_url('admin/produits') ?>"><span class="fas fa-home"></span></a>
     </div>
     <span class="small purple-text"><?= session()->getFlashdata('produit') ? session()->getFlashdata('produit') : '' ?></span>

     <div class="card-body" style="display:flex;flex-flow:row wrap; justify-content:space-between">
         <div style="width:40%; margin:0 auto; text-align:center">
             <br>
             <div style='min-width:200px; min-height:200px;border:1px solid #ededed'>
                 <img src='<?= session()->getFlashdata('image') ? base_url('public/uploads/' . session()->getFlashdata('image')) : "https://images6.alphacoders.com/683/thumb-350-683727.jpg" ?>' alt="img_product" width="400" height="400" />
                 <span class="purple-text"><?= isset($noImage) ? $noImage : '' ?></span>
             </div>
             <form action="" method="POST" enctype="multipart/form-data">
                 <h5 class="grey-text">Modifier photo :</h5>
                 <input class="validate" type="file" name="file" /><br><br>
                 <button type="submit" name="upload_image" value="upload_image" class="btn-small purple">Valider</button>
             </form>
         </div>

         <div style="width:50%; padding:50px;">
             <h5>infos</h5>
             <form action="" method="POST">
                 <span class="grey-text">Nom:</span>
                 <input type="text" name="title" value="<?= isset($values) ? $values['title'] : '' ?>">
                 <span class="purple-text text-lighten-3" style="font-size:13px;"><?= isset($validation) ? $validation->getError("title") : '' ?></span>


                 <br><br>
                 <span class="grey-text">Prix:</span>
                 <input type="text" name="price" value="<?= isset($values) ? $values['price'] : '' ?>">
                 <span class="purple-text text-lighten-3" style="font-size:13px;"><?= isset($validation) ? $validation->getError("price") : '' ?></span>


                 <br><br>

                 <span class="grey-text">Quantité en stock:</span>
                 <input type="number" name="stock" value="<?= isset($values) ? $values['stock'] : '' ?>">
                 <span class="purple-text text-lighten-3" style="font-size:13px;"><?= isset($validation) ? $validation->getError("stock") : '' ?></span>

                 <br><br>
                 <span class="grey-text">Catégorie</span><br>
                 <div class="input-field">
                     <select name="categorie" value="<?= isset($values) ? $values['categorie'] : '' ?>">
                         <option value="">Choisir une categorie</option>
                         <?php foreach ($categories as $categorie) : ?>
                             <option value="<?= $categorie['id'] ?>"><?= $categorie['category_name'] ?></option>
                         <?php endforeach ?>
                     </select>
                 </div>
                 <span class="purple-text text-lighten-3" style="font-size:13px;"><?= isset($validation) ? $validation->getError("categorie") : '' ?></span>

                 <br><br>
                 <span class="grey-text">Marque</span><br>
                 <div class="input-field">
                     <select name="marque" value="<?= isset($values) ? $values['marque'] : '' ?>">
                         <option value="">Choisir une marque</option>
                         <?php foreach ($all_brands as $brand) : ?>
                             <option value="<?= $brand['brand_id'] ?>"><?= $brand['brand_name'] ?></option>
                         <?php endforeach ?>
                     </select>
                 </div>
                 <span class="purple-text text-lighten-3" style="font-size:13px;"><?= isset($validation) ? $validation->getError("marque") : '' ?></span>


                 <br>
                 <div class="row">
                     <div class="col s12">
                         <div class="row">
                             <div class="input-field">
                                 <textarea id="textarea1" class="materialize-textarea" name='short_description' value="<?= isset($values) ? $values['short_description'] : '' ?>"></textarea>
                                 <label for="textarea1" style="background:none;">Résume</label>
                             </div>
                             <span class="purple-text text-lighten-3" style="font-size:13px;"><?= isset($validation) ? $validation->getError("short_description") : '' ?></span>

                         </div>
                     </div>
                 </div>

                 <div class="row">
                     <div class="col s12">
                         <div class="row">
                             <div class="input-field ">
                                 <textarea id="textarea1" class="materialize-textarea" name="long_description" value="<?= isset($values) ? $values['long_description'] : '' ?>"></textarea>
                                 <label for="textarea1" style="background:none;">Description</label>
                             </div>
                             <span class="purple-text text-lighten-3" style="font-size:13px;"><?= isset($validation) ? $validation->getError("long_description") : '' ?></span>

                         </div>
                     </div>
                 </div>
                 <button type="submit" name="creer_produit" value="creer_produit" class="btn-small purple">Enregistrer</button>
             </form>
         </div>
     </div>

     <script>
         document.addEventListener('DOMContentLoaded', function() {
             var elems = document.querySelectorAll('select');
             var instances = M.FormSelect.init(elems);
         });
     </script>
     <?= $this->endSection() ?>