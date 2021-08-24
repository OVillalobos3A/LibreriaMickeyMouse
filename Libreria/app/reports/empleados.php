<?php

//Se añaden las referencias con sus rutas correspondientes
require('../helpers/report.php');
require('../models/empleados.php');

// Se instancia la clase para crear el reporte.
$pdf = new Report;
// Se inicia el reporte con el encabezado del documento.
$pdf->startReport('Reporte de empleados');

// Se instancia el módelo Categorías para obtener los datos.
$empleado = new Empleados;
// Se verifica si existen registros (categorías) para mostrar, de lo contrario se imprime un mensaje.
if ($dataEmpleados = $empleado->readReportEmpleados()) {
    // Se recorren los registros ($dataEmpleados) fila por fila ($rowEmpleado).
    foreach ($dataEmpleados as $rowEmpleado) {

        // Se establece un color de relleno para los encabezados.
        $pdf->SetFillColor(0);
        //Se establece el color de fuente de los encabezados
        $pdf->SetTextColor(225,225,255);
        // Se establece la fuente para los encabezados.
        $pdf->SetFont('Arial', 'B', 11);
        // Se imprimen las celdas con los encabezados.
        $pdf->Cell(186, 10, utf8_decode('Nombre completo: '.$rowEmpleado['nombres']), 1, 1,'C',1);        
        // Se establece la fuente para los datos de los productos.
        $pdf->SetFont('Arial', '', 11);
        // Se establece el color de fuente para los datos de los productos
        $pdf->SetTextColor(0,0,0);
        // Se imprimen las celdas con los datos de los Empleados.                    
        $pdf->Cell(186, 10, utf8_decode('Correo: '.$rowEmpleado['correo']), 1, 1,'C');
        $pdf->Cell(93, 10, utf8_decode('Teléfono: '.$rowEmpleado['telefono']), 1, 0,'C');
        $pdf->Cell(93, 10, utf8_decode('DUI: '.$rowEmpleado['dui']), 1, 1,'C');
        $pdf->Cell(93, 10, utf8_decode('Fecha de nacimiento: '.$rowEmpleado['fecha_nac']), 1, 0,'C');
        // Se define el género dependiendo de la información consultada desde la base
        if ($rowEmpleado['genero'] == 'M') {
            $pdf->Cell(93, 10, utf8_decode('Género: Masculino'), 1, 1,'C');
        } else{
            $pdf->Cell(93, 10, utf8_decode('Género: Femenino'), 1, 1,'C');
        }
        //Se hace un salto de línea para espaciar los registros mostrados
        $pdf->Ln();            
    }
} else {
    //Se imprime un mensaje por si la consulta no retorna datos.
    $pdf->Cell(0, 10, utf8_decode('No hay empleados que mostrar'), 1, 1);
}

// Se envía el documento al navegador y se llama al método Footer()
$pdf->Output();
?>