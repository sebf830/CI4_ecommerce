<?= $this->extend('web/layouts/admin_layout') ?>

<?= $this->section('body-contents') ?>

<?= $this->include('admin/inc/sidebar') ?>

<div class="card" style="margin:160px auto 50px auto;width:90%;min-height:150vh">
    <div class="card-header">
        <h2>Nouvel article</h2>
        <a href="<?= base_url('admin/articles') ?>"><span class="fas fa-home"></span></a>
    </div>
    <p class="small purple-text" style="text-align:center"><?= session()->getFlashdata('msg_success') ? session()->getFlashdata('msg_success') : '' ?></p>

    <div class="card-body" style="display:flex;flex-flow:row wrap; justify-content:space-between">
        <div style="width:40%; margin:0 auto; text-align:center">
            <br>
            <div style='min-width:200px; min-height:200px;border:1px solid #ededed'>
                <img src='<?= session()->getFlashdata('image') ? base_url('assets/web/images/' . session()->getFlashdata('image')) : "https://images6.alphacoders.com/683/thumb-350-683727.jpg" ?>' alt="img_product" width="400" height="400" />
                <span class="purple-text"><?= isset($noImage) ? $noImage : '' ?></span>
            </div>
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
                <input type="text" name="title" value="<?= isset($values) ? $values['title'] : '' ?>">
                <span class="purple-text text-lighten-3" style="font-size:13px;"><?= isset($validation) ? $validation->getError("title") : '' ?></span>


                <br><br>
                <span class="grey-text">Auteur</span>
                <input type="text" name="author" value="<?= isset($values) ? $values['author'] : '' ?>">
                <span class="purple-text text-lighten-3" style="font-size:13px;"><?= isset($validation) ? $validation->getError("author") : '' ?></span>


                <br><br>

                <span class="grey-text">Catégorie</span><br>
                <div class="input-field">
                    <select name="categorie">
                        <option value="">Choisir une catégorie</option>
                        <?php foreach ($category as $detail_category) : ?>
                            <option value="<?= $detail_category['id_article_category'] ?>"><?= $detail_category['title_category'] ?></option>
                        <?php endforeach ?>
                    </select>
                    <span class="purple-text text-lighten-3" style="font-size:13px;"><?= isset($validation) ? $validation->getError("categorie") : '' ?></span>

                </div>
                <br>
                <div class="row">
                    <div class="col s12">
                        <div class="row">
                            <div class="input-field ">
                                <textarea id="textarea1" class="materialize-textarea" name='intro'><?= isset($values) ? $values['intro'] : '' ?></textarea>
                                <label for="textarea1" style="background:none;">Introduction</label>
                            </div>
                            <span class="purple-text text-lighten-3" style="font-size:13px;"><?= isset($validation) ? $validation->getError("intro") : '' ?></span>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col s12">
                        <div class="row">
                            <div class="input-field ">
                                <textarea id="textarea1" class="materialize-textarea" name="text_article"><?= isset($values) ? $values['text_article'] : '' ?></textarea>
                                <label for="textarea1" style="background:none;">Description</label>
                            </div>
                            <span class="purple-text text-lighten-3" style="font-size:13px;"><?= isset($validation) ? $validation->getError("text_article") : '' ?></span>

                        </div>
                    </div>
                </div>
                <button type="submit" name="new_article" value="new_article" class="btn-small purple">Enregistrer</button>
            </form>
        </div>
    </div>

</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('select');
        var instances = M.FormSelect.init(elems);
    });
</script>
<?= $this->endSection() ?>