<?php
//Clase para definir la plantilla  del dasboard
class Dashboard_Page {
    
  //Método para imprimir el encabezado y establecer el titulo del documento
  public static function headerTemplate($title) {
    // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en las páginas web.
    session_start();
    // Se imprime el código HTML de la cabecera del documento.
    print('
      <!DOCTYPE html>
        <html lang="es">
          <head>
            <meta charset="utf-8">
            <!--Importar Google Icon Font-->
            <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">  
            <!--Importar jquery-->   
            <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
            <!--Importar DataTable-->   
            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">  
            <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
            <!--Importar materialize.css-->
            <link type="text/css" rel="stylesheet" href="../resources/css/materialize.css"  media="screen,projection"/>          
            <!--Importar css propio-->   
            <link type="text/css" rel="stylesheet" href="../resources/css/libreria.css"/>            
            <!--Para que sea resposivo-->
            <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
            <title>'. $title .'</title>
          </head>
      
          <body class="black"> 
    ');

    // Se obtiene el nombre del archivo de la página web actual.
    $filename = basename($_SERVER['PHP_SELF']);
    // Se comprueba si existe una sesión de administrador para mostrar el menú de opciones, de lo contrario se muestra un menú vacío.
    if (isset($_SESSION['id_usuario'])) {
        // Se verifica si la página web actual es diferente a index.php (Iniciar sesión) y a register.php (Crear primer usuario) para no iniciar sesión otra vez, de lo contrario se direcciona a main.php
        if ($filename != 'index.php' && $filename != 'register.php' && $filename != 'primer_uso.php' && $filename != 'changepass.php' && $filename != 'autenticacion.php') {
            if (isset($_SESSION['tipo'])) {
                if ($_SESSION['tipo']==1) {
                        // Se llama al método que contiene el código de las cajas de dialogo (modals).
                    self::modals();
                    // Se imprime el código HTML para el encabezado del documento con el menú de opciones.
                    print('
                    <ul id="DropdownAdmin" class="dropdown-content">
                        <li><a href="proveedor.php" class="Titulos grey-text text-darken-4">Proveedores</a></li>
                        <li><a href="marca.php" class="Titulos grey-text text-darken-4">Marcas</a></li>
                    </ul>

                    <ul id="DropdownEmpleados" class="dropdown-content">
                        <li><a href="empleados.php" class="Titulos grey-text text-darken-4">Empleados</a></li>
                        <li><a href="usuarios.php" class="Titulos grey-text text-darken-4">Usuarios</a></li>
                        <li><a href="permisos.php" class="Titulos grey-text text-darken-4">Permisos</a></li>
                    </ul>

                    <ul id="DropdownHistorial" class="dropdown-content">
                        <li><a href="historial.php" class="Titulos grey-text text-darken-4">Facturas</a></li>
                        <li><a href="entradas.php" class="Titulos grey-text text-darken-4">Entradas</a></li>
                    </ul>

                    <ul id="DropdownSesion" class="dropdown-content">
                        <li><a href="login.php" class="Titulos grey-text text-darken-4">Facturas</a></li>
                    </ul>
                
                    <!--Navbar fijo-->
                    <div class="navbar-fixed">
                        <!--Navbar-->
                        <nav class="navbar-transition cool-navbar z-depth-0 nv"role="navigation">
                        <!--Anterior: red accent-4-->
                        <div class="nav-wrapper black valing-wrapper">
                            <a href="graficas.php" class="pad-nav brand-logo white-text Titulos pad-nav"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                            width="48" height="48"
                            viewBox="0 0 172 172"
                            style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><path d="M86,146.2c-33.24754,0 -60.2,-26.95246 -60.2,-60.2v0c0,-33.24754 26.95246,-60.2 60.2,-60.2h0c33.24754,0 60.2,26.95246 60.2,60.2v0c0,33.24754 -26.95246,60.2 -60.2,60.2z" fill="#ffffff"></path><g fill="#000000"><path d="M108.21667,112.15833h-12.9c-1.97943,0 -3.58333,-1.6039 -3.58333,-3.58333v-12.9c0,-1.58383 -1.28283,-2.86667 -2.86667,-2.86667h-5.73333c-1.58383,0 -2.86667,1.28283 -2.86667,2.86667v12.9c0,1.97943 -1.6039,3.58333 -3.58333,3.58333h-12.9c-1.97943,0 -3.58333,-1.6039 -3.58333,-3.58333v-27.35803c0,-3.29523 1.51073,-6.40843 4.0979,-8.44663l20.37053,-16.0519c0.78117,-0.61347 1.88197,-0.61347 2.6617,0l20.3734,16.0519c2.58717,2.0382 4.09647,5.14997 4.09647,8.44377v27.3609c0,1.97943 -1.6039,3.58333 -3.58333,3.58333z"></path></g></g></svg>
                            </a>
                            
                            <a href="#" data-target="mobile-demo" class="sidenav-trigger black-text"><i class="material-icons">menu</i></a>
                            <ul class="right hide-on-med-and-down">

                            <li><a href="inventario.php" id="inv" class="Subtitulos white-text">Inventario<i class="right valign-wrapper"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                            width="30" height="30"
                            viewBox="0 0 172 172"
                            style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><path d="M86,172c-47.49649,0 -86,-38.50351 -86,-86v0c0,-47.49649 38.50351,-86 86,-86v0c47.49649,0 86,38.50351 86,86v0c0,47.49649 -38.50351,86 -86,86z" fill="#ffffff"></path><g fill="#000000"><path d="M123.26667,140.46667l-37.26667,-17.2l-37.26667,17.2v-97.46667c0,-6.30667 5.16,-11.46667 11.46667,-11.46667h51.6c6.30667,0 11.46667,5.16 11.46667,11.46667z"></path></g></g></svg></i></a></li>
                
                            <li><a href="#!" id="adm" class="Subtitulos white-text dropdown-trigger" data-target="DropdownAdmin">Administración<i class="right valign-wrapper"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                            width="30" height="30"
                            viewBox="0 0 172 172"
                            style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><path d="M86,172c-47.49649,0 -86,-38.50351 -86,-86v0c0,-47.49649 38.50351,-86 86,-86v0c47.49649,0 86,38.50351 86,86v0c0,47.49649 -38.50351,86 -86,86z" fill="#ffffff"></path><g><path d="M129,53.75h-48.375l-10.75,-10.75h-26.875c-5.9125,0 -10.75,4.8375 -10.75,10.75v21.5h107.5v-10.75c0,-5.9125 -4.8375,-10.75 -10.75,-10.75z" fill="#333333"></path><path d="M129,53.75h-86c-5.9125,0 -10.75,4.8375 -10.75,10.75v53.75c0,5.9125 4.8375,10.75 10.75,10.75h86c5.9125,0 10.75,-4.8375 10.75,-10.75v-53.75c0,-5.9125 -4.8375,-10.75 -10.75,-10.75z" fill="#000000"></path></g></g></svg></i></a></li>
                                
                            <li><a href="#!" id="usr" class="Subtitulos white-text dropdown-trigger" data-target="DropdownEmpleados">Empleados<i class="right valign-wrapper"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                            width="30" height="30"
                            viewBox="0 0 172 172"
                            style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><path d="M86,172c-47.49649,0 -86,-38.50351 -86,-86v0c0,-47.49649 38.50351,-86 86,-86v0c47.49649,0 86,38.50351 86,86v0c0,47.49649 -38.50351,86 -86,86z" fill="#ffffff"></path><g><path d="M140.18,114.38c0,5.69664 -4.62078,10.32 -10.32,10.32h-87.72c-5.69922,0 -10.32,-4.62336 -10.32,-10.32v-56.76c0,-5.7018 4.62078,-10.32 10.32,-10.32h87.72c5.69922,0 10.32,4.6182 10.32,10.32z" fill="#000000"></path><path d="M73.1,78.26c0,5.69664 -4.62078,10.32 -10.32,10.32c-5.69922,0 -10.32,-4.62336 -10.32,-10.32c0,-5.69922 4.62078,-10.32 10.32,-10.32c5.69922,0 10.32,4.62078 10.32,10.32M80.84,101.48c0,0 -5.00004,-7.74 -18.06,-7.74c-13.06512,0 -18.06,7.74 -18.06,7.74v5.16h36.12zM127.28,70.52h-38.7v5.16h38.7zM127.28,83.42h-38.7v5.16h38.7zM109.22,96.32h-20.64v5.16h20.64z" fill="#ffffff"></path></g></g></svg></i></a></li>
                                
                            <li><a href="venta.php" id="vnt" class="Subtitulos white-text">Venta<i class="right valign-wrapper"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                            width="30" height="30"
                            viewBox="0 0 172 172"
                            style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><path d="M86,172c-47.49649,0 -86,-38.50351 -86,-86v0c0,-47.49649 38.50351,-86 86,-86v0c47.49649,0 86,38.50351 86,86v0c0,47.49649 -38.50351,86 -86,86z" fill="#ffffff"></path><g><path d="M122.61254,82.29604l-12.63589,-35.37323h-47.9533l-12.6331,35.37323l-10.51456,-3.75699l13.95614,-39.07719c0.79271,-2.22182 2.89729,-3.70396 5.25588,-3.70396h55.82456c2.35859,0 4.46317,1.48214 5.25588,3.70396l13.95614,39.07719z" fill="#000000"></path><path d="M123.40246,139.03333h-74.80491c-2.79123,0 -5.02421,-1.95386 -5.58246,-4.46596l-10.04842,-51.3586h106.06667l-10.32754,51.3586c-0.55825,2.51211 -2.79123,4.46596 -5.30333,4.46596z" fill="#000000"></path><path d="M139.03333,88.79123h-106.06667c-3.07035,0 -5.58246,-2.51211 -5.58246,-5.58246v-5.58246c0,-3.07035 2.51211,-5.58246 5.58246,-5.58246h106.06667c3.07035,0 5.58246,2.51211 5.58246,5.58246v5.58246c0,3.07035 -2.51211,5.58246 -5.58246,5.58246z" fill="#000000"></path><path d="M86,97.16491v0c-1.54076,0 -2.79123,1.25047 -2.79123,2.79123v27.91228c0,1.67474 1.11649,2.79123 2.79123,2.79123c1.67474,0 2.79123,-1.11649 2.79123,-2.79123v-27.91228c0,-1.54076 -1.25047,-2.79123 -2.79123,-2.79123zM97.16491,97.16491v0c-1.54076,0 -2.79123,1.25047 -2.79123,2.79123v27.91228c0,1.67474 1.11649,2.79123 2.79123,2.79123c1.67474,0 2.79123,-1.11649 2.79123,-2.79123v-27.91228c0,-1.54076 -1.25047,-2.79123 -2.79123,-2.79123zM108.32982,97.16491v0c-1.54076,0 -2.79123,1.25047 -2.79123,2.79123v27.91228c0,1.67474 1.11649,2.79123 2.79123,2.79123c1.67474,0 2.79123,-1.11649 2.79123,-2.79123v-27.91228c0,-1.54076 -1.25047,-2.79123 -2.79123,-2.79123zM63.67018,97.16491v0c-1.54076,0 -2.79123,1.25047 -2.79123,2.79123v27.91228c0,1.67474 1.11649,2.79123 2.79123,2.79123c1.67474,0 2.79123,-1.11649 2.79123,-2.79123v-27.91228c0,-1.54076 -1.25047,-2.79123 -2.79123,-2.79123zM74.83509,97.16491v0c-1.54076,0 -2.79123,1.25047 -2.79123,2.79123v27.91228c0,1.67474 1.11649,2.79123 2.79123,2.79123c1.67474,0 2.79123,-1.11649 2.79123,-2.79123v-27.91228c0,-1.54076 -1.25047,-2.79123 -2.79123,-2.79123z" fill="#ffffff"></path><path d="M99.95614,49.71404h-27.91228c-1.54076,0 -2.79123,-1.25047 -2.79123,-2.79123v-11.16491c0,-1.54076 1.25047,-2.79123 2.79123,-2.79123h27.91228c1.54076,0 2.79123,1.25047 2.79123,2.79123v11.16491c0,1.54076 -1.25047,2.79123 -2.79123,2.79123z" fill="#000000"></path></g></g></svg></i></a></li>
                
                            <li><a href="#!" id="htr" class="Subtitulos white-text dropdown-trigger" data-target="DropdownHistorial">Historiales<i class="right valign-wrapper"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                            width="30" height="30"
                            viewBox="0 0 172 172"
                            style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><path d="M86,172c-47.49649,0 -86,-38.50351 -86,-86v0c0,-47.49649 38.50351,-86 86,-86v0c47.49649,0 86,38.50351 86,86v0c0,47.49649 -38.50351,86 -86,86z" fill="#ffffff"></path><g><path d="M37.26667,84.56667c0,26.94667 21.78667,48.73333 48.73333,48.73333c26.94667,0 48.73333,-21.78667 48.73333,-48.73333c0,-26.94667 -21.78667,-48.73333 -48.73333,-48.73333c-26.94667,0 -48.73333,21.78667 -48.73333,48.73333" fill="#ffffff"></path><path d="M86,141.9c-31.53333,0 -57.33333,-25.8 -57.33333,-57.33333c0,-31.53333 25.8,-57.33333 57.33333,-57.33333c13.47333,0 26.66,4.87333 36.98,13.76l-7.45333,8.6c-8.02667,-7.16667 -18.63333,-10.89333 -29.52667,-10.89333c-25.22667,0 -45.86667,20.64 -45.86667,45.86667c0,25.22667 20.64,45.86667 45.86667,45.86667z" fill="#cccccc"></path><path d="M86,141.9c-31.53333,0 -57.33333,-25.8 -57.33333,-57.33333c0,-13.47333 4.87333,-26.66 13.76,-36.98l8.6,7.45333c-7.16667,8.02667 -10.89333,18.63333 -10.89333,29.52667c0,25.22667 20.64,45.86667 45.86667,45.86667c25.22667,0 45.86667,-20.64 45.86667,-45.86667c0,-25.22667 -20.64,-45.86667 -45.86667,-45.86667v-11.46667c31.53333,0 57.33333,25.8 57.33333,57.33333c0,31.53333 -25.8,57.33333 -57.33333,57.33333z" fill="#000000"></path><path d="M94.6,50.16667l-22.93333,-17.2l22.93333,-17.2z" fill="#000000"></path><path d="M68.8,58.76667l5.16,-2.58l14.62,27.23333l-5.16,2.58z" fill="#000000"></path><path d="M83.70667,82.27333l4.87333,4.87333l-14.90667,14.62l-4.87333,-4.87333z" fill="#000000"></path><path d="M80.26667,84.56667c0,3.15333 2.58,5.73333 5.73333,5.73333c3.15333,0 5.73333,-2.58 5.73333,-5.73333c0,-3.15333 -2.58,-5.73333 -5.73333,-5.73333c-3.15333,0 -5.73333,2.58 -5.73333,5.73333" fill="#000000"></path><path d="M83.13333,84.56667c0,1.72 1.14667,2.86667 2.86667,2.86667c1.72,0 2.86667,-1.14667 2.86667,-2.86667c0,-1.72 -1.14667,-2.86667 -2.86667,-2.86667c-1.72,0 -2.86667,1.14667 -2.86667,2.86667" fill="#000000"></path></g></g></svg></i></a></li>

                            <li><a  onclick="logOut()" class="Subtitulos white-text">Cerrar Sesión<i class="right valign-wrapper"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                            width="30" height="30"
                            viewBox="0 0 172 172"
                            style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g><path d="M86,14.33333c-39.58041,0 -71.66667,32.08626 -71.66667,71.66667c0,39.58041 32.08626,71.66667 71.66667,71.66667c39.58041,0 71.66667,-32.08626 71.66667,-71.66667c0,-39.58041 -32.08626,-71.66667 -71.66667,-71.66667z" fill="#ffffff"></path><path d="M86,157.66667c16.125,0 30.81667,-5.375 42.64167,-14.33333c-2.15,-27.23333 -29.38333,-32.25 -29.38333,-32.25l-13.25833,2.86667l-13.25833,-2.86667c0,0 -27.23333,5.01667 -29.38333,32.25c11.825,8.95833 26.51667,14.33333 42.64167,14.33333z" fill="#000000"></path><path d="M86,132.58333c11.10833,0 20.06667,-8.24167 21.14167,-18.99167c-3.225,-1.43333 -5.73333,-2.15 -7.16667,-2.50833c0,7.88333 -6.45,13.975 -14.33333,13.975c-7.88333,0 -14.33333,-6.45 -14.33333,-13.975c-1.43333,0.35833 -3.94167,1.075 -7.16667,2.50833c1.79167,10.75 10.75,18.99167 21.85833,18.99167z" fill="#000000"></path><path d="M114.66667,80.625c0,2.86667 -2.50833,5.375 -5.375,5.375c-2.86667,0 -5.375,-2.50833 -5.375,-5.375c0,-2.86667 2.50833,-5.375 5.375,-5.375c2.86667,0 5.375,2.50833 5.375,5.375M68.08333,80.625c0,-2.86667 -2.50833,-5.375 -5.375,-5.375c-2.86667,0 -5.375,2.50833 -5.375,5.375c0,2.86667 2.50833,5.375 5.375,5.375c2.86667,0 5.375,-2.50833 5.375,-5.375" fill="#000000"></path><path d="M86,125.41667c-14.33333,0 -14.33333,-14.33333 -14.33333,-14.33333v-14.33333h28.66667v14.33333c0,0 0,14.33333 -14.33333,14.33333z" fill="#000000"></path><path d="M111.08333,67.00833c0,-21.14167 -50.16667,-13.61667 -50.16667,0v15.76667c0,13.61667 11.10833,24.725 25.08333,24.725c13.975,0 25.08333,-11.10833 25.08333,-24.725z" fill="#000000"></path><path d="M86,39.41667c-17.55833,0 -28.66667,15.40833 -28.66667,29.38333v6.45l7.16667,7.16667v-14.33333l32.96667,-10.75l10.03333,10.75v14.33333l7.16667,-7.16667v-2.86667c0,-11.46667 -2.86667,-24.36667 -17.2,-27.23333l-2.86667,-5.73333z" fill="#000000"></path><path d="M93.16667,78.83333c0,-2.15 1.43333,-3.58333 3.58333,-3.58333c2.15,0 3.58333,1.43333 3.58333,3.58333c0,2.15 -1.43333,3.58333 -3.58333,3.58333c-2.15,0 -3.58333,-1.43333 -3.58333,-3.58333M71.66667,78.83333c0,2.15 1.43333,3.58333 3.58333,3.58333c2.15,0 3.58333,-1.43333 3.58333,-3.58333c0,-2.15 -1.43333,-3.58333 -3.58333,-3.58333c-2.15,0 -3.58333,1.43333 -3.58333,3.58333" fill="#000000"></path></g></g></svg></i></a></li>
                            </ul>
                        </div>
                        </nav>  
                    </div>

                    <!--Navbar "Hamburguesa"-->
                    <ul class="sidenav" id="mobile-demo"> 
                        <li><a href="inventario.php" class="Subtitulos">Inventario<i class="left valign-wrapper"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                        width="100" height="100"
                        viewBox="0 0 172 172"
                        style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><path d="M86,172c-47.49649,0 -86,-38.50351 -86,-86v0c0,-47.49649 38.50351,-86 86,-86v0c47.49649,0 86,38.50351 86,86v0c0,47.49649 -38.50351,86 -86,86z" fill="#000000"></path><g fill="#ffffff"><path d="M123.26667,140.46667l-37.26667,-17.2l-37.26667,17.2v-97.46667c0,-6.30667 5.16,-11.46667 11.46667,-11.46667h51.6c6.30667,0 11.46667,5.16 11.46667,11.46667z"></path></g></g></svg></i></a></li>
                
                        <li><a href="#!" class="Subtitulos dropdown-trigger" data-target="DropdownAdmin">Administración<i class="left valign-wrapper"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                        width="100" height="100"
                        viewBox="0 0 172 172"
                        style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><path d="M86,172c-47.49649,0 -86,-38.50351 -86,-86v0c0,-47.49649 38.50351,-86 86,-86v0c47.49649,0 86,38.50351 86,86v0c0,47.49649 -38.50351,86 -86,86z" fill="#000000"></path><g><path d="M129,53.75h-48.375l-10.75,-10.75h-26.875c-5.9125,0 -10.75,4.8375 -10.75,10.75v21.5h107.5v-10.75c0,-5.9125 -4.8375,-10.75 -10.75,-10.75z" fill="#cccccc"></path><path d="M129,53.75h-86c-5.9125,0 -10.75,4.8375 -10.75,10.75v53.75c0,5.9125 4.8375,10.75 10.75,10.75h86c5.9125,0 10.75,-4.8375 10.75,-10.75v-53.75c0,-5.9125 -4.8375,-10.75 -10.75,-10.75z" fill="#ffffff"></path></g></g></svg></i></a></li>
                            
                        <li><a href="#!" class="Subtitulos dropdown-trigger" data-target="DropdownEmpleados">Empleados<i class="left valign-wrapper"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                        width="100" height="100"
                        viewBox="0 0 172 172"
                        style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><path d="M86,172c-47.49649,0 -86,-38.50351 -86,-86v0c0,-47.49649 38.50351,-86 86,-86v0c47.49649,0 86,38.50351 86,86v0c0,47.49649 -38.50351,86 -86,86z" fill="#000000"></path><g><path d="M140.18,114.38c0,5.69664 -4.62078,10.32 -10.32,10.32h-87.72c-5.69922,0 -10.32,-4.62336 -10.32,-10.32v-56.76c0,-5.7018 4.62078,-10.32 10.32,-10.32h87.72c5.69922,0 10.32,4.6182 10.32,10.32z" fill="#ffffff"></path><path d="M73.1,78.26c0,5.69664 -4.62078,10.32 -10.32,10.32c-5.69922,0 -10.32,-4.62336 -10.32,-10.32c0,-5.69922 4.62078,-10.32 10.32,-10.32c5.69922,0 10.32,4.62078 10.32,10.32M80.84,101.48c0,0 -5.00004,-7.74 -18.06,-7.74c-13.06512,0 -18.06,7.74 -18.06,7.74v5.16h36.12zM127.28,70.52h-38.7v5.16h38.7zM127.28,83.42h-38.7v5.16h38.7zM109.22,96.32h-20.64v5.16h20.64z" fill="#000000"></path></g></g></svg></i></a></li>
                                
                        <li><a href="venta.php" class="Subtitulos">Venta<i class="left valign-wrapper"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                        width="100" height="100"
                        viewBox="0 0 172 172"
                        style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><path d="M86,172c-47.49649,0 -86,-38.50351 -86,-86v0c0,-47.49649 38.50351,-86 86,-86v0c47.49649,0 86,38.50351 86,86v0c0,47.49649 -38.50351,86 -86,86z" fill="#000000"></path><g><path d="M122.61254,82.29604l-12.63589,-35.37323h-47.9533l-12.6331,35.37323l-10.51456,-3.75699l13.95614,-39.07719c0.79271,-2.22182 2.89729,-3.70396 5.25588,-3.70396h55.82456c2.35859,0 4.46317,1.48214 5.25588,3.70396l13.95614,39.07719z" fill="#ffffff"></path><path d="M123.40246,139.03333h-74.80491c-2.79123,0 -5.02421,-1.95386 -5.58246,-4.46596l-10.04842,-51.3586h106.06667l-10.32754,51.3586c-0.55825,2.51211 -2.79123,4.46596 -5.30333,4.46596z" fill="#ffffff"></path><path d="M139.03333,88.79123h-106.06667c-3.07035,0 -5.58246,-2.51211 -5.58246,-5.58246v-5.58246c0,-3.07035 2.51211,-5.58246 5.58246,-5.58246h106.06667c3.07035,0 5.58246,2.51211 5.58246,5.58246v5.58246c0,3.07035 -2.51211,5.58246 -5.58246,5.58246z" fill="#ffffff"></path><path d="M86,97.16491v0c-1.54076,0 -2.79123,1.25047 -2.79123,2.79123v27.91228c0,1.67474 1.11649,2.79123 2.79123,2.79123c1.67474,0 2.79123,-1.11649 2.79123,-2.79123v-27.91228c0,-1.54076 -1.25047,-2.79123 -2.79123,-2.79123zM97.16491,97.16491v0c-1.54076,0 -2.79123,1.25047 -2.79123,2.79123v27.91228c0,1.67474 1.11649,2.79123 2.79123,2.79123c1.67474,0 2.79123,-1.11649 2.79123,-2.79123v-27.91228c0,-1.54076 -1.25047,-2.79123 -2.79123,-2.79123zM108.32982,97.16491v0c-1.54076,0 -2.79123,1.25047 -2.79123,2.79123v27.91228c0,1.67474 1.11649,2.79123 2.79123,2.79123c1.67474,0 2.79123,-1.11649 2.79123,-2.79123v-27.91228c0,-1.54076 -1.25047,-2.79123 -2.79123,-2.79123zM63.67018,97.16491v0c-1.54076,0 -2.79123,1.25047 -2.79123,2.79123v27.91228c0,1.67474 1.11649,2.79123 2.79123,2.79123c1.67474,0 2.79123,-1.11649 2.79123,-2.79123v-27.91228c0,-1.54076 -1.25047,-2.79123 -2.79123,-2.79123zM74.83509,97.16491v0c-1.54076,0 -2.79123,1.25047 -2.79123,2.79123v27.91228c0,1.67474 1.11649,2.79123 2.79123,2.79123c1.67474,0 2.79123,-1.11649 2.79123,-2.79123v-27.91228c0,-1.54076 -1.25047,-2.79123 -2.79123,-2.79123z" fill="#000000"></path><path d="M99.95614,49.71404h-27.91228c-1.54076,0 -2.79123,-1.25047 -2.79123,-2.79123v-11.16491c0,-1.54076 1.25047,-2.79123 2.79123,-2.79123h27.91228c1.54076,0 2.79123,1.25047 2.79123,2.79123v11.16491c0,1.54076 -1.25047,2.79123 -2.79123,2.79123z" fill="#ffffff"></path></g></g></svg></i></a></li>
                
                        <li><a href="#!" class="Subtitulos dropdown-trigger" data-target="DropdownHistorial">Historiales<i class="left valign-wrapper"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                        width="100" height="100"
                        viewBox="0 0 172 172"
                        style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><path d="M86,172c-47.49649,0 -86,-38.50351 -86,-86v0c0,-47.49649 38.50351,-86 86,-86v0c47.49649,0 86,38.50351 86,86v0c0,47.49649 -38.50351,86 -86,86z" fill="#000000"></path><g><path d="M37.26667,84.56667c0,26.94667 21.78667,48.73333 48.73333,48.73333c26.94667,0 48.73333,-21.78667 48.73333,-48.73333c0,-26.94667 -21.78667,-48.73333 -48.73333,-48.73333c-26.94667,0 -48.73333,21.78667 -48.73333,48.73333" fill="#000000"></path><path d="M86,141.9c-31.53333,0 -57.33333,-25.8 -57.33333,-57.33333c0,-31.53333 25.8,-57.33333 57.33333,-57.33333c13.47333,0 26.66,4.87333 36.98,13.76l-7.45333,8.6c-8.02667,-7.16667 -18.63333,-10.89333 -29.52667,-10.89333c-25.22667,0 -45.86667,20.64 -45.86667,45.86667c0,25.22667 20.64,45.86667 45.86667,45.86667z" fill="#333333"></path><path d="M86,141.9c-31.53333,0 -57.33333,-25.8 -57.33333,-57.33333c0,-13.47333 4.87333,-26.66 13.76,-36.98l8.6,7.45333c-7.16667,8.02667 -10.89333,18.63333 -10.89333,29.52667c0,25.22667 20.64,45.86667 45.86667,45.86667c25.22667,0 45.86667,-20.64 45.86667,-45.86667c0,-25.22667 -20.64,-45.86667 -45.86667,-45.86667v-11.46667c31.53333,0 57.33333,25.8 57.33333,57.33333c0,31.53333 -25.8,57.33333 -57.33333,57.33333z" fill="#ffffff"></path><path d="M94.6,50.16667l-22.93333,-17.2l22.93333,-17.2z" fill="#ffffff"></path><path d="M68.8,58.76667l5.16,-2.58l14.62,27.23333l-5.16,2.58z" fill="#ffffff"></path><path d="M83.70667,82.27333l4.87333,4.87333l-14.90667,14.62l-4.87333,-4.87333z" fill="#ffffff"></path><path d="M80.26667,84.56667c0,3.15333 2.58,5.73333 5.73333,5.73333c3.15333,0 5.73333,-2.58 5.73333,-5.73333c0,-3.15333 -2.58,-5.73333 -5.73333,-5.73333c-3.15333,0 -5.73333,2.58 -5.73333,5.73333" fill="#ffffff"></path><path d="M83.13333,84.56667c0,1.72 1.14667,2.86667 2.86667,2.86667c1.72,0 2.86667,-1.14667 2.86667,-2.86667c0,-1.72 -1.14667,-2.86667 -2.86667,-2.86667c-1.72,0 -2.86667,1.14667 -2.86667,2.86667" fill="#ffffff"></path></g></g></svg></i></a></li>
                                
                        <li><a href="" class="Subtitulos dropdown-trigger" data-target="DropdownSesion">Usuario<i class="left valign-wrapper"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                        width="100" height="100"
                        viewBox="0 0 172 172"
                        style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g><path d="M86,14.33333c-39.58041,0 -71.66667,32.08626 -71.66667,71.66667c0,39.58041 32.08626,71.66667 71.66667,71.66667c39.58041,0 71.66667,-32.08626 71.66667,-71.66667c0,-39.58041 -32.08626,-71.66667 -71.66667,-71.66667z" fill="#000000"></path><path d="M86,157.66667c16.125,0 30.81667,-5.375 42.64167,-14.33333c-2.15,-27.23333 -29.38333,-32.25 -29.38333,-32.25l-13.25833,2.86667l-13.25833,-2.86667c0,0 -27.23333,5.01667 -29.38333,32.25c11.825,8.95833 26.51667,14.33333 42.64167,14.33333z" fill="#ffffff"></path><path d="M86,132.58333c11.10833,0 20.06667,-8.24167 21.14167,-18.99167c-3.225,-1.43333 -5.73333,-2.15 -7.16667,-2.50833c0,7.88333 -6.45,13.975 -14.33333,13.975c-7.88333,0 -14.33333,-6.45 -14.33333,-13.975c-1.43333,0.35833 -3.94167,1.075 -7.16667,2.50833c1.79167,10.75 10.75,18.99167 21.85833,18.99167z" fill="#ffffff"></path><path d="M114.66667,80.625c0,2.86667 -2.50833,5.375 -5.375,5.375c-2.86667,0 -5.375,-2.50833 -5.375,-5.375c0,-2.86667 2.50833,-5.375 5.375,-5.375c2.86667,0 5.375,2.50833 5.375,5.375M68.08333,80.625c0,-2.86667 -2.50833,-5.375 -5.375,-5.375c-2.86667,0 -5.375,2.50833 -5.375,5.375c0,2.86667 2.50833,5.375 5.375,5.375c2.86667,0 5.375,-2.50833 5.375,-5.375" fill="#ffffff"></path><path d="M86,125.41667c-14.33333,0 -14.33333,-14.33333 -14.33333,-14.33333v-14.33333h28.66667v14.33333c0,0 0,14.33333 -14.33333,14.33333z" fill="#ffffff"></path><path d="M111.08333,67.00833c0,-21.14167 -50.16667,-13.61667 -50.16667,0v15.76667c0,13.61667 11.10833,24.725 25.08333,24.725c13.975,0 25.08333,-11.10833 25.08333,-24.725z" fill="#ffffff"></path><path d="M86,39.41667c-17.55833,0 -28.66667,15.40833 -28.66667,29.38333v6.45l7.16667,7.16667v-14.33333l32.96667,-10.75l10.03333,10.75v14.33333l7.16667,-7.16667v-2.86667c0,-11.46667 -2.86667,-24.36667 -17.2,-27.23333l-2.86667,-5.73333z" fill="#ffffff"></path><path d="M93.16667,78.83333c0,-2.15 1.43333,-3.58333 3.58333,-3.58333c2.15,0 3.58333,1.43333 3.58333,3.58333c0,2.15 -1.43333,3.58333 -3.58333,3.58333c-2.15,0 -3.58333,-1.43333 -3.58333,-3.58333M71.66667,78.83333c0,2.15 1.43333,3.58333 3.58333,3.58333c2.15,0 3.58333,-1.43333 3.58333,-3.58333c0,-2.15 -1.43333,-3.58333 -3.58333,-3.58333c-2.15,0 -3.58333,1.43333 -3.58333,3.58333" fill="#ffffff"></path></g></g></svg></i></a></li>
                    </ul>
                    <main>
                    ');
                }else {
                            // Se llama al método que contiene el código de las cajas de dialogo (modals).
                            self::modals();
                            // Se imprime el código HTML para el encabezado del documento con el menú de opciones.
                            print('
                        <ul id="DropdownAdmin" class="dropdown-content">
                            <li><a href="proveedor.php" class="Titulos grey-text text-darken-4">Proveedores</a></li>
                            <li><a href="marca.php" class="Titulos grey-text text-darken-4">Marcas</a></li>
                        </ul>

                        <ul id="DropdownEmpleados" class="dropdown-content">
                            <li><a href="empleados.php" class="Titulos grey-text text-darken-4">Empleados</a></li>
                            <li><a href="usuarios.php" class="Titulos grey-text text-darken-4">Usuarios</a></li>
                        </ul>

                        <ul id="DropdownHistorial" class="dropdown-content">
                            <li><a href="historial.php" class="Titulos grey-text text-darken-4">Facturas</a></li>
                            <li><a href="entradas.php" class="Titulos grey-text text-darken-4">Entradas</a></li>
                        </ul>

                        <ul id="DropdownSesion" class="dropdown-content">
                            <li><a href="login.php" class="Titulos grey-text text-darken-4">Facturas</a></li>
                        </ul>
                    
                        <!--Navbar fijo-->
                        <div class="navbar-fixed">
                            <!--Navbar-->
                            <nav class="navbar-transition cool-navbar z-depth-0 nv"role="navigation">
                            <!--Anterior: red accent-4-->
                            <div class="nav-wrapper black valing-wrapper">
                                <a href="graficas.php" class="pad-nav brand-logo white-text Titulos pad-nav"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                width="56" height="56"
                                viewBox="0 0 172 172"
                                style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="#d50000"></path><g><circle cx="78" cy="14" transform="scale(1.72,1.72)" r="1" fill="#d50000"></circle><circle cx="50" cy="50" transform="scale(1.72,1.72)" r="38" fill="#ffffff"></circle><circle cx="84" cy="16" transform="scale(1.72,1.72)" r="4" fill="#d50000"></circle><circle cx="14" cy="26" transform="scale(1.72,1.72)" r="2" fill="#d50000"></circle><circle cx="78" cy="77" transform="scale(1.72,1.72)" r="2" fill="#d50000"></circle><circle cx="17" cy="78" transform="scale(1.72,1.72)" r="4" fill="#d50000"></circle><circle cx="24" cy="83" transform="scale(1.72,1.72)" r="2" fill="#d50000"></circle><circle cx="66.483" cy="78.517" transform="scale(1.72,1.72)" r="2.483" fill="#d50000"></circle><circle cx="16" cy="48" transform="scale(1.72,1.72)" r="1" fill="#d50000"></circle><circle cx="86" cy="31" transform="scale(1.72,1.72)" r="1" fill="#d50000"></circle><circle cx="80" cy="66" transform="scale(1.72,1.72)" r="2" fill="#d50000"></circle><g fill="#000000"><path d="M128.41176,54.89552c-8.39016,-8.30932 -20.4078,-9.8814 -26.98336,-3.36948c-4.12284,4.08328 -5.03444,10.28388 -3.07536,16.3916c-3.79432,-1.58756 -7.96532,-2.46648 -12.34272,-2.46648c-4.3774,0 -8.5484,0.87892 -12.34272,2.46648c1.95908,-6.106 1.04748,-12.30832 -3.07536,-16.3916c-6.57556,-6.51364 -18.5932,-4.94156 -26.98336,3.36948c-8.39016,8.31104 -9.976,20.21344 -3.40044,26.72708c4.12284,4.08328 10.38364,4.98628 16.54812,3.04612c-1.60304,3.7582 -2.49056,7.88964 -2.49056,12.22576c0,17.36512 14.21236,31.44332 31.74432,31.44332c17.53196,0 31.74432,-14.0782 31.74432,-31.44332c0,-4.33612 -0.88752,-8.46756 -2.49056,-12.22576c6.16448,1.94016 12.42528,1.03716 16.54812,-3.04612c6.57728,-6.51364 4.98972,-18.41604 -3.40044,-26.72708z"></path><path d="M86,130.0578c-18.3524,0 -33.28372,-14.82468 -33.28372,-33.04808c0,-3.65328 0.59168,-7.21884 1.75956,-10.6296c-6.05956,1.25216 -11.7734,-0.17544 -15.61072,-3.98352c-2.92056,-2.8982 -4.46512,-6.80776 -4.46512,-11.30212c0,-6.11976 2.87928,-12.48892 7.90168,-17.4752c8.93368,-8.86832 21.92828,-10.3974 28.9648,-3.41076c3.83904,3.81152 5.27352,9.48236 4.01792,15.50408c6.87312,-2.32544 14.55636,-2.32544 21.42948,0c-1.2556,-6.02172 0.17888,-11.69256 4.01792,-15.50408c7.03824,-6.98664 20.03112,-5.45756 28.96308,3.41076v0c5.02412,4.98628 7.90512,11.35716 7.90512,17.4752c0,4.49436 -1.54284,8.4022 -4.46512,11.30212c-3.83732,3.8098 -9.54944,5.23396 -15.609,3.98352c1.16788,3.41076 1.75784,6.97632 1.75784,10.6296c0.00172,18.2234 -14.93132,33.04808 -33.28372,33.04808zM58.56772,82.69244l-1.0234,2.40628c-1.60648,3.77196 -2.42004,7.77956 -2.42004,11.911c0,16.89384 13.85116,30.63836 30.87572,30.63836c17.02456,0 30.87572,-13.74452 30.87572,-30.63836c0,-4.128 -0.81528,-8.1356 -2.42004,-11.911l-1.0234,-2.40456l2.49228,0.78432c6.0372,1.90232 11.83532,0.85828 15.5144,-2.79156c2.45616,-2.43724 3.75476,-5.75512 3.75476,-9.59244c0,-5.48336 -2.62128,-11.22816 -7.19304,-15.76552v0c-7.998,-7.94124 -19.46868,-9.47376 -25.57124,-3.41076c-3.67392,3.6464 -4.72484,9.39636 -2.80876,15.3768l0.79636,2.48884l-2.40972,-1.01136c-7.6024,-3.1906 -16.41396,-3.1906 -24.01636,0l-2.40972,1.01136l0.79636,-2.48884c1.91436,-5.98216 0.86344,-11.7304 -2.80876,-15.3768c-6.10084,-6.06128 -17.57324,-4.52876 -25.57124,3.41076c-4.57004,4.53736 -7.19132,10.28388 -7.19132,15.76552c0,3.83732 1.2986,7.1552 3.75476,9.59244c3.67736,3.65156 9.47548,4.6956 15.51268,2.79156z"></path><path d="M43.95288,77.68724c-0.10836,0 -0.21844,-0.04128 -0.30272,-0.12384c-1.91952,-1.90576 -2.32372,-4.41868 -2.32372,-6.192c0,-4.26216 2.2274,-9.01796 5.95808,-12.72112c2.107,-2.09152 4.58552,-3.73928 7.16552,-4.76612c0.21672,-0.086 0.46956,0.02064 0.559,0.2408c0.08772,0.22188 -0.02064,0.47128 -0.2408,0.559c-2.47336,0.98384 -4.85212,2.56796 -6.87656,4.57864c-3.57244,3.54664 -5.70524,8.07196 -5.70524,12.11052c0,1.60992 0.35776,3.88376 2.06916,5.57968c0.16856,0.16856 0.17028,0.44032 0.00172,0.60888c-0.08256,0.08428 -0.19264,0.12556 -0.30444,0.12556zM128.15032,77.02504c-0.11008,0 -0.22188,-0.04128 -0.30616,-0.12728c-0.16684,-0.16856 -0.16684,-0.44032 0.00344,-0.60888c1.66324,-1.6512 2.0124,-3.86484 2.0124,-5.43004c0,-3.9302 -2.07604,-8.34028 -5.55388,-11.79232c-2.07776,-2.06228 -4.52016,-3.65328 -7.06404,-4.601c-0.2236,-0.08256 -0.3354,-0.33024 -0.25284,-0.55212c0.08256,-0.2236 0.33368,-0.33712 0.55212,-0.25284c2.65912,0.989 5.20644,2.64708 7.3702,4.79536c3.63608,3.612 5.80844,8.2474 5.80844,12.40292c0,1.73032 -0.39388,4.18304 -2.26696,6.04236c-0.08428,0.08256 -0.19436,0.12384 -0.30272,0.12384zM67.66136,65.9534c-0.043,0 -0.08772,-0.00688 -0.13072,-0.02064c-0.22532,-0.07224 -0.35088,-0.31476 -0.27864,-0.54008c1.00276,-3.13384 0.91332,-6.05612 -0.25456,-8.2302c-0.1118,-0.20812 -0.0344,-0.46784 0.17544,-0.58136c0.21156,-0.1118 0.46956,-0.03612 0.58308,0.17544c1.27968,2.38048 1.3932,5.54012 0.3182,8.89928c-0.06192,0.18232 -0.23048,0.29756 -0.4128,0.29756zM105.04728,65.59048c-0.18232,0 -0.35088,-0.11524 -0.40936,-0.29928c-1.08532,-3.39012 -0.90988,-6.66328 0.4816,-8.98528c0.12212,-0.20296 0.38356,-0.2666 0.59168,-0.14792c0.20296,0.12212 0.26832,0.387 0.14792,0.59168c-1.26592,2.10872 -1.41212,5.12388 -0.40076,8.27836c0.07224,0.22704 -0.0516,0.46784 -0.27864,0.54008c-0.04472,0.01548 -0.08772,0.02236 -0.13244,0.02236zM64.93,54.79576c-0.0774,0 -0.1548,-0.02064 -0.22532,-0.06364c-1.55488,-0.95632 -3.32304,-1.15756 -4.53392,-1.15756c-0.40248,0 -0.81012,0.02064 -1.21948,0.0602c-0.22532,0.03096 -0.44548,-0.14964 -0.46956,-0.387c-0.02236,-0.23564 0.14964,-0.4472 0.387,-0.46956c0.4386,-0.043 0.87204,-0.06364 1.30376,-0.06364c1.32096,0 3.2594,0.2236 4.98284,1.28484c0.20296,0.12384 0.26488,0.39044 0.14104,0.59168c-0.08084,0.13244 -0.2236,0.20468 -0.36636,0.20468zM108.3256,54.3778c-0.15996,0 -0.31304,-0.08944 -0.387,-0.24252c-0.10492,-0.21328 -0.01548,-0.46956 0.1978,-0.57448c1.41728,-0.68972 3.12696,-0.97352 4.97768,-0.87204c0.23908,0.01548 0.41796,0.21844 0.4042,0.4558c-0.01548,0.23736 -0.23392,0.40248 -0.4558,0.4042c-0.24252,-0.01548 -0.47988,-0.02408 -0.71896,-0.02408c-0.99072,0 -2.4596,0.13932 -3.83216,0.8084c-0.05676,0.03268 -0.1204,0.04472 -0.18576,0.04472z"></path><path d="M111.74496,104.92344c-2.55592,-2.4768 -4.64744,-2.02616 -7.20508,-0.67596c2.78812,-5.85316 4.64744,-13.50888 4.64744,-17.11056c0,-6.3038 -5.34576,-11.2574 -11.62032,-11.2574c-6.50676,0 -11.62032,5.17892 -11.62032,11.2574v0c0,-6.3038 -5.34576,-11.2574 -11.62032,-11.2574c-6.50676,0 -11.62032,5.17892 -11.62032,11.2574c0,3.60168 1.85932,11.2574 4.64744,17.11056c-2.78812,-1.3502 -4.87964,-1.57552 -7.20508,0.67596c-5.81016,5.62956 9.761,23.41608 26.02876,23.41608c16.26776,0 31.61016,-17.78824 25.5678,-23.41608z"></path><path d="M109.177,87.0578c-0.22876,0 -0.41796,-0.17888 -0.43,-0.40936c-0.22016,-4.81772 -3.77712,-8.9526 -8.6516,-10.05684c-0.2322,-0.05332 -0.37668,-0.2838 -0.32336,-0.516c0.0516,-0.23048 0.27692,-0.37324 0.51428,-0.32336c5.24944,1.19024 9.08332,5.65364 9.32068,10.85664c0.01032,0.23908 -0.17372,0.4386 -0.40936,0.45064c-0.0086,-0.00172 -0.01376,-0.00172 -0.02064,-0.00172z"></path><path d="M107.8096,95.6578c-0.03612,0 -0.07396,-0.00516 -0.1118,-0.01548c-0.22876,-0.06192 -0.36464,-0.29756 -0.30272,-0.52804c0.4042,-1.50328 0.72928,-2.93776 0.96492,-4.26388c0.03956,-0.23392 0.26316,-0.39388 0.4988,-0.34744c0.23392,0.04128 0.39044,0.26316 0.34744,0.4988c-0.23908,1.34848 -0.56932,2.80876 -0.9804,4.33612c-0.05332,0.19436 -0.22704,0.31992 -0.41624,0.31992z"></path><path d="M86.1806,128.7678c-12.36508,0 -24.02496,-10.03964 -26.94036,-17.23784c-1.18508,-2.92744 -0.96664,-5.3836 0.61232,-6.91612c2.22568,-2.1586 4.31032,-2.14484 6.63748,-1.2212c-0.516,-1.16444 -1.00964,-2.41144 -1.47232,-3.72208c-0.07912,-0.2236 0.03784,-0.46784 0.26316,-0.54696c0.22016,-0.07912 0.46956,0.03612 0.54868,0.26144c0.59168,1.68044 1.23668,3.25424 1.91436,4.6784c0.07912,0.16512 0.04472,0.3612 -0.08428,0.4902c-0.129,0.129 -0.32508,0.16512 -0.4902,0.08084c-2.57656,-1.247 -4.49952,-1.55144 -6.71832,0.59856c-1.68216,1.62884 -1.1524,4.14864 -0.41452,5.97528c2.82424,6.9746 14.13668,16.7012 26.144,16.7012c11.94884,0 23.08756,-9.66124 25.81376,-16.5894c0.73272,-1.86104 1.23324,-4.42556 -0.54352,-6.08192c-2.33232,-2.2618 -4.15724,-1.95736 -6.70972,-0.60888c-0.16168,0.08944 -0.36464,0.0602 -0.4988,-0.0688c-0.13416,-0.129 -0.17028,-0.3268 -0.09116,-0.49536c0.68112,-1.43104 1.32612,-3.00484 1.91436,-4.6784c0.07912,-0.2236 0.32336,-0.34056 0.54696,-0.26144c0.2236,0.07912 0.34056,0.32336 0.26144,0.54696c-0.45236,1.28656 -0.9374,2.51636 -1.44824,3.67048c2.29104,-0.98384 4.29484,-0.97524 6.61512,1.2728c1.65636,1.54284 1.92468,4.03856 0.75336,7.01932c-2.81564,7.1552 -14.3018,17.13292 -26.61356,17.13292z"></path><path d="M64.0872,95.6578c-0.1892,0 -0.36292,-0.12556 -0.41452,-0.3182c-0.8858,-3.28176 -1.39492,-6.27112 -1.39492,-8.20612c0,-6.44484 5.40596,-11.6874 12.05032,-11.6874c5.54356,0 10.22196,3.64812 11.62204,8.6c1.25044,-4.37396 5.08432,-7.80536 9.87968,-8.4796c0.2236,-0.02752 0.45236,0.129 0.48504,0.36636c0.03268,0.23564 -0.13072,0.45408 -0.36636,0.48676c-5.45584,0.76368 -9.5718,5.36984 -9.5718,10.71388c0,0.23736 -0.19264,0.43 -0.43,0.43c-0.23736,0 -0.43,-0.19264 -0.43,-0.43c0,-5.97012 -5.01896,-10.8274 -11.1886,-10.8274c-6.16964,0 -11.19032,4.85728 -11.19032,10.8274c0,1.8318 0.50912,4.816 1.36396,7.9808c0.06192,0.23048 -0.07396,0.46612 -0.30272,0.52804c-0.03612,0.01204 -0.07396,0.01548 -0.1118,0.01548z"></path><path d="M86.86,109.41952c-3.32476,0 -6.02,1.8748 -6.02,4.18648c0,2.31168 2.69524,4.18648 6.02,4.18648c3.32476,0 6.02,-1.8748 6.02,-4.18648c0,-2.31168 -2.69524,-4.18648 -6.02,-4.18648zM92.88,92.21952c-1.9006,0 -3.44,3.08052 -3.44,6.88c0,3.79948 1.5394,6.88 3.44,6.88c1.9006,0 3.44,-3.08052 3.44,-6.88c0,-3.8012 -1.5394,-6.88 -3.44,-6.88zM79.12,92.21952c-1.9006,0 -3.44,3.08052 -3.44,6.88c0,3.79948 1.5394,6.88 3.44,6.88c1.9006,0 3.44,-3.08052 3.44,-6.88c0,-3.8012 -1.5394,-6.88 -3.44,-6.88z"></path><path d="M85.14,111.35452c-1.30548,0 -2.36328,0.67252 -2.365,1.50328c-0.00172,0.83076 1.05608,1.505 2.36156,1.50672c0.00172,0 0.00344,0 0.00344,0c1.30548,0 2.36328,-0.67252 2.365,-1.50328c0.00172,-0.83076 -1.05608,-1.505 -2.36156,-1.50672c0,0 -0.00172,0 -0.00344,0z"></path><path d="M85.14516,114.5778c-0.00172,0 -0.00344,0 -0.00516,0c-0.87032,0 -1.67356,-0.2838 -2.14828,-0.76024c-0.2838,-0.28208 -0.43172,-0.61404 -0.43172,-0.96148c0,-0.96492 1.1352,-1.71828 2.58,-1.71828h0.00344c1.4448,0.00172 2.57656,0.7568 2.57656,1.72172c0,0.47816 -0.28208,0.9202 -0.79292,1.247c-0.47988,0.30444 -1.11284,0.47128 -1.78192,0.47128zM85.14,111.3528v0.215c-1.16444,0 -2.15,0.58996 -2.15,1.28828c0,0.23048 0.10664,0.45752 0.30616,0.65704c0.3956,0.39732 1.08532,0.63468 1.8404,0.63468c0.00172,0 0.00344,0 0.00516,0c0.5934,0 1.1438,-0.14448 1.55488,-0.40592c0.38356,-0.24252 0.5934,-0.55556 0.5934,-0.88236c0,-0.69832 -0.98212,-1.29 -2.14656,-1.29172z"></path></g></g></g></svg></a>
                                <a href="#" data-target="mobile-demo" class="sidenav-trigger black-text"><i class="material-icons">menu</i></a>
                                <ul class="right hide-on-med-and-down">

                                <li><a href="inventario.php" class="Subtitulos white-text">Inventario<i class="right valign-wrapper"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                width="30" height="30"
                                viewBox="0 0 172 172"
                                style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><path d="M86,172c-47.49649,0 -86,-38.50351 -86,-86v0c0,-47.49649 38.50351,-86 86,-86v0c47.49649,0 86,38.50351 86,86v0c0,47.49649 -38.50351,86 -86,86z" fill="#ffffff"></path><g fill="#000000"><path d="M123.26667,140.46667l-37.26667,-17.2l-37.26667,17.2v-97.46667c0,-6.30667 5.16,-11.46667 11.46667,-11.46667h51.6c6.30667,0 11.46667,5.16 11.46667,11.46667z"></path></g></g></svg></i></a></li>
                    
                                <li><a href="#!" class="Subtitulos white-text dropdown-trigger" data-target="DropdownAdmin">Administración<i class="right valign-wrapper"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                width="30" height="30"
                                viewBox="0 0 172 172"
                                style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><path d="M86,172c-47.49649,0 -86,-38.50351 -86,-86v0c0,-47.49649 38.50351,-86 86,-86v0c47.49649,0 86,38.50351 86,86v0c0,47.49649 -38.50351,86 -86,86z" fill="#ffffff"></path><g><path d="M129,53.75h-48.375l-10.75,-10.75h-26.875c-5.9125,0 -10.75,4.8375 -10.75,10.75v21.5h107.5v-10.75c0,-5.9125 -4.8375,-10.75 -10.75,-10.75z" fill="#333333"></path><path d="M129,53.75h-86c-5.9125,0 -10.75,4.8375 -10.75,10.75v53.75c0,5.9125 4.8375,10.75 10.75,10.75h86c5.9125,0 10.75,-4.8375 10.75,-10.75v-53.75c0,-5.9125 -4.8375,-10.75 -10.75,-10.75z" fill="#000000"></path></g></g></svg></i></a></li>
                                    
                                <li><a href="#!" class="Subtitulos white-text dropdown-trigger" data-target="DropdownEmpleados">Empleados<i class="right valign-wrapper"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                width="30" height="30"
                                viewBox="0 0 172 172"
                                style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><path d="M86,172c-47.49649,0 -86,-38.50351 -86,-86v0c0,-47.49649 38.50351,-86 86,-86v0c47.49649,0 86,38.50351 86,86v0c0,47.49649 -38.50351,86 -86,86z" fill="#ffffff"></path><g><path d="M140.18,114.38c0,5.69664 -4.62078,10.32 -10.32,10.32h-87.72c-5.69922,0 -10.32,-4.62336 -10.32,-10.32v-56.76c0,-5.7018 4.62078,-10.32 10.32,-10.32h87.72c5.69922,0 10.32,4.6182 10.32,10.32z" fill="#000000"></path><path d="M73.1,78.26c0,5.69664 -4.62078,10.32 -10.32,10.32c-5.69922,0 -10.32,-4.62336 -10.32,-10.32c0,-5.69922 4.62078,-10.32 10.32,-10.32c5.69922,0 10.32,4.62078 10.32,10.32M80.84,101.48c0,0 -5.00004,-7.74 -18.06,-7.74c-13.06512,0 -18.06,7.74 -18.06,7.74v5.16h36.12zM127.28,70.52h-38.7v5.16h38.7zM127.28,83.42h-38.7v5.16h38.7zM109.22,96.32h-20.64v5.16h20.64z" fill="#ffffff"></path></g></g></svg></i></a></li>
                                    
                                <li><a href="venta.php" class="Subtitulos white-text">Venta<i class="right valign-wrapper"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                width="30" height="30"
                                viewBox="0 0 172 172"
                                style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><path d="M86,172c-47.49649,0 -86,-38.50351 -86,-86v0c0,-47.49649 38.50351,-86 86,-86v0c47.49649,0 86,38.50351 86,86v0c0,47.49649 -38.50351,86 -86,86z" fill="#ffffff"></path><g><path d="M122.61254,82.29604l-12.63589,-35.37323h-47.9533l-12.6331,35.37323l-10.51456,-3.75699l13.95614,-39.07719c0.79271,-2.22182 2.89729,-3.70396 5.25588,-3.70396h55.82456c2.35859,0 4.46317,1.48214 5.25588,3.70396l13.95614,39.07719z" fill="#000000"></path><path d="M123.40246,139.03333h-74.80491c-2.79123,0 -5.02421,-1.95386 -5.58246,-4.46596l-10.04842,-51.3586h106.06667l-10.32754,51.3586c-0.55825,2.51211 -2.79123,4.46596 -5.30333,4.46596z" fill="#000000"></path><path d="M139.03333,88.79123h-106.06667c-3.07035,0 -5.58246,-2.51211 -5.58246,-5.58246v-5.58246c0,-3.07035 2.51211,-5.58246 5.58246,-5.58246h106.06667c3.07035,0 5.58246,2.51211 5.58246,5.58246v5.58246c0,3.07035 -2.51211,5.58246 -5.58246,5.58246z" fill="#000000"></path><path d="M86,97.16491v0c-1.54076,0 -2.79123,1.25047 -2.79123,2.79123v27.91228c0,1.67474 1.11649,2.79123 2.79123,2.79123c1.67474,0 2.79123,-1.11649 2.79123,-2.79123v-27.91228c0,-1.54076 -1.25047,-2.79123 -2.79123,-2.79123zM97.16491,97.16491v0c-1.54076,0 -2.79123,1.25047 -2.79123,2.79123v27.91228c0,1.67474 1.11649,2.79123 2.79123,2.79123c1.67474,0 2.79123,-1.11649 2.79123,-2.79123v-27.91228c0,-1.54076 -1.25047,-2.79123 -2.79123,-2.79123zM108.32982,97.16491v0c-1.54076,0 -2.79123,1.25047 -2.79123,2.79123v27.91228c0,1.67474 1.11649,2.79123 2.79123,2.79123c1.67474,0 2.79123,-1.11649 2.79123,-2.79123v-27.91228c0,-1.54076 -1.25047,-2.79123 -2.79123,-2.79123zM63.67018,97.16491v0c-1.54076,0 -2.79123,1.25047 -2.79123,2.79123v27.91228c0,1.67474 1.11649,2.79123 2.79123,2.79123c1.67474,0 2.79123,-1.11649 2.79123,-2.79123v-27.91228c0,-1.54076 -1.25047,-2.79123 -2.79123,-2.79123zM74.83509,97.16491v0c-1.54076,0 -2.79123,1.25047 -2.79123,2.79123v27.91228c0,1.67474 1.11649,2.79123 2.79123,2.79123c1.67474,0 2.79123,-1.11649 2.79123,-2.79123v-27.91228c0,-1.54076 -1.25047,-2.79123 -2.79123,-2.79123z" fill="#ffffff"></path><path d="M99.95614,49.71404h-27.91228c-1.54076,0 -2.79123,-1.25047 -2.79123,-2.79123v-11.16491c0,-1.54076 1.25047,-2.79123 2.79123,-2.79123h27.91228c1.54076,0 2.79123,1.25047 2.79123,2.79123v11.16491c0,1.54076 -1.25047,2.79123 -2.79123,2.79123z" fill="#000000"></path></g></g></svg></i></a></li>
                    
                                <li><a href="#!" class="Subtitulos white-text dropdown-trigger" data-target="DropdownHistorial">Historiales<i class="right valign-wrapper"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                width="30" height="30"
                                viewBox="0 0 172 172"
                                style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><path d="M86,172c-47.49649,0 -86,-38.50351 -86,-86v0c0,-47.49649 38.50351,-86 86,-86v0c47.49649,0 86,38.50351 86,86v0c0,47.49649 -38.50351,86 -86,86z" fill="#ffffff"></path><g><path d="M37.26667,84.56667c0,26.94667 21.78667,48.73333 48.73333,48.73333c26.94667,0 48.73333,-21.78667 48.73333,-48.73333c0,-26.94667 -21.78667,-48.73333 -48.73333,-48.73333c-26.94667,0 -48.73333,21.78667 -48.73333,48.73333" fill="#ffffff"></path><path d="M86,141.9c-31.53333,0 -57.33333,-25.8 -57.33333,-57.33333c0,-31.53333 25.8,-57.33333 57.33333,-57.33333c13.47333,0 26.66,4.87333 36.98,13.76l-7.45333,8.6c-8.02667,-7.16667 -18.63333,-10.89333 -29.52667,-10.89333c-25.22667,0 -45.86667,20.64 -45.86667,45.86667c0,25.22667 20.64,45.86667 45.86667,45.86667z" fill="#cccccc"></path><path d="M86,141.9c-31.53333,0 -57.33333,-25.8 -57.33333,-57.33333c0,-13.47333 4.87333,-26.66 13.76,-36.98l8.6,7.45333c-7.16667,8.02667 -10.89333,18.63333 -10.89333,29.52667c0,25.22667 20.64,45.86667 45.86667,45.86667c25.22667,0 45.86667,-20.64 45.86667,-45.86667c0,-25.22667 -20.64,-45.86667 -45.86667,-45.86667v-11.46667c31.53333,0 57.33333,25.8 57.33333,57.33333c0,31.53333 -25.8,57.33333 -57.33333,57.33333z" fill="#000000"></path><path d="M94.6,50.16667l-22.93333,-17.2l22.93333,-17.2z" fill="#000000"></path><path d="M68.8,58.76667l5.16,-2.58l14.62,27.23333l-5.16,2.58z" fill="#000000"></path><path d="M83.70667,82.27333l4.87333,4.87333l-14.90667,14.62l-4.87333,-4.87333z" fill="#000000"></path><path d="M80.26667,84.56667c0,3.15333 2.58,5.73333 5.73333,5.73333c3.15333,0 5.73333,-2.58 5.73333,-5.73333c0,-3.15333 -2.58,-5.73333 -5.73333,-5.73333c-3.15333,0 -5.73333,2.58 -5.73333,5.73333" fill="#000000"></path><path d="M83.13333,84.56667c0,1.72 1.14667,2.86667 2.86667,2.86667c1.72,0 2.86667,-1.14667 2.86667,-2.86667c0,-1.72 -1.14667,-2.86667 -2.86667,-2.86667c-1.72,0 -2.86667,1.14667 -2.86667,2.86667" fill="#000000"></path></g></g></svg></i></a></li>

                                <li><a  onclick="logOut()" class="Subtitulos white-text">Cerrar Sesión<i class="right valign-wrapper"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                width="30" height="30"
                                viewBox="0 0 172 172"
                                style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g><path d="M86,14.33333c-39.58041,0 -71.66667,32.08626 -71.66667,71.66667c0,39.58041 32.08626,71.66667 71.66667,71.66667c39.58041,0 71.66667,-32.08626 71.66667,-71.66667c0,-39.58041 -32.08626,-71.66667 -71.66667,-71.66667z" fill="#ffffff"></path><path d="M86,157.66667c16.125,0 30.81667,-5.375 42.64167,-14.33333c-2.15,-27.23333 -29.38333,-32.25 -29.38333,-32.25l-13.25833,2.86667l-13.25833,-2.86667c0,0 -27.23333,5.01667 -29.38333,32.25c11.825,8.95833 26.51667,14.33333 42.64167,14.33333z" fill="#000000"></path><path d="M86,132.58333c11.10833,0 20.06667,-8.24167 21.14167,-18.99167c-3.225,-1.43333 -5.73333,-2.15 -7.16667,-2.50833c0,7.88333 -6.45,13.975 -14.33333,13.975c-7.88333,0 -14.33333,-6.45 -14.33333,-13.975c-1.43333,0.35833 -3.94167,1.075 -7.16667,2.50833c1.79167,10.75 10.75,18.99167 21.85833,18.99167z" fill="#000000"></path><path d="M114.66667,80.625c0,2.86667 -2.50833,5.375 -5.375,5.375c-2.86667,0 -5.375,-2.50833 -5.375,-5.375c0,-2.86667 2.50833,-5.375 5.375,-5.375c2.86667,0 5.375,2.50833 5.375,5.375M68.08333,80.625c0,-2.86667 -2.50833,-5.375 -5.375,-5.375c-2.86667,0 -5.375,2.50833 -5.375,5.375c0,2.86667 2.50833,5.375 5.375,5.375c2.86667,0 5.375,-2.50833 5.375,-5.375" fill="#000000"></path><path d="M86,125.41667c-14.33333,0 -14.33333,-14.33333 -14.33333,-14.33333v-14.33333h28.66667v14.33333c0,0 0,14.33333 -14.33333,14.33333z" fill="#000000"></path><path d="M111.08333,67.00833c0,-21.14167 -50.16667,-13.61667 -50.16667,0v15.76667c0,13.61667 11.10833,24.725 25.08333,24.725c13.975,0 25.08333,-11.10833 25.08333,-24.725z" fill="#000000"></path><path d="M86,39.41667c-17.55833,0 -28.66667,15.40833 -28.66667,29.38333v6.45l7.16667,7.16667v-14.33333l32.96667,-10.75l10.03333,10.75v14.33333l7.16667,-7.16667v-2.86667c0,-11.46667 -2.86667,-24.36667 -17.2,-27.23333l-2.86667,-5.73333z" fill="#000000"></path><path d="M93.16667,78.83333c0,-2.15 1.43333,-3.58333 3.58333,-3.58333c2.15,0 3.58333,1.43333 3.58333,3.58333c0,2.15 -1.43333,3.58333 -3.58333,3.58333c-2.15,0 -3.58333,-1.43333 -3.58333,-3.58333M71.66667,78.83333c0,2.15 1.43333,3.58333 3.58333,3.58333c2.15,0 3.58333,-1.43333 3.58333,-3.58333c0,-2.15 -1.43333,-3.58333 -3.58333,-3.58333c-2.15,0 -3.58333,1.43333 -3.58333,3.58333" fill="#000000"></path></g></g></svg></i></a></li>
                                </ul>
                            </div>
                            </nav>  
                        </div>

                        <!--Navbar "Hamburguesa"-->
                        <ul class="sidenav" id="mobile-demo"> 
                            <li><a href="inventario.php" class="Subtitulos">Inventario<i class="left valign-wrapper"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                            width="100" height="100"
                            viewBox="0 0 172 172"
                            style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><path d="M86,172c-47.49649,0 -86,-38.50351 -86,-86v0c0,-47.49649 38.50351,-86 86,-86v0c47.49649,0 86,38.50351 86,86v0c0,47.49649 -38.50351,86 -86,86z" fill="#000000"></path><g fill="#ffffff"><path d="M123.26667,140.46667l-37.26667,-17.2l-37.26667,17.2v-97.46667c0,-6.30667 5.16,-11.46667 11.46667,-11.46667h51.6c6.30667,0 11.46667,5.16 11.46667,11.46667z"></path></g></g></svg></i></a></li>
                    
                            <li><a href="#!" class="Subtitulos dropdown-trigger" data-target="DropdownAdmin">Administración<i class="left valign-wrapper"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                            width="100" height="100"
                            viewBox="0 0 172 172"
                            style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><path d="M86,172c-47.49649,0 -86,-38.50351 -86,-86v0c0,-47.49649 38.50351,-86 86,-86v0c47.49649,0 86,38.50351 86,86v0c0,47.49649 -38.50351,86 -86,86z" fill="#000000"></path><g><path d="M129,53.75h-48.375l-10.75,-10.75h-26.875c-5.9125,0 -10.75,4.8375 -10.75,10.75v21.5h107.5v-10.75c0,-5.9125 -4.8375,-10.75 -10.75,-10.75z" fill="#cccccc"></path><path d="M129,53.75h-86c-5.9125,0 -10.75,4.8375 -10.75,10.75v53.75c0,5.9125 4.8375,10.75 10.75,10.75h86c5.9125,0 10.75,-4.8375 10.75,-10.75v-53.75c0,-5.9125 -4.8375,-10.75 -10.75,-10.75z" fill="#ffffff"></path></g></g></svg></i></a></li>
                                
                            <li><a href="#!" class="Subtitulos dropdown-trigger" data-target="DropdownEmpleados">Empleados<i class="left valign-wrapper"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                            width="100" height="100"
                            viewBox="0 0 172 172"
                            style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><path d="M86,172c-47.49649,0 -86,-38.50351 -86,-86v0c0,-47.49649 38.50351,-86 86,-86v0c47.49649,0 86,38.50351 86,86v0c0,47.49649 -38.50351,86 -86,86z" fill="#000000"></path><g><path d="M140.18,114.38c0,5.69664 -4.62078,10.32 -10.32,10.32h-87.72c-5.69922,0 -10.32,-4.62336 -10.32,-10.32v-56.76c0,-5.7018 4.62078,-10.32 10.32,-10.32h87.72c5.69922,0 10.32,4.6182 10.32,10.32z" fill="#ffffff"></path><path d="M73.1,78.26c0,5.69664 -4.62078,10.32 -10.32,10.32c-5.69922,0 -10.32,-4.62336 -10.32,-10.32c0,-5.69922 4.62078,-10.32 10.32,-10.32c5.69922,0 10.32,4.62078 10.32,10.32M80.84,101.48c0,0 -5.00004,-7.74 -18.06,-7.74c-13.06512,0 -18.06,7.74 -18.06,7.74v5.16h36.12zM127.28,70.52h-38.7v5.16h38.7zM127.28,83.42h-38.7v5.16h38.7zM109.22,96.32h-20.64v5.16h20.64z" fill="#000000"></path></g></g></svg></i></a></li>
                                    
                            <li><a href="venta.php" class="Subtitulos">Venta<i class="left valign-wrapper"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                            width="100" height="100"
                            viewBox="0 0 172 172"
                            style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><path d="M86,172c-47.49649,0 -86,-38.50351 -86,-86v0c0,-47.49649 38.50351,-86 86,-86v0c47.49649,0 86,38.50351 86,86v0c0,47.49649 -38.50351,86 -86,86z" fill="#000000"></path><g><path d="M122.61254,82.29604l-12.63589,-35.37323h-47.9533l-12.6331,35.37323l-10.51456,-3.75699l13.95614,-39.07719c0.79271,-2.22182 2.89729,-3.70396 5.25588,-3.70396h55.82456c2.35859,0 4.46317,1.48214 5.25588,3.70396l13.95614,39.07719z" fill="#ffffff"></path><path d="M123.40246,139.03333h-74.80491c-2.79123,0 -5.02421,-1.95386 -5.58246,-4.46596l-10.04842,-51.3586h106.06667l-10.32754,51.3586c-0.55825,2.51211 -2.79123,4.46596 -5.30333,4.46596z" fill="#ffffff"></path><path d="M139.03333,88.79123h-106.06667c-3.07035,0 -5.58246,-2.51211 -5.58246,-5.58246v-5.58246c0,-3.07035 2.51211,-5.58246 5.58246,-5.58246h106.06667c3.07035,0 5.58246,2.51211 5.58246,5.58246v5.58246c0,3.07035 -2.51211,5.58246 -5.58246,5.58246z" fill="#ffffff"></path><path d="M86,97.16491v0c-1.54076,0 -2.79123,1.25047 -2.79123,2.79123v27.91228c0,1.67474 1.11649,2.79123 2.79123,2.79123c1.67474,0 2.79123,-1.11649 2.79123,-2.79123v-27.91228c0,-1.54076 -1.25047,-2.79123 -2.79123,-2.79123zM97.16491,97.16491v0c-1.54076,0 -2.79123,1.25047 -2.79123,2.79123v27.91228c0,1.67474 1.11649,2.79123 2.79123,2.79123c1.67474,0 2.79123,-1.11649 2.79123,-2.79123v-27.91228c0,-1.54076 -1.25047,-2.79123 -2.79123,-2.79123zM108.32982,97.16491v0c-1.54076,0 -2.79123,1.25047 -2.79123,2.79123v27.91228c0,1.67474 1.11649,2.79123 2.79123,2.79123c1.67474,0 2.79123,-1.11649 2.79123,-2.79123v-27.91228c0,-1.54076 -1.25047,-2.79123 -2.79123,-2.79123zM63.67018,97.16491v0c-1.54076,0 -2.79123,1.25047 -2.79123,2.79123v27.91228c0,1.67474 1.11649,2.79123 2.79123,2.79123c1.67474,0 2.79123,-1.11649 2.79123,-2.79123v-27.91228c0,-1.54076 -1.25047,-2.79123 -2.79123,-2.79123zM74.83509,97.16491v0c-1.54076,0 -2.79123,1.25047 -2.79123,2.79123v27.91228c0,1.67474 1.11649,2.79123 2.79123,2.79123c1.67474,0 2.79123,-1.11649 2.79123,-2.79123v-27.91228c0,-1.54076 -1.25047,-2.79123 -2.79123,-2.79123z" fill="#000000"></path><path d="M99.95614,49.71404h-27.91228c-1.54076,0 -2.79123,-1.25047 -2.79123,-2.79123v-11.16491c0,-1.54076 1.25047,-2.79123 2.79123,-2.79123h27.91228c1.54076,0 2.79123,1.25047 2.79123,2.79123v11.16491c0,1.54076 -1.25047,2.79123 -2.79123,2.79123z" fill="#ffffff"></path></g></g></svg></i></a></li>
                    
                            <li><a href="#!" class="Subtitulos dropdown-trigger" data-target="DropdownHistorial">Historiales<i class="left valign-wrapper"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                            width="100" height="100"
                            viewBox="0 0 172 172"
                            style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><path d="M86,172c-47.49649,0 -86,-38.50351 -86,-86v0c0,-47.49649 38.50351,-86 86,-86v0c47.49649,0 86,38.50351 86,86v0c0,47.49649 -38.50351,86 -86,86z" fill="#000000"></path><g><path d="M37.26667,84.56667c0,26.94667 21.78667,48.73333 48.73333,48.73333c26.94667,0 48.73333,-21.78667 48.73333,-48.73333c0,-26.94667 -21.78667,-48.73333 -48.73333,-48.73333c-26.94667,0 -48.73333,21.78667 -48.73333,48.73333" fill="#000000"></path><path d="M86,141.9c-31.53333,0 -57.33333,-25.8 -57.33333,-57.33333c0,-31.53333 25.8,-57.33333 57.33333,-57.33333c13.47333,0 26.66,4.87333 36.98,13.76l-7.45333,8.6c-8.02667,-7.16667 -18.63333,-10.89333 -29.52667,-10.89333c-25.22667,0 -45.86667,20.64 -45.86667,45.86667c0,25.22667 20.64,45.86667 45.86667,45.86667z" fill="#333333"></path><path d="M86,141.9c-31.53333,0 -57.33333,-25.8 -57.33333,-57.33333c0,-13.47333 4.87333,-26.66 13.76,-36.98l8.6,7.45333c-7.16667,8.02667 -10.89333,18.63333 -10.89333,29.52667c0,25.22667 20.64,45.86667 45.86667,45.86667c25.22667,0 45.86667,-20.64 45.86667,-45.86667c0,-25.22667 -20.64,-45.86667 -45.86667,-45.86667v-11.46667c31.53333,0 57.33333,25.8 57.33333,57.33333c0,31.53333 -25.8,57.33333 -57.33333,57.33333z" fill="#ffffff"></path><path d="M94.6,50.16667l-22.93333,-17.2l22.93333,-17.2z" fill="#ffffff"></path><path d="M68.8,58.76667l5.16,-2.58l14.62,27.23333l-5.16,2.58z" fill="#ffffff"></path><path d="M83.70667,82.27333l4.87333,4.87333l-14.90667,14.62l-4.87333,-4.87333z" fill="#ffffff"></path><path d="M80.26667,84.56667c0,3.15333 2.58,5.73333 5.73333,5.73333c3.15333,0 5.73333,-2.58 5.73333,-5.73333c0,-3.15333 -2.58,-5.73333 -5.73333,-5.73333c-3.15333,0 -5.73333,2.58 -5.73333,5.73333" fill="#ffffff"></path><path d="M83.13333,84.56667c0,1.72 1.14667,2.86667 2.86667,2.86667c1.72,0 2.86667,-1.14667 2.86667,-2.86667c0,-1.72 -1.14667,-2.86667 -2.86667,-2.86667c-1.72,0 -2.86667,1.14667 -2.86667,2.86667" fill="#ffffff"></path></g></g></svg></i></a></li>
                                    
                            <li><a href="" class="Subtitulos dropdown-trigger" data-target="DropdownSesion">Usuario<i class="left valign-wrapper"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                            width="100" height="100"
                            viewBox="0 0 172 172"
                            style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g><path d="M86,14.33333c-39.58041,0 -71.66667,32.08626 -71.66667,71.66667c0,39.58041 32.08626,71.66667 71.66667,71.66667c39.58041,0 71.66667,-32.08626 71.66667,-71.66667c0,-39.58041 -32.08626,-71.66667 -71.66667,-71.66667z" fill="#000000"></path><path d="M86,157.66667c16.125,0 30.81667,-5.375 42.64167,-14.33333c-2.15,-27.23333 -29.38333,-32.25 -29.38333,-32.25l-13.25833,2.86667l-13.25833,-2.86667c0,0 -27.23333,5.01667 -29.38333,32.25c11.825,8.95833 26.51667,14.33333 42.64167,14.33333z" fill="#ffffff"></path><path d="M86,132.58333c11.10833,0 20.06667,-8.24167 21.14167,-18.99167c-3.225,-1.43333 -5.73333,-2.15 -7.16667,-2.50833c0,7.88333 -6.45,13.975 -14.33333,13.975c-7.88333,0 -14.33333,-6.45 -14.33333,-13.975c-1.43333,0.35833 -3.94167,1.075 -7.16667,2.50833c1.79167,10.75 10.75,18.99167 21.85833,18.99167z" fill="#ffffff"></path><path d="M114.66667,80.625c0,2.86667 -2.50833,5.375 -5.375,5.375c-2.86667,0 -5.375,-2.50833 -5.375,-5.375c0,-2.86667 2.50833,-5.375 5.375,-5.375c2.86667,0 5.375,2.50833 5.375,5.375M68.08333,80.625c0,-2.86667 -2.50833,-5.375 -5.375,-5.375c-2.86667,0 -5.375,2.50833 -5.375,5.375c0,2.86667 2.50833,5.375 5.375,5.375c2.86667,0 5.375,-2.50833 5.375,-5.375" fill="#ffffff"></path><path d="M86,125.41667c-14.33333,0 -14.33333,-14.33333 -14.33333,-14.33333v-14.33333h28.66667v14.33333c0,0 0,14.33333 -14.33333,14.33333z" fill="#ffffff"></path><path d="M111.08333,67.00833c0,-21.14167 -50.16667,-13.61667 -50.16667,0v15.76667c0,13.61667 11.10833,24.725 25.08333,24.725c13.975,0 25.08333,-11.10833 25.08333,-24.725z" fill="#ffffff"></path><path d="M86,39.41667c-17.55833,0 -28.66667,15.40833 -28.66667,29.38333v6.45l7.16667,7.16667v-14.33333l32.96667,-10.75l10.03333,10.75v14.33333l7.16667,-7.16667v-2.86667c0,-11.46667 -2.86667,-24.36667 -17.2,-27.23333l-2.86667,-5.73333z" fill="#ffffff"></path><path d="M93.16667,78.83333c0,-2.15 1.43333,-3.58333 3.58333,-3.58333c2.15,0 3.58333,1.43333 3.58333,3.58333c0,2.15 -1.43333,3.58333 -3.58333,3.58333c-2.15,0 -3.58333,-1.43333 -3.58333,-3.58333M71.66667,78.83333c0,2.15 1.43333,3.58333 3.58333,3.58333c2.15,0 3.58333,-1.43333 3.58333,-3.58333c0,-2.15 -1.43333,-3.58333 -3.58333,-3.58333c-2.15,0 -3.58333,1.43333 -3.58333,3.58333" fill="#ffffff"></path></g></g></svg></i></a></li>
                        </ul>
                        <main>
                        ');
                }
            }
        } else {
            header('location: graficas.php');
        }
    } else {
        // Se verifica si la página web actual es diferente a index.php (Iniciar sesión) y a register.php (Crear primer usuario) para direccionar a index.php, de lo contrario se muestra un menú vacío.
        if ($filename != 'index.php' && $filename != 'register.php' && $filename != 'primer_uso.php' && $filename != 'recu_contra.php' && $filename != 'restaurar.php' && $filename != 'changepass.php'  && $filename != 'autenticacion.php') {
            header('location: index.php');
        } else {
            // Se imprime el código HTML para el encabezado del documento con un menú vacío cuando sea iniciar sesión o registrar el primer usuario.
            //print('
              //  <main class="container">
                //    <h3 class="center-align">' . $title . '</h3>
            // ');
        }
    }
  }

    /*
    *   Método para imprimir la plantilla del pie.
    *
    *   Parámetros: $controller (nombre del archivo que sirve como controlador de la página web).
    *
    *   Retorno: ninguno.
    */
    public static function footerTemplate($controller)
    {   
        // Se comprueba si existe una sesión de administrador para imprimir el pie respectivo del documento.
        if (isset($_SESSION['id_usuario'])) {          
            $scripts = '
                <!--JavaScript at end of body for optimized loading-->
                <script type="text/javascript" src="../resources/js/materialize.min.js"></script>
                <script type="text/javascript" src="../resources/js/sweetalert.min.js"></script> 
                <script type="text/javascript" src="https://cdn.rawgit.com/pinzon1992/materialize_table_pagination/f9a8478f/js/pagination.js"></script>               
                <script type="text/javascript" src="../app/controllers/account.js"></script>
                <script type="text/javascript" src="../app/controllers/initialization.js"></script>
                <script type="text/javascript" src="../app/controllers/' . $controller . '"></script>
                <script type="text/javascript" src="../app/helpers/components.js"></script>
                
            ';
            $links = '
                <h5 class="white-text Titulos">California</h5>
                <p class="grey-text text-lighten-4">Somos la mejor Tienda Online para Skaters</p>
                <a href="https://www.instagram.com/california_sktb/?hl=es"><i><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                    width="20" height="20"
                    viewBox="0 0 172 172"
                    style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#ffffff"><path d="M55.04,10.32c-24.65626,0 -44.72,20.06374 -44.72,44.72v61.92c0,24.65626 20.06374,44.72 44.72,44.72h61.92c24.65626,0 44.72,-20.06374 44.72,-44.72v-61.92c0,-24.65626 -20.06374,-44.72 -44.72,-44.72zM55.04,17.2h61.92c20.9375,0 37.84,16.9025 37.84,37.84v61.92c0,20.9375 -16.9025,37.84 -37.84,37.84h-61.92c-20.9375,0 -37.84,-16.9025 -37.84,-37.84v-61.92c0,-20.9375 16.9025,-37.84 37.84,-37.84zM127.28,37.84c-3.79972,0 -6.88,3.08028 -6.88,6.88c0,3.79972 3.08028,6.88 6.88,6.88c3.79972,0 6.88,-3.08028 6.88,-6.88c0,-3.79972 -3.08028,-6.88 -6.88,-6.88zM86,48.16c-20.85771,0 -37.84,16.98229 -37.84,37.84c0,20.85771 16.98229,37.84 37.84,37.84c20.85771,0 37.84,-16.98229 37.84,-37.84c0,-20.85771 -16.98229,-37.84 -37.84,-37.84zM86,55.04c17.13948,0 30.96,13.82052 30.96,30.96c0,17.13948 -13.82052,30.96 -30.96,30.96c-17.13948,0 -30.96,-13.82052 -30.96,-30.96c0,-17.13948 13.82052,-30.96 30.96,-30.96z"></path></g></g></svg></i></a>
                <a href="https://www.facebook.com/California-Skateboarding-100589135435562"><i><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                    width="20" height="20"
                    viewBox="0 0 172 172"
                    style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#ffffff"><path d="M30.96,13.76c-9.45834,0 -17.2,7.74166 -17.2,17.2v110.08c0,9.45834 7.74166,17.2 17.2,17.2h57.90219c0.37149,0.0614 0.75054,0.0614 1.12203,0h19.51797c0.37149,0.0614 0.75054,0.0614 1.12203,0h30.41578c9.45834,0 17.2,-7.74166 17.2,-17.2v-110.08c0,-9.45834 -7.74166,-17.2 -17.2,-17.2zM30.96,20.64h110.08c5.73958,0 10.32,4.58042 10.32,10.32v110.08c0,5.73958 -4.58042,10.32 -10.32,10.32h-27.52v-48.16h13.14187l4.81735,-24.08h-17.95922v-6.88c0,-1.91777 0.18249,-2.06768 0.8264,-2.48594c0.64392,-0.41826 2.63362,-0.95406 6.0536,-0.95406h10.32v-19.37015l-1.96187,-0.93391c0,0 -7.90182,-3.77594 -18.67813,-3.77594c-7.74,0 -14.09854,3.0838 -18.1675,8.17c-4.06896,5.0862 -5.9125,11.89667 -5.9125,19.35v6.88h-10.32v24.08h10.32v48.16h-55.04c-5.73958,0 -10.32,-4.58042 -10.32,-10.32v-110.08c0,-5.73958 4.58042,-10.32 10.32,-10.32zM110.08,51.6c7.15197,0 11.65252,1.57709 13.76,2.41203v7.90797h-3.44c-3.95883,0 -7.13127,0.32749 -9.80265,2.06265c-2.67138,1.73519 -3.95735,5.02888 -3.95735,8.25735v13.76h16.44078l-2.06265,10.32h-14.37813v55.04h-13.76v-55.04h-10.32v-10.32h10.32v-13.76c0,-6.30667 1.59646,-11.5362 4.4075,-15.05c2.81104,-3.5138 6.7725,-5.59 12.7925,-5.59z"></path></g></g></svg></i></a>  
                <a><i><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                    width="20" height="20"
                    viewBox="0 0 172 172"
                    style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#ffffff"><path d="M18.92,24.08c-8.4925,0 -15.43969,6.93375 -15.48,15.42625c0,0 0,0.01344 0,0.02688c0,0.01344 0,0.01344 0,0.02687v92.88c0,8.50594 6.97406,15.48 15.48,15.48h134.16c8.50594,0 15.48,-6.97406 15.48,-15.48v-92.88c0,-0.01344 0,-0.01344 0,-0.02687c0,-0.01344 0,-0.02688 0,-0.02688c-0.04031,-8.4925 -6.9875,-15.42625 -15.48,-15.42625zM27.86938,30.96h116.27469l-58.14406,40.5275zM16.42063,31.36313l69.57937,48.50937l69.59281,-48.50937c3.52062,1.06156 6.06031,4.25969 6.08719,8.15656c-0.01344,0.72563 -0.7525,2.17688 -1.8275,3.34594c-1.08844,1.1825 -2.15,1.92156 -2.15,1.92156l-0.01344,0.02688l-71.68906,50.74l-71.68906,-50.74l-0.01344,-0.02688c0,0 -1.06156,-0.73906 -2.15,-1.92156c-1.075,-1.16906 -1.81406,-2.62031 -1.8275,-3.34594c0.02688,-3.89687 2.56656,-7.095 6.10063,-8.15656zM10.32,50.40406l0.02688,0.02687l0.02687,0.01344v0.01344l10.26625,7.25625v83.32594h-1.72c-4.78375,0 -8.6,-3.81625 -8.6,-8.6zM161.68,50.40406v82.03594c0,4.78375 -3.81625,8.6 -8.6,8.6h-1.72v-83.32594l10.26625,-7.25625v-0.01344zM27.52,62.57844l58.48,41.3875l58.48,-41.3875v78.46156h-116.96z"></path></g></g></svg></i></a>  
                <a class="white-text">7062-3278</a>
            ';
            $content='
                        </main>
                        <footer class="page-footer black">
                        <ul id="DropdownAdmin" class="dropdown-content">
                            <li><a href="proveedor.php" class="Texto grey-text text-darken-4">Proveedores</a></li>
                            <li><a href="marca.php" class="Texto grey-text text-darken-4">Marcas</a></li>
                        </ul>
                    
                        <ul id="DropdownEmpleados" class="dropdown-content">
                            <li><a href="empleados.php" class="Texto grey-text text-darken-4">Empleados</a></li>
                            <li><a href="usuarios.php" class="Texto grey-text text-darken-4">Usuarios</a></li>
                        </ul>
                    
                        <ul id="DropdownHistorial" class="dropdown-content">
                            <li><a href="historial.php" class="Texto grey-text text-darken-4">Facturas</a></li>
                            <li><a href="entradas.php" class="Texto grey-text text-darken-4">Entradas</a></li>
                        </ul> 
                        <div class="container">
                            <div class="row">
                            <div class="col l6 s12">
                                <h5 class="white-text Titulos">Libreria</h5>
                                <ul>
                                <li><a href="graficas.php" class="grey-text text-lighten-3">Inicio</a></li>
                                <li><a href="inventario.php" class="grey-text text-lighten-3">Inventario</a></li>
                                <li><a href="#!" class="grey-text text-lighten-3 dropdown-trigger" data-target="DropdownAdmin">Administracion</a></li>
                                <li><a href="#!" class="grey-text text-lighten-3 dropdown-trigger" data-target="DropdownEmpleados">Empleados</a></li>
                                <li><a href="venta.php" class="grey-text text-lighten-3">Venta</a></li>
                                <li><a href="#!" class="grey-text text-lighten-3 dropdown-trigger" data-target="DropdownHistorial">Historiales</a></li>
                                </ul>
                            </div>
                            <div class="col l4 offset-l2 s12">
                                <h6 class="white-text Subtitulos">Asistencia técnica</h6>
                                <p class="grey-text text-lighten-3">Oscar Villalobos:</p>
                                <a href="https://mail.google.com/mail/u/#inbox?compose=CllgCJTKXHpCjTjrmbjQnHxChcSvtzFDjdzJKWfkDLnFrKwcTvkGgKRxQQxqCQWHXcQXCVhzxBB">oscar700k@gmail.com</a>
                                <p class="grey-text text-lighten-3">Carlos Ordoñez:</p>
                                <a href="https://mail.google.com/mail/u/#inbox?compose=CllgCJTKXHpCjTjrmbjQnHxChcSvtzFDjdzJKWfkDLnFrKwcTvkGgKRxQQxqCQWHXcQXCVhzxBB">ordonezcarlos737@gmail.com</a>  
                                <p class="grey-text text-lighten-3">Daniel Delgado:</p>
                                <a href="https://mail.google.com/mail/u/#inbox?compose=CllgCJTKXHpCjTjrmbjQnHxChcSvtzFDjdzJKWfkDLnFrKwcTvkGgKRxQQxqCQWHXcQXCVhzxBB">daniel.delgado.carcamo@gmail.com</a>  
                                <p class="grey-text text-lighten-3">Alexis Figueroa:</p>
                                <a href="https://mail.google.com/mail/u/#inbox?compose=GTvVlcSBncDnxCnWqmxLcwcDVhrkChBqQVScTNmbxRDqQxSjTjbdhtJXBLwxlxKnrmDQzBkrZfDnB">onedreamermore24.12@gmail.com</a>                        
                            </div>
                            </div>
                        </div>
                        <div class="footer-copyright">
                            <div class="container center">
                            © 2021 Administración de librería 
                            </div>
                        </div>
                        </footer>
                        ' . $scripts . '
                    </body>
                </html>
            ';
        } else {
            $scripts = '
                <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
                <script>
                    M.AutoInit();
                </script>
                <script type="text/javascript" src="../resources/js/materialize.min.js"></script>
                <script type="text/javascript" src="../resources/js/sweetalert.min.js"></script>    
                <script type="text/javascript" src="../app/controllers/account.js"></script>
                <script type="text/javascript" src="../app/helpers/components.js"></script>
                <script type="text/javascript" src="../app/controllers/' . $controller . '"></script>
            ';
            $links = '';
            $content='
                    </main>
                    <footer class="page-footer black">
                        <ul id="DropdownAdmin" class="dropdown-content">
                            <li><a href="proveedor.php" class="Texto grey-text text-darken-4">Proveedores</a></li>
                            <li><a href="marca.php" class="Texto grey-text text-darken-4">Marcas</a></li>
                        </ul>
                    </footer>
                    ' . $scripts . '
                </body>
            </html>
            ';
        }
        print($content);
    }    
    private static function modals()
    {
        // Se imprime el código HTML de las cajas de dialogo (modals).
        print('
            <!-- Componente Modal para mostrar el formulario de editar perfil -->
            <div id="profile-modal" class="modal rad Texto">
                <div class="modal-content">
                    <h4 class="center-align">Editar perfil</h4>
                    <form method="post" id="profile-form">
                        <div class="row">
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">person</i>
                                <input id="nombres_perfil" type="text" name="nombres_perfil" class="validate" required/>
                                <label for="nombres_perfil">Nombres</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">person</i>
                                <input id="apellidos_perfil" type="text" name="apellidos_perfil" class="validate" required/>
                                <label for="apellidos_perfil">Apellidos</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">email</i>
                                <input id="correo_perfil" type="email" name="correo_perfil" class="validate" required/>
                                <label for="correo_perfil">Correo</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">person_pin</i>
                                <input id="alias_perfil" type="text" name="alias_perfil" class="validate" required/>
                                <label for="alias_perfil">Alias</label>
                            </div>
                        </div>
                        <div class="row center-align">
                            <a href="#" class="btn waves-effect grey tooltipped modal-close" data-tooltip="Cancelar"><i class="material-icons">cancel</i></a>
                            <button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar"><i class="material-icons">save</i></button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Componente Modal para mostrar el formulario de cambiar contraseña -->
            <div id="password-modal" class="modal rad Texto">
                <div class="modal-content">
                    <h4 class="center-align">Cambiar contraseña</h4>
                    <form method="post" id="password-form">
                        <div class="row">
                            <div class="input-field col s12 m6 offset-m3">
                                <i class="material-icons prefix">security</i>
                                <input id="clave_actual" type="password" name="clave_actual" class="validate" required/>
                                <label for="clave_actual">Clave actual</label>
                            </div>
                        </div>
                        <div class="row center-align">
                            <label>CLAVE NUEVA</label>
                        </div>
                        <div class="row">
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">security</i>
                                <input id="clave_nueva_1" type="password" name="clave_nueva_1" class="validate" required/>
                                <label for="clave_nueva_1">Clave</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">security</i>
                                <input id="clave_nueva_2" type="password" name="clave_nueva_2" class="validate" required/>
                                <label for="clave_nueva_2">Confirmar clave</label>
                            </div>
                        </div>
                        <div class="row center-align">
                            <a href="#" class="btn waves-effect grey tooltipped modal-close" data-tooltip="Cancelar"><i class="material-icons">cancel</i></a>
                            <button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar"><i class="material-icons">save</i></button>
                        </div>
                    </form>
                </div>
            </div>
        ');
    }
}
?>