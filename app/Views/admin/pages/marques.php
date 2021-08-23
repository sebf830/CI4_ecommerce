<?= $this->extend('web/layouts/admin_layout') ?>

<?= $this->section('body-contents') ?>

<?= $this->include('admin/inc/sidebar') ?>

<div class="card" style="margin:160px auto 50px auto;width:90%;">
    <p class="small purple-text" style="text-align:center"><?= session()->getFlashdata('brand_success') ? session()->getFlashdata('brand_success') : '' ?></p>
    <div class="card-header">
        <h2>Marques</h2>
        <div style="display:flex;flex-direction:column;text-align:right;">
            <a href="<?= base_url('admin/dashboard') ?>"><span class="fas fa-arrow-left"></span></a>
            <br><br>
            <a href="<?= base_url('admin/marque/new') ?>"><i class=" fas fa-plus"></i> Nouvelle marque</a>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table width="100%">
                <thead>
                    <tr>
                        <td>Nom</td>
                        <td>Image</td>
                        <td>Description</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody id="result">
                    <?php foreach ($brand as $brand_detail) : ?>
                        <tr>
                            <td><?= $brand_detail['brand_name'] ?></td>
                            <td><img src="<?= base_url('public/uploads/' . $brand_detail['brand_image']) ?>" width="30" height="30" /></td>
                            <td><?= word_limiter($brand_detail['brand_description'], 8) ?></td>
                            <td><a href="<?= base_url('admin/marque/' . $brand_detail['brand_id']) ?>" class="btn-small purple">Voir</a></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>

            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>