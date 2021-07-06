<?php
    include_once ('../mBaseDatos.php');
    include_once ("../mMaster.php");

    /**
     * Enviar mensaje a la sala en donde se encuentran el/los amigos
     * @param   texto   id de la sala
     * @param   texto   mensaje a enviar
     * @param   entero  id del remitente 
     */
    class mAmigosChat{
        static function enviarMensaje($ID_CHAT, $MENSAJE, $ID_REMITENTE){
            $connect = conexionBaseDatos();
    
            $sql  = "INSERT INTO CHAT_AMIGOS ";
            $sql .= "VALUES ('$ID_CHAT', ";
            $sql .= "'$MENSAJE', ";
            $sql .= "current_timestamp(), ";
            $sql .= "'$ID_REMITENTE')";
    
            $result = $connect -> query($sql);
            $resultado = comprobarDatosAfectados($connect);
            echo "<script>console.log('mChatAmigos::enviarChat')</script>";
            $connect->close();
            return $resultado;
        }
    
        //enviarChat($_GET['ID_CHAT'], $_GET['MENSAJE'], $_GET['ID_REMITENTE']);
    
        /**
         * Pedir los mensajes enviados en una sala
         * @param   texto   id de la sala
         * @return  lista   lista de los id de los usuarios que enviaron mensajes, 
         *                  los mensajes enviados y la fecha del envio
         */
        static function pedirMensajes ($ID_CHAT){
            $connect = conexionBaseDatos();
    
            $sql  = "SELECT ID_REMITENTE, MENSAJE, FECHA_MENSAJE ";
            $sql .= "FROM CHAT_AMIGOS ";
            $sql .= "WHERE ID_CHAT = '$ID_CHAT'";
    
            $result = $connect -> query($sql);
    
            
            //Almacen de variables en la lista chat_amigos
            $filas_guardadas = 0;
            while ($fila = mysqli_fetch_assoc($result)){//realizar la busqueda
                $chat_amigos[$filas_guardadas][0] = $fila ['ID_REMITENTE'];
                $chat_amigos[$filas_guardadas][1] = $fila ['MENSAJE'];
                $chat_amigos[$filas_guardadas][2] = $fila ['FECHA_MENSAJE'];
                $filas_guardadas++;
            }
            
            $filas_guardadas--;
             if ($filas_guardadas >= 0){
    
                //Salida por consola
                echo "<script>console.log('mChatAmigos::pedirAmigos')</script>";
                echo "<script>console.log('--------------------------------------------')</script>";
    
                //mientras la cantidad de columnas impresas sea menor a la 
                //cantidad de columnas que tiene el arreglo entonces..
             }    
             $connect -> close();
            return $chat_amigos;
        }
    }
    
