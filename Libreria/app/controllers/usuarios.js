// Constantes para establecer las rutas y parámetros de comunicación con la API.
const API_USUARIOS = '../app/api/usuarios_crud.php?action=';
const API_USUARIOS2 = '../app/api/usuarios.php?action=';
const ENDPOINT_EMPLEADOS = '../app/api/empleados.php?action=readAll';
const ENDPOINT_TIPO = '../app/api/tipo_usuario.php?action=readAll';

document.addEventListener('DOMContentLoaded', function () {
    revisar();
});

function revisar() {
    const data = new FormData();
    data.append('link', 'usuarios.php');
    
    fetch(API_USUARIOS2 + 'readPagina', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    M.toast({html: 'Acceso Correcto', classes: 'rounded'});
                    // Se llama a la función que obtiene los registros para llenar la tabla. Se encuentra en el archivo components.js
                    readRows(API_USUARIOS);
                } else {
                    M.toast({html: 'Acceso Incorrecto', classes: 'rounded'});
                    sweetAlert(2, 'No tienes permiso de estar aquí', 'graficas.php');
                    window.locationf='graficas.php';
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });

}

// Función para llenar la tabla con los datos de los registros. Se manda a llamar en la función readRows().
function fillTable(dataset) {
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {
        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += `
            <tr>                
                <td>${row.nombre}</td>
                <td>${row.usuario}</td>
                <td>${row.estado}</td>
                <td>${row.tipo_usuario}</td>                
                <td>
                <a href="#" onclick="openUpdateDialog(${row.id_usuario})" class="btn-floating btn waves-effect waves amber accent-4"><i class="material-icons" title="Editar registro">create</i></a>
                <a href="#" onclick="openDeleteDialog(${row.id_usuario})" class="btn-floating btn waves-effect waves amber accent-4"><i class="material-icons" title="Eliminar registro">delete</i></a>
                <a href="#" onclick="openGraphic(${row.id_usuario})" class="btn-floating btn waves-effect waves amber accent-4"><i class="material-icons" title="Historial de ventas">assessment</i></a>
                </td>
                
            </tr>
        `;
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('tbody-rows').innerHTML = content;

    if ($.fn.dataTable.isDataTable('#myTable')) {
        table = $('#myTable').DataTable();              
    }
    else {
        table = $('#myTable').DataTable({
            searching: false,
            ordering: false,
            "lengthChange": false,
            "pageLength": 5,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
              }            
        });           
    }
    // Se inicializa el componente Tooltip asignado a los enlaces para que funcionen las sugerencias textuales.
    M.Tooltip.init(document.querySelectorAll('.tooltipped'));
}

// Método manejador de eventos que se ejecuta cuando se envía el formulario de buscar.
document.getElementById('search-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // Se llama a la función que realiza la búsqueda. Se encuentra en el archivo components.js
    searchRows(API_USUARIOS, 'search-form');
});

// Función para preparar el formulario al momento de insertar un registro.
function openCreateDialog() {
    // Se restauran los elementos del formulario.
    document.getElementById('save-form').reset();
    // Se abre la caja de dialogo (modal) que contiene el formulario.
    let instance = M.Modal.getInstance(document.getElementById('save-modal'));
    instance.open();
    // Se asigna el título para la caja de dialogo (modal).
    document.getElementById('modal-title').textContent = 'Crear usuario';
    // Se llama a la función que llena el select del formulario. Se encuentra en el archivo components.js
    fillSelect(ENDPOINT_EMPLEADOS, 'empleado', null);
    fillSelect(ENDPOINT_TIPO, 'tipo_usuario', null);
}

