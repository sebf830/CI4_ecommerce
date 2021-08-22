<?= $this->extend('web/layouts/admin_layout') ?>

<?= $this->section('body-contents') ?>

<?= $this->include('admin/inc/sidebar') ?>

<div class="card" style="margin:160px auto 50px auto;width:90%;">
    <div class="card-header">
        <h2>Liste des produits</h2>
        <input id="search_product" type="text" class="inputSearch" placeholder="Rechercher un produit" style="padding:2px 5px;border:1px solid lightgrey;height:30px;border-radius:20px;margin-top:9px;width:20em" />
        <a href="<?= base_url('admin/dashboard') ?>"><span class="fas fa-arrow-left"></span></a>
    </div>

    <div class="card-body">
        <p class="purple-text"> <?= session()->getFlashdata('produit_suppression') ?></p>
        <div class="table-responsive">
            <table width="100%">
                <thead>
                    <tr>
                        <td>Produit</td>
                        <td>Image1</td>
                        <td>Prix</td>
                        <td>Stock</td>
                        <td>Categorie</td>
                        <td>Marque</td>
                        <td>Date</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody id="result">
                    <?php foreach ($getAll as $produit) : ?>
                        <tr>

                            <td> <a href="#" style="color:black;"><?= $produit['product_title'] ?></a></td>
                            <td><img src="<?= base_url('public/uploads/' . $produit['product_image']) ?>" width="30" height="30" /></td>
                            <td><?= number_format($produit['product_price'], 2) ?>€</td>
                            <td><?= $produit['product_quantity'] ?></td>
                            <td><?= $produit['category_name'] ?></td>
                            <td><?= $produit['brand_name'] ?></td>
                            <td><?= substr($produit['published_date'], 0, 10) ?></td>
                            <td><a href="<?= base_url('admin/produit/' . $produit['product_id']) ?>" class="btn-small purple">gérer</a></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>

            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#search_product').keyup(function() {
            $('#result').html('');

            var utilisateur = $(this).val();

            if (utilisateur != "") {
                $.ajax({
                    type: 'POST',
                    url: '<?= base_url('search_product') ?>',
                    data: {
                        value: utilisateur
                    },
                    datatype: 'JSON',
                    success: function(data) {
                        if (data != "") {
                            var json = JSON.parse(data);
                            console.log(json)
                            for (element of json.result_search) {
                                var td = '<tr><td>' + element.product_title + '</td>' +
                                    '<td><img src="/CI/venus-shop/public/uploads/' + element.product_image + '" width="30" height="30" /></td>' +
                                    '<td>' + element.product_price + '</td>' +
                                    '<td>' + element.product_quantity + '</td>' +
                                    '<td>' + element.category_name + '</td>' +
                                    '<td>' + element.brand_name + '</td>' +
                                    '<td>' + element.published_date + '</td>' +
                                    '<td> <a href="/CI/venus-shop/admin/produit/' + element.product_id + '" class="btn-small purple"> gérer </a></td>';
                                $('#result').append(td);
                            }
                        }
                    }
                });
            }
        });
    });
</script>

<?= $this->endSection() ?>