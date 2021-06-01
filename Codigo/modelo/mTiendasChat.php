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

            $sql  = "INSERT INTO CHAT_TIENDA (ID_TIENDA, ";
            $sql .= "ID_REMITENTE, ";
            $sql .= "MENSAJE)";
            $sql .= "VALUES ('$ID_TIENDA', ";
            $sql .= "'$ID_REMITENTE', ";
            $sql .= "'$MENSAJE')";

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
        static function pedirChat($ID_TIENDA, $ID_REMITENTE){
            $connect = conexionBaseDatos();

            $sql  = "SELECT * ";
            $sql .= "FROM CHAT_TIENDA ";
            $sql .= "WHERE ID_TIENDA = '$ID_TIENDA' ";
            $sql .= "AND ID_REMITENTE = '$ID_REMITENTE'";
            $result = $connect -> query($sql);

            $descripcionVariable = array('ID_REMITENTE', 'MENSAJE','MENSAJE_RESPUESTA', 'FECHA_MENSAJE');  //Diccionario de variables a conseguir
            $elementos = (count($descripcionVariable));
            //Almacen de variables en la lista info_tienda
            $filas_guardadas = 0;
            while ($fila = mysqli_fetch_assoc($result)){//realizar la busqueda
                $posision_columna = 0;
                while ($posision_columna < $elementos){//ingresar cada uno de los valores de la tienda en una lista
                    $chat_tienda[$filas_guardadas][$posision_columna] = $fila [$descripcionVariable[$posision_columna]];
                    $posision_columna++;
                }
                $filas_guardadas++;
            }
            //Salida por consola
            $filas_impresas = 0;
            while ($filas_impresas<$filas_guardadas){
                echo "<script>console.log('--------------------------------------------')</script>";

                $posision_columna = 0;
                while ( $posision_columna < $elementos ){
                    echo "<script>console.log(' $descripcionVariable[$posision_columna]: " . 
                                                $chat_tienda[$filas_impresas][$posision_columna] . " ')</script>";
                    $posision_columna++;
                } 
                $filas_impresas++;
            }
            $connect -> close();
            echo "<script>console.log('mTiendasChat::pedirChat')</script>";
            return $chat_tienda;
        }

        /**
         * Obtiene los mensajes recibidos por todos los usuarios junto a la ID del usuario que lo envia
         * @param   entero  ID de la tienda
         * @return  lista   Lista de los mensajes recibidos junto a los ID de quienes lo envian
         */
        static function mensajesRecibidos($ID_TIENDA){
            $connect = conexionBaseDatos();

            $sql  = "SELECT * ";
            $sql .= "FROM CHAT_TIENDA ";
            $sql .= "WHERE ID_TIENDA = '$ID_TIENDA'";
            $result = $connect -> query($sql);

            $descripcionVariable = array('ID_REMITENTE', 'MENSAJE');  //Diccionario de variables a conseguir
            $elementos = (count($descripcionVariable));
            //Almacen de variables en la lista info_tienda
            $filas_guardadas = 0;
            while ($fila = mysqli_fetch_assoc($result)){//realizar la busqueda
                $posision_columna = 0;
                while ($posision_columna < $elementos){//ingresar cada uno de los valores de la tienda en una lista
                    $chat_tienda[$filas_guardadas][$posision_columna] = $fila [$descripcionVariable[$posision_columna]];
                    $posision_columna++;
                }
                $filas_guardadas++;
            }
            //Salida por consola
            $filas_impresas = 0;
            while ($filas_impresas<$filas_guardadas){
                echo "<script>console.log('--------------------------------------------')</script>";

                $posision_columna = 0;
                while ( $posision_columna < $elementos ){
                    echo "<script>console.log(' $descripcionVariable[$posision_columna]: " . 
                                                $chat_tienda[$filas_impresas][$posision_columna] . " ')</script>";
                    $posision_columna++;
                } 
                $filas_impresas++;
            }
            $connect -> close();
            echo "<script>console.log('mTiendasChat::mensajesRecibidos')</script>";
            return $chat_tienda;
        }
    }
    

