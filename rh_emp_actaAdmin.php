<?php
session_start();
if($_SESSION[admin_id_pub]){
include "config.php";
$pagina="Capacitaciones";

//CONFIGURACION DE PAGINA
$color_form="naranja";
$color_imprimir="naranja";
$color_botones="blanco";
$url="rh_emp_actaAdmin.php";
$nomb_tabla="rh_acta_administrativa";
$nombre_formulario="Acta administrativa";
$titulo_boton_agregar="Agregar nueva acta";
$genera_reportes="si";
$imp_id="";	//mostrar id en imprimir  
 

// Acta administrativa
$array_variables=array(
//   array("Acta Administrativa","","salto_linea","","","","","","","","","","","")//salto de linea 
  array("Fecha","fecha","date","","","","required","4","date","NOT NULL","si","","","")  
 ,array("Hechos","hechos","text","","","","required","4","text","NOT NULL","si","","","")
 ,array("Testigos","testigos","text","","","","required","4","text","NOT NULL","si","","","")
 ,array("Declaracion","declaracion","textarea","","","","required style='resize:none'","12","text","NOT NULL","si","","","")
 ,array("Descripcion","descripcion","textarea","","","","required style='resize:none'","12","text","NOT NULL","si","","","")
 ,array("","id_empleado","hiddenInsert","","","","","","INT (11)","NOT NULL","","","","")
); 
 
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<title><?php echo $title_sitio; ?></title>
	<meta name="description" content="Sistema de Administracion DIF Guadalajara" />
	<meta name="keywords" content="" tent="DIF Guadalajara" />
	<meta name="author" content="Francisco J. Alvarado"/>	
	<!-- Favicon -->
	<!-- Favicon -->
	<link rel="shortcut icon" href="favicon.ico">
	<link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Sweet-Alert  -->
    <link href="vendors/bower_components/sweetalert/dist/sweetalert.css" rel="stylesheet" type="text/css">
    
    <!-- Custom CSS -->
    <link href="dist/css/style.css" rel="stylesheet" type="text/css">    
    <script src="vendors/bower_components/sweetalert/dist/sweetalert.min.js"></script>

    <script src="vendors/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="dist/js/sweetalert-data.js"></script> 	

    <!-- Summernote -->
  <script>
    $(document).ready(function() {
        $('#summernote').summernote();
    });
  </script>
    <link href="dist/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Jquery -->
<script type="text/javascript">
  $(document).ready(function() 
  {

  });
</script>	<!-- Custom CSS -->
	

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
			include "contenido_engine_rh.php"; //Cambiar PHP de contenido
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