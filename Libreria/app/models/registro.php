<?php
/*
*	Clase para manejar la tabla usuarios de la base de datos. Es clase hija de Validator.
*/
class Registro extends Validator
{
    // Declaración de atributos (propiedades).

    //----- Atributos de los usuarios
    private $id = null;
    private $usuario = null;
    private $clave = null;
    private $tipo = null;

    //----- Atributos de los empleados
    private $idemp = null;
    private $imagen = null;
    private $nombres = null;
    private $apellidos = null;
    private $correo = null;
    private $telefono = null;
    private $nacimiento = null;
    private $genero = null;
    private $estado = "Activo";
    private $dui = null;
    private $recu = null;
    private $ruta = '../../resources/img/empleados/';


    /*******************************/
    //----- Métodos de los usuarios
    /*******************************/


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

    public function setUsuario($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->usuario = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setClave($value)
    {
        if ($this->validatePassword($value)) {
            $this->clave = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setTipo($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->tipo = $value;
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

    /*
    *   Métodos para obtener valores de los atributos.
    */
    public function getId()
    {
        return $this->id;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function getClave()
    {
        return $this->clave;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function getEstado()
    {
        return $this->estado;
    }


    /*******************************/
    //----- Métodos de los usuarios
    /*******************************/


    /*
    *   Métodos para asignar valores a los atributos.
    */
    public function setIdEmp($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->idemp = $value;
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

    public function setNombres($value)
    {
        if ($this->validateAlphabetic($value, 1, 50)) {
            $this->nombres = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setApellidos($value)
    {
        if ($this->validateAlphabetic($value, 1, 50)) {
            $this->apellidos = $value;
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

    public function setTelefono($value)
    {
        if ($this->validatePhone($value)) {
            $this->telefono = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setNacimiento($value)
    {
        if ($this->validateDate($value)) {
            $this->nacimiento = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setDUI($value)
    {
        if ($this->validateDUI($value)) {
            $this->dui = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setGenero($value)
    {
        if ($this->validateAlphabetic($value, 1, 1)) {
            $this->genero = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setRecuperacion($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->recu = $value;
            return true;
        } else {
            return false;
        }
    }

    /*
    *   Métodos para obtener valores de los atributos.
    */
    public function getIdEmp()
    {
        return $this->id;
    }

    public function getImagen()
    {
        return $this->imagen;
    }

    public function getNombres()
    {
        return $this->nombres;
    }

    public function getApellidos()
    {
        return $this->apellidos;
    }

    public function getCorreo()
    {
        return $this->correo;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function getNacimiento()
    {
        return $this->nacimiento;
    }

    public function getGenero()
    {
        return $this->genero;
    }

    public function getDui()
    {
        return $this->dui;
    }

    public function getRecuperacion()
    {
        return $this->recu;
    }

    public function getRuta()
    {
        return $this->ruta;
    }

    /*
    *   Métodos para realizar las operaciones Create del registro del primer usuario.
    */

    public function createRow()
    {
        //Se inicializa el generador de aleatorios.
        mt_srand (time());
        //Se crea la variable que contendra al numero aleatorio.
        $temp = mt_rand(10000,99999);
        //Variable con el estado

        $sql = 'INSERT INTO public.empleados(imagen, nombre, apellido, correo, telefono, fecha_nac, genero, dui, codigo_recu, estado)
                VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
        $params = array($this->imagen, $this->nombres, $this->apellidos, $this->correo, $this->telefono, $this->nacimiento, $this->genero, $this->dui, $temp, $this->estado);
        return Database::executeRow($sql, $params);
    }

    public function createUser()
    {  
        // Se encripta la clave por medio del algoritmo bcrypt que genera un string de 60 caracteres.
        $hash = password_hash($this->clave, PASSWORD_DEFAULT);
        $sql = 'INSERT INTO public.usuarios(usuario, "contraseña", id_empleado, id_tipo_usuario, estado)
                VALUES( ?, ?,(SELECT MAX(id_empleado)
        FROM public.empleados where correo = ? ), ?, ?)';
        $params = array( $this->usuario, $hash, $this->correo, $this->tipo, $this->estado);
        return Database::executeRow($sql, $params);
        
    }

    public function deleteAll()
    {
        $sql = 'DELETE FROM public.empleados';
        return Database::executeRow($sql, null);
    }
}