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
			var latitud = pos.coords.latitude;
			var longitud = pos.coords.longitude;
			var precision = pos.coords.accuracy;
            
 
			var contenedor = document.getElementById("map")
 
			var centro = new google.maps.LatLng(latitud,longitud);
 
			var propiedades =
			{
                zoom: 15,
                center: centro,
                mapTypeId: google.maps.MapTypeId.ROADMAP
			};
 
			var map = new google.maps.Map(contenedor, propiedades);
 
			var posActual = new google.maps.Marker({/*MARCADOR POSICION ACTUAL*/
                position : centro,
                draggable: false,
                map: map,
                title: "Tu posicion actual"
            });
			document.getElementById("latitud").value = latitud;
			document.getElementById("longitud").value = longitud;

			var marcador = new google.maps.Marker({ /*MARCADOR MOVIL*/
                position : centro,
                draggable: true,
                map: map,
                title: "Lugar a seleccionar"
            });
			
            marcador.addListener("dragend",function(event){
                document.getElementById("latCustom").value = this.getPosition().lat();
                document.getElementById("lonCustom").value = this.getPosition().lng();
				console.log(this.getPosition().lat())
            	console.log(this.getPosition().lng())
            });
		}
 </script>
        <body onLoad="localize()">
			<div id="map" ></div> 
			Posicion Actual
			<p>
			<form action="../controlador/cUbicacion.php" method ="$_GET">
				<label for="latitud">Latitud</label>
				<input type="text" id="latitud" name="latitud" class="form_control">
				<label for="longitud">Longitud</label>
				<input type="text" id="longitud" name="longitud" class="form_control">
			<p>
			Posicion Seleccionada
			<p>
				<label for="latitud">Latitud</label>
				<input type="text" id="latCustom" name="latCustom" class="form_control">
				<label for="longitud">Longitud</label>
				<input type="text" id="lonCustom" name="lonCustom" class="form_control">
				<input type="submit" value="Seleccionar Ubicacion">
			</form>
	    </body>



