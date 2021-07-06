<?php
    include_once ("../modelo/mInicioSesion.php");//modelo
    //include_once ('../modelo/mPerfil.php');
    include_once ("cUsuario.php");
    include_once ('cCifradoContrasena.php');

    class cInicioSesion extends mInicioSesion
    {
        /**
         * busca un usuario con las credenciales ingresadas
         * @param   texto   nombre del usuario
         * @param   texto   contraseña del usuario
         * @return  numero  id del usuario /
         *                  0 = no se encontro ningun usuario
         *                  -1 = El nombre de usuario no cumple con los requerimientos
         *                  -1 = la contraseña no cumple con los requerimientos
         */
        static function buscarCuenta($NOMBRE_USUARIO,$CONTRASENA){
            //INICIALIZACION
            $ID_USUARIO = 0;
            $CUMPLIMIENTO = -1;
            if (cUsuario::pedirDatos($NOMBRE_USUARIO,0)==1){
                $CUMPLIMIENTO = 0;
                if(cUsuario::pedirDatos($CONTRASENA,1)==1){
                    $CUMPLIMIENTO = 1;
                    $contrasenaBDHashed = self::pedirContrasenaHasheada($NOMBRE_USUARIO);
                    if ($contrasenaBDHashed != ''){
                        $semilla =  cCifradoContrasena::extraerSemilla($contrasenaBDHashed);
                        $contrasenaHashedLocal = cCifradoContrasena::incrustarSemilla(cCifradoContrasena::hashearContrasena($CONTRASENA,$semilla),$semilla);
                        if ( $contrasenaHashedLocal == $contrasenaBDHashed){
                            $ID_USUARIO = self::comprobarDatosInicioSesion($NOMBRE_USUARIO,$contrasenaHashedLocal);
                        }
                    }
                }
            }

            //SI SE ENCONTRO ALGUNA CUENTA
            if($CUMPLIMIENTO == -1){
                echo "<script>console.error('mInicioSesion::buscarCuenta-> El nombre de usuario ingresado no es valido')</script>";
                $ID_USUARIO = -1;
            }elseif($CUMPLIMIENTO == 0){
                echo "<script>console.error('mInicioSesion::buscarCuenta-> La contraseña ingresada no es valida')</script>";
                $ID_USUARIO = -2;
            }elseif($ID_USUARIO == 0){
                echo "<script>console.error('mInicioSesion::buscarCuenta-> Cuenta no encontrada - Dislaik')</script>";
            }elseif($ID_USUARIO != 0 && $CUMPLIMIENTO == 1) {
                echo "<script>console.warn('mInicioSesion::buscarCuenta-> Cuenta encontrada - equisDee')</script>";
                //sincronizarDatosEventos($ID_USUARIO); en desuso
            }
            return $ID_USUARIO;
        }
    }

