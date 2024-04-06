<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["editarFoto"])) {
    $rutaNuevaFoto = ControladorUsuarios::ctrEditarFotoPerfil();
    $_SESSION["foto"] = $rutaNuevaFoto;
}

$ventas = array("total" => 0.00);

$item = null;
$valor = null;
$orden = "id";

// Instanciar la clase ControladorVentas
$controladorVentas = new ControladorVentas();

// Llamar al método ctrSumaTotalVentas()
$totalVentas = $controladorVentas->ctrSumaTotalVentas();

// Verificar si $totalVentas tiene un valor válido antes de asignarlo a $ventas
if(isset($totalVentas["total"])) {
    $ventas = $totalVentas;
}

$categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);
$totalCategorias = count($categorias);

$clientes = ControladorClientes::ctrMostrarClientes($item, $valor);
$totalClientes = count($clientes);

$productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden, 5); // Limitar a 5 productos
$totalProductos = count($productos);

?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Perfil de usuario</h1>
        <ol class="breadcrumb">
            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Perfil de usuario</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-3">
                        <img src="<?php echo $_SESSION['foto'] ? $_SESSION['foto'] : 'vistas/img/usuarios/default/anonymous.png'; ?>" class="img-responsive img-thumbnail" alt="Foto de perfil">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editarFotoModal">Editar Foto</button>
                    </div>
                    <div class="col-md-9">
                        <h3>Datos del usuario</h3>
                        <p><strong>Nombre:</strong> <?php echo htmlspecialchars($_SESSION['nombre']); ?></p>
                        <p><strong>Usuario:</strong> <?php echo htmlspecialchars($_SESSION['usuario']); ?></p>
                        <p><strong>Perfil:</strong> <?php echo htmlspecialchars($_SESSION['perfil']); ?></p>
                        <?php 
                            // Dependiendo del perfil del usuario, mostrar diferentes secciones
                            if ($_SESSION['perfil'] == 'Vendedor') {
                                // Mostrar gráficas de cantidad vendida
                                include(__DIR__ . '/inicio/cajas-superiores.php');
                            } elseif ($_SESSION['perfil'] == 'Administrador') {
                                // Mostrar cantidad vendida y productos
                                include(__DIR__ . '/inicio/cajas-superiores.php');
                                echo "ㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤ";
                                include(__DIR__ . '/inicio/productos-recientes.php');
                              
                            } elseif ($_SESSION['perfil'] == 'Especial') {
                                // Mostrar productos en inventario
                                include(__DIR__ . '/inicio/productos-recientes.php');
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal -->
<div class="modal fade" id="editarFotoModal" tabindex="-1" role="dialog" aria-labelledby="editarFotoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data" id="editarFotoForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="editarFotoModalLabel">Editar Foto de Perfil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="file" name="editarFoto" class="form-control-file">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById("editarFotoForm").addEventListener("submit", function(event) {
        event.preventDefault(); // Prevenir el envío del formulario normalmente
        var formData = new FormData(this); // Crear un objeto FormData con los datos del formulario
        // Enviar el formulario mediante AJAX
        fetch(window.location.href, {
                method: "POST",
                body: formData
            })
            .then(response => {
                if (response.ok) {
                    // Recargar la página después de enviar el formulario exitosamente
                    window.location.reload();
                } else {
                    console.error("Error al enviar el formulario:", response.statusText);
                }
            })
            .catch(error => {
                console.error("Error en la solicitud:", error);
            });
    });
</script>
