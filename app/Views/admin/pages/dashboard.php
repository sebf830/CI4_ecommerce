 <?= $this->extend('web/layouts/admin_layout') ?>

 <?= $this->section('body-contents') ?>


 <?= $this->include('admin/inc/sidebar') ?>

 <main>
     <div class="cards">
         <div class="card-single">
             <div>
                 <h1><?= isset($allCustomers) ? count($allCustomers) : '' ?></h1>
                 <span>Clients</span>
             </div>
             <div>
                 <span class="fas fa-users"></span>
             </div>
         </div>
         <div class="card-single">
             <div>
                 <h1><?= isset($allProducts) ? count($allProducts) : '' ?></h1>
                 <span>produits boutique</span>
             </div>
             <div>
                 <span class="fas fa-clipboard-list"></span>
             </div>
         </div>
         <div class="card-single">
             <div>
                 <h1><?= count($all_orders) ?></h1>
                 <span>commandes</span>
             </div>
             <div>
                 <span class="fas fa-shopping-cart"></span>
             </div>
         </div>
         <div class="card-single">
             <div>
                 <h1><?= number_format($total->order_total, 2)  ?>€</h1>
                 <span>Income</span>
             </div>
             <div>
                 <span class="fas fa-wallet"></span>
             </div>
         </div>

     </div>

     <div class="recent-grid">
         <div class="projects">
             <div class="card">
                 <div class="card-header">
                     <h2>10 dernières tâches admin</h2>
                     <button>Toutes les taches <span class="fas fa-arrow-right"></span> </button>
                 </div>

                 <div class="card-body">
                     <div class="table-responsive">
                         <table width="100%">
                             <thead>
                                 <tr>
                                     <td>Action</td>
                                     <td>Utilisateur</td>
                                     <td>Table</td>
                                     <td>Date</td>
                                 </tr>
                             </thead>
                             <tbody>
                                 <?php foreach ($last_history as  $last) : ?>
                                     <tr>
                                         <td><?= $last['title_history'] ?></td>
                                         <td><?= $last['user_name'] ?></td>
                                         <td><?= $last['table_history'] ?></td>
                                         <td><?= $last['created_at'] ?></td>
                                     </tr>
                                 <?php endforeach ?>
                             </tbody>
                         </table>
                     </div>
                 </div>

             </div>

             <div class="card">
                 <div class="card-header">
                     <h2>Liste des Admin</h2>
                     <button><span class="fas fa-arrow-right"></span> </button>
                 </div>

                 <div class="card-body">
                     <div class="table-responsive">
                         <table width="100%">
                             <thead>
                                 <tr>
                                     <td>Nom</td>
                                     <td>Role</td>
                                     <td>Status</td>

                                 </tr>
                             </thead>
                             <tbody>
                                 <?php foreach ($allAdmins as $admin) : ?>
                                     <tr>
                                         <td><?= $admin['user_name'] ?></td>
                                         <td><?= $admin['role_name'] ?></td>
                                         <td>
                                             <?php if (session()->get('user_name') == $admin['user_name']) : ?>
                                                 <span class="status green"></span>
                                                 connecté
                                             <?php else : ?>
                                                 <span class="status red"></span>
                                                 hors ligne
                                             <?php endif ?>
                                         </td>
                                     </tr>
                                 <?php endforeach ?>
                             </tbody>

                         </table>
                     </div>
                 </div>
             </div>
             <div class="cards" style="display:flex;width:100%;">
                 <div class="card-single" style="width:50%;height:240px;">
                     <div>
                         <span>Admins</span>
                     </div>
                     <div>
                         <span class="fas fa-users"></span>
                     </div>
                 </div>
                 <div class="card-single" style="width:50%;height:240px;">
                     <div>
                         <span>salut</span>
                     </div>
                     <div>
                         <span class="fas fa-users"></span>
                     </div>
                 </div>


             </div>


         </div>
         <div class="customers">
             <div class="card">
                 <div class="card-header">
                     <h2>Nouveaux clients</h2>
                     <button>Tous les clients <span class="fas fa-arrow-right"></span> </button>
                 </div>
                 <div class="card-body">
                     <?php foreach ($lastCustomers as $lastCustomer) : ?>
                         <div class="customer">
                             <div class="info">
                                 <img src="<?= base_url('assets/admin/img/avatar.png') ?>" height="40px" width="40px" alt="customer">
                                 <div>
                                     <h4><?= $lastCustomer['customer_name'] ?></h4>
                                     <small><?= $lastCustomer['customer_city'] ?></small>
                                 </div>
                             </div>
                             <div class="contact">
                                 <span class="far fa-envelope"></span>
                                 <span class="fas fa-comment"></span>
                                 <span class="fas fa-phone-alt"></span>
                             </div>
                         </div>
                     <?php endforeach ?>
                 </div>
             </div>

         </div>

     </div>

 </main>
 <?= $this->endSection() ?>