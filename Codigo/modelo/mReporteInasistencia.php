<?php
    include_once('../mBaseDatos.php');
    include_once('../mMaster.php');
    /**
     * Pide la cantidad de inasistencias que el usuario ha cometido
     * @param   numero  id del usuario
     * @return  numero  cantidad de inasistencias cometidas
     */
    function pedirInasistencias($ID_USUARIO){
        $connect=conexionBaseDatos();
        $sql = "SELECT INASISTENCIAS 
                FROM USUARIOS 
                WHERE ID_USUARIO = '$ID_USUARIO'";
        $result = $connect->query($sql);
        while ($fila = mysqli_fetch_assoc($result)){
            $INASISTENCIAS = $fila['INASISTENCIAS'];
        }
        echo "<script>console.log('mReporteInasistencia::pedirInasistencias->$INASISTENCIAS')</script>";
        $connect->close();
        return $INASISTENCIAS;
    }
    /**
     * Actualiza la cantidad de inasistencias que ha cometido el usuario
     * @param   numero  id del usuario
     * @param   numero  cantidad de inasistencia
     */
    function actualizarInasistencias($ID_USUARIO,$INASISTENCIAS){
        $connect=conexionBaseDatos();
        $sql = "UPDATE USUARIOS 
                SET INASISTENCIAS = '$INASISTENCIAS' 
                WHERE ID_USUARIO = '$ID_USUARIO'";
        $result = $connect->query($sql);
        comprobarDatosAfectados($connect);
        echo "<script>console.log('mReporteInasistencia::actualizarInasistencias->$INASISTENCIAS')</script>";
        $connect->close();
    }
    //actualizarInasistencias(1,5);
