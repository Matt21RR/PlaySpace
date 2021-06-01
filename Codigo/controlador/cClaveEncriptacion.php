<?php
//TODO Funciones a usar : enviarClaveEncriptacion(); | recibirClaveEncriptacion(); | pedirCopiaClaveEncriptacion();
include_once ("cCifradoContrasena.php");
include_once ("../modelo/mAmigosClaveEncriptacion.php");
    class cClaveEncriptacion extends cCifradoContrasena{

        static $iteraciones = 500000;

        /**
         * Encripta la clave de encriptacion de los mensajes usando como clave de encriptacion
         * la contraseña del usuario hasheada.
         * @param   texto   Clave de encriptacion a encriptar.
         * @param   texto   Contraseña del usuario.
         * @return  texto   Semilla usada para encriptar + la clave de encriptacion encriptada
         */
        static function encriptarClave($texto,$contrasena){
            include_once ("cAmigosMensajes.php");

            $semilla = self::generarSemilla();
            $claveEncriptacionEncriptada = cAmigosMensajes::encriptar($texto,self::hashearContrasena($contrasena,$semilla,self::$iteraciones));
            echo "<script>console.log('cClaveEncriptacion::encriptarClave -> ".$claveEncriptacionEncriptada."')</script>";
            return $semilla.$claveEncriptacionEncriptada;
        }

        /**
         * Desencripta la clave de encriptacion de los mensajes usando como clave de desencriptacion
         * la contraseña del usuario hasheada.
         * @param   texto   Clave de encriptacion a desencriptar.
         * @param   texto   Contraseña del usuario.
         * @return  texto   la clave de encriptacion desencriptada
         */
        static function desencriptarClave($texto, $contrasena){
            include_once ("cAmigosMensajes.php");

            $semilla = substr($texto,0,6);
            $texto = substr($texto,6);
            $claveEncriptacionDesencriptada = cAmigosMensajes::desencriptar($texto,self::hashearContrasena($contrasena,$semilla,self::$iteraciones));
            echo "<script>console.log('cClaveEncriptacion::desencriptarClave -> ".$claveEncriptacionDesencriptada."')</script>";
            return $claveEncriptacionDesencriptada;
        }
        /**
         * Crea una clave para realizar encriptacion
         * @return  texto   Clave para realizar encriptacion
         */
        static function crearClaveEncriptado(){
            $bytes = random_bytes(16);
            $claveEncriptacion = bin2hex($bytes);
            echo "<script>console.log('mClaveEncriptacion::crearClaveEncriptado->$claveEncriptacion')</script>";
            return $claveEncriptacion;
        }
        /**
         * Envia la clave de encriptacion recien generada a los DOS
         * usuarios que son amigos
         * @param   texto   id del chat (union de los id de ambos usuarios)
         * @param   texto   clave de encriptacion
         */
        static function enviarClaveEncriptacion($id_chat){
            $clave = self::crearClaveEncriptado();
            $pL = $clave[0];
            $clave = $pL.$pL.$pL." ".$clave;
            mAmigosClaveEncriptacion::enviarClave($id_chat,$clave);
            echo "<script>console.log('cClaveEncriptacion::enviarClave->$id_chat')</script>";
        }
        /**
         * Enviar la clave de encriptacion ya encriptada
         * @param   texto   id del chat (union de los id de ambos usuarios)
         * @param   numero  id del usuario
         * @param   texto   clave de encriptacion ya encriptada
         */
        static function enviarClaveEncriptacionEncriptada($id_chat,$id_usuario, $claveEncriptacion){
            $ids_array = explode(" ",$id_chat);
            //DONDE GUARDAR LA CLAVE ENCRIPTADA
            if($ids_array[0] == $id_usuario){
                $guardar_en = 0;
            }elseif($ids_array[1] == $id_usuario){
                $guardar_en = 1;
            }else{
                $guardar_en = -1;
            }

            if ($guardar_en != -1){//ENVIAR LA CLAVE
                mAmigosClaveEncriptacion::enviarClaveEncriptada($id_chat, $guardar_en,$claveEncriptacion);
            }else{//ERROR DE DATOS
                echo "<script>console.err('cClaveEncriptacion::enviarClave->Error en los datos ingresados')</script>";
                $id_chat = 0;
            }
            echo "<script>console.log('cClaveEncriptacion::enviarClave->$id_chat')</script>";
        }

        /**
         * Obtener la clave de encriptacion para los mensajes de amigos.
         * @param   texto   Id del chat (union de los id de ambos usuarios).
         * @param   numero  Id del usuario.
         * @param   texto   Contraseña del usuario.
         * @return  texto   Clave de encriptacion de los mensajes ya desencriptada y lista para usar.
         */
        static function recibirClaveEncriptacion($id_chat,$id_usuario,$contrasena){
            $repetir = True;
            while ($repetir == true){//MIENTRAS LA CLAVE RECIBIDA NO ESTE ENCRIPTADA...
                $clave = mAmigosClaveEncriptacion::pedirClaveEncriptada($id_chat,$id_usuario);
                if ($clave != null){
                    $repetir = False;
                    if(($clave[0] == $clave[1]) && ($clave[0] == $clave[1]) && $clave[3]==" "){//DISTINTIVO DE UNA CLAVE NO ENCRIPTADA
                        "<script>console.warn('cClaveEncriptacion::recibirClaveEncriptacion->La clave debe de ser encriptada y reenviada')</script>";
                        //OBTENER,ENCRIPTAR Y ENVIAR LA CLAVE
                        $clave = substr($clave,4);
                        cClaveEncriptacion::enviarClaveEncriptacionEncriptada(  $id_chat,
                                                                                $id_usuario,   
                                                                                cClaveEncriptacion::encriptarClave($clave,$contrasena));
                        $repetir = true;
                    }else{
                        //DESENCRIPTAR LA CLAVE OBTENIDA
                        $clave = self::desencriptarClave($clave,$contrasena);
                        //VERIFICAR QUE LA CLAVE DEL AMIGO NO ESTE VACIA
                        $vCA = self::verificarClaveAmigo($id_usuario,$id_chat); 
                        if($vCA != -1){
                            $pL = $clave[0];
                            $copyClave = $pL.$pL.$pL." ".$clave;
                            mAmigosClaveEncriptacion::enviarClaveAmigo($id_chat,$vCA,$copyClave);
                        }
                    }
                } 
                else{
                    echo "<script>console.err('cClaveEncriptacion::recibirClaveEncriptacion->No hay ninguna clave almacenada')</script>";
                }
            }
            echo "<script>console.log('cClaveEncriptacion::recibirClaveEncriptacion->$clave')</script>";
            return $clave;
        }
        /**
         * Borra la clave de encriptacion de mensajes propia para que el otro usuario sepa que
         * necesita que le facilite una copia de la clave sin encriptar
         * *NOTA: Esto se realiza cuando el usuario cambia su contraseña
         * @param   numero  id del usuario.
         * @param   texto   Id del chat (union de los id de ambos usuarios).
         */
        static function pedirCopiaClaveEncriptacion($id_usuario,$id_chat){
            $ids_array = explode(" ",$id_chat);
            //DONDE GUARDAR LA CLAVE ENCRIPTADA
            if($ids_array[0] == $id_usuario){
                $borrar_en = 0;
            }elseif($ids_array[1] == $id_usuario){
                $borrar_en = 1;
            }else{
                $borrar_en = -1;
            }

            if ($borrar_en != -1){//ENVIAR LA CLAVE
                mAmigosClaveEncriptacion::pedirClaveAmigo($id_chat,$borrar_en);
            }else{//ERROR DE DATOS
                echo "<script>console.err('cClaveEncriptacion::pedirClaveAmigo->Error en los datos ingresados')</script>";
                $id_chat = 0;
            }
            echo "<script>console.log('cClaveEncriptacion::pedirClaveAmigo->$id_chat , $borrar_en')</script>";
        }
        /**
         * Verifica que la clave del amigo no este vacia o sea nula
         * @param   numero  id del usuario.
         * @param   texto   Id del chat (union de los id de ambos usuarios).
         * @return  numero  posision de la fila en la cual se encuentra el campo de clave vacion del amigo
         *                  1- = El amigo cuenta con su clave.
         */
        static function verificarClaveAmigo($id_usuario,$id_chat){
            $ids_array = explode(" ",$id_chat);
            //CUAL DE LOS DOS VERIFICAR
            if($ids_array[0] == $id_usuario){
                $verificar = 1;
            }elseif($ids_array[1] == $id_usuario){
                $verificar = 0;
            }else{
                $verificar = -1;
            }
            if ($verificar != -1){//REVISAR LA CLAVE DEL OTRO USUARIO
                $cA = mAmigosClaveEncriptacion::revisarClaveAmigo($id_chat,$verificar);

                if(($cA != " ") && ($cA != null)){
                    echo "Sdepppaaa<p>";
                    $resultado = -1;
                }else{
                    echo "Sdeppp<p>";
                    $resultado = $verificar;
                }
            }else{//ERROR DE DATOS
                echo "<script>console.err('cClaveEncriptacion::verificarClaveAmigo->Error en los datos ingresados')</script>";
                $resultado = -1;
            }
            echo "<script>console.log('cClaveEncriptacion::verificarClaveAmigo->$resultado')</script>";
            return $resultado;
        }
    }
    //cClaveEncriptacion::enviarClaveEncriptacion("1 4");
    //echo cClaveEncriptacion::recibirClaveEncriptacion("1 4",1,"gamerdefnaf3");