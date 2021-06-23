// * LA BUSQUEDA
//hacer la busqueda en cuanto se tengan Latitud y longitud
function realizarBusqueda(){
    if(window.latitud && window.longitud){// ? Si la latitud y la longitud existen
        latitud = window.latitud;
        longitud = window.longitud;

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                window.positionsArrayAnswer = JSON.parse(borrarSalidaConsola(this.responseText));
                console.warn(window.positionsArrayAnswer);
                localize(window.positionsArrayAnswer,1);
            }
        };
        xmlhttp.open("GET", "../controladorVista/cvBusqueda.php?latitud=" + latitud + "&longitud=" + longitud,true);
        xmlhttp.send();
    }
}
/**
 * Funcion que borra las salidas por consola, para poder usar ajax
 * @param   texto   texto de salida de una operacion
 * @param   texto   el mismo texto pero sin salidas por consola
 */
function borrarSalidaConsola(texto){
    inicioSalidaConsola = 1;
    while (inicioSalidaConsola != -1) {
        inicioSalidaConsola = (texto.indexOf("<script>"));
        if(inicioSalidaConsola != (-1)){
            finSalidaConsola = (texto.indexOf("</script>") + 9);//para que borre toda el termino y no solo el "<"
            //TODO: LO QUE QUITA LAS CADENAS DE TEXTO
            texto = texto.substring(0,inicioSalidaConsola) + texto.substring(finSalidaConsola);
        }
    }
    return texto;
}

// * LAS CAJAS DE FILTROS
//la cosa que muestra o oculta la caja de filtros
function abrirCajaFiltros(){
    if(document.getElementById("Caja_Filtros").style.minHeight != "fit-content"){
        document.getElementById("Caja_Filtros").style.minHeight = "fit-content";
        document.getElementById("Caja_Filtros").style.maxHeight = "100%";
        document.getElementById("Caja_Filtros").style.paddingTop = "55px";
    }else{
        document.getElementById("Caja_Filtros").style.minHeight = "0px";
        document.getElementById("Caja_Filtros").style.maxHeight = "0px";
        document.getElementById("Caja_Filtros").style.paddingTop = "0px";
    }
}
function abrirFiltros(nombreFiltro){
    switch (nombreFiltro) {
        case "filtro1":
                
            break;
        case "filtro1.1":
                document.getElementById("filtro1").style.height = "20px";
                document.getElementById("filtro1").style.overflowY = "hidden";
                document.getElementById("filtro1.1").style.height = "auto";
                //document.getElementById("filtro1.2").style.height = "0px";
                document.getElementById("filtro1.1.1").style.height = "0px";
                document.getElementById("filtro1.1.1").style.overflowY = "hidden";
                document.getElementById("filtro1.1.2").style.height = "0px";
                document.getElementById("filtro1.1.2").style.overflowY = "hidden";
                document.getElementById("filtro1.1.1.1").style.height = "0px";
                document.getElementById("filtro1.1.1.1").style.overflowY = "hidden";
                document.getElementById("filtro1.1.1.2").style.height = "0px";
                document.getElementById("filtro1.1.1.2").style.overflowY = "hidden";

            break;
        case "filtro1.2":

            break;
        case "filtro1.1.1":
            document.getElementById("filtro1.1").style.height = "20px";
            document.getElementById("filtro1.1").style.overflowY = "hidden";
            //document.getElementById("filtro1.2").style.height = "0px";
            document.getElementById("filtro1.1.1").style.height = "auto";
            document.getElementById("filtro1.1.2").style.height = "0px";
            document.getElementById("filtro1.1.2").style.overflowY = "hidden";
            document.getElementById("filtro1.1.1.1").style.height = "0px";
            document.getElementById("filtro1.1.1.1").style.overflowY = "hidden";
            document.getElementById("filtro1.1.1.2").style.height = "0px";
            document.getElementById("filtro1.1.1.2").style.overflowY = "hidden";
            break;
        case "filtro1.1.2":
            document.getElementById("filtro1.1").style.height = "20px";
            document.getElementById("filtro1.1").style.overflowY = "hidden";
            //document.getElementById("filtro1.2").style.height = "0px";
            document.getElementById("filtro1.1.1").style.height = "0px";
            document.getElementById("filtro1.1.2").style.height = "auto";
            document.getElementById("filtro1.1.2").style.overflowY = "hidden";
            document.getElementById("filtro1.1.1.1").style.height = "0px";
            document.getElementById("filtro1.1.1.1").style.overflowY = "hidden";
            document.getElementById("filtro1.1.1.2").style.height = "0px";
            document.getElementById("filtro1.1.1.2").style.overflowY = "hidden";
            break;
        case "filtro1.1.1.1":

            break;
        case "filtro1.1.1.2":

            break;
    }
}

