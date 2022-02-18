<?php
session_start();
if($_SESSION[admin_id_pub]){
include "config.php";
$pagina="Agregar Proyectos";  

//CONFIGURACION DE PAGINA
$color_form="naranja";
$color_imprimir="naranja";
$color_botones="blanco";
$url="oa_proyectos.php";
$nomb_tabla="oa_proyectos";
$nombre_formulario="Proyectos";
$titulo_boton_agregar="Agregar proyecto";
$genera_reportes="si";
$imp_id="";	//mostrar id en imprimir 


$array_variables=array(
  array("Proyecto","id_proyecto","select_sql","pf_proyectos","nombre","","required","4","INT","NOT NULL","si","","","")  

 ,array("Tipo de proyecto","","salto_linea","","","","","","","","","","","") 
 ,array("Alimentación","tp_alimentacion","checkbox","1","","","","2","tinyint","","","","","")
 ,array("Salud","tp_salud","checkbox","1","","","","2","tinyint","","","","","")
 ,array("Educación y cultura","tp_educacion_cultura","checkbox","1","","","","2","tinyint","","","","","")
 ,array("Promoción humana","tp_promocion_humana","checkbox","1","","","","2","tinyint","","","","","")
 ,array("Vivienda","tp_vivienda","checkbox","1","","","","2","tinyint","","","","","")
 ,array("Otros","tp_otros","textarea","","","","","12","TEXT","","","","","")
 ,array("Condiciones socio-económicas de la comunidad","condiciones_comunidad","textarea","","","","","12","TEXT","","","","","")

//  ,array("Objetivo del Proyecto","","text","","","","disabled","4","INT","","","","","")
//  ,array("Número de personas beneficiadas","","text","","","","disabled","4","INT","","","","","")
//  ,array("Duración del Proyecto (meses)","","text","","","","disabled","4","INT","","","","","")
//  ,array("Fecha de inicio","","text","","","","disabled","4","INT","","","","","")
//  ,array("Fecha de termino","","text","","","","disabled","4","INT","","","","","")

 ,array("Periodicidad de los apoyos","periodicidad_apoyos","select_x","","","|Mensual=Mensual|Bimestral=Bimestral|Trimestral=Trimestral|Semestral=Semestral|Definitivo=Devinitivo|Otros=Otros","","4","VARCHAR(50)","","","","","")
 ,array("Presentación de informe y entrega de evidencia","periodicidad_informes","select_x","","","|Mensual=Mensual|Bimestral=Bimestral|Trimestral=Trimestral|Semestral=Semestral|Definitivo=Devinitivo|Otros=Otros","","4","VARCHAR(50)","","","","","")
 ,array("Seguimiento","seguimiento","textarea","","","","","12","TEXT","","si","","","")
 ,array("Observaciones","observacion","textarea","","","","","12","TEXT","","si","","","")
 ,array("","id_organismo","hiddenInsert","","","","","","","","","","","")
 
 

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