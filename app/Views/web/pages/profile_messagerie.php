<?= $this->extend('web/layouts/admin_layout') ?>
<?= $this->section('body-contents') ?>
<?= $this->include('web/inc/sidebar_customer') ?>

<main>

    <div class="card_msg" style="margin:0 auto;">
        <div style="background-color:white;margin:50px auto;width:85%;padding:20px;min-height:70vh;">
            <?php if ($_SERVER['PATH_INFO'] == '/profile/messagerie') : ?>
                <h5>Boite de réception</h5><br>
                <hr>
                <?php if ($msgs == 0) : ?>
                    <?php foreach ($msgs as $msg) : ?>
                        <a href="<?= base_url('profile/messagerie/' . $msg['id_conversation']) ?>" style="color:black">
                            <div style="display:flex;flex-flow:row wrap;justify-content:space-between;padding:14px 0; text-align:center;color:black;<?= $msg['conversation_status_read'] == 0 ? 'font-weight:bold' : '' ?> ">
                                <p style="margin-right:100px;"><?= ucfirst($msg['user_name']) ?></p>
                                <p style="margin-right:100px;"> <?= ucfirst(word_limiter($msg['text_msg'], 7)) ?></p>
                                <p>Le <?= substr($msg['created_at'], 0, 10) ?> à <?= substr($msg['created_at'], 10, 15) ?></p>
                            </div>
                            <hr style="border:1px solid #ededed;">
                        </a>
                    <?php endforeach ?>
                <?php else : ?>
                    <p>Vous n'avez reçu aucun message</p>
                <?php endif ?>
            <?php else : ?>
                <a id="send" href="#" class="material-icons" style="display:block;text-align:right;color:black">reply</a>
                <?php foreach ($msg_details as $msg_detail) : ?>
                    <div class="message_content">
                        <h5><?= $msg_detail['id_user'] == $msg_detail['user_id'] ? $msg_detail['user_name'] : $msg_detail['customer_name'] ?></h5>
                        <p>Le <?= substr($msg_detail['created_at'], 0, 10) ?> à <?= substr($msg_detail['created_at'], 10, 15) ?></p>
                        <br>
                        <?= $msg_detail['text_msg'] ?>
                        <br><br>
                        <?= $msg_details > 1 ? '<hr>' : '' ?>
                    </div>
                <?php endforeach ?>
                <div class="reply_content" id="reply_content" style="margin-top:80px;">
                    <form id="reply_form" style="display:none">
                        <textarea type="text" id="reply_text" style="height:100px;outline:none;border:1px solid #ededed;border-radius:15px;resize:none;padding:15px;"></textarea>
                        <button type="button" id="reply_submit" style="padding:8px;background:purple;color:white;border:none;margin-top:10px;">Envoyer</button>
                    </form>
                </div>

            <?php endif ?>
        </div>
    </div>
</main>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>
    $(function() {
        $(document).on('click', '#send', function() {
            $('#reply_form').fadeIn().show();
        });

        $(document).on('click', '#reply_submit', function() {
            if ($('#reply_text').val() != null) {
                $.ajax({
                    url: '<?= base_url('ajax_msg') ?>',
                    type: 'POST',
                    data: {
                        texte: $('#reply_text').val(),
                        conversation: <?= isset($id_conversation) ? $id_conversation : '' ?>
                    },
                    datatype: 'JSON',
                    success: function(response) {}
                });
            }
        });
    });
</script>

<?= $this->endSection() ?>