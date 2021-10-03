<?php
include("../app/helpers/dashboard.php");
Dashboard_Page::headerTemplate('Pagina');
?>

<br>
<br>
<div class="container">
    <div class="container">
        <div class="col s12 m6">
            <div class="card-panel red accent-4">
                <span class="white-text">
                    Tienes activado el doble factor de autenticación, se te ha enviado a tu correo el código de confirmación para poder acceder.
                </span>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="col s12 m6">
        <div class="card-panel withe">
            <form method="post" id="save-form" name="save-form" enctype="multipart/form-data" class="col-md-4" autocomplete="off">
                <!-- Campo oculto para asignar el id del registro al momento de modificar -->
                <input class="hide" type="text" id="id_usuario" name="id_usuario" />
                <div class="row">                    
                    <!--Estableciendo el tamaño del que tomará el Input field-->
                    <div class="col s10 offset-s1 center-align">
                    <div class="input-field col s12 m12 center-align">
                        <i class="material-icons prefix">password</i>
                        <input id="codigo" type="text" name="codigo" class="validate" maxlength="5" required>
                        <label for="codigo">Código de confirmación:</label>
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col s10 offset-s1 center-align">
                        <button type="submit" class="btn waves-effect amber accent-4 tooltipped"
                            data-tooltip="Iniciar sesion"><i class="material-icons">check</i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

<?php
//Se imprime la plantilla del pie y se envía el nombre del controlador para la página web
Dashboard_Page::footerTemplate('autenticacion.js');
?>
