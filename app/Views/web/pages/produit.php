<?= $this->extend('web/layouts/main_layout') ?>

<?= $this->section('body-contents') ?>

<div class="card-wrapper">
    <div class="card">
        <!-- card left -->
        <div class=" product-imgs">
            <div class="img-display">
                <div class="img-showcase">
                    <img class="imgCardSingle" src="<?= base_url('public/uploads/' . $single['product_image']) ?>" alt="product1">
                    <img class="imgCardSingle" src="<?= base_url('public/uploads/' . $single['product_image2']) ?>" alt="product2">
                    <img class="imgCardSingle" src="<?= base_url('public/uploads/' . $single['product_image3']) ?>" alt="product3">
                    <img class="imgCardSingle" src="<?= base_url('public/uploads/' . $single['product_image4']) ?>" alt="product4">
                </div>
            </div>
            <div class="img-select">
                <div class="img-item">
                    <a href="#" data-id="1">
                        <img class="imgCardSingle " src="<?= base_url('public/uploads/' . $single['product_image']) ?>" alt="product1">
                    </a>
                </div>
                <div class="img-item">
                    <a href="#" data-id="2">
                        <img class="imgCardSingle " src="<?= base_url('public/uploads/' . $single['product_image2']) ?>" alt="product2">
                    </a>
                </div>
                <div class="img-item">
                    <a href="#" data-id="3">
                        <img class="imgCardSingle " src="<?= base_url('public/uploads/' . $single['product_image3']) ?>" alt="product3">
                    </a>
                </div>
                <div class="img-item">
                    <a href="#" data-id="4">
                        <img class="imgCardSingle " src="<?= base_url('public/uploads/' . $single['product_image4']) ?>" alt="product4">
                    </a>
                </div>
            </div>
            <div class="category_right_card">
                <h5>VERS LA CATÉGORIE</h5>
                <ul>
                    <?php foreach ($categories  as $category) :  ?>
                        <li>
                            <a href="<?= base_url('categorie/' . $category['id']) ?>"> <?= $category['category_name'] ?></a>
                        </li>
                    <?php endforeach ?>
                </ul>

            </div>
        </div>
        <!-- card right -->
        <div class="product-content">
            <h2 class="product-title"><?= $single['product_title'] ?></h2>

            <?php if ($single['product_quantity'] == 0) : ?>
                <p class="product-link">Produit épuisé !</p>
            <?php elseif ($single['product_quantity'] > 0 && $single['product_quantity'] < 10) : ?>
                <p class="product-link">Produit bientot épuisé !</p>
            <?php else : ?>
            <?php endif ?>


            <div class="product-rating">
                <?php for ($i = 0; $i < number_format($avg['rank'], 0); $i++) : ?>
                    <?= '<i class="fa fa-bone fa-fw" style="color:orange;transform:rotate(135deg);"></i>' ?>
                <?php endfor ?>
                <?php $black = 5 - number_format($avg['rank'], 0) ?>
                <?php for ($i = 0; $i < $black; $i++) : ?>
                    <?= '<i class="fa fa-bone fa-fw" style="transform:rotate(135deg);"></i>' ?>
                <?php endfor ?>
                <span>(<?= $avg['id_ranking'] ?> avis)</span>
            </div>


            <div class="product-price">
                <?php if ($single['product_quantity'] == 0) : ?>
                    <p class="new-price">Price : <span>-</span></p>

                <?php else : ?>
                    <p class="new-price">Prix : <span style="font-size:21px;"><?= number_format($single['product_price'], 2) ?>€</span></p>
                <?php endif ?>
            </div>

            <?php if (session()->get('customer_id')) : ?>
                <?php if (in_array($single['product_id'], $like)) : ?>
                    <button type="button" id="paw" class="liked" style='border:none;background:none;'>
                        <i class="pink-text text-lighten-2 material-icons" style="font-size:35px;">pets</i>
                        <input type='hidden' id="id_prod" value="<?= $single['product_id'] ?>" />
                    </button>
                <?php else : ?>
                    <button type="button" id="paw" style='border:none;background:none;'>
                        <i class="Medium grey-text text-lighten-2 material-icons" style="font-size:35px;">pets</i>
                        <input type='hidden' id="id_prod" value="<?= $single['product_id'] ?>" />
                    </button>
                <?php endif ?>
            <?php endif ?>

            <span id="message" class="purple-text text-lighten-4"></span>

            <div class="product-detail">
                <h2>Description : </h2>
                <p><?= $single['long_description'] ?></p>
                <ul>
                    <li>Marque: <span><?= $single['brand_name'] ?></span></li>
                    <li>Quantité en stock : <span><?= $single['product_quantity'] ?></span></li>
                    <li>Category: <span><?= $single['category_name'] ?></span></li>
                    <li>Livraison: <span>Europe</span></li>
                    <li>Frais de port: <span>Gratuit</span></li>
                </ul>
            </div>

            <?php if ($single['product_quantity'] == 0) : ?>
                <div class="purchase-info">
                    <button type="button" class="btn-disabled">
                        Ajouter au panier<i class="fas fa-shopping-cart"></i>
                    </button>
                </div>
            <?php else : ?>
                <div class="purchase-info">
                    <a href="<?= base_url('panier/ajouter/' . $single['product_id']) ?>" class="btn">
                        Ajouter au panier <i class="fas fa-shopping-cart"></i>
                    </a>

                <?php endif ?>
                </div>

                <div class="social-links">
                    <a href="#">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                    <a href="#">
                        <i class="fab fa-pinterest"></i>
                    </a>
                </div>
        </div>
    </div>
    <br>
    <h5 class="grey-text" style="padding:10px;">Les clients Vénus-Shop ont également apprécié</h5>
