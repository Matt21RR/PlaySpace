<?php
    include_once('cUsuario.php');           //temporal
    include_once('../modelo/mAutenticacion.php');   //Herencia

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
            for ($contador == 1; $contador < 8; $contador++){
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
            $CLAVE_VERIFICACION = self::pedirClaveVerificacion($ID_USUARIO);

            echo "<script>console.log('cAutenticacion::verificarClaveVerificacion')</script>";
            if($CLAVE_VERIFICACION != $CLAVE_INGRESADA){        //Comparación clave ingresada con la generada
                echo "<script>console.error('Clave invalida')</script>";
                $validacion = -1;
            } else{
                echo "<script>console.warn('Clave correcta')</script>";
                $validacion = 1;
            }
            return $validacion;
        }
// -----------------------------------------------------------------------------------------------    
    }