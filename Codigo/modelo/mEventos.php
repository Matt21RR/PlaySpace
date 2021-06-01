<?php
    include_once('../mBaseDatos.php');
    include_once('../mMaster.php');
    class mEventos{
        /**
         * Busca los eventos en los cuales el usuario esta inscrito.
         * @param   numero  id del usuario.
         * @return  lista   eventos en los cuales el usuario participa.
         * 
         */
        static function pedirIDEventosInscrito($ID_USUARIO){
            $lista_eventos[0] = -1;
            $connect=conexionBaseDatos();
            $sql="select ID_EVENTO from PARTICIPANTES_EVENTO where ID_USUARIO = '$ID_USUARIO'";
            $result = $connect->query($sql);
            $posicion = 0;
            while ($fila = mysqli_fetch_assoc($result)){
                $lista_eventos[$posicion] = $fila ['ID_EVENTO'];
                $posicion++;
            }
            echo "<script>console.log('mEventos::pedirIDEventosInscrito->')</script>";
            $connect->close();
            return $lista_eventos;        
        }
        /**
         * Busca los eventos que el usuario ha creado.
         * @param   numero  id del usuario.
         * @return  lista   eventos creados por el usuario.
         */
        static function pedirIDEventosCreador($ID_USUARIO){
            $lista_eventos[0] = -1;
            $connect=conexionBaseDatos();
            $sql="select ID_EVENTO from EVENTOS where ID_USUARIO = '$ID_USUARIO'";
            $result = $connect->query($sql);
            $posicion = 0;
            while ($fila = mysqli_fetch_assoc($result)){
                $lista_eventos[$posicion] = $fila ['ID_EVENTO'];
                $posicion++;
            }
            echo "<script>console.log('mEventos::pedirIDEventosCreador->')</script>";
            $connect->close();
            return $lista_eventos;
        }
        /**
         * Consulta la informacion del evento
         * @param   numero  la id del evento a consultar
         * @return  lista   informacion del evento
         */
        static function pedirInformacionEventos($ID_EVENTO){
            $connect=conexionBaseDatos();
            $sql="select * from EVENTOS where ID_EVENTO = '$ID_EVENTO'";
            $result = $connect->query($sql);
            while ($fila = mysqli_fetch_assoc($result)){
                $info_evento[0] = $fila ['ID_USUARIO'];//id del creador de la tienda
                $info_evento[1] = $fila ['TAMANO_EVENTO'];
                $info_evento[2] = $fila ['TIPO_EVENTO'];
                $info_evento[3] = $fila ['DESCRIPCION'];
                $info_evento[4] = $fila ['UBICACION_LAT'];
                $info_evento[5] = $fila ['UBICACION_LON'];
                $info_evento[6] = $fila ['FECHA_INICIO'];
                $info_evento[7] = $fila ['FECHA_FIN'];
            }
            while ($pos_imprimir<8){
                echo "<script>console.log('mEventos::pedirInformacionEventos->$info_evento[$pos_imprimir]')</script>";
                $pos_imprimir++;
            }
            $connect->close();
            return $info_evento;
        }
        /**
         * Agrega los participantes que se inscriben al evento
         * @param   numero  id del usuario a añadir.
         * @param   numero  id del evento en donde se añade al usuario
         */
        static function actualizarListaPaticipantes($ID_EVENTO,$ID_USUARIO){
            $connect=conexionBaseDatos();
            $sql="INSERT INTO PARTICIPANTES_EVENTO VALUES ('$ID_EVENTO','$ID_USUARIO')";
            $result = $connect->query($sql);
            comprobarDatosAfectados($connect);
            echo "<script>console.log('mEventos::actualizarListaPaticipantes')</script>";
            $connect->close();
        }
        /**
         * Quita a un participante del evento
         * @param   numero  id del evento
         * @param   numero  id del participante a eliminar
         */

        static function borrarParticipante($ID_EVENTO,$ID_USUARIO){
            $connect=conexionBaseDatos();
            $sql="delete from PARTICIPANTES_EVENTO where ID_PARTICIPANTE = '$ID_USUARIO'";
            $result = $connect->query($sql);
            
            comprobarDatosAfectados($connect);
            echo "<script>console.warn('mEventos::borrarParticipante)</script>";
            $connect->close();
        }

        static function pedirListaInfoParticipantes($ID_EVENTO){
            $connect=conexionBaseDatos();
            $sql= "SELECT * FROM INFO_PARTICIPANTES_EVENTO WHERE ID_EVENTO = '$ID_EVENTO'";
            $result = $connect->query($sql);
            while ($fila = mysqli_fetch_assoc($result)){
        }
    }
    }
    
    //pedirIDEventosCreador($_GET['ID_USUARIO']);
    //pedirIDEventosInscrito($_GET['ID_USUARIO']);