(function(){
    var login = document.getElementById('formulario'),
        nombre = document.getElementById('nombre'),
        usuario = document.getElementById('usuario'),
        campoPassword = document.getElementById('password'),
        mensajeError = document.getElementById('mensaje-error'),    //Mensaje de error en usuario
        mensajeError2 = document.getElementById('mensaje-error2');  //Mensaje de error en contraseña
        mensajeError3 = document.getElementById('mensaje-error3');  //Mensaje de error en nombre

    var validarUsuario = function(e){
        if(usuario.value == 0){
            usuario.classList.add("error");
            usuario.setAttribute("placeholder", "Escribe tu correo electron\u00EDco aqu\u00ED");
            //Mostrar mensajes de error
            mensajeError.style.display="block";

            var comprobarUsuario = function(){
                usuario.classList.remove("error");
                usuario.setAttribute("placeholder", "Correo electron\u00EDco");
                mensajeError.style.display="none";
            };

            usuario.addEventListener("keydown", comprobarUsuario);
            e.preventDefault();
        }
    };

    var validarPassword = function(e){
        if(campoPassword.value == 0){
            campoPassword.classList.add("error");
            campoPassword.setAttribute("placeholder", "Escribe tu contrase\u00f1a aqu\u00ED");
            mensajeError2.style.display="block";

            var comprobarPassword = function(){
                campoPassword.classList.remove("error");
                campoPassword.setAttribute("placeholder", "Contrase\u00f1a");
                mensajeError2.style.display="none";
            };

            campoPassword.addEventListener("keydown", comprobarPassword);
            e.preventDefault();
        }
    };

    var validarNombre = function(e){
        if(nombre.value == 0){
            nombre.classList.add("error");
            nombre.setAttribute("placeholder", "Escribe tu nombre aqu\u00ED");
            mensajeError3.style.display="block";

            var comprobarPassword = function(){
                nombre.classList.remove("error");
                nombre.setAttribute("placeholder", "Nombre");
                mensajeError3.style.display="none";
            };

            nombre.addEventListener("keydown", comprobarPassword);
            e.preventDefault();
        }
    };

    var validar = function(e){
        validarPassword(e);
        validarUsuario(e);
        validarNombre(e);
    };

    if(fileName() == "index.php"){
        window.onload = function(e){
            validarPassword(e);
            validarUsuario(e);
            validarNombre(e);
        }
    }

    login.addEventListener("submit", validar);

    // Funcion para saber cual es el archivo en donde estoy.
	function fileName(){
		var rutaAbsoluta = self.location.href;   
		var posicionUltimaBarra = rutaAbsoluta.lastIndexOf("/");
		var rutaRelativa = rutaAbsoluta.substring( posicionUltimaBarra + "/".length , rutaAbsoluta.length );
		return rutaRelativa;  
	}

    //*------------------------------------------------------------
    //!--------------------------- Icono de mostrar contraseña ---------------------------
    //*------------------------------------------------------------

    var icono = document.getElementById('icono');
    
    var mostrarClave = function(){
        if(campoPassword.type == "password"){
            icono.classList.add('fa-eye');
            icono.classList.remove('fa-eye-slash');
            campoPassword.type = "text";
        }else{
            icono.classList.add('fa-eye-slash');
            icono.classList.remove('fa-eye');
            campoPassword.type = "password";
        }
    };

    icono.addEventListener("click", mostrarClave);

}())