<?php
$layout = 'auth';
/** @var Array $data */
?>
<button class="btn btn-secondary" onclick="window.location.href='?c=auth&a=login'">Prihlásenie</button>
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
                        <div>
                            <label for="username">Používateľské meno</label>
                            <input type="text" id="username" name="username" class="form-control"
                                   placeholder="Používateľské meno" minlength="4" maxlength="25" required autofocus>
                            <div id="username_response" class="form-error"></div>

                        </div>
                        <div class="mt-2">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control"
                                   placeholder="example@mail.com" maxlength="30" required>
                            <div id="email_response" class="form-error"></div>
                        </div>
                        <div class="mt-2">
                            <label for="meno">Celé meno</label>
                            <input type="text" id="meno" name="meno" class="form-control" placeholder="Meno Priezvisko"
                                   minlength="4" maxlength="20" required>
                            <div id="meno_response" class="form-error"></div>
                        </div>
                        <div class="mt-2">
                            <label for="password">Heslo</label>
                            <input type="password" id="password" name="password" class="form-control"
                                   placeholder="Heslo" minlength="8" maxlength="30" required>
                            <div id="password_response" class="form-error"></div>
                        </div>
                        <div>
                            <input type="password" id="password2" name="password2" class="form-control mt-1"
                                   placeholder="Zopakovať heslo" maxlength="30" required>
                            <div id="passwords_response" class="form-error"></div>
                        </div>
                        <div class="password-strength-indicator mt-2" id="password-strength-indicator">
                            <div class="strength"></div>
                            <input type="hidden" name="form_name" value="register_form">
                        </div>
                        <div class="d-flex justify-content-center">
                            <button id="myButton" class="btn btn-lg btn-dark btn-block mt-3" type="submit"
                                    name="submit">Registrovať
                            </button>
                            <div
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    passwordStrength();
    registerHandler();


</script>

