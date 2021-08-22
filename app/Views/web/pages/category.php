 <?= $this->extend('web/layouts/main_layout') ?>

 <?= $this->section('body-contents') ?>
 <div class="wrapper_category">
     <div class="heading-category">
         <h3 class="titre_section_home"><?= $category['category_name'] ?></h3>
     </div>


     <div class="section_category card_section_home">
         <?php foreach ($allCategories as $single_products) : ?>

             <div class="card_home">
                 <div class="imgCardHome">
                     <a href="<?= base_url('produit/' . $single_products['product_id']) ?>">
                         <img style="width:250px;height:250px" src="<?= base_url('public/uploads/' . $single_products['product_image']) ?>" alt="" />
                     </a>
                 </div>
                 <div class="texteCardHome">
                     <h3><?= $single_products['product_title'] ?></h3>
                     <p class="desc"><?= word_limiter($single_products['short_description'], 10) ?></p>
                     <p class="price"><?= format_number($single_products['product_price']); ?>€</p>
                     <a class="buttonHomeCard" href="<?= base_url('produit/' . $single_products['product_id']) ?>">détails</a>
                 </div>
             </div>
         <?php endforeach ?>
     </div>
 </div>

 <!--- fin de contenu ---->
 <?= $this->endSection() ?>