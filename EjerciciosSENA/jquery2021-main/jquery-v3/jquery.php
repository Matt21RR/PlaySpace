
<html>
    <head>
        <title>
            
        </title>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        
    </head>
    
    <body>
                
        <input type="text" id="txt_nombre" placeholder="Digita tu nombre." onkeyup="comunicar();">
        <div id="salida"></div>
        
        <?php
            
            include( "Datos.php" );
            include( "Visual.php" ); //En el video quedó Vista y era Visual.
            
            //$resultado = Datos::avatar();
            //$salida = Visual::dibujar_avatar( $resultado );
         
        ?>
        
        
        <script src="js/operaciones-jquery.js"></script>
        
    </body>
</html>