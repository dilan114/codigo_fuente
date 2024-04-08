<?php
class ControladorProveedores {

    /*=============================================
    CREAR PROVEEDORES
    =============================================*/

    static public function ctrCrearProveedor() {

        if(isset($_POST["nuevoProveedor"])) {

            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoProveedor"]) &&
               preg_match('/^[0-9]+$/', $_POST["nuevoDocumento"]) &&
               filter_var($_POST["nuevoEmail"], FILTER_VALIDATE_EMAIL) &&
               preg_match('/^[()\-0-9 ]+$/', $_POST["nuevoTelefono"]) &&
               preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["nuevaDireccion"])) {

                $tabla = "proveedores";

                $datos = array("nombre" => $_POST["nuevoProveedor"],
                               "documento" => $_POST["nuevoDocumento"],
                               "email" => $_POST["nuevoEmail"],
                               "telefono" => $_POST["nuevoTelefono"],
                               "direccion" => $_POST["nuevaDireccion"],
                               "fecha_nacimiento" => $_POST["nuevaFechaNacimiento"],
                               "compras" => 0,
                               "ultima_compra" => date("Y-m-d H:i:s"));

                $respuesta = ModeloProveedor::mdlIngresarProveedor($tabla, $datos);

                if($respuesta == "ok") {

                    echo'<script>

                    swal({
                          type: "success",
                          title: "El proveedor ha sido guardado correctamente",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar"
                          }).then(function(result){
                                    if (result.value) {

                                    window.location = "proveedores";

                                    }
                                })

                    </script>';

                }

            } else {

                echo'<script>

                    swal({
                          type: "error",
                          title: "¡Por favor, verifique que todos los campos sean válidos!",
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
    MOSTRAR PROVEEDORES
    =============================================*/

    static public function ctrMostrarProveedores($item, $valor) {

        $tabla = "proveedores";

        $respuesta = ModeloProveedor::mdlMostrarProveedores($tabla, $item, $valor);

        return $respuesta;

    }

    /*=============================================
    EDITAR PROVEEDOR
    =============================================*/

    static public function ctrEditarProveedor() {

        if(isset($_POST["editarProveedor"])) {

            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarProveedor"]) &&
               preg_match('/^[0-9]+$/', $_POST["editarDocumento"]) &&
               filter_var($_POST["editarEmail"], FILTER_VALIDATE_EMAIL) &&
               preg_match('/^[()\-0-9 ]+$/', $_POST["editarTelefono"]) &&
               preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["editarDireccion"])) {

                $tabla = "proveedores";

                $datos = array("id" => $_POST["idProveedor"],
                               "nombre" => $_POST["editarProveedor"],
                               "documento" => $_POST["editarDocumento"],
                               "email"=>$_POST["editarEmail"],
					           "telefono"=>$_POST["editarTelefono"],
					           "direccion"=>$_POST["editarDireccion"],
					           "fecha_nacimiento"=>$_POST["editarFechaNacimiento"]);

                $respuesta = ModeloProveedor::mdlEditarProveedor($tabla, $datos);

                if($respuesta == "ok") {

                    echo'<script>

                    swal({
                          type: "success",
                          title: "El proveedor ha sido modificado correctamente",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar"
                          }).then(function(result){
                                    if (result.value) {

                                    window.location = "proveedores";

                                    }
                                })

                    </script>';

                }

            } else {

                echo'<script>

                    swal({
                          type: "error",
                          title: "¡Por favor, verifique que todos los campos sean válidos!",
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

    static public function ctrEliminarProveedor() {

        if(isset($_GET["idProveedor"])) {

            $tabla = "proveedores";
            $datos = $_GET["idProveedor"];

            $respuesta = ModeloProveedor::mdlEliminarProveedor($tabla, $datos);

            if($respuesta == "ok") {

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
