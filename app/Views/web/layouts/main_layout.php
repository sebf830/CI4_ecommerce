<!DOCTYPE html>
<html lang="fr">

<head>
    <?= $this->include('web/inc/head') ?>
</head>

<body>

    <header>
        <?= $this->include('web/inc/header') ?>
    </header>

    <?= $this->renderSection('body-contents'); ?>


    <footer>
        <?= $this->include('web/inc/footer') ?>
    </footer>
</body>

</html>