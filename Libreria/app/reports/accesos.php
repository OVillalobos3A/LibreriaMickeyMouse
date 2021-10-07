<?php

//Se añaden las referencias con sus rutas correspondientes
require('../helpers/report.php');
require('../models/permisos.php');

// Se instancia la clase para crear el reporte.
$pdf = new Report;
// Se inicia el reporte con el encabezado del documento.
$pdf->startReport('Reporte de accesos');

// Se instancia el módelo Usuarios para obtener los datos.
$permiso = new Permisos;
// Se verifica si existen registros (usuarios) para mostrar, de lo contrario se imprime un mensaje.
if ($dataPermisos = $permiso->readPaginas()) {
    // Se recorren los registros ($dataCategorias) fila por fila ($rowCategoria).
    foreach ($dataPermisos as $rowPermiso) {
        // Se establece un color de relleno para mostrar el encabezado.
        $pdf->SetFillColor(0);
        //Se establece el color de fuente para el encabezado
        $pdf->SetTextColor(225,225,255);
        // Se establece la fuente para el encabezado.
        $pdf->SetFont('Arial', 'B', 11);
        // Se imprime una celda con el nombre del encabezado.
        $pdf->Cell(0, 10, utf8_decode('Accesos a la Página: '.$rowPermiso['nombre']), 1, 1, 'C', 1);
        // Se establece la categoría para obtener sus productos, de lo contrario se imprime un mensaje de error.
        if ($permiso->setIdPagina($rowPermiso['id_pagina'])) {
            // Se verifica si existen registros (productos) para mostrar, de lo contrario se imprime un mensaje.
            if ($dataPermisos = $permiso->readAllPaginas()) {
                /*//Se establece un color de fondo para las celdas
                $pdf->SetFillColor(59, 56, 53);
                //Se establece un color de fuente para las celdas de los empleados.
                $pdf->SetTextColor(225,225,255);
                // Se establece la fuente para el nombre de la categoría.
                $pdf->SetFont('Arial', 'B', 11);
                // Se imprimen las celdas con los encabezados.
                $pdf->Cell(93, 10, utf8_decode('Tipo de Usuario'), 1, 0, 'C', 1);                
                $pdf->Cell(93, 10, utf8_decode('Permiso'), 1, 1, 'C', 1);*/
                // Se establece la fuente para los datos de los productos.
                $pdf->SetFont('Arial', '', 11);
                $pdf->SetTextColor(0,0,0);
                // Se recorren los registros ($dataProductos) fila por fila ($rowProducto).
                foreach ($dataPermisos as $rowPermiso) {
                    // Se imprimen las celdas con los datos de los productos.
                    $pdf->Cell(53, 10, utf8_decode($rowPermiso['tipo_usuario']), 1, 0);                    
                    $pdf->Cell(133, 10, utf8_decode('Permisos concedidos: '.$rowPermiso['permiso']), 1, 1);                                    
                }
                $pdf->Ln();
            } else {
                $pdf->Cell(0, 10, utf8_decode('No hay usuarios asignados a este tipo de usuario'), 1, 1);
            }
        } else {
            $pdf->Cell(0, 10, utf8_decode('Tipo de usuario incorrecto o inexistente'), 1, 1);
        }
    }
} else {
    $pdf->Cell(0, 10, utf8_decode('No hay usuarios para mostrar'), 1, 1);
}

// Se envía el documento al navegador y se llama al método Footer()
$pdf->Output();
