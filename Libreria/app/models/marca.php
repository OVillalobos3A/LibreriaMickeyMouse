<?php
/*
*	Clase para manejar la tabla usuarios de la base de datos. Es clase hija de Validator.
*/
class Marca_crud extends Validator
{
    //Declaración de atributos
    private $id = null;
    private $nombre = null;

    
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
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->nombre = $value;
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


    
      //Métodos para realizar las operaciones SCRUD (search, create, read, update, delete).
    

    public function readAll()
    {
        $sql = 'SELECT id_marca, nombre_marca
        FROM public.marca';
        $params = null;
        return Database::getRows($sql, $params);
    }
    
    public function readOne()
    {
        $sql = 'SELECT id_marca, nombre_marca
        FROM public.marca
                WHERE id_marca = ?';        
        $params = array($this->id);        
        return Database::getRow($sql, $params);
    }

    public function searchRows($value)
    {
        $sql = 'SELECT id_marca, nombre_marca
        FROM public.marca
                WHERE nombre_marca ILIKE ? and id_marca <> (Select MIN(id_marca)from marca)';
        $params = array("%$value%");
        return Database::getRows($sql, $params);
    }

    public function createRow()
    {
        $sql = 'INSERT INTO public.marca(nombre_marca)
                VALUES (?)';
        $params = array( $this->nombre);
        if ($this->ide = Database::getLastRow($sql, $params)) {
            return true;
        } else {
            return false;
        }
    }

    public function readCount()
    {
        $sql = 'SELECT Count(id_marca) as numero
                FROM marca';
        $params = null;
        return Database::getRow($sql, $params);
    }

    

    public function updateRow($current_image)
    {
        $sql = 'UPDATE marca 
                SET nombre_marca = ?
                WHERE id_marca = ?'
        $params = array($this->nombre);
        return Database::executeRow($sql, $params);
    }

    public function deleteRow()
    {
        $sql = 'DELETE FROM marca
                WHERE id_marca = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);
    }

}

