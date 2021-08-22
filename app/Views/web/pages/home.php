  <?= $this->extend('web/layouts/main_layout') ?>

  <?= $this->section('body-contents') ?>

  <div class="wrapper_home">
      <div class="header_bottom">
          <!---- slider ----->
          <div class="container_slide">
              <div class="slider">
                  <ul class="slides">
                      <?php foreach ($sliders_products as $slider_product) : ?>
                          <li>
                              <img class="img_slider responsive-img" src="<?= base_url('public/uploads/' . $slider_product['slider_image']) ?>" alt="" />
                          </li>
                      <?php endforeach ?>
                  </ul>
              </div>
              <img class="ad" src="<?= base_url('public/uploads/slider8.png') ?>" />
          </div>
          <!--- fin slider --->
          <!----  produits à la une ---->
          <div class="group-popular">
              <?php foreach ($popular_prod as $popular) : ?>
                  <div class="popular" style="margin-right:4px;">
                      <div class="listimg listimg_2_of_1">
                          <a href="<?= base_url('produit/' . $popular['product_id']); ?>">
                              <img class="imgSlider" src="<?= base_url('public/uploads/' . $popular['product_image']) ?>" alt="" />
                          </a>
                      </div>
                      <div class="pop">
                          <h2 class='titre_popular'><?= word_limiter($popular['product_title'], 2) ?></h2>
                          <p class="text_popularp"><?= word_limiter($popular['short_description'], 6) ?></p><br>
                          <div class="button_popular "><span><a href="<?= base_url('/panier/ajouter/' . $popular['product_id']); ?>">Add to cart</a></span></div>
                      </div>
                  </div>
              <?php endforeach ?>
          </div>
      </div>
      <br>
      <script src="https://code.jquery.com/jquery-3.0.0.min.js" integrity="sha256-JmvOoLtYsmqlsWxa7mDSLMwa6dZ9rrIdtrrVYRnDRH0=" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script>
      <!--- fin produits a la une --->

      <!--- debut contenu principal ---->
      <div class="content">
          <div class="content_top">
              <div class="heading">
                  <h3 class="titre_section_home">LES PLUS CONSULTÉS</h3>
              </div>
          </div>
          <div class="card_section_home">
              <?php foreach ($featured as $feature) : ?>
                  <!--- card produits accueil ---->
                  <div class="card_home">
                      <div class="imgCardHome">
                          <a href="produit/<?= $feature['product_id'] ?>">
                              <img style="width:330px;height:290px" src="<?= base_url('public/uploads/' . $feature['product_image']) ?>" alt="" />
                          </a>
                      </div>
                      <div class="texteCardHome">
                          <h3><?= $feature['product_title'] ?></h3>
                          <p class="desc"><?= word_limiter($feature['short_description'], 10) ?></p>
                          <p class="price"><?= number_format($feature['product_price'], 2); ?>€</p>
                          <a class="buttonHomeCard" href="produit/<?= $feature['product_id'] ?>">détails</a>
                      </div>
                  </div>
                  <br>
                  <!---- fin de card home ----->
              <?php endforeach ?>
          </div>
          <br>
          <!--- section nouveaux produits --->
          <div class="content_bottom">
              <div class="heading">
                  <h3 class="titre_section_home">LES NOUVEATUTÉS</h3>
              </div>
          </div>
          <div class="card_section_home">
              <?php foreach ($news_products as $new) : ?>
                  <!--- card nouveautés---->
                  <div class="card_home">
                      <div class="imgCardHome">
                          <a href="produit/<?= $new['product_id'] ?>">
                              <img style="width:250px;height:250px" src="<?= base_url('public/uploads/' . $new['product_image']) ?>" alt="" />
                          </a>
                      </div>
                      <div class="texteCardHome">
                          <h3><?= $new['product_title'] ?></h3>
                          <p class="desc"><?= word_limiter($new['short_description'], 10) ?></p>
                          <p class="price"><?= number_format($new['product_price'], 2); ?>€</p>
                          <a class="buttonHomeCard" href="produit/<?= $new['product_id'] ?>">détails</a>
                      </div>
                  </div>
                  <!---- fin de card nouveautés ----->
              <?php endforeach ?>
          </div>
      </div>
  </div>

  <!--- fin des sections --->


  <script>
      $(function() {
          $('.slider').slider({
              // full_width: true,
              // height: 400,
              interval: 3000,
              transition: 400
          });

      });
  </script>

  <!--- fin de contenu ---->
  <?= $this->endSection() ?>