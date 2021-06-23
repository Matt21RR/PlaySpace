<?php
    include_once('../mBaseDatos.php');
    include_once('../mMaster.php');
    class mEventos{
        /**
         * Busca los eventos en los cuales el usuario esta inscrito.
         * @param   numero  id del usuario.
         * @return  lista   eventos en los cuales el usuario participa.
         *                  -1 si no se encuentra nada en la primer posicion
         * 
         */
        static function pedirIDEventosInscrito($ID_USUARIO){
            $lista_eventos[0] = -1;
            $connect=conexionBaseDatos();
            $sql="SELECT ID_EVENTO from INFO_PARTICIPANTES_EVENTO where ID_PARTICIPANTE = '$ID_USUARIO' AND ADMINISTRADOR = '0'";
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
            $sql="SELECT ID_EVENTO from EVENTOS where ID_USUARIO = '$ID_USUARIO'";
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
         * Consultar la información basica del evento
         * @param   numero  id del evento
         * @return  lista   información basica del evento
         *                  -1 si no se logra encontrar nada
         */
        static function pedirInfoBasicaEvento($ID_EVENTO){
            $info_basic[0] = -1;
            $connect=conexionBaseDatos();
            $sql="SELECT * FROM LISTA_EVENTOS WHERE ID_EVENTO='$ID_EVENTO'";
            $result =$connect->query($sql);
            while($fila = mysqli_fetch_assoc($result)){
                $info_basic[0] = $fila['ID_EVENTO'];
                $info_basic[1] = $fila['TIPO_EVENTO'];
                $info_basic[2] = $fila['CANTIDAD_INSCRITOS'];
                $info_basic[3] = $fila['CANTIDAD_PARTICIPANTES'];
                $info_basic[4] = $fila['FECHA_INICIO'];
                $info_basic[5] = $fila['TAMANO_EVENTO'];
            }
            echo "<script>console.log('mEventos::pedirIDEventosCreador->')</script>";
            $connect->close();
            return $info_basic;
        }
        /**
         * Consulta la informacion del evento
         * @param   numero  la id del evento a consultar
         * @return  lista   informacion del evento
         *                  -1 en la primer posicion si no se encuentra nada
         */
        static function pedirInformacionEventos($ID_EVENTO){
            $info_evento[0] = -1;
            $connect=conexionBaseDatos();
            $sql="SELECT * from EVENTOS where ID_EVENTO = '$ID_EVENTO'";
            $result = $connect->query($sql);
            while ($fila = mysqli_fetch_assoc($result)){
                $info_evento[0] = $fila ['ID_USUARIO'];//id del creador del Evento
                $info_evento[1] = $fila ['TAMANO_EVENTO'];
                $info_evento[2] = $fila ['CANTIDAD_PARTICIPANTES'];
                $info_evento[3] = $fila ['TIPO_EVENTO'];
                $info_evento[4] = $fila ['DESCRIPCION'];
                $info_evento[5] = $fila ['UBICACION_LAT'];
                $info_evento[6] = $fila ['UBICACION_LON'];
                $info_evento[7] = $fila ['FECHA_INICIO'];
                $info_evento[8] = $fila ['FECHA_FIN'];
                $info_evento[9] = $fila ['CHAT']; //!Borrar de no ser necesario
            }
            //Agregar el nombre del creador del evento
            $sql = "SELECT NOMBRE_USUARIO FROM USUARIOS WHERE ID_USUARIO = '$info_evento[0]'";
            $result = $connect->query($sql);
            while ($fila = mysqli_fetch_assoc($result)){
                $info_evento[10] = $fila['NOMBRE_USUARIO'];
            }
            $pos_imprimir = 0;
            while ($pos_imprimir<11){
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
        static function actualizarListaParticipantes($ID_EVENTO,$ID_USUARIO){
            $connect=conexionBaseDatos();
            $sql = "INSERT INTO PARTICIPANTES_EVENTO (ID_EVENTO,ID_PARTICIPANTE)
                    VALUES ('$ID_EVENTO','$ID_USUARIO')";
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
            $sql="DELETE from PARTICIPANTES_EVENTO where ID_PARTICIPANTE = '$ID_USUARIO' AND ID_EVENTO = '$ID_EVENTO'";
            $result = $connect->query($sql);
            
            comprobarDatosAfectados($connect);
            echo "<script>console.warn('mEventos::borrarParticipante)</script>";
            $connect->close();
        }

        /**
         * consultar la informacion basica de los participantes de un evento
         * @param   numero  id del evento
         * @return  lista   lista con la informacion de los participantes
         *                  -1 en la primer posicion si no se encuentran resultados
         */
        static function pedirListaInfoParticipantes($ID_EVENTO){
            $info_participante[0][0] = -1;
            $connect=conexionBaseDatos();
            $sql= "SELECT * FROM INFO_PARTICIPANTES_EVENTO WHERE ID_EVENTO = '$ID_EVENTO'";
            $result = $connect->query($sql);
            $pos = 0;
            while ($fila = mysqli_fetch_assoc($result)){
                $info_participante[$pos][0] = $fila['ID_PARTICIPANTE'];
                $info_participante[$pos][1] = $fila['ID_FOTO_PERFIL'];
                $info_participante[$pos][2] = $fila['NOMBRE_USUARIO'];
                $info_participante[$pos][3] = $fila['ADMINISTRADOR'];
                $info_participante[$pos][4] = $fila['CALIFICACION_USUARIO'];
                $pos++;
            }
            echo "<script>console.log('mEventos::pedirListaInfoParticipantes->')</script>";
            $connect->close();
            return $info_participante;
        }
    }