<?php
/*
*	Clase para manejar las tablas pedidos y detalle_pedido de la base de datos. Es clase hija de Validator.
*/
class Factura extends Validator
{
    // Declaración de atributos (propiedades).
    private $id_pedido = null;
    private $id_emp = null;
    private $numproducts = null;
    private $id_detalle = null;
    private $cliente = null;
    private $producto = null;
    private $cantidad = null;
    private $cantidad1 = null;
    private $precio = null;
    private $estado = null; // Valor por defecto en la base de datos: 0
    /*
    *   ESTADOS PARA UN PEDIDO
    *   "En preparacion". Es cuando el pedido esta en proceso por parte del cliente y se puede modificar el detalle.
    *   "Finalizado". Es cuando el cliente finaliza el pedido y ya no es posible modificar el detalle.
    *   "Entregado". Es cuando la tienda ha entregado el pedido al cliente.
    */

    /*
    *   Métodos para validar y asignar valores de los atributos.
    */

    //Se valida el Id del Pedido
    public function setIdPedido($value)
    {
        //Se valida que el campo sea un número natural
        if ($this->validateNaturalNumber($value)) {
            //Se guarda el dato
            $this->id_pedido = $value;
            return true;
        } else {
            return false;
        }
    }

    //Se valida el número
    public function setNumproducts($value)
    {
        //Se valida que el dato sea un número natural
        if ($this->validateNaturalNumber($value)) {
            //Se guarda el dato
            $this->numproducts = $value;
            return true;
        } else {
            return false;
        }
    }

    //Se valida el Id del Detalle
    public function setIdDetalle($value)
    {
        //Se valida que el dato sea un número natural
        if ($this->validateNaturalNumber($value)) {
            //Se guarda el dato
            $this->id_detalle = $value;
            return true;
        } else {
            return false;
        }
    }

    //Se valida el Id del Empleado
    public function setIdEmp($value)
    {
        //Se valida que el campo sea un número natural
        if ($this->validateNaturalNumber($value)) {
            //Se guarda el dato
            $this->id_emp = $value;
            return true;
        } else {
            return false;
        }
    }

    //Se valida el Id del Cliente
    public function setCliente($value)
    {
        //Se valida que el campo sea un número natural
        if ($this->validateNaturalNumber($value)) {
            //Se guarda el dato
            $this->cliente = $value;
            return true;
        } else {
            return false;
        }
    }

    //Se valida el Id del Producto
    public function setProducto($value)
    {
        //Se valida que el campo sea un número natural
        if ($this->validateNaturalNumber($value)) {
            //Se guarda el dato
            $this->producto = $value;
            return true;
        } else {
            return false;
        }
    }

    //Se valida la Cantidad a retirar
    public function setCantidad($value)
    {
        //Se valida que el campo sea un número natural
        if ($this->validateNaturalNumber($value)) {
            //Se guarda el dato
            $this->cantidad = $value;
            return true;
        } else {
            return false;
        }
    }

    //Se valida la Cantidad 1
    public function setCantidad1($value)
    {
        //Se valida que el campo sea un número natural
        if ($this->validateNaturalNumber($value)) {
            $this->cantidad1 = $value;
            return true;
        } else {
            return false;
        }
    }

    //Se valida el Precio a registrar
    public function setPrecio($value)
    {
        //Se valida que el campo tenga el formato requerido
        if ($this->validateMoney($value)) {
            //Se guarda el dato
            $this->precio = $value;
            return true;
        } else {
            return false;
        }
    }

    //Se valida el Estado del Pedido
    public function setEstado($value)
    {
        //Se guarda el dato
        $this->estado = $value;
        return true;
    }

    /*
    *   Métodos para obtener valores de los atributos.
    */

    //Se obtiene el Id del Pedido
    public function getIdPedido()
    {
        //Se retorna el dato
        return $this->id_pedido;
    }

    //Se obtiene el Id del Empleado
    public function getIdEmp()
    {
        //Se retorna el dato
        return $this->id_emp;
    }

    //Se obtiene el número de los prodcutos
    public function getNumproducts()
    {
        //Se retorna el dato
        return $this->numproducts;
    }

    /*
    *   Métodos para realizar las operaciones SCRUD (search, create, read, update, delete).
    */
    
