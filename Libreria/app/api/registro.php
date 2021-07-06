<?php
require_once('../helpers/database.php');
require_once('../helpers/validator.php');
require_once('../models/usuarios.php');
require_once('../models/registro.php');

// Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
if (isset($_GET['action'])) {
    // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en el script.
    session_start();
    // Se instancia la clase correspondiente.
    $usuario = new Usuarios;
    $registro = new Registro;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'error' => 0, 'message' => null, 'exception' => null);
    // Se verifica si existe una sesión iniciada como administrador, de lo contrario se finaliza el script con un mensaje de error.
    if (isset($_SESSION['id_usuario'])) {
        // Se compara la acción a realizar cuando un administrador ha iniciado sesión.
        switch ($_GET['action']) {
            case 'logOut':
                if (session_destroy()) {
                    $result['status'] = 1;
                    $result['message'] = 'Sesión eliminada correctamente';
                } else {
                    $result['exception'] = 'Ocurrió un problema al cerrar la sesión';
                }
                break;
            case 'readAll':
                if ($result['dataset'] = $usuario->readAll()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No hay usuarios registrados';
                    }
                }
                break;
            case 'readOne':
                if ($usuario->setId($_POST['id_usuario'])) {
                    if ($result['dataset'] = $usuario->readOne()) {
                        $result['status'] = 1;
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'Usuario inexistente';
                        }
                    }
                } else {
                    $result['exception'] = 'Usuario incorrecto';
                }
                break;
            default:
                $result['exception'] = 'Acción no disponible dentro de la sesión';
        }
    }else {
        // Se compara la acción a realizar cuando el administrador no ha iniciado sesión.
        switch ($_GET['action']) {
            case 'readAll':
                if ($usuario->readAll()) {
                    $result['status'] = 1;
                    $result['message'] = 'Existe al menos un usuario registrado';
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No existen usuarios registrados';
                    }
                }
                break;
            case 'register':
                $_POST = $registro->validateForm($_POST);
                if ($registro->setNombres($_POST['nombre'])) {
                    if ($registro->setApellidos($_POST['apellido'])) {
                        if ($registro->setCorreo($_POST['correo'])) {
                            if ($registro->setTelefono($_POST['telefono'])) {
                                if ($registro->setNacimiento($_POST['fecha'])) {
                                    if (isset($_POST['genero'])) {
                                        if ($registro->setGenero($_POST['genero'])) {
                                            if($registro->setDui($_POST['dui'])){
                                                if ($registro->setUsuario($_POST['alias'])) {         
                                                    if ($_POST['contra'] == $_POST['contra2']) {
                                                        if ($registro->setClave($_POST['contra'])) {
                                                            if (isset($_POST['tipo'])) {
                                                                if($registro->setTipo($_POST['tipo'])){
                                                                    if (is_uploaded_file($_FILES['foto']['tmp_name'])) {
                                                                        if ($registro->setImagen($_FILES['foto'])) {
                                                                            if ($registro->createRow()) {
                                                                                if ($registro->saveFile($_FILES['foto'], $registro->getRuta(), $registro->getImagen())) {
                                                                                    $result['message'] = 'Producto creado correctamente';
                                                                                    if ($registro->createUser()) {
                                                                                        $result['status'] = 1;
                                                                                        $result['message'] = 'Usuario creado correctamente';
                                                                                    } else {
                                                                                    $result['exception'] = Database::getException();
                                                                                    }
                                                                                } else {
                                                                                    $result['message'] = 'Producto creado pero no se guardó la imagen';
                                                                                    if ($registro->createUser()) {
                                                                                        $result['status'] = 1;
                                                                                        $result['message'] = 'Usuario creado correctamente';
                                                                                    } else {
                                                                                        $result['exception'] = Database::getException();
                                                                                    }
                                                                                }
                                                                            } else {
                                                                                $result['exception'] = Database::getException();
                                                                                $registro->deleteAll();
                                                                                if ($registro->createRow()) {
                                                                                    if ($registro->saveFile($_FILES['foto'], $registro->getRuta(), $registro->getImagen())) {
                                                                                        $result['message'] = 'Producto creado correctamente';
                                                                                        if ($registro->createUser()) {
                                                                                            $result['status'] = 1;
                                                                                            $result['message'] = 'Usuario creado correctamente';
                                                                                        } else {
                                                                                        $result['exception'] = Database::getException();
                                                                                        }
                                                                                    } else {
                                                                                        $result['message'] = 'Producto creado pero no se guardó la imagen';
                                                                                        if ($registro->createUser()) {
                                                                                            $result['status'] = 1;
                                                                                            $result['message'] = 'Usuario creado correctamente';
                                                                                        } else {
                                                                                            $result['exception'] = Database::getException();
                                                                                        }
                                                                                    }
                                                                                } else {
                                                                                    $result['exception'] = Database::getException();
                                                                                }
                                                                            }
                                                                        } else {
                                                                            $result['exception'] = $registro->getImageError();
                                                                        }
                                                                    } else {
                                                                        $result['exception'] = 'Seleccione una imagen';
                                                                    }
                                                                } else{
                                                                    $result['exception'] = 'Tipo del usuario incorrecto';
                                                                }
                                                            } else {
                                                                $result['exception'] = 'Seleccione un Genero';
                                                            }
                                                        } else {
                                                            $result['exception'] = $usuario->getPasswordError();
                                                        }
                                                    } else {
                                                        $result['exception'] = 'Claves diferentes';
                                                    } 
                                                } else {
                                                    $result['exception'] = 'Alias incorrecto';
                                                }
                                            }else{
                                                $result['exception'] = 'DUI incorrecto';
                                            }
                                        } else {
                                            $result['exception'] = $registro->getPasswordError();
                                        }
                                    } else {
                                        $result['exception'] = 'Seleccione una categoría';
                                    }
                                } else {
                                    $result['exception'] = 'Claves diferentes';
                                }
                            } else {
                                $result['exception'] = 'Telefono incorrecto';
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
                break;
                case 'logIn':
                    $_POST = $usuario->validateForm($_POST);
                    if ($usuario->checkUser($_POST['user'])) {                        
                        if ($usuario->checkPassword($_POST['pass'])) {
                            $usuario->checkPrimerUso($_POST['user']);
                            if ($usuario->getPrimer_uso() != 1) {
                            $result['status'] = 1;
                            $result['message'] = 'Autenticación correcta';
                            $_SESSION['id_usuario'] = $usuario->getId();
                            $_SESSION['alias_usuario'] = $usuario->getAlias();
                            }
                            else {
                                $result['status'] = 2;
                                $result['message'] = 'Se debe modificar la contraseña por defecto';
                                $_SESSION['alias_usuario'] = $usuario->getAlias();
                            }
                        } else {
                            if (Database::getException()) {
                                $result['exception'] = Database::getException();
                            } else {
                                $result['exception'] = 'Clave incorrecta';
                            }
                        }
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'Alias incorrecto';
                        }
                    }
                    break;
                    case 'changePass':
                        $_POST = $usuario->validateForm($_POST);
                       // if ($usuario->setId($_POST['id_usuario'])) {
                            
                                if ($usuario->setAlias($_SESSION['alias_usuario'])) {                                    
                                        if ($_POST['contra'] == $_POST['contra2']) {                                            
                                                if ($usuario->setClave($_POST['contra'])) {
                                                    if ($usuario->recuContra()) {
                                                        $result['status'] = 1;
                                                        $result['message'] = 'Credenciales actualizadas correctamente';
                                                    } else {
                                                        $result['exception'] = Database::getException();
                                                    }
                                                } else {
                                                    $result['exception'] = $usuario->getPasswordError();
                                                }                                            
                                        } else {
                                            $result['exception'] = 'Contraseñas diferentes';
                                        }                                    
                                } else {
                                    $result['exception'] = 'Alias incorrecto';
                                }
                           // } else {
                             //   $result['exception'] = 'Usuario inexistente';
                            //}
                       
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