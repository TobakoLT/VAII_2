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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.6/clipboard.min.js"></script>
    <link rel="stylesheet" href="public/css/styl.css">
    <script src="public/js/script.js"></script>
    <link rel="icon" type="image/x-icon" href="public/images/motologo1.png">
</head>
<body>
<nav class="navbar navbar-expand-md bg-color border border-danger border-opacity-25 border-1">
    <div class="container-fluid ">
        <div class="">
            <a class="navbar-brand" href="?c=home">
                <img src="public/images/motologo1.png"  alt="" title="<?= \App\Config\Configuration::APP_NAME ?>">
            </a>
        </div>

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
                <li class="nav-item ">
                    <a class="nav-link active menu-button rounded" href="?c=forumThemes">FÓRUM</a>
                </li>
            </ul>
            <?php if ($auth->isLogged()) { ?>
                <ul class="navbar-nav ms-auto ">

                    <li class="nav-item me-1">
                        <a class="nav-link menu-button rounded" href="?c=auth&a=account">
                            <img src="public/images/account.webp" class="nav-logo" alt="" title="">
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-button rounded" href="?c=auth&a=logout">
                            <img src="public/images/logout.png" class="nav-logo" alt="" title="">
                        </a>
                    </li>
                </ul>
            <?php } else { ?>
                <ul class="navbar-nav ms-auto">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link menu-button rounded" href="<?= \App\Config\Configuration::LOGIN_URL ?>">
                                <img src="public/images/login.png" class="nav-logo" alt="" title="<?= \App\Config\Configuration::APP_NAME ?>">
                            </a>
                        </li>
                    </ul>
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
