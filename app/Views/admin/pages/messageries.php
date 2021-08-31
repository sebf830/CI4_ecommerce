 <?= $this->extend('web/layouts/admin_layout') ?>

 <?= $this->section('body-contents') ?>


 <?= $this->include('admin/inc/sidebar') ?>

 <?php if ($_SERVER['PATH_INFO'] == '/admin/messages') : ?>
     <div class="card" style="margin:160px auto 0 auto;width:90%;">
         <div class="card-header">
             <h2>Liste des emails</h2>
             <a href="<?= base_url('admin/dashboard') ?>"><span class="fas fa-arrow-left"></span></a>
         </div>

         <div class="card-body">
             <div class="table-responsive">
                 <table width="100%">
                     <thead>
                         <tr>
                             <td>Nom</td>
                             <td>Email</td>
                             <td>Sujet</td>
                             <td>Apercu</td>
                             <td>Client?</td>
                             <td>Date</td>
                             <td>Lire</td>


                         </tr>
                     </thead>
                     <tbody>
                         <?php foreach ($all_email as $email) : ?>
                             <?php if ($email['consulte'] == 0) : ?>
                                 <tr style="font-size:16px;font-weight:bold;background-color:#ededed;">
                                 <?php else : ?>
                                 <tr style="font-size:14px;">
                                 <?php endif ?>
                                 <td><?= $email['sender_name'] ?></td>
                                 <td><?= $email['sender_email'] ?></td>
                                 <td><?= $email['object_email'] ?></td>
                                 <td><?= word_limiter($email['msg_email'], 8) ?></td>
                                 <?php if ($email['is_customer'] == 0) : ?>
                                     <td>non</td>
                                 <?php else : ?>
                                     <td>oui</td>
                                 <?php endif ?>

                                 <td><?= $email['created_at'] ?></td>
                                 <td><a href="<?= base_url('admin/email/' . $email['id_email']) ?>">Lire</a></td>
                                 </tr>

                             <?php endforeach ?>
                     </tbody>

                 </table>
             </div>
         </div>
     </div>
 <?php else : ?>

     <div class="card" style="margin:160px auto 0 auto;width:90%;">
         <div class="card-header">
             <h2><?= $read_email['object_email'] ?></h2>
             <a href="<?= base_url('admin/messages') ?>"><span class="fas fa-arrow-left"></span></a>
         </div>
         <div class="card-body" style="padding:15px;min-height:20em">
             <div style='display:flex;justify-content:space-between'>
                 <div>
                     <span style="font-weight:bold;"><?= $read_email['sender_name'] ?></span>
                     <span>
                         <span>
                             < </span><?= $read_email['sender_email']  ?>
                                 <span>
                                     > </span>
                         </span>
                 </div>
                 <div>
                     Recu le <?= $read_email['created_at'] ?>
                 </div>
             </div><br><br>
             <p><?= $read_email['msg_email'] ?></p>
         </div>
         <form action="" method="post" style="padding:25px;text-align:center;display:flex;">
             <textarea type="text" name="reply" style="border:1px solid #ededed; padding:15px;width:70%;border-radius:10px;margin:0 auto;height:60px;resize:none;outline:none;"></textarea>
             <button style="margin-right:100px;height:60px;background:none;" type="submit" name="submitReply">repondre</button>
         </form>
     </div>

 <?php endif ?>

 <?= $this->endSection() ?>