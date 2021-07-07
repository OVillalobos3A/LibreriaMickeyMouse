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
    private $telefono = null;

    
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
        if ($this->validateAlphanumeric($value, 1, 50)) {
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
        return $this->telefono;
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
                VALUES (?, ?, ?, ?, ?)';
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

    

    public function updateRow($current_image)
    {
        $sql = 'UPDATE proveedor 
                SET nombre = ?, correo = ?, direccion = ?, telefono = ?
                WHERE id_proveedor = ?'
        $params = array($this->nombre, $this->direccion, $this->correo, $this->tel);
        return Database::executeRow($sql, $params);
    }

    public function deleteRow()
    {
        $sql = 'DELETE FROM proveedor
                WHERE id_proveedor = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);
    }

}
