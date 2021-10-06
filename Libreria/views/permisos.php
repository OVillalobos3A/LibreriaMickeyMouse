<?php
include("../app/helpers/dashboard.php");
Dashboard_Page::headerTemplate('Permisos');
?>
<br>
<br>
<div class="container Texto">
    <div class="card white rad" id="ocultable1">
        <div class="card-content black-text">
            <!--Colocamos el titulo de la card-->
            <span class="card-title center-align"><b> Permisos de los Usuarios </b></span>
            <br>
            <!--Agregamos un botón cuya función es que nos mueste el formulario para agregar-->
            <!--un registro-->
            <div class="col s12">
                <div class="col s6">
                    <a onclick="openCreateDialog()" class="waves-effect amber accent-4 btn modal-trigger" href="#">
                        <i class="material-icons left">add</i>Agregar Acceso
                    </a>
                </div>
            <br>
            </div>
            <div class="col s12 m12 l12">
                <!--Se añade un input field el cual su función es buscar una entrada en especifico-->
                <div class="row">
                    <form method="post" id="search-form">
                        <div class="input-field col s7 m9 l9">
                            <i class="material-icons prefix">search</i>
                            <input type="text" id="search" name="search" class="autocomplete" maxlength="20" required>
                            <label for="search">Ingresa el Nombre del Acceso que buscas</label>
                        </div>
                        <div class="input-field col s4 m2 l2">
                            <button class="btn red accent-4" type="submit" name="action">Buscar
                                <i class="material-icons right">search</i>
                            </button>
                        </div>
                    </form>
                    <div class="input-field col s1 m1 l1">
                        <!--Se añade un boton para genera reporte-->
                        <a href="../app/reports/accesos.php" target="_blank" class="btn waves-effect red accent-4 tooltipped" data-tooltip="Reporte de proveedores"><i class="material-icons">assignment</i></a>
                    </div>
                </div>
            </div>
            <!--Se construye la tabla de datos correspondiente a entradas-->
            <table id="myTable" class="responsive-table striped">            
                <thead>
                    <tr>
                        <th>Tipo de usuario</th>
                        <th>Página</th>
                        <th>Permisos</th>
                        <th>Accion</th>
                    </tr>
                </thead>

                <tbody id="tbody-rows">
                </tbody>
            </table>
            
        </div>
    </div>
</div>

<!-- Modal Structure -->
<div id="save-modal" class="modal Texto rad">
    <div class="modal-content">
        <h5 id="modal-title" class="center-align">Agregar Acceso</h5>
        <br>
        <div class="row">
            <!--Creamos la estructura del formulario respectivo-->
            <form method="post" id="save-form" name="save-form" enctype="multipart/form-data">
                <div class="row">
                    <!-- Campo oculto para asignar el id del registro al momento de modificar -->
                    <input class="hide" type="text" id="id_acceso" name="id_acceso" />
                    <div class="row">
                        <!--Estableciendo el tamaño del que tomará el Input field-->
                        <div class="input-field col s12 m12 l12">
                            <i class="material-icons prefix"></i>
                            <select id="tipo" name="tipo">
                            </select>
                            <label>Tipo del Usuario:</label>
                        </div>
                        <!--Estableciendo el tamaño del que tomará el Input field-->
                        <div class="input-field col s12 m12 l12">
                            <i class="material-icons prefix"></i>
                            <select id="pagina" name="pagina">
                            </select>
                            <label>Página a la que tendrá acceso: </label>
                        </div>
                        <div class="input-field col s12 m12 l12">
                            <i class="material-icons prefix"></i>
                            <select id="permiso" name="permiso">
                            </select>
                            <label>Permisos que tendrá dentro de la página:</label>
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
Dashboard_Page::footerTemplate('permisos.js');
?>
