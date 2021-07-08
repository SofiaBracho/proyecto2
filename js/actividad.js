(() => {
    const form = document.querySelector('#form-actividad');

    eventListeners();
    function eventListeners() {
        form.addEventListener('submit', agregarTarea);
    }

    function agregarTarea(e) {
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
                        text: 'Se guardó correctamente'
                    })
                    setTimeout(function() { 
                        form.reset();
                    }, 1000);
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

})();