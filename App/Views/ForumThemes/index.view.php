<?php

use App\Models\ForumTheme;

/** @var \App\Core\IAuthenticator $auth */
/** @var ForumTheme[] $data */
?>
<div class="container my-5 bg-white rounded border border-dark">
    <h1 class="text-center pt-2">Témy fóra</h1>
    <?php
    foreach ($data as $forumTheme) {
        ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3  border border-2 border-dark">
                    <div class="card-header">
                        <h5><?php echo $forumTheme->getNazov() ?></h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text"><?php echo $forumTheme->getPopis() ?></p>
                        <a href="?c=forumPosts&a=index&themeId=<?= $forumTheme->getId() ?>" class="btn btn-dark">Zobraziť
                            tému</a>
                    </div>
                    <div class="card-footer">

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
    </div>