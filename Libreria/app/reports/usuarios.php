<?php
require('../helpers/report.php');
require('../models/empleados.php');

// Se instancia la clase para crear el reporte.
$pdf = new Report;
// Se inicia el reporte con el encabezado del documento.
$pdf->startReport('Reporte de usuarios');

// Se instancia el módelo Usuarios para obtener los datos.
$usuarios = new Empleados;
// Se verifica si existen registros (usuarios) para mostrar, de lo contrario se imprime un mensaje.
if ($dataUsuarios = $usuarios->readTipo()) {
    // Se recorren los registros ($dataCategorias) fila por fila ($rowCategoria).
    foreach ($dataUsuarios as $rowUsuario) {
        // Se establece un color de relleno para mostrar el nombre de la categoría.
        $pdf->SetFillColor(0);
        $pdf->SetTextColor(225,225,255);
        // Se establece la fuente para el nombre de la categoría.
        $pdf->SetFont('Arial', 'B', 11);
        // Se imprime una celda con el nombre de la categoría.
        $pdf->Cell(0, 10, utf8_decode('Tipo de usuario: '.$rowUsuario['tipo_usuario']), 1, 1, 'C', 1);
        // Se establece la categoría para obtener sus productos, de lo contrario se imprime un mensaje de error.
        if ($usuarios->setId($rowUsuario['id_tipo_usuario'])) {
            // Se verifica si existen registros (productos) para mostrar, de lo contrario se imprime un mensaje.
            if ($dataProductos = $usuarios->readUsuariosTipo()) {
                $pdf->SetFillColor(59, 56, 53);
                $pdf->SetTextColor(225,225,255);
                // Se establece la fuente para el nombre de la categoría.
                $pdf->SetFont('Arial', 'B', 11);
                // Se imprimen las celdas con los encabezados.
                $pdf->Cell(26, 10, utf8_decode('Usuario'), 1, 0, 'C', 1);                
                $pdf->Cell(80, 10, utf8_decode('Empleado'), 1, 0, 'C', 1);
                $pdf->Cell(52, 10, utf8_decode('Correo'), 1, 0, 'C', 1); 
                $pdf->Cell(28, 10, utf8_decode('Teléfono'), 1, 1, 'C', 1);               
                // Se establece la fuente para los datos de los productos.
                $pdf->SetFont('Arial', '', 11);
                $pdf->SetTextColor(0,0,0);
                // Se recorren los registros ($dataProductos) fila por fila ($rowProducto).
                foreach ($dataProductos as $rowProducto) {
                    // Se imprimen las celdas con los datos de los productos.
                    $pdf->Cell(26, 10, utf8_decode($rowProducto['usuario']), 1, 0);                    
                    $pdf->Cell(80, 10, utf8_decode($rowProducto['empleado']), 1, 0);
                    $pdf->Cell(52, 10, utf8_decode($rowProducto['correo']), 1, 0); 
                    $pdf->Cell(28, 10, utf8_decode($rowProducto['telefono']), 1, 1);                                       
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
