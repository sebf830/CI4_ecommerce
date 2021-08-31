<?= $this->extend('web/layouts/admin_layout') ?>

<?= $this->section('body-contents') ?>

<?= $this->include('admin/inc/sidebar') ?>

<div class="card" style="margin:160px auto 50px auto;width:90%;min-height:100vh">
    <div class="card-header">
        <h2><?= $article_detail['title_article'] ?></h2>
        <a href="<?= base_url('admin/articles') ?>"><span class="fas fa-home"></span></a>
    </div>
    <p class="small purple-text" style="text-align:center"><?= session()->getFlashdata('article') ? session()->getFlashdata('article') : '' ?></p>

    <div class="card-body" style="display:flex;flex-flow:row wrap; justify-content:space-between">
        <div style="width:40%; margin:0 auto; text-align:center">
            <br>
            <?php if (session()->getFlashdata('image_article')) : ?>
                <img src="<?= base_url('assets/web/images/' . session()->getFlashdata('image_article')) ?>" alt="img_product" width="400" height="400" />
            <?php else : ?>
                <img src="<?= base_url('assets/web/images/' . $article_detail['image_article1']) ?>" alt="img_product" width="400" height="400" />
            <?php endif ?>
            <form action="" method="POST" enctype="multipart/form-data">
                <h5 class="grey-text">Modifier photo :</h5>
                <input class="validate" type="file" name="file" /><br><br>
                <button type="submit" name="upload_article" value="upload_article" class="btn-small purple">Valider</button>
            </form>

        </div>
        <div style="width:50%; padding:50px;">
            <h5>infos</h5>
            <form action="" method="POST">
                <span class="grey-text">Nom:</span>
                <input type="text" name="title" value="<?= $article_detail['title_article'] ?>">

                <br><br>
                <span class="grey-text">Auteur</span>
                <input type="text" name="author" value="<?= $article_detail['author_article'] ?>">
                <br><br>
                <span class="grey-text">Catégorie</span><br>
                <div class="input-field">
                    <select name="categorie">
                        <option value="<?= $article_detail['id_category'] ?>">Choisir une catégorie</option>
                        <?php foreach ($category as $detail_category) : ?>
                            <option value="<?= $detail_category['id_article_category'] ?>"><?= $detail_category['title_category'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <br>
                <div class="row">
                    <div class="col s12">
                        <div class="row">
                            <div class="input-field ">
                                <textarea id="textarea1" class="materialize-textarea" name='intro'><?= $article_detail['intro'] ?></textarea>
                                <label for="textarea1" style="background:none;">Introduction</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12">
                        <div class="row">
                            <div class="input-field ">
                                <textarea id="textarea1" class="materialize-textarea" name="text_article"><?= $article_detail['text_article'] ?></textarea>
                                <label for="textarea1" style="background:none;">Description</label>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" name="upload_article_infos" value="upload_article_infos" class="btn-small purple">Modifier</button>
            </form>
        </div>
    </div>
    <hr>
    <div style="text-align:center;padding:10px">
        <p class="grey-text">Supprimer l'article</p>
        <button type="buttom" data-target="supprimer_article" class="btn modal-trigger" class="btn-small purple">Supprimer</button>
    </div>
    <div id="supprimer_article" class="modal">
        <div class="modal-content">
            <p class="grey-text">Confirmez-vous la suppression définitive de ce produit?</p>
            <br>
            <p><img src="<?= base_url('public/uploads/' . $article_detail['image_article1']) ?>" width="80" height="80"></p>
            <p><?= $article_detail['title_article'] ?></p>
        </div>
        <div class=" modal-footer">
            <a href="#" class="modal-close waves-effect waves-green btn-flat">Annuler</a>
            <a href="<?= base_url('admin/article/supprimer/' . $article_detail['id_article']) ?>" class="modal-close waves-effect waves-green btn-flat">Supprimer</a>
        </div>
    </div>

</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('select');
        var instances = M.FormSelect.init(elems);
    });
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelector('.modal');
        var instances = M.Modal.init(elems);
    });
</script>
<?= $this->endSection() ?>