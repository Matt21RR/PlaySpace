<?php
    include_once('cTiendaCrear.php');
    include_once('cTiendaEditar.php');
    include_once('../modelo/mTiendas.php');

    class cTiendas extends mTiendas{
        /**
         * Obtiene las ID de las tiendas creadas por un usuario
         * @param   entero  ID del usuario
         * @return  lista   lista de las ID de las tiendas del usuario
         */
        static function consultarTiendasCreadas($ID_USUARIO){
            $info_IDTiendas = self::pedirIDTiendasCreador($ID_USUARIO);
            return $info_IDTiendas;
        }
    
        /**
         * Obtiene la información básica de una tienda en especifico
         * @param   entero  id del usuario para mostrar la información tienda activa
         * @return  lista   lista de información de la tienda 
         *                      [0] = Nombre Tienda
         *                      [1] = telefono Tienda
         *                      [2] = Correo Tienda
         *                      [3] = Fin publicación Tienda
         *                      [4] = Descripción Tienda
         */
        static function consultarInfoTienda($ID_USUARIO, $ID_TIENDA){
            $info_Tienda = self::pedirInformacionTienda($ID_USUARIO, $ID_TIENDA);
            return $info_Tienda;
        }
    }