function openUpdateDialog(id) {
    // Se restauran los elementos del formulario.
    document.getElementById('save-form').reset();
    // Se abre la caja de dialogo (modal) que contiene el fourmlario.
    let instance = M.Modal.getInstance(document.getElementById('save-modal'));
    instance.open();
    // Se asigna el título para la caja de dialogo (modal).
    document.getElementById('modal-title').textContent = 'Actualizar usuario';

    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('id_usuario', id);

    fetch(API_USUARIOS + 'readOne', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se inicializan los campos del formulario con los datos del registro seleccionado.
                    document.getElementById('id_usuario').value = response.dataset.id_usuario;
                    document.getElementById('usuario').value = response.dataset.usuario;
                    document.getElementById('estado').value = response.dataset.estado;
                    fillSelect(ENDPOINT_EMPLEADOS, 'empleado', response.dataset.id_empleado);
                    fillSelect(ENDPOINT_TIPO, 'tipo_usuario', response.dataset.id_tipo_usuario);
                    //document.getElementById('contraseña').value = response.dataset.contraseña;
                    // Se actualizan los campos para que las etiquetas (labels) no queden sobre los datos.
                    M.updateTextFields();
                } else {
                    sweetAlert(2, response.exception, null);
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}

// Método manejador de eventos que se ejecuta cuando se envía el formulario de guardar.
document.getElementById('save-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    // Se define una variable para establecer la acción a realizar en la API.
    let action = '';
    // Se comprueba si el campo oculto del formulario esta seteado para actualizar, de lo contrario será para crear.
    if (document.getElementById('id_usuario').value) {
        action = 'update';
    } else {
        action = 'create';
    }
    saveRow(API_USUARIOS, action, 'save-form', 'save-modal');

});

// Función para establecer el registro a eliminar y abrir una caja de dialogo de confirmación.
function openDeleteDialog(id) {
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('id_usuario', id);
    // Se llama a la función que elimina un registro. Se encuentra en el archivo components.js
    confirmDelete(API_USUARIOS, data);
}

function openGraphic(id) {
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('id_user', id);
    graficaLinealVentasUsuario(API_USUARIOS, data);
    graficaPolarDineroVenta(API_USUARIOS, data);
}


// Función para mostrar la cantidad de productos por categoría en una gráfica de barras.
function graficaLinealVentasUsuario(api, data) {
    fetch(api + 'secondOption', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se remueve la etiqueta canvas de la gráfica.
                if (response.status) {
                    let instance = M.Modal.getInstance(document.getElementById('save-modal1'));
                    instance.open();
                    document.getElementById("chart4").remove();
                    var canvas = document.createElement("canvas");
                    canvas.id = "chart4"; 
                    document.getElementById("contenedor").appendChild(canvas);
                    // Se declaran los arreglos para guardar los datos por gráficar.
                    let categorias = [];
                    let cantidad = [];
                    // Se recorre el conjunto de registros devuelto por la API (dataset) fila por fila a través del objeto row.
                    response.dataset.map(function (row) {
                        // Se asignan los datos a los arreglos.
                        categorias.push(row.fecha);
                        cantidad.push(row.total);
                    });
                    // Se llama a la función que genera y muestra una gráfica de barras. Se encuentra en el archivo components.js
                    lineGraph('chart4', categorias, cantidad, '$', 'Dinero recaudado');
                } else {
                    document.getElementById("chart4").remove();
                    var canvas = document.createElement("canvas");
                    canvas.id = "chart4"; 
                    document.getElementById("contenedor").appendChild(canvas);
                    sweetAlert(3, 'No hay datos disponibles', null);
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}

// Función para mostrar el porcentaje de productos por categoría en una gráfica de pastel.
function graficaPolarDineroVenta(api, data) {
    fetch(api + 'firstOption', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se remueve la etiqueta canvas de la gráfica.
                if (response.status) {
                    document.getElementById("chart5").remove();
                    var canvas = document.createElement("canvas");
                    canvas.id = "chart5"; 
                    document.getElementById("contenedor1").appendChild(canvas);
                    // Se declaran los arreglos para guardar los datos por gráficar.
                    let categorias = [];
                    let cantidad = [];
                    // Se recorre el conjunto de registros devuelto por la API (dataset) fila por fila a través del objeto row.
                    response.dataset.map(function (row) {
                        // Se asignan los datos a los arreglos.
                        categorias.push(row.fecha);
                        cantidad.push(row.cantidad);
                    });
                    // Se llama a la función que genera y muestra una gráfica de pastel en porcentajes. Se encuentra en el archivo components.js
                    polarGraph('chart5', categorias, cantidad, 'Cantidad de ventas realizadas');
                } else {
                    document.getElementById("chart5").remove();
                    var canvas = document.createElement("canvas");
                    canvas.id = "chart5"; 
                    document.getElementById("contenedor1").appendChild(canvas);
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}


