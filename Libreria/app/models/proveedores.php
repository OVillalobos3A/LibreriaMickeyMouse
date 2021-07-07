<?php
/*
*	Clase para manejar la tabla productos de la base de datos. Es clase hija de Validator.
*/



class Proveedores extends Validator
{
    public function readAll()
    {
        $sql = 'SELECT id_proveedor, nombre
        FROM public.proveedor
                ORDER BY nombre';
        $params = null;
        return Database::getRows($sql, $params);
    }

}