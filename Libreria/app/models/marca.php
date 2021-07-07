<?php
/*
*	Clase para manejar la tabla productos de la base de datos. Es clase hija de Validator.
*/



class Marca extends Validator
{
    public function readAll()
    {
        $sql = 'SELECT id_marca, nombre_marca
        FROM public.marca
                ORDER BY nombre_marca';
        $params = null;
        return Database::getRows($sql, $params);
    }

}