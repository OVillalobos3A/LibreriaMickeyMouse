// Constantes para establecer las rutas y parámetros de comunicación con la API.
const API_PERMISOS = '../app/api/permisos.php?action=';
const ENDPOINT_TIPO= '../app/api/permisos.php?action=readTipos';
const ENDPOINT_PAGINA= '../app/api/permisos.php?action=readPaginas';
const ENDPOINT_PERMISO= '../app/api/permisos.php?action=readPermisos';

document.addEventListener('DOMContentLoaded', function () {
    // Se llama a la función que obtiene los registros para llenar la tabla. Se encuentra en el archivo components.js
    readRows(API_PERMISOS);

});

// Función para llenar la tabla con los datos de los registros. Se manda a llamar en la función readRows().
function fillTable(dataset) {
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {
        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += `
            <tr>
                <td>${row.tipo_usuario}</td>
                <td>${row.nombre}</td>
                <td>${row.permiso}</td>                  
                <td>
                    <a href="#" onclick="openUpdateDialog(${row.id_acceso})" class="btn-floating btn waves-effect waves amber accent-4" data-tooltip="Editar"><i class="material-icons" title="Modificar acceso">create</i></a>
                    <a href="#" onclick="openDeleteDialog(${row.id_acceso})" class="btn-floating btn waves-effect waves amber accent-4" data-tooltip="Eliminar"><i class="material-icons" title="Quitar acceso">delete</i></a>
                </td>
            </tr>
      `;
    });
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

    // Se inicializa el componente Material Box asignado a las imagenes para que funcione el efecto Lightbox.
    M.Materialbox.init(document.querySelectorAll('.materialboxed'));
    // Se inicializa el componente Tooltip asignado a los enlaces para que funcionen las sugerencias textuales.
    M.Tooltip.init(document.querySelectorAll('.tooltipped'));
}


document.getElementById('search-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // Se llama a la función que realiza la búsqueda. Se encuentra en el archivo components.js
    searchRows(API_PERMISOS, 'search-form');
});

// Función para preparar el formulario al momento de insertar un registro.
function openCreateDialog() {
    // Se restauran los elementos del formulario.
    document.getElementById('save-form').reset();
    // Se abre la caja de dialogo (modal) que contiene el formulario.
    let instance = M.Modal.getInstance(document.getElementById('save-modal'));
    instance.open();
    // Se asigna el título para la caja de dialogo (modal).
    document.getElementById('modal-title').textContent = 'Agregar acceso';
    // Se inicializan los campos del formulario con los datos del registro seleccionado.
    fillSelect(ENDPOINT_TIPO, 'tipo', null);
    fillSelect(ENDPOINT_PAGINA, 'pagina', null);
    fillSelect(ENDPOINT_PERMISO, 'permiso', null);
}

function openUpdateDialog(id) {
    // Se restauran los elementos del formulario.
    document.getElementById('save-form').reset();
    // Se abre la caja de dialogo (modal) que contiene el formulario.
    let instance = M.Modal.getInstance(document.getElementById('save-modal'));
    instance.open();
    // Se asigna el título para la caja de dialogo (modal).
    document.getElementById('modal-title').textContent = 'Modificar acceso';

    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('id_acceso', id);

    fetch(API_PERMISOS + 'readOne', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se inicializan los campos del formulario con los datos del registro seleccionado.
                    document.getElementById('id_acceso').value = response.dataset.id_acceso;
                    fillSelect(ENDPOINT_TIPO, 'tipo', response.dataset.id_tipo_usuario);
                    fillSelect(ENDPOINT_PAGINA, 'pagina', response.dataset.id_pagina);
                    fillSelect(ENDPOINT_PERMISO, 'permiso', response.dataset.id_permiso);
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
    if (document.getElementById('id_acceso').value) {
        action = 'update';
    } else {
        action = 'create';
    }
    saveRow(API_PERMISOS, action, 'save-form', 'save-modal');

});


// Función para establecer el registro a eliminar y abrir una caja de dialogo de confirmación.
function openDeleteDialog(id) {
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('id_acceso', id);
    // Se llama a la función que elimina un registro. Se encuentra en el archivo components.js
    confirmDelete(API_PERMISOS, data);
}
