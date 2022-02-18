<?php
  session_start();
  if($_SESSION[admin_id_pub]){
  include "config.php";
  $pagina="Agregar Vehiculos";  

  //CONFIGURACION DE PAGINA
  $color_form="naranja";
  $color_imprimir="naranja";
  $color_botones="blanco";
  $url="oa_organismos.php";
  $nomb_tabla="oa_organismos";
  $nombre_formulario="Organismos";
  $titulo_boton_agregar="Agregar organismo";
  $genera_reportes="si";
  $imp_id="";	//mostrar id en imprimir 
 
  $array_variables=array(
    array("Nombre de Organismo","nombre","text","","","","required onblur='this.value=this.value.toUpperCase()'","4","VARCHAR (100)","NOT NULL","si","","","")  
    ,array("Tipo de organismo","id_tipo_organismo","select_sql","oa_tcat_tipo_organismo","tipo_organismo","","required","4","INT","NOT NULL","si","","","")
    ,array("Otro","otro_tipo","text","","","","disabled","4","VARCHAR (50)","","","","","")
    ,array("Tipo de donativo","id_tipo_donativo","select_sql","oa_tcat_tipo_donativo","tipo_donativo","","","4","INT","NOT NULL","si","","","")
    ,array("Estatus","id_estado","select_sql","oa_tcat_estado","estado","","required","4","INT","NOT NULL","si","","","")
    ,array("Observaciones","observaciones","textarea","","","","required","12","TEXT","","","","","")
    ,array("Objetivo de la organización u Objeto social","objetivo","textarea","","","","","12","TEXT","","","","","")
    // ,array("Numero de beneficiarios mensuales","beneficiarios_mensuales","","","","","disabled","","INT","","","","","")
    ,array("Fecha de inicio de operaciones","fecha_operaciones","date","","","","","4","DATE","","","","","")

    ,array("Tipo servicios","","salto_linea","","","","","","","","","","","") 
    ,array("Alimentación","serv_alimentacion","checkbox","1","","","","2","tinyint","","","","","")
    ,array("Salud","serv_salud","checkbox","1","","","","2","tinyint","","","","","")
    ,array("Educación y cultura","serv_educacion_cultura","checkbox","1","","","","2","tinyint","","","","","")
    ,array("Promoción humana","serv_promocion_humana","checkbox","","","","","2","tinyint","","","","","")
    ,array("Vivienda","serv_vivienda","checkbox","1","","","","2","tinyint","","","","","")
    ,array("Otros","serv_otros_detalle","textarea","","","","","12","TEXT","","","","","")

    ,array("Expediente","","salto_linea","","","","","","","","","","","") 
    ,array("Acta constitutiva","acta_constitutiva","checkbox","1","","","","2","tinyint","","","","","")
    ,array("INE del representante legal","docs_ine_representante","checkbox","1","","","","2","tinyint","","","","","")
    ,array("INE del responsable del seguimiento","docs_ine_responsable","checkbox","1","","","","2","tinyint","","","","","")
    ,array("Comprobante de domicilio del OA","docs_comprobante_domicilio","checkbox","1","","","","2","tinyint","","","","","")
    ,array("Solicitud de apoyo","docs_solicitud_apoyo","checkbox","1","","","","2","tinyint","","","","","")
    ,array("Formato con Proyecto","docs_formato_proyecto","checkbox","1","","","","2","tinyint","","","","","")
    ,array("Otro (cual) / observaciones","docs_otro","textarea","","","","","12","TEXT","","","","","")

    ,array("Domicilo","","salto_linea","","","","","","","","","","","") 

    ,array("Diócesis","dom_id_diocesis","text","","","","onblur='this.value=this.value.toUpperCase()'","4","VARCHAR(50)","","","","","") 
    ,array("Vicaria","dom_id_vicaria","select_sql","cat_vicarias","vicaria","","","4","INT","","","","","")
    ,array("Decanato","dom_id_decanato","select_sql","cat_decanatos","decanato","","disabled","4","INT","","","","","")
    ,array("Parroquia","dom_id_parroquia","select_sql","cat_parroquias","parroquia","","disabled","4","INT","","","","","") 
    ,array("CP","dom_cp","number","","","","required","4","INT","NOT NULL","si","","","")
    ,array("Estado","dom_id_estado","select_sql","tcat_estados","estado","","disabled","4","INT","","","","","WHERE id = 1")
    ,array("Municipio","dom_id_municipio","select_sql","tcat_municipios","municipio","","disabled","4","INT","","","","","WHERE id = 1")
    ,array("Colonia o Localidad","dom_id_colonia","select_sql","tcat_colonias","colonia","","disabled","4","INT","NOT NULL","","","","WHERE id = 1")

    ,array("Calle","dom_calle","text","","","","onblur='this.value=this.value.toUpperCase()' required","8","VARCHAR(50)","NOT NULL","si","","","")
    ,array("Núm. Exterior","dom_num_ext","number","","","","required","4","VARCHAR(5)","NOT NULL","si","","","")
    ,array("Número interior","dom_num_int","number","","","","","4","VARCHAR(5)","NOT NULL","si","","","")
    ,array("Observaciones","dom_observaciones","textarea","","","","","12","TEXT","","si","","","")
    
    ,array("Datos de contacto","","salto_linea","","","","","","","","","","","") 
    ,array("Telefono de contacto","cont_telefono","number","","","","required","4","VARCHAR(10)","","","","","")
    ,array("Correo electronico","cont_email","text","","","","onblur='this.value=this.value.toUpperCase()' required","4","VARCHAR(100)","","","","","")
    
    ,array("Representante legal","","salto_linea","","","","","","","","","","","") 
    ,array("Nombre de representante legal","cont_nombre_representante","text","","","","onblur='this.value=this.value.toUpperCase()' required","4","VARCHAR(250)","","","","","")
    ,array("Correo de representante legal","cont_email_representante","text","","","","onblur='this.value=this.value.toUpperCase()' required","4","VARCHAR(100)","","","","","")

    ,array("Datos de Responsable del Seguimiento","","salto_linea","","","","","","","","","","","") 
    ,array("Nombre de responsable","cont_nombre_responsable","text","","","","onblur='this.value=this.value.toUpperCase()' required","4","VARCHAR(250)","NOT NULL","","","","")
    ,array("Cargo de responsable","cont_cargo_responsable","text","","","","onblur='this.value=this.value.toUpperCase()'","4","VARCHAR(100)","NOT NULL","","","","")
    ,array("Telefono de responsable","cont_telefono_responsable","number","","","","onblur='this.value=this.value.toUpperCase()' required","4","VARCHAR(10)","NOT NULL","","","","")
    ,array("Correo de responsable","cont_email_responsable","text","","","","onblur='this.value=this.value.toUpperCase()' required","8","VARCHAR(100)","NOT NULL","","","","")

    ,array("Observaciones","","salto_linea","","","","","","","","","","","") 
    ,array("","cont_observaciones","textarea","","","","","12","TEXT","","","","","")

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
    $("#id_tipo_organismo").change(function(event)
    { 
      if($("#id_tipo_organismo").val() == 4)
      {
        $("#otro_tipo").attr('disabled', false);
      } 
    });

    //Adaptacion al cambiar tipo de organismo a otro
    $("#dom_cp").keyup(function()
    { 
      $cp = $("#dom_cp").val();
      $.post('saca_datos.php',{cp:$cp,opc:"32"}, function(res) 
      {
        $( "#dom_id_estado" ).val(res); 
      });
      $.post('saca_datos.php',{cp:$cp,opc:"33"}, function(res) 
      {
        $( "#dom_id_municipio" ).val(res); 
      });
      $.post('saca_datos.php',{cp:$cp,opc:"34"}, function(res) 
      {
        $( "#dom_id_colonia" ).html(res);
        $( "#dom_id_colonia" ).prop( "disabled", false );
      }); 
    });

    //Adaptacion al cambiar Vicaria
    $("#dom_id_vicaria").change(function(event)
      {
        $.post('saca_datos.php',{vicaria:$("#dom_id_vicaria").val(),opc:"12"}, function(res_mun) 
        {
          $("#dom_id_decanato").attr('disabled', false);
          $("#dom_id_decanato").html( res_mun); 
        });

      });

    //Adaptacion al cambiar Vicaria
    $("#dom_id_decanato").change(function(event)
      {
        $.post('saca_datos.php',{decanato:$("#dom_id_decanato").val(),opc:"13"}, function(res) 
          {
            $("#dom_id_parroquia").attr('disabled', false); 
            $("#dom_id_parroquia").html(res);

          }); 
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