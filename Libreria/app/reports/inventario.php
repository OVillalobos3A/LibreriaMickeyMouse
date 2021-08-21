<?php
require('../helpers/report.php');
require('../models/productos.php');

// Se instancia la clase para crear el reporte.
$pdf = new Report;
// Se inicia el reporte con el encabezado del documento.
$pdf->startReport('Reporte del inventario');

// Se instancia el módelo Categorías para obtener los datos.
$categoria = new Productos;
// Se verifica si existen registros (categorías) para mostrar, de lo contrario se imprime un mensaje.
if ($dataProductos = $categoria->readAllReport()) {
    // Se recorren los registros ($dataProductos) fila por fila ($rowProducto).
    foreach ($dataProductos as $rowProducto) {

        // Se establece un color de relleno para los encabezados.
        $pdf->SetFillColor(0);
        $pdf->SetTextColor(225,225,255);
        // Se establece la fuente para los encabezados.
        $pdf->SetFont('Arial', 'B', 11);
        // Se imprimen las celdas con los encabezados.
        $pdf->Cell(186, 10, utf8_decode($rowProducto['nombre_producto']), 1, 1,'C',1);
        // Se establece la fuente para los datos de los productos.
        $pdf->SetFont('Arial', '', 11);
        $pdf->SetTextColor(0,0,0);
        // Se imprimen las celdas con los datos de los productos.
        $pdf->Cell(186, 10, utf8_decode('  Descripción: '.$rowProducto['descripcion']), 1, 1);
        if ($rowProducto['autor']) {
            $pdf->Cell(93, 10, utf8_decode('  Marca: '.$rowProducto['nombre_marca']), 1, 0);
            $pdf->Cell(93, 10, utf8_decode('  Tipo: '.$rowProducto['tipo_producto']), 1, 1);
            $pdf->Cell(93, 10, utf8_decode('  Proveedor: '.$rowProducto['proveedor']), 1, 0);
            $pdf->Cell(93, 10, utf8_decode('  Autor: '.$rowProducto['autor']), 1, 1);
            $pdf->Cell(93, 10, utf8_decode('  Precio (US$): '.$rowProducto['precio']), 1, 0);
            $pdf->Cell(93, 10, utf8_decode('  Cantidad: '.$rowProducto['stock']), 1, 1);
        }else {
            $pdf->Cell(186, 10, utf8_decode('  Proveedor: '.$rowProducto['proveedor']), 1, 1);
            $pdf->Cell(93, 10, utf8_decode('  Marca: '.$rowProducto['nombre_marca']), 1, 0);
            $pdf->Cell(93, 10, utf8_decode('  Tipo: '.$rowProducto['tipo_producto']), 1, 1);
            $pdf->Cell(93, 10, utf8_decode('  Precio (US$): '.$rowProducto['precio']), 1, 0);
            $pdf->Cell(93, 10, utf8_decode('  Cantidad: '.$rowProducto['stock']), 1, 1);
        }
        $pdf->Ln();
    }
} else {
    $pdf->Cell(0, 10, utf8_decode('No hay productos que mostrar'), 1, 1);
}

// Se envía el documento al navegador y se llama al método Footer()
$pdf->Output();
?>