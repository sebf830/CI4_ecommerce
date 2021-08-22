<?= $this->extend('web/layouts/main_layout') ?>

<?= $this->section('body-contents') ?>

<div class="wrapper-main" style="margin-top:2%;padding:60px 0;">
    <div class="content" style="text-align: center;display:flex;">
        <div class="register">
            <h5>Je crée mon compte</h5>
            <div id="result">
            </div>
            <form class="form_register" method="post" action="">
                <div class="left-col-register">
                    <div>
                        <input type="text" name="customer_name" placeholder="Entrer votre nom" value="<?= isset($values['customer_name']) ? $values['customer_name'] : '' ?>">
                        <span class="purple-text text-lighten-3" style="font-size:13px;"><?= isset($validation) ? $validation->getError("customer_name") : '' ?></span>
                    </div>

                    <div>
                        <input type="text" name="customer_password" placeholder="Enter un mot de passe" value="<?= isset($values['customer_password']) ? $values['customer_password'] : '' ?>">
                        <span class="purple-text text-lighten-3" style="font-size:13px;"><?= isset($validation) ? $validation->getError("customer_password") : '' ?></span>


                    </div>

                    <div>
                        <input type="text" name="customer_city" placeholder="Votre ville" value="<?= isset($values['customer_city']) ? $values['customer_city'] : '' ?>">
                        <span class="purple-text text-lighten-3" style="font-size:13px;"><?= isset($validation) ? $validation->getError("customer_city") : '' ?></span>

                    </div>
                    <div>
                        <input type="text" name="customer_phone" placeholder="Entrer votre numéro de téléphone" value="<?= isset($values['customer_phone']) ? $values['customer_phone'] : '' ?>">
                        <span class="purple-text text-lighten-3" style="font-size:13px;"><?= isset($validation) ? $validation->getError("customer_phone") : '' ?></span>

                    </div>
                </div>
                <div class="right-col-register">
                    <div>
                        <input type="text" name="customer_email" placeholder="Entrer votre Email" value="<?= isset($values['customer_email']) ? $values['customer_email'] : '' ?>">
                        <span class="purple-text text-lighten-3" style="font-size:13px;"><?= isset($validation) ? $validation->getError("customer_email") : '' ?></span>

                    </div>


                    <div>
                        <input type="text" name="customer_address" placeholder="Entrer votre adresse" value="<?= isset($values['customer_address']) ? $values['customer_address'] : '' ?>">
                        <span class="purple-text text-lighten-3" style="font-size:13px;"><?= isset($validation) ? $validation->getError("customer_address") : '' ?></span>

                    </div>

                    <div>
                        <input type="text" name="customer_zipcode" placeholder="Entrer votre code postal" value="<?= isset($values['customer_zipcode']) ? $values['customer_zipcode'] : '' ?>">
                        <span class="purple-text text-lighten-3" style="font-size:13px;"><?= isset($validation) ? $validation->getError("customer_zipcode") : '' ?></span>

                    </div>
                </div>
                <div class="div-button-register">
                    <div><button class="button_register ">Créer mon compte</button></div><br>
                    <p>Déja client? Rendez-vous dans <a href="<?= base_url('client/connexion') ?>">votre espace personnel</a></p>

                    <span class="terms">En cliquant sur 'Créer mon compte' Vous acceptez les <a href="#">Conditions d'utilisation su site</a>.</span>
                </div>

            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>