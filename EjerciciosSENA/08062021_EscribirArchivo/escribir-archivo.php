<?php
//----- (.txt) determina el formato a crear
/*
    $fp = fopen("fichero.txt", "w");    //----- Creación del archivo
    fputs($fp, "Prueba de escritura aprenderaprogramar.com");   //----- Escritura en el archivo
    fputs($fp, "Prueba de escritura aprenderaprogramar.com");   //----- Escritura en el archivo
    fclose($fp);    //----- Cerrar edición del archivo
*/
//----- (.html) Creación HTML
    $fp = fopen('PruebaName.html', 'w');
    fwrite($fp, '<html>');
    fwrite($fp, '<head><title>NombreCompleto</title></head>');
    fwrite($fp, '<body><h1>Nombre Completo</h1>');
    fwrite($fp, '<b>Jhoy Santiago<br>');
    fwrite($fp, 'Moreno Marroquin</b>');
    fwrite($fp, '</body></html>');
    fclose($fp);

    $animales = array(
        array ('tortuga', 'Nicole', '5'),
        array ('perro', 'Chukie', '10'),
        array ('gato', 'whiskie', '8'),
    );