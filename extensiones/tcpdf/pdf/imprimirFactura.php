<?php

require_once "../../../controladores/compras.controlador.php";
require_once "../../../modelos/compras.modelo.php"; // Modifica los nombres de los archivos de controlador y modelo según corresponda a tu aplicación

require_once "../../../controladores/proveedor.controlador.php";
require_once "../../../modelos/proveedores.modelo.php"; // Modifica los nombres de los archivos de controlador y modelo según corresponda a tu aplicación

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";

class imprimirFactura{

    public $codigo;

    public function traerImpresionFactura(){

        //TRAEMOS LA INFORMACIÓN DE LA COMPRA

        $itemCompra = "codigo";
        $valorCompra = $this->codigo;

        $respuestaCompra = ControladorCompras::ctrMostrarCompras($itemCompra, $valorCompra); // Modifica según corresponda el método y la clase del controlador y modelo de compras

        $fecha = substr($respuestaCompra["fecha"],0,-8);
        $productos = json_decode($respuestaCompra["productos"], true);
        $neto = number_format($respuestaCompra["neto"],2);
        $impuesto = number_format($respuestaCompra["impuesto"],2);
        $total = number_format($respuestaCompra["total"],2);

        //TRAEMOS LA INFORMACIÓN DEL PROVEEDOR

        $itemProveedor = "id";
        $valorProveedor = $respuestaCompra["id_proveedor"]; // Modifica según corresponda el nombre del campo que almacena el ID del proveedor en tu base de datos

        $respuestaProveedor = ControladorProveedores::ctrMostrarProveedores($itemProveedor, $valorProveedor); // Modifica según corresponda el método y la clase del controlador y modelo de proveedores

        //TRAEMOS LA INFORMACIÓN DEL VENDEDOR

        $itemVendedor = "id";
        $valorVendedor = $respuestaCompra["id_vendedor"];

        $respuestaVendedor = ControladorUsuarios::ctrMostrarUsuarios($itemVendedor, $valorVendedor);

        //REQUERIMOS LA CLASE TCPDF

        require_once('tcpdf_include.php');

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $pdf->startPageGroup();

        $pdf->AddPage();

        // ---------------------------------------------------------

        $bloque1 = <<<EOF

        <table>

            <tr>

                <td style="width:150px"><img src="images/logo-negro-bloque.png"></td>

                <td style="background-color:white; width:140px">

                    <div style="font-size:8.5px; text-align:right; line-height:15px;">

                        <br>
                        NIT: 71.759.963-9

                        <br>
                        Dirección: Calle 44B 92-11

                    </div>

                </td>

                <td style="background-color:white; width:140px">

                    <div style="font-size:8.5px; text-align:right; line-height:15px;">

                        <br>
                        Teléfono: 300 786 52 49
                        
                        <br>
                        ventas@inventorysystem.com

                    </div>
                    
                </td>

                <td style="background-color:white; width:110px; text-align:center; color:red"><br><br>FACTURA N.<br>$valorCompra</td>

            </tr>

        </table>

EOF;

        $pdf->writeHTML($bloque1, false, false, false, false, '');

        // ---------------------------------------------------------

        $bloque2 = <<<EOF

        <table> 
            
            <tr>
                
                <td style="width:540px"><img src="images/back.jpg"></td>
            
            </tr>

        </table>

        <table style="font-size:10px; padding:5px 10px;">
        
            <tr>
            
                <td style="border: 1px solid #666; background-color:white; width:390px">

                    Proveedor: $respuestaProveedor[nombre]

                </td>

                <td style="border: 1px solid #666; background-color:white; width:150px; text-align:right">
                
                    Fecha: $fecha

                </td>

            </tr>

            <tr>
            
                <td style="border: 1px solid #666; background-color:white; width:540px">Vendedor: $respuestaVendedor[nombre]</td>

            </tr>

            <tr>
            
            <td style="border-bottom: 1px solid #666; background-color:white; width:540px"></td>

            </tr>

        </table>

EOF;

        $pdf->writeHTML($bloque2, false, false, false, false, '');

        // ---------------------------------------------------------

        $bloque3 = <<<EOF

        <table style="font-size:10px; padding:5px 10px;">

            <tr>
            
            <td style="border: 1px solid #666; background-color:white; width:260px; text-align:center">Producto</td>
            <td style="border: 1px solid #666; background-color:white; width:80px; text-align:center">Cantidad</td>
            <td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Valor Unit.</td>
            <td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Valor Total</td>

            </tr>

        </table>

EOF;

        $pdf->writeHTML($bloque3, false, false, false, false, '');

        // ---------------------------------------------------------

        foreach ($productos as $key => $item) {

        $itemProducto = "descripcion";
        $valorProducto = $item["descripcion"];
        $orden = null;

        $respuestaProducto = ControladorProductos::ctrMostrarProductos($itemProducto, $valorProducto, $orden);

        $valorUnitario = number_format($respuestaProducto["precio_venta"], 2);

        $precioTotal = number_format($item["total"], 2); 

        $bloque4 = <<<EOF

        <table style="font-size:10px; padding:5px 10px;">

            <tr>
                
                <td style="border: 1px solid #666; color:#333; background-color:white; width:260px; text-align:center">
                    $item[descripcion]
                </td>

                <td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
                    $item[cantidad]
                </td>

                <td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">$ 
                    $valorUnitario
                </td>

                <td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">$ 
                    $precioTotal
                </td>


            </tr>

        </table>


EOF;

        $pdf->writeHTML($bloque4, false, false, false, false, '');

        }

        // ---------------------------------------------------------

        $bloque5 = <<<EOF

        <table style="font-size:10px; padding:5px 10px;">

            <tr>

                <td style="color:#333; background-color:white; width:340px; text-align:center"></td>

                <td style="border-bottom: 1px solid #666; background-color:white; width:100px; text-align:center"></td>

                <td style="border-bottom: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center"></td>

            </tr>
            
            <tr>
            
                <td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

                <td style="border: 1px solid #666;  background-color:white; width:100px; text-align:center">
                    Neto:
                </td>

                <td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
                    $ $neto
                </td>

            </tr>

            <tr>

                <td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

                <td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
                    Impuesto:
                </td>
            
                <td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
                    $ $impuesto
                </td>

            </tr>

            <tr>
            
                <td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

                <td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
                    Total:
                </td>
                
                <td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
                    $ $total
                </td>

            </tr>


        </table>

EOF;

        $pdf->writeHTML($bloque5, false, false, false, false, '');



        // ---------------------------------------------------------
        //SALIDA DEL ARCHIVO 

        //$pdf->Output('factura.pdf', 'D');
        ob_end_clean();
        $pdf->Output('factura.pdf');

    }

}

$factura = new imprimirFactura();
$factura -> codigo = $_GET["codigo"];
$factura -> traerImpresionFactura();

?>
