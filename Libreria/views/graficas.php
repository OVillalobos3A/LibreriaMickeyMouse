<?php
include("../app/helpers/dashboard.php");
Dashboard_Page::headerTemplate('libreria');
?>
<br>
<div class="row container">
    <div class="center-align" id="datos"></div>
        <div class="col s12 m12">
            <div class="card-panel white rad">
                <div class="row">
                    <div class="col s12 m6 center-align">                                            
                    <br>
                        <img class="responsive-img" src="../resources/img/productos/chart1.PNG">
                    </div>
                    <div class="col s12 m6 center-align">                    
                    <br>
                        <img class="responsive-img" src="../resources/img/productos/chart2.PNG">
                    </div>
                </div>
            </div>
        </div>
        <div id="save-modal" class="modal">
            <div class="modal-content">
                <h5 id="modal-title" class="center-align"></h5>
                <br>
                <!--Estableciendo el tamaño de cada div correspondiente-->
                <form method="post" id="save-form" enctype="multipart/form-data">
                    <!-- Campo oculto para asignar el id del registro al momento de modificar -->
                    <input class="hide" type="number" id="id_empleado" name="id_empleado"/>
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">account_circle</i>
                            <input id="nombre" type="text" name="nombre" class="validate" maxlength="25" required/>
                            <label for="nombre">Nombres</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">account_circle</i>
                            <input id="apellido" type="text" name="apellido" class="validate" maxlength="25" required/>
                            <label for="apellido">Apellidos</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">email</i>
                            <input id="correo" type="email" name="correo" class="validate" maxlength="40" required/>
                            <label for="correo">Correo</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">phone</i>
                            <input id="tel" type="text" name="tel" class="validate" maxlength="9" required/>
                            <label for="tel">Teléfono</label>
                        </div>
                        </div>
                        <div class="file-field input-field col s12">
                            <div class="btn blue-grey tooltipped"  data-tooltip="Seleccione una imagen de 500x500">
                                <i class="material-icons right">image</i>Foto de perfil
                                <input id="archivo" type="file" name="archivo" accept=".gif, .jpg, .png"/>
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text" placeholder="Formatos aceptados: gif, jpg y png"/>
                            </div>
                        </div>
                        <div class="row center-align">
                            <a href="#" class="btn waves-effect red tooltipped modal-close" data-tooltip="Cancelar"><i class="material-icons">cancel</i></a>
                            <button type="submit" class="btn waves-effect yellow darken-3 tooltipped" data-tooltip="Guardar"><i class="material-icons">save</i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div id="credential-modal" class="modal">
            <div class="modal-content">
                <h5 id="modal-title1" class="center-align"></h5>
                <br>
                <!--Estableciendo el tamaño de cada div correspondiente-->
                <form method="post" id="credential-form" enctype="multipart/form-data">
                    <!-- Campo oculto para asignar el id del registro al momento de modificar -->
                    <input class="hide" type="number" id="id_usuario" name="id_usuario"/>
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">account_circle</i>
                            <input id="alias" type="text" name="alias" class="validate" maxlength="10" required/>
                            <label for="alias">Usuario</label>
                        </div>
                        
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">add_moderator</i>
                            <input id="ncontra" type="password" name="ncontra" class="validate" maxlength="16" required/>
                            <label for="ncontra">Nueva contraseña</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">add_moderator</i>
                            <input id="ncontra1" type="password" name="ncontra1" class="validate" maxlength="16" required/>
                            <label for="ncontra1">Confirmar contraseña</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">password</i>
                            <input id="contra" type="password" name="contra" class="validate" maxlength="16" required/>
                            <label for="contra">Contraseña actual</label>
                        </div>
                    </div>
                    <div class="row center-align">
                        <a href="#" class="btn waves-effect red tooltipped modal-close" data-tooltip="Cancelar"><i class="material-icons">cancel</i></a>
                        <button type="submit" class="btn waves-effect yellow darken-3 tooltipped" data-tooltip="Guardar"><i class="material-icons">save</i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
//Se imprime la plantilla del pie y se envía el nombre del controlador para la página web
Dashboard_Page::footerTemplate('grafica.js');
?>
