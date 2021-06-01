<?php
    include_once('../mBaseDatos.php');
    include_once('../mMaster.php');
    class mReporteParticipante{
        /**
         * Pide la cantidad de malos comportamientos cometidos por el usuario en un evento
         * @param   numero  id del usuario
         * @param   numero  id del evento donde esta inscrito
         * @return  numero  cantidad de malos comportamientos cometidos
         */
        static function pedirCantidadMalosComportamientos($ID_USUARIO,$ID_EVENTO){
            $connect = conexionBaseDatos();
            $sql = "SELECT MALOS_COMPORTAMIENTOS 
                    FROM PARTICIPANTES_EVENTO 
                    WHERE ID_PARTICIPANTE = '$ID_USUARIO' &&
                        ID_EVENTO = '$ID_EVENTO'";
            $result = $connect->query($sql);
            while ($fila = mysqli_fetch_assoc($result)){
                $MALOS_COMPORTAMIENTOS = $fila['MALOS_COMPORTAMIENTOS'];
            }
            echo "<script>console.log('mReporteParticipante::pedirCantidadMalosComportamientos->$MALOS_COMPORTAMIENTOS')</script>";
            $connect->close();
            return $MALOS_COMPORTAMIENTOS;
        }
        /**
         * Actualiza la cantidad de malos comportamientos cometidos por el participante en un evento
         * @param   numero  id del participante
         * @param   numero  id del evento
         * @param   numero  cantidad nueva de malos comportamientos
         */
        static function actualizarCantidadMalosComportamientos($ID_USUARIO, $ID_EVENTO, $MALOS_COMPORTAMIENTOS){
            $connect=conexionBaseDatos();
            $sql = "UPDATE PARTICIPANTES_EVENTO 
                    SET MALOS_COMPORTAMIENTOS ='$MALOS_COMPORTAMIENTOS' 
                    WHERE ID_PARTICIPANTE = '$ID_USUARIO'&&
                        ID_EVENTO = '$ID_EVENTO'";
            $result = $connect->query($sql);
            comprobarDatosAfectados($connect);
            echo "<script>console.log('mReporteParticipante::actualizarCantidadMalosComportamientos')</script>";
            $connect->close();
        }
        /**
         * Agrega a usuarios expulsados de un evento en la lista de usuarios expulsados
         * @param   numero  id del participante a expulsar
         * @param   numero  id del evento
         */
        static function actualizarListaExpulsados($ID_EXPULSADO, $ID_EVENTO){
            $connect=conexionBaseDatos();
            $sql = "INSERT INTO PARTICIPANTES_EXPULSADOS 
                    VALUES('$ID_EVENTO', '$ID_EXPULSADO')";
            $result = $connect->query($sql);
            comprobarDatosAfectados($connect);
            echo "<script>console.log('mReporteParticipante::actualizarListaExpulsados')</script>";
            $connect->close();
        }
        /**
         * Remover un participante de la lista de participantes de un evento
         * @param   numero  id del participante
         * @param   numero  id del evento
         */
        static function removerParticipante($ID_PARTICIPANTE,$ID_EVENTO){
            $connect=conexionBaseDatos();
            $sql = "DELETE * FROM PARTICIPANTES_EVENTO 
                    WHERE ID_EVENTO = '$ID_EVENTO'
                    AND ID_PARTICIPANTE = '$ID_PARTICIPANTE'";
            $result = $connect->query($sql);
            comprobarDatosAfectados($connect);
            echo "<script>console.log('mReporteParticipante::removerParticipante')</script>";
            $connect->close();
        }
    }
    