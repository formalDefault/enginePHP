<?php
session_start();
if($_SESSION[admin_id_pub]){
include "config.php";
$pagina="Agregar Asignaciones Extra";  

//CONFIGURACION DE PAGINA
$color_form="naranja";
$color_imprimir="naranja";
$color_botones="blanco";
$url="vh_asignaciones_extra.php";
$nomb_tabla="vh_asignaciones_extra";
$nombre_formulario="Asignaciones Extra";
$titulo_boton_agregar="Agregar Asignacion extra";
$genera_reportes="si";
$imp_id="";	//mostrar id en imprimir 
 
$array_variables = array(

  array("*Fecha de salida","fecha_inicial","date","","","","' required","4","DATE","NOT NULL","si","","","")
  ,array("*Hora de salida","hora_inicial","time","","","","' required","4","TIME","NOT NULL","","","","")
  ,array("*Kilometraje inicial","kilometraje_inicial","number","","","","required","4","INT","NOT NULL","si","","","")
  ,array("*Solicitante","id_solicitante","select_sql","view_empleados","nombre_completo",""," required","4","INT","NOT NULL","si","","","") 
  ,array("Fecha de regreso","fecha_final","date","","","","' ","4","DATE","NOT NULL","si","","","")
  ,array("Hora de regreso","hora_final","time","","","","' ","4","TIME","NOT NULL","","","","")
  ,array("Kilometraje Final","kilometraje_final","number","","","","","4","INT","NOT NULL","si","","","")
  ,array("*Estatus","id_estado","select_x","","","|Asignado=1|Regresado=2","required","4","INT","NOT NULL","si","","","")
  ,array("Observaciones","observaciones","textarea","","","","","12","TEXT","NOT NULL","","","","") 

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
			include "contenido_engine_vh.php"; //Cambiar PHP de contenido
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