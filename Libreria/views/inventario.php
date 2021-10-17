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
                                <div class="input-field col s7 m9 l9">
                                    <i class="material-icons prefix white-text">search</i>
                                    <input id="search" type="text" name="search" class="validate white-text" required>
                                    <label for="search">Buscar Producto</label>
                                </div>
                                <div class="input-field col s4 m2 l2">
                                    <button type="submit" class="btn col s12 waves-effect white black-text"><i
                                            class="material-icons right black-text">search</i>Buscar</button>
                                </div>
                            </form>
                            <div class="input-field col s1 m1 l1">
                                <!--Se añade un boton para genera reporte-->
                                <a href="../app/reports/inventario.php" target="_blank"
                                    class="btn waves-effect white tooltipped" data-tooltip="Reporte del Inventario"><i
                                        class="material-icons black-text">assignment</i></a>
                            </div>
                        </div>
                    </div>
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
            <p>Los campos que no pueden quedar vacíos se marcaran con un (*)</p>
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
                    <input class="hide" type="number" id="id_producto" name="id_producto" />

                    <div class="row">
                        <div class="input-field col s12 m6 l6">
                            <i class="material-icons prefix">assignment</i>
                            <input id="nombre" name="nombre" type="text"
                                class="validate" required>
                            <label for="nombre">Nombre del producto *</label>
                        </div>
                        <div class="input-field col s12 m6 l6">
                            <select id="tipo_producto" name="tipo_producto">
                            </select>
                            <label>Tipo *</label>
                        </div>
                        <div class="input-field col s12 m12 l12">
                            <i class="material-icons prefix">description</i>
                            <textarea id="descripcion"
                                name="descripcion" class="materialize-textarea" required></textarea>
                            <label for="descripcion">Descripcion *</label>
                        </div>
                        <!--Combobox Proveedor-->
                        <div class="input-field col s12 m6 l6">
                            <i class="material-icons prefix"></i>
                            <select id="proveedor" name="proveedor">
                            </select>
                            <label>Proveedor *</label>
                        </div>
                        <!--Combobox Marca-->
                        <div class="input-field col s12 m6 l6">
                            <select id="marca" name="marca">
                            </select>
                            <label>Marca *</label>
                        </div>
                        <div class="input-field col s12 m6 l6">
                            <i class="material-icons prefix">book</i>
                            <input id="autor" name="autor"
                                type="text" class="validate">
                            <label for="autor">Autor (opcional)</label>
                        </div>
                        <!--Texbox Cantidad-->
                        <div class="input-field col s12 m6 l6">
                            <i class="material-icons prefix">sort</i>
                            <input id="stock"
                                name="stock" type="number" min="1" class="validate" required>
                            <label for="stock" id="label-stock">Cantidad Disponible *</label>
                        </div>
                        <div class="input-field col s12 m6 l6">
                            <i class="material-icons prefix">monetization_on</i>
                            <input placeholder="$00.00" id="precio" name="precio" type="number" min="1" max="90"
                                step="any" class="validate" required>
                            <label for="precio">Precio $ * ($00.00)</label>
                        </div>
                        <div class="input-field col s12 m12 l12">
                            <div class="file-field input-field">
                                <div class="btn black">
                                    <span><i class="large material-icons">add_a_photo</i></span>
                                    <input id="foto" type="file" name="foto" accept=".gif, .jpg, .png">
                                </div>
                                <div class="file-path-wrapper">
                                    <input placeholder="Selecciona una Imagen *" id="imagen" class="file-path validate"
                                        type="text">
                                </div>
                            </div>
                        </div>
                        <div class="col s12 m12 l12">
                            <br>
                            <span id="aviso"></span>
                            <br>
                        </div>
                    </div>
                    <div class="row center-align">
                        <a class="btn waves-effect red accent-4 tooltipped modal-close" data-tooltip="Cancelar"><i
                                class="material-icons">cancel</i></a>
                        <button type="submit" class="btn waves-effect red accent-4 tooltipped" data-tooltip="Guardar"><i
                                class="material-icons">save</i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="view-modal" class="modal Texto rad">
        <div class="modal-content black-text">
            <br>
            <div class="row">
                <div class="col s4 m4 l4">
                    <img class="responsive-img" id="imagen-v" src="">
                </div>
                <div class="col s8 m8 l8">
                    <!--Precio-->
                    <h4 class="Titulos" id="precio-v"></h4>
                    <!--Nombre-->
                    <span class="Texto flow-text" id="nombre-v"></span>
                    <!--Tipo del Producto-->
                    <p class="Texto" id="tipo_producto-v"></p>
                    <!--Descripción-->
                    <p class="Texto" id="descripcion-v"></p>
                    <!--Marca-->
                    <p class="Texto" id="autor-v"></p>
                    <!--Marca-->
                    <p class="Texto" id="marca-v"></p>
                    <!--Proveedor-->
                    <p class="Texto" id="proveedor-v"></p>
                    <!--Cantidad-->
                    <p class="Texto" id="stock-v"></p>
                </div>
            </div>
            <div class="col s12 modal-footer">
                <br>
                <button href="#!" class="modal-close waves-effect waves-light btn-flat">Cerrar</button>
            </div>
        </div>
    </div>

</section>
<?php
  //Se imprime la plantilla del pie y se envía el nombre del controlador para la página web
  Dashboard_Page::footerTemplate('productos.js');
?>