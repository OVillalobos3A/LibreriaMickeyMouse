<?php
/*
*	Clase para manejar la tabla usuarios de la base de datos. Es clase hija de Validator.
*/
class Empleados_crud extends Validator
{
    //Declaración de atributos
    private $id = null;
    private $nombre = null;
    private $apellido = null;
    private $correo = null;
    private $telefono = null;
    private $fecha_nac = null;
    private $genero = null;
    private $dui = null;
    private $codigo_recu = null;
    private $estado = null;
    private $imagen = null;
    private $ruta = '../../resources/img/empleados/';

    
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

    public function setApellido($value)
    {
        if ($this->validateAlphabetic($value, 1, 50)) {
            $this->apellido = $value;
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

    public function setFecha($value)
    {
        if ($this->validateDate($value)) {
            $this->fecha = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setGen($value)
    {
        if ($this->validateGen($value)) {
            $this->gen = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setDui($value)
    {
        if ($this->validateDUI($value, 1, 50)) {
            $this->dui = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setCodigo($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->primer_uso = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setEstado($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->estado = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setImagen($file)
    {
        if ($this->validateImageFile($file, 500, 500)) {
            $this->imagen = $this->getImageName();
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

    public function getApellido()
    {
        return $this->apellido;
    }
  
    public function getCorreo()
    {
        return $this->correo;
    }

    public function getFecha()
    {
        return $this->fecha_nac;
    }

    public function getTel()
    {
        return $this->telefono;
    }

    public function getGenero()
    {
        return $this->genero;
    }

    public function getDui()
    {
        return $this->dui;
    }

    public function getCodigo()
    {
        return $this->codigo_recu;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function getImagen()
    {
        return $this->imagen;
    }

    public function getRuta()
    {
        return $this->ruta;
    }

    
      //Métodos para realizar las operaciones SCRUD (search, create, read, update, delete).
    

    public function readAll()
    {
        $sql = 'SELECT id_empleado, nombre, apellido, correo, dui, telefono, genero, fecha_nac, empleados.estado, imagen
                FROM empleados';
        $params = null;
        return Database::getRows($sql, $params);
    }
    
    public function readOne()
    {
        $sql = 'SELECT id_empleado, nombre, apellido, correo, dui, telefono, genero, fecha_nac, estado, imagen
                FROM empleados
                WHERE id_empleado = ?';        
        $params = array($this->id);        
        return Database::getRow($sql, $params);
    }

    public function searchRows($value)
    {
        $sql = 'SELECT id_empleado, nombre, apellido, correo, dui, telefono, estado, genero, fecha_nac, imagen
                FROM empleados
                WHERE nombre ILIKE ? and id_empleado <> (Select MIN(id_empleado)from empleados)';
        $params = array("%$value%");
        return Database::getRows($sql, $params);
    }

    public function createRow()
    {
        $sql = 'INSERT INTO empleados(imagen, nombre, apellido, correo, telefono, dui, fecha_nac, genero, estado)
                VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)';
        $params = array($this->imagen, $this->nombre, $this->apellido, $this->correo, $this->tel, $this->dui, $this->fecha, $this->gen, $this->estado);
        if ($this->ide = Database::getLastRow($sql, $params)) {
            return true;
        } else {
            return false;
        }
    }

    public function readCount()
    {
        $sql = 'SELECT Count(id_empleado) as numero
                FROM empleados';
        $params = null;
        return Database::getRow($sql, $params);
    }

    

    public function updateRow($current_image)
    {
        // Se verifica si existe una nueva imagen para borrar la actual, de lo contrario se mantiene la actual.
        ($this->imagen) ? $this->deleteFile($this->getRuta(), $current_image) : $this->imagen = $current_image;

        $sql = 'UPDATE empleados 
                SET nombre = ?, apellido = ?, correo = ?, telefono = ?, estado = ?, fecha_nac = ?, genero = ?, dui = ?, imagen = ?
                WHERE id_empleado= ?';
        $params = array($this->nombre, $this->apellido, $this->correo, $this->tel, $this->estado, $this->fecha, $this->gen, $this->dui, $this->imagen, $this->id);
        return Database::executeRow($sql, $params);
    }

    public function deleteRow()
    {
        $sql = 'DELETE FROM empleados
                WHERE id_empleado = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);
    }

}

