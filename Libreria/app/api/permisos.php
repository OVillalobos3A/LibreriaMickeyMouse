<?php
require_once('../helpers/database.php');
require_once('../helpers/validator.php');
require_once('../models/permisos.php');

// Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
if (isset($_GET['action'])) {
    // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en el script.
    session_start();
    // Se instancia la clase correspondiente.
    $permiso = new Permisos;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'message' => null, 'exception' => null);
    // Se verifica si existe una sesión iniciada como administrador, de lo contrario se finaliza el script con un mensaje de error.
  
        // Se compara la acción a realizar cuando un administrador ha iniciado sesión.
        switch ($_GET['action']) {

            //Esta accion sirve para leer todos los productos
            case 'readAll':
                if ($result['dataset'] = $permiso->readAll()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No hay permisos registrados';
                    }
                }
                break;

            //Esta accion lee los tipos de productos    
            case 'readTipos':
                if ($result['dataset'] = $permiso->readTipos()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No hay Tipos de Usuario registrados';
                    }
                }
                break;

            //Esta accion lee los tipos de productos    
            case 'readPaginas':
                if ($result['dataset'] = $permiso->readPaginas()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No hay Páginas asociadas';
                    }
                }
                break;

                //Esta accion lee los tipos de productos    
            case 'readPermisos':
                if ($result['dataset'] = $permiso->readPermisos()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No hay Permisos activos';
                    }
                }
                break;

            //Esta accion busca en los productos
            case 'search':
                //Se valida el formulario
                $_POST = $producto->validateForm($_POST);
                //Se verifica que el campo no este vacio
                if ($_POST['search'] != '') {
                    //Se envia el dato y se ejecuta la accion
                    if ($result['dataset'] = $producto->searchRows($_POST['search'])) {
                        $result['status'] = 1;
                        //se cuentan los resultados obtenidos
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
                //Se crea el producto

                if (is_uploaded_file($_FILES['foto']['tmp_name'])) {
                    if ($producto->setImagen($_FILES['foto'])) {
                        if ($producto->createRow()) {
                            $result['status'] = 1;
                            if ($producto->saveFile($_FILES['foto'], $producto->getRuta(), $producto->getImagen())) {
                                $result['message'] = 'Producto creado correctamente';
                            } else {
                                $result['message'] = 'Producto creado pero no se guardó la imagen';
                            }
                        } else {
                            $result['exception'] = Database::getException();;
                        }
                    } else {
                        $result['exception'] = $producto->getImageError();
                    }
                } else {
                    $result['exception'] = 'Seleccione una imagen';
                }

            case 'create':
                $_POST = $permiso->validateForm($_POST);
                if (isset($_POST['tipo'])) {
                    if ($permiso->setIdTipo($_POST['tipo'])) {  
                        if (isset($_POST['pagina'])) {
                            if ($permiso->setIdPagina($_POST['pagina'])) {  
                                if (isset($_POST['permiso'])) {
                                    if ($permiso->setIdPermiso($_POST['permiso'])) {  
                                        if ($permiso->readExistPage()) {
                                            $result['exception'] = 'Este permiso ya existe';
                                        } else {
                                            if (Database::getException()) {
                                                $result['exception'] = Database::getException();
                                            } else {
                                                if ($permiso->createRow()) {
                                                    $result['status'] = 1;
                                                    $result['message'] = 'Acceso actualizado';
                                                } else {
                                                    $result['exception'] = Database::getException();
                                                }
                                            }
                                        }
                                    } else {
                                        $result['exception'] = 'Proveedor incorrecto';
                                    }
                                } else {
                                    $result['exception'] = 'Seleccione una marca';
                                }
                            } else {
                                $result['exception'] = 'Proveedor incorrecto';
                            }
                        } else {
                            $result['exception'] = 'Seleccione un proveedor';
                        }
                    } else {
                        $result['exception'] = 'Categoría incorrecta';
                    }
                } else {
                    $result['exception'] = 'Seleccione una categoría';
                }
                break;
            case 'readOne':
                if ($permiso->setId($_POST['id_acceso'])) {
                    if ($result['dataset'] = $permiso->readOne()) {
                        $result['status'] = 1;
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'Permiso inexistente';
                        }
                    }
                } else {
                    $result['exception'] = 'Permiso incorrecto';
                }
                break;
            case 'update':
                $_POST = $permiso->validateForm($_POST);
                if ($permiso->setId($_POST['id_acceso'])) {
                    if (isset($_POST['tipo'])) {
                        if ($permiso->setIdTipo($_POST['tipo'])) {  
                            if (isset($_POST['pagina'])) {
                                if ($permiso->setIdPagina($_POST['pagina'])) {  
                                    if (isset($_POST['permiso'])) {
                                        if ($permiso->setIdPermiso($_POST['permiso'])) {  
                                            if ($permiso->readExistPageU()) {
                                                $result['exception'] = 'Este permiso ya existe';
                                            } else {
                                                if ($permiso->readExist()) {
                                                    $result['exception'] = 'Los nuevos datos de este permiso ya existen';
                                                } else {
                                                    if (Database::getException()) {
                                                        $result['exception'] = Database::getException();
                                                    } else {
                                                        if ($permiso->updateRow()) {
                                                            $result['status'] = 1;
                                                            $result['message'] = 'Acceso actualizado';
                                                        } else {
                                                            $result['exception'] = Database::getException();
                                                        }
                                                    }
                                                }
                                            }
                                        } else {
                                            $result['exception'] = 'Proveedor incorrecto';
                                        }
                                    } else {
                                        $result['exception'] = 'Seleccione una marca';
                                    }
                                } else {
                                    $result['exception'] = 'Proveedor incorrecto';
                                }
                            } else {
                                $result['exception'] = 'Seleccione un proveedor';
                            }
                        } else {
                            $result['exception'] = 'Categoría incorrecta';
                        }
                    } else {
                        $result['exception'] = 'Seleccione una categoría';
                    }
                } else {
                    $result['exception'] = 'Permiso inexistente';
                }
                break;
            case 'delete':
                if ($permiso->setId($_POST['id_acceso'])) {
                    if ($data = $permiso->readOne()) {
                        if ($permiso->deleteRow()) {
                            $result['status'] = 1;
                            $result['message'] = 'Acceso anulado correctamente';
                        } else {
                            $result['exception'] = Database::getException();
                        }
                    } else {
                        $result['exception'] = 'Acceso inexistente';
                    }
                } else {
                    $result['exception'] = 'Acceso incorrecto';
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
    print(json_encode('Recurso no disponible'));
}