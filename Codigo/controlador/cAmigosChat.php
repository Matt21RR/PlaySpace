<?php
    include_once ("cClaveEncriptacion.php");    
    include_once ("cAmigosMensajes.php");    
    include_once ("../modelo/mAmigosChat.php");    
    include_once ("cValidacion.php");

    class cAmigosChat extends cClaveEncriptacion{
        /**
         * Envia un mensaje al chat
         * @param   texto   Id del chat donde enviar el mensaje.
         * @param   texto   Mensaje a enviar.
         * @param   numero  Id del usuario que esta enviando el mensaje.
         * @param   texto   Contrasena de la cuenta del usuario.
         */
        static function enviarMensaje ($id_chat,$mensaje,$id_usuario,$contrasena){
            //TRAER LA CLAVE DE ENCRIPTACION DE LA BASE DE DATOS
            $clave = self::recibirClaveEncriptacion($id_chat, $id_usuario, $contrasena);
            //REVISAR EL MENSAJE
            $vTexto = cValidacion::validarTexto($mensaje);
            $pNoPermitidas = cValidacion::busquedaGeneralPalabrasNoPermitidas($mensaje);
            if ( $vTexto == 1 && $pNoPermitidas == 0){
                $mensajeEnc= cAmigosMensajes::encriptar($mensaje,$clave);//ENCRIPTAR EL MENSAJE A ENVIAR
                $resultado = mAmigosChat::enviarMensaje($id_chat, $mensajeEnc,$id_usuario);//ENVIAR MENSAJE
                echo "<script>console.log('cAmigosChat::enviarMensaje-> mensaje enviado a ".$id_chat."')</script>";
                
            }
            else{
                $resultado =-1; //
                
                //No deben de haber caracteres no permitidos
                echo "<script>console.err('cAmigosChat::enviarMensaje-> No se puede enviar el mensaje porque ".$vTexto." deberia de ser un 1')</script>";
                //No deben de haber palabras no permitidas
                echo "<script>console.err('cAmigosChat::enviarMensaje-> o porque ".$pNoPermitidas." deberia de ser un 0')</script>";
            }
            return $resultado;
        }
        /**
         * Obtiene los mensajes de un chat
         * @param   texto   Id del chat donde enviar el mensaje.
         * @param   numero  Id del usuario que esta enviando el mensaje.
         * @param   texto   Contrasena de la cuenta del usuario.
         * @return  lista   lista de los mensajes:
         *                  ID del remitente | Mensaje | Fecha y hora del mensaje.
         */
        static function recibirMensajes ($id_chat, $id_usuario, $contrasena){
            //TRAER LA CLAVE DE ENCRIPTACION DE LA BASE DE DATOS
            $clave = self::recibirClaveEncriptacion($id_chat, $id_usuario, $contrasena);
            //OBTENER LOS MENSAJES
            $mensajes = mAmigosChat::pedirMensajes($id_chat);
            $mensDescifrados = $mensajes;
            //DESENCRIPTARLOS
            $cantMensajes = count($mensajes);
            for ($descifrar = 0; $descifrar != $cantMensajes; $descifrar++){
                $mensDescifrados[$descifrar][1] = cAmigosMensajes::desencriptar($mensajes[$descifrar][1], $clave);
                //echo $mensDescifrados[$descifrar][0]." | ".$mensDescifrados[$descifrar][1]." | ".$mensDescifrados[$descifrar][2];
            }
            echo "<script>console.log('cAmigosChat::recibirMensajes-> ".$id_chat."')</script>";
            return $mensDescifrados;
        }
    }
    cAmigosChat::recibirMensajes("1_6",6,"202gamerdefnaf3");