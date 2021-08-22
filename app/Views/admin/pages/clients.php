<?= $this->extend('web/layouts/admin_layout') ?>

<?= $this->section('body-contents') ?>

<?= $this->include('admin/inc/sidebar') ?>

<div class="card" style="margin:160px auto 0 auto;width:90%;">
    <div class="card-header">
        <h2>Liste des Clients</h2>
        <input id="search_user" type="text" class="inputSearch" placeholder="Rechercher un client" style="padding:2px 5px;border:1px solid lightgrey;height:30px;border-radius:20px;margin-top:9px;width:20em" />
        <a href="<?= base_url('admin/dashboard') ?>"><span class="fas fa-arrow-left"></span></a>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table width="100%">
                <thead>
                    <tr>
                        <td>Nom</td>
                        <td>Email</td>
                        <td>Adresse</td>
                        <td>Ville</td>
                        <td>Zip</td>
                        <td>telephone</td>
                        <td>Actif</td>
                        <td>status</td>
                    </tr>
                </thead>
                <tbody id="result">
                    <?php foreach ($getAll as $clients) : ?>
                        <tr>
                            <td><?= $clients['customer_name'] ?></td>
                            <td><?= $clients['customer_email'] ?></td>
                            <td><?= $clients['customer_address'] ?></td>
                            <td><?= $clients['customer_city'] ?></td>
                            <td><?= $clients['customer_zipcode'] ?></td>
                            <td><?= $clients['customer_phone'] ?></td>
                            <?php if ($clients['customer_active']) : ?>
                                <td><span style="color:green" class="fas fa-check"></span></td>
                            <?php else : ?>
                                <td><span style="color:red" class="fas fa-times"></span></td>
                            <?php endif ?>
                            <?php if ($clients['blacklist_status'] == 0) :  ?>
                                <td><span style="color:green" class="fas fa-check"></span></td>
                            <?php else : ?>
                                <td><span style="color:red" class="fas fa-exclamation-triangle"></span></td>
                            <?php endif ?>
                        </tr>
                    <?php endforeach ?>
                </tbody>

            </table>
        </div>
    </div>
</div>
<p style="font-style:italic;display:block;text-align:left;margin-left:50px;">Clients blacklistés = <span style="color:red" class="fas fa-exclamation-triangle"></span></p>

<script>
    $(document).ready(function() {
        $('#search_user').keyup(function() {
            $('#result').html('');

            var utilisateur = $(this).val();

            if (utilisateur != "") {
                $.ajax({
                    type: 'POST',
                    url: '<?= base_url('search_user') ?>',
                    data: {
                        value: utilisateur
                    },
                    datatype: 'JSON',
                    success: function(data) {
                        if (data != "") {
                            var json = JSON.parse(data);
                            console.log(json)
                            for (element of json.result_search) {
                                var active = element.customer_active ? '<td><span style="color:green" class="fas fa-check"></span></td>' : '<td><span style="color:red" class="fas fa-times"></span></td>';
                                var status_blacklist = element.customer_status ? '<td><span style="color:red" class="fas fa-times"></span></td>' : '<td><span style="color:green" class="fas fa-check"></span></td>';
                                var td = '<tr><td>' + element.customer_name + '</td>' +
                                    '<td>' + element.customer_email + '</td>' +
                                    '<td>' + element.customer_address + '</td>' +
                                    '<td>' + element.customer_city + '</td>' +
                                    '<td>' + element.customer_zipcode + '</td>' +
                                    '<td>' + element.customer_phone + '</td>' +
                                    active +
                                    status_blacklist;
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