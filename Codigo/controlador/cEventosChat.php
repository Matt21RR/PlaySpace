<?php
    include_once ("../modelo/mEventosChat.php");   
    include_once ("cValidacion.php");
    class cEventosChat{
        static function recibirMensajes($id_evento){
            $mensajes = mEventosChat::pedirChat($id_evento);
            $cantMensajes = count($mensajes[0]);
            echo "<script>console.log('cEventosChat::recibirMensajes-> Cantidad de mensajes de este chat ".$cantMensajes."')</script>";
            return $mensajes;
        }
        static function enviarMensaje($id_usuario,$id_evento,$mensaje){
            $vTexto = cValidacion::validarTexto($mensaje);
            $pNoPermitidas = cValidacion::busquedaGeneralPalabrasNoPermitidas($mensaje);
            if ( $vTexto == 1 && $pNoPermitidas == 0){
                mEventosChat::enviarMensaje($id_usuario,$id_evento,$mensaje);
                echo "<script>console.log('cEventosChat::enviarMensaje-> mensaje enviado a ".$id_evento."')</script>";
            }else{
                //No deben de haber caracteres no permitidos
                echo "<script>console.err('cEventosChat::enviarMensaje-> No se puede enviar el mensaje porque ".$vTexto." deberia de ser un 1')</script>";
                //No deben de haber palabras no permitidas
                echo "<script>console.err('cEventosChat::enviarMensaje-> o porque ".$pNoPermitidas." deberia de ser un 0')</script>";
            }
        }   
    }
    //cEventosChat::enviarMensaje(4,11,"Sting ray");
    //cEventosChat::recibirMensajes(11);