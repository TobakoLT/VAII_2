<?php /** @var \App\Models\Post $data */ ?>

<div class="row mb-2 g-2">
    <div class="col-lg-6 p-0 box">

        <form method="post" action="?c=posts&a=store"
              class="mb-md-3 border border-white border-2 rounded mb-2 bg-color-white"
              enctype="multipart/form-data">

            <?php if ($data->getId()) { ?>
                <input type="hidden" name="id" value="<?php echo $data->getId() ?>">
            <?php } ?>

            <div class="mb-3">
                <label for="FormName" class="form-label">Meno autora</label>
                <input type="text" style="font-weight: bold" class="form-control" id="FormName"
                       value="<?php echo $_SESSION["user"]->getMeno() ?>" readonly>
            </div>

            <label>Nadpis:
                <input class="form-control" size="120%" type="text" name="nadpis"
                       value="<?php echo $data->getNadpis() ?>" minlength="10" maxlength="50" required>
            </label>

            <label>Text clánku:
                <input class="rounded form-control" size="120%" type="text" name="clanok"
                       value="<?php echo $data->getClanok() ?>" required minlength="100" maxlength="1000">
            </label>

            <label>Obrázok:
                <input class="rounded" size="120%" type="file" name="photo" id="photo">
            </label>
            <input class="rounded mt-1" type="submit" value="Odoslať">
        </form>

    </div>
</div>