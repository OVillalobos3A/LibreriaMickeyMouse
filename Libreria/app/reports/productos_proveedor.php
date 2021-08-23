<?php
// Se verifica si existe el parámetro id en la url, de lo contrario se direcciona a la página web de origen.
if (isset($_GET['id'])) {
    require('../helpers/report.php');
    require('../models/proveedor.php');

    // Se instancia el módelo Categorias para procesar los datos.
    $proveedor = new Proveedor_crud;

    // Se verifica si el parámetro es un valor correcto, de lo contrario se direcciona a la página web de origen.
    if ($proveedor->setId($_GET['id'])) {
        // Se verifica si la categoría del parametro existe, de lo contrario se direcciona a la página web de origen.
        if ($rowProveedor = $proveedor->readOne()) {
            // Se instancia la clase para crear el reporte.
            $pdf = new Report;
            // Se inicia el reporte con el encabezado del documento.
            $pdf->startReport('Productos del proveedor: '.$rowProveedor['nombre']);
            // Se verifica si existen registros (productos) para mostrar, de lo contrario se imprime un mensaje.
            if ($dataProveedores = $proveedor->readProductosReport()) {
                // Se recorren los registros ($dataProductos) fila por fila ($rowProducto).
                foreach ($dataProveedores as $rowProveedores) {
                    // Se establece un color de relleno para el encabezado.
                    $pdf->SetFillColor(0);
                    //Se establece un color de fuente para el encabezado
                    $pdf->SetTextColor(225,225,255);
                    // Se establece la fuente para el encabezado.
                    $pdf->SetFont('Arial', 'B', 11);
                    // Se imprime las celdas con el encabezado desde la consulta de la base.
                    $pdf->Cell(186, 10, utf8_decode($rowProveedores['nombre_producto']), 1, 1,'C',1);
                    // Se establece la fuente para los datos de los productos.
                    $pdf->SetFont('Arial', '', 11);
                    $pdf->SetTextColor(0,0,0);
                    // Se imprimen las celdas con los datos de los productos.
                    $pdf->Cell(186, 10, utf8_decode('  Descripción: '.$rowProveedores['descripcion']), 1, 1);
                    //Se verifica si el dato del autor contiene datos
                    if ($rowProveedores['autor']) {
                        //Si lo tiene se imprimen las celdas 
                        $pdf->Cell(186, 10, utf8_decode('  Marca: '.$rowProveedores['marca']), 1, 1);
                        $pdf->Cell(93, 10, utf8_decode('  Tipo: '.$rowProveedores['tipo_producto']), 1, 0);
                        $pdf->Cell(93, 10, utf8_decode('  Autor: '.$rowProveedores['autor']), 1, 1);
                        $pdf->Cell(93, 10, utf8_decode('  Precio (US$): '.$rowProveedores['precio']), 1, 0);
                        $pdf->Cell(93, 10, utf8_decode('  Cantidad: '.$rowProveedores['stock']), 1, 1);
                    }else {
                        $pdf->Cell(93, 10, utf8_decode('  Tipo: '.$rowProveedores['tipo_producto']), 1, 0);
                        $pdf->Cell(93, 10, utf8_decode('  Marca: '.$rowProveedores['marca']), 1, 1);
                        $pdf->Cell(93, 10, utf8_decode('  Precio (US$): '.$rowProveedores['precio']), 1, 0);
                        $pdf->Cell(93, 10, utf8_decode('  Cantidad: '.$rowProveedores['stock']), 1, 1);
                    }
                    $pdf->Ln();
                }
            } else {
                $pdf->Cell(0, 10, utf8_decode('No hay productos para esta categoría'), 1, 1);
            }
            // Se envía el documento al navegador y se llama al método Footer()
            $pdf->Output();
        } else {
            header('location: ../../views/proveedor.php');
        }
    } else {
        header('location: ../../views/proveedor.php');
    }
} else {
    header('location: ../../views/proveedor.php');
}
?>