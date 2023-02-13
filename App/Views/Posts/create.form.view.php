<?php /** @var \App\Models\Post $data */ ?>

<a href="?c=posts" class="btn btn-secondary">Naspäť</a>
<div class="container my-5 pt-3 bg-white rounded border border-dark">
    <h1 class="text-center">Pridaj článok</h1>
    <form method="post" action="?c=posts&a=store" enctype="multipart/form-data">

        <?php if ($data->getId()) { ?>
            <input type="hidden" name="id" value="<?php echo $data->getId() ?>">
        <?php } ?>

        <div class="form-group">
            <label for="FormName" class="form-label">Meno autora:</label>
            <input type="text" style="font-weight: bold" class="form-control" id="FormName"
                   value="<?php echo $_SESSION["user"]->getMeno() ?>" disabled>
        </div>
        <div class="form-group">
            <label class="form-label">Nadpis:</label>
            <input class="form-control" type="text" name="nadpis"
                   value="<?php echo $data->getNadpis() ?>" minlength="10" maxlength="50" required>
        </div>
        <div class="form-group pt-2">
            <label>Text článku:</label>
            <textarea class="rounded form-control" rows="7" cols="50" name="clanok" required minlength="100"
                      maxlength="1000"><?php echo $data->getClanok() ?></textarea>
        </div>
        <div class="form-group pt-3">
            <label>Obrázok:</label>
            <div class="text-danger" id="img-input-error"></div>
            <input class="form-control rounded" formenctype="multipart/form-data" type="file" name="photo" id="photo">
        </div>
        <div class="form-group d-flex justify-content-center">
            <button id="myButton" type="submit" class="btn btn-dark my-3">Odoslať</button>
        </div>
    </form>

</div>


<script>
    imageInput2();
</script>