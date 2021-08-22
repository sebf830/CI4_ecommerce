 <?= $this->extend('web/layouts/admin_layout') ?>

 <?= $this->section('body-contents') ?>

 <div class="wrapper-admin-login">
     <a class="lien-logo-home" href="<?= base_url('/') ?>"><span class="fas fa-home"></span></a>
     <div class="login-box">
         <h1>Admin Panel</h1>

         <form id="adminlogincheck" action="" method="post" style="padding:20px;">

             <div class="input-prepend" title="User Email">
                 <span class="add-on"><i class="halflings-icon user"></i></span>

                 <input class="input-large" name="user_email" id="user_email" type="text" placeholder="Email" value="<?= isset($values) ? $values['user_email'] : '' ?>" /><br>

                 <span class="purple-text text-lighten-3" style="font-size:13px;"><?= isset($validation) ? $validation->getError("user_email") : '' ?></span>

             </div>
             <div class="clearfix"></div>

             <div class="input-prepend" title="User Password">
                 <span class="add-on"><i class="halflings-icon lock"></i></span>
                 <input class="input-large" name="user_password" id="user_password" type="password" placeholder="Password" value="<?= isset($values) ? $values['user_password'] : '' ?>" /><br>
                 <span class="purple-text text-lighten-3" style="font-size:13px;"><?= isset($validation) ? $validation->getError("user_password") : '' ?></span>

             </div>


             <div class="button-login">
                 <button type="submit" class="btn btn-primary adminlogincheck">Admin Login</button>
             </div>
         </form>
     </div>
 </div>
 <?= $this->endSection() ?>