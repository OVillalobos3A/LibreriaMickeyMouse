// Constantes para establecer las rutas y parámetros de comunicación con la API.
const API_USUARIOS = '../app/api/usuarios.php?action=';
const API_PRODUCTOS = '../app/api/productos.php?action=';
const ENDPOINT_TIPO_PRODUCTOS= '../app/api/productos.php?action=readTypes';
const ENDPOINT_TIPO_MARCA= '../app/api/productos.php?action=readBrands';
const ENDPOINT_PROVEEDOR= '../app/api/productos.php?action=readProvs';

// Método manejador de eventos que se ejecuta cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', function () {
    revisar();
    // Se llama a la función que obtiene los registros para llenar la tabla. Se encuentra en el archivo components.js
    
    
});
function revisar() {
    const data = new FormData();
    data.append('link', 'inventario.php');
    
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
                    readRows(API_PRODUCTOS);
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
    //Se crea la variable del contenido
    let content = '';
    //Se crea la variable que contiene el modal para crear productos
    let adder = '';
    adder +=    `
    <div class="col s12 m6 l4">
        <div class="col s12 white hoverable appear-down rad">
            <div class="card small z-depth-0">
                <div class="card-content black-text center">
                    <div class="container">
                        <div class="row">
                            <div class="col s12 m12 l12">
                                <br><br><br>
                                <a onclick="openCreateDialog()" href="#">
                                <i class="valing-wrapper"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                    width="50" height="50"
                                    viewBox="0 0 50 50"
                                    style=" fill:#000000;"><path d="M 20 4 A 1.0001 1.0001 0 0 0 19.292969 4.2929688 L 17.585938 6 L 9.3867188 6 C 7.5296852 6 5.9058511 7.2896965 5.4882812 9.0996094 L 3.2050781 19 L 2 19 C 0.897 19 0 19.897 0 21 L 0 24 C 0 25.103 0.897 26 2 26 L 48 26 C 49.103 26 50 25.103 50 24 L 50 21 C 50 19.897 49.103 19 48 19 L 46.794922 19 L 44.509766 9.0996094 C 44.0923 7.2901497 42.470315 6 40.613281 6 L 32.414062 6 L 30.707031 4.2929688 A 1.0001 1.0001 0 0 0 30 4 L 20 4 z M 20.414062 6 L 29.585938 6 L 31.292969 7.7070312 A 1.0001 1.0001 0 0 0 32 8 L 40.613281 8 C 41.550248 8 42.351965 8.638241 42.5625 9.5507812 L 44.742188 19 L 5.2578125 19 L 7.4375 9.5507812 C 7.6479301 8.6386942 8.4497521 8 9.3867188 8 L 18 8 A 1.0001 1.0001 0 0 0 18.707031 7.7070312 L 20.414062 6 z M 2.7695312 28 L 7.8261719 45.542969 C 8.0701719 46.387969 8.985 47 10 47 L 32.880859 47 C 34.697941 48.847586 37.219827 50 40 50 C 45.5 50 50 45.5 50 40 C 50 36.774533 48.446014 33.902012 46.056641 32.070312 L 47.230469 28 L 2.7695312 28 z M 17 31 C 17.55 31 18 31.45 18 32 L 18 43 C 18 43.55 17.55 44 17 44 C 16.45 44 16 43.55 16 43 L 16 32 C 16 31.45 16.45 31 17 31 z M 25 31 L 25.001953 31 C 25.550953 31 26 31.45 26 32 L 26 43 C 26 43.55 25.55 44 25 44 C 24.45 44 24 43.55 24 43 L 24 32 C 24 31.45 24.45 31 25 31 z M 40 32 C 44.4 32 48 35.6 48 40 C 48 44.4 44.4 48 40 48 C 35.6 48 32 44.4 32 40 C 32 35.6 35.6 32 40 32 z M 40 34.099609 C 39.4 34.099609 39 34.499609 39 35.099609 L 39 39 L 35.099609 39 C 34.499609 39 34.099609 39.4 34.099609 40 C 34.099609 40.6 34.499609 41 35.099609 41 L 39 41 L 39 44.900391 C 39 45.500391 39.4 45.900391 40 45.900391 C 40.6 45.900391 41 45.500391 41 44.900391 L 41 41 L 44.900391 41 C 45.500391 41 45.900391 40.6 45.900391 40 C 45.900391 39.4 45.500391 39 44.900391 39 L 41 39 L 41 35.099609 C 41 34.499609 40.6 34.099609 40 34.099609 z"></path></svg></i>  
                                </a>
                            </div>
                        </div>
                    </div>
                    <span class="card-title Titulos black-text center">Agregar Producto</span>
                </div>             
            </div>
        </div>
        <div class="col">
        <br>
        </div>
    </div>
    `;
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {
        content += `   
            <div class="col s12 m6 l4">
                <div class="col s12 white hoverable appear-down rad">
                    <div class="card small z-depth-0">
                        <!--Imagen del producto-->
                        <div class="card-image">
                            <img src="../resources/img/productos/${row.imagen}">            
                        </div>
                        <a href='#' data-target='dropdownmas' class="hide dropdown-trigger btn-floating right btn-large waves-effect waves-light white z-depth-0">
                        <i class="large material-icons black-text hoverable">more_vert</i>
                        </a>
                        <div class="card-content black-text">
                            <span class="card-title Titulos black-text">$${row.precio}</span>
                            <p class="Texto">${row.nombre_producto}</p>
                            <p class="Texto">Disponibles: ${row.stock}</p>
                            <p class="Texto">Marca: ${row.nombre_marca}</p>
                            <div class="row">
                                <div class="col s3 m3 l3">
                                    <a href="#" onclick="openViewDialog(${row.id_inventario})" class="btn btn-floating waves-effect white z-depth-0 tooltipped" data-tooltip="Ver más"><i class="material-icons black-text">call_made</i></a>   
                                </div>
                                <div class="col s3 m3 l3">
                                    <a href="#" onclick="openUpdateDialog(${row.id_inventario})" class="btn btn-floating waves-effect white z-depth-0 tooltipped" data-tooltip="Actualizar"><i class="material-icons black-text">mode_edit</i></a>   
                                </div>
                                <div class="col s3 m3 l3">
                                    <a href="entradas.php" class="btn btn-floating waves-effect white z-depth-0 tooltipped" data-tooltip="Actualizar Stock"><i class="material-icons black-text">iso</i></a>
                                </div>
                                <div class="col s3 m3 l3">
                                    <a onclick="openDeleteDialog(${row.id_inventario})" class="btn btn-floating waves-effect white z-depth-0 tooltipped" data-tooltip="Eliminar"><i class="material-icons black-text">delete</i></a>
                                </div>
                            </div>  
                        </div>          
                    </div>
                </div>
                <div class="col">
                    <br>
                </div>
            </div>
    
            
        `;
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('tbody-rows').innerHTML = adder + content;
    // Se inicializa el componente Material Box asignado a las imagenes para que funcione el efecto Lightbox.
    M.Materialbox.init(document.querySelectorAll('.materialboxed'));
    // Se inicializa el componente Tooltip asignado a los enlaces para que funcionen las sugerencias textuales.
    M.Tooltip.init(document.querySelectorAll('.tooltipped'));
}
// Método manejador de eventos que se ejecuta cuando se envía el formulario de buscar.
document.getElementById('search-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // Se llama a la función que realiza la búsqueda. Se encuentra en el archivo components.js
    searchRows(API_PRODUCTOS, 'search-form');
});

