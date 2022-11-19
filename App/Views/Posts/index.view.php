<?php
use App\Models\Post;
/** @var Post[] $data */
?>

<div>
    <a href="?c=posts&a=create"
       class="mb-md-3 border border-dark border-2 rounded mb-2 bg-color btn">
        Nahraj obrázok
    </a>
</div>

<?php
    foreach ($data as $post) {
    ?>
            <div class="row mb-2 g-2">
        <div class="col">
    <div class="mb-md-3 border bg-color-white border-white border-2 rounded mb-2">
        <?php if ($post->getImg()) { ?>
        <a>
            <img src="<?php echo $post->getImg() ?>" alt="" class="image-mask w-100 mb-0 rounded img-fluid">
            <?php } ?>
        </a>

        <p class="card-text">
            <?php echo $post->getText() ?>
        </p>

        <a href="?c=posts&a=delete&id=<?php echo $post->getId() ?>" class="btn btn-danger">
            Zmazat
        </a>

        <a href="?c=posts&a=edit&id=<?php echo $post->getId() ?>" class="btn btn-warning">
            Upraviť
        </a>
    </div>
    </div>
</div>
<?php } ?>