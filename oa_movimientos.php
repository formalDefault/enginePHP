<?php
session_start();
if($_SESSION[admin_id_pub]){
include "config.php";
$pagina="Agregar Movimientos";  

//CONFIGURACION DE PAGINA
$color_form="naranja";
$color_imprimir="naranja";
$color_botones="blanco";
$url="oa_movimientos.php";
$nomb_tabla="oa_movimientos";
$nombre_formulario="Movimientos";
$titulo_boton_agregar="Agregar Movimiento";
$genera_reportes="si";
$imp_id="";	//mostrar id en imprimir 


$array_variables=array(
  array("Fecha del Movimiento","fecha","date","","","","required","4","DATE","NOT NULL","si","","","")  
 ,array("Folio del movimiento (CFDI)","cfdi","text","","","","onblur='this.value=this.value.toUpperCase()' required","4","varchar(50)","","si","","","")
 ,array("Tipo de póliza","tipo_poliza","select_x","","","|Ingreso=Ingreso|Egreso=Egreso","","4","VARCHAR (10)","NOT NULL","","","","")

 ,array("Datos de ingreso","","salto_linea","","","","","","","","","","","") 
 ,array("Nombre de Ingreso","in_nombre","text","","","","disabled onblur='this.value=this.value.toUpperCase()'","4","VARCHAR(100)","NOT NULL","si","","","")
 ,array("Tipo de Ingreso","in_tipo","select_x","","","|Economico=Economico|Especie=Especie","required disabled","4","VARCHAR(50)","NOT NULL","","","","")
 ,array("Concepto","in_concepto","text","","","","onblur='this.value=this.value.toUpperCase()' required disabled","4","VARCHAR(100)","NOT NULL","","","","")
 ,array("Monto","in_monto","number","","","","min=0, step=0.01, disabled","4","DOUBLE","NOT NULL","","","","")
 ,array("Gasto Administrativo","in_gasto_administrativo","select_x","","","|Si=Si|No=No","disabled","4","VARCHAR(2)","NOT NULL","","","","")
 ,array("Total","in_total","number","","","","min=0, step=0.01 disabled","4","double","NOT NULL","","","","")

 ,array("Datos de egreso","","salto_linea","","","","","","","","","","","") 
 ,array("Nombre Egreso","eg_nombre","text","","","","onblur='this.value=this.value.toUpperCase()' disabled required","4","VARCHAR(100)","NOT NULL","","","","")
 ,array("Referencia","eg_referencia","select_x","","","|Transferencia=Transferencia|Cheque=Cheque|Efectivo=Efectivo","disabled","4","VARCHAR(50)","NOT NULL","","","","")
 ,array("Concepto","eg_concepto","text","","","","disabled","4","VARCHAR(100)","NOT NULL","","","","")
 ,array("Monto","eg_monto","number","","","","min=0, step=0.01 disabled","4","DOUBLE","NOT NULL","","","","")
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
    //Adaptacion al cambiar tipo de organismo a otro
    $("#tipo_poliza").change(function(event)
    { 
      if($("#tipo_poliza").val() == "Ingreso")
      {
        $("#in_nombre").attr('disabled', false);
        $("#in_tipo").attr('disabled', false);
        $("#in_concepto").attr('disabled', false);
        $("#in_monto").attr('disabled', false);
        $("#in_gasto_administrativo").attr('disabled', false);
        $("#in_total").attr('disabled', false);

        $("#eg_nombre").attr('disabled', true);
        $("#eg_referencia").attr('disabled', true);
        $("#eg_concepto").attr('disabled', true);
        $("#eg_monto").attr('disabled', true);
      } 
      if($("#tipo_poliza").val() == "Egreso")
      {
        $("#eg_nombre").attr('disabled', false);
        $("#eg_referencia").attr('disabled', false);
        $("#eg_concepto").attr('disabled', false);
        $("#eg_monto").attr('disabled', false);

        $("#in_nombre").attr('disabled', true);
        $("#in_tipo").attr('disabled', true);
        $("#in_concepto").attr('disabled', true);
        $("#in_monto").attr('disabled', true);
        $("#in_gasto_administrativo").attr('disabled', true);
        $("#in_total").attr('disabled', true);
      }
    });

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