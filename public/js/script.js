function modal() {
    document.querySelectorAll('.image-container img').forEach(image => {
        image.onclick = () => {
            document.querySelector('.popup-image').style.display = 'block';
            document.querySelector('.popup-image img').src = image.getAttribute('src');
        }
    });

    document.querySelector('.popup-image').onclick = () => {
        document.querySelector('.popup-image').style.display = 'none';
    }
}

function displayConductModal() {
    if (sessionStorage.getItem("conduct") !== "true") {
        $(document).ready(function () {
            $('#myModal').modal({
                backdrop: 'static',
                keyboard: false
            });
            $('#myModal').modal('show');
        });
    }

    $('#agree').click(function () {
        $('#myModal').modal('hide');
        sessionStorage.setItem("conduct", "true");
    });

}

function imageInput() {
    const input = document.getElementById("photo");
    input.addEventListener("change", function () {
        const file = input.files[0];
        const allowedExtensions = [".jpg", ".jpeg", ".png", ".gif", "webp"];
        const extension = file.name.slice(file.name.lastIndexOf(".") + 1);
        if (!allowedExtensions.includes(extension)) {
            alert("Nepodporovaný typ súboru! Prosím vyberte obrázok (JPG, JPEG, PNG, GIF alebo WEBP! )");
        } else {

        }
    });
}

function imageInput2() {
    const input = document.getElementById("photo");
    const errorDiv = document.getElementById("img-input-error");
    input.addEventListener("change", function () {
        if (!input.files[0]) {
            errorDiv.innerHTML = "";
            document.getElementById("myButton").disabled = false;
        } else {
            const file = input.files[0];
            const allowedExtensions = [".jpg", ".jpeg", ".png", ".gif", ".webp", ".jfif"];
            const extension = file.name.slice(file.name.lastIndexOf("."));
            if (!allowedExtensions.includes(extension)) {
                errorDiv.innerHTML = "Nepodporovaný typ súboru! Prosím vyberte obrázok!";
                document.getElementById("myButton").disabled = true;
            } else {
                errorDiv.innerHTML = "";
                document.getElementById("myButton").disabled = false;
            }
        }
    });
}

function toggleImage(imageId) {
    let image = document.getElementById(imageId);
    let showButton = document.querySelector("button.spoiler-button[data-target='" + imageId + "']")
    let hideButton = document.querySelector("button.hide-spoiler-button[data-target='" + imageId + "']")
    if (image.style.display === "block") {
        image.style.display = "none";
        showButton.style.display = "block";
        hideButton.style.display = "none";
    } else {
        image.style.display = "block";
        showButton.style.display = "none";
        hideButton.style.display = "block";
    }
}

async function themeDeleteConfirm() {
    $(document).on('click', '.delete-theme', function () {
        var themeId = $(this).data('id');
        var confirm = window.confirm("Ste si istý, že chcete vymazať túto tému?");
        if (confirm) {
            var input = prompt("Zadajte 'admin' pre potvrdenie vymazania témy", "");
            if (input === "admin") {
                $.ajax({
                    type: 'POST',
                    url: '?c=forumThemes&a=delete',
                    data: {id: themeId},
                    success: function (data) {
                        alert("Téma bola úspešne vymazaná");
                        $("#theme-" + themeId).fadeOut(1000);
                    },
                    error: function (data) {
                        alert("Chyba pri mazaní témy");
                    }
                });
            } else {
                alert("Nesprávne heslo, téma nebola vymazaná");
            }
        }
    });
}

async function profileDeleteConfirm() {
    $(document).on('click', '.delete-profile', function () {
        var profileId = $(this).data('id');
        var confirm = window.confirm("Ste si istý, že chcete vymazať tento profil?");
        if (confirm) {
            $.ajax({
                type: 'POST',
                url: '?c=auth&a=delete',
                data: {id: profileId},
                success: function (data) {
                    alert("Profil bol úspešne vymazaný");
                    window.location.href = "?c=auth&a=login"
                },
                error: function (data) {
                    alert("Chyba pri mazaní profilu");
                }
            });
        }
    });
}


function tooltip() {
    $(document).ready(function () {
        $('#account_pic').tooltip();
    });
}

function inputToImg() {
    document.getElementById("account_pic").addEventListener("click", function () {
        document.getElementById("photo").click();
    });
}

function viewInputToImg() {
    document.getElementById("photo").addEventListener("change", function () {
        var file = this.files[0];
        var reader = new FileReader();

        reader.addEventListener("load", function () {
            // Nastavenie atribútu "src" elementu "img" na načítaný obrázok
            document.getElementById("account_pic").src = this.result;
        });

        reader.readAsDataURL(file);
    });
}

function defaultAccImg() {
    var image = document.getElementById("account_pic");
    image.onerror = function () {
        this.src = "public/images/defaultAccImg.webp";
    }
}