</div>



<!-- debut slider product -->
<div class="container_slider_h" id="/slide">
    <ul class='list_item_h'>
        <?php foreach ($all_products as $slider_product) : ?>
            <li class="item_slider_h">
                <div class="popular card_slider_h" style="width:100%;border:none;">
                    <div class="listimg img_h">
                        <a href="<?= base_url('produit/' . $slider_product['product_id']); ?>">
                            <img class="imgSlider" src="<?= base_url('public/uploads/' . $slider_product['product_image']) ?>" alt="" />
                        </a>
                    </div>
                    <div>
                        <a href="<?= base_url('produit/' . $slider_product['product_id']); ?>">
                            <h2 class='titre_popular titre_item_h'><?= $slider_product['product_title'] ?></h2>
                            <p class="grey-text price_item_h" style="text-align:center"><?= number_format($slider_product['product_price'], 2) ?>€</p>
                        </a>
                    </div>
                </div>
            </li>
        <?php endforeach ?>

    </ul>
    <span id="prev"><i class="fas fa-angle-left fa-2x"></i></span>
    <span id="next"><i class="fas fa-angle-right fa-2x"></i></span>
</div>

<div style="width:80%;margin:0 auto;background:white;padding: 50px 1%;border-top:1px solid #ededed">
    <h5>Avis client : <?= $single['product_title'] ?></h5>
    <div class="flex_ranking" style="display:flex;flex-flow: row wrap;justify-content:space-between">

        <div class="stats_ranking" style="width:28%;padding: 0 15px;">
            <div style="display:flex;flex-direction:column;text-align:center;justify-content:center;">
                <h1 style="color:orange;"><?= number_format($avg['rank'], 1) ?> </h1>
                <span id="bones_avg" style="font-size:22px"></span><br>
                <?php if ($avg['id_ranking'] > 1) : ?>
                    <span>(<?= $avg['id_ranking'] ?> avis publiés)</span>
                <?php else : ?>
                    <span>(<?= $avg['id_ranking'] ?> avis publié)</span>
                <?php endif ?>
                <br><br>
                <?php if (count($hasRank) == 0) : ?>
                    <a href="<?= base_url('/produit/avis/' . $single['product_id']) ?>" class="button_rank btn-small purple">Laisser un avis</a>
                <?php else :  ?>
                    <button type="button" class="button_rank btn-small purple" style="opacity:0.4">Laisser un avis</button>
                <?php endif ?>
                <br><br>
                <div style="display:flex;flex-direction:row;align-items:flex-end;">
                    <div class="bar-rating">
                        <div class="bar-rating__active" style="width:<?= number_format($five_ranking_percent, 2)  ?>%"></div>
                    </div>
                    <div>5 <span><i class="fas fa-bone" style="color:orange;transform:rotate(135deg);"></i></span></div>
                </div>

                <div style="display:flex;flex-direction:row;align-items:flex-end;">
                    <div class="bar-rating">
                        <div class="bar-rating__active" style="width:<?= $four_ranking_percent  ?>%"></div>
                    </div>
                    <div>4 <span><i class="fas fa-bone" style="color:orange;transform:rotate(135deg);"></i></span></div>
                </div>
                <div style="display:flex;flex-direction:row;align-items:flex-end;">
                    <div class="bar-rating">
                        <div class="bar-rating__active" style="width:<?= $three_ranking_percent  ?>%"></div>
                    </div>
                    <div>3 <span><i class="fas fa-bone" style="color:orange;transform:rotate(135deg);"></i></span></div>
                </div>
                <div style="display:flex;flex-direction:row;align-items:flex-end;">
                    <div class="bar-rating">
                        <div class="bar-rating__active" style="width:<?= $two_ranking_percent  ?>%"></div>
                    </div>
                    <div>2 <span><i class="fas fa-bone" style="color:orange;transform:rotate(135deg);"></i></span></div>
                </div>
                <div style="display:flex;flex-direction:row;align-items:flex-end;">
                    <div class="bar-rating">
                        <div class="bar-rating__active" style="width:<?= $one_ranking_percent ?>%"></div>
                    </div>
                    <div>1 <span><i class="fas fa-bone" style="color:orange;transform:rotate(135deg);"></i></span></div>
                </div>

            </div>

        </div>
        <div class="comments_ranking" style="width:68%; ">
            <?php foreach ($comments as $comment) : ?>
                <div class="card_comment" style="border-bottom:1px solid #ededed;padding:30px 0">
                    <h5><?= $comment['title_comment'] ?></h5>
                    <span>
                        <?php for ($i = 0; $i < $comment['rank']; $i++) : ?>
                            <?= '<i class="fa fa-bone fa-fw" style="color:orange;transform:rotate(135deg);"></i>' ?>
                        <?php endfor ?>
                        <?php $black = 5 - $comment['rank'] ?>
                        <?php for ($i = 0; $i < $black; $i++) : ?>
                            <?= '<i class="fa fa-bone fa-fw" style="transform:rotate(135deg);"></i>' ?>
                        <?php endfor ?>

                    </span>
                    <span> Avis vérifié</span><br>
                    <p style="font-size:14px"><?= $comment['customer_comment'] ?></p>
                    <br>
                    <span style="font-size:11px">client <?= word_limiter($comment['customer_name'], 2) ?> - Avis du <?= substr($comment['created_at'], 0, 10) ?> &nbsp;<a href="#"> Signaler un abus</a></span>
                </div>
            <?php endforeach ?>

        </div>
    </div>

    <!-- /container -->
    <script>
        var orange = <?= number_format($avg['rank'], 0) ?>;
        var black = 5 - orange;
        for (var i = 0; i < orange; i++) {
            $('#bones_avg').append('<i class="fa fa-bone fa-fw" style="color:orange;transform:rotate(135deg);"></i>')
        }
        for (var i = 0; i < black; i++) {
            $('#bones_avg').append('<i class="fa fa-bone fa-fw" style="transform:rotate(135deg);"></i>')
        }
    </script>
    <script>
        $(function() {

            $(document).on('click', '#paw', function() {
                if ($("#paw").hasClass("liked")) {
                    $("#paw").html('<i class="Medium grey-text text-lighten-2 material-icons" style="font-size:35px;">pets</i>');
                    $("#paw").removeClass("liked");
                    $("#message").fadeIn().text('Produit retiré de la liste d\'envie');
                } else {
                    $("#paw").html('<i class="Medium pink-text  text-lighten-1 material-icons" style="font-size:35px;">pets</i>');
                    $("#paw").addClass("liked");
                    $("#message").fadeIn().text('Produit ajouté à la liste d\'envie');

                }
                $.ajax({
                    url: '<?= base_url('ajax_wishlist') ?>',
                    type: 'POST',
                    data: {
                        id_produit: <?= $single['product_id'] ?>
                    },
                    datatype: 'JSON',
                    success: function(response) {
                        console.log(response)
                    }
                });
            });
        });
    </script>

    <script>
        const imgs = document.querySelectorAll('.img-select a');
        const imgBtns = [...imgs];
        let imgId = 1;

        imgBtns.forEach((imgItem) => {
            imgItem.addEventListener('click', (event) => {
                event.preventDefault();
                imgId = imgItem.dataset.id;
                slideImage();
            });
        });

        function slideImage() {
            const displayWidth = document.querySelector('.img-showcase img:first-child').clientWidth;

            document.querySelector('.img-showcase').style.transform = `translateX(${- (imgId - 1) * displayWidth}px)`;
        }
        window.addEventListener('resize', slideImage);
    </script>

    <script>
        function responsiveSlider() {
            const slider = document.querySelector('.container_slider_h');
            let sliderWidth = slider.offsetWidth / 3;
            const sliderList = document.querySelector('.list_item_h');
            let items = sliderList.querySelectorAll('.item_slider_h').length - 2;
            let count = 1;

            window.addEventListener('resize', function() {
                sliderWidth = slider.offsetWidth;
            });

            function prevSlide() {
                if (count > 1) {
                    count = count - 2;
                    sliderList.style.left = '-' + count * sliderWidth + 'px';
                    count++;
                } else if (count == 1) {
                    count = items - 1;
                    sliderList.style.left = '-' + count * sliderWidth + 'px';
                    count++;
                }

            }

            function nextSlide() {
                if (count < items) {
                    sliderList.style.left = '-' + count * sliderWidth + 'px';
                    count++;

                } else if (count == items) {
                    sliderList.style.left = '0px';
                    count = 1;

                }
            }
            prev.addEventListener('click', prevSlide);
            next.addEventListener('click', nextSlide);
            // setInterval(function() {
            //     nextSlide();
            // }, 3000);
        }

        window.addEventListener('load', function() {
            responsiveSlider();
        });
    </script>


    <?= $this->endSection() ?>