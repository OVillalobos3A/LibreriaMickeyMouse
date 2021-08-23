<?php
require('../helpers/report.php');
require('../models/proveedor.php');

// Se instancia la clase para crear el reporte.
$pdf = new Report;
// Se inicia el reporte con el encabezado del documento.
$pdf->startReport('Reporte de los Proveedores');

// Se instancia el módelo Categorías para obtener los datos.
$proveedor = new Proveedor_crud;
// Se verifica si existen registros (categorías) para mostrar, de lo contrario se imprime un mensaje.
if ($dataProveedores = $proveedor->readAllReport()) {
    // Se recorren los registros ($dataProductos) fila por fila ($rowProducto).
    foreach ($dataProveedores as $rowProveedor) {

        // Se establece un color de relleno para los encabezados.
        $pdf->SetFillColor(0);
        $pdf->SetTextColor(225,225,255);
        // Se establece la fuente para los encabezados.
        $pdf->SetFont('Arial', 'B', 11);
        // Se imprimen las celdas con los encabezados.
        $pdf->Cell(186, 10, utf8_decode($rowProveedor['nombre']), 1, 1,'C',1);
        // Se establece la fuente para los datos de los productos.
        $pdf->SetFont('Arial', '', 11);
        $pdf->SetTextColor(0,0,0);
        // Se imprimen las celdas con los datos de los productos.
        $pdf->Cell(186, 10, utf8_decode('  Dirección: '.$rowProveedor['direccion']), 1, 1);
        $pdf->Cell(186, 10, utf8_decode('  Correo: '.$rowProveedor['correo']), 1, 1);
        $pdf->Cell(186, 10, utf8_decode('  Teléfono: '.$rowProveedor['telefono']), 1, 1);
        $pdf->Ln();
    }
} else {
    $pdf->Cell(0, 10, utf8_decode('No hay proveedores que mostrar'), 1, 1);
}

// Se envía el documento al navegador y se llama al método Footer()
$pdf->Output();
?>