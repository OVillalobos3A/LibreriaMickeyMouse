<?php
include("../app/helpers/dashboard.php");
Dashboard_Page::headerTemplate('libreria');
?>
<section>
  <div class="container Texto">
    <div class="row">
      <div class="col s12 m12 l12">
        <h1 class="white-text Titulos">Inventario</h1>
        <h5 class="white-text Texto">Gestión de Productos</h5><br><br>
      </div>       
      <div class="col s8 m8 l8">
        <div class="row">
          <form class="col s12">
            <div class="row">
              <div class="input-field col s12">
                <i class="material-icons prefix white-text">search</i>
                <!--TextBox Producto-->
                <textarea id="icon_prefix2" class="materialize-textarea white-text"></textarea>
                <label for="icon_prefix2">Buscar Producto</label>
              </div>
            </div>
          </form>
        </div>           
      </div>
      <div class="col s4 m4 l4">
        <!--Combobox Tipo del producto-->
        <label class="Texto">Tipo del Producto</label>
        <select class="browser-default Texto">                
          <option class="Texto" value="" disabled selected>Todos</option>
          <!--Tipos de Productos-->
          <option id="tipoi" class="black-text" value="1">tipo[i]</option>
        </select>
      </div>
</section>
<section>

    <div class="container">
        <div class="row" id="tbody-rows">      
        </div>
    </div>

  <!--Modals-->

    <div id="save-modal" class="modal Texto rad">
        <div class="modal-content black-text">
            <h5 id="modal-title"></h5>
            <br>
            <div class="container">
                <div class="row">
                    <div class="col s12 m12 l12 center-aling">
                        <img class="responsive-img" id="imagen" src="">
                    </div>
                </div>
            </div>
            <div class="row">
                <form method="post" id="save-form" enctype="multipart/form-data" class="col s12">
                <input class="hide" type="number" id="id_producto" name="id_producto"/>
                    
                    <div class="row">
                        <div class="input-field col s6 m6 l6">
                            <input id="nombre" name="nombre" type="text" class="validate" required>
                            <label for="nombre">Nombre del producto</label>
                        </div>   
                        <div class="input-field col s6 m6 l6">
                            <select id="tipo_producto" name="tipo_producto">
                            </select>
                            <label>Tipo</label>
                        </div>       
                        <div class="input-field col s12 m12 l12">
                            <textarea id="descripcion" name="decripcion" class="materialize-textarea" required></textarea>
                            <label for="descripcion">Descripcion</label>
                        </div>            
                        <div class="input-field col s12 m6 l6">
                            <input id="autor" name="autor" type="text" class="validate">
                            <label for="autor">Autor (opcional)</label>
                        </div>       
                        <!--Combobox Marca-->
                        <div class="input-field col s12 m6 l6">
                            <select id="marca" name="marca">
                            </select>
                            <label>Marca</label>
                        </div>
                        <!--Combobox Proveedor-->
                        <div class="input-field col s12 m6 l6">
                            <select id="proveedor" name="proveedor">
                            </select>
                            <label>Proveedor</label>
                        </div>    
                        <!--Texbox Cantidad-->
                        <div class="input-field col s6 m6 l6">
                            <input id="stock" name="stock" type="number" min="1" class="validate" required>
                            <label for="stock">Cantidad Disponible</label>
                        </div>
                        <div class="input-field col s12 m6 l6">
                            <input id="precio" name="precio" type="number" min="1" max="90" step="any" class="validate" required>
                            <label for="precio">Precio $</label>
                        </div>
                        <div class="input-field col s12 m12 l12">
                        <div class="file-field input-field">
                                    <div class="btn black">
                                        <span><i class="large material-icons">add_a_photo</i></span>
                                        <input id="foto" type="file" name="foto" accept=".gif, .jpg, .png">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input placeholder="Imagen" id="imagen" class="file-path validate" type="text">
                                    </div>
                                </div>
                        </div>
                        <div class="col s12 modal-footer">
                            <a href="#!" class="modal-close waves-effect waves-black btn-flat">Cancelar</a>
                            <button class="btn-flat modal-close" type="submit">Agregar</button></div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</section>
<?php
  //Se imprime la plantilla del pie y se envía el nombre del controlador para la página web
  Dashboard_Page::footerTemplate('productos.js');
?>
