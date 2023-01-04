<?php
/** @var string $contentHTML */
/** @var \App\Core\IAuthenticator $auth */
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <title><?= \App\Config\Configuration::APP_NAME ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
            crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="public/css/styl.css">
    <script src="public/js/script.js"></script>
    <link rel="icon" type="image/x-icon" href="public/images/motologo1.png">
</head>
<body>
<nav class="navbar navbar-expand-md bg-color border border-danger border-opacity-25 border-1">
    <div class="container-fluid">
        <a class="navbar-brand" href="?c=home">
            <img src="public/images/motologo1.png" alt="" title="<?= \App\Config\Configuration::APP_NAME ?>">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav sticky-top font-size ms-auto mb-2 mb-sm-0">
                <li class="nav-item " >
                    <a class="nav-link active menu-button rounded me-1" aria-current="page" href="?c=home&a=index">ÚVOD</a>
                </li>
                <li class="nav-item " >
                    <a class="nav-link active menu-button rounded me-1" href="?c=home&a=gallery">GALÉRIA</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link active menu-button rounded me-1" href="?c=home&a=info">INFORMÁCIE</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link active menu-button rounded" href="?c=home&a=contact">KONTAKT</a>
                </li>
            </ul>
            <?php if ($auth->isLogged()) { ?>
                <ul class="navbar-nav ms-auto">
                    <span class="navbar-text">Prihlásený používateľ: <b><?= $auth->getLoggedUserName() ?></b></span>
                    <li class="nav-item">
                        <a class="nav-link" href="?c=auth&a=logout">Odhlásenie</a>
                    </li>
                </ul>
            <?php } else { ?>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= \App\Config\Configuration::LOGIN_URL ?>">Prihlásenie</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= \App\Config\Configuration::REGISTER_URL ?>">Registrácia</a>
                    </li>
                </ul>
            <?php } ?>
        </div>

    </div>
</nav>
<div class="container-fluid mt-3">
    <div class="web-content">
        <?= $contentHTML ?>
    </div>
</div>
</body>
</html>
