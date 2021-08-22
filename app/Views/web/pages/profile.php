<?= $this->extend('web/layouts/admin_layout') ?>
<?= $this->section('body-contents') ?>

<?= $this->include('web/inc/sidebar_customer') ?>

<main>
  <div class="cards">
    <div class="card-single">
      <div>
        <h1><?= count($orders) ?></h1>
        <span>Mes commandes</span>
      </div>
      <div>
        <span class="fas fa-gifts"></span>
      </div>
    </div>
    <div class="card-single">
      <div>
        <h1><?= count($wishlist) ?></h1>
        <span>Mes produits favoris</span>
      </div>
      <div>
        <span class="fas fa-heart"></span>
      </div>
    </div>
    <div class="card-single">
      <div>
        <h1><?= count($msg_unread) ?></h1>
        <span>Mes nouveaux messages</span>
      </div>
      <div>
        <span class="fas fa-envelope"></span>
      </div>
    </div>
    <div class="card-single">
      <div>
        <h1><?= $points['points'] != null ? $points['points'] : 0 ?></h1>
        <span>Mes points Venus</span>
      </div>
      <div>
        <span class="fas fa-trophy"></span>
      </div>
    </div>

  </div>

  <div class="recent-grid">
    <div class="projects">
      <div class="card">
        <div class="card-header">
          <h2>Mes dernières commandes</h2>
          <button>Toutes les commandes <span class="fas fa-arrow-right"></span> </button>
        </div>

        <div class="card-body">
          <div class="table-responsive" style="min-height:20vh">
            <table width="100%">
              <thead>
                <tr>
                  <td>Date</td>
                  <td>Montant</td>
                  <td>Coupon</td>
                  <td>Statut</td>
                </tr>
              </thead>
              <tbody>
                <?php if (count($lastOrders) > 0) : ?>
                  <?php foreach ($lastOrders as $lasOrder) :  ?>
                    <tr>
                      <td><?= substr($lasOrder['created_at'], 0, 10) ?></td>
                      <td><?= number_format($lasOrder['order_total'], 2) ?>€</td>
                      <td>non</td>
                      <td>envoyé</td>
                    </tr>
                  <?php endforeach ?>
                <?php else : ?>
                  <td>Aucune commande</td>
                <?php endif ?>
              </tbody>
            </table>
          </div>
        </div>

      </div>

      <div class="card">
        <div class="card-header">
          <h2>Avantages et bons de réduction</h2>
          <button>Voir tous les avantages <span class="fas fa-arrow-right"></span> </button>
        </div>

        <div class="card-body">
          <div class="table-responsive">
            <table width="100%">
              <thead>
                <tr>
                  <td>Code</td>
                  <td>Description coupon</td>
                  <td>Valable jusqu'au..</td>

                </tr>
              </thead>
              <tbody>
                <?php if (count($coupons) > 0) : ?>

                  <?php foreach ($coupons as $coupon) : ?>
                    <tr>
                      <td><?= $coupon['code'] ?></td>
                      <td><?= $coupon['description'] ?></td>
                      <td><?= $coupon['ending_date'] ?></td>
                    </tr>
                  <?php endforeach ?>
                <?php else : ?>
                  <td>Vous n'avez aucun coupon</td>
                <?php endif ?>
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
      <div class="row">
        <div class="card">
          <div class="card-header text-center">
            <span>Support</span>
          </div>
          <div class="card-body chat-care">


            <ul class="chat" id="body_chat">
              <?php if (count($allPosts) > 0) : ?>


                <?php foreach ($allPosts as $post) : ?>
                  <?php if ($post['id_user'] == session()->get('customer_id')) : ?>
                    <li class=" post admin clearfix">
                      <span class="chat-img right clearfix  mx-2">
                        <img src="http://placehold.it/50/FA6F57/fff&text=MOI" alt="Admin" class="img-circle" />
                      </span>

                      <div class="chat-body clearfix">
                        <div class="header clearfix">
                          <small class="left text-muted"><span class="glyphicon glyphicon-time"></span><?= $post['created_at'] ?></small>
                          <strong class="right primary-font"><?= session()->get('customer_name') ?></strong><br>
                        </div>
                        <p>
                          <?= $post['text_msg_user'] ?>
                        </p>
                      </div>
                    </li>
                  <?php else : ?>
                    <li class="post agent clearfix">
                      <span class="chat-img left clearfix mx-2">
                        <img src="http://placehold.it/50/55C1E7/fff&text=VS" alt="Agent" class="img-circle" />
                      </span>
                      <div class="chat-body clearfix">
                        <div class="header clearfix">
                          <strong class="primary-font">Support Venus Shop</strong> <small class="right text-muted">
                            <span class="glyphicon glyphicon-time"></span>14 mins ago</small>
                        </div>
                        <p>
                          <?= $post['text_msg_user'] ?>
                        </p>
                      </div>
                    </li>
                  <?php endif ?>
                <?php endforeach ?>
              <?php else : ?>
                <div style="padding:10px; font-size:14px">
                  <p>Ici s'affichent les messages que vous envoyez au support et les réponses reçues</p>
                  <p>A tout moment, n'hésitez pas à nous questionner ou nous faire part de vos idées</P>
                </div>
              <?php endif ?>
            </ul>
          </div>
          <div class="card-footer">
            <div class="input-group">
              <form action="#body_chat" method="post" class="form_chat">
                <span class="input-group-btn" style="display:flex;">
                  <input id="btn-input" type="text" class="form-control input-sm msg_chat" placeholder="Votre message ici" name="mesg_chat" />
                  <button type="submit" class="btn-floating pulse purple lighten-3" id="btn-chat"><i class="material-icons">send</i></button>
                </span>
              </form>
            </div>
          </div>
        </div>
      </div>


    </div>
  </div>

</main>



<?= $this->endSection() ?>