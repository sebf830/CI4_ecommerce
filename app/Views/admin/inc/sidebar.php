 <input type="checkbox" id="nav-toggle">
 <div class="sidebar">
     <div class="sidebar-brand">
         <h1><span><img src="<?= base_url('assets/web/images/paw.png') ?>" width="40" height="40" /></span>
             <span>Venus-Shop</span>
         </h1>
     </div>
     <div style="height:130px;"></div>
     <div class="sidebar-menu">
         <ul>
             <li>
                 <a href="<?= base_url('admin/dashboard') ?>">
                     <span class="fas fa-tachometer-alt"></span>
                     <span>Dashboard</span>
                 </a>
             </li>
             <li>
                 <a href="<?= base_url('admin/clients') ?>">
                     <span class="fas fa-users"></span>
                     <span>Clients</span>
                 </a>
             </li>
             <li>
                 <a href="<?= base_url('admin/produits') ?>">
                     <span class="fas fa-stream"></span>
                     <span>Produits</span>
                 </a>
             </li>
             <li>
                 <a href="<?= base_url('admin/categories') ?>">
                     <span class="fas fa-boxes"></span>
                     <span>Categories</span>
                 </a>
             </li>
             <li>
                 <a href="<?= base_url('admin/marques') ?>">
                     <span class="fas fa-tasks"></span>
                     <span>Marques</span>
                 </a>
             </li>
             <li>
                 <a href="<?= base_url('admin/commandes') ?>">
                     <span class="fas fa-shopping-cart"></span>
                     <span>Commandes</span>
                 </a>
             </li>
             <li>
                 <a href="<?= base_url('admin/articles') ?>">
                     <span class="fas fa-pen"></span>
                     <span>Blog</span>
                 </a>
             </li>
             <li>
                 <a href="<?= base_url('admin/messages') ?>">
                     <span class="fas fa-user-circle"></span>
                     <span>Messageries</span>
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
             Dashboard
         </h2>

         <div class="search-wrapper">
             <span class="fas fa-search"> </span>
             <input type="text" class="inputSearch" placeholder="Rechercher un texte, produit, marque..." style="padding:2px 5px;border:1px solid lightgrey;height:30px;border-radius:20px;margin-top:9px;" />
         </div>

         <div class="user-wrapper">
             <img src="<?= base_url('assets/admin/img/avatar.png') ?>" width="40px" height="40px" alt="profile-img">
             <div class="">
                 <p><?= session()->get('user_name') ?></p>
                 <small><a href="<?= base_url('/admin/deconnexion') ?>">Déconnexion</a></small>

             </div>
         </div>

     </header>