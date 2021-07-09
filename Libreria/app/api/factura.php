<?php
require_once('../helpers/database.php');
require_once('../helpers/validator.php');
require_once('../models/factura.php');

// Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
if (isset($_GET['action'])) {
    // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en el script.
    session_start();
    // Se instancia la clase correspondiente.
    $pedido = new Factura;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'session' => 0, 'message' => null, 'exception' => null);
    // Se verifica si existe una sesión iniciada como cliente para realizar las acciones correspondientes.
    if (isset($_SESSION['id_usuario'])) {
        $result['session'] = 1;
        // Se compara la acción a realizar cuando un cliente ha iniciado sesión.
        switch ($_GET['action']) {
        //Método para consultar si ya existe un pedido que se encuentre
        //en estado de "En preparacion"
        case 'createDetail':
            if ($pedido->startOrder()) {
                $_SESSION['id_factura'] = $pedido->getIdPedido();
                $_POST = $pedido->validateForm($_POST);
                if ($pedido->setProducto($_POST['id_producto'])) {
                    if ($pedido->setCantidad($_POST['cantidad_producto'])) {
                        if ($pedido->findDuplicate()) {
                            $result['exception'] = 'Este producto ya ha sido agregado a la compra';
                        } else {
                            if ($pedido->verifyCantidad()) {
                                if ($pedido->createDetail()) {
                                    $result['status'] = 1;
                                    $result['message'] = 'Producto agregado correctamente';
                                } else {
                                    if (Database::getException()) {
                                        $result['exception'] = Database::getException();
                                    } else {
                                        $result['exception'] = 'Ocurrió un problema al agregar el producto';
                                    }
                                }
                            } else {
                                $result['exception'] = 'No puede elegir más producto de lo que ya hay';
                            }
                        }
                    } else {
                        $result['exception'] = 'Cantidad incorrecta';
                    }
                } else {
                    $result['exception'] = 'Producto incorrecto';
                }
            } else {
                $result['exception'] = 'Ocurrió un problema al obtener la información de la compra';
            }
            break;
            case 'readAll':
                if ($result['dataset'] = $pedido->readAll()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No hay productos registrados';
                    }
                }
                break;
            case 'readFact':
                if ($pedido->startOrder()) {
                    if ($result['dataset'] = $pedido->readFact()) {
                        $result['status'] = 1;
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'Ha ocurrido un error en la obtención de datos';
                        }
                    }
                } else {
                    $result['exception'] = 'Ocurrió un problema al obtener la información de la compra';
                }
                break;
            //Método para consultar los productos del carrito del cliente
            //que ha iniciado sesión
            case 'readOrderDetail':
                if ($pedido->startOrder()) {
                    if ($result['dataset'] = $pedido->reCharge()) {
                        $result['status'] = 1;
                        $_SESSION['id_factura'] = $pedido->getIdPedido();
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'No se ha cargado ningún producto';
                        }
                    }
                } else {
                    $result['exception'] = 'No se ha cargado ningún producto';
                }
                break;
            //Método para actualizar la cantidad de un producto en el carrito
            //verificando la cantidad que se ingresa comparandola con 
            //el stock, y la cantidad anteriormente ingresada
            case 'updateDetail1':
                $_POST = $pedido->validateForm($_POST);
                if ($pedido->setIdDetalle($_POST['id_detalle1'])) {
                    if ($pedido->setProducto($_POST['id_producto1'])) {
                        if ($pedido->setCantidad($_POST['cantidad_producto1'])) {
                            if ($pedido->setCantidad1($_POST['sbuscar1'])) {
                                if ($pedido->verifyQuantity()) {
                                    if ($pedido->updateDetail()) {
                                        $result['status'] = 1;
                                        $result['message'] = 'Cantidad modificada correctamente';
                                    } else {
                                        $result['exception'] = 'Ocurrió un problema al modificar la cantidad';
                                    }
                                } else {
                                    $result['exception'] = 'No puede elegir más producto de lo que ya hay';
                                }
                            } else {
                                $result['exception'] = 'Cantidad1 incorrecta';
                            }
                        } else {
                            $result['exception'] = 'Cantidad incorrecta';
                        }
                    } else {
                        $result['exception'] = 'Producto incorrecto';
                    }
                } else {
                    $result['exception'] = 'Detalle incorrecto';
                }
                break;
            //Método para actualizar la cantidad de un producto en el carrito
            case 'updateDetail':
                $_POST = $pedido->validateForm($_POST);
                if ($pedido->setIdDetalle($_POST['id_detalle1'])) {
                    if ($pedido->setProducto($_POST['id_producto1'])) {
                        if ($pedido->setCantidad($_POST['cantidad_producto1'])) {
                            if ($pedido->updateDetail()) {
                                $result['status'] = 1;
                                $result['message'] = 'Cantidad modificada correctamente';
                            } else {
                                $result['exception'] = 'Ocurrió un problema al modificar la cantidad';
                            }
                        } else {
                            $result['exception'] = 'Cantidad incorrecta';
                        }
                    } else {
                        $result['exception'] = 'Producto incorrecto';
                    }
                } else {
                    $result['exception'] = 'Detalle incorrecto';
                }
                break;
            //Método para eliminar un producto del carrito
            case 'deleteDetail':
                if ($pedido->setIdDetalle($_POST['id_detalle'])) {
                    if ($pedido->deleteDetail()) {
                        $result['status'] = 1;
                        $result['message'] = 'Producto removido correctamente';
                    } else {
                        $result['exception'] = 'Ocurrió un problema al remover el producto';
                    }
                } else {
                    $result['exception'] = 'Detalle incorrecto';
                }
                break;
            //Método para actualizar el estado del carrito
            //pasar de "En preparación" a "Finalizado"
            case 'finishFact':
                if ($pedido->finishFact()) {
                    $result['status'] = 1;
                    $result['message'] = 'Compra finalizada correctamente';
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'Ocurrió un problema al finalizar el pedido';
                    }
                }
                break;
            default:
                $result['exception'] = 'Acción no disponible dentro de la sesión';
        }
    } else {
        // Se compara la acción a realizar cuando un cliente no ha iniciado sesión.
        switch ($_GET['action']) {
            case 'createDetail':
                $result['exception'] = 'Debe iniciar sesión para agregar el producto al carrito';
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
