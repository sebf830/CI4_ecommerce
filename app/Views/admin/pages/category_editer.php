<?= $this->extend('web/layouts/admin_layout') ?>

<?= $this->section('body-contents') ?>

<?= $this->include('admin/inc/sidebar') ?>

<div class="card" style="margin:160px auto 50px auto;width:90%;min-height:50vh">
    <div class="card-header">
        <h2> <?= ucfirst($details_category['category_name']) ?> (<?= $details_category['product_id'] ?> produits)</h2>
        <a href="<?= base_url('admin/categories') ?>"><span class="fas fa-home"></span></a>
    </div>
    <p style='text-align:center' class="purple-text"><?= session()->getFlashdata('edit_success') ?></p>

    <div class="card-body" style="display:flex;flex-flow:row wrap; justify-content:space-between">
        <div style="width:40%; margin:0 auto; text-align:center">
            <br>
            <div style='min-width:200px; min-height:200px;border:1px solid #ededed'>
                <?php if (!session()->getFlashdata('image')) : ?>
                    <img src='<?= base_url('public/uploads/' . $details_category['category_img']) ?>' alt="img_product" width="400" height="400" />
                <?php else : ?>
                    <img src='<?= base_url('public/uploads/' . session()->getFlashdata('image')) ?>' alt="img_product" width="400" height="400" />
                <?php endif ?>
                <span class="purple-text"><?= session()->getFlashdata('msg_success') ? session()->getFlashdata('msg_success') : '' ?></span>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                <h5 class="grey-text">Modifier l'image :</h5>
                <input class="validate" type="file" name="file" /><br><br>
                <button type="submit" name="upload_image" value="upload_image" class="btn-small purple">Valider</button>
            </form>
            <br>
        </div>
        <div style="width:50%; padding:50px;">
            <form action="" method="POST">
                <span class="grey-text">Titre:</span>
                <input type="text" name="title" value="<?= $details_category['category_name'] ?>">

                <br><br>

                <div class="row">
                    <div class="col s12">
                        <div class="row">
                            <div class="input-field ">
                                <textarea id="textarea1" class="materialize-textarea" name="description"><?= $details_category['category_description'] ?></textarea>
                                <label for="textarea1" style="background:none;">Description</label>
                            </div>

                        </div>
                    </div>
                </div>
                <button type="submit" name="edit_category" value="edit_category" class="btn-small purple">Modifier la catégorie</button>
            </form>
        </div>
    </div>
    <hr>
    <div style="text-align:center;padding:10px">
        <p class="grey-text">Supprimer la catégorie</p>
        <button type="buttom" data-target="supprimer_category" class="btn modal-trigger" class="btn-small purple">Supprimer</button>
    </div>
    <div id="supprimer_category" class="modal modale">
        <div class="modal-content">
            <p class="grey-text">Confirmez-vous la suppression définitive de la catégorie?</p>
            <br>
            <p><img src="<?= base_url('public/uploads/' . $details_category['category_img']) ?>" width="80" height="80"></p>
            <p><?= $details_category['category_name'] ?></p>
        </div>
        <div class=" modal-footer">
            <a href="#" class="modal-close waves-effect waves-green btn-flat">Annuler</a>
            <a href="<?= base_url('admin/supprimer_categorie/' . $details_category['id']) ?>" class="modal-close waves-effect waves-green btn-flat">Supprimer</a>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelector('.modale');
        var instances = M.Modal.init(elems);
    });
</script>
<?= $this->endSection() ?>