<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
<style>
 
	        #map
	        {
	            width: 100%;
	            height: 300px;
	            border: 1px solid #d0d0d0;
	        }
 
</style>

<script>
	 function localize()
		{
		 	if (navigator.geolocation)
			{
                navigator.geolocation.getCurrentPosition(mapa);
            }
            else
            {
                alert("Tu navegador no soporta geolocalizacion.");
            }
		}
 
		function mapa(pos)
		{
		/************************ Aqui están las variables que te interesan***********************************/
            <?php if(!isset($_SESSION))session_start(); 
             ?>
			var latitudUser = '<?php echo $_SESSION[ 'coordsAct0' ]; ?>'
			var longitudUser = '<?php echo $_SESSION[ 'coordsAct1' ]; ?>'
			var ubiUsuario = new google.maps.LatLng(latitudUser,longitudUser);

            var latitudObjetivo = '<?php echo $_SESSION[ 'coords0' ]; ?>'
			var longitudObjetivo = '<?php echo $_SESSION[ 'coords1' ]; ?>'
            var ubiObjetivo = new google.maps.LatLng(latitudObjetivo,longitudObjetivo);
            var contenedor = document.getElementById("map")

			var propiedades =
			{
                zoom: 15,
                center: ubiUsuario,
                mapTypeId: google.maps.MapTypeId.ROADMAP
			};
 
			var map = new google.maps.Map(contenedor, propiedades);
 
			var posActual = new google.maps.Marker({/*MARCADOR POSICION ACTUAL*/
                position : ubiUsuario,
                draggable: false,
                map: map,
                title: "Tu posicion actual"
            });

            var posActIcon = {/* Crear un marcador para emplearlo en google maps */
				url: './png/menuIcons/Mapa.png',
				origin: new google.maps.Point(0,0),
				anchor: new google.maps.Point(20,40)
        	};
			var marcador = new google.maps.Marker({ /*MARCADOR MOVIL*/
                position : ubiObjetivo,
                icon: posActIcon,
                draggable: false,
                map: map,
                title: "Lugar seleccionado"
            });
		}
 </script>
        
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
        </head>
        <body onLoad="localize()">
			<div id="map" ></div> 
            <a href="../controlador/cUbicacion.php?confirmar=0">Seleccionar una nueva Ubicacion</a>
            <a href="../controlador/cUbicacion.php?confirmar=1">Confirmar ubicacion y continuar</a>
        </body>
        </html>