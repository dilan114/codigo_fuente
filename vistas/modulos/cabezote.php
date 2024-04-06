 <header class="main-header">
 	
	<!--=====================================
	LOGOTIPO
	======================================-->
    <a href="escritorio.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>SIS</b> V</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>SIS</b> VENTAS</span>
    </a>

	<!--=====================================
	BARRA DE NAVEGACIÓN
	======================================-->
	<nav class="navbar navbar-static-top" role="navigation">
		
		<!-- Botón de navegación -->

	 	<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        	
        	<span class="sr-only">Toggle navigation</span>
      	
      	</a>

<!-- perfil de usuario -->
<div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
        <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <?php
                // Verifica si la foto de perfil está definida y no está vacía
                if(isset($_SESSION["foto"]) && !empty($_SESSION["foto"])){
                    echo '<img src="'.$_SESSION["foto"].'" class="user-image">';
                }else{
                    // Si no hay foto de perfil, muestra una imagen predeterminada
                    echo '<img src="vistas/img/usuarios/default/anonymous.png" class="user-image">';
                }
                ?>
                <span class="hidden-xs"><?php echo $_SESSION["nombre"]; ?></span>
            </a>
            <!-- Dropdown-toggle -->
            <ul class="dropdown-menu">
                <li class="user-header">
                    <!-- Aquí puedes incluir la imagen del usuario si tienes esa información -->
                    <p>
                      
					
<?php
// Verifica si la foto de perfil está definida y no está vacía
if(isset($_SESSION["foto"]) && !empty($_SESSION["foto"])){
    // Agrega clases CSS para hacer la imagen más grande y centrada
    echo '<img src="'.$_SESSION["foto"].'" class="user-image img-circle" style="width: 100px; height: 100px; object-fit: cover; object-position: center;">';
}else{
    // Si no hay foto de perfil, muestra una imagen predeterminada
    echo '<img src="vistas/img/usuarios/default/anonymous.png" class="user-image img-circle" style="width: 100px; height: 100px; object-fit: cover; object-position: center;">';
}
?>
<br>
					Perfil: <?php echo isset($_SESSION["perfil"]) ? $_SESSION["perfil"] : "Nombre de usuario no disponible"; ?>
					  <!-- Verifica si la variable de sesión está definida antes de mostrarla -->
					  Usuario: <?php echo isset($_SESSION["nombre"]) ? $_SESSION["nombre"] : "Nombre de usuario no disponible"; ?>
                    </p>
                </li>
				<li class="user-body">
    <div class="pull-right">
        <a href="salir" class="btn btn-primary btn-flat btn-danger text-white" style="margin-right: 10px;">Salir</a>
    </div>
	<div class="pull-right">
       <p>ㅤㅤㅤㅤㅤㅤㅤ</p>	
    </div>
    <div class="pull-right">
        <a href="perfil" class="btn btn-primary text-white">perfil</a>
    </div>
</li>


            </ul>
        </li>
    </ul>
</div>




				

	</nav>

 </header>