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
      <span class="card-title center-align"><b> Visualizar Entradas </b></span>
      <br>
      <!--Agregamos un botón cuya función es que nos mueste el formulario para agregar-->
      <!--un registro-->
      <div class="col s6">
        <a class="waves-effect yellow darken-3 btn modal-trigger" href="#modal_registro">
          <i class="material-icons left">add</i>Agregar entrada
        </a>
      </div>
      <br>
      <!--Se añade un input field el cual su función es buscar una entrada en especifico-->
      <div class="input-field col s6">
        <i class="material-icons prefix">search</i>
        <input type="text" id="autocomplete-input" class="autocomplete">
        <label for="autocomplete-input">Buscar entrada</label>
      </div>

      <!-- Modal Structure -->
      <div id="modal_registro" class="modal">
        <div class="modal-content">
          <h5 class="center-align">Agregar entrada</h5>
          <br>
          <div class="row">
            <!--Creamos la estructura del formulario respectivo-->
            <form class="col-md-4">
              <div class="row">
                <!--Estableciendo el tamaño del que tomará el Input field-->
                <div class="input-field col s12 m6">
                  <select>
                    <option value="" disabled selected>Producto</option>
                  </select>
                </div>
                <!--Estableciendo el tamaño del que tomará el Input field-->
                <div class="input-field col s12 m6">
                  <input id="telefono" type="number" class="validate">
                  <label for="telefono">Cantidad</label>
                </div>
              </div>
              <div class="row">
                <!--Estableciendo el tamaño del que tomará el Input field-->
                <div class="input-field col s12 m6">
                  <label for="fecha">Fecha de ingreso</label>
                  <input type="text" class="datepicker">
                </div>
              </div>
            </form>
          </div>
          <!--Asignamos los botones correspondientes para cada acción Scrud-->
          <!--Especificamos con un "title" lo que realiza cada botón-->
        </div>
        <div class="modal-footer">
          <a id="btn_confirmar" class="btn-floating btn-medium waves-effect waves-light red modal-close"
            title="Guardar Cambios" onclick="GuardarRegistro()"><i class="material-icons">check</i></a>
          <a id="cancelar" class="btn-floating modal-close btn-medium waves-effect waves-light red"
            title="Cancelar"><i class="material-icons">clear</i></a>
        </div>
      </div>
      <div id="modal_update" class="modal">
        <div class="modal-content">
          <h5 class="center-align">Actualizar entrada</h5>
          <br>
          <div class="row">
            <!--Creamos la estructura del formulario respectivo-->
            <form class="col-md-4">
              <div class="row">
                <!--Estableciendo el tamaño del que tomará el Input field-->
                <div class="input-field col s12 m6">
                  <select>
                    <option value="" disabled selected>Producto</option>
                  </select>
                </div>
                <!--Estableciendo el tamaño del que tomará el Input field-->
                <div class="input-field col s12 m6">
                  <input id="telefono" type="number" class="validate">
                  <label for="telefono">Cantidad</label>
                </div>
              </div>
              <div class="row">
                <!--Estableciendo el tamaño del que tomará el Input field-->
                <div class="input-field col s12 m6">
                  <label for="fecha">Fecha de ingreso</label>
                  <input type="text" class="datepicker">
                </div>
              </div>
            </form>
          </div>
          <!--Asignamos los botones correspondientes para cada acción Scrud-->
          <!--Especificamos con un "title" lo que realiza cada botón-->
        </div>
        <div class="modal-footer">
          <a id="btn_confirmar" class="btn-floating btn-medium waves-effect waves-light red modal-close"
            title="Guardar Cambios" onclick="ActualizarRegistro()"><i class="material-icons">check</i></a>
          <a id="cancelar" class="btn-floating modal-close btn-medium waves-effect waves-light red"
            title="Cancelar"><i class="material-icons">clear</i></a>
        </div>
      </div>
      <!--Se construye la tabla de datos correspondiente a entradas-->
      <table class="responsive-table striped">
        <thead>
          <tr>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Fecha</th>
            <th>Empleado</th>
            <th>Acción</th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <th>Caja de lapiceros Bic</th>
            <th>50</th>
            <th>15/08/2021</th>
            <th>Fernando Cubías</th>
            <th>
                <a class="btn-floating btn waves-effect waves yellow darken-3 modal-trigger" href="#modal_update"><i class="material-icons" title="Editar registro">create</i></a>
                <a class="btn-floating btn waves-effect waves yellow darken-3" href="#" onclick="EliminarRegistro()"><i class="material-icons" title="Eliminar registro">delete</i></a>
            </th>
          </tr>
          <tr>
            <th>Borradores Facela</th>
            <th>100</th>
            <th>23/08/2021</th>
            <th>Alejandro Muñoz</th>
            <th>
                <a class="btn-floating btn waves-effect waves yellow darken-3 modal-trigger" href="#modal_update"><i class="material-icons" title="Editar registro">create</i></a>
                <a class="btn-floating btn waves-effect waves yellow darken-3" href="#" onclick="EliminarRegistro()"><i class="material-icons" title="Eliminar registro">delete</i></a>
            </th>
          </tr>
          <tr>
            <th>Cuadernos Norma</th>
            <th>25</th>
            <th>27/10/2021</th>
            <th>Mónica Acevedo</th>
            <th>
                <a class="btn-floating btn waves-effect waves yellow darken-3 modal-trigger" href="#modal_update"><i class="material-icons" title="Editar registro">create</i></a>
                <a class="btn-floating btn waves-effect waves yellow darken-3" href="#" onclick="EliminarRegistro()"><i class="material-icons" title="Eliminar registro">delete</i></a>
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
Dashboard_Page::footerTemplate("entradas.js");