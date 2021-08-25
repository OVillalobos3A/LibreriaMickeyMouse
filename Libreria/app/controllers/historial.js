// Constante para establecer la ruta y parámetros de comunicación con la API.
const API_FACTURA = '../app/api/historial.php?action=';

// Método manejador de eventos que se ejecuta cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', function () {
    // Se llama a la función que obtiene los registros para llenar la tabla. Se encuentra en el archivo components.js
    readRows(API_FACTURA);
});


// Función para llenar la tabla con los datos de los registros. Se manda a llamar en la función readRows().
function fillTable(dataset) {
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {
        fechafact = row.fecha;
        estado = row.estado;
        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
            content += `
                <tr>
                    <td>${row.id_factura}</td>
                    <td>${row.estado}</td>
                    <td>${row.total}</td>
                    <td>${row.fecha}</td>
                    <td>${row.usuario}</td>
                    <td>
                        <a href="#" onclick="openAct2(${row.id_factura}, fechafact)" class="btn yellow darken-3 tooltipped" data-tooltip="Ver detalle de la venta"><i class="material-icons">shopping_cart</i></a>
                        <a href="../app/reports/factura.php?id=${row.id_factura}" target="_blank" class="btn waves-effect yellow darken-3 tooltipped" data-tooltip="Comprobante de compra"><i class="material-icons">assignment</i></a>
                    </td>
                </tr>
            `;
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('tbody-rows').innerHTML = content;
    // Se inicializa el componente Material Box asignado a las imagenes para que funcione el efecto Lightbox.
    M.Materialbox.init(document.querySelectorAll('.materialboxed'));
    // Se inicializa el componente Tooltip asignado a los enlaces para que funcionen las sugerencias textuales.
    M.Tooltip.init(document.querySelectorAll('.tooltipped'));
    
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
}

// Método manejador de eventos que se ejecuta cuando se envía el formulario de buscar.
document.getElementById('search-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // Se llama a la función que realiza la búsqueda. Se encuentra en el archivo components.js
    searchRows(API_FACTURA, 'search-form');
});
function openAct2(id, date) {
    // Se restauran los elementos del formulario.
    document.getElementById('save-form1').reset();
    // Se abre la caja de dialogo (modal) que contiene el formulario.
    let instance = M.Modal.getInstance(document.getElementById('save-modal1'));
    instance.open();
    document.getElementById('fact').textContent = id;
    document.getElementById('fecha').textContent= date;
    //Método para ocultar y mostrar secciones en la página correspondiente a pedidos.
    const data = new FormData();
    data.append('id_pedido', id);
    searchRows2(API_FACTURA, data);
    function searchRows2(api, data) {
        fetch(api + 'viewShop', {
            method: 'post',
            body: data
        }).then(function (request) {
            // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
            if (request.ok) {
                request.json().then(function (response) {
                    // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                    if (response.status) {
                        // Se envían los datos a la función del controlador para que llene la tabla en la vista.
                        fillTable1(response.dataset);
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
}
    function fillTable1(dataset) {
        let content = '';
        // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
        dataset.map(function (row) {
            // Se crean y concatenan las filas de la tabla con los datos de cada registro.
            content += `
                <tr>
                    <td> 
                        ${row.nombre}
                    </td>
                    <td><img src="../resources/img/productos/${row.imagen}" class="materialboxed" height="100"></td>
                    <td>${row.cantidad}</td>
                    <td>${row.precio}</td>
                    <td>${row.subtotal}</td>
                </tr>
            `;
        });
        // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
        document.getElementById('tbody-rows1').innerHTML = content;
        // Se inicializa el componente Material Box asignado a las imagenes para que funcione el efecto Lightbox.
    }

    // Función para preparar el formulario al momento de realizar la gráfica.
function openReporte() {
    document.getElementById('option1').style.display = '';
    
    document.getElementById('option2').style.display = 'none';
    // Se restauran los elementos del formulario.
    document.getElementById('save-form2').reset();
    // Se abre la caja de dialogo (modal) que contiene el formulario.
    let instance = M.Modal.getInstance(document.getElementById('save-modal2'));
    instance.open();
    // Se asigna el título para la caja de dialogo (modal).
    document.getElementById('modal-title').textContent = 'Generar gráfico especifico';
}

// Función abrir el formulario para generar el reporte de ventas por fechas.
function openReportDialog() {
    // Se restauran los elementos del formulario.
    document.getElementById('save-form2').reset();
    // Se abre la caja de dialogo (modal) que contiene el formulario.
    let instance = M.Modal.getInstance(document.getElementById('save-modal2'));
    instance.open();
    // Se asigna el título para la caja de dialogo (modal).
    document.getElementById('modal-title').textContent = 'Generar reporte';
   
}

// Método manejador de eventos que se ejecuta cuando se envía el formulario de guardar.
document.getElementById('save-form2').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // Se define una variable para establecer la acción a realizar en la API.
    let action = '';
    // Se comprueba si el campo oculto del formulario esta seteado para actualizar, de lo contrario será para crear.      
    action = 'readReport';    
    if (document.getElementById('fecha1').value > document.getElementById('fecha2').value) {
        sweetAlert(3, 'Fechas especificadas no válidas, asegurese de que el rango de fechas sea el correcto.', null);
    }
    else {        
        loadReport(API_FACTURA, 'save-form2');        
    }    

});

//Funcion para obtener las fechas de inicio y fin para después abrir el reporte de ventas por fechas.
function loadReport(api, form) {
    fetch(api + 'readReport', {
        method: 'post',
        body: new FormData(document.getElementById(form))
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {                                                        
                    window.open('../app/reports/ventas_fecha.php?fecha1='+document.getElementById('fecha1').value+'&fecha2='+document.getElementById('fecha2').value, '_blank');
                    let instance = M.Modal.getInstance(document.getElementById('save-modal2'));
                    instance.close();    
                } else {
                    sweetAlert(3, 'No hay ventas registradas en ese rango de fechas.', null);
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}


