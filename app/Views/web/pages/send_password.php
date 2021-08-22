<?= $this->extend('web/layouts/main_layout') ?>

<?= $this->section('body-contents') ?>
<div class="wrapper-main" style="margin-top:2%;padding:60px 0;">

    <form class="form_register" method="post" action="">
        <div class=" left-col-register" style="width:40%;margin:0 auto;text-align:center">
            <h5>Réinitialiser mon mot de passe</h5>
            <p>Veuillez nous communiquer votre adresse mail</p>
            <span class="purple-text text-lighten-3"><?= isset($password_success) ? $password_success : '' ?></span>
            <div>
                <input type="text" name="customer_email" style="width:80%;" placeholder="Votre adresse mail" value="<?= isset($values['customer_name']) ? $values['customer_name'] : '' ?>">
                <span class="purple-text text-lighten-3" style="font-size:13px;"><?= isset($validation) ? $validation->getError("customer_name") : '' ?></span>
            </div>
            <br>
            <div><button class="button_register ">Réinitialiser</button></div>
        </div>
    </form>
</div>
<?= $this->endSection() ?>