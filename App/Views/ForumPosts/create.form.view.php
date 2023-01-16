<?php
/** @var int $id */
/** @var ForumPost $data */

use App\Models\ForumPost;

?>
<a href="?c=forumPosts&a=index&themeId=<?= $data['id'] ?>" class="btn btn-secondary">Naspäť</a>
<div class="container my-5 pt-3 bg-white rounded">
    <h1 class="text-center">Pridaj príspevok do fóra</h1>
    <form action="?c=forumPosts&a=store" method="post" enctype="multipart/form-data">

        <?php if ($data['post']->getId()) { ?>
            <input type="hidden" name="id" value="<?php echo $data['post']->getId() ?>">
            <input type="hidden" name="theme_id" value="<?php echo $data['post']->getThemeId()?>">
        <?php } else { ?>
            <input type="hidden" name="theme_id" value="<?php echo $data['id'] ?>">
        <?php } ?>
        <div class="form-group">
            <label class="pb-1" for="post_text">Text príspevku:</label>
            <textarea class="form-control" id="post_text" name="post_text" rows="3" required autofocus></textarea>
        </div>
        <div class="form-group pt-2">
            <label for="author">Autor:</label>
            <input type="text" class="form-control" id="author" name="author" value="<?php echo $_SESSION["user"]->getMeno(); ?>" disabled>
        </div>
        <div class="form-group pt-3">
            <label for="attachment_image">Príloha:</label>
            <input type="file" class="form-control-file" id="attachment_image" name="photo">
        </div>
        <div class="form-group d-flex justify-content-center">
            <button type="submit" class="btn btn-dark my-3">Odoslať</button>
        </div>
    </form>
</div>

