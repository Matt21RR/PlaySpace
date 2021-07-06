var resolvedOptions = Intl.DateTimeFormat().resolvedOptions(); //obtener toda la informacion del navegador

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200){
        }
    };
    xmlhttp.open("GET","../controladorVista/cvIniciarSesion.php?zonaHoraria="+resolvedOptions.timeZone); //enviar la zona horaria al archivo de cv inicio secion
    xmlhttp.send();