<?= $this->extend('web/layouts/admin_layout') ?>
<?= $this->section('body-contents') ?>
<?= $this->include('web/inc/sidebar_customer') ?>

<main>
    <div class="cards" style="display:flex;justify-content:center">
        <div class="card-single" style="background-color:white;margin-top:50px;width:65%;padding:20px;">
            <div style="display:flex;flex-direction:column">
                <h5>Vous êtes <?= $rank['rank_name'] ?></h5><br>
                <?php if ($rank['rank_name'] != 'membre or') : ?>
                    <p>Cumulez encore <?= $rank['end_points'] - $points['points'] ?> points et profitez de nouveaux avantages</p>
                <?php endif ?>
                <p><?= $rank['description_next_rank'] ?></p>
            </div>
            <div style="text-align:center">
                <img src="<?= base_url('assets/web/images/' . $rank['rank_image']) ?>" width="60" height="90" />
                <p style="font-size:18px; color:grey"><?= $points['points'] > 0 ? $points['points'] : 0 ?> points venus</p>
                <br>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection() ?>