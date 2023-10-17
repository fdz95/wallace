<?php
	session_start();
	if(isset($_SESSION['user_wallace'])){
		$login_user = "";
		$login_user = $_SESSION['user_wallace'];
		$user_name = "USUARIO";
		$user_email = "";
		require_once ("ajax/conexion.php");
		$query_select_user = "SELECT * FROM t_users WHERE estado = 'A' AND user = '$login_user';";
		$result_select_user = mysqli_query($conexion,$query_select_user);
		if($result_select_user){
			$columna = mysqli_fetch_assoc($result_select_user);
			$user_name = $columna['nombre'];
			$user_lastname = $columna['apellido'];
			$user_type = $columna['tipo'];
		}
		$query_select_config = "SELECT * FROM t_config WHERE Id = '1';";
		$result_select_config = mysqli_query($conexion,$query_select_config);
		if($result_select_config){
			$columna = mysqli_fetch_assoc($result_select_config);
			$version = $columna['version'];
			$author = $columna['author'];
		}
	}else{
		header("Location: login.php");
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta http-equiv="refresh" content="30" />
		
		<title>Wallace - Mas que un bar | Comandas finalizadas</title>
		<!-- Tell the browser to be responsive to screen width -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
		<!-- Theme style -->
		<link rel="stylesheet" href="dist/css/adminlte.min.css">
		
		<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
		
		<!-- Icono -->   
		<link rel="icon" href="img/logo_wallace.ico">
	</head>
	<body class="hold-transition sidebar-mini layout-fixed">
		<div class="wrapper">
			<!-- Navbar -->
			<nav class="main-header navbar navbar-expand navbar-white navbar-light">
				<!-- Left navbar links -->
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
					</li>
					<div class="col-sm-6">
						<ul class="nav navbar-nav navbar-right">
							<li class="nav-item d-none d-sm-inline-block">
								<a href="index.php" class="nav-link">Inicio</a>
							</li>
						</ul>
					</div>
				</ul>
			</nav>
			<!-- /.navbar -->
			<!-- Main Sidebar Container -->
			<aside class="main-sidebar sidebar-dark-primary elevation-4">
				<!-- Brand Logo -->
				<a href="index.php" class="brand-link">
					<img src="img/logo_wallace.jpg" alt="Wallace logo" class="brand-image img-circle elevation-3" style="opacity: .8">
					<span class="brand-text font-weight-light">Wallace</span>
				</a>
				<!-- Sidebar -->
				<div class="sidebar">
					<!-- Sidebar user panel (optional) -->
					<div class="user-panel mt-3 pb-3 mb-3 d-flex">
						<div class="info">
							<a href="#" class="d-block"><?php echo $user_name ." ". $user_lastname; ?></a>
							<a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span><b>Cerrar sesi&oacute;n</b></a>
						</div>
					</div>
			  
					<!-- Sidebar Menu -->
					<nav class="mt-2">
						<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
							<!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
							<li class="nav-item has-treeview menu-open">
								<a href="#" class="nav-link active">
									<i class="nav-icon fas fa-tachometer-alt"></i><p> Inicio <i class="right fas fa-angle-left"></i></p>
								</a>
								<ul class="nav nav-treeview">
									<?php
										if($user_type == "ADMIN"){
											echo '<li class="nav-item"><a href="./index.php" class="nav-link"><i class="fas fa-utensils"></i>&nbsp;&nbsp;<p>Mesas</p></a></li>
												<li class="nav-item"><a href="./clientes.php" class="nav-link"><i class="fas fa-users"></i>&nbsp;&nbsp;<p>Control de clientes</p></a></li>
												<li class="nav-item"><a href="./recibos.php" class="nav-link"><i class="fas fa-dollar-sign"></i>&nbsp;&nbsp;<p>Recibos</p></a></li>
												<li class="nav-item"><a href="./articulos.php" class="nav-link"><i class="fas fa-list-ul"></i>&nbsp;&nbsp;<p>Control de articulos</p></a></li>
												<li class="nav-item"><a href="./comandas.php" class="nav-link"><i class="fas fa-th-list"></i>&nbsp;&nbsp;<p>Comandas pendientes</p></a></li>
												<li class="nav-item"><a href="./comandasF.php" class="nav-link active"><i class="fas fa-tasks"></i>&nbsp;&nbsp;<p>Comandas finalizadas</p></a></li>
												<li class="nav-item"><a href="./estadisticas.php" class="nav-link"><i class="fas fa-chart-line"></i>&nbsp;&nbsp;<p>Estadisticas</p></a></li>
												<li class="nav-item"><a href="./usuarios.php" class="nav-link"><i class="fas fa-user"></i>&nbsp;&nbsp;<p>Usuarios</p></a></li>
												<li class="nav-item"><a href="./config.php" class="nav-link"><i class="fas fa-cog"></i>&nbsp;&nbsp;<p>Configuracion</p></a></li>';
										}else if($user_type == "COCINA"){
											echo '<li class="nav-item"><a href="./comandas.php" class="nav-link"><i class="fas fa-th-list"></i>&nbsp;&nbsp;<p>Comandas pendientes</p></a></li>
												<li class="nav-item"><a href="./comandasF.php" class="nav-link active"><i class="fas fa-tasks"></i>&nbsp;&nbsp;<p>Comandas finalizadas</p></a></li>';
										}
									?>
								</ul>
							</li>
						</ul>
					</nav>
					<!-- /.sidebar-menu -->
				</div>
				<!-- /.sidebar -->
			</aside>

			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<div class="content-header">
					<div class="container-fluid">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1 class="m-0 text-dark">Comandas finalizadas</h1>
							</div><!-- /.col -->
							<div class="col-sm-6">
								<ol class="breadcrumb float-sm-right">
									<li class="breadcrumb-item"><a href="#">Inicio</a></li>
									<li class="breadcrumb-item active">Comandas finalizadas</li>
								</ol>
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.container-fluid -->
				</div>
				<!-- /.content-header -->
				
				<!-- Main content -->
				<section class="content">
					<div class="container-fluid">
						<div class="row">
							<div class="col-12">
								<div class="card">
									<!-- Main content -->
									<div id="response_comandasF"></div>
									<div class='outer_div_comandasF'></div>
								</div>
								<!-- /.card -->
							</div>
							<!-- /.col -->
						</div>
						<!-- /.row -->
						<!-- /.row -->
					</div>
				  <!-- /.container-fluid -->
				</section>
				<!-- /.section -->
			</div>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->
		
		<footer class="main-footer">
			<strong>Copyright &copy; <?php echo date('Y'); ?> <a href="#"><?php echo $author; ?></a>.</strong> All rights reserved.
			<div class="float-right d-none d-sm-inline-block"><b>Version</b> <?php echo $version;?></div>
		</footer>
		<!-- ./wrapper -->
		
		<!-- jQuery -->
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<!-- jQuery -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<!-- Bootstrap -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		<!-- Funciones -->
		<script src="js/scriptComandasF.js"></script>
		<!-- AdminLTE App -->
		<script src="dist/js/adminlte.js"></script>
	</body>
</html>