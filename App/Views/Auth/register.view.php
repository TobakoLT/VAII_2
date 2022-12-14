<?php
$layout = 'auth';
/** @var Array $data */
?>

<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <h5 class="card-title text-center">Registrácia</h5>
                    <div class="text-center text-danger mb-3">
                        <?= @$data['message'] ?>
                    </div>
                    <form method="post" class="form-signin" action="?c=auth&a=store">
                        <div class="form-label-group">
                            <label for="username">Používateľské meno</label>
                            <input type="text" id="username" name="username" class="form-control" placeholder="Používateľské meno" required autofocus>

                        </div>
                        <div class="form-label-group mt-2">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="example@mail.com" required>

                        </div>
                        <div class="form-label-group mt-2">
                            <label for="meno">Celé meno</label>
                            <input type="text" id="meno" name="meno" class="form-control" placeholder="Janko Hraško" required>

                        </div>
                        <div class="form-label-group mt-2">
                            <label for="password">Heslo</label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Heslo" required>

                        </div>
                        <div class="form-label-group">
                            <input type="password" id="password2" name="password2" class="form-control mt-1" placeholder="Zopakovať heslo" required>
                        </div>
                        <div class="password-strength-indicator mt-2" id="password-strength-indicator">
                            <div class="strength"></div>
                        </div>
                        <button class="btn btn-lg btn-primary btn-block mt-3" type="submit" name="submit">Registrovať</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    passwordStrengthNew()
</script>