<?php
use App\Models\ForumTheme;
/** @var \App\Core\IAuthenticator $auth */
/** @var ForumTheme[] $data */
?>
<div class="container my-5 bg-white rounded">
    <h1 class="text-center">Témy fóra</h1>
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-header">
                    <h5>Téma 1</h5>
                </div>
                <div class="card-body">
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.</p>
                    <a href="#" class="btn btn-primary">Zobraziť tému</a>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    <h5>Téma 2</h5>
                </div>
                <div class="card-body">
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.</p>
                    <a href="#" class="btn btn-primary">Zobraziť tému</a>
                </div>
            </div>
            <div class="col-md-4">
                <button class="btn btn-primary my-3" href="?c=forumPosts&a=forumposts">Pridať tému</button>
                <a class="nav-link active menu-button rounded" href="?c=forumPosts&a=posts">FÓRUM</a>
            </div>
        </div>
    </div>

