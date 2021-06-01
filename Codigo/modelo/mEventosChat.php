<?php
    include_once('../mBaseDatos.php');
    include_once("../mMaster.php");
    class mEventosChat{
        /**
     * Envia los mensajes de los participantes.
     * @param   numero  id de la persona que envia el mensaje
     * @param   numero  id del evento al cual corresponde el chat
     * @param   texto   mensaje a enviar
     */
    static function enviarMensaje($ID_USUARIO,$ID_EVENTO,$MENSAJE){
        $connect = conexionBaseDatos();
        $sql="INSERT INTO CHAT_EVENTO VALUES('$ID_EVENTO',
                                            '$MENSAJE',
                                            current_timestamp(),
                                            '$ID_USUARIO')";
        $result = $connect -> query($sql);
        comprobarDatosafectados($connect);
        echo "<script>console.log('mChatEvento::enviarMensaje')</script>";
        $connect->close();
    }
    /**
     * Pide toda la lista de mensajes correspondientes al chat del evento.
     * @param   numero  id del evento
     * @return  lista   lista de mensajes del chat del evento
     */
    static function pedirChat($ID_EVENTO){
        $connect = conexionBaseDatos();
        $sql = "SELECT * FROM CHAT_EVENTO WHERE ID_EVENTO = '$ID_EVENTO'";
        $result = $connect -> query($sql);
        $posicion = 0;
        while ($fila = mysqli_fetch_assoc($result)){
            $lista_mensajes[0][$posicion] = $fila ['ID_REMITENTE'];
            $lista_mensajes[1][$posicion] = $fila ['FECHA_MENSAJE'];
            $lista_mensajes[2][$posicion] = $fila ['MENSAJE'];
            $posicion++;
        }
        echo "<script>console.log('mChatEvento::pedirChat-> Cantidad de mensajes: $posicion')</script>";
        $connect->close();
        return $lista_mensajes;
    }
    }
    