    // Método para verificar si existe un pedido en proceso para seguir comprando, de lo contrario se crea uno.
    public function startOrder()
    {
        //Se setea el contenido de la variable estado
        $this->estado = "Pendiente";

        //Se guarda la consulta sql
        $sql = 'SELECT id_factura
                FROM factura
                WHERE estado = ? AND id_usuario = ?';
        //Se guarda un array con los parametros de la consulta
        $params = array($this->estado, $_SESSION['id_usuario']);
        //Se compara el resultado de la consulta "getRow"
        if ($data = Database::getRow($sql, $params)) {
            //Se guarda el Id del Pedido
            $this->id_pedido = $data['id_factura'];
            //Se retorna el valor 
            return true;   
            //Se define la zona horaria
            date_default_timezone_set('America/El_Salvador');
            //Se guarda la fecha actual del servidor con el formato específico
            $date = date('Y-m-d');
            //Se guarda la consulta sql
            $sql = 'UPDATE factura
                    set fecha = ?
                    WHERE id_factura = ? ';
            //Se guarda un array con los parametros de la consulta
            $params = array($date, $_SESSION['id_factura']);
            //Se compara el resultado de la consulta "getRow" 
            if ($data = Database::getRow($sql, $params)) {
            }
        } else {
            // Se establece la zona horaria local para obtener la fecha del servidor.
            date_default_timezone_set('America/El_Salvador');
            //Se guarda la fecha actual del servidor con el formato específico
            $date = date('Y-m-d');
            //Se guarda la consulta sql
            $sql = 'INSERT INTO factura(estado, id_usuario, fecha)
                    VALUES(?, ?, ?)';
            //Se guarda un array con los parametros de la consulta   
            $params = array($this->estado, $_SESSION['id_usuario'], $date);
            // Se obtiene el ultimo valor insertado en la llave primaria de la tabla pedidos.
            if ($this->id_pedido = Database::getLastRow($sql, $params)) {
                return true;
            } else {
                return false;
            }
        }
    }

    //Leer todos los registros
    public function readAll()
    {
        //Se guarda la consulta sql
        $sql = 'SELECT id_inventario, nombre, precio, imagen
                FROM inventario 
                ORDER BY nombre';
        //Se guarda un array con los parametros de la consulta(vacío)
        $params = null;
        //Se retorna el resultado de la ejecución de a consulta "getRows"
        return Database::getRows($sql, $params);
    }

    // Método para agregar un producto al carrito de compras.
    public function createDetail()
    {
        // Se realiza una subconsulta para obtener el precio del producto.
        $sql = 'INSERT INTO detalle_compra(id_inventario, precio, cantidad, id_factura)
                VALUES(?, (SELECT precio FROM inventario WHERE id_inventario = ?), ?, ?)';
        //Se guarda un array con los parametros de la consulta
        $params = array($this->producto, $this->producto, $this->cantidad, $this->id_pedido);
        //Se retorna el resultado de la ejecución de a consulta "executeRows"
        return Database::executeRow($sql, $params);
    }

    // Método para obtener los productos que se encuentran en el carrito de compras.
    public function reCharge()
    {
        //Se guarda la consulta sql
        $sql = "SELECT id_detalle, nombre, detalle_compra.cantidad, ('$' || ' ' || CAST(detalle_compra.precio AS varchar)) as precio, imagen,
                ('$' || ' ' || CAST((detalle_compra.precio*detalle_compra.cantidad) AS varchar)) as subtotal, id_inventario, detalle_compra.precio as cost
                FROM detalle_compra INNER JOIN  factura USING(id_factura) INNER JOIN inventario USING(id_inventario)
                WHERE id_factura = ?";
        //Se guarda un array con los parametros de la consulta
        $params = array($this->id_pedido);
        //Se retorna el resultado de la ejecución de a consulta "getRows"
        return Database::getRows($sql, $params);
    }

    public function readFact()
    {
        //Se setea el contenido de la variable estado 
        $estado = "Pendiente";
        //Se guarda la consulta sql
        $sql = "SELECT CONCAT('N° de Factura:', ' ', id_factura) as id_factura,
                CONCAT('Fecha: ' || ' ' || fecha) as fecha
                FROM factura
                WHERE id_usuario = ? and estado = ?";
        //Se guarda un array con los parametros de la consulta
        $params = array($_SESSION['id_usuario'], $estado);
        //Se retorna el resultado de la ejecución de a consulta "getRow"
        return Database::getRow($sql, $params);
    }

