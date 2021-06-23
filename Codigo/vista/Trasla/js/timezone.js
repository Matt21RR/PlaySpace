var resolvedOptions = Intl.DateTimeFormat().resolvedOptions(); //obtener toda la informacion del navegador
console.log(resolvedOptions.timeZone);//Obtener el valor de la zona horaria
document.getElementById("utc").value = (resolvedOptions.timeZone);//modificar el valor del input="hidden" con el nombre de "utc"