<?php
/*
*	Clase para manejar la tabla usuarios de la base de datos. Es clase hija de Validator.
*/
class Empleados extends Validator
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

    //Permite validar el Id del Empleado
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

    //Permite validar el Nombre del Empleado
    public function setNombre($value)
    {
        //Se valida que el campo sea un alfanúmerico(números y letras)
        if ($this->validateAlphabetic($value, 1, 50)) {
            //Se guarda el dato
            $this->nombre = $value;
            return true;
        } else {
            return false;
        }
    }

    //Permite validar los Apellidos del Empleado
    public function setApellido($value)
    {
        //Se valida que el campo sea un alfanúmerico(números y letras)
        if ($this->validateAlphabetic($value, 1, 50)) {
            //Se guarda el dato
            $this->apellido = $value;
            return true;
        } else {
            return false;
        }
    }

    //Permite validar el Correo del Empleado
    public function setCorreo($value)
    {
        //Se valida que el Correo Electrónico del Empleado contenga el formato correcto para ese campo
        if ($this->validateEmail($value)) {
            //Se guarda el dato
            $this->correo = $value;
            return true;
        } else {
            return false;
        }
    }

    //Permite validar el Número de Teléfono del Empleado
    public function setTel($value)
    {
        //Se valida que el Número de Teléfono del Empleado contenga el formato correcto para ese campo
        if ($this->validatePhone($value)) {
            //Se guarda el dato
            $this->tel = $value;
            return true;
        } else {
            return false;
        }
    }

    //Permite validar la Fecha ingresada para el Empleado
    public function setFecha($value)
    {
        //Se valida que la fecha ingresada corresponda con la mayoría de Edad, a la vez que se comprueba el formato ingresado
        if ($this->validateBirthDate($value)) {
            $this->fecha = $value;
            return true;
        } else {
            return false;
        }
    }

    //Se valida el Género del Empleado
    public function setGen($value)
    {
        //Se valida que el género ingresado cumpla con el formato establecido
        if ($this->validateGen($value)) {
            //Se guarda el dato
            $this->gen = $value;
            return true;
        } else {
            return false;
        }
    }

    //Se valida el DUI del Empleado
    public function setDui($value)
    {
        //Se valida que el campo tenga el formato requerido
        if ($this->validateDUI($value, 1, 50)) {
            //Se guarda el dato
            $this->dui = $value;
            return true;
        } else {
            return false;
        }
    }

    //Se valida el Código de Recuperación del Usuario
    public function setCodigo($value)
    {
        //Se valida que el campo sea un número natural
        if ($this->validateNaturalNumber($value)) {
            //Se guarda el dato
            $this->primer_uso = $value;
            return true;
        } else {
            return false;
        }
    }

    //Se valida el Estado del Usuario
    public function setEstado($value)
    {
        //Se valida que el campo sea alfanumérico
        if ($this->validateAlphanumeric($value, 1, 50)) {
            //Se guarda el dato
            $this->estado = $value;
            return true;
        } else {
            return false;
        }
    }

    //Se valida la imagen
    public function setImagen($file)
    {
        //Se comprueban los parámetros de entrada necesarios para poder guardas la imagen
        if ($this->validateImageFile($file, 500, 500)) {
            //Se guarda el dato
            $this->imagen = $this->getImageName();
            return true;
        } else {
            return false;
        }
    }


    
    //Métodos para obtener valores de los atributos.
    
    //Se obtiene el Id del Empleado
    public function getId()
    {
        //Se retorna el dato
        return $this->id;
    }

    //Se obtiene el Nombre del Empleado
    public function getNombre()
    {
        //Se retorna el dato
        return $this->nombre;
    }

    //Se obtienen los Apellidos del Empleado
    public function getApellido()
    {
        //Se retorna el dato
        return $this->apellido;
    }
  
    //Se obtiene el Correo Electrónico del Empleado
    public function getCorreo()
    {
        //Se retorna el dato
        return $this->correo;
    }

    //Se obtiene la Fecha de Nacimiento del Empleado
    public function getFecha()
    {
        //Se retorna el dato
        return $this->fecha_nac;
    }

    //Se obtiene el Teléfono del Empleado
    public function getTel()
    {
        //Se retorna el dato
        return $this->telefono;
    }

    //Se obtiene el Género del Empleado
    public function getGenero()
    {
        //Se retorna el dato
        return $this->genero;
    }

    //Se obtiene el DUI del Empleado
    public function getDui()
    {
        //Se retorna el dato
        return $this->dui;
    }

    //Se obtiene el código de Recuperación del Empleado
    public function getCodigo()
    {
        //Se retorna el dato
        return $this->codigo_recu;
    }

    //Se obtiene el Estado del Empleado
    public function getEstado()
    {
        //Se retorna el dato
        return $this->estado;
    }

    //Se obtiene la Imagen del Empleado
    public function getImagen()
    {
        //Se retorna el dato
        return $this->imagen;
    }

    //Se obtiene la Ruta de la Imagen del Empleado
    public function getRuta()
    {
        //Se retorna el dato
        return $this->ruta;
    }

    
      //Métodos para realizar las operaciones SCRUD (search, create, read, update, delete).
    
    //Ver todos los Empleados
    public function readAll()
    {   
        //Se guarda la consulta sql
        $sql = 'SELECT id_empleado, nombre, apellido, correo, dui, telefono, genero, fecha_nac, empleados.estado, imagen
                FROM empleados';
        //Se guarda un array con los parametros de la consulta(vacío)
        $params = null;
        //Se retorna la ejecución del método "getRows"
        return Database::getRows($sql, $params);
    }
    
    //Ver un empleado en específico
    public function readOne()
    {
        //Se guarda la consulta sql
        $sql = 'SELECT id_empleado, nombre, apellido, correo, dui, telefono, genero, fecha_nac, estado, imagen
                FROM empleados
                WHERE id_empleado = ?';     
        //Se guarda un array con los parametros de la consulta   
        $params = array($this->id);        
        //Se retorna la ejecución del método "getRow"
        return Database::getRow($sql, $params);
    }

    //Buscar
    public function searchRows($value)
    {
        //Se guarda la consulta sql
        $sql = 'SELECT id_empleado, nombre, apellido, correo, dui, telefono, estado, genero, fecha_nac, imagen
                FROM empleados
                WHERE nombre ILIKE ? and id_empleado <> (Select MIN(id_empleado)from empleados)';
        //Se guarda un array con los parametros de la consulta
        $params = array("%$value%");
        //Se retorna la ejecución del método "getRows"
        return Database::getRows($sql, $params);
    }

    //Crear
    public function createRow()
    {
        //Se guarda la consulta sql
        $sql = 'INSERT INTO empleados(imagen, nombre, apellido, correo, telefono, dui, fecha_nac, genero, estado)
                VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)';
        //Se guarda un array con los parametros de la consulta
        $params = array($this->imagen, $this->nombre, $this->apellido, $this->correo, $this->tel, $this->dui, $this->fecha, $this->gen, $this->estado);
        
        //Se retorna la ejecución del método "getLastRow"
        if ($this->ide = Database::getLastRow($sql, $params)) {
            return true;
        } else {
            return false;
        }
    }

    //Contador
    public function readCount()
    {
        //Se guarda la consulta sql
        $sql = 'SELECT Count(id_empleado) as numero
                FROM empleados';
        //Se guarda un array con los parametros de la consulta(vacío)        
        $params = null;
        //Se retorna la ejecución del método "getRow"
        return Database::getRow($sql, $params);
    }

    //Actualizar
    public function updateRow($current_image)
    {
        // Se verifica si existe una nueva imagen para borrar la actual, de lo contrario se mantiene la actual.
        ($this->imagen) ? $this->deleteFile($this->getRuta(), $current_image) : $this->imagen = $current_image;
        //Se guarda la consulta sql
        $sql = 'UPDATE empleados 
                SET nombre = ?, apellido = ?, correo = ?, telefono = ?, estado = ?, fecha_nac = ?, genero = ?, dui = ?, imagen = ?
                WHERE id_empleado= ?';
        //Se guarda un array con los parametros de la consulta
        $params = array($this->nombre, $this->apellido, $this->correo, $this->tel, $this->estado, $this->fecha, $this->gen, $this->dui, $this->imagen, $this->id);
        //Se retorna la ejecución del método "executeRow"
        return Database::executeRow($sql, $params);
    }

    //Eliminar
    public function deleteRow()
    {
        //Se guarda la consulta sql
        $sql = 'DELETE FROM empleados
                WHERE id_empleado = ?';
        //Se guarda un array con los parametros de la consulta(vacío)  
        $params = array($this->id);
        //Se retorna la ejecución del método "executeRow"
        return Database::executeRow($sql, $params);
    }

}

