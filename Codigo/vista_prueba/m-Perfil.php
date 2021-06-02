<?php
    include_once('../mBaseDatos.php');

    /**
     * Consulta el ID del usuario tomando su nombre
     * @param   text    Nombre del usuario
     * @return  entero  ID del usuario
     */
    function pedirIDUsuario($NOMBRE_USUARIO){
        $connect=conexionBaseDatos();           //Conexión BD

        $sql="select * from USUARIOS where NOMBRE_USUARIO = '$NOMBRE_USUARIO'";
        $result = $connect->query($sql);
        while ($fila = mysqli_fetch_assoc($result)){
            $info_usuario = $fila ['ID_USUARIO'];       //Almacenamiento ID del usuario buscado 
        }
    
        echo "<script>console.log('m-Perfil::pedirIDUsuario')</script>";
        $connect->close();
        return $info_usuario;           //Retorno de la ID encontrada segun el nombre
    }

    /**
     * Consultar los nombre y ID de los usuarios registrados
     * @return  lista   Lista de los ID y Nombre de los usuarios
     *                      [][0] = ID_USUARIO
     *                      [][1] = NOMBRE_USUARIO
     */
    function pedirInfoUsuarios(){
        $connect=conexionBaseDatos();           //Conexión BD

        $sql="select * from USUARIOS";
        $result = $connect->query($sql);
        $descripcionVariable = ['ID_USUARIO', 'NOMBRE_USUARIO'];  //Diccionario de variables a conseguir
            $elementos = (count($descripcionVariable));
            //Almacen de variables en la lista info_usuarios
            $filas_guardadas = 0;
            while ($fila = mysqli_fetch_assoc($result)){//realizar la busqueda
                $posision_columna = 0;
                while ($posision_columna < $elementos){//ingresar cada uno de los valores de la lista
                    $info_usuarios[$filas_guardadas][$posision_columna] = $fila [$descripcionVariable[$posision_columna]];
                    $posision_columna++;
                }
                $filas_guardadas++;
            }
    
        echo "<script>console.log('m-Perfil::pedirInfoUsuarios')</script>";
        $connect->close();
        return $info_usuarios;          
    }