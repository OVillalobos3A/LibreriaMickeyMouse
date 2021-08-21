<?php
/*
*	Clase para manejar la tabla productos de la base de datos. Es clase hija de Validator.
*/
class Productos extends Validator
{
    // Declaración de atributos (propiedades).
    private $id = null;
    private $nombre = null;
    private $descripcion = null;
    private $precio = null;
    private $cantidad = null;
    private $marca = null;
    private $autor = null;
    private $imagen = null;
    private $tipo = null;
    private $proveedor = null;
    private $foto = null;
    private $ruta = '../../resources/img/productos/';

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

    //Permite validar el Nombre del Producto
    public function setNombre($value)
    {
        //Se valida que el campo sea un alfanúmerico(números y letras)
        if ($this->validateAlphanumeric($value, 1, 50)) {
            //Se guarda el dato
            $this->nombre = $value;
            return true;
        } else {
            return false;
        }
    }

    //Permite validar la Descripción del Producto
    public function setDescripcion($value)
    {
        //Se valida que el campo sea un String(letras, números y símbolos)
        if ($this->validateString($value, 1, 500)) {
            //Se guarda el dato
            $this->descripcion = $value;
            return true;
        } else {
            return false;
        }
    }

    //Permite validar el Precio del Producto
    public function setPrecio($value)
    {
        //Se valida que el campo tenga el formato de dinero
        if ($this->validateMoney($value)) {
            $this->precio = $value;
            return true;
        } else {
            return false;
        }
    }

    //Permite validar la Cantidad del Producto
    public function setCantidad($value)
    {
        //Se valida que sea un número natural
        if ($this->validateNaturalNumber($value)) {
            //Se guarda el dato
            $this->cantidad = $value;
            return true;
        } else {
            return false;
        }
    }

    //Permite validar la Marca del Producto
    public function setMarca($value)
    {
        //Se valida que el campo sea un número natural
        if ($this->validateNaturalNumber($value)) {
            //Se guarda el dato
            $this->marca = $value;
            return true;
        } else {
            return false;
        }
    }

    //Permite validar el Autor del Producto
    public function setAutor($value)
    {
        //Se valida que el campo sea un alfanumérico(números y letras)
        if ($this->validateAlphanumeric($value, 0, 50)) {
            //Se guarda el dato
            $this->autor = $value;
            return true;
        } else {
            return false;
        }
    }

    //Permite validar la Imagen del Producto
    public function setImagen($file)
    {
        //Se valida que el archivo tenga las dimenisiones indicadas
        if ($this->validateImageFile($file, 500, 500)) {
            //Se guarda el dato
            $this->foto = $this->getImageName();
            return true;
        } else {
            return false;
        }
    }

    //Permite validar el Tipo del Producto
    public function setTipo($value)
    {
        //Se valida que el campo sea un número natural
        if ($this->validateNaturalNumber($value)) {
            //Se guarda el dato
            $this->tipo = $value;
            return true;
        } else {
            return false;
        }
    }

