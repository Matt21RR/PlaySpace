<?php
    include_once('../modelo/mCuentaRecuperar.php');
    include_once('cValidacion.php');            //Temporal
    include_once('cAutenticacion.php');         //Temporal

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
        static function introducirContraseñaNueva($ID_USUARIO, $CONTRASENA){
            if (cValidacion::validarTexto($CONTRASENA,3)==1){
                mCuentaRecuperar::actualizarDatosCuenta($ID_USUARIO, $CONTRASENA);
            } else{
                return -1;
            }
            echo "<script>console.log('cCuentaRecuperar::introducirContraseñaNueva')</script>";
        }
    }