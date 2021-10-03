<?php
/*
*	Clase para manejar la tabla usuarios de la base de datos. Es clase hija de Validator.
*/
class Perfil extends Validator
{
    // Declaración de atributos (propiedades).
    private $id = null;
    private $nombre = null;
    private $apellido = null;
    private $correo = null;
    private $tel= null;
    private $fecha = null;
    private $gen = null;
    private $alias = null;
    private $clave = null;
    private $ide = null;
    private $primer_uso = null;
    private $estado = null;
    private $imagen = null;
    private $ruta = '../../resources/img/empleados/';
    private $anio = null;
    private $autenticacion = null;

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

    public function setAutenticacion($value)
    {
        if ($this->validateBoolean($value)) {
            $this->autenticacion = $value;
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

    public function setImagen($file)
    {
        if ($this->validateImageFile($file, 500, 500)) {
            $this->imagen = $this->getImageName();
            return true;
        } else {
            return false;
        }
    }

    public function setIde($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->ide = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setIdt($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->idt = $value;
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

    public function setAlias($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->alias = $value;
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

    public function setClave($value)
    {
        if ($this->validatePass($value)) {
            $this->clave = $value;
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

    public function getIde()
    {
        return $this->ide;
    }

    public function getIdt()
    {
        return $this->idt;
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

    public function getPrimer_uso()
    {
        return $this->primer_uso;
    }


    public function getTel()
    {
        return $this->tel;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function getGen()
    {
        return $this->gen;
    }

    public function getAlias()
    {
        return $this->alias;
    }
    public function getImagen()
    {
        return $this->imagen;
    }

    public function getAuten()
    {
        return $this->autenticacion;
    }

    public function getClave()
    {
        return $this->clave;
    }

    public function getRuta()
    {
        return $this->ruta;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    /*
    *   Métodos para gestionar la cuenta del usuario.
    */
    public function checkUser($alias)
    {
        $this->estado = "activo";
        $sql = 'SELECT id_usuario FROM usuarios WHERE usuario = ? and estado = ? ';
        $params = array($alias, $this->estado);
        if ($data = Database::getRow($sql, $params)) {
            $this->id = $data['id_usuario'];
            $this->alias = $alias;
            return true;
        } else {
            return false;
        }
    }

    public function checkPassword($password)
    {
        $sql = 'SELECT contraseña FROM usuarios WHERE id_usuario = ?';
        $params = array($this->id);
        $data = Database::getRow($sql, $params);
        if (password_verify($password, $data['contraseña'])) {
            return true;
        } else {
            return false;
        }
    }

    public function changePassword()
    {
        $hash = password_hash($this->clave, PASSWORD_DEFAULT);
        $sql = 'UPDATE usuarios SET clave_usuario = ? WHERE id_usuario = ?';
        $params = array($hash, $_SESSION['id_usuario']);
        return Database::executeRow($sql, $params);
    }

    public function changePass()
    {
        $primer_uso = 2;
        $hash = password_hash($this->clave, PASSWORD_DEFAULT);
        $sql = 'UPDATE usuarios SET contraseña = ?, primer_uso = ? WHERE id_usuario = ?';
        $params = array($hash, $primer_uso, $this->id);
        return Database::executeRow($sql, $params);
    }

    public function readProfile()
    {
        $sql = 'SELECT id_usuario, nombres_usuario, apellidos_usuario, correo_usuario, alias_usuario
                FROM usuarios
                WHERE id_usuario = ?';
        $params = array($_SESSION['id_usuario']);
        return Database::getRow($sql, $params);
    }

    public function editProfile()
    {
        $sql = 'UPDATE usuarios
                SET nombres_usuario = ?, apellidos_usuario = ?, correo_usuario = ?, alias_usuario = ?
                WHERE id_usuario = ?';
        $params = array($this->nombres, $this->apellidos, $this->correo, $this->alias, $_SESSION['id_usuario']);
        return Database::executeRow($sql, $params);
    }

    /*
    *   Métodos para realizar las operaciones SCRUD (search, create, read, update, delete).
    */
    public function searchRows($value)
    {
        $sql = 'SELECT id_empleado, nombre, apellido, correo, telefono, estado, genero, estado, imagen
                FROM empleados
                WHERE nombre ILIKE ? and id_empleado <> (Select MIN(id_empleado)from empleados)';
        $params = array("%$value%");
        return Database::getRows($sql, $params);
    }

    public function createRow1()
    {
        // Se encripta la clave por medio del algoritmo bcrypt que genera un string de 60 caracteres.
        $hash = password_hash($this->clave, PASSWORD_DEFAULT);
        $sql = 'INSERT INTO usuarios(nombres_usuario, apellidos_usuario, correo_usuario, alias_usuario, clave_usuario)
                VALUES(?, ?, ?, ?, ?)';
        $params = array($this->nombres, $this->apellidos, $this->correo, $this->alias, $hash);
        return Database::executeRow($sql, $params);
    }

    public function firstUser()
    {   
        $this->primer_uso = 0;
        // Se encripta la clave por medio del algoritmo bcrypt que genera un string de 60 caracteres.
        $hash = password_hash($this->clave, PASSWORD_DEFAULT);
        $this->idt = 1;
        $sql = 'INSERT INTO usuarios(usuario, contraseña, id_empleado, id_tipo_usuario, primer_uso)
                VALUES(?,?,?,?,?)';
        $params = array($this->alias, $hash, $this->ide, $this->idt, $this->primer_uso);
        return Database::executeRow($sql, $params);
    }

    public function primerUso()
    {
        $sql = 'SELECT primer_uso FROM usuarios
                WHERE id_usuario = ?';
        $params = array($this->id);
        if ($data = Database::getRow($sql, $params)) {
            $this->primer_uso = $data['primer_uso'];
            return true;
        } else {
            return false;
        }                
    }

    public function createRow()
    {
        $sql = 'INSERT INTO empleados(imagen, nombre, apellido, correo, telefono, fecha_nac, genero, estado)
                VALUES(?, ?, ?, ?, ?, ?, ?, ?)';
        $params = array($this->imagen, $this->nombre, $this->apellido, $this->correo, $this->tel, $this->fecha, $this->gen, $this->estado);
        if ($this->ide = Database::getLastRow($sql, $params)) {
            return true;
        } else {
            return false;
        }
    }

    public function createFirstEmp()
    {
        $this->estado = "activo";
        $sql = 'INSERT INTO empleados(imagen, nombre, apellido, correo, telefono, fecha_nac, genero, estado)
                VALUES(?, ?, ?, ?, ?, ?, ?, ?)';
        $params = array($this->imagen, $this->nombre, $this->apellido, $this->correo, $this->tel, $this->fecha, $this->gen, $this->estado);
        if ($this->ide = Database::getLastRow($sql, $params)) {
            return true;
        } else {
            return false;
        }
    }

    //Función para cargar a los empleados sin tener en cuenta el empleado root o 
    public function readAll2()
    {
        $sql = 'SELECT id_empleado, nombre, apellido, correo, telefono, genero, estado, imagen
                FROM empleados
                where id_empleado <> (Select MIN(id_empleado)from empleados)';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readAll()
    {
        $sql = 'SELECT id_empleado, nombre, apellido, correo, telefono, genero, estado, imagen
                FROM empleados';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readOne()
    {
        $sql = 'SELECT id_empleado, nombre, apellido, correo, estado, telefono, fecha_nac, genero, imagen
                FROM empleados
                WHERE id_empleado = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    public function readOneuser()
    {
        $sql = 'SELECT nombre, apellido, correo, telefono, imagen, usuarios.id_usuario, usuario
                FROM usuarios INNER JOIN empleados ON usuarios.id_empleado = empleados.id_empleado
                WHERE usuarios.id_usuario = ?';
        $params = array($_SESSION['id_usuario']);
        return Database::getRow($sql, $params);
    }

    public function readOne1()
    {
        $sql = "SELECT usuarios.id_usuario as emp, usuarios.id_empleado as empleado, nombre, apellido, imagen, CONCAT('@',usuario) as ider, CONCAT('¡BIENVENID@!', ' ', nombre, ' ', apellido) as usuario
                FROM usuarios INNER JOIN empleados ON usuarios.id_empleado = empleados.id_empleado
                WHERE usuarios.id_usuario = ?";
        $params = array($_SESSION['id_usuario']);
        return Database::getRows($sql, $params);
    }

    public function readEmfileds()
    {
        $sql = 'SELECT usuarios.id_empleado as emp, nombre, apellido, correo, telefono, imagen, usuarios.id_usuario, usuario, autenticacion
                FROM usuarios INNER JOIN empleados ON usuarios.id_empleado = empleados.id_empleado
                WHERE usuarios.id_usuario = ?';
        $params = array($_SESSION['id_usuario']);
        return Database::getRow($sql, $params);
    }

    public function updateRow($current_image)
    {
        // Se verifica si existe una nueva imagen para borrar la actual, de lo contrario se mantiene la actual.
        ($this->imagen) ? $this->deleteFile($this->getRuta(), $current_image) : $this->imagen = $current_image;

        $sql = 'UPDATE empleados 
                SET nombre = ?, apellido = ?, correo = ?, telefono = ?, estado = ?, fecha_nac = ?, genero = ?, imagen = ?
                WHERE id_empleado= ?';
        $params = array($this->nombre, $this->apellido, $this->correo, $this->tel, $this->estado, $this->fecha, $this->gen, $this->imagen, $this->id);
        return Database::executeRow($sql, $params);
    }

    public function deleteRow()
    {
        $sql = 'DELETE FROM empleados
                WHERE id_empleado = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);
    }

    public function updateRowProfile($current_image)
    {
        // Se verifica si existe una nueva imagen para borrar la actual, de lo contrario se mantiene la actual.
        ($this->imagen) ? $this->deleteFile($this->getRuta(), $current_image) : $this->imagen = $current_image;
        $sql = 'UPDATE empleados 
                SET nombre = ?, apellido = ?, correo = ?, telefono = ?, imagen = ?
                WHERE id_empleado = ?';
        $params = array($this->nombre, $this->apellido, $this->correo, $this->tel, $this->imagen, $this->id);
        return Database::executeRow($sql, $params);
    }

    public function updateUserCredentials()
    {
        // Se encripta la clave por medio del algoritmo bcrypt que genera un string de 60 caracteres.
        $hash = password_hash($this->clave, PASSWORD_DEFAULT);
        $sql = 'UPDATE usuarios 
                SET usuario = ?, contraseña = ?, autenticacion = ?
                WHERE id_usuario = ?';
        $params = array($this->alias, $hash, $this->autenticacion, $this->id);
        return Database::executeRow($sql, $params);
    }

    public function updateUserCredentials2()
    {
        $sql = 'UPDATE usuarios 
                SET usuario = ?, autenticacion = ?
                WHERE id_usuario = ?';
        $params = array($this->alias, $this->autenticacion, $this->id);
        return Database::executeRow($sql, $params);
    }

     /*
    *   Métodos para gestionar las consultas de las gráficas.
    */

    //Método para obtener el listado de los 5 productos que más se
    //tienen en stock
    public function cantidadProductoStockMax()
    {
        $sql = 'SELECT nombre, stock
                FROM inventario
                GROUP BY nombre, stock ORDER BY stock DESC
                FETCH FIRST 5 ROWS ONLY';
        $params = null;
        return Database::getRows($sql, $params);
    }

    //Método para obtener el listado de las 5 fechas que más se
    //han realizado ventas
    public function topVentaCantidad()
    {
        $sql = 'SELECT fecha, count(id_factura) as cantidad
                FROM factura INNER JOIN detalle_compra USING(id_factura)
                GROUP BY fecha ORDER BY cantidad DESC
                FETCH FIRST 5 ROWS ONLY';
        $params = null;
        return Database::getRows($sql, $params);
    }

    //Método para obtener la fechas con las cantidad de ventas realizadas por el usuario
    public function firstOption()
    {
        $sql = 'SELECT fecha, count(id_factura) cantidad
                FROM factura INNER JOIN usuarios USING(id_usuario)
                WHERE id_usuario = ?
                GROUP BY fecha ORDER BY cantidad DESC';
        $params = array($_SESSION['id_usuario']);
        return Database::getRows($sql, $params);
    }

    // Método para mostrar en gráfica lineal el dinero que se 
    //recaudó en cada venta en la que el usuario estuvo presente
    public function secondOption()
    {
        $sql = 'SELECT DISTINCT fecha, Sum(detalle_compra.precio*detalle_compra.cantidad) as total
                FROM factura INNER JOIN detalle_compra USING(id_factura) INNER JOIN usuarios USING(id_usuario)
                WHERE id_usuario = ?
                GROUP BY fecha ORDER BY fecha DESC';
        $params = array($_SESSION['id_usuario']);
        return Database::getRows($sql, $params);
    }

    //Método para mostrar en gráfica lineal las 5 marcas que cuentan con mayor producto
    public function MarcasconmasProductos()
    {
        $sql = 'SELECT nombre_marca as Marca, count(id_inventario) Cantidad
        FROM inventario INNER JOIN marca USING(id_marca)
        GROUP BY Marca ORDER BY Cantidad DESC
        LIMIT 5 OFFSET 0';
        $params = null;
        return Database::getRows($sql, $params);
    }

    //Método para mostrar en gráfica polar los 5 productos más vendidos
    public function ProducosMasVendidos()
    {
        $sql = 'SELECT nombre, sum(detalle_compra.cantidad) total
                FROM detalle_compra INNER JOIN inventario USING(id_inventario)
                GROUP BY nombre ORDER BY total desc limit 5';
        $params = null;
        return Database::getRows($sql, $params);
    }

    // Método para mostrar en gráfica de barras las cantidad de ventas totales de todo el año
    //Se ordenan por mes
    public function TotalVentasEnAnio()
    {   $this->anio = '2021';
        $this->estado = 'Finalizado';
        $sql = "SELECT to_char(factura.fecha, 'Month') AS mes,
                COUNT(id_factura) venta
                FROM factura 
                WHERE EXTRACT(YEAR FROM factura.fecha) = ? AND estado= ?
                GROUP BY mes";
        $params = array($this->anio, $this->estado);
        return Database::getRows($sql, $params);
    }

    // Método para mostrar en gráfica tipo pie los 5 productos más vendidos con más frecuencia
    public function ProducosMasVendidosFrecuencia()
    {
        $sql = 'SELECT nombre, count(detalle_compra.id_inventario) total
                FROM detalle_compra INNER JOIN inventario USING(id_inventario)
                GROUP BY nombre ORDER BY total desc limit 5';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function changeDate()
    {
        date_default_timezone_set('America/El_Salvador');
        $date = date('Y-m-d');
        $sql = 'UPDATE usuarios SET last_date = ? WHERE id_usuario = ?';
        $params = array($date, $this->id);
        return Database::executeRow($sql, $params);
    }

}
