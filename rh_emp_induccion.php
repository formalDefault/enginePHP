<?php
session_start();
if($_SESSION[admin_id_pub]){
include "config.php";
$pagina="Inducciones";

//CONFIGURACION DE PAGINA
$color_form="naranja";
$color_imprimir="naranja";
$color_botones="blanco";
$url="rh_emp_induccion.php";
$nomb_tabla="rh_atn_empleados";
$nombre_formulario="Inducciones";
$titulo_boton_agregar="Agregar nueva induccion";
$genera_reportes="si";
$imp_id="";	//mostrar id en imprimir  

// INDUCCIÓN GENERAL (Recursos Humanos ) 
$array_variables=array(
     array("¿Qué es Cáritas?","induccion_que_es_caritas","select_x","","","|Si=Si|No=No","","4","VARCHAR (10)","NOT NULL","si","","","")  
    ,array("Historia y antecedentes.","induccion_historia","select_x","","","|Si=Si|No=No","","4","VARCHAR (10)","NOT NULL","si","","","")  
    ,array("Identidad, Misión, Visión y Valores.","induccion_identidad","select_x","","","|Si=Si|No=No","","4","VARCHAR (30)","NOT NULL","si","","","")  
    ,array("Estructura ( Organigrama ).","induccion_estructura","select_x","","","|Si=Si|No=No","","4","VARCHAR (10)","NOT NULL","","","","")  
    ,array("Descripción de la Misión y los servicios de cada Programa.","induccion_descripcion","select_x","","","|Si=Si|No=No","","6","VARCHAR (10)","NOT NULL","si","","","")  
    //Entrega, reflexiòn estudio documentos
    ,array("Trípticos","entrega_doc_tripticos","select_x","","","|Si=Si|No=No","","4","VARCHAR (10)","NOT NULL","si","","","")  
    ,array("Estatutos","entrega_doc_estatutos","select_x","","","|Si=Si|No=No","","4","VARCHAR (10)","NOT NULL","si","","","")  
    ,array("Reglamento Interno de Trabajo","entrega_doc_reglamento","select_x","","","|Si=Si|No=No","","4","VARCHAR (10)","NOT NULL","si","","","")  
    ,array("Informe Anual","entrega_doc_informe","select_x","","","|Si=Si|No=No","","4","VARCHAR (10)","NOT NULL","si","","","")  
    ,array("Dcto. Vivamos el amor preferencial de los pobres","entrega_doc_vivamos_amor","select_x","","","|Si=Si|No=No","","4","VARCHAR (10)","NOT NULL","si","","","")  
    // EVENTOS DE PROCURACIÓN DE FONDOS
    ,array("Colecta Anual","induccion_colecta_anual","select_x","","","|Si=Si|No=No","","4","VARCHAR (10)","NOT NULL","","","","")  
    ,array("Semana de Cáritas","induccion_semana_caritas","select_x","","","|Si=Si|No=No","","4","VARCHAR (10)","NOT NULL","","","","")  
    ,array("Raspadito","induccion_rapadito","select_x","","","|Si=Si|No=No","","4","VARCHAR (10)","NOT NULL","","","","")  
    ,array("Subasta de obras de arte","induccion_subasta_arte","select_x","","","|Si=Si|No=No","","4","VARCHAR (10)","NOT NULL","","","","")  
    ,array("Sorteo entre Amigos","induccion_sorteo_amigos","select_x","","","|Si=Si|No=No","","4","VARCHAR (10)","NOT NULL","","","","")  
    ,array("Campaña de Cobijas y Cenas Navideñas ","induccion_cobijas","select_x","","","|Si=Si|No=No","","4","VARCHAR (10)","NOT NULL","","","","")  
    ,array("Campaña en Colegios","induccion_colegios","select_x","","","|Si=Si|No=No","","4","VARCHAR (10)","NOT NULL","","","","")  
    ,array("Jornadas de apoyo en especie en diferentes Parroquias","induccion_jornadas","select_x","","","|Si=Si|No=No","","6","VARCHAR (10)","NOT NULL","","","","")  
    ,array("Observaciones","induccion_observaciones","textarea","","","","style='resize: none'","12","text","NOT NULL","","","","")    
    ,array("Firma del empleado","firma_empleado","textarea","","","","style='resize: none'","12","text","NOT NULL","","","","")   
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