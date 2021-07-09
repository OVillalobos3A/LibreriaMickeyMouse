<?php
include("../app/helpers/dashboard.php");
Dashboard_Page::headerTemplate('Proveedor');
?>
<br>
<br>
<div class="container Texto">
    <div class="card white rad" id="ocultable1">
        <div class="card-content Black-text">
            <!--Colocamos el titulo de la card-->
            <span class="card-title center-align"><b> Visualizar Proveedores </b></span>
            <br>
            <!--Agregamos un botón cuya función es que nos mueste el formulario para agregar-->
            <!--un registro-->
            <div class="col s6">
                <a onclick="openCreateDialog()" class="waves-effect amber accent-4 btn modal-trigger" href="#">
                    <i class="material-icons left">add</i>Agregar proveedor
                </a>
            </div>
            <br>
            <!--Se añade un input field el cual su función es buscar una entrada en especifico-->
            <div class="row">
                <form method="post" id="search-form">
                    <div class="input-field col s12 m8 l8">
                        <i class="material-icons prefix">search</i>
                        <input type="text" id="search" name="search" class="autocomplete" maxlength="20" required>
                        <label for="autocomplete-input">Ingresa el Nombre del Proveedor que deseas buscar</label>
                    </div>
                    <div class="input-field s12 m4 m4">
                        <button class="btn red accent-4" type="submit" name="action">Buscar
                            <i class="material-icons right">search</i>
                        </button>
                    </div>
                </form>
            </div>
            <!--Se construye la tabla de datos correspondiente a entradas-->
            <table id="myTable" class="responsive-table striped">            
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
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
        <h5 id="modal-title" class="center-align">Agregar proveedor</h5>
        <br>
        <div class="row">
            <!--Creamos la estructura del formulario respectivo-->
            <form method="post" id="save-form" name="save-form" enctype="multipart/form-data">
                <div class="row">
                    <!-- Campo oculto para asignar el id del registro al momento de modificar -->
                    <input class="hide" type="text" id="id_proveedor" name="id_proveedor" />
                    <div class="row">
                        <!--Estableciendo el tamaño del que tomará el Input field-->
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">person</i>
                            <input id="nombres" name="nombres" type="text" required class="validate">
                            <label for="nombres">Nombres</label>
                        </div>
                        <!--Estableciendo el tamaño del que tomará el Input field-->
                        <div class="input-field col s12 m6">
                            <input id="direccion" name="direccion" required type="text" class="validate">
                            <label for="direccion">Direccion</label>
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
Dashboard_Page::footerTemplate('proveedor.js');
?>
