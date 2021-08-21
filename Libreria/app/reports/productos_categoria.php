<?php
// Se verifica si existe el parámetro id en la url, de lo contrario se direcciona a la página web de origen.
if (isset($_GET['id'])) {
    require('../helpers/report.php');
    require('../models/marca.php');

    // Se instancia el módelo Categorias para procesar los datos.
    $categoria = new Categorias;

    // Se verifica si el parámetro es un valor correcto, de lo contrario se direcciona a la página web de origen.
    if ($categoria->setIdCategoria($_GET['id'])) {
        // Se verifica si la categoría del parametro existe, de lo contrario se direcciona a la página web de origen.
        if ($rowCategoria = $categoria->readOne()) {
            // Se instancia la clase para crear el reporte.
            $pdf = new Report;
            // Se inicia el reporte con el encabezado del documento.
            $pdf->startReport('Productos de la categoría '.$rowCategoria['categoria']);
            // Se verifica si existen registros (productos) para mostrar, de lo contrario se imprime un mensaje.
            if ($dataProductos = $categoria->readProductosCategoria()) {
                // Se establece un color de relleno para los encabezados.
                $pdf->SetFillColor(225);
                // Se establece la fuente para los encabezados.
                $pdf->SetFont('Arial', 'B', 11);
                // Se imprimen las celdas con los encabezados.
                $pdf->Cell(30, 10, utf8_decode('Nombre'), 1, 0, 'C', 1);
                $pdf->Cell(26, 10, utf8_decode('Precio (US$)'), 1, 0, 'C', 1);
                $pdf->Cell(55, 10, utf8_decode('Descripción'), 1, 0, 'C', 1);
                $pdf->Cell(25, 10, utf8_decode('Cantidad'), 1, 0, 'C', 1);
                $pdf->Cell(25, 10, utf8_decode('Marca'), 1, 0, 'C', 1);
                $pdf->Cell(25, 10, utf8_decode('Tipo'), 1, 1, 'C', 1);
                // Se establece la fuente para los datos de los productos.
                $pdf->SetFont('Arial', '', 11);
                // Se recorren los registros ($dataProductos) fila por fila ($rowProducto).
                foreach ($dataProductos as $rowProducto) {
                    // Se imprimen las celdas con los datos de los productos.
                    $pdf->Cell(30, 20, utf8_decode($rowProducto['nombre_producto']), 1, 0);
                    $pdf->Cell(26, 20, $rowProducto['precio_producto'], 1, 0);
                    $pdf->Cell(55, 20, utf8_decode($rowProducto['descripcion_producto']), 1, 0);
                    $pdf->Cell(25, 20, $rowProducto['cantidad_total'], 1, 0);
                    $pdf->Cell(25, 20, utf8_decode($rowProducto['marca_producto']), 1, 0);
                    $pdf->Cell(25, 20, utf8_decode($rowProducto['categoria']), 1, 1);
                }
            } else {
                $pdf->Cell(0, 10, utf8_decode('No hay productos registrados en el inventario'), 1, 1);
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