// Función para ver todos los detaller del producto
function openViewDialog(id) {
    // Se abre la caja de dialogo (modal) que contiene el formulario.
    let instance = M.Modal.getInstance(document.getElementById('view-modal'));
    instance.open();
    
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('id_producto', id);

    fetch(API_PRODUCTOS + 'readOne', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se inicializan los campos del modal con los datos del registro seleccionado.
                    document.getElementById('nombre-v').textContent = response.dataset.nombre_producto;
                    document.getElementById('precio-v').textContent = '$' + response.dataset.precio;
                    document.getElementById('autor-v').textContent = 'Autor: '+response.dataset.autor;
                    document.getElementById('descripcion-v').textContent = response.dataset.descripcion;
                    document.getElementById('stock-v').textContent = 'Cantidad disponible: ' + response.dataset.stock;
                    document.getElementById('tipo_producto-v').textContent = 'Tipo de producto: '+response.dataset.tipo_producto;
                    document.getElementById('marca-v').textContent = 'Marca: ' + response.dataset.nombre_marca;
                    document.getElementById('proveedor-v').textContent = 'Proveedor: ' + response.dataset.proveedor;
                    document.getElementById('imagen-v').setAttribute('src', '../resources/img/productos/' + response.dataset.imagen);
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

// Función para preparar el formulario al momento de insertar un registro.
function openCreateDialog() {
    // Se restauran los elementos del formulario.
    document.getElementById('save-form').reset();
    // Se abre la caja de dialogo (modal) que contiene el formulario.
    let instance = M.Modal.getInstance(document.getElementById('save-modal'));
    instance.open();
    // Se asigna el título para la caja de dialogo (modal).
    document.getElementById('modal-title').textContent = 'Crear producto';
    // Se establece el campo de archivo como obligatorio.
    document.getElementById('foto').required = true;
    document.getElementById('esconder').classList.add("hide");
    // Se llama a la función que llena el select del formulario. Se encuentra en el archivo components.js
   fillSelect(ENDPOINT_TIPO_PRODUCTOS, 'tipo_producto', null);
   fillSelect(ENDPOINT_TIPO_MARCA, 'marca', null);
   fillSelect(ENDPOINT_PROVEEDOR, 'proveedor', null);
}

// Función para preparar el formulario al momento de modificar un registro.
function openUpdateDialog(id) {
    // Se restauran los elementos del formulario.
    document.getElementById('save-form').reset();
    // Se abre la caja de dialogo (modal) que contiene el formulario.
    let instance = M.Modal.getInstance(document.getElementById('save-modal'));
    instance.open();
    // Se asigna el título para la caja de dialogo (modal).
    document.getElementById('modal-title').textContent = 'Actualizar producto';
    // Se establece el campo de archivo como opcional.
    document.getElementById('foto').required = false;
    document.getElementById('stock').disabled = true;
    document.getElementById('label-stock').innerHTML="Cantidad (solo puede actualizarse haciendo una entrada) ";
    document.getElementById('aviso').innerHTML="Los cambios(incluyendo la imagen del producto) se visualizaran al guardar los datos";

    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('id_producto', id);

    fetch(API_PRODUCTOS + 'readOne', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se inicializan los campos del formulario con los datos del registro seleccionado.
                    document.getElementById('id_producto').value = response.dataset.id_inventario;
                    document.getElementById('nombre').value = response.dataset.nombre_producto;
                    document.getElementById('precio').value = response.dataset.precio;
                    document.getElementById('autor').value = response.dataset.autor;
                    document.getElementById('descripcion').value = response.dataset.descripcion;
                    document.getElementById('stock').value = response.dataset.stock;
                    fillSelect(ENDPOINT_TIPO_PRODUCTOS, 'tipo_producto', response.dataset.id_tipo_producto);
                    fillSelect(ENDPOINT_TIPO_MARCA, 'marca', response.dataset.id_marca);
                    fillSelect(ENDPOINT_PROVEEDOR, 'proveedor', response.dataset.id_proveedor);
                    document.getElementById('imagen').setAttribute('src', '../resources/img/productos/' + response.dataset.imagen);
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
    if (document.getElementById('id_producto').value) {
        action = 'update';
    } else {
        action = 'create';
    }
    saveRow(API_PRODUCTOS, action, 'save-form', 'save-modal');
});

// Función para establecer el registro a eliminar y abrir una caja de dialogo de confirmación.
function openDeleteDialog(id) {
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('id_producto', id);
    // Se llama a la función que elimina un registro. Se encuentra en el archivo components.js
    confirmDelete(API_PRODUCTOS, data);
}