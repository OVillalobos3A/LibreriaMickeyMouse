<?php
include("../app/helpers/dashboard.php");
Dashboard_Page::headerTemplate('Venta');
?>
<br>
<br>
<div class="container">
    <div class="card white rad">
        <div class="card-content Black-text">
            <!--Colocamos el titulo de la card-->
            <span class="card-title center-align"><b>Gestión de venta</b></span>
            <br>
            <!--Agregamos un botón cuya función es que nos mueste el formulario para agregar-->
            <!--un registro-->
            <div class="col s6 pad-nav"> 
                <a href="#" class="waves-effect amber accent-4 btn" onclick="openCreateDialog()"><i class="material-icons left">add</i>Agregar productos</a>                     
                <p class="right" id="id_fact">N° de Factura: 0</p><br>
                <p class="right" id="fecha">Fecha: fecha[i]</p><br> 
            </div>
            <br>
            <!-- Modal Structure -->
            <form method="post" id="save-form" name="save-form" enctype="multipart/form-data" class="col-md-4">
                <div id="modal_registro" class="modal Texto rad">
                    <div class="modal-content">
                        <a href="#" class="btn waves-effect red accent-4 tooltipped modal-close right-align" data-tooltip="Cerrar"><i class="material-icons">cancel</i></a>  
                        <h5 class="center-align">Buscar producto</h5>
                        <br>
                        <!--Estableciendo el tamaño de cada div correspondiente-->
                        <div class="row">
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">search</i>
                                <input id="search" type="text" name="search"  maxlength="40" required/>
                                <label for="autocomplete-input">Nombre del producto</label>
                            </div>
                            <div class="input-field s12 m6">
                                <button class="btn red accent-4" type="submit" name="action">Buscar
                                    <i class="material-icons right">search</i>
                                </button>
                            </div>
                        </div>
                        <table class="responsive-table centered" id="myTable2">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Imagen</th>
                                    <th>Precio</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody id="tbody-rows">
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col s12">
                  <div class="card white rad">
                    <div class="card-content black-text">
                        <span class="card-title">Listado de productos</span>
                        <br>
                        <div class="row">
                            <table class="responsive-table striped">
                                <thead>
                                <!--Se crean las filas con los elementos que va a llevar la tabla-->
                                    <tr>
                                        <th>Producto</th>
                                        <th>Imagen</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                        <th>Subtotal</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="tabla-compra">
                                </tbody>
                            </table>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="row" id="ocultable1">
                <div class="col s12 m12 l12">
                  <div class="card white rad">
                    <div class="card-content black-text">
                        <h6><b>Subtotal: </b><b>$</b><b id="subtotal">0.00</b></h6>
                        <h6><b>Impuestos(iva): </b><b>$</b><b id="iva">0.00</b></h6>
                        <h6><b>Total: </b><b>$</b><b id="total">0.00</b></h6>
                        <br>
                    </div>
                  </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12 right-align">
                    <a onclick="finishFact()" class="waves-effect amber accent-4 btn-large"><i class="material-icons left">sd_storage</i>Guardar</a>
                </div>
            </div>
            <!--Se construye la tabla de datos correspondiente a entradas-->
        </div>
    </div>
</div>

<form method="post" id="item-form">
    <div id="item-modal" class="modal Texto rad">
        <div class="modal-content">
            <!-- Título para la caja de dialogo -->
            <h4 class="center-align">Elegir cantidad</h4>
            <!-- Formulario para cambiar la cantidad de producto -->
                <!-- Campo oculto para asignar el id del registro al momento de modificar -->
                <input type="number" id="id_detalle" name="id_detalle" class="hide"/>
                <input type="number" id="id_producto" name="id_producto" class="hide"/>
                <input type="number" id="stock" name="stock" class="hide"/>
                <input type="number" id="sbuscar" name="sbuscar" class="hide"/>
                <div class="row">
                    <div class="input-field col s12 m4 offset-m4">
                        <i class="material-icons prefix">list</i>
                        <input type="number" id="cantidad_producto" name="cantidad_producto" min="1" class="validate" required/>
                        <label for="cantidad_producto">Cantidad</label>
                    </div>
                </div>
                <div class="row center-align">
                    <a class="btn waves-effect red accent-4 tooltipped modal-close" data-tooltip="Cancelar"><i class="material-icons">cancel</i></a>
                    <button type="submit" class="btn waves-effect red accent-4 tooltipped" data-tooltip="Guardar"><i class="material-icons">save</i></button>
                </div>
        </div>
    </div>
</form>

<div id="item1-modal" class="modal Texto rad">
    <div class="modal-content">
        <!-- Título para la caja de dialogo -->
        <h4 class="center-align">Cambiar cantidad</h4>
        <!-- Formulario para cambiar la cantidad de producto -->
        <form method="post" id="item1-form">
            <!-- Campo oculto para asignar el id del registro al momento de modificar -->
            <input type="number" id="id_detalle1" name="id_detalle1" class="hide"/>
            <input type="number" id="id_producto1" name="id_producto1" class="hide"/>
            <input type="number" id="stock1" name="stock1" class="hide"/>
            <input type="number" id="sbuscar1" name="sbuscar1" class="hide"/>
            <div class="row">
                <div class="input-field col s12 m4 offset-m4">
                    <i class="material-icons prefix">list</i>
                    <input type="number" id="cantidad_producto1" name="cantidad_producto1" min="1" class="validate" required/>
                    <label for="cantidad_producto">Cantidad</label>
                </div>
            </div>
            <div class="row center-align">
                <a href="#" class="btn waves-effect red accent-4 tooltipped modal-close" data-tooltip="Cancelar"><i class="material-icons">cancel</i></a>
                <button type="submit" class="btn waves-effect red accent-4 tooltipped" data-tooltip="Guardar"><i class="material-icons">save</i></button>
                <h6><b id="mensaje"></b></h6>
            </div>
        </form>
    </div>
</div>


<?php
//Se imprime la plantilla del pie y se envía el nombre del controlador para la página web
 Dashboard_Page::footerTemplate('venta.js');
?>