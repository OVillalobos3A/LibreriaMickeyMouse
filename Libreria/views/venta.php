<?php
include("../app/helpers/dashboard.php");
Dashboard_Page::headerTemplate('Venta');
?>
<br>
<br>
<div class="container">
    <div class="card whithe">
        <div class="card-content Black-text">
            <!--Colocamos el titulo de la card-->
            <span class="card-title center-align"><b>Gestión de venta</b></span>
            <br>
            <!--Agregamos un botón cuya función es que nos mueste el formulario para agregar-->
            <!--un registro-->
            <div class="col s6">
                <a class="waves-effect yellow darken-3 btn modal-trigger" href="#modal_registro">
                    <i class="material-icons left">add</i>Agregar productos
                </a>
            </div>
            <br>
            <!-- Modal Structure -->
            <div id="modal_registro" class="modal">
                <div class="modal-content">
                    <h5 class="center-align">Buscar producto</h5>
                    <br>
                    <!--Estableciendo el tamaño de cada div correspondiente-->
                    <div class="row">
                        <!--Creamos la estructura del formulario respectivo-->
                        <form class="col-md-4">
                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">search</i>
                                    <input type="text" id="autocomplete-input" class="autocomplete">
                                    <label for="autocomplete-input">Nombre del producto</label>
                                </div>
                            </div>
                        </form>
                    </div>
                    <table>
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Imagen</th>
                            <th>Cantidad</th>
                            <th>Accion</th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr>
                            <td>Caja de colores facela</td>
                            <td>$3.50</td>
                            <th><img class="responsive-img" src="../resources/img/tabla/ccaja.jpg"></th>
                            <th>
                                <div class="input-field col s12">
                                    <input type="number" min="0" max="100" stpe="1" VALUE="0" SIZE="6" class="center-align">
                                </div>
                            </th>
                            <th>
                                <a class="btn-floating btn waves-effect waves yellow darken-3 modal-close" href="#"><i class="material-icons" title="Añadir producto">add</i></a>
                            </th>
                        </tr>
                        <tr>
                            <td>Caja de colores facela</td>
                            <td>$3.50</td>
                            <th><img class="responsive-img" src="../resources/img/tabla/ccaja.jpg"></th>
                            <th>
                                <div class="input-field col s12">
                                    <input type="number" min="0" max="100" stpe="1" VALUE="0" SIZE="6" class="center-align">
                                </div>
                            </th>
                            <th>
                                <a class="btn-floating btn waves-effect waves yellow darken-3 modal-close" href="#"><i class="material-icons" title="Añadir producto">add</i></a>
                            </th>
                        </tr>
                        <tr>
                            <td>Caja de colores facela</td>
                            <td>$3.50</td>
                            <th><img class="responsive-img" src="../resources/img/tabla/ccaja.jpg"></th>
                            <th>
                                <div class="input-field col s12">
                                    <input type="number" min="0" max="100" stpe="1" VALUE="0" SIZE="6" class="center-align">
                                </div>
                            </th>
                            <th>
                                <a class="btn-floating btn waves-effect waves yellow darken-3 modal-close" href="#"><i class="material-icons" title="Añadir producto">add</i></a>
                            </th>
                        </tr>
                        </tbody>
                    </table>
                    <!--Asignamos los botones correspondientes para cada acción Scrud-->
                    <!--Especificamos con un "title" lo que realiza cada botón-->
                </div>
                <div class="modal-footer">
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                  <div class="card white">
                    <div class="card-content black-text">
                      <span class="card-title">Listado de productos</span>
                      <br>
                      <table class="responsive-table striped">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Subotal</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
        
                        <tbody>
                            <tr>
                                <td>Caja de colores facela</td>
                                <td>$3.50</td>
                                <td>5</td>
                                <td>$17.50</td>
                                <th>
                                    <a class="btn-floating btn waves-effect waves yellow darken-3" href="#"><i class="material-icons" title="Remover producto">remove</i></a>
                                </th>
                            </tr>
                            <tr>
                                <td>Libro el principito</td>
                                <td>$5.99</td>
                                <td>1</td>
                                <td>$5.99</td>
                                <th>
                                    <a class="btn-floating btn waves-effect waves yellow darken-3" href="#"><i class="material-icons" title="Remover producto">remove</i></a>
                                </th>
                            </tr>
                            
                        </tbody>
                    </table>
                    </div>
                  </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12 center-align">
                    <a class="waves-effect red btn-large"><i class="material-icons right">calculate</i>Calcular total</a>
                </div>
            </div>
            <div class="row" id="ocultable1">
                <div class="col s12 m6">
                  <div class="card yellow darken-3">
                    <div class="card-content white-text">
                      <h6>Subtotal: $17.50 </h6>
                      <h6>Impuestos(iva): $2.01</h5>
                      <h6>Total: $19.51</h6>
                      <br>
                    </div>
                  </div>
                </div>
            </div>
            <!--Se construye la tabla de datos correspondiente a entradas-->
        </div>
    </div>
</div>
<?php
//Se imprime la plantilla del pie y se envía el nombre del controlador para la página web
 Dashboard_Page::footerTemplate('venta.js');
?>