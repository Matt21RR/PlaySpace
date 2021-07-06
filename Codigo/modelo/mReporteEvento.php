<?php
    include_once('../mBaseDatos.php');
    include_once('../mMaster.php');
    /**
     * Pide la fecha de la ultimna vez que el usuario realizó un reporte de evento falso
     * @param   numero  id del usuario
     * @return  datetime    la fecha del ultimo reporte de evento falso
     */
    function pedirFechaUltimoReporte($ID_USUARIO){
        $connect=conexionBaseDatos();
        $sql = "SELECT FECHA_REPORTE_EVENTO 
                FROM USUARIOS 
                WHERE ID_USUARIO = '$ID_USUARIO'";
        $result = $connect->query($sql);
        while ($fila = mysqli_fetch_assoc($result)){
            $FECHA_REPORTE_EVENTO = $fila['FECHA_REPORTE_EVENTO'];
        }
        echo "<script>console.log('mReporteEvento::enviarReporteEventoFalso->$FECHA_REPORTE_EVENTO')</script>";
        $connect->close();
        return $FECHA_REPORTE_EVENTO;
    }
    function actualizarFechaUltimoReporte($ID_USUARIO,$FECHA_ACTUAL){
        $connect=conexionBaseDatos();
        //actualizar la fecha y hora a la cual el usuario envio el ultimo reporte enviado
        $sql = "UPDATE USUARIOS 
                SET FECHA_REPORTE_EVENTO ='$FECHA_ACTUAL' 
                WHERE ID_USUARIO = '$ID_USUARIO'";
        $result = $connect->query($sql);
        comprobarDatosAfectados($connect);
        echo "<script>console.log('mReporteEvento::actualizarFechaUltimoReporte-> $ID_USUARIO - $FECHA_ACTUAL')</script>";
        $connect->close();
    }

    /**
     * Envia el reporte de evento falso
     * @param   numero  id del evento a reportar
     * @param   numero  id del usuario que envia el reporte
     */
    function enviarReporteEventoFalso($ID_EVENTO,$ID_USUARIO){
        $connect=conexionBaseDatos();
        //Consultar la cantidad de reportes por evento falso que se tiene el evento.
        $sql = "SELECT EVENTO_FALSO 
                FROM EVENTOS 
                WHERE ID_EVENTO = '$ID_EVENTO'";
        $result = $connect->query($sql);
        while ($fila = mysqli_fetch_assoc($result)){
            $EVENTO_FALSO = $fila['EVENTO_FALSO'];
        }
        $EVENTO_FALSO++;
        
        //Actualizar la cantidad de reportes de evento falso que tiene el evento
        $sql = "UPDATE EVENTOS 
                SET EVENTO_FALSO = '$EVENTO_FALSO' 
                WHERE ID_EVENTO = '$ID_EVENTO'";
        $result = $connect->query($sql);
        comprobarDatosAfectados($connect);
        
        //Enviar la id de la persona que reporto el evento y que evento fue el que reportó
        $sql = "INSERT INTO REPORTANTES_EVENTO 
                VALUES('$ID_EVENTO','$ID_USUARIO')";
        $result = $connect->query($sql);
        comprobarDatosAfectados($connect);
        echo "<script>console.log('mReporteEvento::enviarReporteEventoFalso')</script>";
        $connect->close();
    }
    enviarReporteEventoFalso(21,4);
    //pedirFechaUltimoReporte(4);