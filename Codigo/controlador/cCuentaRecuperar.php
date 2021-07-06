<?php
    include_once('../modelo/mCuentaRecuperar.php');
    include_once('cValidacion.php');            //Temporal
    include_once('cAutenticacion.php');         //Temporal
    include_once('cCuentaCrear.php');           //Temporal
    include_once('cPerfil.php');                 //Temporal

    class cCuentaRecuperar{
        /**
         * Se busca el ID del usuario segun el correo creado para la cuenta
         * Crea y Envia una clave de verificacion a la BD
         * @param   texto   correo ingresado
         * @return  entero  ID de la cuenta
         *          entero  -1 = Cuenta no encontrada
         */
        static function buscarCuenta($CORREO){
            $ID_USUARIO = mCuentaRecuperar::buscarCuenta($CORREO);
            echo "<script>console.log('cCuentaRecuperar::buscarCuenta')</script>";
            cAutenticacion::crearClaveVerificacion($ID_USUARIO);
            return $ID_USUARIO;
        }
        /**
         * Actualizar la contraseña de una cuenta
         * @param   entero  ID del usuario
         * @param   texto   Nueva contraseña
         * @return  entero  -1 = Contraseña no válida
         */
        static function introducirContraseñaNueva($ID_USUARIO,$CONTRASENA){
            $info_usuario = cPerfil::consultarPerfil($ID_USUARIO);
            $info_usuario[0] = strtolower($info_usuario[0]);
            // $CONTRASENA = strtolower($CONTRASENA);
            $contrasenaBDHashed = $info_usuario[1];
            if ($contrasenaBDHashed != ''){
                $semilla =  cCifradoContrasena::extraerSemilla($contrasenaBDHashed);
                $contrasenaHashedLocal = cCifradoContrasena::incrustarSemilla(cCifradoContrasena::hashearContrasena($CONTRASENA,$semilla),$semilla);
                if ($contrasenaHashedLocal == $contrasenaBDHashed){
                    $CONTRASENA = -1;
                }
            }
            if($info_usuario[0] != $CONTRASENA && $CONTRASENA != -1){        // Compara si la contraseña es igual al nombre de usuario
                $CONTRASENA = cCuentaCrear::validarDatosCuenta($CONTRASENA, 1);     //Validación y encriptación de la contraseña
            } else{
                $CONTRASENA = -1;
            }
            if ($CONTRASENA==-1){
                return -1;
            }else {
                mCuentaRecuperar::actualizarDatosCuenta($ID_USUARIO, $CONTRASENA);
            }
        }
    }