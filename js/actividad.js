(() => {
    const form = document.querySelector('#form-actividad')
    let campoTitulo = document.querySelector('#titulo-actividad')
    let campoDescripcion = document.querySelector('#descripcion-actividad')
    let campoAccion = document.querySelector('#accion')
    let campoId = document.querySelector('#id')
    let botonesActividad = document.querySelectorAll('.botones-actividad a')
    
    eventListeners();
    function eventListeners() {
        form.addEventListener('submit', enviarActividad)

        //Iterando en la lista de botones
        botonesActividad.forEach(btn => {
            btn.addEventListener('click', accionBotones)
        })
    }

    function enviarActividad(e) {
        e.preventDefault()
        let datos = new FormData(this);

        $.ajax({
            method: 'post',
            data: datos,
            url: 'inc/modelos/modelo-tarea.php',
            processData: false,
            contentType: false,
            cache: false,
            enctype: 'multipart/form-data',
            success: function(data) {
                let resultado = JSON.parse(data);

                console.log(resultado)

                if(resultado.respuesta == 'correcto') {
                    swal({
                        type: 'success',
                        title: 'Correcto',
                        text: 'Se envió correctamente'
                    }).then((result) => {
                        location.reload();
                    })
                } else {
                    let error = resultado.error;
                    swal({
                        type: 'error',
                        title: 'Error',
                        text: error
                    })
                }
            }
        });
    }

    function accionBotones(e) {
        e.preventDefault()

        let btnType = this.className
        let idActividad = this.parentElement.parentElement.id
        
        if(btnType=='delete') {
            //Eliminar elemento de la BD con el id
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Si, eliminar!'
            }).then((result) => {
                if (result.value) {
                    eliminarActividad(idActividad)    
                }
            })
        }
        else if(btnType=='edit') {
            //Cambiar tipo de form y llenar datos
            let titulo = this.parentElement.parentElement.childNodes[3].innerText
            let descripcion = this.parentElement.parentElement.childNodes[7].innerText
        
            campoAccion.value = 'editar'
            campoId.value = idActividad
            campoTitulo.value = titulo
            campoDescripcion.value = descripcion

            //Animación que nos lleva hacia arriba
            $('body, html').animate({
                scrollTop: '0px'
            }, 300);
        }
    }

    function eliminarActividad(id) {
        
        $.ajax({
            type: 'post',
            data: {
                "accion": "eliminar",
                "id": id
            },
            url: 'inc/modelos/modelo-tarea.php',
            dataType: 'json',
            success: function(data) {                
                let resultado = data;
                if(resultado.respuesta == "correcto"){
                    //Si va bien volvemos a cargar las entradas
                    Swal.fire(
                        '¡Eliminado!',
                        'La entrada ha sido borrada.',
                        'success'
                    ).then((result) => {
                        location.reload();
                    })
                }
            }
        });
    }

})();