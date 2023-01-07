function modal() {
    document.querySelectorAll('.image-container img').forEach(image =>{
        image.onclick = () => {
            document.querySelector('.popup-image').style.display = 'block';
            document.querySelector('.popup-image img').src = image.getAttribute('src');
        }
    });


    document.querySelector('.popup-image').onclick = () =>{
        document.querySelector('.popup-image').style.display = 'none';
    }

}

function passwordStrengthOld() {
    const passwordInput = document.getElementById('password');
    const passwordStrengthIndicator = document.getElementById('password-strength-indicator');

    passwordInput.addEventListener('input', checkPasswordStrength);

    function checkPasswordStrength() {
        const password = passwordInput.value;
        const strengthRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");
        const mediumRegex = new RegExp("^(?=.{8,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");

        if (strengthRegex.test(password)) {
            // Silné
            passwordStrengthIndicator.innerHTML = '<div class="strength strong">Silné</div>';
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

        if (strengthRegex.test(password)) {
            // Silné
            passwordStrengthIndicator.classList.remove("weak", "medium");
            passwordStrengthIndicator.classList.add("strong");
        } else {
            const mediumRegex = new RegExp(
                "^(?=.{8,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$",
                "g"
            );

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

async function loginUser() {
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





