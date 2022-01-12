<?php
session_start();
if($_SESSION[admin_id_pub]){
include "config.php";
$pagina="Aviso de salida";

//CONFIGURACION DE PAGINA
$color_form="naranja";
$color_imprimir="naranja";
$color_botones="blanco";
$url="rh_emp_avisoSalida.php";
$nomb_tabla="rh_aviso_salida";
$nombre_formulario="Aviso de salida";
$titulo_boton_agregar="Agregar aviso de salida";
$genera_reportes="si";
$imp_id="";	//mostrar id en imprimir 
 
//ELEMENTOS DE FORMULARIO aviso de salida
$array_variables=array(
	//Normal: array(«Nombre de elemento»,«Campo DB»,«tipo (text,number,textarea,date)»,"","","",«Parametros HTML»,«Tamaño (2,4,6,8,12)»,«Tipo dato DB (VARCAHR(50)»,«Parametros DB (NOT NULL)»,«Se muestra en tabla (si,no)»,"","","","")
	//Seleccion: array(«Nombre de elemento»,«Campo DB»,«tipo (select_x,select_sql)»,"«si es select_sql: nombre de tabla DB»","«si es select_sql: nombre de campo DB»","«Si el select_x: Lista de elementos separada por |»",«Parametros HTML»,«Tamaño (2,4,6,8,12)»,«Tipo dato DB (VARCAHR(50)»,«Parametros DB (NOT NULL)»,«Se muestra en tabla (si,no)»,"","","","«Condicion DB (WHERE)»")
	 array("*Fecha actual","fecha","date","","","","required='required'","4","date","NOT NULL","si","","","")
	,array("Motivo de salida","motivo_salida","textarea","","","","required style='resize: none'","12","text","NOT NULL","","","","")
	,array("Domicilio al que se dirige","","salto_linea","","","","","","","","","","","")//salto de linea 
	,array("*Municipio","municipio_nac","select_sql","tcat_municipios","municipio",""," required","4","VARCHAR (100)","NOT NULL","","","","","WHERE id_estado=14")
	,array("*Colonia","colonia","select_sql","tcat_colonias","colonia","","disabled required","4","VARCHAR (100)","NOT NULL","","","","","WHERE id=10")
	,array("*Calle y numero","calle_numero","text","","","","required='required'","4","VARCHAR (100)","NOT NULL","","","","")
	,array("*Codigo postal","cp","number","","","","required='required'","4","VARCHAR (100)","NOT NULL","","","","")
	,array("*Persona que con quien se dirige","persona_dirige","date","","","","required='required'","4","VARCHAR (100)","NOT NULL","si","","","") 
	,array("Persona que con quien (otro)","persona_dirige_otro","date","","","","","4","date","NOT NULL","","","","") 
	,array("*Hora de salida","hora_salida","time","","","","required='required'","4","time","NOT NULL","si","","","") 
	,array("*Hora de entrada","hora_entrada","time","","","","required='required'","4","time","NOT NULL","si","","","") 
	,array("*Firma Autorizacion operativo","firma_autorizacion","text","","","","required='required'","4","VARCHAR (50)","NOT NULL","","","","") 
	,array("*Firma Solicitante","firma_solicitante","text","","","","required='required'","4","VARCHAR (50)","NOT NULL","","","","") 
	,array("*Firma Recursos Humanos","firma_rh","text","","","","required='required'","4","VARCHAR (50)","NOT NULL","","","","") 
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
      //Acciones antes de enviar formulario
      $( "#validation-form" ).submit(function( event ) {  
        $( "#colonia" ).prop( "disabled", false );
      });

      // // Adaptacion al cambiar Municipio Radica 
      $("#municipio_nac").change(function(event)
        {
			$.post('saca_datos.php',{
				municipio_nac:$("#municipio_nac").val(), 
				opc:"37"
				}, function(res_col) 
				{
				$( "#colonia" ).html( res_col);
				$("#colonia").attr('disabled', false); 
			});
        });

      // Adaptacion al cambiar Colonia Radica 
      $("#colonia").change(function(event)
          {
            $.post('saca_datos.php',{colonia:$("#colonia").val(),opc:"6"}, function(res_cp) 
            {
              $( "#cp" ).val( res_cp);

            });

          });
      
      //Adaptacion al capturar Codigo Postal
      $("#cp").keyup(function(){
        $cp = $("#cp").val()
        $.post('saca_datos.php',{cp:$cp,opc:"34"}, function(res) 
            {
              $( "#colonia" ).html(res);
              $( "#colonia" ).prop( "disabled", false );
            });
      });
      
    //VALIDACION DE TAMAÑO DEL ARCHIVO
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