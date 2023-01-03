<div class="row mb-2 g-2">
    <div class="col-lg-6 p-0 box">

        <form method="post" action="?c=posts&a=store" class="mb-md-3 border border-white border-2 rounded mb-2 bg-color-white"
              enctype="multipart/form-data">

            <?php /** @var \App\Models\Post $data */
            if ($data->getId()) { ?>
                <input type="hidden" name="id" value="<?php echo $data->getId() ?>">
            <?php } ?>

            <div class="mb-3">
                <label for="FormName" class="form-label">Meno autora</label>
                <input type="text" class="form-control" id="FormName" value="<?php echo $data->getAutor() ?>">
            </div>

            <label>Nadpis:
                <input class="form-control" required size="120%" type="text" name="nadpis" value="<?php echo $data->getNadpis() ?>">
            </label>

            <label>Text clánku:
                <input required class="rounded form-control" size="120%" type="text" name="clanok" value="<?php echo $data->getClanok() ?>">
            </label>

            <label>Obrázok:
                <input class="rounded" size="120%" type="url" name="obrazok" value="<?php echo $data->getObrazok() ?>">
            </label>
            <input class="rounded mt-1" type="submit" value="Odoslať">
        </form>

    </div>
</div>