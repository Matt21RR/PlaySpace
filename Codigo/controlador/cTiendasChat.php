<?php
    include_once('../modelo/mTiendasChat.php');     //Herencia
    include_once('cValidacion.php');                //Temporal

    class cTiendasChat extends mTiendasChat
    {
        /**
         * Obtiene y muestra por consola los mensajes junto a los ID del usuario quien lo envia,
         * recibidos de una tienda
         * @param   entero  ID de la tienda
         * @return  lista   Lista de los mensajes recibidos junto a los ID de quienes lo envian
         */
        static function mostrarMensajes($ID_TIENDA){
            $chat_tienda = self::mensajesRecibidos($ID_TIENDA);

            echo "<script>console.log('cTiendasChat::mostrarMensajes')</script>";
            return $chat_tienda;
        }

        /**
         * Obtiene y muestra por consola los mensajes junto al ID del usuario que lo envia,
         * recibidos de una tienda
         * @param   entero  ID de la tienda
         * @return  lista   Lista de los mensajes recibidos junto a los ID de quien lo envia
         */
        static function mostrarMensajeUsuario($ID_TIENDA, $ID_REMITENTE){
            $chat_tienda = self::pedirChat($ID_TIENDA, $ID_REMITENTE);
            return $chat_tienda;
        }

        /**
         * Enviar mensajes para USUARIOS a una tienda
         * @param   entero  ID de la tienda a la cual se le enviara el mensaje
         * @param   entero  ID del usuario que envia el mensaje
         * @param   texto   Mensaje que sera enviado
         */
        static function cEnviarMensaje($ID_TIENDA,$ID_REMITENTE,$MENSAJE){
            if(cValidacion::validarTexto($MENSAJE)==1){
                self::EnviarMensaje($ID_TIENDA,$ID_REMITENTE,$MENSAJE);
            } else{
                echo "<script>console.error('Mensaje no enviado')</script>";
            }
        }

        /**
         * Responde la TIENDA el mensaje realizado por un usuario
         * @param   entero  ID tienda
         * @param   entero  ID usuario
         * @param   texto   Mensaje de respuesta
         * @param   entero  Posición fila del mensaje a responder
         */
        static function responderMensaje($ID_TIENDA,$ID_REMITENTE,$MENSAJE_RESPUESTA, $FILA_MENSAJE){
            
            if(cValidacion::validarTexto($MENSAJE_RESPUESTA)==1){
                $chat_tienda = self::mostrarMensajeUsuario($ID_TIENDA,$ID_REMITENTE);
                $FECHA_MENSAJE = $chat_tienda[$FILA_MENSAJE][3];      //[][3] fecha del mensaje recibido

                self::EnviarMensajeTienda($ID_TIENDA,$ID_REMITENTE,$FECHA_MENSAJE,$MENSAJE_RESPUESTA);
            } else{
                echo "<script>console.error('Mensaje no enviado')</script>";
            }
        }
    }