

// Estado de validación general
var validaciones = {
    email: false,
    nombreUsuario: false,
    nombre: false,
    apellidos: false,
    fechaNacimiento: false,  // Cambié a false para iniciar con botón deshabilitado
    telefono: false,
    password: false,
    passwordIguales: false
};
actualizarEstadoBoton()

function validarEmail(email){
    var formato = /^[a-zA-Z]+([\.]?[a-zA-Z0-9_-]+)*@[a-z0-9]+([\.-]+[a-z0-9]+)*\.[a-z]{2,4}$/;
    email = email.replace(/\+/g, '\+');
    validaciones.email = formato.test(email);
    $.ajax({
        url: 'php/checkE.php',
        method: 'POST',
        data: { email: email },
        dataType: 'json',
        success: function(response) {
            if (response.error) {
                //alert(response.error);
            } else if (response.exists) { 
                //alert('El email ya existe en la base de datos.');
                validaciones.email = false;
            } else {
                validaciones.email = true;
            }
            mostrarValidacion('#email', validaciones.email);
        },
        error: function(xhr, status, error) {
           // alert('Hubo un error al llamar a la función de PHP: email' + error);
            validaciones.email = false;
            mostrarValidacion('#email', validaciones.email);
        }
    });
}
function registro(event) {
    event.preventDefault(); // Evita el envío normal del formulario

    // Obtener los valores del formulario
    var usuario = document.getElementById('usuario').value;
    var password = document.getElementById('password').value;
    var email = document.getElementById('email').value;
    var nombre = document.getElementById('nombre').value;
    var apellidos = document.getElementById('apellidos').value;
    var genero = document.getElementById('genero').value;
    var birthday = document.getElementById('birthday').value;
    var telefono = document.getElementById('telefono').value;

    // Crear la cadena de información
    var info = email + "," + nombre + "," + apellidos + "," + genero + "," + birthday + "," + telefono +  "," + usuario + "," + password;

    // Realizar la solicitud AJAX
    $.ajax({
        url: 'php/registrar.php',
        method: 'POST',
        data: { info: info },
        dataType: 'json',
        success: function(response) {
            if (response.error) {
                alert('Error: ' + response.error);
            } else if (response.success) {
                alert("Registro exitoso");
                window.location.href = '../../auth/index.php'; 
            }
        },
        error: function(xhr, status, error) {
            alert('Hubo un error al procesar la solicitud: ' + error);
        }
    });
    
}
function validarNombreUsuario(nombreUsuario) {
    var formato = /^[a-zA-Z0-9_-]{4,15}$/;
    nombreUsuario = nombreUsuario.replace(/\+/g, '\+');
    validaciones.nombreUsuario = formato.test(nombreUsuario);
    
    $.ajax({
        url: 'php/checkU.php',
        method: 'POST',
        data: { nombreUsuario: nombreUsuario },
        dataType: 'json',
        success: function(response) {
            if (response.error) {
                alert(response.error);
            } else if (response.exists) { 
                alert('yrgrega existe en la base de datos');
                
                validaciones.nombreUsuario = false;
            } else {
                alert('No existe');
                validaciones.nombreUsuario = true;
            }
            mostrarValidacion('#usuario', validaciones.nombreUsuario);
        },
        error: function(xhr, status, error) {
            alert('Hubo un error al llamar a la función de PHP: ' + error);
            validaciones.nombreUsuario = false;
            mostrarValidacion('#usuario', validaciones.nombreUsuario);
        }
    });
}

function validarNombre(nombre){
    var formato = /^[a-zA-Z áéíóúüÁÉÍÓÜÚ]{3,15}$/;
    nombre = nombre.replace(/\+/g, '\+');
    validaciones.nombre = formato.test(nombre) && nombre !== '';
    mostrarValidacion('#nombre', validaciones.nombre);
}

function validarApellidos(apellidos){
    var formato = /^[a-zA-Z áéíóúüÁÉÍÓÜÚ]{3,15}$/;
    apellidos = apellidos.replace(/\+/g, '\+');
    validaciones.apellidos = formato.test(apellidos) && apellidos !== '';
    mostrarValidacion('#apellidos', validaciones.apellidos);
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
    var formato = /^[0-9]{8,15}$/; // Permite de 8 a 15 dígitos
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
    validaciones.passwordIguales = password.length >= 8 && password === passwordRepetida;
    mostrarValidacion('#password2', validaciones.passwordIguales);
}

function mostrarValidacion(nombreCampo, valido){
    if (valido) {
        $(nombreCampo).css({
            'border': '1px solid #7ca22c',
            'box-shadow': '0 0 2px 1px #7ca22c'
        });
    } else {
        $(nombreCampo).css({
            'border': '1px solid red',
            'box-shadow': '0 0 2px 1px red'
        });
    }
    actualizarEstadoBoton();
}

function actualizarEstadoBoton(){
    const btnregistro = document.getElementById('registrar');
    const todoValido = Object.values(validaciones).every(valido => valido);
    btnregistro.disabled = !todoValido;
}

// Eventos para validación
$(document).ready(function(){
    const btnregistro = document.getElementById('registrar');
    btnregistro.disabled = true;
    $('#formularioRegistro').on('submit', function(event) {
        event.preventDefault(); // Evitar envío del formulario hasta validar

        // Realizar todas las validaciones aquí
        validarEmail($('#email').val());
        validarNombreUsuario($('#usuario').val());
        validarNombre($('#nombre').val());
        validarApellidos($('#apellidos').val());
        validarFecha($('#birthday').val());
        validarTelefono($('#telefono').val());
        validarPassword($('#password').val());
        validarPasswordIguales($('#password').val(), $('#password2').val());

        // Revisa si todo es válido
        const todoValido = Object.values(validaciones).every(valido => valido);
        if (todoValido) {
            this.submit();
        } else {
          //  alert('Por favor, corrige los campos marcados antes de continuar.');
        }
    });
});

