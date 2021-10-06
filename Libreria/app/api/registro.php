<?php

//Se llaman los archivos necesarios

require_once('../helpers/database.php');
require_once('../helpers/validator.php');
require_once('../models/usuarios.php');
require_once('../models/registro.php');

require '../../libraries/PHPMailer/PHPMailerAutoload.php';
//composer require ipinfo/ipinfo;
use ipinfo\ipinfo\IPinfo;
$access_token = 'f62d9dca0db9cf';


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
                                $usuario->setAlias($_POST['user']);
                                $_SESSION['pass'] = $_POST['pass'];
                                $_SESSION['fecha'] = $usuario->getFecha();
                                $_SESSION['usuaio'] = $usuario->getAlias();
                                $_SESSION['cant'] = $usuario->getCant();
                                $usuario->setIntentos(0);
                                $usuario->updateIntentos();
                                if ($_SESSION['cant'] >= 90) {
                                    $result['message'] = 'Han pasado un período largo desde su último cambio de contraseña, es hora de renovar tus credenciales.';
                                    $result['status'] = 3;
                                    $_SESSION['id_user'] = $usuario->getId();
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
                                        $mail->setFrom('libreriamickeysv@gmail.com', 'Libreria Mickey Mouse'); //remitente 
                                        $mail->SMTPAuth = true;
                                        $mail->SMTPSecure = 'tls'; //seguridad
                                        $mail->Host = "smtp.gmail.com"; // servidor smtp
                                        $mail->Port = 587; //puerto
                                        $mail->Username = 'libreriamickeysv@gmail.com'; //nombre usuario
                                        $mail->Password = 'Mickey2021'; //contraseña
                                        $mail->AddAddress($usuario->getCorreo());
                                        $mail->Subject = 'Código de recuperación - Librería Mickey Mouse';
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
                                        $usuario->readTipoU();
                                        $_SESSION["tipo"] = $usuario->getTipo();
                                        //sesion que captura la fecha y hora del inicio de sesión
                                        $user_agent = $_SERVER['HTTP_USER_AGENT'];
                                        //Se establece la zona horaria y se obtiene la fecha y hora actual                                
                                        date_default_timezone_set('America/El_Salvador');
                                        $DateAndTime = date('m-d-Y H:i:s a', time());
                                        $plataforma = $usuario->getPlatform($user_agent);                                          
                                        $ip = $_SERVER['REMOTE_ADDR'];
                                        //Se obtienen detalles del usuario para el inicio de sesion mediante ipinfo
                                        $details = json_decode(file_get_contents("http://ipinfo.io/"));
                                                                                                                                                                
                                        //Se registra ingresan los datos en la base de datos
                                        $usuario->registrarSesion($DateAndTime, $plataforma, $_SESSION['id_usuario'], $details->city, $details->timezone);
                                    }
                                }
                            }
                            else {
                                $result['status'] = 2;
                                $result['message'] = 'Se debe modificar la contraseña por defecto';
                                //Se setea el alias en la variable "Session"
                                $_SESSION['alias_usuario'] = $usuario->getAlias();
                            }
                        } else {
                            $usuario->setAlias($_POST['user']);
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
                                    $usuario->setAlias($_POST['user']);
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
                                    //Se establece la zona horaria y se obtiene la fecha y hora actual
                                    date_default_timezone_set('America/El_Salvador');
                                    $_SESSION["ultimoAcceso"] = date("Y-n-j H:i:s");
                                    $result['message'] = 'Autenticación correcta';
                                    $result['status'] = 1;
                                    $usuario->readTipoU();
                                    $_SESSION["tipo"] = $usuario->getTipo();
                                    //sesion que captura la fecha y hora del inicio de sesión
                                    $user_agent = $_SERVER['HTTP_USER_AGENT'];                                    
                                    $DateAndTime = date('m-d-Y H:i:s a', time());
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
                case 'changePasss':
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