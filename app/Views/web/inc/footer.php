  </div>
  <?php if (!isset($_COOKIE['Venus-Shop'])) : ?>
      <div class="masque_cookie" style="position:fixed; background:rgba(0, 0, 0, 0.8);top:0;bottom:0;left:0;right:0;z-index:8000;display:none">
          <div id="accept_cookie" class="accept_cookie" style="display:none">
              <span class="text_cookie">
                  Les cookies assurent le bon fonctionnement de la boutique et de nos services.<br>
                  En poursuivant votre navigation sur ce site, vous acceptez l'utilisation de cookies </span>
              <span class="accept_button btn-small " id="accept">Accepter <i class=" paw_cookie fas fa-paw"></i></span>
              <span class="decline_button btn-small " id="decline">Refuser</span>

          </div>
      </div>
  <?php endif ?>

  <div class="footer">
      <div class="wrapper">
          <div class="section group section-footer">
              <div class="col_1_of_4 span_1_of_4">
                  <h4>Information</h4>
                  <ul>
                      <li><a href="#">About Us</a></li>
                      <li><a href="#">Customer Service</a></li>
                      <li><a href="#"><span>Advanced Search</span></a></li>
                      <li><a href="#">Orders and Returns</a></li>
                      <li><a href="#"><span>Contact Us</span></a></li>
                  </ul>
              </div>
              <div class="col_1_of_4 span_1_of_4">
                  <h4>Why buy from us</h4>
                  <ul>
                      <li><a href="about.html">About Us</a></li>
                      <li><a href="faq.html">Customer Service</a></li>
                      <li><a href="#">Privacy Policy</a></li>
                      <li><a href="contact.html"><span>Site Map</span></a></li>
                      <li><a href="preview.html"><span>Search Terms</span></a></li>
                  </ul>
              </div>
              <div class="col_1_of_4 span_1_of_4">
                  <h4>My account</h4>
                  <ul>
                      <li><a href="contact.html">Sign In</a></li>
                      <li><a href="index.html">View Cart</a></li>
                      <li><a href="#">My Wishlist</a></li>
                      <li><a href="#">Track My Order</a></li>
                      <li><a href="faq.html">Help</a></li>
                  </ul>
              </div>
              <div class="col_1_of_4 span_1_of_4">

                  <h4>Follow Us</h4>
                  <div class="social-icons">
                      <ul class="itemsFooter">
                          <li class="facebook"><a href="https://www.facebook.com/" target="_blank"> </a></li>
                          <li class="twitter"><a href="https://twitter.com/?lang=fr" target="_blank"> </a></li>
                          <li class="contact"><a href="<?= base_url('contact') ?>" target="_blank"> </a></li>
                      </ul>
                  </div>
              </div>
          </div>
          <div class="copy_right">
              <p><b>&copy;sebastien Flouvat 2021 - Venus-Shop</b></p>
          </div>
      </div>
  </div>

  <script>
      $(function() {

          <?php if (!isset($_COOKIE['Venus-Shop'])) : ?>
              setTimeout(function() {
                  $('.masque_cookie').fadeIn('slow')
                  $('.accept_cookie').fadeIn('slow')
              }, 3000);
          <?php endif ?>

          $(document).on('click', '#accept', function() {
              $.ajax({
                  url: '<?= base_url('accept_cookie') ?>',
                  type: 'POST',
                  data: {
                      accept: true
                  },
                  datatype: 'JSON',
                  success: function(response) {
                      //   window.history.go(0)
                      $('#accept_cookie').fadeOut('slow')
                      $('.masque_cookie').fadeOut('slow')

                  }
              });
          });
          $(document).on('click', '#decline', function() {
              $.ajax({
                  url: '<?= base_url('accept_cookie') ?>',
                  type: 'POST',
                  data: {
                      accept: false
                  },
                  datatype: 'JSON',
                  success: function(response) {
                      //   window.history.go(0)
                      $('#accept_cookie').fadeOut('slow')
                      $('.masque_cookie').fadeOut('slow')

                  }
              });
          });
      });
  </script>

  </body>

  </html>