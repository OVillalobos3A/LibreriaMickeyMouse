<?php
include("../app/helpers/dashboard.php");
Dashboard_Page::headerTemplate('libreria');
?>

<!--Contenedor para mostrar el div contenedor a la card en la cual se muestra:-->
<!--el formulario de recuperar contraseña.-->
<br>
<br>
<br>
<div class="row container" id="ocultable">
    <div class="col s12">
        <div class="card white rad">
            <!--Defiendo el contenido de la card que contendrá el formulario-->
            <div class="card-content black-text">
                <a class="waves-effect yellow darken-3 white-text btn" href="../views/index.php">
                    <i class="material-icons left">arrow_back</i>Login
                </a>
                <br>
                <br>
                <!--Colocamos el titulo de la card-->
                <span class="card-title center-align">Recuperación de contraseña</span>
                <br>
                <!--Estableciendo el tamaño de cada div correspondiente-->
                <!--Creamos la estructura del formulario respectivo-->
                <form method="post" id="save-form" name="save-form" enctype="multipart/form-data" class="col-md-4">
                    <div class="row">
                        <div class="row">
                            <!--Estableciendo el tamaño del que tomará el Input field-->
                            <div class="input-field col s12 m6">
                                <input id="usuario" name="usuario" type="text" class="validate" autocomplete="off"  maxlength="10" required>
                                <label for="usuario">Ingrese su usuario:</label>
                            </div>
                        </div>
                        <div class="row">
                            <!--Estableciendo el tamaño del que tomará el Input field-->
                            <div class="input-field col s12 m6">
                                <button class="btn waves-effect yellow darken-3 white-text" type="submit" id="action" name="action"><i class="material-icons right">email</i>Enviar código</button>
                            </div>
                        </div>
                        <div class="row">
                            <!--Estableciendo el tamaño del que tomará el Input field-->
                            <div class="input-field col s12">
                                <p class="justificado">Se enviará un código de confirmación al correo electrónico
                                    asociado a esta cuenta, por favor revisa tu bandeja de entrada y procede a cambiar
                                    tu contraseña.
                                </p>
                            </div>
                        </div>
                </form>
                <form method="post" id="save-form2" name="save-form2" enctype="multipart/form-data" class="col-md-4">
                <input class="hide" type="text" id="usuario2" name="usuario2" />
                    <div class="row">
                        <!--Estableciendo el tamaño del que tomará el Input field-->
                        <div class="input-field col s12 m6">
                            <input id="codigo" name="codigo" type="text" class="validate"  autocomplete="off" maxlength="5" required>
                            <label for="usuario">Ingrese el código de confirmación:</label>
                        </div>
                    </div>
                    <div class="row">
                        <!--Estableciendo el tamaño del que tomará el Input field-->
                        <div class="input-field col s12 m6">
                            <input id="pass1" name="pass1" type="password" class="validate"  autocomplete="off" maxlength="16" required>
                            <label for="usuario">Nueva contraseña:</label>
                        </div>
                        <!--Estableciendo el tamaño del que tomará el Input field-->
                        <div class="input-field col s12 m6">
                            <input id="pass2" name="pass2" type="password"  autocomplete="off" class="validate">
                            <label for="usuario">Confirmar contraseña:</label>
                        </div>
                        <!--Estableciendo el tamaño del que tomará el Input field-->
                        <div class="input-field col s12 m6">
                        <button class="btn waves-effect yellow darken-3 white-text" type="submit" id="cambiar" name="cambiar"><i class="material-icons right">save</i>Guardar contraseña</button>
                        </div>
                    </div>
            </div>
            </form>

        </div>
    </div>
</div>
</div>
</div>
<br>
<br>
<br>
<?php
//Se imprime la plantilla del pie y se envía el nombre del controlador para la página web
Dashboard_Page::footerTemplate('recu_contra.js');
?>