<html><head>
                    <?php include_once("mPerfiles.php") ?>
                    <title>Perfiles</title>
                </head><body><h1>Usuarios</h1><?php
                    $info_perfiles = perfiles();
                    // var_dump($info_perfiles);
                    $nombreVariable = ["Doc: ", "Nombre: ", "Valor: "]; 
                    for($i=0; $i<count($info_perfiles); $i++){
                        for($j=0; $j<count($nombreVariable); $j++){
                            echo $nombreVariable[$j].$info_perfiles[$i][$j]." <br>";
                        }    
                        echo "<br>";
                    } ?></body></html>