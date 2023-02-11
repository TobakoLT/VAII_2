<?php

use App\Models\ForumPost;
use App\Models\ForumTheme;

/** @var \App\Core\IAuthenticator $auth */
/** @var ForumPost[] $data */

?>

<div class="container bg-white rounded border border-dark my-5">
    <?php if ($data['themeId'] != NULL) { ?>
        <h2 class="text-center fw-bold pt-2"><?php echo ForumTheme::getOne($data['themeId'])->getNazov() ?></h2>
    <?php } else { ?>
        <h2 class="text-center fw-bold pt-2">Všetky príspevky</h2>
    <?php } ?>
    <div class="row">
        <div class="col-md-12">
            <?php
            $imageId = 1;
            foreach ($data['posts'] as $post) { ?>
                <!--<div style="margin-top: 15px;"></div>-->
                <div class="card mb-3 border border-2 border-dark">
                    <div class="card-header">
                        <small class="fw-bold"><?php echo $post->getAuthor() ?></small>
                    </div>
                    <div class="card-body">
                        <p><?= $post->getPostText() ?></p>
                        <?php if ($post->getAttachmentImage()) { ?>
                            <div class="mb-1">
                                <button class="spoiler-button simpleHoverRed" data-target="<?= $imageId ?>"
                                        onclick="toggleImage(<?= $imageId ?>)">Zobraziť prílohu
                                </button>
                                <button class="hide-spoiler-button simpleHoverYellow" data-target="<?= $imageId ?>"
                                        onclick="toggleImage(<?= $imageId ?>)" style="display: none">Skryť
                                </button>
                            </div>
                            <img id="<?= $imageId ?>" class="img-fluid" src="<?= $post->getAttachmentImage() ?>"
                                 style="display: none" alt="">
                            <?php $imageId++ ?>
                        <?php } ?>
                    </div>
                    <div class="card-footer">
                        <small>
                            <?php echo $post->getCreatedAt() ?>
                        </small>
                        <small class="float-end fw-semibold">
                            <?php if ($auth->isLogged() && $_SESSION["user"]->getUsername() == $post->getAuthor()) { ?>
                                <a href="?c=forumPosts&a=delete&id=<?php echo $post->getId() ?>&theme_id=<?php echo $post->getThemeId() ?>"
                                   class="me-2">
                                    Zmazať
                                </a>

                                <a href="?c=forumPosts&a=edit&id=<?php echo $post->getId() ?>" class="me-2">
                                    Upraviť
                                </a>
                            <?php } ?>
                        </small>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<div class="col-md-4 bottom-buttons my-1">
    <?php if ($auth->isLogged() && $data['themeId'] !== NULL) { ?>
        <a class="btn btn-secondary" href="?c=forumPosts&a=create&id=<?= $data['themeId'] ?>">Nový príspevok</a>
    <?php } ?>
    <a class="btn btn-secondary" href="?c=forumThemes">Zoznam tém</a>
</div>

<script>

</script>