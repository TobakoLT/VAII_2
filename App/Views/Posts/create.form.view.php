<div class="row mb-2 g-2">
    <div class="col-lg-6 p-0 box">

        <form method="post" action="?c=posts&a=store" class="mb-md-3 border border-white border-2 rounded mb-2 bg-color-white"
              enctype="multipart/form-data">

            <?php /** @var \App\Models\Post $data */
            if ($data->getId()) { ?>
                <input type="hidden" name="id" value="<?php echo $data->getId() ?>">
            <?php } ?>
            <label>Meno autora:
                <input class="rounded" size="120%" type="text" name="autor" value="<?php echo $data->getAutor() ?>">
            </label>
            <label>Nadpis:
                <input required class="rounded" size="120%" type="text" name="nadpis" value="<?php echo $data->getNadpis() ?>">
            </label>
            <label>Text clánku:
                <input required class="rounded" size="120%" type="text" name="clanok" value="<?php echo $data->getClanok() ?>">
            </label>
            <label>Obrázok:
                <input class="rounded" size="120%" type="url" name="obrazok" value="<?php echo $data->getObrazok() ?>">
            </label>
            <input class="rounded mt-1" type="submit" value="Odoslať">
        </form>

    </div>
</div>