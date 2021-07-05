<?php
require_once('../helpers/database.php');
require_once('../helpers/validator.php');
require_once('../models/perfil.php');

// Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
if (isset($_GET['action'])) {
    // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en el script.
    session_start();
    // Se instancia la clase correspondiente.
    $usuario = new Perfil;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'message' => null, 'exception' => null);
    // Se verifica si existe una sesión iniciada como administrador, de lo contrario se finaliza el script con un mensaje de error.
    if (isset($_SESSION['id_usuario'])) {
        // Se compara la acción a realizar cuando un administrador ha iniciado sesión.
        switch ($_GET['action']) {
            //Método para consultar la existencia de un empleado
            case 'readOne':
                if ($usuario->setId($_POST['id_empleado'])) {
                    if ($result['dataset'] = $usuario->readOne()) {
                        $result['status'] = 1;
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'Empleado inexistente';
                        }
                    }
                } else {
                    $result['exception'] = 'Empleado incorrecto';
                }
                break;
            //Método para consultar la información del empleado que ha iniciado sesión
            //y mostrarla en la página de bienvenida
            case 'openName':
                if ($result['dataset'] = $usuario->readOne1()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'Empleado inexistente';
                    }
                }
                break;
            //Método para consultar la información del empleado para mandarla al modal
            case 'readEmfileds':
                if ($result['dataset'] = $usuario->readEmfileds()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'Empleado inexistente';
                    }
                }
                break;
            //Método para actualizar la información del empleado que se encuentra iniciado sesión
            case 'updateProfile':
                $_POST = $usuario->validateForm($_POST);
                if ($usuario->setId($_POST['id_empleado'])) {
                    if ($data = $usuario->readOne()) {
                        if ($usuario->setNombre($_POST['nombre'])) {
                            if ($usuario->setApellido($_POST['apellido'])) {
                                if ($usuario->setCorreo($_POST['correo'])) {
                                    if ($usuario->setTel($_POST['tel'])) {
                                        if (is_uploaded_file($_FILES['archivo']['tmp_name'])) {
                                            if ($usuario->setImagen($_FILES['archivo'])) {
                                                if ($usuario->updateRowProfile($data['imagen'])) {
                                                    $result['status'] = 1;
                                                    if ($usuario->saveFile($_FILES['archivo'], $usuario->getRuta(), $usuario->getImagen())) {
                                                        $result['message'] = 'Perfil actualizado correctamente';
                                                    } else {
                                                        $result['message'] = 'Perfil actualizado pero no se guardó la imagen';
                                                    }
                                                } else {
                                                    $result['exception'] = Database::getException();
                                                }
                                            } else {
                                                $result['exception'] = $usuario->getImageError();
                                            }
                                        } else {
                                            if ($usuario->updateRowProfile($data['imagen'])) {
                                                $result['status'] = 1;
                                                $result['message'] = 'Perfil actualizado correctamente';
                                            } else {
                                                $result['exception'] = Database::getException();
                                            }
                                        }
                                    } else {
                                        $result['exception'] = 'Teléfono incorrecto';
                                    }
                                } else {
                                    $result['exception'] = 'Correo incorrecto';
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
            //Método para actualizar las credenciales del empleado 
            //que ha iniciado sesión
            case 'updateUserCredentials':
                $_POST = $usuario->validateForm($_POST);
                if ($usuario->setId($_POST['id_usuario'])) {
                    if ($data = $usuario->readOneuser()) {
                        if ($usuario->setAlias($_POST['alias'])) {
                            if ($_POST['ncontra'] != '' && $_POST['ncontra1'] != '') {
                                if ($_POST['ncontra'] == $_POST['ncontra1']) {
                                    if ($usuario->checkPassword($_POST['contra'])) {
                                        if ($usuario->setClave($_POST['ncontra'])) {
                                            if ($usuario->updateUserCredentials()) {
                                                $result['status'] = 1;
                                                $result['message'] = 'Credenciales actualizadas correctamente';
                                            } else {
                                                $result['exception'] = Database::getException();
                                            }
                                        } else {
                                            $result['exception'] = $usuario->getPasswordError();
                                        }
                                    } else {
                                        if (Database::getException()) {
                                            $result['exception'] = Database::getException();
                                        } else {
                                            $result['exception'] = 'Clave incorrecta';
                                        }
                                    }
                                } else {
                                    $result['exception'] = 'Contraseñas diferentes';
                                }
                            } else {
                                if ($usuario->checkPassword($_POST['contra'])) {
                                    if ($usuario->updateUserCredentials2()) {
                                        $result['status'] = 1;
                                        $result['message'] = 'Credenciales actualizadas correctamente';
                                    } else {
                                        $result['exception'] = Database::getException();
                                    }
                                } else {
                                    if (Database::getException()) {
                                        $result['exception'] = Database::getException();
                                    } else {
                                        $result['exception'] = 'Clave incorrecta';
                                    }
                                }
                            }
                        } else {
                            $result['exception'] = 'Alias incorrecto';
                        }
                    } else {
                        $result['exception'] = 'Usuario inexistente';
                    }
                } else {
                    $result['exception'] = 'Usuario incorrecto';
                }
                break;
            default:
                $result['exception'] = 'Acción no disponible dentro de la sesión';
        }
        // Se indica el tipo de contenido a mostrar y su respectivo conjunto de caracteres.
        header('content-type: application/json; charset=utf-8');
        // Se imprime el resultado en formato JSON y se retorna al controlador.
        print(json_encode($result));
    } else {
        print(json_encode('Acceso denegado'));
    }
} else {
    print(json_encode('Recurso no disponible'));
}
