<?= $this->extend('web/layouts/main_layout') ?>

<?= $this->section('body-contents') ?>
<div class="wrapper-main" style="padding-bottom:60px;">
    <div class="content" style="text-align:center; margin:0;">
        <div class="login_panel">
            <h5>Espace Personnel</h5>
            <p>Connectez-vous à votre compte client.</p>
            <br>
            <form action="<?= base_url('client/connexion') ?>" method="post">
                <?php if (session()->get('success')) : ?>
                    <p style="color:lightgreen; font-size:14px;"> <?= session()->get('success') ?></p>
                <?php endif; ?>
                <input name="customer_email" placeholder="Enter Your Email" type="text" value="<?= isset($values['customer_email']) ? $values['customer_email'] : '' ?>" />
                <span class="purple-text text-lighten-3" style="font-size:13px;"><?= isset($validation) ? $validation->getError("customer_email") : '' ?></span>

                <input name="customer_password" placeholder="Enter Your Password" type="password" />
                <span class="purple-text text-lighten-3" style="font-size:13px;"><?= isset($validation) ? $validation->getError("customer_password") : '' ?></span>


                <div class="buttons">
                    <div><button class="button_login">Entrer</button></div>
                    <p>Pas encore inscrit? <a href="<?= base_url('client/inscription') ?>">Je crée mon compte</a></p>
                    <p style="font-size:12px;" class="note">Si vous avez oublié votre mot de passe, vous pouvez le <a href="<?= base_url('client/reinitialiser') ?>">réinitialiser ici</a></p>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>