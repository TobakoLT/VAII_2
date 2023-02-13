<?php
//$layout = 'auth';
/** @var User[] $data */

/** @var \App\Core\IAuthenticator $auth */

use App\Models\User;

?>
<?php if ($auth->isLogged()) { ?>

<div class="container rounded bg-white mt-5 mb-5 border border-dark">
    <div class="row">
            <div class="col-md-4 border-right">
                <form method="post" action="?c=auth&a=store" enctype="multipart/form-data">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <div class="img-fluid">
                        <img data-toggle="tooltip"
                             title="Vašu profilovú fotku si môžete zmeniť kliknutím na foktu a následným Uložením zmien."
                             class="rounded-circle mt-5 mb-2"
                             style="object-fit: cover; width: 200px; height: 200px; margin: 0 auto; display: block;"
                             id="account_pic"
                             src="<?php echo $_SESSION["user"]->getAccountImg() ?>"
                             alt="Vaša fotka je zatial prázdna.">
                    </div>
                    <span class="font-weight-bold"><?php echo $_SESSION["user"]->getMeno() ?></span>
                    <span class="text-black-50"><?php echo $_SESSION["user"]->getEmail() ?></span>
                    <input type="file" name="photo" id="photo" style="display: none">
                    <div class="text-danger" id="img-input-error"></div>
                    <span> </span>
                </div>
            </div>
            <div class="col-md-5 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Profile Settings</h4>
                        <?php if ($_SESSION["user"]->getAdmin()) { ?>
                            <h6 class="text-danger fw-bold text-decoration-underline">Účet administrátora</h6>
                        <?php } ?>
                    </div>

                    <div class="row mt-5">
                        <div class="col-md-12"><label class="labels">Používateľské meno</label>
                            <input type="text" class="form-control" placeholder="" id="username" name="username"
                                   value="<?php echo $_SESSION["user"]->getUsername() ?>" minlength="4" maxlength="25"
                                   required></div>
                        <input type="hidden" id="sessionUsername"
                               value="<?php echo $_SESSION["user"]->getUsername() ?>">
                        <div id="username_response" class="form-error"></div>

                        <div class="col-md-12"><label class="labels">Email</label>
                            <input type="email" class="form-control" placeholder="" id="email" name="email"
                                   value="<?php echo $_SESSION["user"]->getEmail() ?>" minlength="5" maxlength="30"
                                   required></div>
                        <input type="hidden" id="sessionEmail" value="<?php echo $_SESSION["user"]->getEmail() ?>">
                        <div id="email_response" class="form-error"></div>

                        <div class="col-md-12"><label class="labels">Celé meno</label>
                            <input type="text" class="form-control" placeholder="" id="meno" name="meno"
                                   value="<?php echo $_SESSION["user"]->getMeno() ?>" minlength="5" maxlength="20"
                                   required></div>
                        <div id="meno_response" class="form-error"></div>
                        <div class="col-md-12"><label class="labels">Heslo</label>
                            <input type="password" class="form-control" placeholder="Heslo" id="password"
                                   name="password" minlength="8" maxlength="30"></div>
                        <div id="password_response" class="form-error"></div>

                        <div class="col-md-12"><label class="labels">Zopakuj heslo</label>
                            <input type="password" class="form-control" placeholder="Zopakuj heslo" id="password2"
                                   name="password2"
                                   maxlength="30">

                            <div id="passwords_response" class="form-error"></div>
                            <div class="password-strength-indicator mt-2" id="password-strength-indicator">
                                <div class="strength"></div>
                            </div>

                            <input type="hidden" name="form_name" value="profile_form">
                        </div>
                        <div class="mt-4 text-center">
                            <button class="btn btn-primary profile-button" type="submit" name="submit" id="myButton">
                                Save Profile
                            </button>
                            <button class="btn btn-danger delete-profile"
                                    data-id="<?php echo $_SESSION["user"]->getId() ?>">Zmazať
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </div>

    <?php } else { ?>
        <div class="alert alert-danger text-center" role="alert">
            Najprv sa musíte prihlásiť.
        </div>
    <?php } ?>

    <script>
        inputToImg();
        viewInputToImg();
        tooltip();
        defaultAccImg();
        profileDeleteConfirm();
        registerHandler();
        passwordStrength();
        imageInput2();
    </script>

