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

  <!-- Dropdown Structure -->
  <ul id='dropdownmas' class='dropdown-content center'>
    <!--Boton de ver-->
    <li><a class="black-text Texto modal-trigger" href="#modalactualizar">
      <i class="material-icons center">call_made</i>Ver
    </a></li>
    <!--Boton de editar-->
    <li><a class="black-text Texto modal-trigger" href="#modalstock">
      <i class="material-icons center">more</i>Stock
    </a></li>
    <!--Boton de editar-->
    <li><a class="black-text Texto modal-trigger" href="#modalactualizar">
      <i class="material-icons center">edit</i>Editar
    </a></li>
    <!--Boton de archivar-->  
    <li><a class="black-text Texto modal-trigger" href="#modaleliminar">
      <i class="material-icons center">delete</i>Archivar
    </a></li>
  </ul>

  <div class="container">
    <div class="row">      
      <div class="col s12 m6 l4">
        <div class="col s12 white hoverable appear-down rad">
          <div class="card small z-depth-0">
            <div class="card-content black-text center">
              <div class="container">
                <div class="row">
                  <div class="col s12 m12 l12">
                    <br><br><br>
                    <a class="modal-trigger" href="#modalagregar">
                      <i class="valing-wrapper"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                        width="50" height="50"
                        viewBox="0 0 50 50"
                        style=" fill:#000000;"><path d="M 20 4 A 1.0001 1.0001 0 0 0 19.292969 4.2929688 L 17.585938 6 L 9.3867188 6 C 7.5296852 6 5.9058511 7.2896965 5.4882812 9.0996094 L 3.2050781 19 L 2 19 C 0.897 19 0 19.897 0 21 L 0 24 C 0 25.103 0.897 26 2 26 L 48 26 C 49.103 26 50 25.103 50 24 L 50 21 C 50 19.897 49.103 19 48 19 L 46.794922 19 L 44.509766 9.0996094 C 44.0923 7.2901497 42.470315 6 40.613281 6 L 32.414062 6 L 30.707031 4.2929688 A 1.0001 1.0001 0 0 0 30 4 L 20 4 z M 20.414062 6 L 29.585938 6 L 31.292969 7.7070312 A 1.0001 1.0001 0 0 0 32 8 L 40.613281 8 C 41.550248 8 42.351965 8.638241 42.5625 9.5507812 L 44.742188 19 L 5.2578125 19 L 7.4375 9.5507812 C 7.6479301 8.6386942 8.4497521 8 9.3867188 8 L 18 8 A 1.0001 1.0001 0 0 0 18.707031 7.7070312 L 20.414062 6 z M 2.7695312 28 L 7.8261719 45.542969 C 8.0701719 46.387969 8.985 47 10 47 L 32.880859 47 C 34.697941 48.847586 37.219827 50 40 50 C 45.5 50 50 45.5 50 40 C 50 36.774533 48.446014 33.902012 46.056641 32.070312 L 47.230469 28 L 2.7695312 28 z M 17 31 C 17.55 31 18 31.45 18 32 L 18 43 C 18 43.55 17.55 44 17 44 C 16.45 44 16 43.55 16 43 L 16 32 C 16 31.45 16.45 31 17 31 z M 25 31 L 25.001953 31 C 25.550953 31 26 31.45 26 32 L 26 43 C 26 43.55 25.55 44 25 44 C 24.45 44 24 43.55 24 43 L 24 32 C 24 31.45 24.45 31 25 31 z M 40 32 C 44.4 32 48 35.6 48 40 C 48 44.4 44.4 48 40 48 C 35.6 48 32 44.4 32 40 C 32 35.6 35.6 32 40 32 z M 40 34.099609 C 39.4 34.099609 39 34.499609 39 35.099609 L 39 39 L 35.099609 39 C 34.499609 39 34.099609 39.4 34.099609 40 C 34.099609 40.6 34.499609 41 35.099609 41 L 39 41 L 39 44.900391 C 39 45.500391 39.4 45.900391 40 45.900391 C 40.6 45.900391 41 45.500391 41 44.900391 L 41 41 L 44.900391 41 C 45.500391 41 45.900391 40.6 45.900391 40 C 45.900391 39.4 45.500391 39 44.900391 39 L 41 39 L 41 35.099609 C 41 34.499609 40.6 34.099609 40 34.099609 z"></path></svg></i>  
                    </a>
                  </div>
                </div>
              </div>
              <span class="card-title Titulos black-text center">Agregar Producto</span>
            </div>             
          </div>
        </div>
        <div class="col">
          <br>
        </div>
      </div>

      <div class="col s12 m6 l4">
        <div class="col s12 white hoverable appear-down rad">
          <div class="card small z-depth-0">
            <!--Imagen del producto-->
            <div class="card-image">
              <img src="../resources/multimedia/productos/producto 1.jpg">            
            </div>
            <a href='#' data-target='dropdownmas' class="dropdown-trigger btn-floating right btn-large waves-effect waves-light white z-depth-0">
              <i class="large material-icons black-text hoverable">more_vert</i>
            </a>
            <div class="card-content black-text">
              <span class="card-title Titulos black-text">$12.00</span>
              <p class="Texto">Libro El Principito</p>
              <p class="Texto">Cantidad:[i]</p>
            </div>             
          </div>
        </div>
        <div class="col">
          <br>
        </div>
      </div>
  
      <div class="col s12 m6 l4">
        <div class="col s12 white hoverable appear-down rad">
          <div class="card small z-depth-0">
            <!--Imagen del producto-->
            <div class="card-image">
              <img src="../resources/multimedia/productos/producto 2.jpg">            
            </div>
            <a href='#' data-target='dropdownmas' class="dropdown-trigger btn-floating right btn-large waves-effect waves-light white z-depth-0">
              <i class="large material-icons black-text hoverable">more_vert</i>
            </a>
            <div class="card-content black-text">
              <span class="card-title Titulos black-text">$2.00</span>
              <p class="Texto">Cuadernos #1 Rayados</p>
              <p class="Texto">Cantidad:[i]</p>
            </div>             
          </div>
        </div>
        <div class="col">
          <br>
        </div>
      </div>
  
      <div class="col s12 m6 l4">
        <div class="col s12 white hoverable appear-down rad">
          <div class="card small z-depth-0">
            <!--Imagen del producto-->
            <div class="card-image">
              <img src="../resources/multimedia/productos/producto 3.jpg">            
            </div>
            <a href='#' data-target='dropdownmas' class="dropdown-trigger btn-floating right btn-large waves-effect waves-light white z-depth-0">
              <i class="large material-icons black-text hoverable">more_vert</i>
            </a>
            <div class="card-content black-text">
              <span class="card-title Titulos black-text">$0.50</span>
              <p class="Texto">Lapiceros</p>
              <p class="Texto">Cantidad: [i]</p>
            </div>       
          </div>
        </div>
        <div class="col">
          <br>
        </div>
      </div>
  
      <div class="col s12 m6 l4">
        <div class="col s12 white hoverable appear-down rad">
          <div class="card small z-depth-0">
            <!--Imagen del producto-->
            <div class="card-image">
              <img src="../resources/multimedia/productos/producto 4.png">            
            </div>
            <a href='#' data-target='dropdownmas' class="dropdown-trigger btn-floating right btn-large waves-effect waves-light white z-depth-0">
              <i class="large material-icons black-text hoverable">more_vert</i>
            </a>
            <div class="card-content black-text">
              <span class="card-title Titulos black-text">$5.00</span>
              <p class="Texto">Estuche de Geometría</p>
              <p class="Texto">Cantidad:[i]</p>
            </div>            
          </div>
        </div>
        <div class="col">
          <br>
        </div>
      </div>
      
    </div>
  </div>

  <!--Modals-->

  <!--Agregar-->
  <div id="modalagregar" class="modal Texto rad">
    <div class="modal-content black-text">
      <h5>Agregar nuevo producto</h5>
      <br>
      <div class="row">
        <form class="col s12">
          <div class="row">
            <!--Texbox Nombre-->
            <div class="input-field col s12 m6 l6">
              <input id="first_name" type="text"
                class="validate">
              <label for="first_name">Nombre</label>
            </div>
            <!--Combobox Tipo-->
            <div class="input-field col s12 m6 l6">
              <select>
                <optgroup label="team 1">
                  <option value="1">Accesorios</option>
                  <option value="2">Ropa</option>
                </optgroup>
              </select>
              <label>Tipo de Producto</label>
            </div>
            <!--Textbox Descripcion-->
            <div class="input-field col s12 m12 l12">
              <textarea id="textarea1" class="materialize-textarea"></textarea>
              <label for="textarea1">Descripcion</label>
            </div>
          </div>
          <div class="row">    
            <!--Textbox Autor-->
            <div class="input-field col s12 m6 l6">
              <input id="edit-autor" type="text"
                class="validate">
              <label for="edit-autor">Autor</label>
            </div>        
            <!--Combobox Marca-->
            <div class="input-field col s12 m6 l6">
              <select>
                <optgroup label="team 1">
                  <option value="1">Marca</option>
                  <option value="2">Marca[i]</option>
                </optgroup>
              </select>
              <label>Marca</label>
            </div>
            <!--Combobox Proveedor-->
            <div class="input-field col s12 m6 l6">
              <select>
                <optgroup label="team 1">
                  <option value="1">Proveedor</option>
                  <option value="2">Proveedor</option>
                </optgroup>
              </select>
              <label>Proveedor</label>
            </div>
            <!--Combobox Estado-->
            <div class="input-field col s12 m6 l6">
              <select>
                <optgroup label="team 1">
                  <option value="1">Disponible </option>
                  <option value="2">Pendiente</option>
                </optgroup>
              </select>
              <label>Estado</label>
            </div>  
          </div>          
          <div class="row">
            <!--Texbox Cantidad-->
            <div class="input-field col s12 m6 l6">
              <input id="edit-cantidad" type="number" min="1"
                class="validate">
              <label for="edit-cantidad">Cantidad en stock</label>
            </div>
            <!--Texbox Medida-->
            <div class="input-field col s12 m6 l6">
              <input id="edit-medida" type="text"
                class="validate">
              <label for="edit-medida">Medida Disponible</label>
            </div>
          </div>
          <div class="row">
            <!--Textbox Precio-->
            <div class="input-field col s12 m6 l6">
              <input id="edit-precio" type="number" max="100" min="1" class="validate">
              <label for="edit-precio">Precio $</label>
            </div>
            <!--Textbox Descuentos-->
            <div class="input-field col s12 m6 l6">
              <input id="edit-descuento" type="number" max="100" min="1" class="validate">
              <label for="edit-descuento">Descuento %</label>
            </div>
            <!--Textbox Imagen-->
            <div class="input-field col s12 m12 l12">
              <form action="#">
                <div class="file-field input-field">
                  <div class="btn black">
                    <span><i class="large material-icons">add_a_photo</i></span>
                    <input type="file">
                  </div>
                  <div class="file-path-wrapper">
                    <input placeholder="Imagen" class="file-path validate" type="text">
                  </div>
                </div>
              </form>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-black btn-flat">Cancelar</a>
      <a class="btn-flat modal-close black  white-text" type="submit" name="action">Agregar
        <i class="material-icons left">save</i>
      </a>
    </div>
  </div>

  <!--Ingresar al Stock-->
  <div id="modalstock" class="modal Texto rad">
    <div class="modal-content black-text">
      <h5>Agregar productos al stock</h5>
      <br>
      <div class="row">
          <div class="row">
            <!--Textbox Cantidad Actual-->
            <div class="input-field col s12 m12 l12">
              <input disabled id="in-stock" placeholder="Producto[i]" type="text" class="validate">
              <label for="in-stock">Producto</label>
            </div>
            <!--Textbox Cantidad Actual-->
            <div class="input-field col s12 m12 l12">
              <input disabled id="in-stock" placeholder="[i]" type="number" class="validate" min="1">
              <label for="in-stock">Cantidad Actual en Stock</label>
            </div>
            <!--Textbox Cantidad por Agregar al Stock-->
            <div class="input-field col s12 m12 l12">
              <input id="add-stock" type="number" class="validate" min="1">
              <label for="add-stock">Cantidad a Agregar</label>
            </div>
            <!--Textbox Cantidad Final-->
            <div class="input-field col s12 m12 l12">
              <input disabled id="in-stock" placeholder="[i]" type="number" class="validate" min="1">
              <label for="in-stock">Cantidad Total en Stock al finalizar</label>
            </div>
          </div>               
        </form>
      </div>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-black btn-flat">Cancelar</a>
      <button class="btn-flat waves-effect waves-light black darken-4 white-text modal-close" type="submit" name="action">Guardar Cambios
        <i class="material-icons left">save</i>
      </button>
    </div>
  </div>

  <!--Actualizar-->
  <div id="modalactualizar" class="modal Texto rad">
    <div class="modal-content black-text">
      <h5>Actualizar producto</h5>
      <br>
      <div class="row">
        <form class="col s12">
          <div class="row">
            <!--Texbox Nombre-->
            <div class="input-field col s12 m6 l6">
              <input id="first_name" type="text"
                class="validate">
              <label for="first_name">Nombre</label>
            </div>
            <!--Combobox Tipo-->
            <div class="input-field col s12 m6 l6">
              <select>
                <optgroup label="team 1">
                  <option value="1">Accesorios</option>
                  <option value="2">Ropa</option>
                </optgroup>
              </select>
              <label>Tipo de Producto</label>
            </div>
            <!--Textbox Descripcion-->
            <div class="input-field col s12 m12 l12">
              <textarea id="textarea1" class="materialize-textarea"></textarea>
              <label for="textarea1">Descripcion</label>
            </div>
          </div>
          <div class="row">    
            <!--Textbox Autor-->
            <div class="input-field col s12 m6 l6">
              <input id="edit-autor" type="text"
                class="validate">
              <label for="edit-autor">Autor</label>
            </div>        
            <!--Combobox Marca-->
            <div class="input-field col s12 m6 l6">
              <select>
                <optgroup label="team 1">
                  <option value="1">Marca</option>
                  <option value="2">Marca[i]</option>
                </optgroup>
              </select>
              <label>Marca</label>
            </div>
            <!--Combobox Proveedor-->
            <div class="input-field col s12 m6 l6">
              <select>
                <optgroup label="team 1">
                  <option value="1">Proveedor</option>
                  <option value="2">Proveedor</option>
                </optgroup>
              </select>
              <label>Proveedor</label>
            </div>
            <!--Combobox Estado-->
            <div class="input-field col s12 m6 l6">
              <select>
                <optgroup label="team 1">
                  <option value="1">Disponible </option>
                  <option value="2">Pendiente</option>
                </optgroup>
              </select>
              <label>Estado</label>
            </div>  
          </div>          
          <div class="row">
            <!--Texbox Cantidad-->
            <div class="input-field col s12 m6 l6">
              <input disabled id="edit-cantidad" type="number" min="1"
                class="validate">
              <label for="edit-cantidad">Cantidad en stock</label>
            </div>
            <!--Texbox Medida-->
            <div class="input-field col s12 m6 l6">
              <input id="edit-medida" type="text"
                class="validate">
              <label for="edit-medida">Medida Disponible</label>
            </div>
          </div>
          <div class="row">
            <!--Textbox Precio-->
            <div class="input-field col s12 m6 l6">
              <input id="edit-precio" type="number" max="100" min="1" class="validate">
              <label for="edit-precio">Precio $</label>
            </div>
            <!--Textbox Descuentos-->
            <div class="input-field col s12 m6 l6">
              <input id="edit-descuento" type="number" max="100" min="1" class="validate">
              <label for="edit-descuento">Descuento %</label>
            </div>
            <!--Textbox Imagen-->
            <div class="input-field col s12 m12 l12">
              <form action="#">
                <div class="file-field input-field">
                  <div class="btn black">
                    <span><i class="large material-icons">add_a_photo</i></span>
                    <input type="file">
                  </div>
                  <div class="file-path-wrapper">
                    <input placeholder="Imagen" class="file-path validate" type="text">
                  </div>
                </div>
              </form>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-black btn-flat">Cancelar</a>
      <button class="btn-flat waves-effect waves-light black darken-4 white-text modal-close" type="submit" name="action">Guardar Cambios
        <i class="material-icons left">save</i>
      </button>
    </div>
  </div>

  <!--Eliminar-->
  <div id="modaleliminar" class="modal rad">
    <div class="modal-content black-text center Texto">
      <h4>Archivar producto</h4><br>
      <h6>¿Está seguro que desea archivar el producto?</h6>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-black btn-flat">Cancelar</a>
      <button class="btn waves-effect waves-light red modal-close" type="submit" name="action">Archivar
        <i class="material-icons right">delete</i>
      </button>
    </div>
  </div>
</section>
<?php
  //Se imprime la plantilla del pie y se envía el nombre del controlador para la página web
  Dashboard_Page::footerTemplate('productos.js');
?>
