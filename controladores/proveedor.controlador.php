<?php


class ControladorProveedores{

	/*=============================================
	CREAR PROVEEDORES
	=============================================*/

	static public function ctrCrearProveedor(){

		if(isset($_POST["nuevoProveedor"])){
	
			// Validar el nombre del proveedor
			if(!preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoProveedor"])){
	
				echo '<script>
				swal({
					type: "error",
					title: "¡Error!",
					text: "El nombre del proveedor no puede estar vacío ni contener caracteres especiales",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"
				}).then(function(result){
					if (result.value) {
						window.location = "proveedores";
					}
				});
				</script>';
				
				return; // Detener la ejecución del script
	
			}
	
			// Validar el teléfono del proveedor
			if(!preg_match('/^[()\-0-9 ]+$/', $_POST["nuevoTelefonoProveedor"])){
	
				echo '<script>
				swal({
					type: "error",
					title: "¡Error!",
					text: "El teléfono del proveedor no es válido",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"
				}).then(function(result){
					if (result.value) {
						window.location = "proveedores";
					}
				});
				</script>';
				
				return; // Detener la ejecución del script
	
			}
	
			// Validar la dirección del proveedor
			if(!preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["nuevaDireccionProveedor"])){
	
				echo '<script>
				swal({
					type: "error",
					title: "¡Error!",
					text: "La dirección del proveedor no es válida",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"
				}).then(function(result){
					if (result.value) {
						window.location = "proveedores";
					}
				});
				</script>';
				
				return; // Detener la ejecución del script
	
			}
	
			// Si todas las validaciones pasan, procedemos a crear el proveedor
			$tabla = "proveedores";
	
			$datos = array(
				"nombre" => $_POST["nuevoProveedor"],
				"telefono" => $_POST["nuevoTelefonoProveedor"],
				"direccion" => $_POST["nuevaDireccionProveedor"]
			);
	
			$respuesta = ModeloProveedor::mdlIngresarProveedor($tabla, $datos);
	
			if($respuesta == "ok"){
	
				echo '<script>
				swal({
					type: "success",
					title: "¡Éxito!",
					text: "El proveedor ha sido guardado correctamente",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"
				}).then(function(result){
					if (result.value) {
						window.location = "proveedores";
					}
				});
				</script>';
	
			} else {
	
				echo '<script>
				swal({
					type: "error",
					title: "¡Error!",
					text: "Ocurrió un error al guardar el proveedor",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"
				}).then(function(result){
					if (result.value) {
						window.location = "proveedores";
					}
				});
				</script>';
	
			}
	
		}
	
	}
	

	/*=============================================
	MOSTRAR PROVEEDORES
	=============================================*/

	static public function ctrMostrarProveedores($item, $valor){

		$tabla = "proveedores";

		$respuesta = ModeloProveedor::mdlMostrarProveedores($tabla, $item, $valor);

		return $respuesta;

	}


	
		/*=============================================
		EDITAR PROVEEDOR
		=============================================*/
		static public function ctrEditarProveedor(){

			if(isset($_POST["editarProveedor"])){
	
				if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarProveedor"]) &&
				preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["editarDireccion"]) &&
				   preg_match('/^[()\-0-9 ]+$/', $_POST["editarTelefono"]) 
				   ){
	
					   $tabla = "proveedores";
	
					   $datos = array("id"=>$_POST["idProveedor"],
									  "nombre"=>$_POST["editarProveedor"],
									  "direccion"=>$_POST["editarDireccion"],
								   "telefono"=>$_POST["editarTelefono"]
								 
							);
	
					   $respuesta = ModeloProveedor::mdlEditarProveedor($tabla, $datos);
	
					   if($respuesta == "ok"){
	
						echo'<script>
	
						swal({
							  type: "success",
							  title: "El proveedor ha sido cambiado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {
	
										window.location = "proveedores";
	
										}
									})
	
						</script>';
	
					}
	
				}else{
	
					echo'<script>
	
						swal({
							  type: "error",
							  title: "¡El proveedor no puede ir vacío o llevar caracteres especiales!",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
								if (result.value) {
	
								window.location = "proveedores";
	
								}
							})
	
					  </script>';
	
	
	
				}
	
			}
	
		}
	
	
	
	/*=============================================
	ELIMINAR PROVEEDOR
	=============================================*/

	static public function ctrEliminarProveedor(){

		if(isset($_GET["idProveedor"])){

			$tabla ="proveedores";
			$datos = $_GET["idProveedor"];

			$respuesta = ModeloProveedor::mdlEliminarProveedor($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El proveedor ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
								if (result.value) {

								window.location = "proveedores";

								}
							})

				</script>';

			}		

		}

	}

}
