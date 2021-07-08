(() => {
    let userType = ''
    Swal.fire({
        title: '¿Eres un profesor o estudiante?',
        showDenyButton: true,
        denyButtonText: `Estudiante`,
        denyButtonColor: `#2496CD`,
        confirmButtonText: `Profesor`,
        confirmButtonColor: `#D33B30`,
    }).then((result) => {
        /* Al presionar un boton */
        if (result.isConfirmed) {
            Swal.fire('Inicia sesión como profesor!', '', 'success')
            userType = 'profesor'
        } else if (result.isDenied) {
            Swal.fire('Inicia sesión como estudiante!', '', 'success')
            userType = 'estudiante'
        }
        document.querySelector('#tipo-usuario').value = userType;
    })

    eventListeners()
    function eventListeners() {
        document.querySelector('#formulario').addEventListener('submit', validarLogin)
    }

    function validarLogin(e) {
        e.preventDefault();
    
        let cedula = document.querySelector('#cedula').value;
        let password = document.querySelector('#password').value;
        let accion = document.querySelector('#tipo').value;
    
        if(cedula != '' && password != '') {
            let datos = new FormData(this);
            datos.append('cedula', cedula);
            datos.append('password', password);
            datos.append('accion', accion);
            datos.append('tipo_usuario', userType);
    
            $.ajax({
                method: 'post',
                data: datos,
                url: 'inc/modelos/modelo-admin.php',
                processData: false,
                contentType: false,
                cache: false,
                enctype: 'multipart/form-data',
                success: function(data) {
                    let resultado = JSON.parse(data);
    
                    if(resultado.respuesta == 'correcto') {
                        swal({
                            type: 'success',
                            title: 'Correcto',
                            text: 'Se guardó correctamente'
                        })
                        setTimeout(function() { 
                            window.location.href = 'index.php';
                        }, 2000);
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
    
        }else {
            swal({
                type: 'error',
                title: 'Error',
                text: 'Debes llenar todos los campos'
            })
        }
    }
})();