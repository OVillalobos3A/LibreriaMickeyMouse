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
                    Recuerda que cada 90 días tiene que renovar su contraseña por temas de seguridad, una vez cambiadas
                    tus credenciales podrás iniciar sesión.
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
                <input class="hide" type="text" id="usuario" name="usuario" />
                <div class="row">
                    <!--Estableciendo el tamaño del que tomará el Input field-->
                    <div class="input-field col s12 m6">
                        <i class="material-icons prefix">password</i>
                        <input id="clave" type="password" name="clave" class="validate" maxlength="16" required>
                        <label for="clave">Nueva contraseña:</label>
                    </div>
                    <!--Estableciendo el tamaño del que tomará el Input field-->
                    <div class="input-field col s12 m6">
                        <i class="material-icons prefix">password</i>
                        <input id="confirmar" type="password" name="confirmar" class="validate" maxlength="16" required>
                        <label for="confirmar">Confirmar contraseña:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col s10 offset-s1 center-align">
                        <button type="submit" class="btn waves-effect amber accent-4 tooltipped"
                            data-tooltip="Guardar"><i class="material-icons">save</i></button>
                    </div>
                </div>
            </form>
        </div>
        <div class="row">
            <div class="col s12">
                <div class="card-panel red accent-4">
                    <span class="white-text">
                        Las contraseñas son hoy la llave maestra a toda nuestra vida digital. Tanto nuestras cuentas, tales como de la banca en línea, correo electrónico y redes sociales, como nuestros dispositivos, computadoras, tabletas y teléfonos móviles, dependen de una clave para resguardar la información que almacenan. Sin embargo, el aumento en ciberataques que resultan en fuga de datos, hackeo de cuentas y robo de información pueden comprometerlas y poner en jaque la información que resguardan.
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
//Se imprime la plantilla del pie y se envía el nombre del controlador para la página web
Dashboard_Page::footerTemplate('change.js');
?>