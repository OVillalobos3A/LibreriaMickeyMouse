<?php
/*
*	Clase para manejar la tabla usuarios de la base de datos. Es clase hija de Validator.
*/
class Usuarios extends Validator
{
    // Declaración de atributos (propiedades).
    private $cant = null;
    private $id = null;
    private $nombres = null;
    private $apellidos = null;
    private $correo = null;
    private $alias = null;
    private $clave = null;
    private $tipo = null;
    private $direccion = null;
    private $estado = null;
    private $dui = null;
    private $primer_uso = null;
    private $autenticacion = null;
    private $codigo = null;
    private $intentos = null;
    private $fecha = null;

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

    public function setFecha($value)
    {
        if ($this->validateDate($value)) {
            $this->fecha = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setCant($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->cant = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setIntentos($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->intentos = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setAutenticacion($value)
    {
        if ($this->validateBoolean($value)) {
            $this->autenticacion = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setCodigo($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->codigo = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setPrimer_uso($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->primer_uso = $value;
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

    public function setAlias($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->alias = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setClave($value)
    {
        if ($this->validatePass($value)) {
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

    public function setDireccion($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->direccion = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setEstado($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->estado = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setDui($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->dui = $value;
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

    public function getCant()
    {
        return $this->cant;
    }

    public function getFecha()
    {
        return $this->fecha;
    }


    public function getAuten()
    {
        return $this->autenticacion;
    }

    public function getIntentos()
    {
        return $this->intentos;
    }

    public function getCodigo()
    {
        return $this->codigo;
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

    public function getAlias()
    {
        return $this->alias;
    }

    public function getClave()
    {
        return $this->clave;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function getDui()
    {
        return $this->dui;
    }
    
    public function getPrimer_uso()
    {
        return $this->primer_uso;
    } 

    /*
    *   Métodos para gestionar la cuenta del usuario.
    */
    public function checkUser($alias)
    {
        $this->estado = "activo";
        $sql = 'SELECT id_usuario, last_date, autenticacion, empleados.correo as correo FROM usuarios INNER JOIN empleados USING(id_empleado) WHERE usuario = ? and usuarios.estado = ? ';
        $params = array($alias, $this->estado);
        if ($data = Database::getRow($sql, $params)) {
            $this->id = $data['id_usuario'];
            $this->alias = $alias;
            $this->fecha = $data['last_date'];
            date_default_timezone_set('America/El_Salvador');
            $date = date('Y-m-d');
            $fecha1 = new DateTime($this->fecha);
            $fecha2 = new DateTime($date);
            $rela = $fecha1->diff($fecha2);
            $this->cant = $rela->days;
            $this->autenticacion = $data['autenticacion'];
            $this->correo = $data['correo'];
            return true;
        } else {
            return false;
        }
    } 

    public function checkPrimerUso($alias)
    {
        $sql = 'SELECT primer_uso FROM public.usuarios WHERE usuario = ?';
        $params = array($alias);
        if ($data = Database::getRow($sql, $params)) {
            //$this->primer_uso = $data['primer_uso'];
            $this->setPrimer_uso($data['primer_uso']);
            $this->alias = $alias;
            return true;
        } else {
            return false;
        }
    }

    public function checkPassword($password)
    {
        $sql = 'SELECT "contraseña" FROM public.usuarios WHERE id_usuario = ?';
        $params = array($this->id);
        $data = Database::getRow($sql, $params);
        if (password_verify($password, $data['contraseña'])) {
            return true;
        } else {
            return false;
        }
    }


    public function updatePass()
    {
        // Se encripta la clave por medio del algoritmo bcrypt que genera un string de 60 caracteres.
        $hash = password_hash($this->clave, PASSWORD_DEFAULT);
        $sql = 'UPDATE usuarios set "contraseña" = ? from empleados where usuarios.id_empleado=empleados.id_empleado and empleados.correo=?';
        // Creamos la sentencia SQL que contiene la consulta que mandaremos a la base        
        $params = array($hash , $this->correo);
        return Database::executeRow($sql, $params);
    }
    
    public function readProfile()
    {
        $sql = 'SELECT id_usuario, usuario, "contraseña", id_empleado, id_tipo_usuario, estado
                FROM public.usuarios
                WHERE id_usuario = ?';
        $params = array($_SESSION['id_usuario']);
        return Database::getRow($sql, $params);
    }

    /*
    *   Métodos para realizar las operaciones SCRUD (search, create, read, update, delete).
    */
    public function searchRows($value)
    {
        $sql = 'SELECT id_usuario, usuario, "contraseña", id_empleado, id_tipo_usuario, estado
                FROM public.usuarios
                WHERE apellido_usuario ILIKE ? OR nombres_usuario ILIKE ? OR nick_usuario ILIKE ?
                ORDER BY apellido_usuario';
        $params = array("%$value%", "%$value%", "%$value%");
        return Database::getRows($sql, $params);
    }

    public function createRow()
    {
        // Se encripta la clave por medio del algoritmo bcrypt que genera un string de 60 caracteres.
        $hash = password_hash($this->clave, PASSWORD_DEFAULT);
        $sql = 'INSERT INTO public.usuarios(nombre_usuario, apellido_usuario, email_usuario, nick_usuario, clave_usuario, dui, direccion_usuario, tipo_usuario, estado)
                VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)';
        $params = array($this->nombres, $this->apellidos, $this->correo, $this->alias, $hash, $this->dui. $this->direccion, $this->tipo, $this->estado);
        return Database::executeRow($sql, $params);
    }

    public function readAll()
    {
        $sql = 'SELECT id_usuario, usuario, "contraseña", id_empleado, id_tipo_usuario, estado
                FROM public.usuarios
                ORDER BY usuario';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readOne()
    {
        $sql = 'SELECT id_usuario, usuario, "contraseña", id_empleado, id_tipo_usuario, estado
                FROM public.usuarios
                WHERE id_usuario = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    public function readOneReport()
    {
        $sql = 'SELECT nombre, apellido, usuario
                FROM public.usuarios
                INNER JOIN public.empleados USING(id_empleado)
                WHERE id_usuario = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    public function updateRow()
    {
        $sql = 'UPDATE public."tbUsuarios"
                SET nombre_usuario = ?, apellido_usuario = ?, email_usuario = ?,dui = ?, direccion = ?, tipo_usuario = ?, estado = ? 
                WHERE id_usuario = ?';
        $params = array($this->nombres, $this->apellidos, $this->correo, $this->dui. $this->direccion, $this->tipo, $this->estado, $this->id);
        return Database::executeRow($sql, $params);
    }

    public function deleteRow()
    {
        $sql = 'DELETE FROM public."tbUsuarios"
                WHERE id_usuario = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);
    }

    public function recuContra()
    {
        $hash = password_hash($this->clave, PASSWORD_DEFAULT);
        $sql = 'UPDATE usuarios
                SET contraseña = ?, primer_uso = ?
                WHERE usuario = ?';
        $params = array($hash, 2, $this->alias);
        return Database::executeRow($sql, $params);
    }

    public function readIntentos()
    {
        $sql = 'SELECT intentos FROM usuarios WHERE usuario = ?';
        $params = array($this->alias);
        if ($data = Database::getRow($sql, $params)) {
            $this->intentos = $data['intentos'];
            return true;
        } else {
            return false;
        }   
    }

    public function updateIntentos()
    {
        $sql = 'UPDATE usuarios 
                SET intentos = ?
                WHERE usuario = ?';
        $params = array($this->intentos, $this->alias);
        return Database::executeRow($sql, $params);
    }

    //Se ingresan a la base de datos la informacion del inicio de sesión
    public function registrarSesion($fecha, $plataforma, $id, $region, $zona)
    {
        $sql = 'INSERT INTO historial_usuarios(fecha_hora, plataforma, id_usuario, region, timezone)
                VALUES(?, ?, ?, ?, ?)';
        $params = array($fecha, $plataforma, $id, $region, $zona);
        return Database::executeRow($sql, $params);
    }

    //Funcion para obtener el registro de inicios de sesion de un usuario.
    public function readSesiones()
    {
        $sql = 'SELECT plataforma, fecha_hora, usuarios.usuario
                FROM historial_usuarios INNER JOIN usuarios USING(id_usuario)
                WHERE id_usuario = ?
                ORDER BY fecha_hora desc;';
        $params = array($_SESSION['id_usuario']);
        return Database::getRows($sql, $params);
    }

    //Se obtiene el sistema operativo que se esta usando para el inicio de sesión
    public function getPlatform($user_agent)
    {
        $plataformas = array(
            'Windows 10' => 'Windows NT 10.0+',
            'Windows 8.1' => 'Windows NT 6.3+',
            'Windows 8' => 'Windows NT 6.2+',
            'Windows 7' => 'Windows NT 6.1+',
            'Windows Vista' => 'Windows NT 6.0+',
            'Windows XP' => 'Windows NT 5.1+',
            'Windows 2003' => 'Windows NT 5.2+',
            'Windows' => 'Windows otros',
            'iPhone' => 'iPhone',
            'iPad' => 'iPad',
            'Mac OS X' => '(Mac OS X+)|(CFNetwork+)',
            'Mac otros' => 'Macintosh',
            'Android' => 'Android',
            'BlackBerry' => 'BlackBerry',
            'Linux' => 'Linux',
        );
        foreach ($plataformas as $plataforma => $pattern) {
            if (preg_match('/(?i)' . $pattern . '/', $user_agent))
                return $plataforma;
        }
        return 'Otras';
    }

    public function changePassw()
    {
        $hash = password_hash($this->clave, PASSWORD_DEFAULT);
        $sql = 'UPDATE usuarios SET contraseña = ? WHERE id_usuario = ?';
        $params = array($hash, $this->id);
        return Database::executeRow($sql, $params);
    }

    public function changeDate()
    {
        date_default_timezone_set('America/El_Salvador');
        $date = date('Y-m-d');
        $sql = 'UPDATE usuarios SET last_date = ? WHERE id_usuario = ?';
        $params = array($date, $this->id);
        return Database::executeRow($sql, $params);
    }

    public function checkAutn()
    {
        $sql = 'SELECT codigo_autn FROM usuarios                
                WHERE id_usuario = ?';
        $params = array($this->id);
        if ($data = Database::getRow($sql, $params)) {
            $this->codigo = $data['codigo_autn'];
            return true;
        } else {
            return false;
        }                
    }

    public function updateCode()
    {
        $sql = 'UPDATE usuarios
                SET codigo_autn = ?
                WHERE id_usuario = ?';
        $params = array($this->codigo, $this->id);
        return Database::executeRow($sql, $params);
    }

    function generarCodigo($longitud)
    {
        
        $caracteres = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "A" , "B" , "C" , "D", "E" , "F", "E" 
        , "G", "H" , "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");


        for ($i = 1; $i <= $longitud; $i++) {
            $this->codigo .= $caracteres[$this->numero_aleatorio(0, 36)];
        }

        return $this->codigo;
    }

    function numero_aleatorio($ninicial, $nfinal)
    {
        $numero = rand($ninicial, $nfinal);

        return $numero;
    }

    public function updateState()
    {        
        $sql = 'UPDATE usuarios
                SET estado = ?
                WHERE usuario = ?';
        $params = array($this->estado, $this->alias);
        return Database::executeRow($sql, $params);
    }

   
}
