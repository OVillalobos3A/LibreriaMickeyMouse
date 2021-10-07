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
                        <label for="search">Ingresa el Número de factura que quieres buscar</label>
                    </div>
                    <div class="input-field s12 m4 l4">
                        <button class="btn red accent-4" type="submit" name="action">Buscar
                            <i class="material-icons right">search</i>
                        </button>
                        <a onclick="openReportDialog()" class="waves-effect red accent-4 btn" href="#">
                            <i class="material-icons center tooltipped" data-tooltip="Reporte de ventas por fechas">assignment</i>
                        </a>
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

    <div id="save-modal2" class="modal Texto rad">
    <div class="modal-content">
        <a href="#" class="btn waves-effect red tooltipped modal-close" data-tooltip="Cancelar"><i class="material-icons">cancel</i></a>
        <h5 id="modal-title" class="center-align">Generar gráfico</h5>
        <br>
        <div class="row" id="option1">
            <!--Creamos la estructura del formulario respectivo-->
            <form method="post" id="save-form2" name="save-form2" enctype="multipart/form-data">
                <div class="row">
                    <!--Estableciendo el tamaño del que tomará el Input field-->
                    <div class="input-field col s12 m6">
                        <i class="material-icons prefix">date_range</i>
                        <input type="date" id="fecha1" name="fecha1" class="validate" required />
                        <label for="fecha1">Desde</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <i class="material-icons prefix">date_range</i>
                        <input type="date" id="fecha2" name="fecha2" class="validate" required />
                        <label for="fecha2">Hasta</label>
                    </div>
                </div> 
                <div class="row center-align">
                    <button type="submit" class="btn waves-effect red tooltipped" data-tooltip="Número de entradas realizadas"><i class="material-icons">assignment_turned_in</i></button>
                    
                </div>   
            </form> 
        </div>
</div>
<br>

<?php
//Se imprime la plantilla del pie y se envía el nombre del controlador para la página web
Dashboard_Page::footerTemplate('historial.js');
