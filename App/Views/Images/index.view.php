<?php
use App\Models\Image;
/** @var \App\Core\IAuthenticator $auth */
/** @var Image[] $data */
?>

<div>
    <?php if($auth->isLogged()) {?>
    <a href="?c=images&a=create"
       class="mb-md-3 border border-dark border-2 rounded mb-2 bg-color btn">
        Nahraj obrázok
    </a>
    <?php } ?>
</div>

<div class="row mb-2 g-2">
    <?php
    foreach ($data as $image) {
        ?>

        <div class="card col-md-4">
            <div class="mb-md-3 border border-white border-2 rounded mb-2">
                <a href="" target="_blank">
                    <?php if ($image->getImg()) { ?>
                        <img src="<?php echo $image->getImg() ?>" alt="moto1" class="image-mask w-100 mb-0 rounded img-fluid">
                    <?php } ?>
                </a>
            </div>

            <?php if ($image->getText()) { ?>
            <p class="mx-auto card-text">
                <?php echo $image->getText() ?>
                <?php } ?>
            </p>
            <?php if($auth->isLogged()) {?>
                <a href="?c=images&a=delete&id=<?php echo $image->getId() ?>" class="btn btn-danger">
                    Zmazat
                </a>

                <a href="?c=images&a=edit&id=<?php echo $image->getId() ?>" class="btn btn-warning">
                    Upraviť
                </a>
            <?php } ?>
        </div>
    <?php } ?>

