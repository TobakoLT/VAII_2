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

<div class="containerX row mb-2 border-img">
    <?php
    foreach ($data as $image) {
        ?>
        <div class="card-body col-md-4">
            <div class="image-container card m-1">
                <div class="card-img image border border-white border-2 rounded mb-1">
                    <?php if ($image->getImg()) { ?>
                        <img src="<?php echo $image->getImg() ?>" alt="moto1" class="image-mask w-100 mb-0 rounded img-fluid">
                    <?php } ?>
                </div>

                <?php if ($image->getText()) { ?>
                <p class="card-title mx-auto card-text">
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
        </div>
    <?php } ?>
    <!-- The Modal -->
    <div class="popup-image">
        <span>&times</span>
        <img src="" alt="">
    </div>
    <script>
        modal();
    </script>
</div>


