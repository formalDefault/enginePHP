<?php
session_start();
if($_SESSION[admin_id_pub]){
include "config.php";

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<title><?php echo $title_sitio; ?></title>
	<meta name="description" content="Sistema 14" />
	<meta name="keywords" content="" tent="Sistema 14" />
	<meta name="author" content="Francisco J. Alvarado"/>	

	<!-- Favicon -->
	<link rel="shortcut icon" href="assets/logo.ico">

  <!-- Sweet-Alert  -->
  <link href="vendors/bower_components/sweetalert/dist/sweetalert.css" rel="stylesheet" type="text/css">
    
  <!-- Custom CSS -->
  <link href="dist/css/style.css" rel="stylesheet" type="text/css">    
	<script src="vendors/bower_components/sweetalert/dist/sweetalert.min.js"></script>
	<!--<link rel="stylesheet" href="styles/dashboard-style.css">-->

	<!-- jQuery -->
  <script src="vendors/bower_components/jquery/dist/jquery.min.js"></script>

  <!-- Bootstrap Core JavaScript -->
  <script src="vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="dist/js/sweetalert-data.js"></script>
<link href="dist/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<!-- Chart.js -->
	<script src="dist-new/chart/Chart.bundle.js"></script>
</head>

<body>
	<!-- Preloader -->
	<div class="preloader-it">
		<div class="la-anim-1"></div>
	</div>
	<!-- /Preloader -->
    <div class="wrapper">
			<!-- Top Menu Items -->
			<?php 
			include "barra_nav.php";
			include "barra_izquierda.php";
			include "barra_derecha.php";
			include "rh_emp_atencion.php"; 
			@include "funciones.php";  
			$area=obten("area");
			$coordinacion=obten("coordinacion");
			if(!$coordinacion){
			include "contenido_index.php";
			}elseif($coordinacion=="dirgral"){
			include "contenido_index.php";

			}
			?>
	        <!-- /Main Content -->  

    </div>
    <!-- /#wrapper -->
			<?php 
			include "java.php";
			?>

	
</body>

</html>
<?
}else{header("Location: login.php");}
?>