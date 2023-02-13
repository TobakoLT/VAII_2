<?php
/** @var int $id */

/** @var ForumPost $data */

use App\Models\ForumPost;


$themeId = $data['post']->getId() ? $data['post']->getThemeId() : $data['id'];
?>
<a href="?c=forumPosts&a=index&themeId=<?= $themeId ?>" class="btn btn-secondary">Naspäť</a>
<div class="container my-5 pt-3 bg-white rounded border border-dark">
    <h1 class="text-center">Pridaj príspevok do fóra</h1>
    <form action="?c=forumPosts&a=store" method="post" enctype="multipart/form-data">

        <?php if ($data['post']->getId()) { ?>
            <input type="hidden" name="id" value="<?php echo $data['post']->getId() ?>">
            <input type="hidden" name="theme_id" value="<?php echo $data['post']->getThemeId() ?>">

        <?php } else { ?>
            <input type="hidden" name="theme_id" value="<?php echo $data['id'] ?>">

        <?php } ?>
        <div class="form-group">
            <label class="pb-1" for="post_text">Text príspevku:</label>
            <textarea class="form-control" id="post_text" name="post_text" rows="3" minlength="50" required
                      autofocus><?= trim($data['post']->getPostText()) ?></textarea>
        </div>
        <div class="form-group pt-2">
            <label for="author">Autor:</label>
            <input type="text" class="form-control" id="author" name="author" style="font-weight: bold"
                   value="<?php echo $_SESSION["user"]->getUsername(); ?>" disabled>
        </div>
        <div class="form-group pt-3">
            <label for="photo">Príloha:</label>
            <div class="text-danger" id="img-input-error"></div>
            <input type="file" class="form-control" formenctype="multipart/form-data" id="photo" name="photo">

        </div>
        <div class="form-group d-flex justify-content-center">
            <button id="myButton" type="submit" class="btn btn-dark my-3">Odoslať</button>
        </div>
    </form>
</div>
<script>
    imageInput2();
</script>

