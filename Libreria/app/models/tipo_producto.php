<?php
/*
*	Clase para manejar la tabla productos de la base de datos. Es clase hija de Validator.
*/



class Tipo_producto extends Validator
{
    public function readAll()
    {
        $sql = 'SELECT id_tipo_producto, tipo_producto
        FROM public.tipo_producto
                ORDER BY tipo_producto';
        $params = null;
        return Database::getRows($sql, $params);
    }

}
