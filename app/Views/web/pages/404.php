<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Page 404</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,900" rel="stylesheet">
    <link rel="shortcut icon" href="<?= base_url('public/uploads/paw2.ico') ?>" type="image/x-icon" />

</head>

<body>
    <div class="notfound-404">
        <img class="img_404" src="<?= base_url('assets/web/images/bg_404.png') ?>" alt="404" />
    </div>
    <div class="text-404">
        <h2>404 - Page non trouvée</h2>
        <p>La page demandée à été supprimée, modifiée ou est peut être temporairement indisponible.</p>
        <a href="<?= base_url('home') ?>">Vers la boutique</a>
    </div>
</body>

</html>

<style>
    .notfound-404 {
        width: 80%;
        margin: 20px auto;
        text-align: center;
    }

    .img_404 {
        width: 60%;
    }

    .text-404 {
        text-align: center;
    }

    .text-404 h2 {
        font-family: 'Montserrat', sans-serif;
        color: #000;
        font-size: 24px;
        font-weight: 700;
        text-transform: uppercase;
        margin-top: 0;
    }

    .text-404 p {
        font-family: 'Montserrat', sans-serif;
        color: #000;
        font-size: 14px;
        font-weight: 400;
        margin-bottom: 20px;
        margin-top: 0px;
    }

    .text-404 a {
        font-family: 'Montserrat', sans-serif;
        font-size: 14px;
        text-decoration: none;
        text-transform: uppercase;
        background: purple;
        display: inline-block;
        padding: 15px 30px;
        border-radius: 40px;
        color: #fff;
        font-weight: 700;
        -webkit-box-shadow: 0px 4px 15px -5px #0046d5;
        box-shadow: 0px 4px 15px -5px #0046d5;
    }


    @media only screen and (max-width: 767px) {
        .img_404 {
            width: 100%;
        }
    }
</style>