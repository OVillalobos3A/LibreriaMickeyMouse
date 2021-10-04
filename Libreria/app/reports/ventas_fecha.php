<?php
if (isset($_GET['fecha1']) && isset($_GET['fecha2'])) {
    if ($_GET['fecha1'] != null && $_GET['fecha2'] != null) {
 require('../helpers/report.php');
 require('../models/historial.php');

// Se instancia la clase para crear el reporte.
$pdf = new Report;

// Se inicia el reporte con el encabezado del documento.
$pdf->startReport('Reporte de ventas por fecha');
// Se instancia el módelo Historial para obtener los datos.
$ventas = new Historial;
        $pdf->SetFillColor(207, 118, 53);
        // Se establece la fuente para el nombre de la categoría.
        $pdf->SetFont('Arial', 'B', 11);
        
            //Se establecen los parametros para la consulta con las dos fechas.
            if ($ventas->setFecha($_GET['fecha1']) && $ventas->setFecha2($_GET['fecha2'])) {
                //Se agrega el texto que indica el estado del pedido.
            $pdf->Cell(166, 10, 'Ventas del: '.$_GET['fecha1'].' al '.$_GET['fecha2'], 0, 1);
            if ($dataVentas = $ventas->readReportVentas()) {
                // Se establece un color de relleno para los encabezados.
                $pdf->SetFillColor(0);
                $pdf->SetTextColor(225,225,255);
                $pdf->SetFont('Arial', 'B', 11);
                // Se imprimen las celdas con los encabezados.
                $pdf->Cell(40, 10, utf8_decode('Estado'), 1, 0, 'C', 1);
                $pdf->Cell(40, 10, utf8_decode('Fecha'), 1, 0, 'C', 1);
                $pdf->Cell(70, 10, utf8_decode('Empleado'), 1, 0, 'C', 1);
                $pdf->Cell(36, 10, utf8_decode('Total'), 1, 1, 'C', 1);
                // Se establece la fuente para los datos de la venta.
                $pdf->SetFont('Times', '', 11);
                // Se recorren los registros ($dataVentas) fila por fila ($rowVenta).
                foreach ($dataVentas as $rowVenta) {
                    $pdf->SetFont('Arial', '', 11);
                    $pdf->SetTextColor(0,0,0);  
                    // Se imprimen las celdas con los datos de la venta.
                    $pdf->Cell(40, 10, utf8_decode($rowVenta['estado']), 1, 0);
                    $pdf->Cell(40, 10, utf8_decode($rowVenta['fecha']), 1, 0);
                    $pdf->Cell(70, 10, utf8_decode($rowVenta['empleado']), 1, 0);
                    $pdf->Cell(36, 10, '$'.$rowVenta['total'], 1, 1);
                }
            } else {
                $pdf->Cell(0, 10, utf8_decode('Fecha inexistente o incorrecta'), 1, 1);
            }
            } else {
                $pdf->Cell(0, 10, utf8_decode('No hay ventas en este rango de fechas'), 1, 1);
            }
  
// Se envía el documento al navegador y se llama al método Footer()
$pdf->Output();
} else {
    //Se devuelve a la interfaz del los proveedores
    header('location: ../../views/historial.php');
}
} else {
    //Se devuelve a la interfaz del los proveedores
    header('location: ../../views/historial.php');
}
?>