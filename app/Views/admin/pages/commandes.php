<?= $this->extend('web/layouts/admin_layout') ?>

<?= $this->section('body-contents') ?>

<?= $this->include('admin/inc/sidebar') ?>

<div class="card" style="margin:160px auto 50px auto;width:90%;">
    <div class="card-header">
        <h2>Liste des commandes client</h2>
        <a href="<?= base_url('admin/dashboard') ?>"><span class="fas fa-arrow-left"></span></a>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table width="100%">
                <thead>
                    <tr>
                        <td>Client</td>
                        <td>Nombre de produits</td>
                        <td>Réference</td>
                        <td>Montant</td>
                        <td>Date</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody id="result">
                    <?php foreach ($order_details as $order) : ?>
                        <tr>
                            <td><?= $order['customer_name'] ?></td>
                            <td><?= $order['order_details_id'] ?></td>
                            <td><?= $order['order_ref'] ?></td>
                            <td><?= number_format($order['order_total'], 2) ?>€</td>
                            <td><?= substr($order['created_at'], 0, 10) ?></td>
                            <td><a href="<?= base_url('admin/commande/' . $order['order_id']) ?>" class="btn-small purple">gérer</a></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>

            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>