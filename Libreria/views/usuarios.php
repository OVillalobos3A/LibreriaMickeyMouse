<?php
include("../app/helpers/dashboard.php");
Dashboard_Page::headerTemplate('Usuarios');
?>
<br>
<br>
<div class="container">
    <div class="card whithe">
        <div class="card-content Black-text">
            <!--Colocamos el titulo de la card-->
            <span class="card-title center-align"><b> Visualizar Usuarios </b></span>
            <br>
            <!--Agregamos un botón cuya función es que nos mueste el formulario para agregar-->
            <!--un registro-->
            <div class="col s6">
                <a onclick="openCreateDialog()" class="waves-effect yellow darken-3 btn modal-trigger" href="#">
                    <i class="material-icons left">add</i>Agregar usuario
                </a>
            </div>
            <br>
            <!--Se añade un input field el cual su función es buscar una entrada en especifico-->
            <div class="row">
                <form method="post" id="search-form">
                    <div class="input-field col s12 m6">
                        <i class="material-icons prefix">search</i>
                        <input type="text" id="search" name="search" class="autocomplete" maxlength="20" required>
                        <label for="autocomplete-input">Nombre de usuario</label>
                    </div>
                    <div class="input-field s12 m6">
                        <button class="btn red" type="submit" name="action">Buscar
                            <i class="material-icons right">search</i>
                        </button>
                    </div>
                </form>
            </div>
            <!-- Modal Structure -->
            <!--Se construye la tabla de datos correspondiente a entradas-->
            <table class="responsive-table striped">
                <thead>
                    <tr>
                        <th>Empleado</th>
                        <th>Usuario</th>
                        <th>Tipo empleado</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>

                <tbody id="tbody-rows">
                </tbody>
            </table>
        </div>
    </div>
</div>
<div id="save-modal" class="modal">
    <div class="modal-content">
        <h5 id="modal-title" class="center-align">Agregar usuario</h5>
        <br>
        <!--Estableciendo el tamaño de cada div correspondiente-->
        <div class="row">
            <!--Creamos la estructura del formulario respectivo-->
            <form method="post" id="save-form" name="save-form" enctype="multipart/form-data">
                <input class="hide" type="number" id="id_usuario" name="id_usuario" />
                <input class="hide" type="text" id="contraseña" name="contraseña" value="123456" />
                <div class="row">
                    <!--Estableciendo el tamaño del que tomará el Input field-->
                    <div class="input-field col s12 m6 l6">
                        <i class="material-icons prefix">group</i>
                        <select id="empleado" name="empleado" required>
                            <option value="0" disabled selected>Empleado</option>
                        </select>
                        <label for="tipo_usuario">Empleado</label>
                    </div>
                    <!--Estableciendo el tamaño del que tomará el Input field-->
                    <div class="input-field col s12 m6 l6">
                        <i class="material-icons prefix">recent_actors</i>
                        <select id="tipo_usuario" name="tipo_usuario" required>
                            <option value="0" disabled selected>Tipo de usuario</option>
                        </select>
                        <label for="tipo_usuario">Tipo de usuario</label>
                    </div>
                </div>
                <div class="row">
                    <!--Estableciendo el tamaño del que tomará el Input field-->
                    <div class="input-field col s12 m6">
                        <i class="material-icons prefix">perm_identity</i>
                        <input id="usuario" type="text" name="usuario" class="validate" required>                        
                        <label for="usuario">Usuario</label>
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

        </div>
        <div class="row center-align">
            <a href="#" class="btn waves-effect red tooltipped modal-close" data-tooltip="Cancelar"><i class="material-icons">cancel</i></a>
            <button type="submit" class="btn waves-effect red tooltipped" data-tooltip="Guardar"><i class="material-icons">save</i></button>
        </div>
        </form>
    </div>
</div>

<?php
//Se imprime la plantilla del pie y se envía el nombre del controlador para la página web
Dashboard_Page::footerTemplate('usuarios.js');
?>