function verificarFechaInicio(){
    //Tamaño del evento
    var tamanoEvento = document.getElementById("tamano_evento").textContent;
    var hoy = new Date();
    hoy.setSeconds(0);
    //fecha y hora de inicio
    fechaInicio = document.getElementById("fecha_inicio").value;
    horaInicio = document.getElementById("hora_inicio").value;
    
    if(fechaInicio != "" && horaInicio != ""){
        //año fecha inicio
        afi = fechaInicio.substring(0,4);
        //mes
        mfi = (fechaInicio.substring(5,7))-1;//Vete a saber porque javascript cuenta los meses desde cero
        //dia
        dfi = fechaInicio.substring(8,10);
        //horas
        hfi = horaInicio.substring(0,2);
        //minutos
        minfi = horaInicio.substring(3,5);
        
        var fechaTempInicio = new Date(afi,mfi,dfi,hfi,minfi);
    }
    //fecha y hora fin
    fechaFin = document.getElementById("fecha_fin").value;
    horaFin = document.getElementById("hora_fin").value;
    //si fecha inicio y fecha fin estan definidos
    if ((fechaInicio != "" && horaInicio != "") && (fechaFin != "" && horaFin != "")){
        //FECHA FIN
        aff = fechaFin.substring(0,4);
        mff = (fechaFin.substring(5,7))-1;//Vete a saber porque javascript cuenta los meses desde cero
        dff = fechaFin.substring(8,10);
        //HORA FIN
        hff = horaFin.substring(0,2);
        minff = horaFin.substring(3,5);

        var fechaTempFin = new Date(aff,mff,dff,hff,minff);
        
        //Comparar la fecha de inicio con la fecha de hoy
        var fechaCopyTempInicio = fechaTempInicio;
        if(fechaCopyTempInicio.setHours(fechaCopyTempInicio.getHours()-12) < hoy){
            window.alert('La fecha de inicio del evento tiene que ser por lo menos 12 horas mayor a la fecha actual');
        }
        //Comparar la fecha de inicio con la fecha de fin
        //*Para todos los tamaños de evento
        var fechaCopyTempInicio = fechaTempInicio;
        if(fechaCopyTempInicio.setHours(fechaCopyTempInicio.getHours()+1)>fechaTempFin){
            window.alert('La fecha de fin del evento debe de ser por lo menos una hora mayor con respecto a la fecha de inicio');
        }
        //*PARA TAMAÑO DE EVENTO PEQUEÑO o GRUPAL
        var fechaCopyTempInicio = fechaTempInicio;
        if(tamanoEvento == 1 && (fechaCopyTempInicio.setHours(fechaCopyTempInicio.getHours()+12)<fechaTempFin)){
            window.alert('La fecha de fin de evento de un evento de tamaño grupal es de maximo 12 horas con respecto a la fecha de inicio');
        }
        //*PARA TAMAÑO DE EVENTO TORNEO y MASIVO
        var fechaCopyTempInicio = fechaTempInicio;
        if(tamanoEvento != 1 && (fechaCopyTempInicio.setDate(fechaCopyTempInicio.getDate()+30)<fechaTempFin)){
            window.alert('La fecha de fin de evento de un evento de tamaño torneo o masivo es de maximo 30 días con respecto a la fecha de inicio');
        }
    }
    
}