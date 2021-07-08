<?php
/*
*	Clase para manejar la tabla productos de la base de datos. Es clase hija de Validator.
*/
class Productos extends Validator
{
    // Declaración de atributos (propiedades).
    private $id = null;
    private $cliente = null;
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
    public function setId($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->id = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setCliente($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->cliente = $value;
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

    public function setDescripcion($value)
    {
        if ($this->validateString($value, 1, 500)) {
            $this->descripcion = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setPrecio($value)
    {
        if ($this->validateMoney($value)) {
            $this->precio = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setCantidad($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->cantidad = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setMarca($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->marca = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setAutor($value)
    {
        if ($this->validateAlphanumeric($value, 0, 50)) {
            $this->autor = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setImagen($file)
    {
        if ($this->validateImageFile($file, 500, 500)) {
            $this->foto = $this->getImageName();
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

    public function setProveedor($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->proveedor = $value;
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

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    public function getCantidad()
    {
        return $this->cantidad;
    }

    public function getMarca()
    {
        return $this->marca;
    }

    public function getDescuento()
    {
        return $this->descuento;
    }

    public function getImagen()
    {
        return $this->foto;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function getRuta()
    {
        return $this->ruta;
    }

    /*
    *   Métodos para realizar las operaciones SCRUD (search, create, read, update, delete).
    */


    //Buscar
    public function searchRows($value)
    {
        $sql = 'SELECT id_inventario, public.inventario.nombre as nombre_producto, precio, public.inventario.descripcion, descuento, stock, autor, imagen, public.proveedor.nombre, tipo_producto, nombre_marca
        FROM public.inventario
            INNER JOIN public.tipo_producto USING(id_tipo_producto) 
            INNER JOIN public.proveedor USING(id_proveedor) 
            INNER JOIN public.marca USING(id_marca)
                WHERE public.inventario.nombre ILIKE ? OR public.inventario.descripcion ILIKE ? OR autor ILIKE ? OR tipo_producto ILIKE ? OR  nombre_marca ILIKE ?
                ORDER BY nombre_producto';
        $params = array("%$value%", "%$value%", "%$value%", "%$value%", "%$value%");
        return Database::getRows($sql, $params);
    }
    
    //Crear Producto
    public function createRow()
    {
        $sql = 'INSERT INTO public.inventario( nombre, precio, descripcion, stock, autor, imagen, id_proveedor, id_tipo_producto, id_marca)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';
        $params = array($this->nombre, $this->precio, $this->descripcion, $this->cantidad, $this->autor, $this->foto, $this->proveedor, $this->tipo, $this->marca);
        return Database::executeRow($sql, $params);
    }

    //Ver todos los productos
    public function readAll()
    {
        $sql = 'SELECT id_inventario, public.inventario.nombre as nombre_producto, precio, public.inventario.descripcion, descuento, stock, autor, imagen, public.proveedor.nombre, tipo_producto, nombre_marca
        FROM public.inventario
            INNER JOIN public.tipo_producto USING(id_tipo_producto) 
            INNER JOIN public.proveedor USING(id_proveedor) 
            INNER JOIN public.marca USING(id_marca) 
            ORDER BY public.inventario.nombre';
        $params = null;
        return Database::getRows($sql, $params);
    }

    //Ver todos los Proveedores
    public function readProvs()
    {
        $sql = 'SELECT id_proveedor, nombre
        FROM public.proveedor
                ORDER BY nombre';
        $params = null;
        return Database::getRows($sql, $params);
    }

    //Ver todos los Tipos de productos
    public function readTypes()
    {
        $sql = 'SELECT id_tipo_producto, tipo_producto
        FROM public.tipo_producto
                ORDER BY tipo_producto';
        $params = null;
        return Database::getRows($sql, $params);
    }
    
    //Ver todas las Marcas
    public function readBrands()
    {
        $sql = 'SELECT id_marca, nombre_marca
        FROM public.marca
                ORDER BY nombre_marca';
        $params = null;
        return Database::getRows($sql, $params);
    }

    //Leer solo un producto
    public function readOne()
    {
        $sql = 'SELECT id_inventario, public.inventario.nombre as nombre_producto, precio, public.inventario.descripcion as descripcion, descuento, stock, autor, imagen,id_proveedor, public.proveedor.nombre as proveedor, id_tipo_producto, tipo_producto,id_marca, nombre_marca
        FROM public.inventario
            INNER JOIN public.tipo_producto USING(id_tipo_producto) 
            INNER JOIN public.proveedor USING(id_proveedor) 
            INNER JOIN public.marca USING(id_marca)
                WHERE  id_inventario = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    //Actualizar producto
    public function updateRow($current_image)
    {
        // Se verifica si existe una nueva imagen para borrar la actual, de lo contrario se mantiene la actual.
        if ($this->foto) {
            $this->deleteFile($this->getRuta(), $current_image);
        } else {
            $this->foto = $current_image;
        }

        $sql = 'UPDATE public.inventario
                SET nombre=?, precio=?, descripcion=?, autor=?, imagen=?, id_proveedor=?, id_tipo_producto=?, id_marca=?
                WHERE id_inventario=?';
        $params = array($this->nombre, $this->precio, $this->descripcion, $this->autor, $this->foto, $this->proveedor, $this->tipo, $this->marca, $this->id);
        return Database::executeRow($sql, $params);
    }

    //Borrar Producto
    public function deleteRow()
    {
        $sql = 'DELETE FROM public.inventario
                WHERE id_inventario=?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);
    }

    /*
    *   Métodos para generar gráficas.
    */
    public function cantidadProductosCategoria()
    {
        $sql = 'SELECT nombre_categoria, COUNT(id_producto) cantidad
                FROM public."tbProductos" INNER JOIN categorias USING(id_categoria)
                GROUP BY nombre_categoria ORDER BY cantidad DESC';
        $params = null;
        return Database::getRows($sql, $params);
    }
}
