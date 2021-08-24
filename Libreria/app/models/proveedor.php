<?php
/*
*	Clase para manejar la tabla proveedores de la base de datos. Es clase hija de Validator.
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

    //Permite validar el ID del Proveedor.
    public function setId($value)
    {
        //Se valida que el campo sea un número natural.
        if ($this->validateNaturalNumber($value)) {
            //Se guarda el dato.
            $this->id = $value;
            return true;
        } else {
            return false;
        }
    }

    //Permite validar el Nombre del Proveedor.
    public function setNombre($value)
    {
        //Se valida que el campo contenga caracteres alfabéticos.
        if ($this->validateAlphabetic($value, 1, 50)) {}
            //Se guarda el dato
            $this->nombre = $value;
            return true;
        } else {
            return false;
        }
    }

    //Permite validar la Dirección del Proveedor
    public function setDireccion($value)
    {
        //Se valida que el campo sea una cadena de caracteres.
        if ($this->validateString($value, 1, 500)) {
            //Se guarda el dato
            $this->direccion = $value;
            return true;
        } else {
            return false;
        }
    }

    //Permite validar el Correo del Proveedor.
    public function setCorreo($value)
    {
        //Se valida que el Correo ingresado contenga el formato indicado.
        if ($this->validateEmail($value)) {
            //Se guarda el dato.
            $this->correo = $value;
            return true;
        } else {
            return false;
        }
    }

    //Permite valida el Número Telefónico del Proveedor.
    public function setTel($value)
    {
        //Se valida que el Número ingresado contenga el formato requerido.
        if ($this->validatePhone($value)) {
            //Se guarda el dato.
            $this->tel = $value;
            return true;
        } else {
            return false;
        }
    }


    
    //Métodos para obtener valores de los atributos.
    
    //Se obtiene el Id del Proveedor
    public function getId()
    {
        //Se reotrna el dato
        return $this->id;
    }
    //Se obtiene el Nombre del Proveedor
    public function getNombre()
    {
        //Se retorna el dato
        return $this->nombre;
    }

    //Se obtiene la Dirección del Proveedor
    public function getDireccion()
    {
        //Se retorna el dato
        return $this->direccion;
    }
  
    //Se obtiene el Correo del Proveedor
    public function getCorreo()
    {
        //Se retorna el dato
        return $this->correo;
    }

    //Se obtiene el Número Telefónico del Proveedor
    public function getTel()
    {
        //Se retorna el dato
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

