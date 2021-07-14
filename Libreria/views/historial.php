<?php
include("../app/helpers/dashboard.php");
Dashboard_Page::headerTemplate('Ventas realizadas');
?>
<br>
<br>
<div class="container Text" id="tbentradas">
    <div class="card white rad">
        <div class="card-content Black-text">
            <!--Colocamos el titulo de la card-->
            <span class="card-title center-align"><b> <h4>Historial de ventas</h4></b></span>
            <br>
            <form method="post" id="search-form">
                <div class="row">
                    <div class="input-field col s12 m8 m8">
                        <i class="material-icons prefix">search</i>
                        <input id="search" type="text" name="search"  maxlength="40" required/>
                        <label for="autocomplete-input">Ingresa el Número de factura que quieres buscar</label>
                    </div>
                    <div class="input-field s12 m4 l4">
                        <button class="btn red accent-4" type="submit" name="action">Buscar
                            <i class="material-icons right">search</i>
                        </button>
                    </div>
                </div>
            </form>
            <!-- Modal Structure -->
            <div id="save-modal1" class="modal">
                <div class="modal-content">
                <a href="#" class="btn waves-effect red tooltipped modal-close right-align" data-tooltip="Cerrar"><i class="material-icons">cancel</i></a>
                <form method="post" id="save-form1" enctype="multipart/form-data">
                    <input class="hide" type="number" id="id_pedido" name="id_pedido"/>
                    <div class="row">
                        <div class="col s12 m12">
                            <h4 class="center-align amber-text text-accent-4"><b>Detalle de la venta</b></h4>
                            </div>
                        </div>
                        <div class="row">                    
                            <div class="col s12 m6">
                            <h6><b>Fecha realizada: </b><b id="fecha"></b></h6>
                            </div>
                            <div class="col s12 m6">
                            <h6><b>ID de la factura: </b><b id="fact"></b></h6>
                            </div>
                        </div>
                        <hr>
                        <table class="striped responsive-table">
                                <thead>
                                <!--Se crean las filas con los elementos que va a llevar la tabla-->
                                    <tr>
                                        <th>Producto</th>
                                        <th>Imagen</th>
                                        <th>Cantidad</th>  
                                        <th>Precio</th>
                                        <th>Subtotal</th>                                  
                                    </tr>
                                </thead>
                                <tbody id="tbody-rows1">
                                </tbody>
                            </table>
                        <!--Asignamos los botones correspondientes para cada acción Scrud-->
                        <!--Especificamos con un "title" lo que realiza cada botón-->
                    </div>
                </form>
            </div>
            <!--Se construye la tabla de datos correspondiente a entradas-->
            <form method="post" id="save-form" enctype="multipart/form-data">
                <!-- Campo oculto para asignar el id del registro al momento de modificar -->
                <div class="row">
                    <table class="responsive-table striped" id="myTable">
                        <thead>
                            <tr>
                                <th>Código de la factura</th>
                                <th>Estado</th>
                                <th>Total</th>
                                <th>Fecha</th>
                                <th>Empleado encargado</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-rows">
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
</div>
<br>

<?php
//Se imprime la plantilla del pie y se envía el nombre del controlador para la página web
Dashboard_Page::footerTemplate('historial.js');
