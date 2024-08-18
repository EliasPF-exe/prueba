// Estado de validación general
var validaciones = {
    email: false,
    nombreUsuario: false,
    nombre: false,
    apellidos: false,
    fechaNacimiento: false,
    telefono: false,
    password: false,
    passwordIguales: false
};

function validarEmail(email){
    var formato = /^[a-zA-Z]+([\.]?[a-zA-Z0-9_-]+)*@[a-z0-9]+([\.-]+[a-z0-9]+)*\.[a-z]{2,4}$/;
    email = email.replace(/\+/g, '\+');
    validaciones.email = formato.test(email);
    mostrarValidacion('#email', validaciones.email);
}
function registro(){
    alert("santi");
}
function validarNombreUsuario(nombreUsuario){
    var formato = /^[a-zA-Z0-9_-]{4,15}$/;
    nombreUsuario = nombreUsuario.replace(/\+/g, '\+');
    validaciones.nombreUsuario = formato.test(nombreUsuario);
    mostrarValidacion('#usuario', validaciones.nombreUsuario);

}

function validarNombre(nombre){
    var formato = /^[a-zA-Z áéíóúüÁÉÍÓÜÚ]{3,15}$/;
    nombre = nombre.replace(/\+/g, '\+');
    validaciones.nombre = formato.test(nombre) || nombre == '';
    mostrarValidacion('#nombre', validaciones.nombre && nombre!="");
}

function validarApellidos(apellidos){
    var formato = /^[a-zA-Z áéíóúüÁÉÍÓÜÚ]{3,15}$/;
    apellidos = apellidos.replace(/\+/g, '\+');
    validaciones.apellidos = formato.test(apellidos) || apellidos == '';
    mostrarValidacion('#apellidos', validaciones.apellidos && apellidos !="");
}

function validarFecha(fechaNacimiento) {
    var hoy = new Date();
    var cumpleanos = new Date(fechaNacimiento);
    var edad = hoy.getFullYear() - cumpleanos.getFullYear();
    var mes = hoy.getMonth() - cumpleanos.getMonth();
    var dia = hoy.getDate() - cumpleanos.getDate();

    if (edad > 120) {
        validaciones.fechaNacimiento = false; 
    } else if (edad > 18) {
        validaciones.fechaNacimiento = true;
    } else if (edad === 18) {
        if (mes > 0) {
            validaciones.fechaNacimiento = true;
        } else if (mes === 0) {
            validaciones.fechaNacimiento = dia >= 0;
        } else {
            validaciones.fechaNacimiento = false;
        }
    } else {
        validaciones.fechaNacimiento = false;
    }

    mostrarValidacion('#birthday', validaciones.fechaNacimiento);
}

function validarTelefono(telefono){
    var formato = /^[0-9]{9}$/;
    telefono = telefono.replace(/\+/g, '\+');
    validaciones.telefono = formato.test(telefono);
    mostrarValidacion('#telefono', validaciones.telefono);
}

function validarPassword(pass){
    pass = pass.replace(/\+/g, '\+');
    validaciones.password = pass.length >= 8;
    mostrarValidacion('#password', validaciones.password);
}

function validarPasswordIguales(password, passwordRepetida){
    password = password.replace(/\+/g, '\+');
    passwordRepetida = passwordRepetida.replace(/\+/g, '\+');
    validaciones.passwordIguales = password.length >= 8 && password == passwordRepetida;
    mostrarValidacion('#password2', validaciones.passwordIguales);
}

function mostrarValidacion(nombreCampo, valido){
    if (valido) {
        $(nombreCampo).css('border', '1px solid #7ca22c');
        $(nombreCampo).css('box-shadow', '0 0 2px 1px #7ca22c');
    } else {
        $(nombreCampo).css('border', '1px solid red');
        $(nombreCampo).css('box-shadow', '0 0 2px 1px red');
    }
    actualizarEstadoBoton();
}

function actualizarEstadoBoton(){
    const btnregistro = document.getElementById('registrar');
    const todoValido = Object.values(validaciones).every(valido => valido);
    btnregistro.disabled = !todoValido;
}


$(document).ready(function(){
    $('#email').on('input', function() {
        validarEmail(this.value);
    });
    
    $('#usuario').on('input', function() {
        validarNombreUsuario(this.value);
    });
    
    $('#nombre').on('input', function() {
        validarNombre(this.value);
    });
    
    $('#apellidos').on('input', function() {
        validarApellidos(this.value);
    });
    
    $('#birthday').on('input', function() {
        validarFecha(this.value);
    });
    
    $('#telefono').on('input', function() {
        validarTelefono(this.value);
    });
    
    $('#password').on('input', function() {
        validarPassword(this.value);
        validarPasswordIguales(this.value, $('#password2').val());
    });
    
    $('#password2').on('input', function() {
        validarPasswordIguales($('#password').val(), this.value);
    });

});
