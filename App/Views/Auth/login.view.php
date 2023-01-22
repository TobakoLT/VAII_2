<?php
$layout = 'auth';
/** @var Array $data */
?>
<button class="btn btn-secondary" onclick="window.location.href='?c=home'">Domov</button>
<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <h5 class="card-title text-center">Prihlásenie</h5>
                    <div class="text-center text-danger mb-3">

                    </div>
                    <form class="form-signin">
                        <div class="form-label-group mb-3">
                            <input name="username" type="text" id="username" class="form-control" placeholder="Login"
                                   minlength="4" maxlength="25" required autofocus>
                        </div>

                        <div class="form-label-group mb-3">
                            <input name="password" type="password" id="password" class="form-control"
                                   placeholder="Password" minlength="8" maxlength="30" required>
                        </div>
                        <div class="text-center text-danger mb-3" id="error-message"></div>
                        <div class="text-center">
                            <button class="btn btn-primary" type="submit" onclick="loginUser()" name="submit">Prihlásiť
                            </button>
                        </div>
                        <div class="form-group text-center mt-3">
                            <p>Nemáte účet? <a href="?c=auth&a=register" class="">Zaregistrujte sa teraz!</a></p>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
