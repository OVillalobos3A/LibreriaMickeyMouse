<?php
/*
*	Clase para manejar la tabla usuarios de la base de datos. Es clase hija de Validator.
*/

class Entradas extends Validator
{
    private $id = null;    
    private $idem = null;    
    private $producto = null;
    private $fecha = null;
    private $cantidad = null;
    private $empleado = null;
    private $cantidad_act;
    private $sumar_cant;

    

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

    public function setIdem($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->idem = $value;
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

    public function setCantidad_act($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->cantidad_act= $value;
            return true;
        } else {
            return false;
        }
    }

    public function setSumar($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->sumar_cant = $value;
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

    public function setEmpleado($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->empleado = $value;
            return true;
        } else {
            return false;
        }
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


    //Métodos para obtener valores de los atributos.

    public function getId()
    {
        return $this->id;
    }

    public function getIdem()
    {
        return $this->idem;
    }

    public function getCantidad()
    {
        return $this->cantidad;
    }

    public function getCantidad_act()
    {
        return $this->cantidad_act;
    }

    public function getSumar()
    {
        return $this->sumar_cant;
    }

    public function getEmpleado()
    {
        return $this->empleado;
    }

    public function getProducto()
    {
        return $this->producto;
    }

    public function getFecha()
    {
        return $this->fecha;
    }


    //Métodos para realizar las operaciones SCRUD (search, create, read, update, delete).
    public function readAll()
    {
        $sql = 'SELECT id_entrada, entrada_inventario.cantidad as cantidad, entrada_inventario.fecha as fecha, empleados.nombre as empleado, inventario.nombre as producto, entrada_inventario.id_inventario as id_inventario
                FROM entrada_inventario INNER JOIN empleados USING(id_empleado)
                INNER JOIN inventario USING(id_inventario)                
                ORDER BY entrada_inventario.fecha';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readProd()
    {
        $sql = 'SELECT id_inventario, nombre as producto
                FROM inventario';
        $params = null;
        return Database::getRows($sql, $params);
    }


    public function createRow()
    {
        $sql = 'INSERT INTO entrada_inventario(cantidad, fecha, id_empleado, id_inventario)
                VALUES(?, ?, ?, ?)';
        $params = array($this->cantidad, $this->fecha, $this->empleado, $this->producto);
        return Database::executeRow($sql, $params);
    }

    public function updateInventario()
    {
        $sql = 'UPDATE inventario
        SET stock = ?
        WHERE id_inventario = ?';
        $params = array($this->cantidad_act, $this->producto);
        return Database::executeRow($sql, $params);
    }

    public function readAct()
    {
        $sql = 'SELECT stock FROM inventario
                WHERE id_inventario = ?';
        $params = array($this->producto);
        if ($data = Database::getRow($sql, $params)) {            
            $this->setSumar($data['stock']);
            return true;
        } else {
            return false;
        }                
    }

    public function readEmpl()
    {
        $sql = 'SELECT id_empleado FROM usuarios
                WHERE id_usuario = ?';
        $params = array($_SESSION['id_usuario']);
        if ($data = Database::getRow($sql, $params)) {            
            $this->setEmpleado($data['id_empleado']);
            return true;
        } else {
            return false;
        }                
    }

    public function deleteRow()
    {
        $sql = 'DELETE FROM entrada_inventario
                WHERE id_entrada = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);
    }
}
