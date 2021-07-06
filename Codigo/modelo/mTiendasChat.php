<?php
    include_once('../mMaster.php');
    include_once('../mBaseDatos.php');

    class mTiendasChat
    {
        /**
         * Enviar y contestar mensajes entre la tienda y el usuario
         * @param   numero  id de la tienda
         * @param   numero  id del usuario/remitente
         * @param   texto   mensaje que envia el usaurio a la tienda
         * @param   texto   mensaje que envia la tienda al usuario en respuesta a su pregunta y/o inquietud
         */
        static function enviarMensaje($ID_TIENDA,$ID_REMITENTE,$MENSAJE){
            $connect = conexionBaseDatos();

            $sql  = "INSERT INTO CHAT_TIENDA (ID_TIENDA, ID_REMITENTE, MENSAJE)";
            $sql .= "VALUES ('$ID_TIENDA', '$ID_REMITENTE', '$MENSAJE')";

            $result = $connect -> query($sql);
            comprobarDatosAfectados($connect);
            echo "<script>console.log('mTiendasChat::enviarMensaje')</script>";
            $connect -> close();
        }
        /**
         * Responde la tienda el mensaje realizado por un usuario
         * @param   entero  ID usuario
         * @param   texto   Mensaje el cual sera respondido
         * @param   texto   Mensaje de respuesta
         */
        static function enviarMensajeTienda($ID_TIENDA,$ID_REMITENTE,$FECHA_MENSAJE,$MENSAJE_RESPUESTA){
            $connect = conexionBaseDatos();

            $sql  = "UPDATE CHAT_TIENDA SET MENSAJE_RESPUESTA = '$MENSAJE_RESPUESTA' ";
            $sql .= "WHERE ID_TIENDA = '$ID_TIENDA' AND ID_REMITENTE = '$ID_REMITENTE' AND FECHA_MENSAJE = '$FECHA_MENSAJE'";

            $result = $connect -> query($sql);
            comprobarDatosAfectados($connect);
            echo "<script>console.log('mTiendasChat::enviarMensajeTienda')</script>";
            $connect -> close();            
        }
        /**
         * Indicar y mostrar los mensajes recibidos y enviados a una tienda especifica
         * @param   entero  ID de la tienda
         * @param   entero  ID del remitente
         * @return  lista   Lista de los mensajes enviados y recibidos junto a los ID de quienes lo envian
         *                      Posición valor columna
         *                          [][0] = ID_REMITENTE
         *                          [][1] = MENSAJE
         *                          [][2] = MENSAJE_RESPUESTA
         *                          [][3] = FECHA_MENSAJE
         */
        static function pedirChat($ID_TIENDA, $ID_REMITENTE=null){
            $connect = conexionBaseDatos();

            $sql  = "SELECT * ";
            $sql .= "FROM CHAT_TIENDA ";
            $sql .= "WHERE ID_TIENDA = '$ID_TIENDA'";
            if($ID_REMITENTE != null) $sql .= " AND ID_REMITENTE = '$ID_REMITENTE'";
            $result = $connect -> query($sql);

            $descripcionVariable = array('ID_REMITENTE','MENSAJE','MENSAJE_RESPUESTA','FECHA_MENSAJE');  //Diccionario de variables a conseguir
            $elementos = (count($descripcionVariable));
            //Almacen de variables en la lista info_tienda

            for($i=0; $i<$fila = mysqli_fetch_assoc($result); $i++){        // $i = Filas
                for($j=0; $j<$elementos; $j++){     // $j = Columnas
                    $chat_tienda[$i][$j] = $fila [$descripcionVariable[$j]];
                }
            }
            //Salida por consola
            for($a=0; $a<$i; $a++){
                echo "<script>console.log('--------------------------------------------')</script>";
                for($b=0; $b<$elementos; $b++){
                    echo "<script>console.log(' ~ $descripcionVariable[$b]: ".$chat_tienda[$a][$b]."')</script>";
                }
            }
            $connect -> close();
            echo "<script>console.log('mTiendasChat::pedirChat')</script>";
            return $chat_tienda;
        }
    }