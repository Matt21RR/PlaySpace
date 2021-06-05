function selectRadio(primerId,id,cantOp){
    i = primerId;
    if (document.querySelector("#_"+id).checked == 1){ //si el cuadro de opcion sobre el que se clica esa ya marcado, desmarcarlo
      document.getElementById("Op"+id).style.border = "unset";
      document.querySelector("#_"+id).checked = 0;
    }else{
      while (i != (cantOp+1)){
        //document.getElementById("texto"+i).style.width = "0%";
        //document.getElementById("texto"+i).style.padding = "0px";
        document.getElementById("Op"+i).style.border = "unset";
        if(i == id){
          //document.getElementById("texto"+i).style.width = "100%";
          //document.getElementById("texto"+i).style.padding = "12px";
          document.getElementById("Op"+i).style.border = "4px solid #90caf9";
          document.querySelector("#_"+i).checked = 1;
        }
        else{
          //document.getElementById("texto"+i).style.width = "0%";
          //document.getElementById("texto"+i).style.padding = "0px";
          document.getElementById("Op"+i).style.border = "unset";
          document.querySelector("#_"+i).checked = 0;
        }
        i++;
      }
    }
  }
function selectSubsection(idSubsection,cantSubsection){ //para abrir la subseccion
  i = 1;
  if (document.getElementById("OpSub"+idSubsection).style.border == "4px solid rgb(144, 202, 249)"){ //si el cuadro de opcion sobre el que se clica esa ya marcado, desmarcarlo
    document.getElementById("OpSub"+idSubsection).style.border = "unset";
    document.getElementById("sub"+idSubsection).style.width = "0%";//panel de subseccion
    document.getElementById("sub"+idSubsection).style.height = "0px";//panel de subseccion
    document.getElementById("sub"+idSubsection).style.padding = "0px";//panel de subseccion
  }else{
    while (i != (cantSubsection+1)){
      document.getElementById("sub"+i).style.width = "0%";//panel de subseccion
      document.getElementById("sub"+i).style.height = "0px";//panel de subseccion
      document.getElementById("sub"+i).style.padding = "0px";//panel de subseccion
      document.getElementById("OpSub"+i).style.border = "unset";//boton que activa-desactiva la subseccion
      if(i == idSubsection){
        document.getElementById("sub"+i).style.width = "100%";
        document.getElementById("sub"+i).style.height = "auto";
        document.getElementById("sub"+i).style.padding = "12px";
        document.getElementById("OpSub"+i).style.border = "4px solid #90caf9";
      }else{
        document.getElementById("sub"+i).style.width = "0%";
        document.getElementById("sub"+i).style.height = "0px";
        document.getElementById("sub"+i).style.padding = "0px";
        document.getElementById("OpSub"+i).style.border = "unset";
      }
      i++;
    }
  }
}

function selectRadioImg(id,cantImg){
        
        i = 1;

        while (i != (cantImg+1)){
          document.getElementById("img"+i).style.border = "0px";
          if(i == id){
            document.getElementById("img"+i).style.border = "4px solid #2979ff";
            document.querySelector("#Op"+i).checked = "True";
          }
          else{
            document.getElementById("img"+i).style.border = "0px";
          }
          i++;
        }
        
        
      }