<?php
require_once('../helpers/database.php');
require_once('../helpers/validator.php');
require_once('../models/marca.php');

// Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
if (isset($_GET['action'])) {      
    // Se instancia la clase correspondiente.
    $prov = new Marca_crud;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'message' => null, 'exception' => null);
    // Se verifica si existe una sesión iniciada como administrador, de lo contrario se finaliza el script con un mensaje de error.
   
    // Se compara la acción a realizar cuando un administrador ha iniciado sesión.
    switch ($_GET['action']) {
        case 'readAll':
            if ($result['dataset'] = $prov->readAll()) {
                $result['status'] = 1;
            } else {
                if (Database::getException()) {
                    $result['exception'] = Database::getException();
                } else {
                    $result['exception'] = 'No hay empleados registrados';
                }
            }
            break;
            case 'readCount':
                if ($result['dataset'] = $prov->readCount()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No existen registros.';
                    }
                }
                break;
        case 'readOne':
            if ($prov->setId($_POST['id_marca'])) {
                if ($result['dataset'] = $prov->readOne()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'El empleado no existe';
                    }
                }
            } else {
                $result['exception'] = 'Empleado incorrecto';
            }
            break;
        case 'search':
            $_POST = $prov->validateForm($_POST);
            if ($_POST['search'] != '') {
                if ($result['dataset'] = $prov->searchRows($_POST['search'])) {
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
        case 'create':
            $_POST = $prov->validateForm($_POST);
            if ($prov->setNombre($_POST['nombre'])) {
                if ($prov->createRow()) {
                        $result['status'] = 1;
                        $result['message'] = 'marca creada correctamente';
                } else {
                        $result['exception'] = Database::getException();;
                }
            }
            else {
                $result['exception'] = 'Nombres incorrectos';
            }
            break;
        case 'update':
            $_POST = $prov->validateForm($_POST);
            if ($prov->setId($_POST['id_marca'])) {
                if($data = $prov->readOne()){
                    if ($prov->setNombre($_POST['nombre'])) {
                        if ($prov->updateRow()) {
                                $result['status'] = 1;
                                $result['message'] = 'Proveedor modificado correctamente';
                        } else {
                                $result['exception'] = Database::getException();;
                        }
                    }
                    else {
                        $result['exception'] = 'Nombres incorrectos';
                    }
                }
                else{
                    $result['exception'] = 'Marca inexistente';
                }
            }
            else{
                $result['exception'] = 'Marca incorrectos';
            }
            break;
            case 'delete':
                // if ($_POST['id_empleado'] != $_SESSION['id_empleado']) {
                if ($prov->setId($_POST['id_marca'])) {
                    if ($data = $prov->readOne()) {
                        if ($prov->deleteRow()) {
                            $result['status'] = 1;
                            $result['message'] = 'Marca eliminado correctamente';
                        } else {
                            $result['exception'] = Database::getException();
                        }
                    } else {
                        $result['exception'] = 'Marca inexistente';
                    }
                } else {
                    $result['exception'] = 'Marca incorrecto';
                }
                // } else {
                //   $result['exception'] = 'No se puede eliminar a sí mismo';
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
