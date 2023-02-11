<?php
use App\Models\Post;
/** @var \App\Core\IAuthenticator $auth */
/** @var Post[] $data */
?>

<?php if($auth->isLogged()) {?>
<div class="me-auto">

    <a href="?c=posts&a=create"
       class="mb-md-3 border border-dark border-2 rounded mb-2 bg-color btn">
        Pridaj clanok
    </a>

</div>
<?php } ?>
<div class="row mb-2 g-2 ">
<?php
foreach ($data as $post) {
?>
<div class="card col-lg-4 p-0 box">
    <div class="card-body">
        <h3 class="card-title"> <a class="clanok1"></a><?php echo $post->getNadpis() ?></h3>
        <p class="card-text"><?php echo $post->getAutor() ?></p>
        <p class="card-text p-index"><?php echo $post->getDatum() ?></p>
        <p class="card-text p-index"><?php echo $post->getClanok() ?></p>
        <img src="<?php echo $post->getObrazok() ?>" alt="" class="image-mask w-100 mb-0 rounded img-fluid">

        <?php if($auth->isLogged()) {?>
        <a href="?c=posts&a=delete&id=<?php echo $post->getId() ?>" class="btn btn-danger">
            Zmazať
        </a>

        <a href="?c=posts&a=edit&id=<?php echo $post->getId() ?>" class="btn btn-warning">
            Upraviť
        </a>
        <?php } ?>
    </div>
</div>
<?php } ?>