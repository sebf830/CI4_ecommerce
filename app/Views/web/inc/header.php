<div class="wrapper-header">
    <!-- header-top first row-->
    <div class="header_top1">
        <div class="cart">
            <ul>
                <!-- connexion link -->

                <li class="user_link_header <?php if ($_SERVER['PATH_INFO'] == '/client/connexion') : ?>
                               <?php echo " active_link_header pulse"; ?>
                        <?php endif ?>">
                    <?php if (session()->get('customer_id')) : ?>
                        <a href="<?php echo base_url('logout'); ?>"><i class="fas fa-user"></i> <span class="logout_span">Déconnexion</span></a>
                    <?php else : ?>
                        <a href="<?php echo base_url('connexion'); ?>"><i class="fas fa-user"></i> <span class="login_span">Connexion</span></a>
                    <?php endif ?>
                </li>

                <!-- cart link --->
                <li class="<?php if ($_SERVER['PATH_INFO'] == '/panier') : ?>
                               <?php echo "active_link_header"; ?>
                        <?php endif ?>">
                    <a href="<?php echo base_url('panier'); ?>" title="View my shopping cart" rel="nofollow">
                        <span class="cart_title"><i class="fas fa-shopping-cart"></i> <span class="text_cart"> Panier(
                                <?php if (!empty(session('cart'))) : ?>
                                    <span class="no_product"><?= count(session('cart')) ?> </span>
                                <?php else :  ?>
                                    <span class="no_product">0</span>
                                    <?php endif ?>)
                            </span>
                        </span>
                    </a>
                </li>
            </ul>
        </div>
        <a href="#" data-target="slide-out" class="medium sidenav-trigger purple-text"><i class="material-icons">menu</i></a>
    </div>
    <!-- header-top second row-->
    <div class="header_top">
        <div class="logo">
            <a href="<?php echo base_url('/'); ?>"><img src="<?php echo base_url('assets/web/images/paw.png'); ?>" alt="" /></a>
            <span class="logo_title" style="font-weight:bold;">VENUS-SHOP</span>
        </div>
        <form class="form_search" method="post" action="<?= base_url('search') ?>">
            <input type="text" class="input_search" placeholder="Rechercher un produit" name="search" style="padding:2px 5px;border:1px solid lightgrey;height:30px;border-radius:20px;margin-top:10px;">
            <button type="submit" class="button_search"><i class="fas fa-search"></i></button>
        </form>
    </div>
    <div class="menu">
        <ul id="dc_mega-menu-orange" style="float:left" class="dc_mm-orange">
            <li class="  <?php if ($_SERVER['PATH_INFO'] == '/home') : ?>
                           <?= "active"; ?>
                        <?php endif ?>"><a href="<?= base_url('home'); ?>">Accueil</a></li>

            <li class="<?php if ($_SERVER['PATH_INFO'] == '/produits') : ?>
                           <?php echo "active"; ?>
                        <?php endif ?>"><a href="<?= base_url('produits'); ?>">produits</a></li>

            <li class="<?php if ($_SERVER['PATH_INFO'] == '/categories') : ?>
                               <?php echo " active "; ?>
                        <?php endif ?> dropdown show"><a href="<?= base_url('categories'); ?>">categories</a>
            </li>

            <li class="<?php if ($_SERVER['PATH_INFO'] == '/panier') : ?>
                               <?php echo "active"; ?>
                        <?php endif ?>"><a href="<?= base_url('panier'); ?>">Panier</a></li>

            <li class="<?php if ($_SERVER['PATH_INFO'] == '/contact') : ?>
                               <?php echo "active"; ?>
                        <?php endif ?>"><a href="<?= base_url('contact'); ?>">Contact</a></li>

            <li class="<?php if ($_SERVER['PATH_INFO'] == '/blog') : ?>
                               <?php echo "active"; ?>
                        <?php endif ?>"><a href="<?= base_url('blog'); ?>">Blog</a></li>
            <li class="<?php if ($_SERVER['PATH_INFO'] == '/about') : ?>
                               <?php echo "active"; ?>
                        <?php endif ?>"><a href="<?= base_url('about'); ?>">About us</a></li>


            <?php if (session()->get('customer_id')) : ?>
                <li class="<?php if ($_SERVER['PATH_INFO'] == '/profile') : ?>
                               <?= "active"; ?>
                        <?php endif ?>"><a href="<?= base_url('profile'); ?>"><i class="fas fa-user"></i></a>
                </li>
            <?php endif ?>
        </ul>
    </div>
    <ul id="slide-out" class="sidenav side_ul ">
        <li>
            <div class="user-view">
                <div class="background"></div>
                <a href="#user"><img src="<?= base_url('assets/web/images/paw.png'); ?>" alt="" width=' 60' height='60' /> VENUS SHOP</a>
            </div>
        </li>
        <li><a href="<?= base_url('home'); ?>">Accueil</a></li>
        <li><a href="<?= base_url('produits'); ?>">produits</a></li>
        <li><a href="<?= base_url('categories'); ?>">categories</a></li>
        <li><a href="<?= base_url('panier'); ?>">Panier</a></li>
        <li><a href="<?= base_url('contact'); ?>">Contact</a></li>
        <li><a href="<?= base_url('blog'); ?>">Blog</a></li>
        <li><a href="<?= base_url('about'); ?>">About us</a></li>

        <?php if (session()->get('customer_id')) : ?>
            <li class="<?php if ($_SERVER['PATH_INFO'] == '/profile') : ?>
                               <?= "active"; ?>
                        <?php endif ?>"><a href="<?= base_url('profile'); ?>">Mon compte</a>
            </li>
        <?php endif ?>

        <div class="divider"></div>
        <li>
            <?php if (session()->get('customer_id')) : ?>
                <a href="<?= base_url('logout'); ?>"><i class="fas fa-user"></i> Déconnexion</a>
            <?php else : ?>
                <a href="<?= base_url('connexion'); ?>"><i class="fas fa-user"></i> Connexion</a>
            <?php endif ?>
        </li>
    </ul>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var elem = document.querySelector('.sidenav');
        var instances = M.Sidenav.init(elem);

    });
</script>