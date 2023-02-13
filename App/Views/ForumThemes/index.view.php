<?php

use App\Models\ForumTheme;

/** @var \App\Core\IAuthenticator $auth */
/** @var ForumTheme[] $data */
?>
<div class="container my-5 bg-white rounded border border-dark">
    <h1 class="text-center pt-2">Témy fóra</h1>
    <?php
    foreach ($data["forumThemes"] as $forumTheme) {
        ?>
        <div class="row" id="theme-<?= $forumTheme->getId() ?>">
            <div class="col-md-12">
                <div class="card mb-3  border border-2 border-dark">
                    <div class="card-header">
                        <div class="row">
                        <h5 class="col"><?php echo $forumTheme->getNazov() ?></h5>
                        <h6 class="col text-end">Počet príspevkov: <?= $data["postCount"][$forumTheme->getId()] ?></h6>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="card-text"><?php echo $forumTheme->getPopis() ?></p>
                        <a href="?c=forumPosts&a=index&themeId=<?= $forumTheme->getId() ?>" class="btn btn-dark">Zobraziť
                            tému</a>
                    </div>
                    <div class="card-footer">
                        <small>
                            <?php echo $forumTheme->getCreatedAt() ?>
                        </small>
                        <small class="float-end fw-bold">
                            <?php if ($auth->isLogged() && $_SESSION["user"]->getAdmin()) { ?>
                                <button class="delete-theme simpleHoverRed" data-id="<?= $forumTheme->getId() ?>">Zmazať
                                </button>
                                <button class="me-2 simpleHoverYellow"
                                        onclick="location.href='?c=forumThemes&a=edit&id=<?= $forumTheme->getId() ?>'">
                                    Upraviť
                                </button>
                            <?php } ?>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="col-md-4 bottom-buttons my-1">
        <?php if ($auth->isLogged()) { ?>
            <a class="btn btn-secondary " href="?c=forumThemes&a=create">Nová téma</a>
        <?php } ?>
        <a class="btn btn-secondary " href="?c=forumPosts&a=showAllPosts">Všetky príspevky</a>
        <a class="btn btn-secondary " href="?c=forumPosts&a=userPosts">Moje príspevky</a>
    </div>
    <!-- Modálne okno -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="conductModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border border-3">
                <div class="modal-header ">
                    <h5 class="modal-title fw-bold" id="conductModalLabel">Upozornenie na správanie</h5>
                </div>
                <div class="modal-body">
                    Toto upozornenie slúži na zvýšenie zodpovednosti a slušnosti užívateľov fóra.
                </div>
                <div class="modal-footer ">
                    <a href="?c=home" class="btn btn-light" id="leave">Nechápem</a>
                    <button type="button" class="btn " id="agree">Rozumiem</button>
                </div>
            </div>
        </div>
    </div>
</div>
    <script>
        themeDeleteConfirm();
        displayConductModal();
    </script>