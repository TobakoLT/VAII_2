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
*/
function passwordStrengthOld() {
    const passwordInput = document.getElementById('password');
    const passwordStrengthIndicator = document.getElementById('password-strength-indicator');

function imageInput() {
    const input = document.getElementById("photo");
    input.addEventListener("change", function () {
        const file = input.files[0];
        const allowedExtensions = [".jpg", ".jpeg", ".png", ".gif", "webp"];
        const extension = file.name.slice(file.name.lastIndexOf(".") + 1);
        if (!allowedExtensions.includes(extension)) {
            alert("Nepodporovaný typ súboru! Prosím vyberte obrázok (JPG, JPEG, PNG, GIF alebo WEBP! )");
        } else {

    function checkPasswordStrength() {
        const password = passwordInput.value;
        const strengthRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");
        const mediumRegex = new RegExp("^(?=.{8,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");

function imageInput2() {
    const input = document.getElementById("photo");
    const errorDiv = document.getElementById("img-input-error");
    input.addEventListener("change", function () {
        if (!input.files[0]) {
            errorDiv.innerHTML = "";
            document.getElementById("myButton").disabled = false;
        } else {
            if (mediumRegex.test(password)) {
                passwordStrengthIndicator.innerHTML = '<div class="strength medium">Stredne silné</div>'
            } else {
                passwordStrengthIndicator.innerHTML = '<div class="strength weak">Slabé</div>'
            }
        }
    }
}

function passwordStrengthNew() {
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

function passwordStrengthGradient() {
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

        if (strengthRegex.test(password)) {
            // Silné
            passwordStrengthIndicator.classList.remove("weak", "medium");
            passwordStrengthIndicator.classList.add("strong");
            passwordStrengthIndicator.parentElement.style.backgroundSize = "100% 100%"; /* zobrazí sa pozadie pre silné heslo */
        } else {
            const mediumRegex = new RegExp(
                "^(?=.{8,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$",
                "g"
            );

            if (mediumRegex.test(password)) {
                // Stredne silné
                passwordStrengthIndicator.classList.remove("weak", "strong");
                passwordStrengthIndicator.classList.add("medium");
                passwordStrengthIndicator.parentElement.style.backgroundSize = "50% 100%";
            } else {
                // Slabé
                passwordStrengthIndicator.classList.remove("medium", "strong");
                passwordStrengthIndicator.classList.add("weak");
                passwordStrengthIndicator.parentElement.style.backgroundSize = "25% 100%";
            }
        }
    }
}

async function loginUserX() {
    // Získame hodnoty z formulára pre používateľské meno a heslo
    var username = $('#username').val();
    var password = $('#password').val();

    // Vytvoríme objekt s požiadavkou na server
    try {
        const data = await $.ajax({
            url: '?c=auth&a=loginUser',
            method: 'POST',
            dataType: 'json',
            data: {username, password},
        });

        // Ak bolo prihlásenie úspešné, presmerujeme používateľa na domovskú stránku
        if (data.success) {
            window.location.replace("?c=home");
        } else {
            // Ak nebolo prihlásenie úspešné, zobrazíme chybovú hlášku
            $('#error-message').text(data.message);
        }
    } catch (error) {
        console.error('Error:', error);
    }
}

async function loginUser() {
    // Získame hodnoty z formulára pre používateľské meno a heslo
    const username = document.querySelector('#username').value;
    const password = document.querySelector('#password').value;

    // Vytvoríme objekt s požiadavkou na server
    try {
        const response = await fetch(`?c=auth&a=loginUser&password=${password}&username=${username}`, {
            method: 'POST'
        });

        const data = await response.json();

        // Ak bolo prihlásenie úspešné, presmerujeme používateľa na domovskú stránku
        if (data.success) {
            window.location.href='?c=home';
        } else {
            // Ak nebolo prihlásenie úspešné, zobrazíme chybovú hlášku
            document.querySelector('#error-message').textContent = data.message;
        }
    } catch (error) {
        console.error('Error:', error);
    }
}




