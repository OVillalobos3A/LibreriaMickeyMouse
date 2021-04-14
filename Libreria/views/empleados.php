<?php
include("../app/helpers/dashboard.php");
Public_Page::headerTemplate('Empleados');
?>
<br>
<br>
<div class="container" id="tbentradas">
    <div class="card whithe">
        <div class="card-content Black-text">
            <!--Colocamos el titulo de la card-->
            <span class="card-title center-align"><b> Visualizar Empleados </b></span>
            <br>
            <!--Agregamos un botón cuya función es que nos mueste el formulario para agregar-->
            <!--un registro-->
            <div class="col s6">
                <a class="waves-effect yellow darken-3 btn modal-trigger" href="#modal_entradas">
                    <i class="material-icons left">add</i>Agregar empleado
                </a>
            </div>
            <br>
            <!--Se añade un input field el cual su función es buscar una entrada en especifico-->
            <div class="input-field col s6">
                <i class="material-icons prefix">search</i>
                <input type="text" id="autocomplete-input" class="autocomplete">
                <label for="autocomplete-input">Buscar empleado</label>
            </div>

            <!-- Modal Structure -->
            <div id="modal_entradas" class="modal">
                <div class="modal-content">
                    <h5 class="center-align">Administración de Empleados</h5>
                    <br>
                    <!--Estableciendo el tamaño de cada div correspondiente-->
                    <div class="row">
                        <!--Creamos la estructura del formulario respectivo-->
                        <form class="col-md-4">
                            <div class="row">
                                <!--Estableciendo el tamaño del que tomará el Input field-->
                                <div class="input-field col s12 m6">
                                    <input id="nombres" type="text" class="validate">
                                    <label for="nombres">Nombres</label>
                                </div>
                                <!--Estableciendo el tamaño del que tomará el Input field-->
                                <div class="input-field col s12 m6">
                                    <input id="apellidos" type="text" class="validate">
                                    <label for="apellidos">Apellidos</label>
                                </div>
                            </div>
                            <div class="row">
                                <!--Estableciendo el tamaño del que tomará el Input field-->
                                <div class="input-field col s12 m6">
                                    <input id="correo" type="text" class="validate">
                                    <label for="correo">Correo</label>
                                </div>
                                <!--Estableciendo el tamaño del que tomará el Input field-->
                                <div class="input-field col s12 m6">
                                    <input id="telefono" type="text" class="validate">
                                    <label for="telefono">Teléfono</label>
                                </div>
                            </div>
                            <div class="row">
                                <!--Textbox Autor-->
                                <div class="input-field col s12 m6 l6">
                                    <input id="dui" type="text" class="validate">
                                    <label for="dui">Dui</label>
                                </div>
                                <!--Combobox Marca-->
                                <div class="input-field col s12 m6 l6">
                                    <select>
                                        <optgroup label="Género">
                                            <option value="1">Masculino</option>
                                            <option value="2">Femenino</option>
                                        </optgroup>
                                    </select>
                                    <label>Género</label>
                                </div>
                            </div>
                            <div class="row">
                                <!--Estableciendo el tamaño del que tomará el Input field-->
                                <div class="input-field col s12">
                                    <label for="fecha">Fecha de nacimiento</label>
                                    <input type="text" class="datepicker">
                                </div>
                            </div>
                            <div class="row">
                                <!--Estableciendo el tamaño del que tomará el Input field-->
                                <div class="input-field col s12">
                                    <div class="file-field input-field">
                                        <div class="btn black">
                                            <span><i class="large material-icons">add_a_photo</i></span>
                                            <input type="file">
                                        </div>
                                        <div class="file-path-wrapper">
                                            <input placeholder="Imagen" class="file-path validate" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!--Asignamos los botones correspondientes para cada acción Scrud-->
                    <!--Especificamos con un "title" lo que realiza cada botón-->
                </div>
                <div class="modal-footer">
                    <a id="btn_confirmar" class="btn-floating btn-medium waves-effect waves-light red"
                        title="Guardar Cambios"><i class="material-icons">check</i></a>
                    <script>
                        $('#btn_confirmar').click(function () {
                            swal({
                                title: "Exito!",
                                text: "Los datos se han ingresado!",
                                icon: "success",
                            });
                        });
                    </script>
                    <a id="cancelar" class="btn-floating modal-close btn-medium waves-effect waves-light red"
                        title="Cancelar"><i class="material-icons">clear</i>
                    </a>

                </div>
            </div>
            <!--Se construye la tabla de datos correspondiente a entradas-->
            <table class="responsive-table striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                        <th>Género</th>
                        <th>Dui</th>
                        <th>Estado</th>
                        <th>Imagen</th>
                        <th>Acción</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <th>Oscar Villalobos</th>
                        <th>7942-8223</th>
                        <th>oscarv@empresa.com</th>
                        <th>Masculino</th>
                        <th>00050447-8</th>
                        <th>Activo</th>
                        <th><img class="responsive-img" src="../resources/img/tabla/man.png"></th>
                        <th><a class="btn-floating btn waves-effect waves yellow darken-3 modal-trigger"
                                href="#modal_entradas"><i class="material-icons" title="Editar registro">create</i></a>
                            <a id="btn_eliminar" class="btn-floating btn waves-effect waves yellow darken-3" href="#"><i
                                    class="material-icons" title="Eliminar registro">delete</i></a>
                            <script>
                                $("#btn_eliminar").click(function () {
                                    swal({
                                        title: "Eliminar registro",
                                        text: "¿Estas seguro de eliminar este registro?",
                                        icon: "warning",
                                        buttons: true,
                                        dangerMode: true,
                                    })
                                        .then((willDelete) => {
                                            if (willDelete) {
                                                swal("El registro se ha eliminado correctamente.", {
                                                    icon: "success",
                                                });
                                            }
                                        });
                                });
                            </script>
                        </th>
                    </tr>
                    <tr>
                        <th>Nora Puerta</th>
                        <th>8084-8223</th>
                        <th>norap@empresa.com</th>
                        <th>Femenino</th>
                        <th>25050447-8</th>
                        <th>Activo</th>
                        <th><img class="responsive-img" src="../resources/img/tabla/woman.png"></th>
                        <th><a class="btn-floating btn waves-effect waves yellow darken-3 modal-trigger"
                                href="#modal_entradas"><i class="material-icons" title="Editar registro">create</i></a>
                            <a id="btn_eliminar2" class="btn-floating btn waves-effect waves yellow darken-3"
                                href="#"><i class="material-icons" title="Eliminar registro">delete</i></a>
                            <script>
                                $("#btn_eliminar2").click(function () {
                                    swal({
                                        title: "Eliminar registro",
                                        text: "¿Estas seguro de eliminar este registro?",
                                        icon: "warning",
                                        buttons: true,
                                        dangerMode: true,
                                    })
                                        .then((willDelete) => {
                                            if (willDelete) {
                                                swal("El registro se ha eliminado correctamente.", {
                                                    icon: "success",
                                                });
                                            }
                                        });
                                });
                            </script>
                        </th>
                    </tr>
                    <tr>
                        <th>Noel Valverde</th>
                        <th>1089-8223</th>
                        <th>noelv@empresa.com</th>
                        <th>Masculino</th>
                        <th>00030447-9</th>
                        <th>Activo</th>
                        <th><img class="responsive-img" src="../resources/img/tabla/man.png"></th>
                        <th><a class="btn-floating btn waves-effect waves yellow darken-3 modal-trigger"
                            href="#modal_entradas"><i class="material-icons" title="Editar registro">create</i></a>
                        <a id="btn_eliminar" class="btn-floating btn waves-effect waves yellow darken-3" href="#"><i
                                class="material-icons" title="Eliminar registro">delete</i></a>
                        <script>
                            $("#btn_eliminar").click(function () {
                                swal({
                                    title: "Eliminar registro",
                                    text: "¿Estas seguro de eliminar este registro?",
                                    icon: "warning",
                                    buttons: true,
                                    dangerMode: true,
                                })
                                    .then((willDelete) => {
                                        if (willDelete) {
                                            swal("El registro se ha eliminado correctamente.", {
                                                icon: "success",
                                            });
                                        }
                                    });
                            });
                        </script>
                        </th>
                    </tr>
                    <tr>
                        <th>Marta Prados</th>
                        <th>8084-8228</th>
                        <th>martap@empresa.com</th>
                        <th>Femenino</th>
                        <th>44750447-8</th>
                        <th>Activo</th>
                        <th><img class="responsive-img" src="../resources/img/tabla/woman.png"></th>
                        <th><a class="btn-floating btn waves-effect waves yellow darken-3 modal-trigger"
                            href="#modal_entradas"><i class="material-icons" title="Editar registro">create</i></a>
                        <a id="btn_eliminar" class="btn-floating btn waves-effect waves yellow darken-3" href="#"><i
                                class="material-icons" title="Eliminar registro">delete</i></a>
                        <script>
                            $("#btn_eliminar").click(function () {
                                swal({
                                    title: "Eliminar registro",
                                    text: "¿Estas seguro de eliminar este registro?",
                                    icon: "warning",
                                    buttons: true,
                                    dangerMode: true,
                                })
                                    .then((willDelete) => {
                                        if (willDelete) {
                                            swal("El registro se ha eliminado correctamente.", {
                                                icon: "success",
                                            });
                                        }
                                    });
                            });
                        </script>
                        </th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<br>
<?php
  //Se imprime la plantilla del pie y se envía el nombre del controlador para la página web
  Public_Page::footerTemplate();
?>