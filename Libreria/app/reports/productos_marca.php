<?php
// Se verifica si existe el parámetro id en la url, de lo contrario se direcciona a la página web de origen.
if (isset($_GET['id'])) {
    require('../helpers/report.php');
    require('../models/marca.php');

    // Se instancia el módelo Categorias para procesar los datos.
    $marca = new Marca_crud;

    // Se verifica si el parámetro es un valor correcto, de lo contrario se direcciona a la página web de origen.
    if ($marca->setId($_GET['id'])) {
        // Se verifica si la categoría del parametro existe, de lo contrario se direcciona a la página web de origen.
        if ($rowMarca = $marca->readOne()) {
            // Se instancia la clase para crear el reporte.
            $pdf = new Report;
            // Se inicia el reporte con el encabezado del documento.
            $pdf->startReport('Productos de la Marca: '.$rowMarca['nombre_marca']);
            // Se verifica si existen registros (productos) para mostrar, de lo contrario se imprime un mensaje.
            if ($dataProductos = $marca->readAllReport()) {
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
                        $pdf->Cell(186, 10, utf8_decode('  Proveedor: '.$rowProducto['proveedor']), 1, 1);
                        $pdf->Cell(93, 10, utf8_decode('  Tipo: '.$rowProducto['tipo_producto']), 1, 0);
                        $pdf->Cell(93, 10, utf8_decode('  Autor: '.$rowProducto['autor']), 1, 1);
                        $pdf->Cell(93, 10, utf8_decode('  Precio (US$): '.$rowProducto['precio']), 1, 0);
                        $pdf->Cell(93, 10, utf8_decode('  Cantidad: '.$rowProducto['stock']), 1, 1);
                    }else {
                        $pdf->Cell(93, 10, utf8_decode('  Tipo: '.$rowProducto['tipo_producto']), 1, 0);
                        $pdf->Cell(93, 10, utf8_decode('  Proveedor: '.$rowProducto['proveedor']), 1, 1);
                        $pdf->Cell(93, 10, utf8_decode('  Precio (US$): '.$rowProducto['precio']), 1, 0);
                        $pdf->Cell(93, 10, utf8_decode('  Cantidad: '.$rowProducto['stock']), 1, 1);
                    }
                    $pdf->Ln();
                }
            } else {
                $pdf->Cell(0, 10, utf8_decode('No hay productos para esta categoría'), 1, 1);
            }
            // Se envía el documento al navegador y se llama al método Footer()
            $pdf->Output();
        } else {
            header('location: ../../../views/dashboard/categorias.php');
        }
    } else {
        header('location: ../../../views/dashboard/categorias.php');
    }
} else {
    header('location: ../../../views/dashboard/categorias.php');
}
?>