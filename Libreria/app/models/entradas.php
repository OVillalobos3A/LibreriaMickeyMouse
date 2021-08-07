<?php
/*
*	Clase para manejar la tabla de Entradas de la base de datos. Es clase hija de Validator.
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

    //Se valida el Id de la Entrada
    public function setId($value)
    {
        //Se valida que el campo sea un número natural
        if ($this->validateNaturalNumber($value)) {
            //Se guarda el dato
            $this->id = $value;
            return true;
        } else {
            return false;
        }
    }

    //Se valida el Id 
    public function setIdem($value)
    {
        //Se valida que el campo sea un número natural
        if ($this->validateNaturalNumber($value)) {
            //Se guarda el dato
            $this->idem = $value;
            return true;
        } else {
            return false;
        }
    }

    //Se valida la Cantidad a Ingresar 
    public function setCantidad($value)
    {
        //Se valida que el campo ingresado sea un número natural
        if ($this->validateNaturalNumber($value)) {
            //Se guarda el dato
            $this->cantidad = $value;
            return true;
        } else {
            return false;
        }
    }

    //Se valida la Cantidad Actual del inventario
    public function setCantidad_act($value)
    {
        //Se valida que el campo sea un número natural 
        if ($this->validateNaturalNumber($value)) {
            //Se guarda el dato
            $this->cantidad_act= $value;
            return true;
        } else {
            return false;
        }
    }

    //Se valida la Cantidad Sumada 
    public function setSumar($value)
    {
        //Se valida que el campo sea un número natural
        if ($this->validateNaturalNumber($value)) {
            //Se guarda el dato
            $this->sumar_cant = $value;
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

    //Se valida el Id del Empleado
    public function setEmpleado($value)
    {
        //Se valida que el campo sea un número natural
        if ($this->validateNaturalNumber($value)) {
            //Se guarda el dato
            $this->empleado = $value;
            return true;
        } else {
            return false;
        }
    }

    //Se valida la Fecha de la Entrada
    public function setFecha($value)
    {
        //Se valida que la Fecha de la entrada esté en el formato requerido
        if ($this->validateDate($value)) {
            //Se guarda el dato
            $this->fecha = $value;
            return true;
        } else {
            return false;
        }
    }


    //Métodos para obtener valores de los atributos.

    //Se obtiene el Id de la Entrada
    public function getId()
    {
        //Se retorna el dato
        return $this->id;
    }

    //Se obtiene el Id 
    public function getIdem()
    {
        //Se retorna el dato
        return $this->idem;
    }

    //Se obtiene la Cantidad a Ingresar
    public function getCantidad()
    {
        //Se retorna el dato
        return $this->cantidad;
    }

    //Se obtiene la Cantidad Actual que hay en el Inventario
    public function getCantidad_act()
    {
        //Se retorna el dato
        return $this->cantidad_act;
    }

    //Se obtiene la suma
    public function getSumar()
    {
        //Se retorna el dato
        return $this->sumar_cant;
    }

    //Se obtiene el empleado
    public function getEmpleado()
    {
        //Se retorna el dato
        return $this->empleado;
    }

    //Se obtiene el Id del producto
    public function getProducto()
    {
        //Se retorna el dato
        return $this->producto;
    }

    //Se obtiene la Fecha de la Entrada
    public function getFecha()
    {
        //Se retorna el dato
        return $this->fecha;
    }


    //Métodos para realizar las operaciones SCRUD (search, create, read, update, delete).

    //Leer todas las entradas
    public function readAll()
    {
        //Se guarda la consulta sql
        $sql = 'SELECT id_entrada, entrada_inventario.cantidad as cantidad, entrada_inventario.fecha as fecha, empleados.nombre as empleado, inventario.nombre as producto, entrada_inventario.id_inventario as id_inventario
                FROM entrada_inventario INNER JOIN empleados USING(id_empleado)
                INNER JOIN inventario USING(id_inventario)                
                ORDER BY entrada_inventario.fecha';
        //Se guarda un array con los parametros de la consulta(vacío)
        $params = null;
        //Se retorna la ejecución del método "getRows"
        return Database::getRows($sql, $params);
    }

    //Buscar
    public function searchRows($value)
    {
        //Se guarda la consulta sql
        $sql = 'SELECT id_entrada, entrada_inventario.cantidad as cantidad, entrada_inventario.fecha as fecha, empleados.nombre as empleado, inventario.nombre as producto, entrada_inventario.id_inventario as id_inventario
        FROM entrada_inventario INNER JOIN empleados USING(id_empleado)
        INNER JOIN inventario USING(id_inventario)      
        WHERE inventario.nombre ILIKE ?
        ORDER BY entrada_inventario.fecha';
        //Se guarda un array con los parametros de la consulta(vacío)
        $params = array("%$value%");
        //Se retorna la ejecución del método "getRows"
        return Database::getRows($sql, $params);
    }

    //Leer producto en específico
    public function readProd()
    {
        //Se guarda la consulta sql
        $sql = 'SELECT id_inventario, nombre as producto
                FROM inventario';
        //Se guarda un array con los parametros de la consulta(vacío)
        $params = null;
        //Se retorna la ejecución del método "getRows"
        return Database::getRows($sql, $params);
    }

    //Insert
    public function createRow()
    {
        //Se guarda la consulta sql
        $sql = 'INSERT INTO entrada_inventario(cantidad, fecha, id_empleado, id_inventario)
                VALUES(?, ?, ?, ?)';
        //Se guarda un array con los parametros de la consulta
        $params = array($this->cantidad, $this->fecha, $this->empleado, $this->producto);
        //Se retorna la ejecución del método "executeRow"
        return Database::executeRow($sql, $params);
    }

    //Actualizar cantidad stock del inventario
    public function updateInventario()
    {
        //Se guarda la consulta sql
        $sql = 'UPDATE inventario
        SET stock = ?
        WHERE id_inventario = ?';
        //Se guarda un array con los parametros de la consulta
        $params = array($this->cantidad_act, $this->producto);
        //Se retorna la ejecución del método "executeRow"
        return Database::executeRow($sql, $params);
    }

    //Leer cantidad actual en stock del inventario
    public function readAct()
    {
        //Se guarda la consulta sql
        $sql = 'SELECT stock FROM inventario
                WHERE id_inventario = ?';
        //Se guarda un array con los parametros de la consulta
        $params = array($this->producto);
        //Se retorna la ejecución del método "getRow"
        if ($data = Database::getRow($sql, $params)) { 
            //Se setea la cantidad en Stock del inventario           
            $this->setSumar($data['stock']);
            return true;
        } else {
            return false;
        }                
    }

    //Leer al Empleado
    public function readEmpl()
    {
        //Se guarda la consulta sql
        $sql = 'SELECT id_empleado FROM usuarios
                WHERE id_usuario = ?';
        //Se guarda un array con los parametros de la consulta
        $params = array($_SESSION['id_usuario']);
        //Se retorna la ejecución del método "getRow"
        if ($data = Database::getRow($sql, $params)) {     
            //Se setea al empleado       
            $this->setEmpleado($data['id_empleado']);
            return true;
        } else {
            return false;
        }                
    }

    //Se elimina la Entrada
    public function deleteRow()
    {
        //Se guarda la consulta sql
        $sql = 'DELETE FROM entrada_inventario
                WHERE id_entrada = ?';
        //Se guarda un array con los parametros de la consulta
        $params = array($this->id);
        //Se retorna la ejecución del método "executeRow"
        return Database::executeRow($sql, $params);
    }
}
