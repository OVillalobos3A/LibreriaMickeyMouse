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
      <div class="col s12 m12 l12">
        <div class="row">
          <div class="col s12">
            <div class="row">
                <form method="post" id="search-form">
                    <div class="input-field col s8 m10 l10">
                        <input id="search" type="text" name="search" class="validate white-text" required>
                        <label for="search">Buscar Producto</label>                                
                    </div>
                    <div class="input-field col s4 m2 l2">
                        <button type="submit" class="btn col s12 waves-effect white black-text"><i class="material-icons right black-text">search</i>Buscar</button>
                    </div>
                </form>
            </div>
          </div>
        </div>           
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
            <div class="container" id="esconder">
                <div class="row">
                    <div class="col s12 m12 l12">
                        <img class="centrar" id="imagen" src="" height="200" width="200">
                    </div>
                </div>
            </div>
            <div class="row">
                <form method="post" id="save-form" enctype="multipart/form-data" class="col s12">
                <input class="hide" type="number" id="id_producto" name="id_producto"/>
                    
                    <div class="row">
                        <div class="input-field col s12 m6 l6">
                            <input id="nombre" name="nombre" type="text" class="validate" required>
                            <label for="nombre">Nombre del producto</label>
                        </div>   
                        <div class="input-field col s12 m6 l6">
                            <select id="tipo_producto" name="tipo_producto">
                            </select>
                            <label>Tipo</label>
                        </div>       
                        <div class="input-field col s12 m12 l12">
                            <textarea id="descripcion" name="descripcion" class="materialize-textarea" required></textarea>
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
                        <div class="input-field col s12 m6 l6">
                            <input id="stock" name="stock" type="number" min="1" class="validate" required>
                            <label for="stock" id="label-stock">Cantidad Disponible</label>
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
                        <div class="col s12 m12 l12">
                            <br>
                            <span id="aviso"></span>
                            <br>
                        </div>
                        <div class="col s12 modal-footer">
                            <br>
                            <a href="#!" class="modal-close waves-effect waves-black btn-flat">Cancelar</a>
                            <button class="btn-flat modal-close" type="submit">Guardar</button>
                        </div>
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
