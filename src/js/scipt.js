
var sesion = localStorage.getItem('sesion');
var nombre = localStorage.getItem('');
var foto = localStorage.getItem('');

function checarIndex(){
if(sesion!=null){
    $(location).attr('href','registrodeDAtos.php')
}

};