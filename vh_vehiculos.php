<?php
session_start();
if($_SESSION[admin_id_pub]){
include "config.php";
$pagina="Agregar Vehiculos";  

//CONFIGURACION DE PAGINA
$color_form="naranja";
$color_imprimir="naranja";
$color_botones="blanco";
$url="vh_vehiculos.php";
$nomb_tabla="vh_vehiculos";
$nombre_formulario="Vehiculos";
$titulo_boton_agregar="Agregar vehiculo";
$genera_reportes="si";
$imp_id="";	//mostrar id en imprimir 


$array_variables = array(

  array("*Marca","marca","text","","","","onblur='this.value=this.value.toUpperCase()' required","4","VARCHAR (20)","NOT NULL","si","","","")
  ,array("*Modelo","modelo","text","","","","onblur='this.value=this.value.toUpperCase()' required","4","VARCHAR (20)","NOT NULL","si","","","")
  ,array("Sub Modelo","sub_modelo","text","","","","onblur='this.value=this.value.toUpperCase()'","4","VARCHAR (20)","NOT NULL","si","","","")
  ,array("*Año","year","number","","","","onblur='this.value=this.value.toUpperCase()' required","4","VARCHAR (4)","NOT NULL","si","","","")
  ,array("*Color","color","text","","","","onblur='this.value=this.value.toUpperCase()' required","4","VARCHAR (10)","NOT NULL","si","","","")
  ,array("Factura","factura","text","","","","onblur='this.value=this.value.toUpperCase()'","4","VARCHAR (20)","NOT NULL","","","","")
  ,array("Proveedor","proveedor","text","","","","onblur='this.value=this.value.toUpperCase()'","4","VARCHAR (100)","NOT NULL","","","","") 
  ,array("Fecha de adquisición","fecha_Adquisicion","date","","","","onblur='this.value=this.value.toUpperCase()'","4","date","NOT NULL","","","","")
  ,array("Numero motor","num_motor","number","","","","onblur='this.value=this.value.toUpperCase()'","4","int","NOT NULL","","","","")
  ,array("Numero Serie","num_serie","number","","","","","4","int","NOT NULL","si","","","")
  ,array("Monto","monto","number","","","","min='0' step='0.01'","4","double","NOT NULL","","","","")
  ,array("*Placas","placas","text","","","","onblur='this.value=this.value.toUpperCase()' required","4","VARCHAR (10)","NOT NULL","","","","")
  ,array("*Tarjeta de circulación","tarjeta_circulacion","text","","","","onblur='this.value=this.value.toUpperCase()' required","4","VARCHAR (25)","NOT NULL","","","","")
  ,array("Observaciones","observaciones","textarea","","","","","12","text","NOT NULL","","","","")

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