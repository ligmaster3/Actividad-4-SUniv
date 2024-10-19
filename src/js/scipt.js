
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
};



function checarIndex(){
if(sesion!=null){
    $(location).attr('href','registrodeDAtos.php')
}
};
