<?php
    include_once('mPerfiles.php');

    //----- (.html) Creación HTML
    $fp = fopen('Perfiles.php', 'w');
    fputs($fp, '<html>');
    fputs($fp, '<head>
                    <?php include_once("mPerfiles.php") ?>
                    <title>Perfiles</title>
                </head>');

    fputs($fp, '<body><h1>Usuarios</h1>');
    fputs($fp, '<?php
                    $info_perfiles = perfiles();
                    // var_dump($info_perfiles);
                    $nombreVariable = ["Doc: ", "Nombre: ", "Valor: "]; 
                    for($i=0; $i<count($info_perfiles); $i++){
                        for($j=0; $j<count($nombreVariable  ); $j++){
                            echo $nombreVariable[$j].$info_perfiles[$i][$j]." <br>";
                        }    
                        echo "<br>";
                    } ?>');
    fputs($fp, '</body></html>');
    fclose($fp);