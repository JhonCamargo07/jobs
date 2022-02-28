<?php
    require_once('../modelos/login.php');
    $modeloLogin = new Login();
    $modeloLogin->validarSesion();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Sesión cerrada exitosamente</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../vistas/css/autostyle.css">
    <link rel="stylesheet" href="../vistas/css/style.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <script src="../vistas/js/alerta.js"></script>
    <script>
        const alertLogout = () => {
            swal.fire({
            title: "¡Sesión cerrada exitosamente!",
            text:"Será redirecionado a la página principal",
            confirmButtonText: 'Ok, entendí',
            confirmButtonColor: '#4DAF51',
            imageUrl: '../vistas/imagenes/success.gif',
            imageWidth: 175,
            imageHeight: 135,
            timer: 5090,
            timerProgressBar: true,
            didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
            },
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
                },
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: false,
            stopKeydownPropagation: false,
            }).then((result)=>{
                if(result.isConfirmed){
                    location.href ="../";
                }
            });
            // Redirecionar al index
            setInterval( ()=> {
                location.href ="../";
            }, 5100);
        }
    </script>

</head>
<body>
    <?php
        // No se inicia la sesión (session_start();) porque con la comprobación de arriba ya se estaria verificando si realmente está activa la sesion

        // Se destruye la sesión
        session_destroy();

        // Mensaje de que se cerró la sesión
        echo '<script>
                alertaFlotanteConRedirecion("¡Sesión cerrada exitosamente!", "Será redirecionado a la página principal", "#4DAF51", "../vistas/imagenes/success.gif", "../");
            </script>';
    ?>
</body>
</html>