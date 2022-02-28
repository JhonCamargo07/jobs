(function(){
    // var campoClave = document.querySelector('#btn-password');


    document.querySelector("#btn-password").addEventListener("click",function(){
        var longitud = 20; //numero de caracteres
        var clave = generarClave(longitud); 
        document.querySelector("#password").value= clave;
        document.write = clave;
        copiarPassword();
    });
    
    /*Función principal | Generador de claves | Password Generator*/
    function generarClave(long){
        /*caracteres permitidos*/
        let caracteres = "Aa0BbCc1DdEe2FfGgHh3IiJj4KkLl5MmNn6OoPp7QqRr8SsTt9UuVv*WwXxYyZz$",
            clave = '',
            numero;
    
        /*creacion de clave*/
        for(let i=0;i<long;i++)
        {
            numero = getNumero( 0, caracteres.length );
            clave += caracteres.substring( numero, numero + 1 );
        }
        return clave;
    }
    
    
    /*Función para generar un numero aleatorio*/
    function getNumero(min,max){
        return Math.floor( Math.random() * ( max - min ) ) + min;
    }

	// Funcion que nos permite copiar el texto al portapapeles.
	function copiarPassword(){
		// Selecciona el texto de un input
		namedItem('password').select();
		// Copiamos el Texto
		document.execCommand("copy");
	}
}())