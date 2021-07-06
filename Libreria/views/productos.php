<?php
include("../app/helpers/dashboard.php");
Public_Page::headerTemplate('libreria');
?>
<section>
  <div class="container Texto">
    <div class="row"> 
      <div class="col s12">
        <br><br>
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
    </div>  
  </div>  
</section>
<section>
  <div class="container">
    <div class="row">      
      <div class="col s12 m6 l4">
        <div class="col s12 white hoverable appear-down rad">
          <div class="card alto-card-m z-depth-0">
            <!--Imagen del producto-->
            <div class="card-image">
              <img class="responsive-img alto-card-img" src="../resources/multimedia/productos/producto 1.jpg">   
              <a href="producto.php" class="large btn-floating halfway-fab waves-effect waves-light amber accent-4 hoverable hoverable right"><i class="material-icons black-text">call_made</i></a>         
            </div>            
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
          <div class="card alto-card-m z-depth-0">
            <!--Imagen del producto-->
            <div class="card-image">
              <img class="responsive-img alto-card-img" src="../resources/multimedia/productos/producto 2.jpg">  
              <a href="producto.php" class="large btn-floating halfway-fab waves-effect waves-light amber accent-4 hoverable hoverable right"><i class="material-icons black-text">call_made</i></a>          
            </div>
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
          <div class="card alto-card-m z-depth-0">
            <!--Imagen del producto-->
            <div class="card-image">
              <img class="responsive-img alto-card-img" src="../resources/multimedia/productos/producto 3.jpg"> 
              <a href="producto.php" class="large btn-floating halfway-fab waves-effect waves-light amber accent-4 hoverable hoverable right"><i class="material-icons black-text">call_made</i></a>           
            </div>
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
          <div class="card alto-card-m z-depth-0">
            <!--Imagen del producto-->
            <div class="card-image">
              <img class="responsive-img alto-card-img" src="../resources/multimedia/productos/producto 4.png">    
              <a href="producto.php" class="large btn-floating halfway-fab waves-effect waves-light amber accent-4 hoverable hoverable right"><i class="material-icons black-text">call_made</i></a>        
            </div>
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
</section>
<?php
  //Se imprime la plantilla del pie y se envía el nombre del controlador para la página web
  Public_Page::footerTemplate();
?>
