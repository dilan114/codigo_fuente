<?php

require_once("../../../controladores/compras.controlador.php");
require_once("../../../modelos/compras.modelo.php");
require_once("../../../controladores/proveedor.controlador.php");
require_once("../../../modelos/proveedores.modelo.php");
require_once("../../../controladores/usuarios.controlador.php");
require_once("../../../modelos/usuarios.modelo.php");
require_once("../../../controladores/productos.controlador.php");
require_once("../../../modelos/productos.modelo.php");

class ImprimirFactura1 {
    public $codigo;

    public function traerImpresionFactura1() {
        $itemCompra = "codigo";
        $valorCompra = $this->codigo;
        $respuestaCompra = ControladorCompras::ctrMostrarCompras($itemCompra, $valorCompra);

        $fecha = substr($respuestaCompra["fecha"], 0, -8);
        $productos = json_decode($respuestaCompra["productos"], true);
        $neto = number_format($respuestaCompra["neto"], 2);
        $impuesto = number_format($respuestaCompra["impuesto"], 2);
        $total = number_format($respuestaCompra["total"], 2);

        $itemProveedor = "id";
        $valorProveedor = $respuestaCompra["id_proveedor"];
        $respuestaProveedor = ControladorProveedores::ctrMostrarProveedores($itemProveedor, $valorProveedor);

        $itemVendedor = "id";
        $valorVendedor = $respuestaCompra["id_vendedor"];
        $respuestaVendedor = ControladorUsuarios::ctrMostrarUsuarios($itemVendedor, $valorVendedor);

        require_once('tcpdf_include.php');
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->AddPage('P', 'A7');

        $bloque1 = <<<EOF

        <h1>TICKET COMPRA</h1>
        
<table style="font-size:6px; text-align:center">
    <tr>
    
        <td style="width:80px; text-align: left;">
        <h4>Datos de la empresa</h4>
            Inventory System<br>
            NIT: 71.759.963-9<br>
            Dirección: Calle 44B<br>
            Teléfono: 300 786 52 49<br>
            FACTURA N.$valorCompra
        </td>
        <td style="width:80px; vertical-align: top;">
            Fecha: $fecha
        </td>
    </tr>
    <br>
    <tr>
        <td colspan="2" style="text-align: top ;">
        <h4>Info proveedor</h4>
            <br>Nombre: $respuestaProveedor[nombre]<br>Documento: $respuestaProveedor[documento]<br>
        </td>
    </tr>
</table>
<br>
EOF;



        $pdf->writeHTML($bloque1, false, false, false, false, '');

        $bloque2 = '<table style="font-size:6px; width:100%; border-collapse: collapse; border: 1px solid black;">';
        $bloque2 .= <<<EOF
        <br>
        <tr>
            <th style="width:50%; text-align:left; border: 1px solid black; padding: 5px;">Producto</th>
            <th style="width:25%; text-align:right; border: 1px solid black; padding: 5px;">Cantidad</th>
            <th style="width:25%; text-align:right; border: 1px solid black; padding: 5px;">Precio</th>
        </tr>
EOF;

        foreach ($productos as $key => $item) {
            $precioTotal = number_format($item["total"], 2);
            $bloque2 .= <<<EOF
            <tr>
                <td style="width:50%; text-align:left; border: 1px solid black; padding: 5px;">$item[descripcion]</td>
                <td style="width:25%; text-align:right; border: 1px solid black; padding: 5px;">$item[cantidad]</td>
                <td style="width:25%; text-align:right; border: 1px solid black; padding: 5px;">$ $precioTotal</td>
            </tr>
EOF;
        }
        $bloque2 .= '</table>';
        $pdf->writeHTML($bloque2, false, false, false, false, '');

        $bloque3 = <<<EOF
        <br>
        <br>
        <table style="font-size:6px; text-align:right">
        
            <tr>
                <td style="width:80px;">NETO: </td>
                <td style="width:80px;">$ $neto</td>
            </tr>
            <tr>
                <td style="width:80px;">IMPUESTO: </td>
                <td style="width:80px;">$ $impuesto</td>
            </tr>
            <tr>
                <td style="width:160px;">--------------------------</td>
            </tr>
            <tr>
                <td style="width:80px;">TOTAL: </td>
                <td style="width:80px;">$ $total</td>
            </tr>
            <tr>
            
                <td style="width:160px;"><br><br>Muchas gracias por su compra</td>
            </tr>
        </table>
EOF;

        $pdf->writeHTML($bloque3, false, false, false, false, '');

        ob_end_clean();
        $pdf->Output('factura.pdf');

        // JavaScript para abrir una ventana emergente
        echo "<script>";
        echo "var win = window.open('factura.pdf', '_blank', 'width=400,height=600');";
        echo "if(win){";
        echo "    win.focus();";
        echo "} else {";
        echo "    alert('Por favor, habilite las ventanas emergentes para ver la factura.');";
        echo "}";
        echo "</script>";
    }
}

$factura = new ImprimirFactura1();
$factura->codigo = $_GET["codigo"];
$factura->traerImpresionFactura1();
?>
