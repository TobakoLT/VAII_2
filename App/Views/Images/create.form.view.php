<div class="row mb-2 g-2">
    <div class="col-lg-6 p-0 box">

<form method="post" action="?c=images&a=store" class="mb-md-3 border border-white border-2 rounded mb-2 bg-color-white"
      enctype="multipart/form-data">

      <?php /** @var \App\Models\Image $data */
      if ($data->getId()) { ?>
      <input type="hidden" name="id" value="<?php echo $data->getId() ?>">
    <?php } ?>
    <label for="photo" class="form-label">Obrázok:</label>
    <input class="form-control" formenctype="multipart/form-data" type="file" id="photo" name="photo">
    <label>Zadaj popis k obrázku:
        <input class="rounded" size="" type="text" name="text" value="<?php echo $data->getText() ?>">
    </label>
    <input class="rounded mt-1" type="submit" value="Odoslať">
</form>

</div>
</div>

<script>
    imageInput();
</script>