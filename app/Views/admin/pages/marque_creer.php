 <?= $this->extend('web/layouts/admin_layout') ?>

 <?= $this->section('body-contents') ?>


 <?= $this->include('admin/inc/sidebar') ?>


 <div class="card" style="margin:160px auto 50px auto;width:90%;min-height:50vh">
     <div class="card-header">
         <h2>CRÉER UNE NOUVELLE MARQUE</h2>
         <a href="<?= base_url('admin/categories') ?>"><span class="fas fa-home"></span></a>
     </div>
     <p style='text-align:center' class="purple-text"><?= session()->getFlashdata('msg_success') ?></p>

     <div class="card-body" style="display:flex;flex-flow:row wrap; justify-content:space-between">
         <div style="width:40%; margin:0 auto; text-align:center">
             <br>
             <div style='min-width:200px; min-height:200px;border:1px solid #ededed'>
                 <img src='<?= session()->getFlashdata('image') ? base_url('public/uploads/' . session()->getFlashdata('image')) : "https://images6.alphacoders.com/683/thumb-350-683727.jpg" ?>' alt="img_product" width="400" height="400" />
                 <span class="purple-text"><?= isset($noImage) ? $noImage : '' ?></span>
             </div>
             <form action="" method="POST" enctype="multipart/form-data">
                 <h5 class="grey-text">Image catégorie :</h5>
                 <input class="validate" type="file" name="file" /><br><br>
                 <button type="submit" name="upload_image" value="upload_image" class="btn-small purple">Valider</button>
             </form>
             <br>
         </div>
         <div style="width:50%; padding:50px;">
             <form action="" method="POST">
                 <span class="grey-text">Titre:</span>
                 <input type="text" name="title" value="">
                 <span class="purple-text text-lighten-3" style="font-size:13px;"><?= isset($validation) ? $validation->getError("title") : '' ?></span>
                 <br><br>
                 <div class="row">
                     <div class="col s12">
                         <div class="row">
                             <div class="input-field ">
                                 <textarea id="textarea1" class="materialize-textarea" name="description"></textarea>
                                 <label for="textarea1" style="background:none;">Description</label>
                             </div>
                             <span class="purple-text text-lighten-3" style="font-size:13px;"><?= isset($validation) ? $validation->getError("description") : '' ?></span>

                         </div>
                     </div>
                 </div>
                 <button type="submit" name="marque_creer" value="marque_creer" class="btn-small purple">Enregistrer La marque</button>
             </form>
         </div>
     </div>
 </div>


 <?= $this->endSection() ?>