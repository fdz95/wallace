<?php
	/*session_start();
	if(isset($_SESSION['user_wallace'])){
		$login_user = "";
		$login_user = $_SESSION['user_wallace'];
		$user_name = "USUARIO";
		$user_email = "";
		$query_select_user = "SELECT * FROM t_users WHERE estado = 'A' AND user = '$login_user';";
		$result_select_user = mysqli_query($conexion,$query_select_user);
		if($result_select_user){
			$columna = mysqli_fetch_assoc($result_select_user);
			$user_name = $columna['nombre'];
			$user_lastname = $columna['apellido'];
			$user_type = $columna['tipo'];
		}*/
		require_once ("ajax/conexion.php");
		$query_select_config = "SELECT * FROM t_config WHERE Id = '1';";
		$result_select_config = mysqli_query($conexion,$query_select_config);
		if($result_select_config){
			$columna = mysqli_fetch_assoc($result_select_config);
			$version = $columna['version'];
			$author = $columna['author'];
		}
	/*}else{
		header("Location: login.php");
	}*/
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Wallace - Mas que un bar | Estadisticas</title>
		<!-- Tell the browser to be responsive to screen width -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
		<!-- Theme style -->
		<link rel="stylesheet" href="dist/css/adminlte.min.css">
		<!-- Icono -->   
		<link rel="icon" href="img/logo_wallace.ico">
		<!-- daterange picker -->
		<link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
		<!-- Tempusdominus Bbootstrap 4 -->
		<link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
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
				</ul>
			</nav>
			<!-- /.navbar -->
			<!-- Main Sidebar Container -->
			<aside class="main-sidebar sidebar-dark-primary elevation-4">
				<!-- Brand Logo -->
				<a href="#" class="brand-link">
					<img src="img/logo_wallace.jpg" alt="Wallace logo" class="brand-image img-circle elevation-3" style="opacity: .8">
					<span class="brand-text font-weight-light">Wallace</span>
				</a>
				<!-- Sidebar -->
				<div class="sidebar">
					<!-- Sidebar user panel (optional) -->
					<div class="user-panel mt-3 pb-3 mb-3 d-flex">
						<div class="info">
							<a href="#" class="d-block">Administrador</a>
						</div>
					</div>
				</div>
				<!-- /.sidebar -->
			</aside>

			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<div class="content-header">
					<div class="container-fluid">
						<div class="row mb-3">
							<div class="col-sm-6">
								<a href="mEstadisticas.php"><h1 class="m-0 text-dark">Estadisticas <i class="fas fa-sync-alt"></i></h1></a>
							</div><!-- /.col -->
							<div id="loader_Mestadistica"></div>
						</div><!-- /.row -->
					</div><!-- /.container-fluid -->
				</div>
				<!-- /.content-header -->
				
				<!-- Main content -->
				<section class="content">
					<div class="container-fluid">
						<div class="row">
							<div class="col-12">
								<!--<div class="card">
									<div class="card-header">
										<h3><b>Ingresos mensuales</b></h3>
									</div>
									<div id="loader"></div>
									<div id="response"></div>
									<div class='outer_div'></div>
								</div>-->
								<div class="card">
									<div class="card-header">
										<h3><b>Ingresos mensuales</b></h3>
									</div>
									<div id="loader_mensuales"></div>
									<div class='outer_div_mensuales'></div>
								</div>
								<div class="card">
									<div class="card-header">
										<h3><b>Ingresos mensuales Pool</b></h3>
									</div>
									<div class="card-body">
										<div id="loader_pool"></div>
										<div class='outer_div_pool'></div>
									</div>
								</div>
								<!-- /.card -->
							</div>
							<!-- /.col -->
						</div>
						<!-- /.row -->
					</div>
					<!-- /.container-fluid -->
				</section>
				<!-- /.content -->
			</div>
			<!-- /.content-wrapper -->
		</div>
		
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
		
		<!-- DataTables -->
		<script src="../adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="../adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
		<script src="../adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
		<script src="../adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
		
		<!-- Funciones -->
		<script src="js/scriptMestadisticas.js"></script>
		<!-- AdminLTE App -->
		<script src="dist/js/adminlte.js"></script><!-- page script -->
		<script>
		  $(function () {
			$("#example1").DataTable({
			  "responsive": true,
			  "autoWidth": false,
			});
			$('#example2').DataTable({
			  "paging": true,
			  "lengthChange": false,
			  "searching": false,
			  "ordering": true,
			  "info": true,
			  "autoWidth": false,
			  "responsive": true,
			});
		  });
		</script>
	</body>
</html>