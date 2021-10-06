<?php
/*
*	Clase para manejar la tabla productos de la base de datos. Es clase hija de Validator.
*/
class Permisos extends Validator
{
    // Declaración de atributos (propiedades).
    private $id = null;
    private $nombre = null;
    private $tipo = null;
    private $link = null;
    private $permiso = null;
    private $idtipo = null;
    private $idpagina = null;
    private $idpermiso = null;

    /*
    *   Métodos para asignar valores a los atributos.
    */

    //Permite validar el ID del Producto
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

    public function setIdTipo($value)
    {
        //Se valida que el campo sea un número natural
        if ($this->validateNaturalNumber($value)) {
            //Se guarda el dato
            $this->idtipo = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setIdPagina($value)
    {
        //Se valida que el campo sea un número natural
        if ($this->validateNaturalNumber($value)) {
            //Se guarda el dato
            $this->idpagina = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setIdPermiso($value)
    {
        //Se valida que el campo sea un número natural
        if ($this->validateNaturalNumber($value)) {
            //Se guarda el dato
            $this->idpermiso = $value;
            return true;
        } else {
            return false;
        }
    }

    //Permite validar la Descripción del Producto
    public function setNombre($value)
    {
        //Se valida que el campo sea un String(letras, números y símbolos)
        if ($this->validateString($value, 1, 500)) {
            //Se guarda el dato
            $this->nombre = $value;
            return true;
        } else {
            return false;
        }
    }

    //Permite validar la Descripción del Producto
    public function setTipo($value)
    {
        //Se valida que el campo sea un String(letras, números y símbolos)
        if ($this->validateString($value, 1, 500)) {
            //Se guarda el dato
            $this->tipo = $value;
            return true;
        } else {
            return false;
        }
    }

    //Permite validar la Descripción del Producto
    public function setLink($value)
    {
        //Se valida que el campo sea un String(letras, números y símbolos)
        if ($this->validateString($value, 1, 500)) {
            //Se guarda el dato
            $this->link = $value;
            return true;
        } else {
            return false;
        }
    }

    //Permite validar la Descripción del Producto
    public function setPermiso($value)
    {
        //Se valida que el campo sea un String(letras, números y símbolos)
        if ($this->validateString($value, 1, 500)) {
            //Se guarda el dato
            $this->permiso = $value;
            return true;
        } else {
            return false;
        }
    }

    /*
    *   Métodos para obtener valores de los atributos.
    */

    //Se obtiene el Id del Producto
    public function getId()
    {
        //Se retorna el dato
        return $this->id;
    }

    //Se obtiene el Nombre del Producto
    public function getIdTipo()
    {
        //Se retorna el dato
        return $this->idtipo;
    }

    //Se obtiene la Descripción del Producto
    public function getIdPagina()
    {
        //Se retorna el dato
        return $this->idpagina;
    }

    //Se obtiene el Precio del Producto
    public function getIdPermiso()
    {
        //Se retorna el dato
        return $this->idpermiso;
    }

    //Se obtiene la Cantidad del Producto
    public function getNombre()
    {
        //Se retorna el dato
        return $this->nombre;
    }

    //Se obtiene la Marca del Producto
    public function getLink()
    {
        //Se retorna el dato
        return $this->link;
    }

    //Se obtiene la Imagen del Poducto
    public function getPermiso()
    {
        //Se retorna el dato
        return $this->permiso;
    }

    //Se obtiene el Tipo del Producto
    public function getTipo()
    {
        //Se retorna el dato
        return $this->tipo;
    }

    /*
    *   Métodos para realizar las operaciones SCRUD (search, create, read, update, delete).
    */


    //Buscar
    public function searchRows($value)
    {
        //Se guarda la consulta sql
        $sql = 'SELECT id_acceso, id_tipo_usuario, tipo_usuario,id_pagina, nombre,id_permiso, permiso
        FROM public.accesos
            INNER JOIN public.tipo_usuario USING(id_tipo_usuario) 
            INNER JOIN public.paginas USING(id_pagina) 
            INNER JOIN public.permisos USING(id_permiso)
                where tipo_usuario = ? OR nombre = ? OR permiso = ?
                ORDER BY tipo_usuario';
        //Se guarda un array con los parametros de la consulta
        $params = array("%$value%", "%$value%", "%$value%");
        //Se retorna la ejecución del método "getRow"
        return Database::getRows($sql, $params);
    }
    
    //Crear Producto
    public function createRow()
    {
        //Se guarda la consulta sql
        $sql = 'INSERT INTO public.accesos(id_tipo_usuario, id_pagina, id_permiso)
            VALUES ( ?, ?, ?)';
        //Se guarda un array con los parametros de la consulta
        $params = array($this->idtipo,$this->idpagina,$this->idpermiso);
        //Se retorna la ejecución del método "executeRow"
        return Database::executeRow($sql, $params);
    }

    //Ver todos los productos
    public function readAll()
    {
        //Se guarda la consulta sql
        $sql = 'SELECT id_acceso, tipo_usuario, nombre, permiso
        FROM public.accesos
            INNER JOIN public.tipo_usuario USING(id_tipo_usuario) 
            INNER JOIN public.paginas USING(id_pagina) 
            INNER JOIN public.permisos USING(id_permiso)
                order by id_tipo_usuario';
        //Se guarda un array con los parametros de la consulta(vacío)
        $params = null;
        //Se retorna la ejecución del método "getRow"
        return Database::getRows($sql, $params);
    }

    //Ver todos los productos
    public function readAllReport()
    {
        //Se guarda la consulta sql
        $sql = 'SELECT public.inventario.nombre as nombre_producto, precio, public.inventario.descripcion, stock, autor, public.proveedor.nombre as proveedor, tipo_producto, nombre_marca
        FROM public.inventario
            INNER JOIN public.tipo_producto USING(id_tipo_producto) 
            INNER JOIN public.proveedor USING(id_proveedor) 
            INNER JOIN public.marca USING(id_marca) 
            ORDER BY public.inventario.nombre';
        //Se guarda un array con los parametros de la consulta(vacío)
        $params = null;
        //Se retorna la ejecución del método "getRow"
        return Database::getRows($sql, $params);
    }

    //Ver todos los Proveedores
    public function readTipos()
    {
        $r = 'Root';
        //Se guarda la consulta sql
        $sql = 'SELECT id_tipo_usuario, tipo_usuario
        FROM public.tipo_usuario
        where tipo_usuario != ? order by id_tipo_usuario';
        //Se guarda un array con los parametros de la consulta(vacío)
        $params = array($r);
        //Se retorna la ejecución del método "getRow"
        return Database::getRows($sql, $params);
    }

    //Ver todos los Tipos de productos
    public function readPaginas()
    {
        //Se guarda la consulta sql
        $sql = 'SELECT id_pagina, nombre, link
        FROM public.paginas';
        //Se guarda un array con los parametros de la consulta(vacío)
        $params = null;
        return Database::getRows($sql, $params);
    }
    
    //Ver todas las Marcas
    public function readPermisos()
    {
        //Se guarda la consulta sql
        $sql = 'SELECT id_permiso, permiso
        FROM public.permisos';
        //Se guarda un array con los parametros de la consulta(vacío)
        $params = null;
        //Se retorna la ejecución del método "getRow"
        return Database::getRows($sql, $params);
    }

    //Leer solo un producto
    public function readOne()
    {
        //Se guarda la consulta sql
        $sql = 'SELECT id_acceso, id_tipo_usuario, tipo_usuario,id_pagina, nombre,id_permiso, permiso
        FROM public.accesos
            INNER JOIN public.tipo_usuario USING(id_tipo_usuario) 
            INNER JOIN public.paginas USING(id_pagina) 
            INNER JOIN public.permisos USING(id_permiso)
                where id_acceso= ?';
        //Se guarda un array con los parametros de la consulta
        $params = array($this->id);
        //Se retorna la ejecución del método "getRow"
        return Database::getRow($sql, $params);
    }

    //Leer solo un producto
    public function readExistPage()
    {
        //Se guarda la consulta sql
        $sql = 'SELECT id_acceso, id_tipo_usuario, tipo_usuario,id_pagina, nombre,id_permiso, permiso
        FROM public.accesos
            INNER JOIN public.tipo_usuario USING(id_tipo_usuario) 
            INNER JOIN public.paginas USING(id_pagina) 
            INNER JOIN public.permisos USING(id_permiso)
                WHERE id_tipo_usuario = ? AND id_pagina = ?';
        //Se guarda un array con los parametros de la consulta
        $params = array($this->idtipo, $this->idpagina);
        //Se retorna la ejecución del método "getRow"
        return Database::getRow($sql, $params);
    }

    //Leer solo un producto
    public function readExistPageU()
    {
        //Se guarda la consulta sql
        $sql = 'SELECT id_acceso, id_tipo_usuario, tipo_usuario,id_pagina, nombre,id_permiso, permiso
        FROM public.accesos
            INNER JOIN public.tipo_usuario USING(id_tipo_usuario) 
            INNER JOIN public.paginas USING(id_pagina) 
            INNER JOIN public.permisos USING(id_permiso)
                WHERE id_tipo_usuario = ? AND id_pagina = ? AND id_acceso != ?';
        //Se guarda un array con los parametros de la consulta
        $params = array($this->idtipo, $this->idpagina, $this->id);
        //Se retorna la ejecución del método "getRow"
        return Database::getRow($sql, $params);
    }

    //Leer solo un producto
    public function readExist()
    {
        //Se guarda la consulta sql
        $sql = 'SELECT id_acceso, id_tipo_usuario, tipo_usuario,id_pagina, nombre,id_permiso, permiso
        FROM public.accesos
            INNER JOIN public.tipo_usuario USING(id_tipo_usuario) 
            INNER JOIN public.paginas USING(id_pagina) 
            INNER JOIN public.permisos USING(id_permiso)
                WHERE id_tipo_usuario = ? AND id_pagina = ? and id_permiso = ?';
        //Se guarda un array con los parametros de la consulta
        $params = array($this->idtipo, $this->idpagina, $this->idpermiso);
        //Se retorna la ejecución del método "getRow"
        return Database::getRow($sql, $params);
    }

    //Actualizar producto
    public function updateRow()
    {
        //Se guarda la consulta sql
        $sql = 'UPDATE public.accesos
            SET id_tipo_usuario=?, id_pagina=?, id_permiso=?
            WHERE id_acceso=?';
        //Se guarda un array con los parametros de la consulta
        $params = array($this->idtipo, $this->idpagina, $this->idpermiso, $this->id);
        //Se retorna la ejecución del método "executeRow"
        return Database::executeRow($sql, $params);
    }

    //Borrar Producto
    public function deleteRow()
    {
        //Se guarda la consulta sql
        $sql = 'DELETE FROM public.accesos
                WHERE id_acceso=?';
        //Se guarda un array con los parametros de la consulta
        $params = array($this->id);
        //Se retorna la ejecución del método "executeRow"
        return Database::executeRow($sql, $params);
    }
}
