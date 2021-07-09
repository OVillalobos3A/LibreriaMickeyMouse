// Constante para establecer la ruta y parámetros de comunicación con la API.
const API_FACTURA = '../app/api/factura.php?action=';

// Método manejador de eventos que se ejecuta cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', function () {
  // Se llama a la función que obtiene los productos del carrito de compras para llenar la tabla en la vista.
  readOrderDetail();
  readInformation();
});

// Función para obtener el detalle del pedido (carrito de compras).
function readOrderDetail() {
    fetch(API_FACTURA + 'readOrderDetail', {
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se declara e inicializa una variable para concatenar las filas de la tabla en la vista.
                    let content = '';
                    let subtotal = 0;
                    // Se declara e inicializa una variable para ir sumando cada subtotal y obtener el monto final a pagar.
                    let total = 0;
                    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
                    response.dataset.map(function (row) {
                        subtotal = row.cost * row.cantidad;
                        total += subtotal;
                        iva = (total * 13)/100;
                        totalfinal = total + iva;
                        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
                        content += `
                            <tr>
                                <td>${row.nombre}</td>
                                <td>${row.precio}</td>
                                <td>${row.cantidad}</td>
                                <td>${row.subtotal}</td>
                                <td>
                                    <a onclick="openModify(${row.id_detalle}, ${row.cantidad}, ${row.id_inventario})" class="btn-floating btn-small btn tooltipped waves-effect waves-light orange darken-4" data-position="right" data-tooltip="modificar cantidad"><i class="material-icons">add</i></a>
                                    <a onclick="openDeleteDialog(${row.id_detalle})" class="btn-floating btn-small btn tooltipped waves-effect waves-light orange darken-4" data-position="right" data-tooltip="remover producto"><i class="material-icons">remove</i></a>
                                </td>
                            </tr>
                        `;
                    });
                    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
                    document.getElementById('tabla-compra').innerHTML = content;
                    document.getElementById('total').textContent = totalfinal.toFixed(2);
                    document.getElementById('iva').textContent = iva.toFixed(2);
                    document.getElementById('subtotal').textContent = total.toFixed(2);
                    // Se inicializa el componente Tooltip asignado a los enlaces para que funcionen las sugerencias textuales.
                    M.Tooltip.init(document.querySelectorAll('.tooltipped'));
                } else {
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}

function openCreateDialog() {
    // Se abre la caja de dialogo (modal) que contiene el formulario.
    let instance = M.Modal.getInstance(document.getElementById('modal_registro'));
    document.getElementById('save-form').reset(); 
    instance.open();
    fetch(API_FACTURA + 'readAll', {
        method: 'get'
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

    function fillTable1(dataset) {
        let content = '';
        // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
        dataset.map(function (row) {
            // Se crean y concatenan las filas de la tabla con los datos de cada registro.
            content += `
            <tr>
                <td>${row.nombre}</td>
                <td>${row.precio}</td>
                <td><a onclick="openUpdateDialog(${row.id_inventario})" class="btn-floating btn waves-effect waves amber accent-4"><i class="material-icons" title="Añadir producto">add</i></a></td>
            </tr>
            `;
        });
        // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
        document.getElementById('tbody-rows').innerHTML = content;

        // Se agrega la paginación a la tabla
        if ($.fn.dataTable.isDataTable('#myTable2')) {
            table = $('#myTable2').DataTable();              
        }
        else {
            table = $('#myTable2').DataTable({
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
    }
}

// Función para abrir una caja de dialogo (modal) con el formulario de cambiar cantidad de producto.
function openUpdateDialog(id) {  
    // Se restauran los elementos del formulario.
    document.getElementById('item-form').reset();  
    // Se abre la caja de dialogo (modal) que contiene el formulario.
    let instance = M.Modal.getInstance(document.getElementById('item-modal'));
    instance.open();
    // Se inicializan los campos del formulario con los datos del registro seleccionado.
    document.getElementById('id_producto').value = id;
    // Se actualizan los campos para que las etiquetas (labels) no queden sobre los datos.
    M.updateTextFields();
}


// Método manejador de eventos que se ejecuta cuando se envía el formulario de agregar un producto al carrito.
document.getElementById('item-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    fetch(API_FACTURA + 'createDetail', {
        method: 'post',
        body: new FormData(document.getElementById('item-form'))
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se constata si el cliente ha iniciado sesión.
                if (response.status) {
                    sweetAlert(1, response.message);
                    let instance = M.Modal.getInstance(document.getElementById('item-modal'));
                    instance.close();
                    readOrderDetail();
                } else {
                    // Se verifica si el cliente ha iniciado sesión para mostrar la excepción, de lo contrario se direcciona para que se autentique. 
                    if (response.session) {
                        sweetAlert(2, response.exception, null);
                    } else {
                        sweetAlert(3, response.exception, null);
                    }
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
});

function readInformation() {
    fetch(API_FACTURA + 'readFact', {
        method: 'post'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se inicializan los campos del formulario con los datos del registro seleccionado.
                    document.getElementById('id_fact').textContent  = response.dataset.id_factura;
                    document.getElementById('fecha').textContent = response.dataset.fecha;
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

// Función para mostrar un mensaje de confirmación al momento de eliminar un producto del carrito.
function openDeleteDialog(id) {
    swal({
        title: 'Advertencia',
        text: '¿Está seguro de remover el producto?',
        icon: 'warning',
        buttons: ['No', 'Sí'],
        closeOnClickOutside: false,
        closeOnEsc: false
    }).then(function (value) {
        // Se verifica si fue cliqueado el botón Sí para realizar la petición respectiva, de lo contrario no se hace nada.
        if (value) {
            // Se define un objeto con los datos del registro seleccionado.
            const data = new FormData();
            data.append('id_detalle', id);
            fetch(API_FACTURA + 'deleteDetail', {
                method: 'post',
                body: data
            }).then(function (request) {
                // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
                if (request.ok) {
                    request.json().then(function (response) {
                        // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                        if (response.status) {
                            // Se cargan nuevamente las filas en la tabla de la vista después de borrar un producto del carrito.
                            sweetAlert(1, response.message, null);
                            fetch(API_FACTURA + 'readOrderDetail', {
                                method: 'get'
                            }).then(function (request) {
                                // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
                                if (request.ok) {
                                    request.json().then(function (response) {
                                        // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                                        if (response.status) {
                                            // Se declara e inicializa una variable para concatenar las filas de la tabla en la vista.
                                            let content = '';
                                            let subtotal = 0;
                                            // Se declara e inicializa una variable para ir sumando cada subtotal y obtener el monto final a pagar.
                                            let total = 0;
                                            // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
                                            response.dataset.map(function (row) {
                                                subtotal = row.cost * row.cantidad;
                                                total += subtotal;
                                                iva = (total * 13)/100;
                                                totalfinal = total + iva;
                                                // Se crean y concatenan las filas de la tabla con los datos de cada registro.
                                                content += `
                                                    <tr>
                                                        <td>${row.nombre}</td>
                                                        <td>${row.precio}</td>
                                                        <td>${row.cantidad}</td>
                                                        <td>${row.subtotal}</td>
                                                        <td>
                                                            <a onclick="openModify(${row.id_detalle}, ${row.cantidad}, ${row.id_inventario})" class="btn-floating btn-small btn tooltipped waves-effect waves-light orange darken-4" data-position="right" data-tooltip="modificar cantidad"><i class="material-icons">add</i></a>
                                                            <a onclick="openDeleteDialog(${row.id_detalle})" class="btn-floating btn-small btn tooltipped waves-effect waves-light orange darken-4" data-position="right" data-tooltip="remover producto"><i class="material-icons">remove</i></a>
                                                        </td>
                                                    </tr>
                                                `;
                                            });
                                            // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
                                            document.getElementById('tabla-compra').innerHTML = content;
                                            document.getElementById('total').textContent = totalfinal.toFixed(2);
                                            document.getElementById('iva').textContent = iva.toFixed(2);
                                            document.getElementById('subtotal').textContent = total.toFixed(2);
                                            // Se inicializa el componente Tooltip asignado a los enlaces para que funcionen las sugerencias textuales.
                                            M.Tooltip.init(document.querySelectorAll('.tooltipped'));
                                        } else {
                                            // Se declara e inicializa una variable para concatenar las filas de la tabla en la vista.
                                            let content = '';
                                            let subtotal = 0.00;
                                            let iva = 0.00;
                                            let totalfinal = 0.00;
                                            // Se declara e inicializa una variable para ir sumando cada subtotal y obtener el monto final a pagar.
                                            let total = 0.00;
                                            // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
                                            response.dataset.map(function (row) {
                                                subtotal = 0.00;
                                                total = 0.00;
                                                iva = 0.00;
                                                totalfinal = 0.00;
                                                // Se crean y concatenan las filas de la tabla con los datos de cada registro.
                                                content += `
                                                    <tr>
                                                        <td>${row.nombre}</td>
                                                        <td>${row.precio}</td>
                                                        <td>${row.cantidad}</td>
                                                        <td>${row.subtotal}</td>
                                                        <td>
                                                            <a onclick="openModify(${row.id_detalle}, ${row.cantidad}, ${row.id_inventario})" class="btn-floating btn-small btn tooltipped waves-effect waves-light orange darken-4" data-position="right" data-tooltip="modificar cantidad"><i class="material-icons">add</i></a>
                                                            <a onclick="openDeleteDialog(${row.id_detalle})" class="btn-floating btn-small btn tooltipped waves-effect waves-light orange darken-4" data-position="right" data-tooltip="remover producto"><i class="material-icons">remove</i></a>
                                                        </td>
                                                    </tr>
                                                `;
                                            });
                                            // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
                                            document.getElementById('tabla-compra').innerHTML = content;
                                            document.getElementById('total').textContent = totalfinal.toFixed(2);
                                            document.getElementById('iva').textContent = iva.toFixed(2);
                                            document.getElementById('subtotal').textContent = total.toFixed(2);
                                            // Se inicializa el componente Tooltip asignado a los enlaces para que funcionen las sugerencias textuales.
                                            M.Tooltip.init(document.querySelectorAll('.tooltipped'));
                                        }
                                    });
                                } else {
                                    console.log(request.status + ' ' + request.statusText);
                                }
                            }).catch(function (error) {
                                console.log(error);
                            });
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
    });
}

// Función para abrir una caja de dialogo (modal) con el formulario de cambiar cantidad de producto.
function openModify(id, quantity, product) {    
    // Se abre la caja de dialogo (modal) que contiene el formulario.
    let instance = M.Modal.getInstance(document.getElementById('item1-modal'));
    instance.open();
    // Se inicializan los campos del formulario con los datos del registro seleccionado.
    document.getElementById('id_detalle1').value = id;
    document.getElementById('cantidad_producto1').value = quantity;
    document.getElementById('id_producto1').value = product;
    document.getElementById('stock1').value = quantity;
    // Se actualizan los campos para que las etiquetas (labels) no queden sobre los datos.
    M.updateTextFields();
}


// Método manejador de eventos que se ejecuta cuando se envía el formulario de cambiar cantidad de producto.
document.getElementById('item1-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    let stock = document.getElementById('stock1').value;
    let nquantity = document.getElementById('cantidad_producto1').value;
    if (stock == nquantity) {
        document.getElementById('mensaje').textContent = "Por favor ingrese una cantidad que no sea igual, para poder efectuar un cambio.";
    } else {
        if (stock > nquantity) {
            fetch(API_FACTURA + 'updateDetail', {
                method: 'post',
                body: new FormData(document.getElementById('item1-form'))
            }).then(function (request) {
                // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
                if (request.ok) {
                    request.json().then(function (response) {
                        // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                        if (response.status) {
                            // Se actualiza la tabla en la vista para mostrar el cambio de la cantidad de producto.
                            readOrderDetail();
                            // Se cierra la caja de dialogo (modal) del formulario.
                            let instance = M.Modal.getInstance(document.getElementById('item1-modal'));
                            instance.close();
                            sweetAlert(1, response.message, null);
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
        } else if (stock < nquantity){
            let total = nquantity - stock;
            document.getElementById('sbuscar1').value = total;
            fetch(API_FACTURA + 'updateDetail1', {
                method: 'post',
                body: new FormData(document.getElementById('item1-form'))
            }).then(function (request) {
                // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
                if (request.ok) {
                    request.json().then(function (response) {
                        // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                        if (response.status) {
                            // Se actualiza la tabla en la vista para mostrar el cambio de la cantidad de producto.
                            readOrderDetail();
                            // Se cierra la caja de dialogo (modal) del formulario.
                            let instance = M.Modal.getInstance(document.getElementById('item1-modal'));
                            instance.close();
                            sweetAlert(1, response.message, null);
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
});


// Función para mostrar un mensaje de confirmación al momento de finalizar el pedido.
function finishFact() {
    swal({
        title: 'Aviso',
        text: '¿Está seguro de finalizar la compra?',
        icon: 'info',
        buttons: ['No', 'Sí'],
        closeOnClickOutside: false,
        closeOnEsc: false
    }).then(function (value) {
        // Se verifica si fue cliqueado el botón Sí para realizar la petición respectiva, de lo contrario se muestra un mensaje.
        if (value) {
            fetch(API_FACTURA + 'finishFact', {
                method: 'get'
            }).then(function (request) {
                // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
                if (request.ok) {
                    request.json().then(function (response) {
                        // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                        if (response.status) {
                            sweetAlert(1, response.message);
                            fetch(API_FACTURA + 'readOrderDetail', {
                                method: 'get'
                            }).then(function (request) {
                                // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
                                if (request.ok) {
                                    request.json().then(function (response) {
                                        // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                                        if (response.status) {
                                            // Se declara e inicializa una variable para concatenar las filas de la tabla en la vista.
                                            let content = '';
                                            let subtotal = 0;
                                            // Se declara e inicializa una variable para ir sumando cada subtotal y obtener el monto final a pagar.
                                            let total = 0;
                                            // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
                                            response.dataset.map(function (row) {
                                                subtotal = row.cost * row.cantidad;
                                                total += subtotal;
                                                iva = (total * 13)/100;
                                                totalfinal = total + iva;
                                                // Se crean y concatenan las filas de la tabla con los datos de cada registro.
                                                content += `
                                                    <tr>
                                                        <td>${row.nombre}</td>
                                                        <td>${row.precio}</td>
                                                        <td>${row.cantidad}</td>
                                                        <td>${row.subtotal}</td>
                                                        <td>
                                                            <a onclick="openModify(${row.id_detalle}, ${row.cantidad}, ${row.id_inventario})" class="btn-floating btn-small btn tooltipped waves-effect waves-light orange darken-4" data-position="right" data-tooltip="modificar cantidad"><i class="material-icons">add</i></a>
                                                            <a onclick="openDeleteDialog(${row.id_detalle})" class="btn-floating btn-small btn tooltipped waves-effect waves-light orange darken-4" data-position="right" data-tooltip="remover producto"><i class="material-icons">remove</i></a>
                                                        </td>
                                                    </tr>
                                                `;
                                            });
                                            // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
                                            document.getElementById('tabla-compra').innerHTML = content;
                                            document.getElementById('total').textContent = totalfinal.toFixed(2);
                                            document.getElementById('iva').textContent = iva.toFixed(2);
                                            document.getElementById('subtotal').textContent = total.toFixed(2);
                                            // Se inicializa el componente Tooltip asignado a los enlaces para que funcionen las sugerencias textuales.
                                            M.Tooltip.init(document.querySelectorAll('.tooltipped'));
                                        } else {
                                            // Se declara e inicializa una variable para concatenar las filas de la tabla en la vista.
                                            let content = '';
                                            let subtotal = 0.00;
                                            let iva = 0.00;
                                            let totalfinal = 0.00;
                                            // Se declara e inicializa una variable para ir sumando cada subtotal y obtener el monto final a pagar.
                                            let total = 0.00;
                                            // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
                                            response.dataset.map(function (row) {
                                                subtotal = 0.00;
                                                total = 0.00;
                                                iva = 0.00;
                                                totalfinal = 0.00;
                                                // Se crean y concatenan las filas de la tabla con los datos de cada registro.
                                                content += `
                                                    <tr>
                                                        <td>${row.nombre}</td>
                                                        <td>${row.precio}</td>
                                                        <td>${row.cantidad}</td>
                                                        <td>${row.subtotal}</td>
                                                        <td>
                                                            <a onclick="openModify(${row.id_detalle}, ${row.cantidad}, ${row.id_inventario})" class="btn-floating btn-small btn tooltipped waves-effect waves-light orange darken-4" data-position="right" data-tooltip="modificar cantidad"><i class="material-icons">add</i></a>
                                                            <a onclick="openDeleteDialog(${row.id_detalle})" class="btn-floating btn-small btn tooltipped waves-effect waves-light orange darken-4" data-position="right" data-tooltip="remover producto"><i class="material-icons">remove</i></a>
                                                        </td>
                                                    </tr>
                                                `;
                                            });
                                            // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
                                            document.getElementById('tabla-compra').innerHTML = content;
                                            document.getElementById('total').textContent = totalfinal.toFixed(2);
                                            document.getElementById('iva').textContent = iva.toFixed(2);
                                            document.getElementById('subtotal').textContent = total.toFixed(2);
                                            // Se inicializa el componente Tooltip asignado a los enlaces para que funcionen las sugerencias textuales.
                                            M.Tooltip.init(document.querySelectorAll('.tooltipped'));
                                        }
                                    });
                                } else {
                                    console.log(request.status + ' ' + request.statusText);
                                }
                            }).catch(function (error) {
                                console.log(error);
                            });
                            readInformation();
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
        } else {
            sweetAlert(4, 'Puede seguir añadiendo más productos', null);
        }
    });
}



