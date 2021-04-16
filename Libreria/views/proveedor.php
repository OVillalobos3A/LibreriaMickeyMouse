<?php
include("../app/helpers/dashboard.php");
Dashboard_Page::headerTemplate('Proveedores');
?>
<br>
<br>
<div class="container">
    <div class="card whithe">
        <div class="card-content Black-text">
            <!--Colocamos el titulo de la card-->
            <span class="card-title center-align"><b> Visualizar Proveedores </b></span>
            <br>
            <!--Agregamos un botón cuya función es que nos mueste el formulario para agregar-->
            <!--un registro-->
            <div class="col s6">
                <a class="waves-effect yellow darken-3 btn modal-trigger" href="#modal_registro">
                    <i class="material-icons left">add</i>Agregar proveedor
                </a>
            </div>
            <br>
            <!--Se añade un input field el cual su función es buscar una entrada en especifico-->
            <div class="input-field col s6">
                <i class="material-icons prefix">search</i>
                <input type="text" id="autocomplete-input" class="autocomplete">
                <label for="autocomplete-input">Buscar proveedor</label>
            </div>
            <!-- Modal Structure -->
            <div id="modal_registro" class="modal">
                <div class="modal-content">
                    <h5 class="center-align">Agregar proveedor</h5>
                    <br>
                    <!--Estableciendo el tamaño de cada div correspondiente-->
                    <div class="row">
                        <!--Creamos la estructura del formulario respectivo-->
                        <form class="col-md-4">
                            <div class="row">
                                <!--Estableciendo el tamaño del que tomará el Input field-->
                                <div class="input-field col s12 m6 l6">
                                    <select>
                                        <optgroup label="Empleados">
                                            <option value="1">Oscar Villanueva</option>
                                            <option value="2">Carlos Adonay</option>
                                        </optgroup>
                                    </select>
                                    <label>Empleado</label>
                                </div>
                                <!--Estableciendo el tamaño del que tomará el Input field-->
                                <div class="input-field col s12 m6 l6">
                                    <select>
                                        <optgroup label="Tipo de Usuario">
                                            <option value="1">Administrador</option>
                                            <option value="2">Root</option>
                                            <option value="3">Gerente</option>
                                        </optgroup>
                                    </select>
                                    <label>Tipo de usuarios</label>
                                </div>
                            </div>
                            <div class="row">
                                <!--Estableciendo el tamaño del que tomará el Input field-->
                                <div class="input-field col s12 m6 l6">
                                    <input id="nombre" type="text" class="validate">
                                    <label for="nombre">Nombre</label>
                                </div>
                            </div>
                            <div class="row">
                                <!--Estableciendo el tamaño del que tomará el Input field-->
                                <div class="input-field col s12 m6 l6">
                                    <input id="Correo" type="text" class="validate">
                                    <label for="Correo">Correo</label>
                                </div>
                            </div>
                            <div class="row">
                                <!--Estableciendo el tamaño del que tomará el Input field-->
                                <div class="input-field col s12 m6 l6">
                                    <input id="direcc" type="text" class="validate">
                                    <label for="direcc">Dirección</label>
                                </div>
                            </div>
                            <div class="row">
                                <!--Estableciendo el tamaño del que tomará el Input field-->
                                <div class="input-field col s12 m6 l6">
                                    <input id="telefono" type="text" class="validate">
                                    <label for="telefono">Teléfono</label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <a id="btn_confirmar" class="btn-floating btn-medium waves-effect waves-light red modal-close"
                        title="Guardar Cambios" onclick="ActualizarRegistro()"><i class="material-icons">check</i></a>
                    <a id="cancelar" class="btn-floating modal-close btn-medium waves-effect waves-light red"
                        title="Cancelar"><i class="material-icons">clear</i>
                    </a>
                </div>
            </div>
            <div id="modal_update" class="modal">
                <div class="modal-content">
                    <h5 class="center-align">Actualización de proveedor</h5>
                    <br>
                    <!--Estableciendo el tamaño de cada div correspondiente-->
                    <div class="row">
                        <!--Creamos la estructura del formulario respectivo-->
                        <form class="col-md-4">
                            <div class="row">
                                <!--Estableciendo el tamaño del que tomará el Input field-->
                                <div class="input-field col s12 m6 l6">
                                    <select>
                                        <optgroup label="Empleados">
                                            <option value="1">Oscar Villanueva</option>
                                            <option value="2">Carlos Adonay</option>
                                        </optgroup>
                                    </select>
                                    <label>Empleado</label>
                                </div>
                                <!--Estableciendo el tamaño del que tomará el Input field-->
                                <div class="input-field col s12 m6 l6">
                                    <select>
                                        <optgroup label="Tipo de Usuario">
                                            <option value="1">Administrador</option>
                                            <option value="2">Root</option>
                                            <option value="3">Gerente</option>
                                        </optgroup>
                                    </select>
                                    <label>Tipo de usuarios</label>
                                </div>
                            </div>
                            <div class="row">
                                <!--Estableciendo el tamaño del que tomará el Input field-->
                                <div class="input-field col s12 m6 l6">
                                    <input id="nombre" type="text" class="validate">
                                    <label for="nombre">Nombre</label>
                                </div>
                            </div>
                            <div class="row">
                                <!--Estableciendo el tamaño del que tomará el Input field-->
                                <div class="input-field col s12 m6 l6">
                                    <input id="Correo" type="text" class="validate">
                                    <label for="Correo">Correo</label>
                                </div>
                            </div>
                            <div class="row">
                                <!--Estableciendo el tamaño del que tomará el Input field-->
                                <div class="input-field col s12 m6 l6">
                                    <input id="direcc" type="text" class="validate">
                                    <label for="direcc">Dirección</label>
                                </div>
                            </div>
                            <div class="row">
                                <!--Estableciendo el tamaño del que tomará el Input field-->
                                <div class="input-field col s12 m6 l6">
                                    <input id="telefono" type="text" class="validate">
                                    <label for="telefono">Teléfono</label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <a id="btn_confirmar" class="btn-floating btn-medium waves-effect waves-light red modal-close"
                        title="Guardar Cambios" onclick="ActualizarRegistro()"><i class="material-icons">check</i></a>
                    <a id="cancelar" class="btn-floating modal-close btn-medium waves-effect waves-light red"
                        title="Cancelar"><i class="material-icons">clear</i>
                    </a>
                </div>
            </div>
            <!--Se construye la tabla de datos correspondiente a entradas-->
            <table class="responsive-table striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>Acción</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <th>Facela</th>
                        <th>facela@gmail.com</th>
                        <th>Calle al volcan Local 12, 13, 14</th>
                        <th>7787-2265</th>
                        <th>
                            <a class="btn-floating btn waves-effect waves yellow darken-3 modal-trigger" href="#modal_update"><i class="material-icons" title="Editar registro">create</i></a>
                            <a class="btn-floating btn waves-effect waves yellow darken-3" href="#" onclick="EliminarRegistro()"><i class="material-icons" title="Eliminar registro">delete</i></a>
                        </th>
                    </tr>
                    <tr>
                        <th>Augusto Valladares</th>
                        <th>augusto515@gmail.com</th>
                        <th>Colonia miralvalle</th>
                        <th>7787-8531</th>
                        <th>
                            <a class="btn-floating btn waves-effect waves yellow darken-3 modal-trigger" href="#modal_update"><i class="material-icons" title="Editar registro">create</i></a>
                            <a class="btn-floating btn waves-effect waves yellow darken-3" href="#" onclick="EliminarRegistro()"><i class="material-icons" title="Eliminar registro">delete</i></a>
                        </th>
                    </tr>
                    <tr>
                        <th>Denis Romero</th>
                        <th>denisrrmro@hotmail.com</th>
                        <th>Calle a mariona centro penal al esperanza</th>
                        <th>7559-2237</th>
                        <th>
                            <a class="btn-floating btn waves-effect waves yellow darken-3 modal-trigger" href="#modal_update"><i class="material-icons" title="Editar registro">create</i></a>
                            <a class="btn-floating btn waves-effect waves yellow darken-3" href="#" onclick="EliminarRegistro()"><i class="material-icons" title="Eliminar registro">delete</i></a>
                        </th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
  //Se imprime la plantilla del pie y se envía el nombre del controlador para la página web
  Dashboard_Page::footerTemplate('usuarios.js');
?>