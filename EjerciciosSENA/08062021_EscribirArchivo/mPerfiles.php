<?php
    include_once('../Modelo/BD/mBaseDatos.php');

    function perfiles(){
        $connect = conexion::conexionBaseDatos();
        
        $sql = "SELECT * FROM tb_personas";
        $result = $connect -> query($sql);

        $descripcionVariable = array('nombre', 'documento', 'valor');  //Diccionario de variables a conseguir
        $elementos = (count($descripcionVariable));

        for($i=0; $i<$fila = mysqli_fetch_assoc($result); $i++){        // $i = Filas
            for($j=0; $j<$elementos; $j++){     // $j = Columnas
                $info_personas[$i][$j] = $fila [$descripcionVariable[$j]];
            }
        }
        $connect->close();
        return $info_personas;
    }