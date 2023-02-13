<a href="?c=images" class="btn btn-secondary">Naspäť</a>
<div class="container my-5 pt-3 bg-white rounded border border-dark">
    <h1 class="text-center">Pridaj obrázok</h1>
    <form method="post" action="?c=images&a=store"
          enctype="multipart/form-data">

        <?php /** @var \App\Models\Image $data */
        if ($data->getId()) { ?>
            <input type="hidden" name="id" value="<?php echo $data->getId() ?>">
        <?php } ?>
        <div>
            <label class="form-label">Obrázok:</label>
            <div class="text-danger" id="img-input-error"></div>
            <input class="form-control" formenctype="multipart/form-data" type="file" id="photo" name="photo">
        </div>
        <div class="pt-2">
            <label class="form-label">Popis:</label>
            <input class="form-control" type="text" name="text" value="<?php echo $data->getText() ?>">
        </div>
        <div class="d-flex justify-content-center">
            <button id="myButton" type="submit" class="btn btn-dark my-3">Odoslať</button>
        </div>
    </form>
</div>

<script>
    imageInput2();
</script>