// * LAS OPERACIONES DE FILTRADO
// LAS FILTRACIONES SE REALIZAN SOBRE UNA COPIA DEL ARRAY DE LAS UBICACIONES
function filtrarResultados(tipoUbicacion=0,tamanoEvento=0,tipoEvento=0,idActividad=0){
    almacenarValoresFiltro(tipoUbicacion,tamanoEvento,tipoEvento,idActividad); //guadar los valores del filtro recien ingresados
    valoresFiltros = pedirValoresFiltro();
    tipoUbicacion = valoresFiltros[0];
    tamanoEvento = valoresFiltros[1];
    tipoEvento = valoresFiltros[2];
    idActividad = valoresFiltros[3];
    var resultados = [...window.positionsArrayAnswer];//Copiar la informacion de la busqueda general a una variable local
    if (resultados[0] != -1) {//TODO: Aplicar filtro por filtro de manera ordenada el filtrado
        if (tipoUbicacion != 0) { //1 - tipoUbicacion
            abrirFiltros("filtro1.1");
            copiaResultados = crearArregloPosicionesID(resultados);//crear una copia del arreglo de resultados original
            console.log("Copiado de la info de resultados de busqueda "+copiaResultados);
            idExcluir = filtrarUbicacion(resultados,tipoUbicacion);//obtener las id de la ubicaciones a excluir
            indicesUbiRemover= almacenarPosicionUbicacionesARemover(copiaResultados,idExcluir);
            resultado = removerElementosArray(indicesUbiRemover,resultados);
            if(tamanoEvento != 0){//1.1 - tamanoEvento
                abrirFiltros("filtro1.1.1");
                copiaResultados = crearArregloPosicionesID(resultados);//crear una copia del arreglo de resultados original
                idExcluir = filtrarTamanoEvento(resultados,tamanoEvento);//obtener las id de la ubicaciones a excluir
                indicesUbiRemover= almacenarPosicionUbicacionesARemover(copiaResultados,idExcluir);
                resultado = removerElementosArray(indicesUbiRemover,resultado);
                if(tipoEvento != 0 && tamanoEvento != 3){//1.1.1 - tipoEvento
                    if(tipoEvento == 1){
                        abrirFiltros("filtro1.1.1.1");
                    }else{
                        abrirFiltros("filtro1.1.1.2");
                    }
                    copiaResultados = crearArregloPosicionesID(resultados);//crear una copia del arreglo de resultados original
                    idExcluir = filtrarTipoEvento(resultados,tipoEvento);//obtener las id de la ubicaciones a excluir
                    indicesUbiRemover= almacenarPosicionUbicacionesARemover(copiaResultados,idExcluir);
                    resultado = removerElementosArray(indicesUbiRemover,resultado);
                    if (idActividad != 0) {//1.1.1.1 y 1.1.1.2 - idEvento
                        copiaResultados = crearArregloPosicionesID(resultados);//crear una copia del arreglo de resultados original
                        idExcluir = filtrarIDActividad(resultados,idActividad);//obtener las id de la ubicaciones a excluir
                        indicesUbiRemover= almacenarPosicionUbicacionesARemover(copiaResultados,idExcluir);
                        resultado = removerElementosArray(indicesUbiRemover,resultado);
                    }
                }else if (tipoEvento != 0 && tamanoEvento == 3){//1.1.2 - tipoEvento = Masivo | idActividad
                    if (idActividad != 0) {
                        copiaResultados = crearArregloPosicionesID(resultados);//crear una copia del arreglo de resultados original
                        idExcluir = filtrarIDActividad(resultados,idActividad);//obtener las id de la ubicaciones a excluir
                        indicesUbiRemover= almacenarPosicionUbicacionesARemover(copiaResultados,idExcluir);
                        resultado = removerElementosArray(indicesUbiRemover,resultado);
                    }
                }
            }
        }
    }
    console.error("Resultados del filtrado "+resultado);
    localize(resultado,1);
}
//=======================================================================================================
//*UTILIDADES
function almacenarValoresFiltro(tipoUbicacion=0,tamanoEvento=0,tipoEvento=0,idActividad=0){
    if(tipoUbicacion != null){//si este valor no se ha guardado previamente o se desea actualizar
        window.tipoUbicacion = tipoUbicacion;
    }
    if(tamanoEvento != null){
        window.tamanoEvento = tamanoEvento;
    }
    if(tipoEvento != null){
        window.tipoEvento = tipoEvento;
    }
    if(idActividad != null){
        window.idActividad = idActividad;
    }
}
function pedirValoresFiltro(){
    var valorFiltro = new Array(4);
    valorFiltro[0] = window.tipoUbicacion;
    valorFiltro[1] = window.tamanoEvento;
    valorFiltro[2] = window.tipoEvento;
    valorFiltro[3] = window.idActividad;
    return valorFiltro;
}
/**
 * Esta funcion es para crear un arreglo que contenga las id de los resultados de busqueda en el mismo
 * orden en el que estan en el arreglo original
 * @param {Array} resultados Arreglo con toda la informacion de los resultados de busqueda
 * @returns {Array} El mismo arreglo pero solo con las id de los resultados de busqueda
 */
