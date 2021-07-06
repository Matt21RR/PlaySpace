<?php
    include_once('cUsuario.php');           //temporal
    include_once('../modelo/mAutenticacion.php');   //Herencia
    include_once('cPerfil.php');  // Temporal
    include_once('../mMaster.php');

    class cAutenticacion extends mAutenticacion 
    {
// ------- PEDIR CORREO --------------------------------------------------------------------------
        /**
         * recibe el correo ingresado por el usuario y lo valida para ver si cumple con los parametros mínimos
         * @param   texto   correo ingresado por el usuario
         * @return  entero   1 = variable disponible
         *                  -1 = variable no disponible
         */
        static function pedirCorreo($correoIngresado){
            $validacion = -1;
            $variableIngresada = cUsuario::pedirDatos($correoIngresado, 2);     //Validar correo (2)

            if( $variableIngresada == 1){
                echo "<script>console.log('cAutenticacion::pedirCorreo')</script>";            
                $validacion = 1;
            }
            return $validacion;
        }
// ------- CLAVE VERIFICACION --------------------------------------------------------------------
        /**
         * Generador de clave de verificación
         * @param   entero  ID del usuario al cual se le almacenara la clave de verificación
         */
        static function crearClaveVerificacion($ID_USUARIO){
            $diccionarioCaracteres = array( '0','1','2','3','4','5','6','7','8','9','A','B','C','D','E','F',
                                            'G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V',
                                            'W','X','Y','Z' );  
            $claveVerificacion = "";
            // PIN = ######## (8 caracteres alfanumericos)
            for ($contador = 1; $contador <= 8; $contador++){
                $posicion = rand(0, 36);    //Toma un valor aleatoreo de $diccionarioCaracteres
                $claveVerificacion .= $diccionarioCaracteres[$posicion];
            }

            echo "<script>console.log('cAutenticacion::crearClaveVerificacion')</script>";
            self::enviarClaveVerificacion($ID_USUARIO, $claveVerificacion);
        }
        /**
         * Verificar la clave de verificación almacenada en la base de datos con 
         * la clave de verificación ingresada por el usuario
         * @param   entero  ID de usuario
         * @param   texto   clave de verificación por ingresada por del usuario
         * @return  entero   1 = Clave de verificación valida
         *                  -1 = Clave de verificación invalida
         */
        static function verificarClaveVerificacion($ID_USUARIO, $CLAVE_INGRESADA){
            $validacion = -1;
            // Comprobar que cumple con el timepo límite
            if(self::comprobarTiempoClaveVerificacion($ID_USUARIO) == 1){
                $CLAVE_VERIFICACION = self::pedirClaveVerificacion($ID_USUARIO);

                echo "<script>console.log('cAutenticacion::verificarClaveVerificacion')</script>";
                if($CLAVE_VERIFICACION == $CLAVE_INGRESADA){        //Comparación clave ingresada con la generada
                    $validacion = 1;
                }
            } else{ // Si el tiempo es superado eliminar la clave
                self::eliminarClaveVerificacion($ID_USUARIO);
            }
            return $validacion;
        }
        /**
         * Elimina la clave de verificacion generada
         * @param   entero  ID_USUARIO
         */
        static function eliminarClaveVerificacion($ID_USUARIO){
            mAutenticacion::borrarClaveVerificacion($ID_USUARIO);
        }
// ------- TIEMPO CLAVE VERIFICACION ----------------------------------------------------------------------------------------    
        /**
         * Toma la fecha del momento en donde se crea la clave de verificacion y la compara al timepo actual
         * @param   entero  ID_USUARIO
         * @param   entero  -1 = Tiempo superado
         *                   1 = Tiempo no superado
         */
        static function comprobarTiempoClaveVerificacion($ID_USUARIO){
            $fechaActual = date_create(mMaster::tiempo()); // Obtener fecha actual Y-m-d h:i:s
            if(!isset($_SESSION['fecha_maxima'])){
                $_SESSION['fecha_maxima'] = date_create(mMaster::tiempo()); // Obtener fecha actual Y-m-d h:i:s
                date_modify($_SESSION['fecha_maxima'],"+10 minutes");  // Incremento de 10min = tiempo_maximo
            }
            if($fechaActual < $_SESSION['fecha_maxima']){
                $tiempoSuperado = 1;
            } else{
                $tiempoSuperado = -1;
            }
            return $tiempoSuperado;
        }
    }