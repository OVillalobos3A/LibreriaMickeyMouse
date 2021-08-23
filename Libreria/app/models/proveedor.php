<?php
/*
*	Clase para manejar la tabla usuarios de la base de datos. Es clase hija de Validator.
*/
class Proveedor_crud extends Validator
{
    //Declaración de atributos
    private $id = null;
    private $nombre = null;
    private $direccion = null;
    private $correo = null;
    private $tel = null;

    
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

    public function setNombre($value)
    {
        if ($this->validateAlphabetic($value, 1, 50)) {
            $this->nombre = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setDireccion($value)
    {
        if ($this->validateString($value, 1, 500)) {
            $this->direccion = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setCorreo($value)
    {
        if ($this->validateEmail($value)) {
            $this->correo = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setTel($value)
    {
        if ($this->validatePhone($value)) {
            $this->tel = $value;
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
    public function getNombre()
    {
        return $this->nombre;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }
  
    public function getCorreo()
    {
        return $this->correo;
    }


    public function getTel()
    {
        return $this->tel;
    }


    
      //Métodos para realizar las operaciones SCRUD (search, create, read, update, delete).
    

    public function readAll()
    {
        $sql = 'SELECT id_proveedor, nombre, correo, direccion, telefono
                FROM public.proveedor';
        $params = null;
        return Database::getRows($sql, $params);
    }
    
    public function readOne()
    {
        $sql = 'SELECT id_proveedor, nombre, correo, direccion, telefono
                FROM public.proveedor
                WHERE id_proveedor = ?';        
        $params = array($this->id);        
        return Database::getRow($sql, $params);
    }

    public function searchRows($value)
    {
        $sql = 'SELECT id_proveedor, nombre, correo, direccion, telefono
                FROM public.proveedor
                WHERE nombre ILIKE ? and id_proveedor <> (Select MIN(id_proveedor)from proveedor)';
        $params = array("%$value%");
        return Database::getRows($sql, $params);
    }

    public function createRow()
    {
        $sql = 'INSERT INTO public.proveedor(nombre, correo, direccion, telefono)
                VALUES (?, ?, ?, ?)';
        $params = array( $this->nombre, $this->correo, $this->direccion, $this->tel);
        if ($this->ide = Database::getLastRow($sql, $params)) {
            return true;
        } else {
            return false;
        }
    }

    public function readCount()
    {
        $sql = 'SELECT Count(id_proveedor) as numero
                FROM proveedor';
        $params = null;
        return Database::getRow($sql, $params);
    }

    public function updateRow()
    {
        $sql = 'UPDATE proveedor 
                SET nombre = ?, correo = ?, direccion = ?, telefono = ?
                WHERE id_proveedor = ?';
        $params = array($this->nombre, $this->correo, $this->direccion, $this->tel,$this->id);
        return Database::executeRow($sql, $params);
    }

    public function deleteRow()
    {
        $sql = 'DELETE FROM proveedor
                WHERE id_proveedor = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);
    }

    public function readAllReport()
    {
        $sql = 'SELECT nombre, correo, direccion, telefono
                FROM public.proveedor';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readProductosReport()
    {
        $sql = 'SELECT public.inventario.nombre as nombre_producto, precio, public.inventario.descripcion, stock, autor, nombre_marca as marca, tipo_producto
                FROM public.proveedor
                INNER JOIN public.inventario USING(id_proveedor)
                INNER JOIN public.tipo_producto USING(id_tipo_producto) 
                INNER JOIN public.marca USING(id_marca)
                WHERE id_proveedor = ?';
        $params = array($this->id);
        return Database::getRows($sql, $params);
    }
}

