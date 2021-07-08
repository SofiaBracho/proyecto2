let userType = '';
let contSeccion;
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
        document.querySelector("#seccion-estudiante").parentElement.style = "display:none;";
        extraerMaterias()
    } else if (result.isDenied) {
        Swal.fire('Inicia sesión como estudiante!', '', 'success')
        userType = 'estudiante'
        document.querySelector("#seccion-profesor").parentElement.style = "display:none;";
        document.querySelector("#materias-profesor").parentElement.style = "display:none;";
    }
    document.querySelector('#tipo-usuario').value = userType;

    extraerSecciones()
})

let a=0;
function crearOptionMaterias(materias) {    
        contMaterias = document.querySelector("#materias-profesor")        
        if(!a) {
            materias.forEach(materia => {
                let option = document.createElement('option')
                option.value=materia.id
                option.innerHTML=materia.nombre
        
                contMaterias.childNodes[1].appendChild(option)
            });
            a=1
        }else {
            let select = document.createElement('select')
            select.name="materias[]"
    
            materias.forEach(materia => {
                let option = document.createElement('option')
                option.value=materia.id
                option.innerHTML=materia.nombre
        
                select.appendChild(option)
            });
            contMaterias.appendChild(select);
        }
}

let b=0;
function crearOption(secciones) {
    if(userType=='estudiante') {
        contSeccion = document.querySelector("#seccion-estudiante")
        secciones.forEach(seccion => {
            let option = document.createElement('option');
            option.value=seccion.id
            option.innerHTML=seccion.nombre
    
            contSeccion.appendChild(option)
        });
    } else if (userType=='profesor') {
        contSeccion = document.querySelector("#seccion-profesor")
        
        
        if(!b) {
            secciones.forEach(seccion => {
                let option = document.createElement('option')
                option.value=seccion.id
                option.innerHTML=seccion.nombre
        
                contSeccion.childNodes[1].appendChild(option)
            });
            b=1
        }else {
            let select = document.createElement('select')
            select.name="secciones[]"
    
            secciones.forEach(seccion => {
                let option = document.createElement('option')
                option.value=seccion.id
                option.innerHTML=seccion.nombre
        
                select.appendChild(option)
            });
            contSeccion.appendChild(select);
        }
    }
}



const extraerSecciones = () => new Promise((resolve) => {
    $.ajax({
        type: 'get',
        url: 'inc/funciones/extraer-secciones.php',
        dataType: 'json',
        success: function(data) {
            let secciones=(data.secciones);
            crearOption(secciones)
        }
    });
});

const extraerMaterias = () => new Promise((resolve) => {
    $.ajax({
        type: 'get',
        url: 'inc/funciones/extraer-materias.php',
        dataType: 'json',
        success: function(data) {
            let materias=(data.materias);
            crearOptionMaterias(materias)
        }
    });
});

eventListeners();

function eventListeners() {
    document.querySelector('#formulario').addEventListener('submit', validarRegistro);
    document.querySelector('#btn-seccion').addEventListener('click', extraerSecciones)
    document.querySelector('#btn-materias').addEventListener('click', extraerMaterias)
}

function validarRegistro(e) {
    e.preventDefault();

    let cedula = document.querySelector('#cedula').value;
    let correo = document.querySelector('#correo').value;
    let nombre = document.querySelector('#nombre').value;
    let seccion='';
    let materias='';
    if( userType=='estudiante' ) {
        seccion = document.querySelector('#seccion-estudiante').value;
    }else if( userType=='profesor' ) {
        materias = document.querySelectorAll('#materias-profesor select');
        materias = Array.from(materias)
        materias = materias.map(e => e.value)

        seccion = document.querySelectorAll('#seccion-profesor select');
        seccion = Array.from(seccion)
        seccion = seccion.map(e => e.value)
    }
    let telefono = document.querySelector('#telefono').value;
    let password = document.querySelector('#password').value;
    let accion = document.querySelector('#tipo').value;

    if(cedula != '' && correo != '' && nombre != '' && telefono != '' && password != '') {
        let datos = new FormData(this);
        datos.append('cedula', cedula);
        datos.append('correo', correo);
        datos.append('nombre', nombre);
        datos.append('seccion', seccion);
        datos.append('telefono', telefono);
        datos.append('password', password);
        datos.append('accion', accion);
        datos.append('tipo_usuario', userType);
        if(userType=='profesor') {
            datos.append('materias', materias);
        }

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