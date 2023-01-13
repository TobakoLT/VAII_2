<button class="btn btn-secondary" onclick="window.location.href='?c=forumThemes&a=themes'">Prihlásenie</button>
<div class="container bg-white p-5 rounded">
    <h2>Vytvorte novú tému.</h2>
    <form action="?c=forumThemes&a=store" method="post" enctype="multipart/form-data">
        <?php /** @var \App\Models\ForumTheme $data */
        if ($data->getId()) { ?>
            <input type="hidden" name="id" value="<?php echo $data->getId() ?>">
        <?php } ?>
        <div class="form-group row">
            <label for="title" class="col-12 col-md-3 col-form-label">Názov</label>
            <div class="col-12 col-md-9">
                <input type="text" class="form-control" id="title" placeholder="Zadajte názov" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="description" class="col-12 col-md-3 col-form-label">Popis</label>
            <div class="col-12 col-md-9 mt-1">
                <textarea class="form-control" id="description" rows="3" placeholder="Krátky popis čím sa daná téma zaoberá"></textarea>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-12 text-end mt-2">
                <button type="submit" class="btn btn-primary btn-dark" name="submit">Vytvoriť tému</button>
            </div>
        </div>
    </form>
</div>

