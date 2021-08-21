<?php
include("../app/helpers/dashboard.php");
Dashboard_Page::headerTemplate('Gestión de entradas');
?>
<br>
<br>
<div class="container" id="tbentradas">
    <div class="card white rad">
        <div class="card-content Black-text">
            <!--Colocamos el titulo de la card-->
            <span class="card-title center-align"><b> Visualizar Entradas </b></span>
            <br>
            <!--Agregamos un botón cuya función es que nos mueste el formulario para agregar-->
            <!--un registro-->
            <div class="col s6">
                <a onclick="openCreateDialog()" class="waves-effect amber accent-4 btn modal-trigger" href="#">
                    <i class="material-icons left">add</i>Agregar entrada
                </a>
            </div>
            <br>
            <!--Se añade un input field el cual su función es buscar una entrada en especifico-->
            <div class="row">
                <form method="post" id="search-form">
                    <div class="input-field col s12 m8 l8">
                        <i class="material-icons prefix">search</i>
                        <input type="text" id="search" name="search" class="autocomplete" maxlength="20" required>
                        <label for="autocomplete-input">Fecha de la entrada</label>
                    </div>
                    <div class="input-field s12 m4 l4">
                        <button class="btn red accent-4" type="submit" name="action">Buscar
                            <i class="material-icons right">search</i>
                        </button>
                        <a onclick="openCreateDialog1()" class="waves-effect amber accent-4 btn" href="#">
                            <i class="material-icons center tooltipped" data-tooltip="Generar gráfico">trending_up</i>
                        </a>
                    </div>
                </form>
            </div>
            <!--Se construye la tabla de datos correspondiente a entradas-->
            <table class="responsive-table striped" id="myTable">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Fecha</th>
                        <th>Empleado</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody id="tbody-rows">
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="save-modal" class="modal Texto rad">
    <div class="modal-content">
        <h5 id="modal-title" class="center-align">Agregar entrada</h5>
        <br>
        <div class="row">
            <!--Creamos la estructura del formulario respectivo-->
            <form method="post" id="save-form" name="save-form" enctype="multipart/form-data">
                <input class="hide" type="number" id="id_entrada" name="id_entrada" />
                <input class="hide" type="date" id="fecha" name="fecha" />
                <div class="row">
                    <!--Estableciendo el tamaño del que tomará el Input field-->
                    <div class="input-field col s12 m6 l6">
                        <i class="material-icons prefix">recent_actors</i>
                        <select id="producto" name="producto" required>
                            <option value="0" disabled selected>Producto</option>
                        </select>
                        <label for="Producto">Producto</label>
                    </div>
                    <!--Estableciendo el tamaño del que tomará el Input field-->
                    <div class="input-field col s12 m6">
                        <input id="cantidad" name="cantidad" type="number" class="validate" min="1" required>
                        <label for="cantidad">Cantidad</label>
                    </div>
                </div>

        </div>
        <!--Asignamos los botones correspondientes para cada acción Scrud-->
        <!--Especificamos con un "title" lo que realiza cada botón-->
    </div>
    <div class="row center-align">
        <a href="#" class="btn waves-effect red tooltipped modal-close" data-tooltip="Cancelar"><i
                class="material-icons">cancel</i></a>
        <button type="submit" class="btn waves-effect red tooltipped" data-tooltip="Guardar"><i
                class="material-icons">save</i></button>
    </div>
    </form>
</div>
<br>

<div id="save-modal1" class="modal Texto rad">
    <div class="modal-content">
        <a href="#" class="btn waves-effect red tooltipped modal-close" data-tooltip="Cancelar"><i class="material-icons">cancel</i></a>
        <h5 id="modal-title" class="center-align">Generar gráfico</h5>
        <br>
        <div class="row" id="option1">
            <!--Creamos la estructura del formulario respectivo-->
            <form method="post" id="save-form1" name="save-form1" enctype="multipart/form-data">
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
                    <button  class="btn waves-effect red tooltipped" data-tooltip="Número de entradas realizadas"><i class="material-icons">assignment_turned_in</i></button>
                    <a class="waves-effect amber accent-4 btn"><i class="material-icons center tooltipped" data-tooltip="Cambiar de opción" onclick="showTwo()">change_circle</i></a>
                </div>   
            </form> 
        </div>
        <div class="row" id="option2">
            <!--Creamos la estructura del formulario respectivo-->
            <form method="post" id="save-form2" name="save-form2" enctype="multipart/form-data">
                <div class="row">
                    <!--Estableciendo el tamaño del que tomará el Input field-->
                    <div class="input-field col s12 m6">
                        <i class="material-icons prefix">date_range</i>
                        <input type="date" id="date1" name="date1" class="validate" required />
                        <label for="date1">Desde</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <i class="material-icons prefix">date_range</i>
                        <input type="date" id="date2" name="date2" class="validate" required />
                        <label for="date2">Hasta</label>
                    </div>
                </div> 
                <div class="row center-align">
                    <button  class="btn waves-effect red tooltipped" data-tooltip="Cantidad y producto en especifico"><i class="material-icons">inventory_2</i></button>
                    <a class="waves-effect amber accent-4 btn"><i class="material-icons center tooltipped" data-tooltip="Cambiar de opción" onclick="showOne()">change_circle</i></a>
                </div>   
            </form> 
        </div>
        <div id="contenedor">
            <canvas id="chart2"></canvas>
        </div>  
    </div>
</div>
<!-- Importación del archivo para generar gráficas en tiempo real. Para más información https://www.chartjs.org/ -->
<script type="text/javascript" src="../resources/js/chart.js"></script>
<?php
//Se imprime la plantilla del pie y se envía el nombre del controlador para la página web
Dashboard_Page::footerTemplate("entradas.js");