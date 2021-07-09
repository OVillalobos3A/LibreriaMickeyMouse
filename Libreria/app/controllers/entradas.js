// Constantes para establecer las rutas y parámetros de comunicación con la API.
const API_ENTRADAS = '../app/api/entradas.php?action=';
const ENDPOINT_PRODUCTO = '../app/api/entradas.php?action=readProd';

document.addEventListener('DOMContentLoaded', function () {
    // Se llama a la función que obtiene los registros para llenar la tabla. Se encuentra en el archivo components.js
    readRows(API_ENTRADAS);

});

// Función para llenar la tabla con los datos de los registros. Se manda a llamar en la función readRows().
function fillTable(dataset) {
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {
        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += `
            <tr>                
                <td>${row.producto}</td>
                <td>${row.cantidad}</td>
                <td>${row.fecha}</td>
                <td>${row.empleado}</td>                
                <td>                
                <a href="#" onclick="openDeleteDialog(${row.id_entrada}, ${row.cantidad}, ${row.id_inventario})" class="btn-floating btn waves-effect waves yellow darken-3"><i class="material-icons" title="Eliminar registro">delete</i></a>
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
            "lengthChange": false,
            "pageLength": 5,
            "responsive": true
        });                    
    }
    
    
    


    // Se inicializa el componente Tooltip asignado a los enlaces para que funcionen las sugerencias textuales.
    M.Tooltip.init(document.querySelectorAll('.tooltipped'));
}

// Función para preparar el formulario al momento de insertar un registro.
function openCreateDialog() {
    // Se restauran los elementos del formulario.
    document.getElementById('save-form').reset();
    // Se abre la caja de dialogo (modal) que contiene el formulario.
    let instance = M.Modal.getInstance(document.getElementById('save-modal'));
    instance.open();
    // Se asigna el título para la caja de dialogo (modal).
    document.getElementById('modal-title').textContent = 'Agregar entrada';
    obtenerFecha();
    // Se llama a la función que llena el select del formulario. Se encuentra en el archivo components.js
    fillSelect(ENDPOINT_PRODUCTO, 'producto', null);
}


function obtenerFecha() {
    // Se declara e inicializa un objeto para obtener la fecha y hora actual.
    let today = new Date();
    // Se declara e inicializa una variable para guardar el día en formato de 2 dígitos.
    let day = ('0' + today.getDate()).slice(-2);
    // Se declara e inicializa una variable para guardar el mes en formato de 2 dígitos.
    var month = ('0' + (today.getMonth() + 1)).slice(-2);
    // Se declara e inicializa una variable para guardar el año con la mayoría de edad.
    let year = today.getFullYear();
    // Se declara e inicializa una variable para establecer el formato de la fecha.
    let date = `${year}-${month}-${day}`;
    document.getElementById('fecha').value = date;
}


// Método manejador de eventos que se ejecuta cuando se envía el formulario de guardar.
document.getElementById('save-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    // Se define una variable para establecer la acción a realizar en la API.
    let action = '';
    // Se comprueba si el campo oculto del formulario esta seteado para actualizar, de lo contrario será para crear.
    if (document.getElementById('id_entrada').value) {
        action = 'update';
    } else {
        action = 'create';
    }
    saveRow(API_ENTRADAS, action, 'save-form', 'save-modal');
    if ($.fn.dataTable.isDataTable('#myTable')) {
        table = $('#myTable').DataTable();
    }
    else {
        table = $('#myTable').DataTable({
            searching: false,
            ordering: false,
            "lengthChange": false,
            "pageLength": 5
        });
    }

});

// Función para establecer el registro a eliminar y abrir una caja de dialogo de confirmación.
function openDeleteDialog(id, cant, inv) {
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('id_entrada', id);
    data.append('cantidad', cant);
    data.append('id_inventario', inv);
    // Se llama a la función que elimina un registro. Se encuentra en el archivo components.js
    confirmDelete(API_ENTRADAS, data);
    if ($.fn.dataTable.isDataTable('#myTable')) {
        table = $('#myTable').DataTable();
    }
    else {
        table = $('#myTable').DataTable({
            searching: false,
            ordering: false,
            "lengthChange": false,
            "pageLength": 5
        });
    }
}