function passwordStrength() {
    const passwordInput = document.getElementById("password");
    const passwordStrengthIndicator = document.querySelector(
        ".password-strength-indicator .strength"
    );

    passwordInput.addEventListener("input", updatePasswordStrength);

    function updatePasswordStrength() {
        const password = passwordInput.value;
        const strengthRegex = new RegExp(
            "^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$",
            "g"
        );
        const mediumRegex = new RegExp(
            "^(?=.{8,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$",
            "g"
        );
        if (password === "") {
            passwordStrengthIndicator.classList.remove("weak", "medium", "strong");
        } else {
            if (strengthRegex.test(password)) {
                // Silné
                passwordStrengthIndicator.classList.remove("weak", "medium");
                passwordStrengthIndicator.classList.add("strong");
            } else {

                if (mediumRegex.test(password)) {
                    // Stredne silné
                    passwordStrengthIndicator.classList.remove("weak", "strong");
                    passwordStrengthIndicator.classList.add("medium");
                } else {
                    // Slabé
                    passwordStrengthIndicator.classList.remove("medium", "strong");
                    passwordStrengthIndicator.classList.add("weak");
                }
            }
        }
    }
}

async function loginUserCheck() {
    const username = document.querySelector('#username').value;
    const password = document.querySelector('#password').value;

    try {
        const response = await fetch(`?c=auth&a=loginUserCheck&password=${password}&username=${username}`, {
            method: 'POST'
        });

        const data = await response.json();

        if (data.success) {
        } else {
            document.querySelector('#error-message').textContent = data.message;
        }
    } catch (error) {
        console.error('Error:', error);
    }
}

async function registerUsernameCheck(usernameInput) {
    $("#" + usernameInput).keyup(debounce(async function () {
        var username = $(this).val();
        if (!username) {
            $("#username_response").html("");
            return;
        }
        $("#username_response").html("...");
        var sessionUsername = $("#sessionUsername").val();
        if (username) {
            if (username.length < 4) {
                $("#username_response").text("Používateľské meno musí mať aspoň 4 znaky");
                return;
            }
            var response = await fetch('?c=auth&a=registerUsernameCheck', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: `username=${encodeURIComponent(username)}`
            });
            var data = await response.json();
            if (data.taken && username !== sessionUsername) {
                $("#username_response").text("Používateľské meno je obsadené");
                document.getElementById("myButton").disabled = true;
            } else if (!/^[a-zA-Z0-9]+$/.test(username)) {
                $("#username_response").text("Používateľské meno môže obsahovať iba písmená a čísla");
            } else {
                $("#username_response").text("");
                document.getElementById("myButton").disabled = false;
            }
        }
    }, 500));
}

async function registerEmailCheck(emailInput) {
    $("#" + emailInput).keyup(debounce(async function () {
        var email = $(this).val();
        if (!email) {
            $("#email_response").html("");
            return;
        }
        $("#email_response").html("...");
        var sessionEmail = $("#sessionEmail").val();
        var response = await fetch('?c=auth&a=registerEmailCheck', {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: `email=${encodeURIComponent(email)}`
        });
        var data = await response.json();
        if (data.taken && email !== sessionEmail) {
            $("#email_response").html("E-mailová adresa je už zaregistrovaná");
        } else {
            if (data.notValid) {
                $("#email_response").html("Zadaná e-mailová adresanie nie je validná");
            } else if (email === sessionEmail) {
                $("#email_response").html("Vaša e-mailová adresa je už zaregistrovaná");
            } else {
                $("#email_response").html("");
            }
        }
    }, 500));
}

function registerNameCheck(nameInput) {
    $("#" + nameInput).keyup(function () {
        const name = $("#" + nameInput).val();
        if (name !== "" && name.length < 4) {
            $('#meno_response').text('Meno musí mať viac ako 4 znaky');
        } else if (name !== "" && name.length > 20) {
            $('#meno_response').text('Meno nesmie mať viac ako 20 znakov');
        } else if (name !== "" && !/^[a-zA-Z\sÁáČčĎďÉéĚěÍíŇňÓóŘřŠšŤťÚúŮůÝýŽž]+$/.test(name)) {
            $('#meno_response').text('Meno môže obsahovať len písmená');
        } else {
            $('#meno_response').text('');
        }
    });
}

function registerPasswordLengthCheck(passwordInput) {
    $("#" + passwordInput).keyup(function () {
        const password = $("#" + passwordInput).val();
        if (password !== "" && password.length < 8) {
            $('#password_response').text('Zadané heslo je príliš krátke');
        } else {
            $('#password_response').text('');
        }
    });
}

function registerPasswordsCheck() {
    const password = $("#password").val();
    const password2 = $("#password2").val();
    if (password !== password2) {
        $('#passwords_response').text('Zadané heslá sa nezhodujú');
        document.getElementById("myButton").disabled = true;
    } else {
        $('#passwords_response').text('');
        document.getElementById("myButton").disabled = false;
    }
}

function registerHandler() {
    $(document).ready(function () {
        registerUsernameCheck("username");
    });
    $(document).ready(function () {
        registerEmailCheck("email");
    });
    $(document).ready(function () {
        registerNameCheck("meno");
    });
    $(document).ready(function () {
        registerPasswordLengthCheck("password");
    });
    $(document).ready(function () {
        $("#password").keyup(function () {
            registerPasswordsCheck();
        });
        $("#password2").keyup(function () {
            registerPasswordsCheck();
        });
    });
}

function debounce(fn, wait) {
    let timeout;
    return function () {
        clearTimeout(timeout);
        timeout = setTimeout(() => fn.apply(this, arguments), wait);
    };
}



