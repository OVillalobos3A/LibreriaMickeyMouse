<?php
// Se incluye la clase con las plantillas del documento.
require_once('../app/helpers/dashboard.php');
// Se imprime la plantilla del encabezado enviando el título de la página web.
Dashboard_Page::headerTemplate('libreria');
?>
<body>
    <div class="row login">
        <div class="col s12 m14 offset-s14">
            <div class="card ">
            <a class="waves-effect yellow darken-3 white-text btn" href="../views/index.php">
                    <i class="material-icons left">arrow_back</i>Login
                </a>
                <div class="card-action center-align">
                    <h4>Recuperación por medio de correo</h4>
                </div>
                <div class="card-content">
                    <form method="post" id="email-form">
                        <div class="form-field">
                            <label for="correo">Correo electrónico</label>
                            <input id="correo" type="text" name="correo" class="validate" autocomplete="off" required>
                        </div><br>
                        <div class="form-field">
                            <label for="codigo">Código</label>
                            <input id="codigo" type="number" name="codigo" class="validate" autocomplete="off" disabled required>
                        </div><br>
                    </form>
                    <div class="form-field center-align">
                        <button onclick="enviarCorreo()" class="button btn waves-effect yellow darken-3 white-text"><span>Enviar código</span>
                        <i class="material-icons right">send</i>
                    </button>
                    </div> 
                </div>
            </div>
        </div>
    </div>
    </div>
</body>
<?php
// Se imprime la plantilla del pie enviando el nombre del controlador para la página web.
Dashboard_Page::footerTemplate('restaurar.js',null);
?>