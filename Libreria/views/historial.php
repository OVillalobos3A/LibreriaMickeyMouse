<?php
include("../app/helpers/dashboard.php");
Dashboard_Page::headerTemplate('Gestión de entradas');
?>
<br>
<br>
<div class="container" id="tbentradas">
    <div class="card whithe">
        <div class="card-content Black-text">
            <!--Colocamos el titulo de la card-->
            <span class="card-title center-align"><b> <h4>Historial de compras</h4></b></span>
            <br>
            <!--Agregamos un botón cuya función es que nos mueste el formulario para agregar-->
            <!--un registro-->

            <!--Se añade un input field el cual su función es buscar una entrada en especifico-->
            <div class="input-field col s6">
                <i class="material-icons prefix">search</i>
                <input type="text" id="autocomplete-input" class="autocomplete">
                <label for="autocomplete-input">Buscar registo</label>
            </div>

            <!-- Modal Structure -->
            <div id="modal_entradas" class="modal">
                <div class="modal-content">
                <div class="row">
                <div class="col s12 m12">
                    <h4 class="center-align yellow-text text-darken-3"><b>Detalle de compra</b></h4>
                    </div>
                </div>
                <div class="row">                    
                    <div class="col s12 m3">
                    <h6><b>Fecha: </b>10/04/2021</h6>
                    </div>
                    <div class="col s12 m5">
                    <h6><b>Cliente:</b> Felipe Hernandez</h6>
                    </div>
                    <div class="col s12 m4">
                    <h6><b>ID de detalle:</b> 2142</h6>
                    </div>
                </div>
                    
                    <hr>
                    <table class="striped responsive-table">
                            <thead>
                            <!--Se crean las filas con los elementos que va a llevar la tabla-->
                                <tr>
                                    <th>Producto</th>
                                    <th>Nombre</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Importe</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                            <!--Creacion de las columnas para las filas ya previamente creadas-->
                                <tr>
                                    <td><img src="../resources/img/productos/cuaderno.jpg" width="80" height="80"></td>
                                    <td>Cuaderno Norma color</td>
                                    <td>$7.00</td>
                                    <td>5</td>
                                    <td>$35.00</td>                                    
                                </tr>
                                <tr>
                                    <td><img src="../resources/img/productos/lapicero.jpg" width="80" height="80"></td>
                                    <td>Lapicero Bic Azul</td>
                                    <td>$0.50</td>
                                    <td>10</td>
                                    <td>$5.00 </td>                                    
                                </tr>
                                <tr>
                                    <td><img src="../resources/img/productos/plumones.jpg" width="80" height="80"></td>
                                    <td>Caja de plumones</td>
                                    <td>$8.50</td>
                                    <td>1</td>
                                    <td>$8.50</td>                                    
                                </tr>
                            </tbody>
                        </table>
                    <!--Asignamos los botones correspondientes para cada acción Scrud-->
                    <!--Especificamos con un "title" lo que realiza cada botón-->
                </div>
            </div>
            <!--Se construye la tabla de datos correspondiente a entradas-->
            <table class="responsive-table striped">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Impuestos</th>
                        <th>Total</th>
                        <th>Fecha</th>
                        <th>Empleado</th>
                        <th>Detalle</th>
                    </tr>
                </thead>

                <tbody>                
                    <tr>
                        <th>Felipe Florez</th>
                        <th>$5.00</th>
                        <th>$30.00</th>
                        <th>15/08/2021</th>
                        <th>Enrique Hernandez</th>
                        <th><a class="btn-floating btn waves-effect waves yellow darken-3 modal-trigger" href="#modal_entradas"><i class="material-icons" title="Ver detalle">visibility</i></a>
                        </th>
                    </tr>

                    <tr>
                        <th>Felipe Florez</th>
                        <th>$5.00</th>
                        <th>$30.00</th>
                        <th>15/08/2021</th>
                        <th>Enrique Hernandez</th>
                        <th><a class="btn-floating btn waves-effect waves yellow darken-3 modal-trigger" href="#modal_entradas"><i class="material-icons" title="Ver detalle">visibility</i></a>
                        </th>
                    </tr>

                    <tr>
                        <th>Felipe Florez</th>
                        <th>$5.00</th>
                        <th>$30.00</th>
                        <th>15/08/2021</th>
                        <th>Enrique Hernandez</th>
                        <th><a class="btn-floating btn waves-effect waves yellow darken-3 modal-trigger" href="#modal_entradas"><i class="material-icons" title="Ver detalle">visibility</i></a>
                        </th>
                    </tr>

                    <tr>
                        <th>Felipe Florez</th>
                        <th>$5.00</th>
                        <th>$30.00</th>
                        <th>15/08/2021</th>
                        <th>Enrique Hernandez</th>
                        <th><a class="btn-floating btn waves-effect waves yellow darken-3 modal-trigger" href="#modal_entradas"><i class="material-icons" title="Ver detalle">visibility</i></a>
                        </th>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>
<br>

<?php
//Se imprime la plantilla del pie y se envía el nombre del controlador para la página web
Dashboard_Page::footerTemplate();
?>