<?php
    // Con la siguiente función reemplazamos los caracteres que no queremos por un caracter vacio o nulo (''), esto con el fin de evitar la inyercion de codigos que puedan alterar la base de datos o el codigo php.
    // function limpiarTexto($elemento){
    //     $input = ltrim(rtrim($elemento));
    //     $simbolosRestinjidos = array("{", "}", "[", "]", "\"", "'", ":", ";", "=", "<", ">", "\\", "/", "&", "#", "(", ")", "%");
    //     $texto = str_replace($simbolosRestinjidos, '', $input);
    //     return ltrim(rtrim($texto));
    // } 
    // Funcion origina, no utilizada por la funcionalidad de SW


    function limpiarTexto($elemento){
        $input = ltrim(rtrim($elemento));
        $texto = htmlspecialchars($input);
        return ltrim(rtrim($texto));
    }

    // Con la siguiente función verificamos si un input o elemento es nulo.
    function campoNull($input){
        if($input == null){
            return true;
        }else{
            return false;
        }
    }

    // Con la siguiente función se comprueba el número de caracteres
    function numCharacters($input, $min, $max){
        if(strlen($input) > $max || strlen($input) < $min){
            return strlen($input);
        }else{
            return false;
        }
    }

    function verificarEmail($mail){
        if(filter_var($mail, FILTER_VALIDATE_EMAIL)){
            return true;
        }else{
            return false;
        }
    }

    function formatoTelefono($telefono){
        $num1 = substr($telefono, 0, 3);
        $num2 = substr($telefono, 3, 3);
        $num3 = substr($telefono, 6, 4);
        $numero_final = $num1 . " " . $num2 . " " . $num3;
        return $numero_final;
    }

    function formatoDocumento($documento){
        $documentoFinal = number_format($documento,0,",",".");
        return $documentoFinal;
    }

    function lineaParaFirma($nombre){
        $cantLetrasNombre = strlen($nombre);
        $firma = "";
        for($j=0; $j<=$cantLetrasNombre; $j++){
            $firma .= "_";
        }
        return $firma;
    }

    function diasLaborales($dia){
        if($dia == "Mon"){
            return true;
        }elseif($dia == "Tue"){
            return true;
        }elseif($dia == "Wed"){
            return true;
        }elseif($dia == "Thu"){
            return true;
        }elseif($dia == "Fri"){
            return true;
        }else{
            return false;
        }
    }

    function mesEspañol($monthNum){
        switch($monthNum){
            case 1:
                $monthNum = "Enero";
                return $monthNum;
            break;

            case 2:
                $monthNum = "Febrero";
                return $monthNum;
            break;

            case 3:
                $monthNum = "Marzo";
                return $monthNum;
            break;

            case 4:
                $monthNum = "Abril";
                return $monthNum;
            break;

            case 5:
                $monthNum = "Mayo";
                return $monthNum;
            break;

            case 6:
                $monthNum = "Junio";
                return $monthNum;
            break;

            case 7:
                $monthNum = "Julio";
                return $monthNum;
            break;

            case 8:
                $monthNum = "Agosto";
                return $monthNum;
            break;

            case 9:
                $monthNum = "Septiembre";
                return $monthNum;
            break;

            case 10:
                $monthNum = "Octubre";
                return $monthNum;
            break;

            case 11:
                $monthNum = "Noviembre";
                return $monthNum;
            break;

            case 12:
                $monthNum = "Diciembre";
                return $monthNum;
            break;
        }
    }

    function buscarNombreArchivo(){
        $url = $_SERVER["REQUEST_URI"];;
        $buscarPalabra   = 'as';
        $pos = strpos($url, $buscarPalabra) + 3;
        $archivo = substr($url, $pos);
        return $archivo;
    }

    function restarDias($dias){
        $date_now = date('Y/m/d');
        $date_future = strtotime($dias, strtotime($date_now));
        $date_future = date('Y/m/d', $date_future);
        return $date_future;
    }

    function formatoFecha($fecha, $espaciado){
        $fechaFinal = date("d", strtotime($fecha)) . $espaciado . strtolower(mesEspañol(date("m", strtotime($fecha)))) . $espaciado . date("Y", strtotime($fecha));
        return $fechaFinal;
    }

    function formatoFechaNum($fecha){
        $fechaFinal = date("d", strtotime($fecha)) . "-" . date("m", strtotime($fecha)) . "-" . date("Y", strtotime($fecha));
        return $fechaFinal;
    }
?>