 <input type="checkbox" id="nav-toggle">
 <div class="sidebar background_sidebar">
     <div class="sidebar-brand">
         <a href="<?= base_url('/') ?>">
             <h1><span><img src="<?= base_url('assets/web/images/paw.png') ?>" width="40" height="40" /></span>
                 <span>Venus-Shop</span>
             </h1>
         </a>
     </div>
     <div style="height:130px;"></div>
     <div class="sidebar-menu">
         <ul>
             <li>
                 <a href="<?= base_url('profile') ?>">
                     <span class="fas fa-tachometer-alt <?= $_SERVER['PATH_INFO'] == '/profile' ? 'sidebar_active' : '' ?>"></span>
                     <span class="<?= $_SERVER['PATH_INFO'] == '/profile' ? 'sidebar_active' : '' ?>">Accueil</span>
                 </a>
             </li>
             <li>
                 <a href="<?= base_url('profile/informations') ?>">
                     <span class="fas fa-users <?= $_SERVER['PATH_INFO'] == '/profile/informations' ? 'sidebar_active' : '' ?>"></span>
                     <span class="<?= $_SERVER['PATH_INFO'] == '/profile/informations' ? 'sidebar_active' : '' ?>">Mes infos</span>
                 </a>
             </li>
             <li>
                 <a href="<?= base_url('profile/history') ?>">
                     <span class="fas fa-stream <?= $_SERVER['PATH_INFO'] == '/profile/history' ? 'sidebar_active' : '' ?>"></span>
                     <span class="<?= $_SERVER['PATH_INFO'] == '/profile/history' ? 'sidebar_active' : '' ?>">Mon historique</span>
                 </a>
             </li>
             <li>
                 <a href="<?= base_url('profile/wishlist') ?>">
                     <span class="fas fa-boxes <?= $_SERVER['PATH_INFO'] == '/profile/wishlist' ? 'sidebar_active' : '' ?>"></span>
                     <span class="<?= $_SERVER['PATH_INFO'] == '/profile/wishlist' ? 'sidebar_active' : '' ?>">Ma wishlist</span>
                 </a>
             </li>
             <li>
                 <a href="<?= base_url('profile/avantage') ?>">
                     <span class="fas fa-tasks <?= $_SERVER['PATH_INFO'] == '/profile/avantage' ? 'sidebar_active' : '' ?>"></span>
                     <span class="<?= $_SERVER['PATH_INFO'] == '/profile/avantage' ? 'sidebar_active' : '' ?>">Mes avantages</span>
                 </a>
             </li>
             <li>
                 <a href="<?= base_url('profile/messagerie') ?>">
                     <span class="fas fa-user-circle <?= $_SERVER['PATH_INFO'] == '/profile/messagerie' ? 'sidebar_active' : '' ?>"></span>
                     <span class="<?= $_SERVER['PATH_INFO'] == '/profile/messagerie' ? 'sidebar_active' : '' ?>">Messagerie</span>
                 </a>
             </li>
         </ul>

     </div>
 </div>

 <div class="main-content">
     <header>
         <h2>
             <label for="nav-toggle">
                 <span class="fas fa-bars"></span>
             </label>
             MON COMPTE
         </h2>

         <div class="search-wrapper">
             <span class="fas fa-search"> </span>
             <input type="text" class="inputSearch" placeholder="Rechercher un texte, produit, marque..." style="padding:2px 5px;border:1px solid lightgrey;height:30px;border-radius:20px;margin-top:9px;" />
         </div>

         <div class="user-wrapper">
             <img src="<?= base_url('assets/admin/img/avatar.png') ?>" width="50px" height="40px" alt="profile-img">
             <div class="">
                 <p><?= session()->get('user_name') ?></p>
                 <small><a href="<?= base_url('/logout') ?>">Déconnexion</a></small>

             </div>
         </div>

     </header>

     <style>
         .sidebar_active {
             color: purple;
         }
     </style>