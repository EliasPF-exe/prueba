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
 
 function validarNombreUsuario(nombreUsuario) {
    var formato = /^[a-zA-Z0-9_-]{4,15}$/;
    nombreUsuario = nombreUsuario.replace(/\+/g, '\+');
    validaciones.nombreUsuario = formato.test(nombreUsuario);
   
 }
 
 
 function validarPassword(pass){
    pass = pass.replace(/\+/g, '\+');
    validaciones.password = pass.length >= 8;
    mostrarValidacion('#password', validaciones.password);
   
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
 
    $('#formularioRegistro').on('submit', function(event) {
        event.preventDefault(); // Evitar envío del formulario hasta validar
 
 
        // Realizar todas las validaciones aquí
        validarNombreUsuario($('#usuario').val());
        validarPassword($('#password').val());
 
 
        // Revisa si todo es válido
        const todoValido = Object.values(validaciones).every(valido => valido);
        if (todoValido) {
            this.submit();
        } else {
            alert('Por favor, corrige los campos marcados antes de continuar.');
        }
    });
 });
 