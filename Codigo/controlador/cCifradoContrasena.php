<?php

    class cCifradoContrasena {
        /**
         * Hashea la contraseña
         * @param   texto   Contraseña a hashear
         * @param   texto   Semilla de 6 digitos con la cual hashear la contraseña
         */
        static function hashearContrasena($contrasena,$semilla, $iteraciones = 2000000){
            /*Implementacion del PBKDF2..... para crear una clave para cifrar la clave de encriptado de los mensajes
            //este proceso solo se realiza una vez para guardar una copia cifrada de la clave de cifrado de los mensaje, de forma segura en la base de datos.
            //tambien se realiza al iniciar sesion, para descifrar las claves de cifrado de los mensajes

            //para ajustar el tiempo que se emplea siga la siguiente tabla
            //-----------------------------
            //|  Iteraciones  | Segundos |
            //|    500.000    |     1    |
            //|   1'000.000   |     2    |
            //|   2'000.000   |    3.2   |
            //-----------------------------
            //La relacion entre los valores es de aproximadamente 555.555 / 1
            //Recuerde que mientras mas iteracciones se realicen mas segura sera la clave de cifrado creada,
            //ademas el tiempo de inicio de sesion se alarga y dificulta mas los posibles ataques de diccionario.
            //Se recomienda no reducir demasiado el numero de iteraciones.
            */
            $tamanoResultado = 50;

            $contrasenaHasheada = hash_pbkdf2("sha256", $contrasena, $semilla, $iteraciones, $tamanoResultado);

            if (strlen($semilla) != 6){
                echo "<script>console.error('cCifradoContrasena::hashearContrasena->La semilla debe de tener EXACTAMENTE 6 digitos')</script>";
                $contrasenaHasheada = "Error!";
            }

            echo "<script>console.log('cCifradoContrasena::hashearContrasena-> ".$contrasenaHasheada."')</script>";
            echo "<script>console.log('->Contraseña = ".$contrasena."')</script>";
            echo "<script>console.log('->Semilla = ".$semilla."')</script>";
            echo "<script>console.log('-># iteraciones = ".$iteraciones."')</script>";

            
            return $contrasenaHasheada;
        }
        /**
         * Genera una semilla para encriptar la contraseña con hash
         * @return  numero  semilla
         */
        static function generarSemilla(){
            $semilla = random_int(100000,999999);//igual a rand() pero permite que el numero generado sea mas apto para criptografia
            echo "<script>console.log('cCifradoContrasena::generarSemilla-> ".$semilla."')</script>";
            return $semilla;
        }
        /**
         * Incrusta la semilla de encriptacion de una contraseña hasheada
         * en la propia contraseña hasheada
         * @param   texto   Contraseña hasheada sin o con su semilla incrustada
         * @param   numero  Semilla a incrustar.
         *                  Si esta vacio este campo significa que lo que se quiere hacer es
         *                  extraer la semilla de una contraseña hasheada que tiene su
         *                  semilla incrustada dentro de si(Porfavor usar extraerSemilla(); para hacerlo)
         * @return  texto   La contraseña hasheada con la contraseña incrustada o la semilla
         *                  (Depende del parametro anterior).
         */
        static function incrustarSemilla ($contrasenaHasheada,$seed = null){
            //TODO: Designar posiciones de incrustacion de la semilla usando la siguiente tabla.
            //-El primer numero de la semilla se incrusta en la posicion #3.
            //-Si la operacion entre el anterior valor de la semilla y al que se le esta introduciendo la posicion a incrustar
            //  da igual a  = 0, usar el valor de la semilla.
            //-Si el valor de la operacion anterior.
            //-Si el valor de la semilla a usar como posicion es igual a 0, usar el 3.
            
            if ($seed == null){ // SE DESEA EXTRAER LA SEMILLA
                $fragmento = str_split($contrasenaHasheada);
                $semilla[0] = $fragmento[3];
                $semilla[1] = $fragmento[$semilla[0]+3];
                

                $listaPosicionesIncrustar[0] = 3;
                $listaPosicionesIncrustar[1] = $semilla[0]+3;
            }else{ // SE DESEA INSERTAR LA SEMILLA
                $semilla = str_split("$seed") ;
                $tmp_contrasena = str_split($contrasenaHasheada);// ?se hace una sola vez
                $listaPosicionesIncrustar[0] = 3;
                $listaPosicionesIncrustar[1] = $semilla[0] + 3;

                $tmp_contrasena[$listaPosicionesIncrustar[0]] =$semilla[0];
                $tmp_contrasena[$listaPosicionesIncrustar[1]] =$semilla[1];
            }
            $posicionValorIncrustado = 2;

            while ($posicionValorIncrustado != 6){
                //DECIDIR LA POSICION DONDE INCRUSTAR_EXTRAER LA SEMILLA
                $valorSemilla = $semilla[$posicionValorIncrustado-1];

                $posMinus1 = $semilla[$posicionValorIncrustado-1];
                $posMinus2 = $semilla[($posicionValorIncrustado-2)];
                
                if( ($valorSemilla == 0) or 
                    ($valorSemilla == 1) or 
                    ($valorSemilla == 2) or 
                    ($valorSemilla == 3)){

                    $tmp_posicionIncrustar = $posMinus1+$posMinus2;

                }elseif(($valorSemilla == 4) or 
                        ($valorSemilla == 5) or 
                        ($valorSemilla == 6) or 
                        ($valorSemilla == 7)){

                    $tmp_posicionIncrustar = $posMinus1-$posMinus2;

                }elseif(($valorSemilla == 8) or 
                        ($valorSemilla == 9)){

                    $tmp_posicionIncrustar = $posMinus1*$posMinus2;

                }
                //SI ES NEGATIVA ENTONCES VOLVERLA POSITIVA
                if ($tmp_posicionIncrustar<0){
                    $tmp_posicionIncrustar = $tmp_posicionIncrustar*-1;
                }
                //USAR EL ULTIMO DIGITO DEL RESULTADO DE LAS OPERACIONES
                $tmp_posicionIncrusta = substr("$tmp_posicionIncrustar",-1);

                //SI ES IGUAL A CERO ENTONCES USAR EL 3
                if ($tmp_posicionIncrusta==0){
                    $tmp_posicionIncrusta = 3;
                }
                
                //INTRODUCIR EL ULTIMO RESULTADO EN LA LISTA DE POSICIONES A USAR
                $listaPosicionesIncrustar[$posicionValorIncrustado] = $listaPosicionesIncrustar[$posicionValorIncrustado-1]+$tmp_posicionIncrusta;

                if($seed == null){
                    $semilla[$posicionValorIncrustado] = $fragmento[$listaPosicionesIncrustar[$posicionValorIncrustado]];
                    
                }else{
                    $tmp_contrasena[$listaPosicionesIncrustar[$posicionValorIncrustado]] =$semilla[$posicionValorIncrustado];
                }
                $posicionValorIncrustado++;
            }

            if($seed == null){
                $resultado = implode($semilla);
            }else{
                $resultado = implode($tmp_contrasena);
                echo "<script>console.log('cCifradoContrasena::incrustarContrasena-> ".$resultado."')</script>";
            }

            return $resultado;
        }
        /**
         * Extrae la semilla de encriptacion de una contraseña hasheada que 
         * tiene su semilla incrustada dento de si misma.
         * @param   texto   la contraseña hasheada de donde se desea sacar su semilla
         * @return  texto   la semilla de la contraseña
         */
        static function extraerSemilla ($contrasenaHasheadaSemilla){
            $resultado = incrustarSemilla($contrasenaHasheadaSemilla);
            echo "<script>console.log('cCifradoContrasena::extraerContrasena-> ".$resultado."')</script>";
            return $resultado;
        }
    }
    
    //echo "<p>";
    //generarSemilla();
    //echo "<p>";
    //echo hashearContrasena("gamerdefnaf3",generarSemilla());
    //echo "<p>";
    //echo incrustarSemilla(hashearContrasena("elbiernez",561258),561258);
    //echo extraerSemilla(incrustarSemilla(hashearContrasena("gamerdefnaf3",167258),167258));


    