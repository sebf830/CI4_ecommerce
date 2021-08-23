<?= $this->extend('web/layouts/admin_layout') ?>

<?= $this->section('body-contents') ?>

<?= $this->include('admin/inc/sidebar') ?>

<div class="card" style="margin:160px auto 50px auto;width:90%;min-height:50vh">
    <div class="card-header">
        <h2><?= $brand_detail['brand_name'] ?> (<?= $brand_detail['product_id'] ?> produit<?= $brand_detail['product_id'] < 1 ? '' : 's' ?>)</h2>
        <a href="<?= base_url('admin/marques') ?>"><span class="fas fa-home"></span></a>
    </div>
    <p class="small purple-text" style="text-align:center"><?= session()->getFlashdata('marque') ? session()->getFlashdata('marque') : '' ?></p>

    <div class="card-body" style="display:flex;flex-flow:row wrap; justify-content:space-between">
        <div style="width:40%; margin:0 auto; text-align:center">
            <?php if (isset($name)) : ?>
                <img src="<?= base_url('public/uploads/' . $name) ?>" alt="img_product" width="400" height="400" />
            <?php else : ?>
                <img src="<?= base_url('public/uploads/' . $brand_detail['brand_image']) ?>" alt="img_product" width="400" height="400" />
            <?php endif ?>

            <form action="" method="POST" enctype="multipart/form-data">
                <h5 class="grey-text">Modifier photo :</h5>
                <input class="validate" type="file" name="file" /><br><br>
                <button type="submit" name="upload_marque" value="upload_marque" class="btn-small purple">Valider</button>
            </form>
            <br>
        </div>
        <div style="width:50%; padding:50px;">
            <h5>infos</h5>
            <form action="" method="POST">
                <span class="grey-text">Nom:</span>
                <input type="text" name="title" value="<?= $brand_detail['brand_name'] ?>">

                <div class="row">
                    <div class="col s12">
                        <div class="row">
                            <div class="input-field ">
                                <textarea id="textarea1" class="materialize-textarea" name="description"><?= $brand_detail['brand_description'] ?></textarea>
                                <label for="textarea1" style="background:none;">Description</label>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" name="upload_marque_infos" value="upload_marque_infos" class="btn-small purple">Modifier</button>
            </form>
        </div>
    </div>
    <hr>

    <div style="text-align:center;padding:10px">
        <p class="grey-text">Supprimer la marque</p>
        <button type="buttom" data-target="supprimer_produit" class="btn modal-trigger" class="btn-small purple">Supprimer</button>
    </div>
    <div id="supprimer_produit" class="modal">
        <div class="modal-content">
            <p class="grey-text">Confirmez-vous la suppression définitive de la marque?</p>
            <br>
            <p><img src="<?= base_url('public/uploads/' . $brand_detail['brand_image']) ?>" width="80" height="80"></p>
            <p><?= $brand_detail['brand_name'] ?></p>
        </div>
        <div class=" modal-footer">
            <a href="#" class="modal-close waves-effect waves-green btn-flat">Annuler</a>
            <a href="<?= base_url('admin/produit/supprimer/' . $brand_detail['brand_id']) ?>" class="modal-close waves-effect waves-green btn-flat">Supprimer</a>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelector('.modal');
        var instances = M.Modal.init(elems);
    });
</script>
<?= $this->endSection() ?>