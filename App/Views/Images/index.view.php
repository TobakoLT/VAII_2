<?php
use App\Models\Image;
/** @var Image[] $data */
?>

<div>
    <a href="?c=images&a=create"
       class="mb-md-3 border border-dark border-2 rounded mb-2 bg-color btn">
        Nahraj obrázok
    </a>
</div>

<?php
    foreach ($data as $image) {
    ?>
            <div class="row mb-2 g-2">
        <div class="card col-lg-4 p-0 box">
    <div class="mb-md-3 border bg-color-white border-white border-2 rounded mb-2">
        <?php if ($image->getImg()) { ?>
        <div class="card border-0 p-0 box">
        <a>
            <img src="<?php echo $image->getImg() ?>" alt="" class="image-mask w-100 mb-0 rounded img-fluid">
            <?php } ?>
        </a>

        <?php if ($image->getText()) { ?>
        <p class="mx-auto card-text">
            <?php echo $image->getText() ?>
            <?php } ?>
        </p>

        <a href="?c=images&a=delete&id=<?php echo $image->getId() ?>" class="btn btn-danger">
            Zmazat
        </a>

        <a href="?c=images&a=edit&id=<?php echo $image->getId() ?>" class="btn btn-warning">
            Upraviť
        </a>
        </div>
    </div>
    </div>
</div>
<?php } ?>