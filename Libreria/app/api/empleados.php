<?php
require_once('../helpers/database.php');
require_once('../helpers/validator.php');
require_once('../models/empleados.php');

// Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
if (isset($_GET['action'])) {      
    // Se instancia la clase correspondiente.
    $empl = new Empleados;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'message' => null, 'exception' => null);
    // Se verifica si existe una sesión iniciada como administrador, de lo contrario se finaliza el script con un mensaje de error.
   
    // Se compara la acción a realizar cuando un administrador ha iniciado sesión.
    switch ($_GET['action']) {
        case 'readAll':
            if ($result['dataset'] = $empl->readAll()) {
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
                if ($result['dataset'] = $empl->readCount()) {
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
            if ($empl->setId($_POST['id_empleado'])) {
                if ($result['dataset'] = $empl->readOne()) {
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
            $_POST = $empl->validateForm($_POST);
            if ($_POST['search'] != '') {
                if ($result['dataset'] = $empl->searchRows($_POST['search'])) {
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
            $_POST = $empl->validateForm($_POST);
            if ($empl->setNombre($_POST['nombres'])) {
                if ($empl->setApellido($_POST['apellidos'])) {
                    if ($empl->setCorreo($_POST['correo'])) {
                        if ($empl->setTel($_POST['telefono'])) {
                            if ($empl->setGen($_POST['genero'])) {
                                if ($empl->setDui($_POST['dui'])) {
                                    if ($empl->setFecha($_POST['fecha'])) {
                                        if ($empl->setEstado($_POST['estado'])) {
                                            if (is_uploaded_file($_FILES['imagen']['tmp_name'])) {
                                                if ($empl->setImagen($_FILES['imagen'])) {
                                                    if ($empl->createRow()) {
                                                        $result['status'] = 1;
                                                        if ($empl->saveFile($_FILES['imagen'], $empl->getRuta(), $empl->getImagen())) {
                                                            $result['message'] = 'Empleado creado correctamente';
                                                        } else {
                                                            $result['message'] = 'Empleado creado pero no se guardó la imagen';
                                                        }
                                                    } else {
                                                        $result['exception'] = Database::getException();;
                                                    }
                                                } else {
                                                    $result['exception'] = $empl->getImageError();
                                                }
                                            } else {
                                                $result['exception'] = 'Seleccione una imagen';
                                            }
                                        } else {
                                            $result['exception'] = 'Estado no seleccionado';
                                        }
                                    } else {
                                        $result['exception'] = 'Fecha incorrecta';
                                    }
                                } else {
                                    $result['exception'] = 'DUI incorrecto';
                                }
                            } else {
                                $result['exception'] = 'Genero no seleccionado';
                            }
                        } else {
                            $result['exception'] = 'Teléfono incorrecto';
                        }
                    } else {
                        $result['exception'] = 'Formato de correo incorrecto';
                    }
                } else {
                    $result['exception'] = 'Apellidos incorrectos';
                }
            } else {
                $result['exception'] = 'Nombres incorrectos';
            }
            break;
        case 'update':
            $_POST = $empl->validateForm($_POST);
            if ($empl->setId($_POST['id_empleado'])) {
                if ($data = $empl->readOne()) {
                    if ($empl->setNombre($_POST['nombres'])) {
                        if ($empl->setApellido($_POST['apellidos'])) {
                            if ($empl->setCorreo($_POST['correo'])) {
                                if ($empl->setTel($_POST['telefono'])) {
                                    if ($empl->setGen($_POST['genero'])) {
                                        if ($empl->setDui($_POST['dui'])) {
                                            if ($empl->setFecha($_POST['fecha'])) {
                                                if ($empl->setEstado($_POST['estado'])) {
                                                    if (is_uploaded_file($_FILES['imagen']['tmp_name'])) {
                                                        if ($empl->setImagen($_FILES['imagen'])) {
                                                            if ($empl->updateRow($data['imagen'])) {
                                                                $result['status'] = 1;
                                                                if ($empl->saveFile($_FILES['imagen'], $empl->getRuta(), $empl->getImagen())) {
                                                                    $result['message'] = 'Empleado modificado correctamente';
                                                                } else {
                                                                    $result['message'] = 'Empleado modificado pero no se guardó la imagen';
                                                                }
                                                            } else {
                                                                $result['exception'] = Database::getException();
                                                            }
                                                        } else {
                                                            $result['exception'] = $empl->getImageError();
                                                        }
                                                    } else {
                                                        if ($empl->updateRow($data['imagen'])) {
                                                            $result['status'] = 1;
                                                            $result['message'] = 'Empleado modificado correctamente';
                                                        } else {
                                                            $result['exception'] = Database::getException();
                                                        }
                                                    }
                                                } else {
                                                    $result['exception'] = 'Estado no seleccionado';
                                                }
                                            } else {
                                                $result['exception'] = 'Fecha incorrecta';
                                            }
                                        } else {
                                            $result['exception'] = 'DUI incorrecto';
                                        }
                                    } else {
                                        $result['exception'] = 'Genero no seleccionado';
                                    }
                                } else {
                                    $result['exception'] = 'Teléfono incorrecto';
                                }
                            } else {
                                $result['exception'] = 'Formato de correo incorrecto';
                            }
                        } else {
                            $result['exception'] = 'Apellidos incorrectos';
                        }
                    } else {
                        $result['exception'] = 'Nombres incorrectos';
                    }
                } else {
                    $result['exception'] = 'Empleado inexistente';
                }
            } else {
                $result['exception'] = 'Empleado incorrecto';
            }
            break;
            case 'delete':
                // if ($_POST['id_empleado'] != $_SESSION['id_empleado']) {
                if ($empl->setId($_POST['id_empleado'])) {
                    if ($data = $empl->readOne()) {
                        if ($empl->deleteRow()) {
                            $result['status'] = 1;
                            if ($empl->deleteFile($empl->getRuta(), $data['imagen'])) {
                                $result['message'] = 'Empleado eliminado correctamente';
                            } else {
                                $result['message'] = 'Empleado eliminado pero no se borró la imagen';
                            }
                        } else {
                            $result['exception'] = Database::getException();
                        }
                    } else {
                        $result['exception'] = 'Empleado inexistente';
                    }
                } else {
                    $result['exception'] = 'Empleado incorrecto';
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
