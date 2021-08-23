<?= $this->extend('web/layouts/admin_layout') ?>

<?= $this->section('body-contents') ?>

<?= $this->include('admin/inc/sidebar') ?>

<div class="card" style="margin:160px auto 50px auto;width:90%;">
    <span class="purple-text" style='text-align:center'><?= session()->getFlashdata('success_category') ? session()->getFlashdata('success_category') : '' ?></span>
    <div class="card-header">
        <h2>Catégories boutique</h2>

        <a href="<?= base_url('admin/dashboard') ?>"><span class="fas fa-arrow-left"></span></a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table width="100%">
                <thead>
                    <tr>
                        <td>Nom</td>
                        <td>Image</td>
                        <td>Description</td>
                        <td><a href="<?= base_url('admin/category/new') ?>"><i class=" fas fa-plus"></i> Nouvelle catégorie</a></td>
                    </tr>
                </thead>
                <tbody id="result">
                    <?php foreach ($details_category as $category) : ?>
                        <tr>
                            <td><?= $category['category_name'] ?></td>
                            <td><img src="<?= base_url('public/uploads/' . $category['category_img']) ?>" width="30" height="30" /></td>
                            <td><?= word_limiter($category['category_description'], 8) ?></td>
                            <td><a href="<?= base_url('admin/category/' . $category['id']) ?>" class="btn-small purple">Voir</a></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>

            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>