    // Método para finalizar un pedido por parte del cliente.
    public function finishFact()
    {
        // Se establece la zona horaria local para obtener la fecha del servidor.
        date_default_timezone_set('America/El_Salvador');
        //Se guarda la fecha actual del servidor con el formato específico
        $date = date('Y-m-d');
        //Se guarda el contenido de la variable estado
        $this->estado = "Finalizado";
        //Se guarda la consulta sql
        $sql = 'UPDATE factura
                SET estado = ?, fecha = ?
                WHERE id_factura = ?';
        //Se guarda un array con los parametros de la consulta
        $params = array($this->estado, $date, $_SESSION['id_factura']);
        //Se retorna el resultado de la ejecución de a consulta "executeRow"
        return Database::executeRow($sql, $params);
    }

    // Método para actualizar la cantidad de un producto agregado al carrito de compras.
    public function updateDetail()
    {
        //Se guarda la consulta sql
        $sql = 'UPDATE detalle_compra
                SET cantidad = ?
                WHERE id_detalle = ? AND id_factura = ?';
        //Se guarda un array con los parametros de la consulta
        $params = array($this->cantidad, $this->id_detalle, $_SESSION['id_factura']);
        //Se retorna el resultado de la ejecución de a consulta "executeRow"
        return Database::executeRow($sql, $params);
    }

    // Método para eliminar un producto que se encuentra en el carrito de compras.
    public function deleteDetail()
    {
        //Se guarda la consulta sql
        $sql = 'DELETE FROM detalle_compra
                WHERE id_detalle = ? AND id_factura = ?';
        //Se guarda un array con los parametros de la consulta
        $params = array($this->id_detalle, $_SESSION['id_factura']);
        //Se retorna el resultado de la ejecución de a consulta "executeRow"
        return Database::executeRow($sql, $params);
    }

    // Método para verificar la cantidad un producto que se encuentra en el carrito de compras.
    public function verifyCantidad()
    {
        //Se guarda la consulta sql
        $sql = "SELECT nombre, stock 
                FROM inventario 
                WHERE id_inventario = ? and stock >= ?";
        //Se guarda un array con los parametros de la consulta
        $params = array($this->producto,$this->cantidad);
        //Se retorna el resultado de la ejecución de a consulta "executeRow"
        return Database::getRows($sql, $params);
    }

    // Método para verificar la cantidad un producto que se encuentra en el carrito de compras.
    public function verifyQuantity()
    {
        $sql = "SELECT nombre, stock 
                FROM inventario  
                WHERE id_inventario = ? and stock >= ?";
        $params = array($this->producto, $this->cantidad1);
        return Database::getRows($sql, $params);
    }

    //Método para verificar el producto a la hora de actualizar la cantidad
    public function verifyProduct()
    {
        $sql = "SELECT id_producto
                FROM pedido INNER JOIN detalle_pedido USING(id_pedido) INNER JOIN productos USING(id_producto)
                WHERE id_detalle = ?";
        $params = array($this->id_detalle);
        if ($data = Database::getRow($sql, $params)) {
            $this->producto = $data['id_producto'];
        } else {
        }
    } 
    
    //Método para obtener el número de productos que se encuentran en el carrito
    public function readCantprods()
    {
        $sql = "SELECT count(id_detalle) as cantidad
                FROM pedido INNER JOIN detalle_pedido USING(id_pedido) INNER JOIN clientes USING(id_cliente)          
                WHERE pedido.estado = 'En preparacion' AND pedido.id_cliente = ?";
        $params = array($_SESSION['id_cliente']);
        if ($data = Database::getRow($sql, $params)) {
            $this->numproducts = $data['cantidad'];
            return true;
        } else {
            return false;
        }
        
    }

    //Método para verificar que el producto elegido no se haya elgido previamente en el carrito 
    public function findDuplicate()
    {
        $sql = 'SELECT id_inventario
                FROM detalle_compra INNER JOIN factura USING(id_factura)
                WHERE id_inventario = ? and detalle_compra.id_factura = ?';
        $params = array($this->producto, $_SESSION['id_factura']);
        return Database::getRows($sql, $params);
    }

    public function searchRows($value)
    {
        $sql = "SELECT id_inventario, nombre, precio, imagen
                FROM inventario
                WHERE nombre ILIKE ?";
        $params = array("%$value%");
        return Database::getRows($sql, $params);
    }
}
