<?php

use App\Models\ForumPost;
use App\Models\ForumTheme;

/** @var \App\Core\IAuthenticator $auth */
/** @var ForumPost[] $data */

?>

<div class="container bg-white rounded border border-primary">
    <h2 class="text-center fw-bold pt-2"><?php echo ForumTheme::getOne($data['themeId'])->getNazov(); ?></h2>
    <div class="row">
        <div class="col-md-12">
            <?php foreach ($data['posts'] as $post) { ?>
            <!--<div style="margin-top: 15px;"></div>-->
                <div class="card mb-3">
                    <div class="card-header">
                        <small class="fw-bold"><?php echo $post->getAuthor()?></small>
                    </div>
                    <div class="card-body">
                        <p><?= $post->getPostText() ?></p>

                        <button class="spoiler-button btn-sm" data-img-src="<?= $post->getAttachmentImage() ?>">Zobraziť prílohu</button>
                        <img class="spoiler-image" style="display: none" alt="">
                        <button class="hide-spoiler-button btn-sm" style="display: none">Skryť</button>
                    </div>
                    <div class="card-footer">
                        <small><?php echo $post->getCreatedAt() ?></small>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<div class="col-md-4 bottom-buttons my-1">
    <?php if ($auth->isLogged()) { ?>
        <a class="btn btn-secondary" href="?c=forumPosts&a=create&id=<?= $data['themeId'] ?>">Nový príspevok</a>
    <?php } ?>
    <a class="btn btn-secondary" href="?c=forumThemes">Zoznam tém</a>
</div>

<script>
    toggleSpoiler('.spoiler-button', '.spoiler-image', '.hide-spoiler-button');
</script>