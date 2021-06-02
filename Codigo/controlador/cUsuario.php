<?php
    include_once('cValidacion.php');        //Temporal

    class cUsuario
    {
        /**
         * Determinar los límites y descripción de la variable para 
         *                      0 = NOMBRE USUARIO
         *                      1 = CONTRASENA
         *                      2 = CORREO
         *                      3 = TELEFONO
         * @param   entero  Variable que determina que límite sera impuesto
         * @return  lista   lista de las variables obtenidas
         */
        static function decidir($evaluar){
            if( $evaluar == 0 ){
                $nombre_evaluar = "NOMBRE_USUARIO";
                $evaluar = 1;
            } elseif( $evaluar == 1 ) {
                $nombre_evaluar = "CONTRASENA";
            }

            switch ($evaluar){
                case 1:     //Límites para NOMBRE_USUARIO y CONTRASENA 
                    $limite_min = 8;
                    $limite_max = 15;
                    break;

                case 2:     //Límite para CORREO
                    $nombre_evaluar = "CORREO";
                    $limite_min = 12;
                    $limite_max = 45;
                    break;

                case 3:     //Límite para TELEFONO
                    $nombre_evaluar = "TELEFONO";
                    $limite_min = 5;
                    $limite_max = 15;
                    break;
            }

            $variables[0] = $nombre_evaluar;
            $variables[1] = $limite_min;
            $variables[2] = $limite_max;

            echo "<script>console.log('cUsuario::decidir')</script>";
            return $variables;
        }

        /**
         * Comprobar que los valores a ingresar por el usuario cumplan con los limites impuestos
         * @param   lista   lista con el limite minimo, maximo y nombre de la variable
         * @param   entero   1 = variable disponible
         *                  -1 = variable no disponible  
         */
        static function pedirVariables($variables, $variable_evaluar){

            $nombre_evaluar = $variables[0] ;
            $limite_min = $variables[1];
            $limite_max = $variables[2]; 
            
            $tamano = strlen($variable_evaluar);

            if( $tamano <= $limite_max && $tamano >= $limite_min ){
                echo "<script>console.warn('$nombre_evaluar válido')</script>";
                $variableIngresada = 1;
            } elseif( $tamano > $limite_max ){
                echo "<script>console.error('Límite $nombre_evaluar excedido')</script>";
                $variableIngresada = -1;
            } else{
                echo "<script>console.error('Límite $nombre_evaluar no alcanzado')</script>";
                $variableIngresada = -1;
            } 

            echo "<script>console.log('cUsuario::pedirVariables')</script>";
            return $variableIngresada;
        }
        /**
         * Se evaluan los datos ingresados por el usuario para ver si cumplen con los parametros establecidos
         *          decidir - si cumple con el min y max del dato establecido 
         *          validarTexto - 0 = texto
         *                         1 = cadena de caracteres sin espacios y sin caracteres especiales
         *                         2 = correo
         *                         3 = contraseña
         * @param   texto   datos del usuario a comprobar
         * @param   entero  tipo de variable para validarTexto
         * @return  entero   1 = Variable Válida
         *                  -1 = Variable inválida
         *          
         */
        static function pedirDatos($datoIngresar, $datoEvaluar){
            $validacion = -1;

            if( $datoEvaluar == 1 ){
                $datoEvaluarDecidir = 0;
            } else if( $datoEvaluar == 3 ){
                $datoEvaluarDecidir = 1;
            } else {
                $datoEvaluarDecidir = $datoEvaluar;
            }

            $cValidacion = cValidacion::validarTexto( $datoIngresar, $datoEvaluar );

            echo "<script>console.log('cUsuario::pedirDatos')</script>";

            if( $cValidacion != 1 ){
                echo "<script>console.error('Los datos ingresados no cumplen con los parametros establecidos')</script>";
            } else {
                if(self::pedirVariables(self::decidir($datoEvaluarDecidir), $datoIngresar) == 1){
                    $validacion = 1;
                }
            }
            return $validacion;
        }
        /**
         * Se determina el ID_FOTO_PERFIL tomando encuenta la selección del usuario
         * @param   entero  ID foto de perfil determinada
         * @return  entero  0 = Error
         *                  1 = ID_FOTO_PERFIL encontrada
         */
        static function pedirIDFotoPerfil($ID_FOTO_PERFIL){
            echo "<script>console.log('cUsuario::pedirIDFotoPerfil')</script>";
            if( $ID_FOTO_PERFIL < 0 or $ID_FOTO_PERFIL > 11 ){
                echo "<script>console.error('Los datos ingresados no cumplen con los parametros establecidos')</script>";
                $ID_FOTO_PERFIL = -1;
            } else {
                echo "<script>console.warn('FOTO_PERFIL válido')</script>";
                $ID_FOTO_PERFIL = 1;
            }
            return $ID_FOTO_PERFIL;
        }    
    }