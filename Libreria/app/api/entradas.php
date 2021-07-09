<?php
require_once('../helpers/database.php');
require_once('../helpers/validator.php');
require_once('../models/entradas.php');

// Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
if (isset($_GET['action'])) {
    // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en el script.
    session_start();
    // Se instancia la clase correspondiente.
    $entradas = new Entradas;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'error' => 0, 'message' => null, 'exception' => null);
    // Se verifica si existe una sesión iniciada como administrador, de lo contrario se finaliza el script con un mensaje de error.
    if (isset($_SESSION['id_usuario'])) {
        // Se compara la acción a realizar cuando un administrador ha iniciado sesión.
        switch ($_GET['action']) {
            case 'readAll':
                if ($result['dataset'] = $entradas->readAll()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No hay entradas registradas';
                    }
                }
                break;
            case 'readProd':
                if ($result['dataset'] = $entradas->readProd()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No hay productos registradas';
                    }
                }
                break;
                case 'search':
                    $_POST = $entradas->validateForm($_POST);                    
                        if ($result['dataset'] = $entradas->searchRows($_POST['search'])) {
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
                    break;
            case 'create':
                $_POST = $entradas->validateForm($_POST);
                if ($entradas->setCantidad($_POST['cantidad'])) {
                    if ($entradas->setFecha($_POST['fecha'])) {
                        if ($entradas->readEmpl()) {
                            if (isset($_POST['producto'])) {
                                if ($entradas->setProducto($_POST['producto'])) {
                                    if ($entradas->createRow()) {
                                        if ($entradas->readAct()) {
                                            $entradas->setCantidad_act($entradas->getSumar() + $entradas->getCantidad());
                                            if ($entradas->updateInventario()) {
                                                $result['status'] = 1;
                                                $result['message'] = 'La entrada se ha registrado correctamente';
                                            } else {
                                                $result['exception'] = Database::getException();
                                            }
                                        } else {
                                            $result['exception'] = 'Ocurrió un error al intentar actualizar el stock.';
                                        }
                                    } else {
                                        $result['exception'] = Database::getException();;
                                    }
                                }
                            } else {
                                $result['exception'] = 'Seleccione un tipo de usuario';
                            }
                        } else {
                            $result['exception'] = 'Error al asignar el empleado';
                        }
                    } else {
                        $result['exception'] = 'Error al asignar la fecha.';
                    }
                } else {
                    $result['exception'] = 'Error al asignar la cantidad a ingresar.';
                }
                break;                
            case 'updateProduct':
                $_POST = $entradas->validateForm($_POST);
                if ($entradas->setId($_POST['id_usuario'])) {
                    if ($entradas->readAct()) {
                        $entradas->setCantidad_act($entradas->getSumar() + $entradas->getCantidad());
                        if ($entradas->updateInventario()) {
                            $result['status'] = 1;
                            $result['message'] = 'Usuario modificado correctamente';
                        } else {
                            $result['exception'] = Database::getException();
                        }
                    } else {
                        $result['exception'] = 'Nombre de usuario invalido';
                    }
                } else {
                    $result['exception'] = 'Usuario incorrecto';
                }
                break;
            case 'delete':
                if ($entradas->setId($_POST['id_entrada'])) {
                    if ($entradas->setCantidad($_POST['cantidad'])) {
                        if ($entradas->setProducto($_POST['id_inventario'])) {
                            //if ($data = $entradas->readOne()) {
                            if ($entradas->deleteRow()) {
                                if ($entradas->readAct()) {
                                    $entradas->setCantidad_act($entradas->getSumar() - $entradas->getCantidad());
                                    if ($entradas->updateInventario()) {
                                        $result['status'] = 1;
                                        $result['message'] = 'La entrada se ha eliminado correctamente';
                                    } else {
                                        $result['exception'] = Database::getException();
                                    }
                                } else {
                                    $result['exception'] = 'Ocurrió un error al intentar actualizar el stock.';
                                }
                            } else {
                                $result['exception'] = Database::getException();
                            }
                            //} else {
                            //  $result['exception'] = 'Usuario inexistente';
                            //}
                        } else {
                            $result['exception'] = 'Ocurrió un error al intentar eliminar la entrada.';
                        }
                    } else {
                        $result['exception'] = 'Ocurrió un error en el proceso de eliminación de la entrada.';
                    }
                } else {
                    $result['exception'] = 'Entrada incorrecta.';
                }
                break;

            default:
                $result['exception'] = 'Acción no disponible fuera de la sesión';
        }
    }
    // Se indica el tipo de contenido a mostrar y su respectivo conjunto de caracteres.
    header('content-type: application/json; charset=utf-8');
    // Se imprime el resultado en formato JSON y se retorna al controlador.
    print(json_encode($result));
} else {
    print(json_encode('Recurso no disponible'));
}
