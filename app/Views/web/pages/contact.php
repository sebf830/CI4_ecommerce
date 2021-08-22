<?= $this->extend('web/layouts/main_layout') ?>

<?= $this->section('body-contents') ?>

<div class="wrapper_contact">
    <div class="content_form_contact">
        <div class="support">
            <div class="support_desc">
                <h3><?= $options_contact['contact_title']; ?></h3>
                <p><?= $options_contact['contact_subtitle']; ?></p>
                <p><?= $options_contact['contact_description']; ?></p>
            </div>
            <div>
                <img class="supportImg" src="<?= base_url('assets/web/images/contact.png') ?>" alt="" />
            </div>
        </div>

        <div class="contact-form">
            <form action="" method="POST" class="form_contact">
                <span style="color:lightgreen;font-size:18px;">
                    <?= isset($success) ? $success : '' ?>
                </span>
                <h2>Contactez-nous</h2>
                <div>
                    <span><label>Nom</label></span>
                    <span><input type="text" name="nom" value="<?= isset($values['nom']) ? $values['nom'] : '' ?>"></span>
                    <span class="purple-text text-lighten-3" style="font-size:13px;"><?= isset($validation) ? $validation->getError("nom") : '' ?></span>
                </div>
                <div>
                    <span><label>EMAIL</label></span>
                    <span><input type="text" name="email" value="<?= isset($values['email']) ? $values['email'] : '' ?>"></span>
                    <span class="purple-text text-lighten-3" style="font-size:13px;"><?= isset($validation) ? $validation->getError("email") : '' ?></span>

                </div>
                <div>
                    <span><label>Objet du message</label></span>
                    <span><input type="text" name="objet" value="<?= isset($values['objet']) ? $values['objet'] : '' ?>"></span>
                    <span class="purple-text text-lighten-3" style="font-size:13px;"><?= isset($validation) ? $validation->getError("objet") : '' ?></span>

                </div>
                <div>
                    <span><label>Message</label></span>
                    <span><textarea name="sujet"><?= isset($values['sujet']) ? $values['sujet'] : '' ?></textarea></span>
                    <span class="purple-text text-lighten-3" style="font-size:13px;"><?= isset($validation) ? $validation->getError("sujet") : '' ?></span>

                </div>
                <div>
                    <span><input type="submit" name="submit_contact"></span>
                </div>
            </form>

            <div class="col span_1_of_3">
                <div class="company_address">
                    <h2>Informations:</h2>
                    <p><?= $options_contact['company_location']; ?></p>
                    <p>telephone :<?= $options_contact['company_number']; ?></p>
                    <p>Email :<a href="mailto:<?= $options_contact['company_email']; ?>"> <span><?= $options_contact['company_email']; ?></span></a></p>
                    <p>Suivez-nous : <a target="_blank" href="<?= $options_contact['company_facebook']; ?>"><span>Facebook</span></a>,
                        <a target="_blank" href="<?= $options_contact['site_twitter_link']; ?>"><span>Twitter</span></a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>