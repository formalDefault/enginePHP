<?php
session_start();
if($_SESSION[admin_id_pub]){
include "config.php";
$pagina="Capacitaciones";

//CONFIGURACION DE PAGINA
$color_form="naranja";
$color_imprimir="naranja";
$color_botones="blanco";
$url="rh_emp_capacitaciones.php";
$nomb_tabla="rh_capacitacion";
$nombre_formulario="Capacitaciones";
$titulo_boton_agregar="Agregar nueva capacitacion";
$genera_reportes="si";
$imp_id="";	//mostrar id en imprimir  

// Capacitaciones
$array_variables=array(
     array("Fecha","fecha","date","","","","required","4","date","NOT NULL","si","","","")  
    ,array("Nombre De La Capacitacion","nombre_capacitacion","text","","","","required","4","VARCHAR (100)","NOT NULL","si","","","")
    ,array("Tema De La Capacitacion","tema_capacitacion","text","","","","required","4","VARCHAR (100)","NOT NULL","si","","","")
    ,array("Duracion","","salto_linea","","","","","","","","","","","")//salto de linea 
    ,array("Fecha De Inicio","inicio_vacaciones","date","","","","required","4","date","NOT NULL","si","","","")
    ,array("Fecha De Termino","termino_vacaciones","date","","","","required","4","date","NOT NULL","si","","","")
    ,array("Dias","","salto_linea","","","","","","","","","","","")//salto de linea 
    //Checkboxs con los dias de la semana
    ,array("Lunes","dia_cap_lunes","checkbox","Si","","","","2","varchar(20)","NOT NULL","si","","","")  
    ,array("Martes","dia_cap_martes","checkbox","Si","","","","2","varchar(20)","NOT NULL","si","","","")  
    ,array("Miercoles","dia_cap_mieroles","checkbox","Si","","","","2","varchar(20)","NOT NULL","si","","","")  
    ,array("Jueves","dia_cap_jueves","checkbox","Si","","","","2","varchar(20)","NOT NULL","si","","","")  
    ,array("Viernes","dia_cap_viernes","checkbox","Si","","","","2","varchar(20)","NOT NULL","si","","","")  
    ,array("Sabado","dia_cap_sabado","checkbox","Si","","","","2","varchar(20)","NOT NULL","si","","","")  
    ,array("Observaciones","observaciones","textarea","","","","style='resize: none'","12","text","NOT NULL","si","","","")
    ,array("","id_empleado","hiddenInsert","","","","","","INT (8)","NOT NULL","","","","")
  );

// // Acta administrativa
// $array_variables=array(
//   array("Acta Administrativa","","salto_linea","","","","","","","","","","","")//salto de linea 
//  ,array("Fecha","fecha","date","","","","required","4","date","NOT NULL","si","","","")  
//  ,array("Hechos","hechos","text","","","","required","4","text","NOT NULL","si","","","")
//  ,array("Testigos","testigos","text","","","","required","4","text","NOT NULL","si","","","")
//  ,array("Declaracion","declaracion","textarea","","","","required style='resize:none'","12","text","NOT NULL","si","","","")//salto de linea  
// );

// //Nota de bodega
// $array_variables=array(
//   array("Acta Administrativa","","salto_linea","","","","","","","","","","","")//salto de linea 
//  ,array("Numero de nota","no_nota","number","","","","required","4","varchar (100)","NOT NULL","si","","","")  
//  ,array("Tipo de comunidad","tipo_comunidad","text","","","","required","4","varchar (100)","NOT NULL","si","","","")
//  ,array("Cantidad producida","cant_prod","number","","","","required","4","int","NOT NULL","si","","","")
//  ,array("Unidad","unidad","text","","","","required ","4","varchar (100)","NOT NULL","si","","","") 
//  ,array("Descripcion","descripcion","textarea","","",""," ","12","text","NOT NULL","si","","","") 
//  ,array("precio_unitario","unidad","number","","","","required ","4","double","NOT NULL","si","","","") 
//  ,array("Total","total","number","","","","required ","4","double","NOT NULL","si","","","") 
//  ,array("Tipo de cuota de recuperacion","tipo_cuota_recuperacion","text","","","","required ","4","varchar(40)","NOT NULL","si","","","") 
//  ,array("Firma de atendido","firma_atendido","text","","","","required ","4","varchar(40)","NOT NULL","si","","","") 
//  ,array("Firmo de recibido","firma_recibo","text","","","","required ","4","varchar(40)","NOT NULL","si","","","") 
// );
 
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