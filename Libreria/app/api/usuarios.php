<?php
require_once('../helpers/database.php');
require_once('../helpers/validator.php');
require_once('../models/usuarios.php');
require_once('../helpers/email.php');

// Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
if (isset($_GET['action'])) {
    // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en el script.
    session_start();
    // Se instancia la clase correspondiente.
    $usuario = new Usuarios;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'error' => 0, 'message' => null, 'exception' => null);
    // Se verifica si existe una sesión iniciada como administrador, de lo contrario se finaliza el script con un mensaje de error.
    if (isset($_SESSION['id_usuario'])) {
        $fechaGuardada = $_SESSION["ultimoAcceso"];
        date_default_timezone_set('America/El_Salvador');
        $ahora = date("Y-n-j H:i:s");
        $tiempo_transcurrido = (strtotime($ahora) - strtotime($fechaGuardada));
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
            case 'timeOut':
                //comparamos el tiempo transcurrido
                if ($tiempo_transcurrido >= 300) {
                    $result['status'] = 1;
                    //si pasaron 5 minutos o más
                    session_destroy(); // destruyo la sesión                    
                    //si no, actualizo la fecha de la sesión
                } else {
                    $_SESSION["ultimoAcceso"] = $ahora;
                }
                break;
            case 'search':
                $_POST = $usuario->validateForm($_POST);
                if ($_POST['search'] != '') {
                    if ($result['dataset'] = $usuario->searchRows($_POST['search'])) {
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
                $_POST = $usuario->validateForm($_POST);
                if ($usuario->setNombres($_POST['nombre_usuario'])) {
                    if ($usuario->setApellidos($_POST['apellido_usuario'])) {
                        if ($usuario->setCorreo($_POST['correo_usuario'])) {
                            if ($usuario->setAlias($_POST['alias_usuario'])) {
                                if ($_POST['clave_usuario'] == $_POST['confirmar_clave']) {
                                    if ($usuario->setClave($_POST['clave_usuario'])) {
                                        if ($usuario->setDui($POST['dui_usuario'])) {
                                            if ($usuario->setTipo($_POST['tipo_usuario'])) {
                                                if ($usuario->setDireccion($POST['direccion_usuario'])) {
                                                    if ($usuario->setEstado(isset($_POST['estado_usuario']) ? 1 : 0)) {
                                                        if ($usuario->createRow()) {
                                                            $result['status'] = 1;
                                                            $result['message'] = 'Usuario creado correctamente';
                                                        } else {
                                                            $result['exception'] = Database::getException();
                                                        }
                                                    } else {
                                                        $result['exception'] = 'EStado incorrecto';
                                                    }
                                                } else {
                                                    $result['exception'] = 'Direccion incorrecta';
                                                }
                                            } else {
                                                $result['exception'] = 'Tipo de usuario incorrecto';
                                            }
                                        } else {
                                            $result['exception'] = 'dui incorrecto';
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
            case 'update':
                $_POST = $usuario->validateForm($_POST);
                if ($usuario->setId($_POST['id_usuario'])) {
                    if ($usuario->readOne()) {
                        if ($usuario->setNombres($_POST['nombre_usuario'])) {
                            if ($usuario->setApellidos($_POST['apellido_usuario'])) {
                                if ($usuario->setCorreo($_POST['email_usuario'])) {
                                    if ($usuario->setDui($_POST['dui'])) {
                                        if ($usuario->setDireccion($_POST['direccion_usuario'])) {
                                            if ($usuario->setTipo(isset($_POST['tipo_usuario']) ? 1 : 2)) {
                                                if ($usuario->setEstado(isset($_POST['estado']) ? 1 : 0)) {
                                                    if ($usuario->updateRow()) {
                                                        $result['status'] = 1;
                                                        $result['message'] = 'Usuario modificado correctamente';
                                                    } else {
                                                        $result['exception'] = Database::getException();
                                                    }
                                                }
                                            } else {
                                                $result['exception'] = 'Estado incorrecto';
                                            }
                                        } else {
                                            $result['exception'] = 'Tipo de usuario incorrecto';
                                        }
                                    } else {
                                        $result['exception'] = 'Direccion incorrecta';
                                    }
                                } else {
                                    $result['exception'] = 'DUI incorrecto';
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
                    $result['exception'] = 'Usuario inexistente';
                }
                break;
            case 'delete':
                if ($_POST['id_usuario'] != $_SESSION['id_usuario']) {
                    if ($usuario->setId($_POST['id_usuario'])) {
                        if ($usuario->readOne()) {
                            if ($usuario->deleteRow()) {
                                $result['status'] = 1;
                                $result['message'] = 'Usuario eliminado correctamente';
                            } else {
                                $result['exception'] = Database::getException();
                            }
                        } else {
                            $result['exception'] = 'Usuario inexistente';
                        }
                    } else {
                        $result['exception'] = 'Usuario incorrecto';
                    }
                } else {
                    $result['exception'] = 'No se puede eliminar a sí mismo';
                }
                break;
            default:
                $result['exception'] = 'Acción no disponible dentro de la sesión';
        }
    } else {
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
                $_POST = $usuario->validateForm($_POST);
                if ($usuario->setNombres($_POST['nombres'])) {
                    if ($usuario->setApellidos($_POST['apellidos'])) {
                        if ($usuario->setCorreo($_POST['correo'])) {
                            if ($usuario->setAlias($_POST['alias'])) {
                                if ($_POST['clave1'] == $_POST['clave2']) {
                                    if ($usuario->setClave($_POST['clave1'])) {
                                        if ($usuario->setDui($_POST['dui_us uario'])) {
                                            if ($usuario->setDireccion($_POST['direccion_usuario'])) {
                                                if ($usuario->setTipo($_POST['tipo_usuario'])) {
                                                    if ($usuario->setEstado(isset($_POST['estado_usuario']) ? 1 : 0)) {
                                                        if ($usuario->createRow()) {
                                                            $result['status'] = 1;
                                                            $result['message'] = 'Usuario registrado correctamente';
                                                        } else {
                                                            $result['exception'] = Database::getException();
                                                        }
                                                    } else {
                                                        $result['exception'] = 'Estado incorrecto';
                                                    }
                                                } else {
                                                    $result['exception'] = 'Tipo de usuario incorrecto';
                                                }
                                            } else {
                                                $result['exception'] = 'Direccion incorrecta';
                                            }
                                        } else {
                                            $result['exception'] = 'DUI incorrecto';
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
                case 'sendEmail':
                    $_POST = $usuario->validateForm($_POST);
                    // Generamos el codigo de seguridad 
                    $code = rand(999999, 111111);
                    // Concatenamos el codigo generado dentro del mensaje a enviar
                    $message = "Has solicitado recuperar tu contraseña por medio de correo electrónico, su código de seguridad es: $code";
                    // Colocamos el asunto del correo a enviar
                    $asunto = "Recuperación de contraseña Libreria Mickey Mouse";
                    // Validmos el formato del mensaje que se enviara en el correo
                    if ($email->setMensaje($message)) {
                        // Validamos si el correo ingresado tiene formato correcto
                        if ($email->setCorreo($_POST['correo'])) {
                            if ($email->validarCorreo()) {
                                // Validamos si el correo ingresado tiene formato correcto
                                if ($email->setAsunto($asunto)) {
                                    // Ejecutamos la funcion para enviar el correo electronico
                                    if ($email->enviarCorreo()) {
                                        $result['status'] = 1;
                                        // Colocamos el mensaje de exito 
                                        $result['message'] = 'Código enviado correctamente';
                                        // Guardamos el correo al que se envio el código
                                        $_SESSION['mail'] = $email->getCorreo();
                                        // Ejecutamos funcion para obtener el usuario del correo ingresado
                                        //$usuario->obtenerUsuario($_SESSION['mail']);
                                        // Ejecutamos funcion para actualizar el codigo de recuperacion del usuario en la base de datos
                                        $email->actualizarCodigo($code);
                                        unset($_SESSION['mail']);
                                    } else {
                                        // En caso que el correo no se envie mostramos el error
                                        $result['exception'] = $_SESSION['error'];
                                    }
                                } else {
                                    $result['exception'] = 'Asunto incorrecto';
                                }
                            } else {
                                $result['exception'] = 'El correo ingresado no esta registrado';
                            }
                        } else {
                            $result['exception'] = 'Correo incorrecto';
                        }
                    } else {
                        $result['exception'] = 'Mensaje incorrecto';
                    }
                    break;
                case 'verifyCode':
                    $_POST = $usuario->validateForm($_POST);
                    // Validmos el formato del mensaje que se enviara en el correo
                    if ($email->setCodigo($_POST['codigo'])) {
                        // Validamos si el correo ingresado tiene formato correcto
                        if ($email->setCorreo($_SESSION['mail'])) {
                            // Ejecutamos la funcion para validar el codigo de seguridad
                            if ($email->validarCodigo()) {
                                $result['status'] = 1;
                                // Colocamos el mensaje de exito 
                                $result['message'] = 'El código ingresado es correcto';
                                unset($_SESSION['mail']);
                            } else {
                                // En caso que el correo no se envie mostramos el error
                                $result['exception'] = 'El código ingresado no es correcto';
                            }
                        } else {
                            $result['exception'] = 'Correo incorrecto';
                        }
                    } else {
                        $result['exception'] = 'Mensaje incorrecto';
                    }
                    break;
                case 'restorePassword':
                    // Obtenemos el form con los inputs para obtener los datos
                    $_POST = $usuario->validateForm($_POST);
                    if ($usuario->setCorreo($_SESSION['mail'])) {
                        if ($usuario->setClave($_POST['clave1'])) {
                            // Ejecutamos la funcion para actualizar al usuario
                            if ($usuario->updatePass()) {
                                $result['status'] = 1;
                                $result['message'] = 'Clave actualizada correctamente';
                                unset($_SESSION['mail']);
                            } else {
                                $result['exception'] = Database::getException();
                            }
                        } else {
                            $result['exception'] = $usuario->getPasswordError();
                        }
                    } else {
                        $result['exception'] = 'Correo incorrecto';
                    }
                    break;
            case 'changePass':
                $_POST = $usuario->validateForm($_POST);
                if ($usuario->setId($_SESSION['id_user'])) {
                    if ($_POST['clave'] == $_POST['confirmar']) {
                        if ($_POST['clave'] != $_SESSION['usuaio']) {
                            if ($_POST['clave'] != $_SESSION['pass']) {
                                if ($usuario->setClave($_POST['clave'])) {
                                    if ($usuario->changePassw()) {
                                        if ($usuario->changeDate()) {
                                            $result['status'] = 1;
                                            $result['message'] = 'La contraseña se guardó correctamente';
                                        } else {
                                            $result['exception'] = Database::getException();
                                        }
                                    } else {
                                        $result['exception'] = Database::getException();
                                    }
                                } else {
                                    $result['exception'] = $usuario->getPasswordError();
                                }
                            } else {
                                $result['exception'] = 'La contraseña no tiene que ser la misma que la anterior.';
                            }
                        } else {
                            $result['exception'] = 'Las contraseña no debe de ser igual al nombre de usuario.';
                        }
                    } else {
                        $result['exception'] = 'Las contraseñas no coinciden';
                    }
                } else {
                    $result['exception'] = 'Usuario incorrecto';
                }
                break;
            case 'logIn':
                $_POST = $usuario->validateForm($_POST);
                if ($usuario->checkUser($_POST['alias'])) {
                    if ($usuario->checkPassword($_POST['clave'])) {
                        if ($usuario->getPrimer_uso() == 2) {
                            $usuario->setAlias($_POST['alias']);
                            $_SESSION['pass'] = $_POST['clave'];
                            $_SESSION['fecha'] = $usuario->getFecha();
                            $_SESSION['usuaio'] = $usuario->getAlias();
                            $_SESSION['cant'] = $usuario->getCant();
                            $usuario->setIntentos(0);
                            $usuario->updateIntentos();
                            if ($_SESSION['cant'] >= 90) {
                                $_SESSION['id_user'] = $usuario->getId();
                                $result['message'] = 'Han pasado un período largo desde su último cambio de contraseña, es hora de renovar tus credenciales.';
                                $result['status'] = 3;
                            } else {
                                if ($usuario->getAuten()) {
                                    $_SESSION['id_user'] = $usuario->getId();
                                    $_SESSION['correo'] = $usuario->getCorreo();
                                    $usuario->setId($_SESSION['id_user']);
                                    $usuario->generarCodigo(5);
                                    $usuario->updateCode();
                                    $_SESSION['autn'] = $usuario->getCodigo();
                                    $mail = new PHPMailer();
                                    $mail->IsSMTP();
                                    //Configuracion servidor mail
                                    $mail->setFrom('hardprimestore@gmail.com', 'HardPrimeStore'); //remitente
                                    $mail->SMTPAuth = true;
                                    $mail->SMTPSecure = 'tls'; //seguridad
                                    $mail->Host = "smtp.gmail.com"; // servidor smtp
                                    $mail->Port = 587; //puerto
                                    $mail->Username = 'HardPrimeStore@gmail.com'; //nombre usuario
                                    $mail->Password = 'Store2021'; //contraseña
                                    $mail->AddAddress($usuario->getCorreo());
                                    $mail->Subject = 'Segundo factor de autenticación - HardPrimeStore';
                                    $mail->Body = 'El código para iniciar sesión es: ' . $usuario->getCodigo() . '.';
                                    if ($mail->Send()) {
                                        $result['message'] = 'Se le ha envíado el código para iniciar sesión, por favor revise su correo.';
                                        $result['status'] = 4;
                                    } else {
                                        $result['exception'] = 'Ocurrió un error al enviar el correo.';
                                    }
                                } else {
                                    $_SESSION['id_usuario'] = $usuario->getId();
                                    date_default_timezone_set('America/El_Salvador');
                                    $_SESSION["ultimoAcceso"] = date("Y-n-j H:i:s");
                                    $result['message'] = 'Autenticación correcta';
                                    $result['status'] = 1;
                                    //sesion que captura la fecha y hora del inicio de sesión
                                    $user_agent = $_SERVER['HTTP_USER_AGENT'];
                                    //Se establece la zona horaria y se obtiene la fecha y hora actual                                
                                    date_default_timezone_set('America/El_Salvador');
                                    $DateAndTime = date('m-d-Y h:i:s a', time());
                                    $plataforma = $usuario->getPlatform($user_agent);
                                    $ip = $_SERVER['REMOTE_ADDR'];
                                    //Se obtienen detalles del usuario para el inicio de sesion mediante ipinfo
                                    $details = json_decode(file_get_contents("http://ipinfo.io/"));

                                    //Se registra ingresan los datos en la base de datos
                                    $usuario->registrarSesion($DateAndTime, $plataforma, $_SESSION['id_usuario'], $details->city, $details->timezone);
                                }
                            }
                        } else {
                            $result['status'] = 2;
                            $result['message'] = 'Se debe modificar la contraseña por defecto';
                        }
                    } else {
                        $usuario->setAlias($_POST['alias']);
                        $usuario->readIntentos();
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            if ($usuario->getIntentos() == 0) {
                                $usuario->setIntentos(1);
                                $usuario->updateIntentos();
                                $result['exception'] = 'Credenciales incorrectas o usuario inactivo.';
                            } else if ($usuario->getIntentos() == 1) {
                                $usuario->setIntentos(2);
                                $usuario->updateIntentos();
                                $result['exception'] = 'Credenciales incorrectas o usuario inactivo.';
                            } else if ($usuario->getIntentos() == 2) {
                                $usuario->setIntentos(3);
                                $usuario->setEstado('inactivo');
                                $usuario->setAlias($_POST['alias']);
                                $usuario->updateState();
                                $usuario->updateIntentos();
                                $result['exception'] = 'Se han excedido los intentos permitidos, su cuenta ha sido bloqueada';
                            } else if ($usuario->getIntentos() > 2) {
                                $result['exception'] = 'Se han excedido los intentos permitidos, su cuenta ha sido bloqueada.';
                            }
                        }
                    }
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'Credenciales incorrectas o usuario inactivo.';
                    }
                }
                break;
            case 'readAutenticacion':
                $_POST = $usuario->validateForm($_POST);
                if ($usuario->setCodigo($_SESSION['autn'])) {
                    if ($usuario->setId($_SESSION['id_user'])) {
                        if ($usuario->checkAutn() == true) {
                            if ($usuario->getCodigo() == $_POST['codigo']) {
                                $result['status'] = 1;
                                $result['message'] = 'Autenticación correcta.';
                                $_SESSION['id_usuario'] = $usuario->getId();
                                $_SESSION["ultimoAcceso"] = date("Y-n-j H:i:s");
                                $result['message'] = 'Autenticación correcta';
                                $result['status'] = 1;
                                //sesion que captura la fecha y hora del inicio de sesión
                                $user_agent = $_SERVER['HTTP_USER_AGENT'];
                                //Se establece la zona horaria y se obtiene la fecha y hora actual
                                date_default_timezone_set('America/El_Salvador');
                                $DateAndTime = date('m-d-Y h:i:s a', time());
                                $plataforma = $usuario->getPlatform($user_agent);
                                $ip = $_SERVER['REMOTE_ADDR'];
                                //Se obtienen detalles del usuario para el inicio de sesion mediante ipinfo
                                $details = json_decode(file_get_contents("http://ipinfo.io/"));

                                //Se registra ingresan los datos en la base de datos
                                $usuario->registrarSesion($DateAndTime, $plataforma, $_SESSION['id_usuario'], $details->city, $details->timezone);
                            } else {
                                $result['exception'] = 'El código ingresado es incorrecto.';
                            }
                        } else {
                            $result['exception'] = 'El usuario es incorrecto.';
                        }
                    } else {
                        $result['exception'] = 'Error al asignar el usuario para iniciar sesion.';
                    }
                } else {
                    $result['exception'] = 'Error al asignar el código de confirmación';
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
