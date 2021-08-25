<?php
// Se verifica si existe el parámetro id en la url, de lo contrario se direcciona a la página web de origen.
if (isset($_GET['id'])) {
    require('../helpers/report.php');
    require('../models/historial.php');
    // Se instancia el módelo Categorias para procesar los datos.
    $comprobante = new Historial;

    // Se verifica si el parámetro es un valor correcto, de lo contrario se direcciona a la página web de origen.
    if ($comprobante->setId($_GET['id'])) {        
        // Se verifica si la categoría del parametro existe, de lo contrario se direcciona a la página web de origen.
        if ($rowComprobante = $comprobante->readOne()) {            
            // Se instancia la clase para crear el reporte.
            $pdf = new Report;
            // Se inicia el reporte con el encabezado del documento.
            $pdf->startReport('Factura - Pedido #' . $rowComprobante['id_factura']);
            //Se agrega el texto que indica el estado del pedido.
            $pdf->Cell(166, 10, 'Estado: '.$rowComprobante['estado'], 0, 1);
            // Se verifica si existen registros (productos) para mostrar, de lo contrario se imprime un mensaje.
            if ($dataComprobante = $comprobante->readFactura()) {
                // Se establece un color de relleno para los encabezados.
                $pdf->SetFillColor(0);
                $pdf->SetTextColor(225,225,255);
                // Se establece la fuente para los encabezados.
                $pdf->SetFont('Arial', 'B', 11);
                // Se imprimen las celdas con los encabezados.
                $pdf->Cell(186, 10, utf8_decode('Fecha del pedido: ' . $rowComprobante['fecha']), 1, 1, 'C', 1);                
                $pdf->SetFillColor(59, 56, 53);
                $pdf->SetTextColor(225,225,255);
                $pdf->Cell(54, 10, utf8_decode('Nombre'), 1, 0, 'C', 1);
                $pdf->Cell(28, 10, utf8_decode('Cantidad'), 1, 0, 'C', 1);
                $pdf->Cell(52, 10, utf8_decode('Precio'), 1, 0, 'C', 1);
                $pdf->Cell(52, 10, utf8_decode('Subtotal'), 1, 1, 'C', 1);
                // Se establece la fuente para los datos de los productos.
                $pdf->SetFont('Arial', '', 11);
                // Se recorren los registros ($dataComprobante) fila por fila ($rowFactura).
                foreach ($dataComprobante as $rowFactura) {
                    // Se imprimen las celdas con los datos de la factura.
                    $pdf->SetFont('Arial', '', 11);
                    $pdf->SetTextColor(0,0,0);  
                    $pdf->Cell(54, 10, utf8_decode($rowFactura['nombre']), 1, 0, 'C');
                    $pdf->Cell(28, 10, utf8_decode($rowFactura['cantidad']), 1, 0, 'C');
                    $pdf->Cell(52, 10, '$' . $rowFactura['precio'], 1, 0, 'C');
                    $pdf->Cell(52, 10, '$' . $rowFactura['subtotal'], 1, 1, 'C');
                }
                //Se verifica si se ha podido obtener el total del pedido, de lo contrario muestra un mensaje de error.
                if ($rowTotal = $comprobante->readTotal()) {
                    $pdf->SetFont('Arial', 'B', 11);
                    $pdf->SetFillColor(0);
                    $pdf->SetTextColor(225,225,255);
                    $pdf->Cell(134, 10, 'Total', 1, 0, 'C', 1);
                    $pdf->SetFillColor(59, 56, 53);
                    $pdf->SetTextColor(225,225,255);
                    $pdf->SetFont('Arial', '', 11);
                    $pdf->Cell(52, 10, '$'.$rowTotal['total'], 1, 1, 'C', 1);
                } else {
                    $pdf->Cell(0, 10, utf8_decode('Hubo un error al obtener el total del pedido'), 1, 1);
                }
            } else {
                $pdf->Cell(0, 10, utf8_decode('No hay productos para esta pedido'), 1, 1);
            }
            // Se envía el documento al navegador y se llama al método Footer()
            $pdf->SetTextColor(0,0,0);  
            $pdf->Output();
        } else {
            header('location: ../../../views/dashboard/historial.php');
        }
    } else {
        header('location: ../../../views/dashboard/historial.php');
    }
} else {
    header('location: ../../../views/dashboard/historial.php');
}
