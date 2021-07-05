<?php
//Clase para definir la plantilla  del dasboard
class Dashboard_Page {
  //Método para imprimir el encabezado y establecer el titulo del documento
  public static function headerTemplate($title) {
    print('
      <!DOCTYPE html>
      <html lang="es">
        <head>
          <meta charset="utf-8">
          <!--Importar Google Icon Font-->
          <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">  
          <!--Importar materialize.css-->
          <link type="text/css" rel="stylesheet" href="../resources/css/materialize.css"  media="screen,projection"/>          
          <!--Importar css propio-->   
          <link type="text/css" rel="stylesheet" href="../resources/css/libreria.css"/>
          <!--Css Extras-->
          <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
          <link type="text/css" rel="stylesheet"  href="../resources/extras/noUiSlider-14.6.3/distribute/nouislider.css">
          <!--Para que sea resposivo-->
          <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
          <title>Libreria</title>
        </head>
        <body class="black">  
        <main>
   ');
  }

  //Método para imprimir el pie y establecer el controlador del documento
  public static function footerTemplate() {
    print('
        </main>
        <footer class="page-footer black">
          <div class="footer-copyright">
            <div class="container center">
            © 2021 Administración de libreria Mickey Mouse
            </div>
          </div>    
        </footer>  
        <!--JavaScript at end of body for optimized loading-->
        <script type="text/javascript" src="../resources/js/materialize.js"></script> 
        <script type="text/javascript" src="../app/controllers/libreria.js"></script> 
        <script type="text/javascript" src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>   
        <script src="../app/controllers/'.$controller.'"></script>
      </body>
    </html>
   ');
  }
}
?>