<?php
    // TODO: Funciones a usar : Encriptar(); | Desencriptar();
    class cAmigosMensajes{
        /**
         * Encripta un mensaje / texto
         * @param   texto   mensaje o texto a encriptar
         * @param   texto   clave con la cual cifrar el mensaje
         * @return  texto   mensaje encriptado
         */
        static function encriptar($mensaje,$clave){
            //CONFIGURACION DEL ENCRIPTADOR
            $tipoEncriptacion = "AES-256-CBC";
            $opcion = 0; // 0 para introducir datos en RAW | 1 para datos en Byte(base64_decode)
            $iv = random_bytes(openssl_cipher_iv_length($tipoEncriptacion)/2);//Crear un vector de inicio apropiado para el tipo de encriptacion
            $iv = bin2hex($iv);

            //ENCRIPTADOR
            $encriptado = openssl_encrypt($mensaje,$tipoEncriptacion,$clave,$opcion,$iv);
            $resultado = self::insertarIV($encriptado,$iv);//se guarda el texto encriptado mas el vector de inicio generado en la variable de retorno
            return ($resultado);
        }
        /**
         * Desencripta un texto
         * @param   texto   Texto del mensaje encriptado
         * @param   texto   Clave con la cual se encriptó el texto
         * @return  texto   Texto desencriptado
         */
        static function desencriptar($texto,$clave){
            //SEPARACION DEL IV Y MENSAJE ENCRIPTADO
            $mensajeEncriptado = self::removerIV($texto);
            $iv = substr($mensajeEncriptado,0,16);
            $mensajeEncriptado = substr($mensajeEncriptado,16);

            //CONFIGURACION DE DESENCRIPTADOR
            $opcion = 0;
            $tipoEncriptacion = "AES-256-CBC";

            //DESENCRIPTADOR
            $desencriptado = openssl_decrypt($mensajeEncriptado,$tipoEncriptacion,$clave,$opcion,$iv);
            return($desencriptado);
        }
        /**
         * Inserta el vector de inicio en el mensaje encriptado.
         * @param   texto   el mensaje encriptado.
         * @param   texto   el vector de inicio que se utilizo para encriptar el mensaje.
         * @return  texto   el texto del mensaje encriptado junto al texto del vector de inicio.
         */
        static function insertarIV($texto,$iv){
            $insertar = 0; //Caracter del vector de inicio a insertar
            $posicionInsersion = 0; //posicion donde insertar el caracter del vector de inicio en el texto
            while ($insertar != 16){
                // ? Si el caracter anterior es un numero
                if ((is_numeric($iv[$insertar-1])==true) && $insertar != 0){
                    $posicionInsersion++;
                }else{ // ? Si el caracter anterior NO es un numero
                    $posicionInsersion = $posicionInsersion+2;
                }
                //DIVIDIR EL TEXTO EN LA POSICION DONDE TOCA INTRODUCIR EL CARACTER DEL IV
                $textoInicio = substr($texto,0,($posicionInsersion));
                $textoFin = substr($texto,$posicionInsersion);
                //UNIR LAS DOS PARTES CON EL CARACTER DEL IV A INSERTAR ENTRE ELLAS DOS
                $texto = $textoInicio.$iv[$insertar].$textoFin;
                $insertar++;
            }
            return $texto;
        }
        /**
         * Extrae el vector de inicio del texto que tiene el mensaje encriptado + el vector de inicio insertado.
         * @param   texto   mensaje encriptado + el vector de inicio insertado.
         * @return  texto   vector de inicio + mensaje encriptado.
         *                  : (IV = primeros 16 caracteres | Mensaje encriptado = los demas caracteres)
         * *                Nota: Es un solo texto que contiene ambos valores unidos por concatenación.
         */
        static function removerIV($texto){
            $texto = str_split($texto);
            $extraer = 0;
            $posicionExtraer = 2;
            $listaPosicionesExtraer[0] = 2;
            //OBTENER LA LISTA DE LAS POSICIONES DE LOS CARACTERES DEL IV QUE ESTAN EN EL TEXTO
            while ($extraer != 15){
                if ((is_numeric($texto[$posicionExtraer]) == true)){//si el caracter que esta en la posicion de extracion es un numero
                    $posicionExtraer++;
                }else{
                    $posicionExtraer = $posicionExtraer + 2;
                }
                $listaPosicionesExtraer[$extraer+1] = $posicionExtraer;//obtener la posicion del valor actual valor
                $extraer++;
            }
            $texto = implode($texto);
            $pos = 15;
            $extraido = 15;
            //EXTRAER LOS CARACTERES DEL IV DEL TEXTO
            while($extraido != -1){
                $iv[$pos] = $texto[$listaPosicionesExtraer[$extraido]];//guardar los caracteres
                //Remover los caracteres del IV del texto
                $textoInicio = substr($texto,0,($listaPosicionesExtraer[$extraido]));
                $textoFin = substr($texto,$listaPosicionesExtraer[$extraido]+1);
                $texto = $textoInicio.$textoFin; 

                $pos--;
                $extraido--;
            }
            ksort($iv);
            $iv = implode($iv);
            return $iv.$texto;
        }
    }
    //$key =  cAmigosMensajes::crearClaveEncriptado();

    //$claveEncriptada = cClaveEncriptacionMensajes::encriptarClave($key,"gamerdefnaf3");
    //$claveDesencriptada = cClaveEncriptacionMensajes::desencriptarClave($claveEncriptada,"gamerdefnaf3");
    //echo cAmigosMensajes::desencriptar((cAmigosMensajes::encriptar("Risky Bussiness",$claveDesencriptada)),$claveDesencriptada);
    
    