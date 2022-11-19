<div class="row mb-2 g-2">
    <div class="col-lg-6 p-0 box">

<form method="post" action="?c=posts&a=store" class="mb-md-3 border border-white border-2 rounded mb-2 bg-color-white"
      enctype="multipart/form-data">
      <?php /** @var \App\Models\Post $data */
      if ($data->getId()) { ?>
      <input type="hidden" name="id" value="<?php echo $data->getId() ?>">
    <?php } ?>
    <label>Zadaj URL adresu obrázka:
        <input class="rounded" size="100%" type="url" name="img" value="<?php echo $data->getImg() ?>">
    </label>
    <input class="rounded" type="submit" value="Odoslať">
</form>

</div>
</div>