
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar proveedores
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar proveedores</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProveedor">
          
          Agregar proveedor

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Nombre</th>

           <th>Teléfono</th>
           <th>Dirección</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>
          
          <tr>

            <td>1</td>

            <td>Juan Villegas</td>

          

            <td>555 57 67</td>

            <td>calle 27 # 40 - 36</td>

            <td>

              <div class="btn-group">
                  
                <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>

                <button class="btn btn-danger"><i class="fa fa-times"></i></button>

              </div>  

            </td>

          </tr>

          
        </tbody>

       </table>

      </div>

    </div>

  </section>

  <!-- MODAL AGREGAR PROVEEDOR -->
  <div id="modalAgregarProveedor" class="modal fade" role="dialog">
  
    <div class="modal-dialog">

      <div class="modal-content">

        <form role="form" method="post">

          <!-- CABEZA DEL MODAL -->
          <div class="modal-header" style="background:#3c8dbc; color:white">

            <button type="button" class="close" data-dismiss="modal">&times;</button>

            <h4 class="modal-title">Agregar proveedor</h4>

          </div>

          <!-- CUERPO DEL MODAL -->
          <div class="modal-body">

            <div class="box-body">

              <!-- ENTRADA PARA EL NOMBRE -->
              <div class="form-group">
                
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                  <input type="text" class="form-control input-lg" name="nuevoProveedor" placeholder="Ingresar nombre" required>

                </div>

              </div>

              <!-- ENTRADA PARA EL TELÉFONO -->
              <div class="form-group">
                
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                  <input type="text" class="form-control input-lg" name="nuevoTelefonoProveedor" placeholder="Ingresar teléfono" data-inputmask="'mask':'(999) 999-9999'" data-mask required>

                </div>

              </div>

              <!-- ENTRADA PARA LA DIRECCIÓN -->
              <div class="form-group">
                
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                  <input type="text" class="form-control input-lg" name="nuevaDireccionProveedor" placeholder="Ingresar dirección" required>

                </div>

              </div>
  
            </div>

          </div>

          <!-- PIE DEL MODAL -->
          <div class="modal-footer">

            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

            <button type="submit" class="btn btn-primary">Guardar proveedor</button>

          </div>

        </form>

      </div>

    </div>

  </div>
</div>