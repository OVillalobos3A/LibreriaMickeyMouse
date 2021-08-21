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
                <a href="#" onclick="openDeleteDialog(${row.id_entrada}, ${row.cantidad}, ${row.id_inventario})" class="btn-floating btn waves-effect waves amber accent-4"><i class="material-icons" title="Eliminar registro">delete</i></a>
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
    searchRows(API_ENTRADAS, 'search-form');
});

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

// Función para preparar el formulario al momento de realizar la gráfica.
function openCreateDialog1() {
    document.getElementById('option1').style.display = '';
    document.getElementById('chart2').style.display = 'none';
    document.getElementById('option2').style.display = 'none';
    // Se restauran los elementos del formulario.
    document.getElementById('save-form1').reset();
    // Se abre la caja de dialogo (modal) que contiene el formulario.
    let instance = M.Modal.getInstance(document.getElementById('save-modal1'));
    instance.open();
    // Se asigna el título para la caja de dialogo (modal).
    document.getElementById('modal-title').textContent = 'Generar gráfico especifico';
}

function showTwo() {
    document.getElementById('option2').style.display = '';
    document.getElementById('option1').style.display = 'none';
    document.getElementById('date1').value = document.getElementById('fecha1').value;
    document.getElementById('date2').value = document.getElementById('fecha2').value;
}

function showOne() {
    document.getElementById('option1').style.display = '';
    document.getElementById('option2').style.display = 'none';
    document.getElementById('fecha1').value = document.getElementById('date1').value;
    document.getElementById('fecha2').value = document.getElementById('date2').value;
}

document.getElementById('save-form1').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // Se llama a la función que realiza la búsqueda. Se encuentra en el archivo components.js
    if (document.getElementById('fecha1').value > document.getElementById('fecha2').value) {
        sweetAlert(3, 'Fechas especificadas no válidas, asegurese de que el rango de fechas sea el correcto.', null);
    }
    else {
        loadGraphicOne(API_ENTRADAS, 'save-form1');
    }
    
});

document.getElementById('save-form2').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    if (document.getElementById('date1').value > document.getElementById('date2').value) {
        sweetAlert(3, 'Fechas especificadas no válidas, asegurese de que el rango de fechas sea el correcto.', null);
    }
    else {
        loadGraphicTwo(API_ENTRADAS, 'save-form2');
    }
});

function loadGraphicOne(api, form) {
    fetch(api + 'firstOption', {
        method: 'post',
        body: new FormData(document.getElementById(form))
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    document.getElementById("chart2").remove();
                    var canvas = document.createElement("canvas");
                    canvas.id = "chart2"; 
                    document.getElementById("contenedor").appendChild(canvas);
                    document.getElementById('chart2').style.display = '';
                    // Se declaran los arreglos para guardar los datos por gráficar.
                    let categorias = [];
                    let cantidad = [];
                    // Se recorre el conjunto de registros devuelto por la API (dataset) fila por fila a través del objeto row.
                    response.dataset.map(function (row) {
                        // Se asignan los datos a los arreglos.
                        categorias.push(row.fecha);
                        cantidad.push(row.cantidad);
                    });
                    // Se llama a la función que genera y muestra una gráfica de barras. Se encuentra en el archivo components.js
                    lineGraph('chart2', categorias, cantidad, 'Cantidad', 'Cantidad de entradas realizadas');
                } else {
                    sweetAlert(3, response.exception, null);
                    document.getElementById("chart2").remove();
                    var canvas = document.createElement("canvas");
                    canvas.id = "chart2"; 
                    document.getElementById("contenedor").appendChild(canvas);
                    document.getElementById('chart2').style.display = 'none';
                    console.log(response.exception);
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}

function loadGraphicTwo(api, form) {
    fetch(api + 'secondOption', {
        method: 'post',
        body: new FormData(document.getElementById(form))
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    document.getElementById("chart2").remove();
                    var canvas = document.createElement("canvas");
                    canvas.id = "chart2"; 
                    document.getElementById("contenedor").appendChild(canvas);
                    document.getElementById('chart2').style.display = '';
                    // Se declaran los arreglos para guardar los datos por gráficar.
                    let categorias = [];
                    let cantidad = [];
                    // Se recorre el conjunto de registros devuelto por la API (dataset) fila por fila a través del objeto row.
                    response.dataset.map(function (row) {
                        // Se asignan los datos a los arreglos.
                        categorias.push(row.nombre);
                        cantidad.push(row.cantidad);
                    });
                    // Se llama a la función que genera y muestra una gráfica de barras. Se encuentra en el archivo components.js
                    barGraph('chart2', categorias, cantidad, 'Cantidad', 'Cantidad ingresada por producto');
                } else {
                    sweetAlert(3, response.exception, null);
                    document.getElementById("chart2").remove();
                    var canvas = document.createElement("canvas");
                    canvas.id = "chart2"; 
                    document.getElementById("contenedor").appendChild(canvas);
                    document.getElementById('chart2').style.display = 'none';
                    console.log(response.exception);
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}


