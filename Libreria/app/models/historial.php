<?php
/*
*	Clase para manejar la tabla categorias de la base de datos. Es clase hija de Validator.
*/
class Historial extends Validator
{
    // Declaración de atributos (propiedades).
    private $id = null;
    private $estado = null;
    private $fecha = null;
    private $fecha2 = null;
    /*
    *   Métodos para asignar valores a los atributos.
    */
    public function setId($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->id = $value;
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

    public function setFecha($value)
    {
        if ($this->validateDate($value)) {
            $this->fecha = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setFecha2($value)
    {
        if ($this->validateDate($value)) {
            $this->fecha2 = $value;
            return true;
        } else {
            return false;
        }
    }

    /*
    *   Métodos para obtener valores de los atributos.
    */
    public function getId()
    {
        return $this->id;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function getFecha2()
    {
        return $this->fecha2;
    }

    /*
    *   Métodos para realizar las operaciones SCRUD (search, create, read, update, delete).
    */
    public function searchRows($value)
    {
        $sql = "SELECT DISTINCT id_pedido, pedido.estado as estado, fecha_pedido, (clientes.nombre || ' ' || clientes.apellido) as cliente, clientes.direccion as direccion, usuario,
                ('$' || ' ' || sum(detalle_pedido.precio_producto*detalle_pedido.cantidad)) as total
                FROM pedido INNER JOIN detalle_pedido USING(id_pedido) INNER JOIN clientes USING(id_cliente)
                WHERE clientes.nombre ILIKE ? OR pedido.estado ILIKE ? OR clientes.direccion ILIKE ?
                GROUP BY pedido.id_pedido, clientes.nombre, clientes.apellido, clientes.direccion, clientes.usuario";
        $params = array("%$value%", "%$value%", "%$value%");
        return Database::getRows($sql, $params);
    }

    public function searchPedido($value)
    {
        $int = (int)$value;
        $sql = "SELECT id_factura, factura.estado as estado, fecha,
                ('$' || ' ' || sum(detalle_compra.precio*detalle_compra.cantidad)) as total, usuario
                FROM factura INNER JOIN detalle_compra USING(id_factura) INNER JOIN usuarios USING(id_usuario)
                WHERE factura.id_factura = ?
                GROUP BY factura.id_factura, usuario";
        $params = array($int);
        return Database::getRows($sql, $params);
    }
    public function readAll()
    {
        $sql = "SELECT DISTINCT id_factura, factura.estado as estado, fecha,
                ('$' || ' ' || sum(detalle_compra.precio*detalle_compra.cantidad)) as total, usuario
                FROM factura INNER JOIN detalle_compra USING(id_factura) INNER JOIN usuarios USING(id_usuario)
                GROUP BY factura.id_factura, usuario";
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function viewShop()
    {
        $sql = 'SELECT detalle_compra.id_factura as id_factura, inventario.nombre as nombre, cantidad, detalle_compra.precio as precio, (detalle_compra.precio*cantidad) as subtotal, inventario.imagen as imagen
                FROM detalle_compra INNER JOIN factura ON detalle_compra.id_factura = factura.id_factura
                INNER JOIN inventario ON detalle_compra.id_inventario = inventario.id_inventario
                WHERE detalle_compra.id_factura = ?';
        $params = array($this->id);
        return Database::getRows($sql, $params);
    }

    public function readOne()
    {
        $sql = "SELECT id_factura, factura.estado as estado, fecha
                FROM factura 
                WHERE id_factura = ?";
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }
    
    //Funcion para obtener los datos que van en el reporte de factura
    public function readFactura()
    {
        $sql = 'SELECT detalle_compra.id_factura as id_factura, inventario.nombre as nombre, cantidad, detalle_compra.precio as precio, (detalle_compra.precio * cantidad) as subtotal
                FROM detalle_compra INNER JOIN factura ON detalle_compra.id_factura = factura.id_factura
                INNER JOIN inventario ON detalle_compra.id_inventario = inventario.id_inventario
                WHERE detalle_compra.id_factura = ?';
        $params = array($this->id);
        return Database::getRows($sql, $params);
    }
    
    //Funcion para obtener el total de la compra de una factura en especifico.
    public function readTotal()
    {
        $sql = 'SELECT id_factura, sum(detalle_compra.precio * detalle_compra.cantidad) as total
                FROM factura INNER JOIN detalle_compra USING(id_factura)
                WHERE detalle_compra.id_factura = ?
                GROUP BY id_factura;';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }
    //Funcion para obtener las ventas que han habido en un rango de fechas.
    public function readReportVentas()
    {
        $sql = "SELECT id_factura, factura.estado as estado, fecha, (empleados.nombre || ' ' || empleados.apellido) as empleado,
                sum(detalle_compra.precio*detalle_compra.cantidad) as total
                FROM factura INNER JOIN detalle_compra USING(id_factura) INNER JOIN usuarios USING(id_usuario)
                INNER JOIN empleados USING(id_empleado)
                WHERE fecha between ? and ?
                GROUP BY factura.id_factura, usuario, empleado";
        $params = array($this->fecha, $this->fecha2);
        return Database::getRows($sql, $params);
    }
}
