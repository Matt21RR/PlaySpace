<?php
    include_once('../mBaseDatos.php');
    include_once('../mMaster.php');
    /**
     * Pide la calificacion  del usuario
     * @param   numero  id del usuario
     * @return  decimal calificacion actual del usuario
     */
    function pedirCalificacionParticipante($ID_USUARIO){
        $connect=conexionBaseDatos();
        $sql = "SELECT CALIFICACION_USUARIO
                FROM USUARIOS
                WHERE ID_USUARIO = '$ID_USUARIO'";
        $result = $connect->query($sql);
        while ($fila = mysqli_fetch_assoc($result)){
            $CALIFICACION_USUARIO = $fila['CALIFICACION_USUARIO'];
        }
        echo "<script>console.log('mReportePostFinEvento::pedirCalificacionParticipante->$CALIFICACION_USUARIO')</script>";
        $connect->close();
        return $CALIFICACION_USUARIO;
    }
    /**
     * Pide la cantidad de veces que un usuario ha participado en eventos
     * @param   numero  la id del usuario
     * @return  numero  cantidad de participaciones
     */
    function pedirCantidadParticipaciones($ID_USUARIO){
        $connect=conexionBaseDatos();
        //Consultar la cantidad de participaciones actuales.
        $sql = "SELECT PARTICIPACIONES 
                from USUARIOS 
                where ID_USUARIO = '$ID_USUARIO'";
        $result = $connect->query($sql);
        while ($fila = mysqli_fetch_assoc($result)){
            $PARTICIPACIONES = $fila['PARTICIPACIONES'];
        }
        echo "<script>console.log('mReportePostFinEvento::pedirCantidadParticipaciones->$NUMERO_PARTICIPACIONES')</script>";
        $connect->close();
        return $PARTICIPACIONES;
    }
    /**
     * Pide la calificacion de los eventos realizados por un
     * usuario
     * @param   numero  id del usuario
     * @return  decimal calificacion general de los eventos del usuario
     */
    function pedirCalificacionEventos($ID_USUARIO){
        $connect=conexionBaseDatos();
        $sql = "SELECT CALIFICACION_EVENTOS 
                from USUARIOS 
                where ID_USUARIO = '$ID_USUARIO'";
        $result = $connect->query($sql);
        while ($fila = mysqli_fetch_assoc($result)){
            $CALIFICACION_EVENTOS = $fila['CALIFICACION_EVENTOS'];
        }
        echo "<script>console.log('mReportePostFinEvento::pedirCalificacionEventos->$CALIFICACION_EVENTOS')</script>";
        $connect->close();
        return $CALIFICACION_EVENTOS;
    }
    /**
     * Pide la cantidad de veces que un usuario ha realizado eventos
     * @param   numero  la id del usuario
     * @return  numero  cantidad de eventos realizados
     */
    function pedirCantidadEventosRealizados($ID_USUARIO){
        $connect=conexionBaseDatos();
        //Consultar la cantidad de participaciones actuales.
        $sql = "SELECT EVENTOS_REALIZADOS 
                from USUARIOS 
                where ID_USUARIO = '$ID_USUARIO'";
        $result = $connect->query($sql);
        while ($fila = mysqli_fetch_assoc($result)){
            $EVENTOS_REALIZADOS  = $fila['EVENTOS_REALIZADOS '];
        }
        echo "<script>console.log('mReportePostFinEvento::pedirCantidadEventosRealizados->$EVENTOS_REALIZADOS ')</script>";
        $connect->close();
        return $EVENTOS_REALIZADOS ;
    }
    /**
     * Actualiza la calificacion  del usuario
     * @param   numero  id del usuario
     * @param   decimal calificacion nueva del participante
     */
    function actualizarCalificacionParticipante($ID_USUARIO,$CALIFICACION_USUARIO){
        $connect=conexionBaseDatos();
        $sql = "UPDATE USUARIOS 
                SET CALIFICACION_USUARIO ='$CALIFICACION_USUARIO'
                WHERE ID_USUARIO = '$ID_USUARIO'";
        $result = $connect->query($sql);
        comprobarDatosAfectados($connect);
        echo "<script>console.log('mReportePostFinEvento::actualizarCalificacionParticipante')</script>";
        $connect->close();
    }
    /**
     * Actualizar la cantidad de participaciones
     * @param   numero  id del usuario
     * @param   numero  cantidad nueva de participaciones
     */
    function actualizarCantidadParticipaciones($ID_USUARIO,$CANTIDAD_PARTICIPACIONES){
        $connect=conexionBaseDatos();
        
        $sql = "UPDATE usuarios 
                set PARTICIPACIONES = '$NUMERO_PARTICIPACIONES' 
                where ID_USUARIO = '$ID_USUARIO'";
        $result = $connect->query($sql);
        comprobarDatosAfectados($connect);
        echo "<script>console.log('mReportePostFinEvento::actualizarCantidadParticipaciones')</script>";
        $connect->close();
    }
    /**
     * Actualizar la calificacion  de los eventos que ha realizado
     * @param   numero  id del usuario
     * @param   decimal calificacion nueva de los eventos realizados
     */
    function actualizarCalificacionEventos($ID_USUARIO,$CALIFICACION_EVENTOS){
        $connect=conexionBaseDatos();
        $sql = "UPDATE USUARIOS
                SET CALIFICACION_EVENTOS = '$CALIFICACION_EVENTOS'
                WHERE ID_USUARIO = '$ID_USUARIO'";
        $result = $connect->query($sql);
        comprobarDatosAfectados($connect);
        echo "<script>console.log('mReportePostFinEvento::actualizarCalificacionEventos')</script>";
        $connect->close();
    }
    /**
     * Actualizar la cantidad de eventos realizados
     * @param   numero  id del usuario
     * @param   numero  cantidad nueva de eventos realizados
     */

    function actualizarCantidadEventosRealizdos($ID_USUARIO,$EVENTOS_REALIZADOS){
        $connect=conexionBaseDatos();
        
        $sql = "UPDATE USUARIOS 
                set EVENTOS_REALIZADOS = '$EVENTOS_REALIZADOS' 
                where ID_USUARIO = '$ID_USUARIO'";
        $result = $connect->query($sql);
        comprobarDatosAfectados($connect);
        echo "<script>console.log('mReportePostFinEvento::actualizarCantidadEventosRealizdos')</script>";
        $connect->close();
    }
