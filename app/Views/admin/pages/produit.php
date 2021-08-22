<?= $this->extend('web/layouts/admin_layout') ?>

<?= $this->section('body-contents') ?>

<?= $this->include('admin/inc/sidebar') ?>

<div class="card" style="margin:160px auto 50px auto;width:90%;min-height:150vh">
    <div class="card-header">
        <h2><?= $data_product['product_title'] ?></h2>
        <a href="<?= base_url('admin/produits') ?>"><span class="fas fa-home"></span></a>
    </div>
    <span class="small purple-text"><?= session()->getFlashdata('produit', 'Image modifiée avec succès') ?></span>

    <div class="card-body" style="display:flex;flex-flow:row wrap; justify-content:space-between">
        <div style="width:40%; margin:0 auto; text-align:center">
            <img src="<?= base_url('public/uploads/' . $data_product['product_image']) ?>" alt="img_product" width="400" height="400" />

            <form action="" method="POST" enctype="multipart/form-data">
                <h5 class="grey-text">Modifier photo :</h5>
                <input class="validate" type="file" name="file" /><br><br>
                <button type="submit" name="upload_image" value="upload_image" class="btn-small purple">Valider</button>
            </form>

        </div>
        <div style="width:50%; padding:50px;">
            <h5>infos</h5>
            <form action="" method="POST">
                <span class="grey-text">Nom:</span>
                <input type="text" name="title" value="<?= $data_product['product_title'] ?>">

                <br><br>
                <span class="grey-text">Prix:</span>
                <input type="text" name="price" value="<?= $data_product['product_price'] ?>">

                <br><br>

                <span class="grey-text">Quantité en stock:</span>
                <input type="text" name="stock" value="<?= $data_product['product_quantity'] ?>">
                <br><br>
                <span class="grey-text">Catégorie</span><br>
                <div class="input-field">
                    <select name="categorie">
                        <option value="<?= $data_product['product_category'] ?>"><?= $data_product['category_name'] ?></option>
                        <?php foreach ($categories as $categorie) : ?>
                            <option value="<?= $categorie['id'] ?>"><?= $categorie['category_name'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <br>
                <div class="row">
                    <div class="col s12">
                        <div class="row">
                            <div class="input-field ">
                                <textarea id="textarea1" class="materialize-textarea" name='short_description'><?= $data_product['short_description'] ?></textarea>
                                <label for="textarea1" style="background:none;">Résume</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col s12">
                        <div class="row">
                            <div class="input-field ">
                                <textarea id="textarea1" class="materialize-textarea" name="long_description"><?= $data_product['long_description'] ?></textarea>
                                <label for="textarea1" style="background:none;">Description</label>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" name="update_infos" value="update_infos" class="btn-small purple">Modifier</button>
            </form>
        </div>
    </div>
    <hr>
    <div style="text-align:center;padding:10px">
        <p class="grey-text">Supprimer le produit</p>
        <button type="buttom" data-target="supprimer_produit" class="btn modal-trigger" class="btn-small purple">Supprimer</button>
    </div>
    <div id="supprimer_produit" class="modal">
        <div class="modal-content">
            <p class="grey-text">Confirmez-vous la suppression définitive de ce produit?</p>
            <br>
            <p><img src="<?= base_url('public/uploads/' . $data_product['product_image']) ?>" width="80" height="80"></p>
            <p><?= $data_product['product_title'] ?></p>
        </div>
        <div class=" modal-footer">
            <a href="#" class="modal-close waves-effect waves-green btn-flat">Annuler</a>
            <a href="<?= base_url('admin/produit/supprimer/' . $data_product['product_id']) ?>" class="modal-close waves-effect waves-green btn-flat">Supprimer</a>
        </div>
    </div>

</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('select');
        var instances = M.FormSelect.init(elems);
    });
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.modal');
        var instances = M.Modal.init(elems);
    });
</script>
<?= $this->endSection() ?>