<?php
//$layout = 'auth';
/** @var Array $data */
/** @var \App\Core\IAuthenticator $auth */
?>
<?php if ($auth->isLogged()) { ?>
<div class="container w-50 rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-4 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                <span class="font-weight-bold">Edogaru</span>
                <span class="text-black-50">edogaru@mail.com.my</span>
                <button class="btn btn-primary mt-3" id="change-photo-button">Zmeň fotku</button>
                <span> </span>
            </div>
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Profile Settings</h4>
                </div>
                <div class="row mt-5">
                    <div class="col-md-12"><label class="labels">Username</label>
                        <input type="text" class="form-control" placeholder="enter phone number" value=""></div>
                    <div class="col-md-12"><label class="labels">Email</label>
                        <input type="text" class="form-control" placeholder="enter address line 1" value=""></div>
                    <div class="col-md-12"><label class="labels">Celé meno</label>
                        <input type="text" class="form-control" placeholder="enter address line 2" value=""></div>
                    <div class="col-md-12"><label class="labels">Heslo</label>
                        <input type="text" class="form-control" placeholder="enter address line 2" value=""></div>
                    <div class="col-md-12"><label class="labels">Zopakuj heslo</label>
                        <input type="text" class="form-control" placeholder="enter address line 2" value=""></div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-6"><label class="labels">Country</label><input type="text" class="form-control" placeholder="country" value=""></div>
                    <div class="col-md-6"><label class="labels">State/Region</label><input type="text" class="form-control" value="" placeholder="state"></div>
                </div>
                <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="button">Save Profile</button></div>
            </div>
        </div>

    </div>
</div>
<?php } else {?>
    <div class="alert alert-danger text-center" role="alert">
        Najprv sa musíte prihlásiť.
    </div>
<?php } ?>


