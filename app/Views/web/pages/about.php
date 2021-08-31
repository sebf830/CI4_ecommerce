 <?= $this->extend('web/layouts/main_layout') ?>

 <?= $this->section('body-contents') ?>

 <div class="wrapper_home" style="padding-bottom:50px">
     <div class="firstsection_about">
         <img src=" <?= base_url('assets/web/images/bg_chien.jpg') ?>" />
         <div class="text_first_section_about">
             <h3>About us </h3>
             <p>Venus-shop est un site de démonstration sans objectif commercial.
                 Notre animalerie en ligne propose des produits d'alimentation, de soins et de jeux ainsi que des conseils destinés au bien-être des chiens.
                 Nous serions heureux de lire vos commentaires ou vos suggestions.
                 Vous pouvez nous écrire via la rubrique 'Contact'.</p>
         </div>
     </div>
     <div class="second_section_about">
         <h5>DÉVELOPPÉ PAR </h5>
         <br>
         <div class="avatar_about">
             <img src="<?= base_url('public/uploads/sb.png') ?>">
         </div>
         <h5>Sébastien Flouvat</h5>
         <p>Développeur web PHP</P>
         <br>
         <span>
             <img src="<?= base_url('assets/web/images/laravel.png') ?>" height="50" width="50" />
         </span>
         <span>
             <img src="<?= base_url('assets/web/images/ci4.png') ?>" height="60" width="60" />
         </span>
     </div>

 </div>



 <?= $this->endSection() ?>