    //Permite validar el Proveedor del Producto
    public function setProveedor($value)
    {
        //Se valida que el campo sea un número natural
        if ($this->validateNaturalNumber($value)) {
            //Se guarda el dato
            $this->proveedor = $value;
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
    public function getNombre()
    {
        //Se retorna el dato
        return $this->nombre;
    }

    //Se obtiene la Descripción del Producto
    public function getDescripcion()
    {
        //Se retorna el dato
        return $this->descripcion;
    }

    //Se obtiene el Precio del Producto
    public function getPrecio()
    {
        //Se retorna el dato
        return $this->precio;
    }

    //Se obtiene la Cantidad del Producto
    public function getCantidad()
    {
        //Se retorna el dato
        return $this->cantidad;
    }

    //Se obtiene la Marca del Producto
    public function getMarca()
    {
        //Se retorna el dato
        return $this->marca;
    }

    //Se obtiene la Imagen del Poducto
    public function getImagen()
    {
        //Se retorna el dato
        return $this->foto;
    }

    //Se obtiene el Tipo del Producto
    public function getTipo()
    {
        //Se retorna el dato
        return $this->tipo;
    }

    //Se obtiene el Estado del Producto
    public function getEstado()
    {
        //Se retorna el dato
        return $this->estado;
    }

    //Se obtiene la ruta de la Imagen
    public function getRuta()
    {
        //Se retorna el dato
        return $this->ruta;
    }

    /*
    *   Métodos para realizar las operaciones SCRUD (search, create, read, update, delete).
    */


    //Buscar
    public function searchRows($value)
    {
        //Se guarda la consulta sql
        $sql = 'SELECT id_inventario, public.inventario.nombre as nombre_producto, precio, public.inventario.descripcion, descuento, stock, autor, imagen, public.proveedor.nombre, tipo_producto, nombre_marca
        FROM public.inventario
            INNER JOIN public.tipo_producto USING(id_tipo_producto) 
            INNER JOIN public.proveedor USING(id_proveedor) 
            INNER JOIN public.marca USING(id_marca)
                WHERE public.inventario.nombre ILIKE ? OR public.inventario.descripcion ILIKE ? OR autor ILIKE ? OR tipo_producto ILIKE ? OR  nombre_marca ILIKE ?
                ORDER BY nombre_producto';
        //Se guarda un array con los parametros de la consulta
        $params = array("%$value%", "%$value%", "%$value%", "%$value%", "%$value%");
        //Se retorna la ejecución del método "getRow"
        return Database::getRows($sql, $params);
    }
    
    //Crear Producto
    public function createRow()
    {
        //Se guarda la consulta sql
        $sql = 'INSERT INTO public.inventario( nombre, precio, descripcion, stock, autor, imagen, id_proveedor, id_tipo_producto, id_marca)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';
        //Se guarda un array con los parametros de la consulta
        $params = array($this->nombre, $this->precio, $this->descripcion, $this->cantidad, $this->autor, $this->foto, $this->proveedor, $this->tipo, $this->marca);
        //Se retorna la ejecución del método "executeRow"
        return Database::executeRow($sql, $params);
    }

    //Ver todos los productos
    public function readAll()
    {
        //Se guarda la consulta sql
        $sql = 'SELECT id_inventario, public.inventario.nombre as nombre_producto, precio, public.inventario.descripcion, descuento, stock, autor, imagen, public.proveedor.nombre, tipo_producto, nombre_marca
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
    public function readProvs()
    {
        //Se guarda la consulta sql
        $sql = 'SELECT id_proveedor, nombre
        FROM public.proveedor
                ORDER BY nombre';
        //Se guarda un array con los parametros de la consulta(vacío)
        $params = null;
        //Se retorna la ejecución del método "getRow"
        return Database::getRows($sql, $params);
    }

    //Ver todos los Tipos de productos
    public function readTypes()
    {
        //Se guarda la consulta sql
        $sql = 'SELECT id_tipo_producto, tipo_producto
        FROM public.tipo_producto
                ORDER BY tipo_producto';
        //Se guarda un array con los parametros de la consulta(vacío)
        $params = null;
        return Database::getRows($sql, $params);
    }
    
    //Ver todas las Marcas
    public function readBrands()
    {
        //Se guarda la consulta sql
        $sql = 'SELECT id_marca, nombre_marca
        FROM public.marca
                ORDER BY nombre_marca';
        //Se guarda un array con los parametros de la consulta(vacío)
        $params = null;
        //Se retorna la ejecución del método "getRow"
        return Database::getRows($sql, $params);
    }

    //Leer solo un producto
    public function readOne()
    {
        //Se guarda la consulta sql
        $sql = 'SELECT id_inventario, public.inventario.nombre as nombre_producto, precio, public.inventario.descripcion as descripcion, descuento, stock, autor, imagen,id_proveedor, public.proveedor.nombre as proveedor, id_tipo_producto, tipo_producto,id_marca, nombre_marca
        FROM public.inventario
            INNER JOIN public.tipo_producto USING(id_tipo_producto) 
            INNER JOIN public.proveedor USING(id_proveedor) 
            INNER JOIN public.marca USING(id_marca)
                WHERE  id_inventario = ?';
        //Se guarda un array con los parametros de la consulta
        $params = array($this->id);
        //Se retorna la ejecución del método "getRow"
        return Database::getRow($sql, $params);
    }

    //Actualizar producto
    public function updateRow($current_image)
    {
        // Se verifica si existe una nueva imagen para borrar la actual, de lo contrario se mantiene la actual.
        if ($this->foto) {
            //Se elimina el archivo actual
            $this->deleteFile($this->getRuta(), $current_image);
        } else {
            //Se setea la variable foto con la imagen actual del Producto
            $this->foto = $current_image;
        }
        //Se guarda la consulta sql
        $sql = 'UPDATE public.inventario
                SET nombre=?, precio=?, descripcion=?, autor=?, imagen=?, id_proveedor=?, id_tipo_producto=?, id_marca=?
                WHERE id_inventario=?';
        //Se guarda un array con los parametros de la consulta
        $params = array($this->nombre, $this->precio, $this->descripcion, $this->autor, $this->foto, $this->proveedor, $this->tipo, $this->marca, $this->id);
        //Se retorna la ejecución del método "executeRow"
        return Database::executeRow($sql, $params);
    }

    //Borrar Producto
    public function deleteRow()
    {
        //Se guarda la consulta sql
        $sql = 'DELETE FROM public.inventario
                WHERE id_inventario=?';
        //Se guarda un array con los parametros de la consulta
        $params = array($this->id);
        //Se retorna la ejecución del método "executeRow"
        return Database::executeRow($sql, $params);
    }
}
