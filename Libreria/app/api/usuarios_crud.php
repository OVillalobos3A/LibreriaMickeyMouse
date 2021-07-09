<?php
require_once('../helpers/database.php');
require_once('../helpers/validator.php');
require_once('../models/usuarios_crud.php');

// Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
if (isset($_GET['action'])) {
    // Se instancia la clase correspondiente.
    $usuarios = new UsuariosCrud;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'message' => null, 'exception' => null);
    // Se verifica si existe una sesión iniciada como administrador, de lo contrario se finaliza el script con un mensaje de error.

    // Se compara la acción a realizar cuando un administrador ha iniciado sesión.
    switch ($_GET['action']) {
        case 'readAll':
            if ($result['dataset'] = $usuarios->readAll()) {
                $result['status'] = 1;
            } else {
                if (Database::getException()) {
                    $result['exception'] = Database::getException();
                } else {
                    $result['exception'] = 'No hay usuarios registrados';
                }
            }
            break;
        case 'create':
            $_POST = $usuarios->validateForm($_POST);
            if ($usuarios->setUsuario($_POST['usuario'])) {
                if ($usuarios->setClave($_POST['contraseña'])) {
                    if ($usuarios->setEstado($_POST['estado'])) {
                        if (isset($_POST['empleado'])) {
                            if ($usuarios->setEmpleado($_POST['empleado'])) {
                                if (isset($_POST['tipo_usuario'])) {
                                    if ($usuarios->setTipo_usuario($_POST['tipo_usuario'])) {
                                        if ($usuarios->createRow()) {
                                            $result['status'] = 1;
                                            $result['message'] = 'Empleado creado correctamente';
                                        } else {
                                            $result['exception'] = Database::getException();;
                                        }
                                    }
                                } else {
                                    $result['exception'] = 'Seleccione un tipo de usuario';
                                }
                            } else {
                                $result['exception'] = 'Seleccione un empleado';
                            }
                        } else {
                            $result['exception'] = 'Empleado incorrecto';
                        }
                    } else {
                        $result['exception'] = 'Error al asignar el estado';
                    }
                } else {
                    $result['exception'] = 'Error al asignar la contraseña';
                }
            } else {
                $result['exception'] = 'Usuario incorrecto';
            }
            break;
        case 'readOne':
            if ($usuarios->setId($_POST['id_usuario'])) {
                if ($result['dataset'] = $usuarios->readOne()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'El usuario no existe';
                    }
                }
            } else {
                $result['exception'] = 'Producto incorrecto';
            }
            break;
        case 'search':
            $_POST = $usuarios->validateForm($_POST);
            if ($_POST['search'] != '') {
                if ($result['dataset'] = $usuarios->searchRows($_POST['search'])) {
                    $result['status'] = 1;
                    $rows = count($result['dataset']);
                    if ($rows > 1) {
                        $result['message'] = 'Se encontraron ' . $rows . ' coincidencias';
                    } else {
                        $result['message'] = 'Solo existe una coincidencia';
                    }
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No hay coincidencias';
                    }
                }
            } else {
                $result['exception'] = 'Ingrese un valor para buscar';
            }
            break;
        case 'update':
            $_POST = $usuarios->validateForm($_POST);
            if ($usuarios->setId($_POST['id_usuario'])) {
                if ($data = $usuarios->readOne()) {
                    if ($usuarios->setUsuario($_POST['usuario'])) {
                        if ($usuarios->setEmpleado($_POST['empleado'])) {
                            if ($usuarios->setTipo_usuario($_POST['tipo_usuario'])) {
                                if ($usuarios->setEstado($_POST['estado'])) {
                                    if ($usuarios->updateRow()) {
                                        $result['status'] = 1;
                                        $result['message'] = 'Usuario modificado correctamente';
                                    } else {
                                        $result['exception'] = Database::getException();
                                    }
                                } else {
                                    $result['exception'] = 'El estado es incorrecto';
                                }
                            } else {
                                $result['exception'] = 'El tipo de usuario es incorrecto';
                            }
                        } else {
                            $result['exception'] = 'Error al asignar empleado';
                        }
                    } else {
                        $result['exception'] = 'Nombre de usuario invalido';
                    }
                } else {
                    $result['exception'] = 'Usuario inexistente';
                }
            } else {
                $result['exception'] = 'Usuario incorrecto';
            }
            break;
        case 'delete':
            //if ($_POST['id_usuario'] != $_SESSION['id_usuario']) {
            if ($usuarios->setId($_POST['id_usuario'])) {
                if ($data = $usuarios->readOne()) {
                    if ($usuarios->deleteRow()) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = Database::getException();
                    }
                } else {
                    $result['exception'] = 'Usuario inexistente';
                }
            } else {
                $result['exception'] = 'Usuario incorrecto';
            }
            //} else {
            //  $result['exception'] = 'No se puede eliminar a si mismo';
            //}
            break;
        default:
            $result['exception'] = 'Acción no disponible fuera de la sesión';
    }
    // Se indica el tipo de contenido a mostrar y su respectivo conjunto de caracteres.
    header('content-type: application/json; charset=utf-8');
    // Se imprime el resultado en formato JSON y se retorna al controlador.
    print(json_encode($result));
} else {
    print(json_encode('Recurso no disponible'));
}
