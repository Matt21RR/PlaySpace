function comprobarDatos(){
    if((document.getElementById("fotoPerfil").src).search('/0.png') != -1){
        window.alert("Aun no has seleccionado una foto de perfil");
    }else{
        if((window.rNombre == 1) && (window.rContrasena == 1) && (window.rCorreo == 1)&&(comprobarTerminos() == 1)){
            document.forms['formCrearCuenta'].submit() ;
        }else{
            if(comprobarTerminos() == 0){
                window.alert('Porfavor, acepta los terminos y condiciones para poder continuar');
            }else{
                console.log(window.rNombre+" "+window.rContrasena+" "+window.rCorreo+" "+comprobarTerminos());
                window.alert('Porfavor, introduce todos los valores correctamente e intentalo denuevo');
            }
        }
    }
}
function comprobarTerminos(){
    if(document.getElementById("terminos").checked == 0){
        window.alert('Porfavor, acepta los terminos y condiciones para poder continuar');
        resultado = 0;
    }else{
        resultado = 1;
    }
    return resultado;
}
//========CONSULTAS AJAX===============================================
function comprobarNombre(){
    nombreIngresado = document.getElementById('nombre_usuario').value;
    window.rNombre = 0;

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            respuesta = JSON.parse(borrarSalidaConsola(this.responseText));
            //Si la respuesta es 1 entonces informar a el usuario
            if(respuesta == 1){
                window.alert('El nombre de usuario ingresado no se encuentra disponible para su uso');
                document.getElementById('nombre_usuario').style.borderColor = "#A00000";
                
            }else{
                document.getElementById('nombre_usuario').style.borderColor = ""; 
                window.rNombre = 1;
            }
        }
    };
    xmlhttp.open("GET", "../controladorVista/cvCuentaCrear.php?nombreUsuarioBuscar="+nombreIngresado,true);
    xmlhttp.send();
}
function comprobarContrasena(){
    contrasenaIngresado = document.getElementById('contrasena').value;
    window.rContrasena = 0;

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            respuesta = JSON.parse(borrarSalidaConsola(this.responseText));
            //Si la respuesta es 1 entonces informar a el usuario
            if(respuesta == -1){
                window.alert('La contraseña ingresada debe de tener minimo 2 numeros y 6 letras');
                document.getElementById('contrasena').style.borderColor = "#A00000";
                
            }else{
                document.getElementById('contrasena').style.borderColor = ""; 
                window.rContrasena = 1;
            }
        }
    };
    xmlhttp.open("GET", "../controladorVista/cvCuentaCrear.php?contrasenaComprobar="+contrasenaIngresado,true);
    xmlhttp.send();
}
function comprobarCorreo(){
    correoIngresado = document.getElementById('correo').value;
    window.rCorreo = 0;

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            respuesta = JSON.parse(borrarSalidaConsola(this.responseText));
            //Si la respuesta es 1 entonces informar a el usuario
            if(respuesta == 1){
                window.alert('El correo ingresado no se encuentra disponible para su uso');
                document.getElementById('correo').style.borderColor = "#A00000";
            }else{
                document.getElementById('correo').style.borderColor = ""; 
                window.rCorreo = 1;
            }
        }
    };
    xmlhttp.open("GET", "../controladorVista/cvCuentaCrear.php?correoBuscar="+correoIngresado,true);
    xmlhttp.send();
}