function crearArregloPosicionesID(resultados){
    var copiaResultados = new Array (200);
    for (index = 0; index < resultados.length; index++) {
        copiaResultados[index] = resultados[index][0];//Copiar las id a un arreglo aparte para darle mas velocidad al filtrado
    }
    return copiaResultados;
}
/**
 * almacena la posicion de las ubicaciones que se deben de excluir del arreglo de ubicaciones
 * @param {Array} listaUbicaciones 
 * @param {Array} listaExclusiones 
 * @returns {Array}
 */
function almacenarPosicionUbicacionesARemover(listaUbicaciones,listaExclusiones){ //? FINO SEÑORES
    //TODO: buscar en todo el arreglo la posicion de la id del evento a no mostrar y la guarda
    var listaPosicionesExcluir = new Array (200);
    var posCoincidencia = 0;
    for (let posX = 0; posX < listaExclusiones.length; posX++) {//remover valores de arriba hacia abajo
        if(listaExclusiones[posX] != null){//si la posicion del arreglo no esta vacia hacer....
            var i = listaUbicaciones.indexOf(listaExclusiones[posX]);
            if(i != -1){
                listaPosicionesExcluir[posCoincidencia] = i;
                posCoincidencia++;
            }
        }
        else if(listaExclusiones[posX] == null && posX == 0){
            listaPosicionesExcluir = -1;
            break;
        }
    }
    return listaPosicionesExcluir;
}
/**
 * Remueve los elementos del segundo array que coincidan con la informacion contenida en el primer subindice de cada indice del
 * primer arreglo
 * @param {Array} posRemover 
 * @param {Array} arregloUbicaciones 
 * @returns {Array} El segundo array con remocion de elementos
 */
function removerElementosArray(posRemover,arregloUbicaciones){
        if (posRemover != -1) {
            for (let index = (posRemover.length - 1); index > -1; index--) {
                indice = posRemover[index]; //la posicion donde esta la ubi a remover
                arregloUbicaciones.splice(indice,1); //removerla del arreglo de entrada
            }
        }
        if(arregloUbicaciones.length == 0){
            arregloUbicaciones[0] = -1;
        }
    return arregloUbicaciones;
}
//=======================================================================================================
function filtrarUbicacion(resultados = -1,tipoUbicacion = 0){//evento | tienda
    var exclusionList = new Array (200);
    cantEx=0;
    if (resultados != -1 && tipoUbicacion != 0) {
        for (let posX = 0; posX < resultados.length; posX++) {//para cada ubicacion hacer...
            if (tipoUbicacion != resultados[posX][4]){//si el tipo de ubicacion a filtrar es diferente al que tiene la ubicacion
                exclusionList[cantEx] = resultados[posX][0];//lista de ubicaciones a ocultar
                cantEx++;
            }
        }
    }
    return exclusionList;
}
function filtrarTamanoEvento(resultados = -1,tamanoEvento = 0){//pequeño | torneo | masivo
    var exclusionList = new Array (200);
    cantEx=0;
    if (resultados != -1 && tamanoEvento != 0) {
        for (let posX = 0; posX < resultados.length; posX++) {//para cada ubicacion hacer...
            if (tamanoEvento != resultados[posX][9]){//si el tamaño de evento a filtrar es diferente al que tiene la ubicacion
                exclusionList[cantEx] = resultados[posX][0];//lista de ubicaciones a ocultar
                cantEx++;
            }
        }
    }
    return exclusionList;
}
function filtrarTipoEvento(resultados = -1, tipoEvento = 0){//Deporte | ocio
    var exclusionList = new Array (200);
    cantEx=0;
    if(resultados != -1 && tipoEvento != 0){
        switch (tipoEvento) {
            case 1://Deporte (las id de los deportes van de 1 a 99) toca revisar que la actividad de evento sea menor a 100
                for (let posX = 0; posX < resultados.length; posX++) {//para cada ubicacion hacer...
                    if (resultados[posX][5]>100){//si el tipo de evento a filtrar es mayor a 100
                        exclusionList[cantEx] = resultados[posX][0];//lista de ubicaciones a ocultar
                        cantEx++;
                    }
                }
                break;
            case 2://0cio (las id de ocio van de 101 a 199)revisar que la actividad de evento sea mayor a 100 y menor a 200
                for (let posX = 0; posX < resultados.length; posX++) {//para cada ubicacion hacer...
                    if ((resultados[posX][5] < 100) || (resultados[posX][5] > 200)){//si el tipo de evento es menor a 100 o mayor a 200
                        exclusionList = resultados[posX][0];//lista de ubicaciones a ocultar
                        cantEx++;
                    }
                }
                break;
        }
    }
    return exclusionList;
}
function filtrarIDActividad(resultados = -1, idActividad = 0){
    var exclusionList = new Array (200);
    cantEx=0;
    if(resultados != -1 && idActividad != 0){
        for (let posX = 0; posX < resultados.length; posX++) {//para cada ubicacion hacer...
            if (idActividad != resultados[posX][5]){//si el id de la actividad a filtrar es diferente al que tiene la ubicacion
                exclusionList[cantEx] = resultados[posX][0];//lista de ubicaciones a ocultar
                cantEx++;
            }
        }
    }
    return exclusionList;
}