var alertaFlotante = (titulo, texto, colorBoton, imagen) => {
    swal.fire({
        title: `${titulo}`,
        text: `${texto}`,
        confirmButtonText: 'Ok, entendí',
        confirmButtonColor: `${colorBoton}`,
        imageUrl: `${imagen}`,
        imageWidth: "auto",
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
    });
}
var alertaFlotanteConRedirecion = (titulo, texto, colorBoton, imagen, direccion) => {
    swal.fire({
        title: `${titulo}`,
        text: `${texto}`,
        confirmButtonText: 'Ok, entendí',
        confirmButtonColor: `${colorBoton}`,
        imageUrl: `${imagen}`,
        imageWidth: "auto",
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
            location.href = `${direccion}`;
        }
    });
    // Redirecionar
    setInterval( ()=> {
        location.href = `${direccion}`;
    }, 5100);
}


//!==============================================================
//!=========================== Mensaje de bienvenida =============================
//!==============================================================

var mensajeBienvenida = "",
    fecha = new Date(),
    horaActual = fecha.getHours();

    if(horaActual >= 0 && horaActual < 12){
        mensajeBienvenida = "Buenos días";
    }else if(horaActual >= 12 && horaActual < 18){
        mensajeBienvenida = "Buenas tardes";
    }else if(horaActual >= 18 && horaActual < 24){
        mensajeBienvenida = "Buenas noches";
    }else{
        mensajeBienvenida = "Bienvenido";
    }

    // var hora = fecha.getHours() + '-' + fecha.getMinutes() + '-' + fecha.getSeconds();

    // console.log(hora);

var alertaBienvenida = () => {
    swal.fire({
        toast: true,
        position: 'bottom-end',
        title: "<span style='color: #fff'>¡Hola! " + mensajeBienvenida + "</span>",
        showConfirmButton: false,
        icon: 'success',
        background:'#2D85CC',
        timer: 5000,
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
            }
    });
}

// Saber de que página viene
var referrer = document.referrer;

window.onload = () => {
    // Si viene de la página login, muestra el mensaje de bienveida sino no hace nada
    if(referrer == 'http://localhost/jobs/vistas/index.php'){
        alertaBienvenida();
    }  
}

var eliminar = false;
var AlertaConfirmacion = (/* titulo, ok, no, mensajeOk, imagen  */) => {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    })
    
    swalWithBootstrapButtons.fire({
        title: '¿Está seguro?',
        text: "No podrás revertir esta acción",
        icon: 'info',
        showCancelButton: true,
        confirmButtonText: 'Si, eliminar',
        cancelButtonText: 'No, cancelar',
        reverseButtons: true
    }).then((result) => {

        if (result.isConfirmed) {
            swalWithBootstrapButtons.fire(
                '¡Eliminado!',
                'La tarea fue eliminada exitosamente',
                'success'
            )
            eliminar = true;
        
        } else if (
          /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
                'Cancelado',
                'La tarea no se eliminó',
                'error'
            )
            eliminar = false;
        }
    })
    return true;
    
    // Swal.fire({
    //     title: `${titulo}`,
    //     showDenyButton: true,
    //     confirmButtonText: `${ok}`,
    //     denyButtonText: `${no}`,
    //     }).then((result) => {
    //     /* Read more about isConfirmed, isDenied below */
    //         if (result.isConfirmed) {
    //             Swal.fire(`${mensajeOk}`, `${imagen}`, 'success')
    //         }
    //     })
}

var alertaEliminar = () => {
    var opcion = confirm("¿Desea eliminar está tarea?");
    return opcion;
}

// Funcion para eliminar
// var eliminarTarea = () => {
//     eliminar = confirm("Eliminar?");
// }