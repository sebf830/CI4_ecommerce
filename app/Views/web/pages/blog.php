 <?= $this->extend('web/layouts/main_layout') ?>

 <?= $this->section('body-contents') ?>

 <div class="wrapper_home" style="padding-bottom:50px">

     <div class="container_blog">
         <div id="flex_container_blog">

             <!-- Affichage de tous les articles -->
             <?php if (in_array('blog', $url)) : ?>
                 <?php foreach ($getArticles as $article) : ?>
                     <div class="card card_blog">
                         <div class="card-image">
                             <img src="<?= base_url('assets/web/images/' . $article['image_article1']) ?>">
                         </div>
                         <div class="card-content">
                             <span class="title_article_blog"><?= $article['title_article'] ?></span><br>
                             <span class="meta purple-text">Publié le <?= substr($article['created_at'], 0, 10) ?> | catégorie : <?= $article['title_category'] ?></span><br>
                             <span class="meta purple-text">Auteur : <?= $article['author_article'] ?></span><br>
                             <span><?= word_limiter($article['intro'], 12) ?></p>
                         </div>
                         <div class="card-action">
                             <a href="<?= base_url('article/' . $article['id_article']) ?>" class="purple waves-effect waves-light btn">Lire la suite</a>
                         </div>
                     </div>
                 <?php endforeach ?>

                 <!-- Affichage des articles pour une categorie -->
             <?php elseif (in_array('categorie_blog', $url)) : ?>
                 <!-- Si il y a articles pour la categorie -->
                 <?php if (count($articles_category) != 0) : ?>
                     <?php foreach ($articles_category as $article) : ?>
                         <div class="card card_blog">
                             <div class="card-image">
                                 <img src="<?= base_url('assets/web/images/' . $article['image_article1']) ?>">

                             </div>
                             <div class="card-content">
                                 <span class="title_article_blog"><?= $article['title_article'] ?></span><br>
                                 <span class="meta urple-text">Publié le <?= substr($article['created_at'], 0, 10) ?> | catégorie : <?= $article['title_category'] ?></span><br>
                                 <span class="meta purple-text">Auteur : <?= $article['author_article'] ?></span><br>
                                 <span><?= word_limiter($article['intro'], 12) ?></p>
                             </div>
                             <div class="card-action">
                                 <a href="<?= base_url('article/' . $article['id_article']) ?>" class="purple waves-effect waves-light btn">Lire la suite</a>
                             </div>
                         </div>

                     <?php endforeach ?>
                     <!-- sinon categorie vide -->
                 <?php else : ?>
                     <div class="result_blog">
                         <h5>Retrouvez prochainement nos articles <?= $idCat['title_category'] ?></h5>
                         <br>
                         Voir d'autres articles.
                         <br>
                         <!-- suggestion d'articles -->
                         <?php foreach ($default_result as $default_article) : ?>
                             <div style="display:flex">
                                 <div class="card card_blog_large">
                                     <div class="card-image">
                                         <img src="<?= base_url('assets/web/images/' . $default_article['image_article1']) ?>">
                                     </div>
                                     <div class="card-content">
                                         <span class="title_article_blog"><?= $default_article['title_article'] ?></span><br>

                                     </div>
                                     <div class="card-action">
                                         <a href="<?= base_url('article/' . $article['id_article']) ?>" class="purple waves-effect waves-light btn">Lire la suite</a>
                                     </div>
                                 </div>
                             </div>
                         <?php endforeach ?>
                     </div>
                 <?php endif ?>

             <?php elseif (in_array('article', $url)) : ?>
                 <div class="read_article">
                     <h4><?= $getArticle['title_article'] ?></h4><br>
                     <p>Publié le <?= substr($getArticle['created_at'], 0, 10) ?> par <?= $getArticle['author_article'] ?></p><br>
                     <div class="card-image">
                         <img src="<?= base_url('assets/web/images/' . $getArticle['image_article1']) ?>">
                     </div>
                     <div class="card-content">
                         <p><?= $getArticle['intro'] ?></p>
                         <br>
                         <?= $getArticle['text_article'] ?>
                     </div>
                     <div class="card-action">
                     </div>
                 </div>
                 <!-- affichage de la recherche -->
             <?php elseif (in_array('recherche_blog', $url)) : ?>
                 <div style="width:100%">
                     <h5>Votre recherche à retourné <?= count($search_result) ?> résultats</h5>
                 </div>
                 <?php foreach ($search_result as $result) : ?>
                     <div class="card card_blog">
                         <div class="card-image">
                             <img src="<?= base_url('assets/web/images/' . $result['image_article1']) ?>">
                         </div>
                         <div class="card-content">
                             <span class="title_article_blog"><?= $result['title_article'] ?></span><br>
                             <span class="meta purple-text">Publié le <?= substr($result['created_at'], 0, 10) ?> </span><br>
                             <span lass="meta purple-text">Auteur : <?= $result['author_article'] ?></span><br>
                             <span><?= word_limiter($result['intro'], 12) ?></p>
                         </div>
                         <div class="card-action">
                             <a href="<?= base_url('article/' . $result['id_article']) ?>" class="purple waves-effect waves-light btn">Lire la suite</a>
                         </div>
                     </div>
                 <?php endforeach ?>
             <?php endif ?>

         </div>

         <!-- navigation blog -->
         <div class="blog_navigation">
             <h5>THE VENUS BLOG</h5>
             <hr>
             <div class="search_blog">
                 <P>Chercher dans le blog</P>
                 <form action="<?= base_url('recherche_blog') ?>" method="post">
                     <input type="text" name="search_blog" id="search_blog_input" />
                     <button type="submit" id="search_blog_submit"><i class="fas fa-search"></i></button>
                 </form>
             </div>
             <h5>Derniers articles</h5>
             <hr>
             <!-- Affichage des 5 derniers articles -->
             <div class="last_articles">
                 <?php foreach ($lastFiveArticles as $last_articles) : ?>
                     <a href="<?= base_url('article/' . $last_articles['id_article']) ?>">
                         <div class="flex_last_articles">
                             <div class="img_last_art">
                                 <img src="<?= base_url('assets/web/images/' . $last_articles['image_article1']) ?>" width="40" height="40">
                             </div>
                             <div class="txt_last_art">
                                 <p><?= $last_articles['title_article'] ?></p>
                             </div>
                         </div>
                     </a>
                     <hr>
                 <?php endforeach ?>
             </div>
             <!-- les categories blog -->
             <h5>Catégories</h5>
             <div style="padding-bottom:20px">
                 <ul class="category_list_blog">
                     <?php foreach ($categories as $category) : ?>
                         <li><a href="<?= base_url('categorie_blog/' . $category['id_article_category']) ?>"><?= $category['title_category'] ?></a></li>
                     <?php endforeach ?>
                 </ul>
             </div>
             <hr>
             <br>
             <a href="<?= base_url('blog') ?>" class="purple waves-effect waves-light btn">Tous les articles</a>
         </div>
     </div>
 </div>
 <?= $this->endSection() ?>