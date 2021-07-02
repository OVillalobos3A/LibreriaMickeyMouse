<?php
include("../app/helpers/dashboard.php");
Dashboard_Page::headerTemplate('Empleados');
?>
<br>
<br>
<div class="container">
    <div class="card white" id="ocultable1">
        <div class="card-content Black-text">
            <!--Colocamos el titulo de la card-->
            <span class="card-title center-align"><b> Visualizar Empleados </b></span>
            <br>
            <!--Agregamos un botón cuya función es que nos mueste el formulario para agregar-->
            <!--un registro-->
            <div class="col s6">
                <a onclick="openCreateDialog()" class="waves-effect yellow darken-3 btn modal-trigger" href="#">
                    <i class="material-icons left">add</i>Agregar empleado
                </a>
            </div>
            <br>
            <!--Se añade un input field el cual su función es buscar una entrada en especifico-->
            <div class="row">
                <form method="post" id="search-form">
                    <div class="input-field col s12 m6">
                        <i class="material-icons prefix">search</i>
                        <input type="text" id="search" name="search" class="autocomplete" maxlength="20" required>
                        <label for="autocomplete-input">Primer nombre del empleado</label>
                    </div>
                    <div class="input-field s12 m6">
                        <button class="btn red" type="submit" name="action">Buscar
                            <i class="material-icons right">search</i>
                        </button>
                    </div>
                </form>
            </div>
            <!--Se construye la tabla de datos correspondiente a entradas-->
            <table class="responsive-table striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                        <th>Género</th>
                        <th>Dui</th>
                        <th>Estado</th>
                        <th>Imagen</th>
                        <th>Acción</th>
                    </tr>
                </thead>

                <tbody id="tbody-rows">
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Modal Structure -->
<div id="save-modal" class="modal">
    <div class="modal-content">
        <h5 id="modal-title" class="center-align">Agregar empleado</h5>
        <br>
        <div class="row">
        <!--Creamos la estructura del formulario respectivo-->
        <form method="post" id="save-form" name="save-form" enctype="multipart/form-data">
            <div class="row">
                <!-- Campo oculto para asignar el id del registro al momento de modificar -->
                <input class="hide" type="text" id="id_empleado" name="id_empleado" />
                <div class="row">
                    <!--Estableciendo el tamaño del que tomará el Input field-->
                        <div class="input-field col s12 m6">
                    <i class="material-icons prefix">person</i>
                        <input id="nombres" name="nombres" type="text" required class="validate">
                        <label for="nombres">Nombres</label>
                    </div>
                    <!--Estableciendo el tamaño del que tomará el Input field-->
                    <div class="input-field col s12 m6">                        
                        <input id="apellidos" name="apellidos" required type="text" class="validate">
                        <label for="apellidos">Apellidos</label>
                    </div>
                </div>
                <div class="row">
                    <!--Estableciendo el tamaño del que tomará el Input field-->
                    <div class="input-field col s12 m6">
                        <i class="material-icons prefix">email</i>
                        <input id="correo" name="correo" required type="text" class="validate">
                        <label for="correo">Correo</label>
                    </div>
                    <!--Estableciendo el tamaño del que tomará el Input field-->
                    <div class="input-field col s12 m6">
                        <i class="material-icons prefix">phone</i>
                        <input id="telefono" name="telefono" required type="text" class="validate">
                        <label for="telefono">Teléfono</label>
                    </div>
                </div>
                <div class="row">
                    <!--Textbox Autor-->
                    <div class="input-field col s12 m6 l6">
                        <i class="material-icons prefix">call_to_action</i>
                        <input id="dui" name="dui" type="text" required class="validate">
                        <label for="dui">Dui</label>
                    </div>
                    <!--Combobox Marca-->
                    <div class="input-field col s12 m6 l6">
                        <i class="material-icons prefix">portrait</i>
                        <select id="genero" name="genero" required>
                            <option value="0" disabled selected>Género</option>
                            <option value="M">Masculino</option>
                            <option value="F">Femenino</option>
                        </select>
                        <label>Género</label>
                    </div>
                </div>
                <div class="row">
                    <!--Estableciendo el tamaño del que tomará el Input field-->
                    <div class="input-field col s12 m6">
                        <i class="material-icons prefix">date_range</i>
                        <input type="date" id="fecha" name="fecha" class="validate" required />
                        <label for="fecha">Nacimiento</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <i class="material-icons prefix">playlist_add_check</i>
                        <select id="estado" name="estado" required>
                            <option value="0" disabled selected>Estado</option>
                            <option value="Activo">Activo</option>
                            <option value="Inactivo">Inactivo</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <!--Estableciendo el tamaño del que tomará el Input field-->
                    <div class="input-field col s12">
                        <div class="file-field input-field">
                            <div class="btn black">
                                <span><i class="large material-icons">add_a_photo</i></span>
                                <input id="imagen" type="file" name="imagen" accept=".gif, .jpg, .png">
                            </div>
                            <div class="file-path-wrapper">
                                <input type="text" class="file-path validate" placeholder="Formatos aceptados: gif, jpg y png">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row center-align">
                <a href="#" class="btn waves-effect red tooltipped modal-close" data-tooltip="Cancelar"><i class="material-icons">cancel</i></a>
                <button type="submit" class="btn waves-effect red tooltipped" data-tooltip="Guardar"><i class="material-icons">save</i></button>
            </div>

        </form>
        </div>
    </div>
</div>
<br>
<?php
//Se imprime la plantilla del pie y se envía el nombre del controlador para la página web
Dashboard_Page::footerTemplate('empleados.js');
?>