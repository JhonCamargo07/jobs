(function(){
    // Variables de la lita y sus hijos
    var lista = document.getElementById("listaNav"),
        hijosLista = lista.children,
        l = document.links; // Para obtener links

        cambiarColorEnlace();

    // Función para cambiar y asignar el color a cada enlace del nav dependiendo de la página que esté
    function cambiarColorEnlace(){
        var s = "newTrabajo.php";
        if(extraerNameFile(l.trabajos.href) == "jobs.php" && fileName() == "jobs.php"){
            for(i=0; i < hijosLista.length; i++){
                hijosLista[i].classList.remove("activo");
            }
            hijosLista[1].classList.add("activo");
        }else if(extraerNameFile(l.newTrabajo.href) == "newTrabajo.php" && fileName() == "newTrabajo.php" || fileName().match(/newTrabajo.*/)){
            for(i=0; i < hijosLista.length; i++){
                hijosLista[i].classList.remove("activo");
            }
            hijosLista[2].classList.add("activo");
        }else if(extraerNameFile(l.oldTrabajo.href) == "oldTrabajo.php" && fileName() == "oldTrabajo.php" || fileName().match(/jobsEliminados.php*/)){
            for(i=0; i < hijosLista.length; i++){
                hijosLista[i].classList.remove("activo");
            }
            hijosLista[3].classList.add("activo");
            if(fileName().match(/jobsEliminados.php*/)){
                hijosLista[3].innerHTML = "<i class='icon-nav fas fa-check-circle'></i>Tareas eliminados";
            }
        }else if(extraerNameFile(l.clases.href) == "clases.php" && fileName() == "clases.php"){
            for(i=0; i < hijosLista.length; i++){
                hijosLista[i].classList.remove("activo");
            }
            hijosLista[0].classList.add("activo");
        }
    }
    
    // Funcion para saber cual es el archivo en donde estoy.
	function fileName(){
		var rutaAbsoluta = self.location.href;   
		var posicionUltimaBarra = rutaAbsoluta.lastIndexOf("/");
		var rutaRelativa = rutaAbsoluta.substring( posicionUltimaBarra + "/".length , rutaAbsoluta.length );
		return rutaRelativa;  
	}

    // Funcion para saber cual es el enlace que tiene un a en html
    function extraerNameFile(enlace){
        var rutaAbsoluta = enlace;
        var posicionUltimaBarra = rutaAbsoluta.lastIndexOf("/");
		var rutaRelativa = rutaAbsoluta.substring( posicionUltimaBarra + "/".length , rutaAbsoluta.length );
		return rutaRelativa;  
    }
}())