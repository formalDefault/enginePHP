<?php
session_start();
if($_SESSION[admin_id_pub]){
include "config.php";
$pagina="Solicitud de vacaciones";

//CONFIGURACION DE PAGINA
$color_form="naranja";
$color_imprimir="naranja";
$color_botones="blanco";
$url="rh_emp_vacaciones.php";
$nomb_tabla="rh_solicitud_vacaciones";
$nombre_formulario="Solicitud de vacaciones";
$titulo_boton_agregar="Agregar";
$genera_reportes="si";
$imp_id="";	//mostrar id en imprimir  

//ELEMENTOS DE FORMULARIO Solicitud de Vacaciones
$array_variables=array(
	array("Fecha","fecha","date","","","","require='require'","4","date","NOT NULL","si","","","")
   ,array("Fecha De Ingreso","fecha_ingreso","date","","","","require='require'","4","date","NOT NULL","si","","","")
   ,array("Dias a tomar","dias_a_tomar","number","","","","require='require'","4","int (2)","NOT NULL","si","","","")
   ,array("Periodo de Vacaciones","","salto_linea","","","","","","","","","","","")//salto de linea 
   ,array("Inicio De Vacaciones","inicio_vacaciones","date","","","","require='require'","4","date","NOT NULL","si","","","")
   ,array("Termino De Vacaciones","termino_vacaciones","date","","","","require='require'","4","date","NOT NULL","si","","","")
   ,array("Año De Trabajo Correspondiente","anio_trabajo_correspondiente","number","NOT NULL","","","require='require'","4","int","NOT NULL","","","","")
   ,array("Firma Autorizacion Coordinador del programa","firma_autorizacion_coord","select_x","NOT NULL","","|Si=si|No=no","required='required'","6","VARCHAR (50)","NOT NULL","","","","")
   ,array("Firma Empleado","firma_empleado","select_x","","","|Si=si|No=no","required='required'","6","VARCHAR (50)","NOT NULL","","","","")
   ,array("Observaciones","observaciones","textarea","","","","style='resize: none'","12","text","NOT NULL","si","","","")
   ,array("","id_empleado","hiddenInsert","","","","","","INT (8)","NOT NULL","","","","")
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