<?php
// Obtener productos
$item = null;
$valor = null;
$orden = "id";
$productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

?>

<div class="box box-primary">

  <div class="box-header with-border">

    <h3 class="box-title">Recently Added Products</h3>

    <div class="box-tools pull-right">

      <button type="button" class="btn btn-box-tool" data-widget="collapse">

        <i class="fa fa-minus"></i>

      </button>

      <button type="button" class="btn btn-box-tool" data-widget="remove">

        <i class="fa fa-times"></i>

      </button>

    </div>

  </div>
  
  <div class="box-body">

    <ul class="products-list product-list-in-box">

    <?php
    // Verificar si el array $productos está definido y no está vacío
    if(isset($productos) && is_array($productos) && count($productos) > 0) {
        // Iterar sobre los primeros 5 elementos del array $productos
        for($i = 0; $i < min(5, count($productos)); $i++) {
            // Verificar si el índice actual existe en el array $productos
            if(isset($productos[$i])) {
                // Acceder a los datos del producto en el índice actual
                $producto = $productos[$i];
                // Mostrar el producto en la interfaz
                echo '<li class="item">
                    <div class="product-img">
                        <img src="'.$producto["imagen"].'" alt="Product Image">
                    </div>
                    <div class="product-info">
                        <a href="" class="product-title">
                            '.$producto["descripcion"].'
                            <span class="label label-warning pull-right">$'.$producto["precio_venta"].'</span>
                        </a>
                    </div>
                </li>';
            }
        }
    } else {
        // No hay productos disponibles
        echo "No hay productos disponibles.";
    }
    ?>

    </ul>

  </div>

  <div class="box-footer text-center">

    <a href="productos" class="uppercase">Ver todos los productos</a>
  
  </div>

</div>
