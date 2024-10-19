
var sesion = localStorage.getItem('sesion');
var nombre = localStorage.getItem('');
var foto = localStorage.getItem('');

function showToast(message, type) {
    Toastify({
        text: message,
        duration: 3000,
        close: true,
        gravity: "top",
        position: "center",
        backgroundColor: type === 'error' ? "#ff0000" : "#4CAF50",
    }).showToast();
    document.getElementById('loginForm').addEventListener('submit', function(event) {
        event.preventDefault();
        
        const email = document.getElementById('inputEmailAddress').value;
        const password = document.getElementById('inputPassword').value;

        if (!email || !password) {
            showToast('Por favor, complete todos los campos', 'error');
            return;
        }

        if (!isValidEmail(email)) {
            showToast('Por favor, ingrese un email válido', 'error');
            return;
        }

        // If validation passes, submit the form
        this.submit();
    });

    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

   
};



function checarIndex(){
if(sesion!=null){
    $(location).attr('href','registrodeDAtos.php')
}
};
