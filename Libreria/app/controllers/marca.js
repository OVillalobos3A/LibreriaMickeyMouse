// Constantes para establecer las rutas y parámetros de comunicación con la API.
const API_USUARIOS = '../app/api/usuarios.php?action=';
const API_MARCA = '../app/api/marca.php?action=';

document.addEventListener('DOMContentLoaded', function () {
    revisar();
    // Se declara e inicializa un objeto para obtener la fecha y hora actual.
    let today = new Date();
    // Se declara e inicializa una variable para guardar el día en formato de 2 dígitos.
    let day = ('0' + today.getDate()).slice(-2);
    // Se declara e inicializa una variable para guardar el mes en formato de 2 dígitos.
    var month = ('0' + (today.getMonth() + 1)).slice(-2);
    // Se declara e inicializa una variable para guardar el año con la mayoría de edad.
    let year = today.getFullYear() - 18;
    // Se declara e inicializa una variable para establecer el formato de la fecha.
    let date = `${year}-${month}-${day}`;

});

function revisar() {
    const data = new FormData();
    data.append('link', 'marca.php');
    
    fetch(API_USUARIOS + 'readPagina', {
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
                readRows(API_MARCA);
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
              <td>${row.nombre_marca}</td>                  
              <td>
                <a href="#" onclick="openUpdateDialog(${row.id_marca})" class="btn-floating  btn waves-effect waves amber accent-4" data-tooltip="Editar"><i class="material-icons" title="Editar registro">create</i></a>
                <a href="#" onclick="openDeleteDialog(${row.id_marca})" class="btn-floating btn waves-effect waves amber accent-4" data-tooltip="Eliminar"><i class="material-icons" title="Eliminar registro">delete</i></a>
                <a href="../app/reports/productos_marca.php?id=${row.id_marca}" target="_blank" class="btn-floating btn waves-effect waves amber accent-4" data-tooltip="Ver Reporte de Productos"><i class="material-icons" title="Ver Reporte de Productos">assignment</i></a>
                <a href="#" onclick="openGraphic(${row.id_marca})" class="btn-floating btn waves-effect waves amber accent-4"><i class="material-icons" title="Gráfico de los productos de la marca">assessment</i></a>
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
    searchRows(API_MARCA, 'search-form');
});

// Función para preparar el formulario al momento de insertar un registro.
function openCreateDialog() {
    // Se restauran los elementos del formulario.
    document.getElementById('save-form').reset();
    // Se abre la caja de dialogo (modal) que contiene el formulario.
    let instance = M.Modal.getInstance(document.getElementById('save-modal'));
    instance.open();
    // Se asigna el título para la caja de dialogo (modal).
    document.getElementById('modal-title').textContent = 'Agregar marca';
}

function openUpdateDialog(id) {
    // Se restauran los elementos del formulario.
    document.getElementById('save-form').reset();
    // Se abre la caja de dialogo (modal) que contiene el formulario.
    let instance = M.Modal.getInstance(document.getElementById('save-modal'));
    instance.open();
    // Se asigna el título para la caja de dialogo (modal).
    document.getElementById('modal-title').textContent = 'Actualizar marca';

    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('id_marca', id);

    fetch(API_MARCA + 'readOne', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se inicializan los campos del formulario con los datos del registro seleccionado.
                    document.getElementById('id_marca').value = response.dataset.id_marca;
                    document.getElementById('nombre').value = response.dataset.nombre_marca;
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
    if (document.getElementById('id_marca').value) {
        action = 'update';
    } else {
        action = 'create';
    }
    saveRow(API_MARCA, action, 'save-form', 'save-modal');

});


// Función para establecer el registro a eliminar y abrir una caja de dialogo de confirmación.
function openDeleteDialog(id) {
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('id_marca', id);
    // Se llama a la función que elimina un registro. Se encuentra en el archivo components.js
    confirmDelete(API_MARCA, data);
}

function openGraphic(id) {
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('id_mar', id);
    graficaDonutProductosCantidadXMarca(API_MARCA, data);
}

function graficaDonutProductosCantidadXMarca(api, data) {
    fetch(api + 'ProductosCantidadXMarca', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se remueve la etiqueta canvas de la gráfica.
                if (response.status) {
                    // Se declaran los arreglos para guardar los datos por gráficar.
                    document.getElementById("chart11").remove();
                    var canvas = document.createElement("canvas");
                    canvas.id = "chart11"; 
                    document.getElementById("contenedor").appendChild(canvas);
                    let instance = M.Modal.getInstance(document.getElementById('save-modal1'));
                    instance.open();
                    let categorias = [];
                    let cantidad = [];
                    // Se recorre el conjunto de registros devuelto por la API (dataset) fila por fila a través del objeto row.
                    response.dataset.map(function (row) {
                        // Se asignan los datos a los arreglos.
                        categorias.push(row.nombre);
                        cantidad.push(row.stock);
                    });
                    // Se llama a la función que genera y muestra una gráfica tipo donut. Se encuentra en el archivo components.js
                    pieGraph('chart11', categorias, cantidad, 'Cantidad en Stock');
                } else {
                    document.getElementById("chart11").remove();
                    var canvas = document.createElement("canvas");
                    canvas.id = "chart11"; 
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
