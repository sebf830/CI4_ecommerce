<?= $this->extend('web/layouts/admin_layout') ?>

<?= $this->section('body-contents') ?>

<?= $this->include('admin/inc/sidebar') ?>

<div class="card" style="margin:160px auto 50px auto;width:90%;">
    <div class="card-header">
        <h2>Liste des articles blog</h2>
        <a href="<?= base_url('admin/dashboard') ?>"><span class="fas fa-arrow-left"></span></a>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table width="100%">
                <thead>
                    <tr>
                        <td>Titre</td>
                        <td>Image</td>
                        <td>Auteur</td>
                        <td>Aperçu</td>
                        <td>catégorie</td>
                        <td>Publication</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody id="result">
                    <?php foreach ($article_details as $article) : ?>
                        <tr>
                            <td class="grey-text"><?= $article['title_article'] ?></td>
                            <td><img src="<?= $article['image_article1'] ?>" width='60' height='60' /></td>
                            <td><?= $article['author_article'] ?></td>
                            <td><?= word_limiter($article['intro'], 8) ?></td>
                            <td><?= $article['title_category'] ?></td>
                            <td><?= $article['created_at'] ?></td>
                            <td><a href="<?= base_url('admin/article/' . $article['id_article']) ?>" class="btn-small purple">gérer</a></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>

            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>