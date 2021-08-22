<?= $this->extend('web/layouts/admin_layout') ?>
<?= $this->section('body-contents') ?>


<?= $this->include('web/inc/sidebar_customer') ?>

<main>
    <div class="cards_container">
        <div class="card-left">
            <div class="register">
                <h5>Modifier mes informations personnelles</h5>
                <div id="result">
                    <span class=" purple-text text-lighten-3"><?= isset($confirm) ? $confirm : '' ?></span>
                </div>
                <form method="post" action="">
                    <br>
                    <div>
                        <input type="text" name="customer_city" placeholder="Votre ville" value="<?= isset($data_customer['customer_city']) ? $data_customer['customer_city'] : '' ?>">
                        <span class="purple-text text-lighten-3" style="font-size:13px;"><?= isset($validation) ? $validation->getError("customer_city") : '' ?></span>
                    </div>
                    <div>
                        <input type="text" name="customer_phone" placeholder="Entrer votre numéro de téléphone" value="<?= isset($data_customer['customer_phone']) ? $data_customer['customer_phone'] : '' ?>">
                        <span class="purple-text text-lighten-3" style="font-size:13px;"><?= isset($validation) ? $validation->getError("customer_phone") : '' ?></span>

                    </div>
                    <div>
                        <input type="text" name="customer_email" placeholder="Entrer votre Email" value="<?= isset($data_customer['customer_email']) ? $data_customer['customer_email'] : '' ?>">
                        <span class="purple-text text-lighten-3" style="font-size:13px;"><?= isset($validation) ? $validation->getError("customer_email") : '' ?></span>

                    </div>
                    <div>
                        <input type="text" name="customer_address" placeholder="Entrer votre adresse" value="<?= isset($data_customer['customer_address']) ? $data_customer['customer_address'] : '' ?>">
                        <span class="purple-text text-lighten-3" style="font-size:13px;"><?= isset($validation) ? $validation->getError("customer_address") : '' ?></span>

                    </div>
                    <div>
                        <input type="text" name="customer_zipcode" placeholder="Entrer votre code postal" value="<?= isset($data_customer['customer_zipcode']) ? $data_customer['customer_zipcode'] : '' ?>">
                        <span class="purple-text text-lighten-3" style="font-size:13px;"><?= isset($validation) ? $validation->getError("customer_zipcode") : '' ?></span>

                    </div>
                    <br>
                    <div><button type="submit" value='informations' name='informations' class="button_register">Modifier mes infos</button></div><br>
                </form>
            </div>
        </div>
        <div class="card-right">
            <h5>Modifier mon mot de passe</h5>
            <span class="purple-text text-lighten-3"><?= isset($password_success) ? $password_success : '' ?></span>
            <form method='post' action="" class="form_password">
                <div>
                    <input type="password" name="last_pass" placeholder="Ancien passsword" value="<?= isset($values['last_pass']) ? $values['last_pass'] : '' ?>">
                    <p class="purple-text text-lighten-3" style="font-size:13px;"><?= isset($validation) ? $validation->getError("last_pass") : '' ?></p>
                    <p class="purple-text text-lighten-3" style="font-size:13px;"><?= isset($validPassword) ? $validPassword : '' ?></p>

                </div>
                <div>
                    <input type="password" name="new_pass" placeholder="Nouveau password" value="<?= isset($values['new_pass']) ? $values['new_pass'] : '' ?>">
                    <p class="purple-text text-lighten-3" style="font-size:13px;"><?= isset($validation) ? $validation->getError("new_pass") : '' ?></p>
                </div>
                <div>
                    <button type="submit" value='password' name='password' class="button_register password">Modifier</button>
                </div><br>
            </form>
        </div>
    </div>

</main>


<?= $this->endSection() ?>