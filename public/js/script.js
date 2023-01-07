
/*
function modal(){
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
*/
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






