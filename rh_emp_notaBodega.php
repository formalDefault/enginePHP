<?php
  session_start();
  if($_SESSION[admin_id_pub]){
  include "config.php";
  $pagina="Nota de bodega";

  //CONFIGURACION DE PAGINA
  $color_form="naranja";
  $color_imprimir="naranja";
  $color_botones="blanco";
  $url="rh_emp_notaBodega.php";
  $nomb_tabla="rh_nota_bodega";
  $nombre_formulario="Nota de bodega";
  $titulo_boton_agregar="Agregar nueva nota";
  $genera_reportes="si";
  $imp_id="";	//mostrar id en imprimir  

  //Nota de bodega
  $array_variables=array(
  //  array("Nota de bodega","","salto_linea","","","","","","","","","","","")//salto de linea 
   array("Numero de nota","no_nota","number","","","","required","4","VARCHAR (100)","NOT NULL","si","","","") 
  ,array("Tipo de comunidad","tipo_comunidad","text","","","","required","4","VARCHAR (100)","NOT NULL","si","","","") 
  ,array("Cantidad producida","cant_prod","number","","","","required","4","INT (8)","NOT NULL","si","","","") 
  ,array("Unidad","unidad","text","","","","required ","4","VARCHAR (100)","","si","","","") 
  ,array("Descripcion","descripcion","textarea","","","","","12","text","NOT NULL","si","","","")
  ,array("precio_unitario","precio_unitario","number","","","","required","4","DOUBLE","NOT NULL","si","","","") 
  ,array("Total","total","number","","","","required","4","DOUBLE","NOT NULL","si","","","") 
  ,array("Tipo de cuota de recuperacion","tipo_cuota_recuperacion","text","","","","required","4","VARCHAR(40)","NOT NULL","si","","","") 
  ,array("Firma de atendido","firma_atendido","text","","","","required","4","VARCHAR(50)","NOT NULL","","","","") 
  ,array("Firmo de recibido","firma_recibo","text","","","","required","4","VARCHAR(50)","NOT NULL","","","","") 
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