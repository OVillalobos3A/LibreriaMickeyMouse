// Constante para establecer la ruta y parámetros de comunicación con la API.
const API_PROFILE =  '../app/api/perfil.php?action=';

// Método manejador de eventos que se ejecuta cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', function () {
    openName(API_PROFILE);  
    graficaBarrasInventarioStock();
    graficaDonutCantidadVentas();   
    graficaBarrasTotalVentasEnAnio();    
    graficaLinealMarcasconmasProductos();
    graficaPolarProducosMasVendidos();
    graficaPieProducosMasVendidosFrecuencia();  
});

// Función para preparar el formulario al momento de modificar un registro.
function openName() {
    fetch(API_PROFILE + 'openName', {
        method: 'post',
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    let content = '';
                    // Se recorre el conjunto de registros devuelto por la API (dataset) fila por fila a través del objeto row.
                    response.dataset.map(function (row) {
                        // Se crean y concatenan las tarjetas con los datos de cada categoría.
                        content += `
                            <div id="perfil">
                                <div class="center-align">
                                    <img class="circle" height="100" src="../resources/img/empleados/${row.imagen}">
                                    <p class="white-text Texto">${row.ider}</p>
                                </div>
                                <div class="center-align">
                                    <a class="waves-effect amber accent-4 btn"><i class="material-icons right tooltipped" data-tooltip="Modificar perfil" onclick="openUpdateProfile(${row.empleado})">account_circle</i>Perfil</a>
                                    <a class="waves-effect amber accent-4 btn"><i class="material-icons right tooltipped" data-tooltip="Modificar Credenciales" onclick="openUpdateCredentials(${row.id_usuario})">pin</i>Credenciales</a>
                                    <a class="waves-effect amber accent-4 btn"><i class="material-icons center tooltipped" data-tooltip="Gráfico de ventas" onclick="openModalGraphic()">analytics</i></a>
                                </div>
                                <div><br></div>
                            </div>
                            <div class="col s12 m12 l12 center-align">
                                <div class="card white rad">
                                    <!--Defiendo el contenido de la card que contendrá las gráficas-->
                                    <div class="card-content black-text">
                                        
                                        <div id="graficas">
                                            <!--Definiendo el nombre del encabezado-->
                                            <h3 class="center-align Titulos amber-text text-accent-4">${row.usuario}</h3>
                                            <h5 class="center-align Text">Estas son las novedades:</h5>
                                            <!--Definiendo el panel número 1 para almacenar las gráficas-->
                                            <!--En este caso solo son imagenes-->
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            
                        `;
                    });
                    // Se agregan las tarjetas a la etiqueta div mediante su id para mostrar las categorías.
                    document.getElementById('datos').innerHTML = content;
                    // Se inicializa el componente Tooltip asignado a los enlaces para que funcionen las sugerencias textuales.
                    M.Tooltip.init(document.querySelectorAll('.tooltipped'));
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

// Función para preparar el formulario al momento de modificar un registro.
function openUpdateProfile(id) {
    // Se restauran los elementos del formulario.
    document.getElementById('save-form').reset();
    // Se abre la caja de dialogo (modal) que contiene el formulario.
    let instance = M.Modal.getInstance(document.getElementById('save-modal'));
    instance.open();
    // Se asigna el título para la caja de dialogo (modal).
    document.getElementById('modal-title').textContent = 'Editar perfil';
    // Se establece el campo de archivo como opcional.
    document.getElementById('archivo').required = false;
    

    const data = new FormData();
    data.append('id_empleado', id);

    fetch(API_PROFILE + 'readEmfileds', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se inicializan los campos del formulario con los datos del registro seleccionado.
                    document.getElementById('id_empleado').value = response.dataset.emp;
                    document.getElementById('nombre').value = response.dataset.nombre;
                    document.getElementById('apellido').value = response.dataset.apellido;
                    document.getElementById('correo').value = response.dataset.correo;
                    document.getElementById('tel').value = response.dataset.telefono;
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
function openUpdateCredentials(id) {
    // Se restauran los elementos del formulario.
    document.getElementById('credential-form').reset();
    // Se abre la caja de dialogo (modal) que contiene el formulario.
    let instance = M.Modal.getInstance(document.getElementById('credential-modal'));
    instance.open();
    // Se asigna el título para la caja de dialogo (modal).
    document.getElementById('modal-title1').textContent = 'Editar credenciales';
    // Se establece el campo de archivo como opcional.
    document.getElementById('ncontra').required = false;
    document.getElementById('ncontra1').required = false;

    const data = new FormData();
    data.append('id_usuario', id);

    fetch(API_PROFILE + 'readEmfileds', {
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
                    document.getElementById('alias').value = response.dataset.usuario;
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

document.getElementById('save-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // Se define una variable para establecer la acción a realizar en la API.
    let action = '';
    // Se comprueba si el campo oculto del formulario esta seteado para actualizar, de lo contrario será para crear.
    if (document.getElementById('id_empleado').value) {
        action = 'updateProfile';
    } else {
    }
    saveRowUser(API_PROFILE, action, 'save-form', 'save-modal');
});

document.getElementById('credential-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // Se define una variable para establecer la acción a realizar en la API.
    let action = '';
    // Se comprueba si el campo oculto del formulario esta seteado para actualizar, de lo contrario será para crear.
    if (document.getElementById('id_usuario').value) {
        action = 'updateUserCredentials';
    } else {
    }
    saveRowUser(API_PROFILE, action, 'credential-form', 'credential-modal');

});

// Función para mostrar la cantidad de productos por categoría en una gráfica de barras.
function graficaBarrasInventarioStock() {
    fetch(API_PROFILE + 'cantidadProductoStockMax', {
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se remueve la etiqueta canvas de la gráfica.
                if (response.status) {
                    // Se declaran los arreglos para guardar los datos por gráficar.
                    let categorias = [];
                    let cantidad = [];
                    // Se recorre el conjunto de registros devuelto por la API (dataset) fila por fila a través del objeto row.
                    response.dataset.map(function (row) {
                        // Se asignan los datos a los arreglos.
                        categorias.push(row.nombre);
                        cantidad.push(row.stock);
                    });
                    // Se llama a la función que genera y muestra una gráfica de barras. Se encuentra en el archivo components.js
                    barGraph('chart1', categorias, cantidad, 'Cantidad', 'Cantidad en stock');
                } else {
                    document.getElementById('chart1').remove();
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

// Función para mostrar el porcentaje de productos por categoría en una gráfica de pastel.
function graficaDonutCantidadVentas() {
    fetch(API_PROFILE + 'topVentaCantidad', {
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se remueve la etiqueta canvas de la gráfica.
                if (response.status) {
                    // Se declaran los arreglos para guardar los datos por gráficar.
                    let categorias = [];
                    let cantidad = [];
                    // Se recorre el conjunto de registros devuelto por la API (dataset) fila por fila a través del objeto row.
                    response.dataset.map(function (row) {
                        // Se asignan los datos a los arreglos.
                        categorias.push(row.fecha);
                        cantidad.push(row.cantidad);
                    });
                    // Se llama a la función que genera y muestra una gráfica tipo donut. Se encuentra en el archivo components.js
                    doughnutGraph('chart3', categorias, cantidad, 'Ventas realizadas');
                } else {
                    document.getElementById('chart3').remove();
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


// Función para preparar el formulario al momento de realizar la gráfica.
function openModalGraphic() {
    let instance = M.Modal.getInstance(document.getElementById('save-modal1'));
    instance.open();
    graficaLinealVentasUsuario();
    graficaPolarDineroVenta();
}

// Función para mostrar la cantidad de productos por categoría en una gráfica de barras.
function graficaLinealVentasUsuario() {
    fetch(API_PROFILE + 'secondOption', {
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se remueve la etiqueta canvas de la gráfica.
                if (response.status) {
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
                    document.getElementById('chart4').remove();
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

// Función para mostrar el porcentaje de productos por categoría en una gráfica de pastel.
function graficaPolarDineroVenta() {
    fetch(API_PROFILE + 'firstOption', {
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se remueve la etiqueta canvas de la gráfica.
                if (response.status) {
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
                    document.getElementById('chart5').remove();
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


// Función para mostrar la cantidad de productos por categoría en una gráfica de barras.
function graficaBarrasTotalVentasEnAnio() {
    fetch(API_PROFILE + 'TotalVentasEnAnio', {
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se remueve la etiqueta canvas de la gráfica.
                if (response.status) {
                    // Se declaran los arreglos para guardar los datos por gráficar.
                    let categorias = [];
                    let cantidad = [];
                    // Se recorre el conjunto de registros devuelto por la API (dataset) fila por fila a través del objeto row.
                    response.dataset.map(function (row) {
                        // Se asignan los datos a los arreglos.
                        categorias.push(row.mes);
                        cantidad.push(row.venta);
                    });
                    // Se llama a la función que genera y muestra una gráfica de barras. Se encuentra en el archivo components.js
                    barGraph('chart6', categorias, cantidad, 'Ventas en este mes', 'Total de ventas en el año');
                } else {
                    document.getElementById('chart6').remove();
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

// Función para mostrar la cantidad de productos por categoría en una gráfica de barras.
function graficaLinealMarcasconmasProductos() {
    fetch(API_PROFILE + 'MarcasconmasProductos', {
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se remueve la etiqueta canvas de la gráfica.
                if (response.status) {
                    // Se declaran los arreglos para guardar los datos por gráficar.
                    let categorias = [];
                    let cantidad = [];
                    // Se recorre el conjunto de registros devuelto por la API (dataset) fila por fila a través del objeto row.
                    response.dataset.map(function (row) {
                        // Se asignan los datos a los arreglos.
                        categorias.push(row.marca);
                        cantidad.push(row.cantidad);
                    });
                    // Se llama a la función que genera y muestra una gráfica de barras. Se encuentra en el archivo components.js
                    lineGraph('chart8', categorias, cantidad, 'cantidad', 'Marcas');
                } else {
                    document.getElementById('chart8').remove();
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

// Función para mostrar la cantidad de productos por categoría en una gráfica de barras.
function graficaPolarProducosMasVendidos() {
    fetch(API_PROFILE + 'ProducosMasVendidos', {
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se remueve la etiqueta canvas de la gráfica.
                if (response.status) {
                    // Se declaran los arreglos para guardar los datos por gráficar.
                    let categorias = [];
                    let cantidad = [];
                    // Se recorre el conjunto de registros devuelto por la API (dataset) fila por fila a través del objeto row.
                    response.dataset.map(function (row) {
                        // Se asignan los datos a los arreglos.
                        categorias.push(row.nombre);
                        cantidad.push(row.total);
                    });
                    // Se llama a la función que genera y muestra una gráfica de barras. Se encuentra en el archivo components.js
                    polarGraph('chart9', categorias, cantidad, 'Productos', 'Cantidad');
                } else {
                    document.getElementById('chart9').remove();
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

// Función para mostrar la cantidad de productos por categoría en una gráfica de barras.
function graficaPieProducosMasVendidosFrecuencia() {
    fetch(API_PROFILE + 'ProducosMasVendidosFrecuencia', {
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se remueve la etiqueta canvas de la gráfica.
                if (response.status) {
                    // Se declaran los arreglos para guardar los datos por gráficar.
                    let categorias = [];
                    let cantidad = [];
                    // Se recorre el conjunto de registros devuelto por la API (dataset) fila por fila a través del objeto row.
                    response.dataset.map(function (row) {
                        // Se asignan los datos a los arreglos.
                        categorias.push(row.nombre);
                        cantidad.push(row.total);
                    });
                    // Se llama a la función que genera y muestra una gráfica de barras. Se encuentra en el archivo components.js
                    pieGraph('chart7', categorias, cantidad, 'Productos', 'Cantidad');
                } else {
                    document.getElementById('chart7').remove();
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


