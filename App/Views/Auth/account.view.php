<?php
//$layout = 'auth';
/** @var User[] $data */
/** @var \App\Core\IAuthenticator $auth */

use App\Models\User;

?>
<?php if ($auth->isLogged()) { ?>

<div class="container w-50 rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-4 border-right">
            <form method="post" action="?c=auth&a=store"
                  enctype="multipart/form-data">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <div class="img-fluid">
                <img data-toggle="tooltip"  title="Vašu profilovú fotku si môžete zmeniť kliknutím na foktu a následným Uložením zmien."
                     class="rounded-circle mt-5 mb-2" width="200px" style="object-fit: cover; width: 200px; height: 200px; margin: 0 auto; display: block;" id="account_pic"
                     src="<?php echo $_SESSION["user"]->getAccountImg() ?>" alt="Vaša fotka je zatial prázdna.">
                </div>
                <span class="font-weight-bold"><?php echo $_SESSION["user"]->getMeno() ?></span>
                <span class="text-black-50"><?php echo $_SESSION["user"]->getEmail() ?></span>
                <input type="file" name="photo" id="photo" style="display: none">
                <span> </span>
            </div>
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Profile Settings</h4>
                </div>
                <div class="row mt-5">
                    <div class="col-md-12"><label class="labels">Používateľské meno</label>
                        <input type="text" class="form-control" placeholder="" id="username" name="username"value="<?php echo $_SESSION["user"]->getUsername() ?>"></div>
                    <div class="col-md-12"><label class="labels">Email</label>
                        <input type="text" class="form-control" placeholder="" id="email" name="email"value="<?php echo $_SESSION["user"]->getEmail() ?>"></div>
                    <div class="col-md-12"><label class="labels">Celé meno</label>
                        <input type="text" class="form-control" placeholder="" id="meno" name="meno"value="<?php echo $_SESSION["user"]->getMeno() ?>"></div>
                    <div class="col-md-12"><label class="labels">Heslo</label>
                        <input type="password" class="form-control" placeholder="Heslo" id="password" name="password" minlength="3" maxlength="30"></div>
                    <div class="col-md-12"><label class="labels">Zopakuj heslo</label>
                        <input type="password" class="form-control" placeholder="" id="password2" name="password2" maxlength="30"></div>
                    <input type="hidden" name="form_name" value="profile_form">
                </div>
                <div class="mt-4 text-center"><button class="btn btn-primary profile-button" type="submit" name="submit">Save Profile</button>
                    <a href="?c=auth&a=delete&id=<?php echo $_SESSION["user"]->getId() ?>" class="btn btn-danger">
                        Zmazať
                    </a></div>

            </div>
        </div>
    </form>
    </div>
</div>

<?php } else {?>
    <div class="alert alert-danger text-center" role="alert">
        Najprv sa musíte prihlásiť.
    </div>
<?php } ?>
<script>
    inputToImg();
    viewInputToImg();
    tooltip();
</script>

