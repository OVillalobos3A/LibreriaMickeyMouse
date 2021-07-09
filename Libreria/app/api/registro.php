<?php

//Se llaman los archivos necesarios
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

            //Este case se utiliza para consultar los usuarios registrados
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
            
            //Este case se utiliza para crear el primer usuario
            case 'register':
                //Validamos el formulario y envíamos los datos al modelo
                $_POST = $registro->validateForm($_POST);
                if ($registro->setNombres($_POST['nombre'])) {
                    if ($registro->setApellidos($_POST['apellido'])) {
                        if ($registro->setCorreo($_POST['correo'])) {
                            if ($registro->setTelefono($_POST['telefono'])) {
                                if ($registro->setNacimiento($_POST['fecha'])) {
                                    //Se verifica que se selecciones alguna opción del combobox
                                    if (isset($_POST['genero'])) {
                                        if ($registro->setGenero($_POST['genero'])) {
                                            if($registro->setDui($_POST['dui'])){
                                                if ($registro->setUsuario($_POST['alias'])) {         
                                                    //Se verifica si las contraseñas son iguales
                                                    if ($_POST['contra'] == $_POST['contra2']) {
                                                        if ($registro->setClave($_POST['contra'])) {
                                                            //Se verifica que se selecciones alguna opción del combobox
                                                            if (isset($_POST['tipo'])) {
                                                                if($registro->setTipo($_POST['tipo'])){
                                                                    //Se verifica si hay un archivo de imagen
                                                                    if (is_uploaded_file($_FILES['foto']['tmp_name'])) {
                                                                        if ($registro->setImagen($_FILES['foto'])) {
                                                                            //Se crea el primer empleado
                                                                            if ($registro->createRow()) {
                                                                                if ($registro->saveFile($_FILES['foto'], $registro->getRuta(), $registro->getImagen())) {
                                                                                    //Se crean las credenciales de acceso al sistema del usuario
                                                                                    if ($registro->createUser()) {
                                                                                        $result['status'] = 1;
                                                                                        $result['message'] = 'Usuario creado correctamente';
                                                                                    } else {
                                                                                    $result['exception'] = Database::getException();
                                                                                    }
                                                                                } else {
                                                                                    //Se crean las credenciales de acceso al sistema del usuario
                                                                                    if ($registro->createUser()) {
                                                                                        $result['status'] = 1;
                                                                                        $result['message'] = 'Usuario creado correctamente';
                                                                                    } else {
                                                                                        $result['exception'] = Database::getException();
                                                                                    }
                                                                                }
                                                                            } else {
                                                                                //Se eliminan los anteriores registros si en caso exista un empleado anteriormente ingresado
                                                                                if ($registro->deleteAll()) {
                                                                                    //Se crea un nuevo empleado
                                                                                    if ($registro->createRow()) {
                                                                                        //Se ejecuta el proceso de guardar imagen
                                                                                        if ($registro->saveFile($_FILES['foto'], $registro->getRuta(), $registro->getImagen())) {
                                                                                            //Se crean las credenciales de acceso al sistema del usuario
                                                                                            if ($registro->createUser()) {
                                                                                                $result['status'] = 1;
                                                                                                $result['message'] = 'Usuario creado correctamente';
                                                                                            } else {
                                                                                            $result['exception'] = Database::getException();
                                                                                            }
                                                                                        } else {
                                                                                            //Se crean las credenciales de acceso al sistema del usuario
                                                                                            if ($registro->createUser()) {
                                                                                                $result['status'] = 1;
                                                                                                $result['message'] = 'Usuario creado pero no se guardó la imagen';
                                                                                            } else {
                                                                                                $result['exception'] = Database::getException();
                                                                                            }
                                                                                        }
                                                                                    } else {
                                                                                        $result['exception'] = Database::getException();
                                                                                    }
                                                                                } else {
                                                                                    $result['exception'] = Database::getException();
                                                                                }
                                                                            }
                                                                        } else {
                                                                            $result['exception'] = $registro->getImageError();
                                                                        }
                                                                    } else {
                                                                        $result['exception'] = 'Selecciona una imagen';
                                                                    }
                                                                } else{
                                                                    $result['exception'] = 'El Tipo del usuario a sido ingresado de manera incorrecta';
                                                                }
                                                            } else {
                                                                $result['exception'] = 'Selecciona un Genero';
                                                            }
                                                        } else {
                                                            $result['exception'] = $usuario->getPasswordError();
                                                        }
                                                    } else {
                                                        $result['exception'] = 'Las contraseñas ingresadas no coinciden';
                                                    } 
                                                } else {
                                                    $result['exception'] = 'Tu Alias no está permitido. Prueba con un distinto';
                                                }
                                            }else{
                                                $result['exception'] = 'Verifica que tu DUI haya sido ingresado de la manera correcta';
                                            }
                                        } else {
                                            $result['exception'] = $registro->getPasswordError();
                                        }
                                    } else {
                                        $result['exception'] = 'Selecciona una categoría';
                                    }
                                } else {
                                    $result['exception'] = 'Verifica tu fecha de nacimiento';
                                }
                            } else {
                                $result['exception'] = 'Verifica que tu Teléfono se haya ingresado correctamente. Debería de tener el siguiente formato: (0000-0000)';
                            }
                        } else {
                            $result['exception'] = 'Verifica que hayas ingresa tu dirección de Correo de manera correcta';
                        }
                    } else {
                        $result['exception'] = 'Apellidos incorrectos';
                    }
                } else {
                    $result['exception'] = 'Nombres incorrectos';
                }
                break;

                //Este case se utiliza para verificar las credenciales de acceso al sistema
                case 'logIn':
                    //Se valida el formulario
                    $_POST = $usuario->validateForm($_POST);
                    //Se verifica que usuario
                    if ($usuario->checkUser($_POST['user'])) {
                        //Se verifica que la contraseña coincida
                        if ($usuario->checkPassword($_POST['pass'])) {
                            //Se verifica el primer uso de los usuarios no rooteados
                            $usuario->checkPrimerUso($_POST['user']);
                            //Se verifica que el primer uso no esté setea
                            if ($usuario->getPrimer_uso() != 1) {
                            $result['status'] = 1;
                            $result['message'] = 'Autenticación correcta';
                            //Se setea el id en la variable "Session"
                            $_SESSION['id_usuario'] = $usuario->getId();
                            //Se setea el alias del usuario en la variable "Session"
                            $_SESSION['alias_usuario'] = $usuario->getAlias();
                            }
                            else {
                                $result['status'] = 2;
                                $result['message'] = 'Se debe modificar la contraseña por defecto';
                                //Se setea el alias en la variable "Session"
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

                    //Este case se utiliza para cambiar la contraseña del los usuarios no rooteados
                    case 'changePass':
                        //Se valida el formulario
                        $_POST = $usuario->validateForm($_POST);
                       // if ($usuario->setId($_POST['id_usuario'])) {
                            if ($usuario->setAlias($_SESSION['alias_usuario'])) {  
                                    //Se verifican las contraseñas                                  
                                    if ($_POST['contra'] == $_POST['contra2']) {                                            
                                            if ($usuario->setClave($_POST['contra'])) {
                                                //Se ejecuta la recuperacion de contraseña
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