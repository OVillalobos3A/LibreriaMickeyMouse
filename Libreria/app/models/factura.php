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
    public function setIdPedido($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->id_pedido = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setNumproducts($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->numproducts = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setIdDetalle($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->id_detalle = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setIdEmp($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->id_emp = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setCliente($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->cliente = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setProducto($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->producto = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setCantidad($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->cantidad = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setCantidad1($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->cantidad1 = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setPrecio($value)
    {
        if ($this->validateMoney($value)) {
            $this->precio = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setEstado($value)
    {
        $this->estado = $value;
        return true;
    }

    /*
    *   Métodos para obtener valores de los atributos.
    */
    public function getIdPedido()
    {
        return $this->id_pedido;
    }

    public function getIdEmp()
    {
        return $this->id_emp;
    }

    public function getNumproducts()
    {
        return $this->numproducts;
    }

    /*
    *   Métodos para realizar las operaciones SCRUD (search, create, read, update, delete).
    */
    // Método para verificar si existe un pedido en proceso para seguir comprando, de lo contrario se crea uno.
    public function startOrder()
    {
        $this->estado = "Pendiente";

        $sql = 'SELECT id_factura
                FROM factura
                WHERE estado = ? AND id_usuario = ?';
        $params = array($this->estado, $_SESSION['id_usuario']);
        if ($data = Database::getRow($sql, $params)) {
            $this->id_pedido = $data['id_factura'];
            return true;   
            date_default_timezone_set('America/El_Salvador');
            $date = date('Y-m-d');
            $sql = 'UPDATE factura
                    set fecha = ?
                    WHERE id_factura = ? ';
            $params = array($date, $_SESSION['id_factura']);
            if ($data = Database::getRow($sql, $params)) {
            } else {
            } 
        } else {
            // Se establece la zona horaria local para obtener la fecha del servidor.
            date_default_timezone_set('America/El_Salvador');
            $date = date('Y-m-d');
            $sql = 'INSERT INTO factura(estado, id_usuario, fecha)
                    VALUES(?, ?, ?)';
            $params = array($this->estado, $_SESSION['id_usuario'], $date);
            // Se obtiene el ultimo valor insertado en la llave primaria de la tabla pedidos.
            if ($this->id_pedido = Database::getLastRow($sql, $params)) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function readAll()
    {
        $sql = 'SELECT id_inventario, nombre, precio, imagen
                FROM inventario 
                ORDER BY nombre';
        $params = null;
        return Database::getRows($sql, $params);
    }

    // Método para agregar un producto al carrito de compras.
    public function createDetail()
    {
        // Se realiza una subconsulta para obtener el precio del producto.
        $sql = 'INSERT INTO detalle_compra(id_inventario, precio, cantidad, id_factura)
                VALUES(?, (SELECT precio FROM inventario WHERE id_inventario = ?), ?, ?)';
        $params = array($this->producto, $this->producto, $this->cantidad, $this->id_pedido);
        return Database::executeRow($sql, $params);
    }

    // Método para obtener los productos que se encuentran en el carrito de compras.
    public function reCharge()
    {
        $sql = "SELECT id_detalle, nombre, detalle_compra.cantidad, ('$' || ' ' || CAST(detalle_compra.precio AS varchar)) as precio, imagen,
                ('$' || ' ' || CAST((detalle_compra.precio*detalle_compra.cantidad) AS varchar)) as subtotal, id_inventario, detalle_compra.precio as cost
                FROM detalle_compra INNER JOIN  factura USING(id_factura) INNER JOIN inventario USING(id_inventario)
                WHERE id_factura = ?";
        $params = array($this->id_pedido);
        return Database::getRows($sql, $params);
    }

    public function readFact()
    {
        $estado = "Pendiente";
        $sql = "SELECT CONCAT('N° de Factura:', ' ', id_factura) as id_factura,
                CONCAT('Fecha: ' || ' ' || fecha) as fecha
                FROM factura
                WHERE id_usuario = ? and estado = ?";
        $params = array($_SESSION['id_usuario'], $estado);
        return Database::getRow($sql, $params);
    }

    // Método para finalizar un pedido por parte del cliente.
    public function finishFact()
    {
        // Se establece la zona horaria local para obtener la fecha del servidor.
        date_default_timezone_set('America/El_Salvador');
        $date = date('Y-m-d');
        $this->estado = "Finalizado";
        $sql = 'UPDATE factura
                SET estado = ?, fecha = ?
                WHERE id_factura = ?';
        $params = array($this->estado, $date, $_SESSION['id_factura']);
        return Database::executeRow($sql, $params);
    }

    // Método para actualizar la cantidad de un producto agregado al carrito de compras.
    public function updateDetail()
    {
        $sql = 'UPDATE detalle_compra
                SET cantidad = ?
                WHERE id_detalle = ? AND id_factura = ?';
        $params = array($this->cantidad, $this->id_detalle, $_SESSION['id_factura']);
        return Database::executeRow($sql, $params);
    }

    // Método para eliminar un producto que se encuentra en el carrito de compras.
    public function deleteDetail()
    {
        $sql = 'DELETE FROM detalle_compra
                WHERE id_detalle = ? AND id_factura = ?';
        $params = array($this->id_detalle, $_SESSION['id_factura']);
        return Database::executeRow($sql, $params);
    }

    // Método para verificar la cantidad un producto que se encuentra en el carrito de compras.
    public function verifyCantidad()
    {
        $sql = "SELECT nombre, stock 
                FROM inventario 
                WHERE id_inventario = ? and stock >= ?";
        $params = array($this->producto,$this->cantidad);
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
