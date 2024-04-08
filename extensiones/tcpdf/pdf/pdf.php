<?php

require_once "../../../controladores/ventas.controlador.php";
require_once "../../../modelos/ventas.modelo.php";

require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";

// Requiere la clase TCPDF y las configuraciones
require_once('tcpdf_include.php');

class ImprimirFactura {

    public $codigo;
    public function imprimirFactura() {
    if (isset($_GET["tipo"])) {
      $tipo = $_GET["tipo"];
      switch ($tipo) {
          case "ventas":
              $this->codigo = $_GET["codigo"];
              $this->traerImpresionFacturaVentas();
              break;
          case "compras":
              $this->codigo = $_GET["codigo"];
              $this->traerImpresionFacturaCompras();
              break;
          default:
              echo "Tipo de factura no válido.";
              break;
      }
  } else {
      echo "Tipo de factura no especificado.";
  }
    }
    public function traerImpresionFacturaVentas() {
        // Traer la información de la venta
        $itemVenta = "codigo";
        $valorVenta = $this->codigo;
        $respuestaVenta = ControladorVentas::ctrMostrarVentas($itemVenta, $valorVenta); 

        // Obtener la información necesaria de la venta
        $fecha = substr($respuestaVenta["fecha"], 0, -8);
        $productos = json_decode($respuestaVenta["productos"], true);
        $neto = number_format($respuestaVenta["neto"], 2);
        $impuesto = number_format($respuestaVenta["impuesto"], 2);
        $total = number_format($respuestaVenta["total"], 2);

        // Traer la información del cliente
        $itemCliente = "id";
        $valorCliente = $respuestaVenta["id_cliente"];
        $respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

        // Traer la información del vendedor
        $itemVendedor = "id";
        $valorVendedor = $respuestaVenta["id_vendedor"];
        $respuestaVendedor = ControladorUsuarios::ctrMostrarUsuarios($itemVendedor, $valorVendedor);

        // Crear instancia de TCPDF
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // Agregar una página
        $pdf->AddPage();

        // Contenido de la factura de ventas
        $html = <<<EOF

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
                <td style="background-color:white; width:110px; text-align:center; color:red"><br><br>FACTURA N.<br>$valorVenta</td>
            </tr>
        </table>

        EOF;

        $pdf->writeHTML($html, false, false, false, false, '');

        // Continúa con el resto del contenido de la factura de ventas...

        // ---------------------------------------------------------
        // Output del archivo
        ob_end_clean();
        $pdf->Output('factura_ventas.pdf');
    }

    public function traerImpresionFacturaCompras() {
      // Traer la información de la compra
      $itemCompra = "codigo"; // O el nombre correcto del campo en la base de datos para identificar la compra
      $valorCompra = $this->codigo; // O el valor adecuado para identificar la compra
      $respuestaCompra = ControladorCompras::ctrMostrarCompras($itemCompra, $valorCompra); // Ajusta el controlador y el modelo adecuados para las compras
      $fecha = "Fecha de la compra";
      $proveedor = "Proveedor de la compra";
      $neto = "Neto de la compra";
      $impuesto = "Impuesto de la compra";
      $total = "Total de la compra";
      // Obtener la información necesaria de la compra
      $fecha = substr($respuestaCompra["fecha"], 0, -8); // Ajusta el formato según tu base de datos
      $productos = json_decode($respuestaCompra["productos"], true); // Ajusta el nombre del campo según tu base de datos
      $neto = number_format($respuestaCompra["neto"], 2); // Ajusta el nombre del campo según tu base de datos
      $impuesto = number_format($respuestaCompra["impuesto"], 2); // Ajusta el nombre del campo según tu base de datos
      $total = number_format($respuestaCompra["total"], 2); // Ajusta el nombre del campo según tu base de datos
  
      // Traer la información del proveedor (si es necesario)
      $itemProveedor = "id"; // O el nombre correcto del campo en la base de datos para identificar el proveedor
      $valorProveedor = $respuestaCompra["id_proveedor"]; // O el valor adecuado para identificar el proveedor
      $respuestaProveedor = ControladorProveedores::ctrMostrarProveedores($itemProveedor, $valorProveedor); // Ajusta el controlador y el modelo adecuados para los proveedores
  
      // Crear instancia de TCPDF
      $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
  
      // Agregar una página
      $pdf->AddPage();
  
      // Contenido de la factura de compras
      $html = <<<EOF

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
                        compras@inventorysystem.com
                    </div>
                </td>
                <td style="background-color:white; width:110px; text-align:center; color:red"><br><br>FACTURA N.<br>$valorCompra</td>
            </tr>
        </table>

        EOF;
  
      $pdf->writeHTML($html, false, false, false, false, '');
  
      // Continúa con el resto del contenido de la factura de compras...
  
      // ---------------------------------------------------------
      // Output del archivo
      ob_end_clean();
      $pdf->Output('factura_compras.pdf');
  }
  
}

$factura = new ImprimirFactura();

if (isset($_GET["tipo"]) && $_GET["tipo"] === "ventas") {
    
    $factura->codigo = $_GET["codigo"];
    $factura->traerImpresionFacturaVentas();
} elseif (isset($_GET["tipo"]) && $_GET["tipo"] === "compras") {
   
    $factura->codigo = $_GET["codigo"];
    $factura->traerImpresionFacturaCompras();
} else {
    
    echo "Tipo de factura no válido.";
}

?>
