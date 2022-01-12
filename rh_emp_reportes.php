<?php
session_start();
if($_SESSION[admin_id_pub]){
include "config.php";
$pagina="Agregar Reporte";  

//CONFIGURACION DE PAGINA
$color_form="naranja";
$color_imprimir="naranja";
$color_botones="blanco";
$url="rh_emp_reportes.php";
$nomb_tabla="rh_reportes";
$nombre_formulario="Reportes";
$titulo_boton_agregar="Agregar Reporte";
$genera_reportes="si";
$imp_id="";	//mostrar id en imprimir 

//ELEMENTOS DE FORMULARIO Reportes
$array_variables=array(
//Normal: array(«Nombre de elemento»,«Campo DB»,«tipo (text,number,textarea,date)»,"","","",«Parametros HTML»,«Tamaño (2,4,6,8,12)»,«Tipo dato DB (VARCAHR(50)»,«Parametros DB (NOT NULL)»,«Se muestra en tabla (si,no)»,"","","","")
//Seleccion: array(«Nombre de elemento»,«Campo DB»,«tipo (select_x,select_sql)»,"«si es select_sql: nombre de tabla DB»","«si es select_sql: nombre de campo DB»","«Si el select_x: Lista de elementos separada por |»",«Parametros HTML»,«Tamaño (2,4,6,8,12)»,«Tipo dato DB (VARCAHR(50)»,«Parametros DB (NOT NULL)»,«Se muestra en tabla (si,no)»,"","","","«Condicion DB (WHERE)»")
 array("Fecha actual","fecha","date","","","","required","4","date","NOT NULL","si","","","")
,array("Quien realiza el reporte","quien_realiza_reporte","select_x","","","|Esposa=Esposa|Pariente=Pariente|Empleado=Empleado|Otro=otro","required","4","VARCHAR (50)","NOT NULL","si","","","")
,array("Quien (Otro)","quien_otro","text","","","","","4","VARCHAR (50)","NOT NULL","","","","")
,array("Medio de reporte", "medio_reporte", "select_x","","","|Telefono=telefono|Whatsapp=whatsapp|E-mail=email|Otro=otro","required","4","VARCHAR (50)","NOT NULL","si","","","")
,array("Medio de reporte (Otro)","medio_reporte_otro","text","","","","","4","VARCHAR (50)","NOT NULL","","","","")
,array("Causa de reporte", "causa_reporte", "select_x","","","|Enfermedad=enfermedad|Problematransporte=problema_transporte|Accidente=accidente|Otro=otro","required='required'","4","VARCHAR (50)","NOT NULL","","","","")
,array("Cual causa (otro)","causa_reporte_otro", "text","","","","","4","VARCHAR (50)","NOT NULL","","","","")
,array("Dias probables de ausencia","dias_ausencia","number","","","","","4","int (8)","NOT NULL","si","","","")
,array("Fecha probable Regreso","fecha_regreso","date","","","","","4","date","NOT NULL","si","","","")
,array("Goce de sueldo", "goce_sueldo", "select_x","","","|Si=si|No=no","","4","VARCHAR (50)","NOT NULL","si","","","")
,array("Comentario adicional","comentario_adicional","textarea","","","","style='resize: none'","12","text","NOT NULL","","","","")
,array("*Nombre de quien reporta","nombre_reporta","text","","","","required","4","VARCHAR (100)","NOT NULL","","","","")
,array("*Nombre De Quien Aprueba (Jefe De Departamento)","nombre_aprueba","text","","","","required","8","VARCHAR (100)","NOT NULL","","","","")
,array("Observaciones","observaciones","textarea","","","","style='resize: none'","12","text","NOT NULL","","","","")
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