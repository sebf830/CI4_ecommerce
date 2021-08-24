 <?= $this->extend('web/layouts/main_layout') ?>
 <?= $this->section('body-contents') ?>

 <div class="wrapper_home">
     <div class="section_category card_section_home">
         <?php foreach ($categories as $category) : ?>

             <div class="card_home" style="margin-top:10px;">
                 <div class="imgCardHome">
                     <a href="<?= base_url('categorie/' . $category['id']) ?>">
                         <img style="width:300px;height:250px" src="<?= base_url('public/uploads/' . $category['category_img']) ?>" alt="" />
                         <span class="purple-text"><?= $category['category_name'] ?></span>
                     </a>
                 </div>

             </div>
         <?php endforeach ?>
     </div>

 </div>


 <!-- loader  -->

 <?= $this->endSection() ?>