<?php
include("../app/helpers/dashboard.php");
Dashboard_Page::headerTemplate('libreria');
?>
<br>
<div class="row container">
    <div class="col s12">
        <div class="card white">
            <!--Defiendo el contenido de la card que contendrá las gráficas-->
            <div class="card-content black-text">
                <!--Definiendo el nombre del encabezado-->
                <h3 class="center-align Titulos yellow-text text-darken-3">Benvenido Usuario - Gerente</h3>
                <h5 class="center-align Text">Estas son las novedades:</h5>
                <!--Definiendo el panel número 1 para almacenar las gráficas-->
                <!--En este caso solo son imagenes-->
            </div>
        </div>
        <div class="col s12 m12">
            <div class="card-panel white">
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
    </div>
</div>

<?php
//Se imprime la plantilla del pie y se envía el nombre del controlador para la página web
Dashboard_Page::footerTemplate();
?>