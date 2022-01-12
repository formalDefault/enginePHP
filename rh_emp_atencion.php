<?php
  session_start();
  if($_SESSION[admin_id_pub]){
  include "config.php";
  $pagina="Atencion empleados";
  $excel=$_POST["excel"];

  //CONFIGURACION DE PAGINA
  $color_form="naranja";
  $color_imprimir="naranja";
  $color_botones="blanco";
  $url="rh_emp_atencion.php";
  $nomb_tabla="rh_atn_empleados";
  $nombre_formulario="Empleados";
  $titulo_boton_agregar="Agregar Empleado";
  $genera_reportes="si";
  $imp_id="si";	//mostrar id en imprimir    

  // ELEMENTOS DE FORMULARIO atencion empleados
  $array_variables=array(
    //Encabezado de formulario
    array("*Nombre","nombre","text","","","","onblur='this.value=this.value.toUpperCase()' required","4","VARCHAR (100)","NOT NULL","si","","","")
    ,array("*Primer Apellido","appat","text","","","","onblur='this.value=this.value.toUpperCase()' required","4","VARCHAR (100)","NOT NULL","si","","","")
    ,array("Segundo Apellido","apmat","text","","","","onblur='this.value=this.value.toUpperCase()'","4","VARCHAR (100)","NOT NULL","si","","","")
    ,array("*Fecha de Nacimiento","fecha_nac","date","","","","required","4","DATE","NOT NULL","","","","")

    //Lugar de Nacimiento
    ,array("Lugar de Nacimiento","","salto_linea","","","","","18","","","","","","")
    ,array("*Estado","estado_nac","select_sql","tcat_estados","estado","","required","6","VARCHAR (100)","NOT NULL","","","","")
    ,array("*Municipio","municipio_nac","select_sql","tcat_municipios","municipio","","disabled required","6","VARCHAR (100)","NOT NULL","","","","","WHERE id_estado='14'")


    //Identificacion
    ,array("Identificacion","","salto_linea","","","","","18","","","","","","")
    ,array("RFC","rfc","text","","","","onblur='this.value=this.value.toUpperCase()'","4","VARCHAR (100)","NOT NULL","","","","")
    ,array("CURP","curp","text","","","","onblur='this.value=this.value.toUpperCase()'","4","VARCHAR (100)","NOT NULL","","","","")
    ,array("Email","email","email","","","","","4","VARCHAR (100)","NOT NULL","","","","")

    //Salud
    ,array("Salud","","salto_linea","","","","","18","","","","","","")
    ,array("Numero IMSS","numero_imss","text","","","","","4","VARCHAR (100)","NOT NULL","","","","")
    ,array("Numero de Clínica","numero_clinica","number","","","","","4","VARCHAR (100)","NOT NULL","","","","")
    ,array("Tipo de Sangre","tipo_sangre","select_x","","","|A+=A+|A-=A-|B+=B+|B-=B-|AB+=AB+|AB-=AB-|O+=O+|O-=O-","","4","VARCHAR (100)","NOT NULL","","","","")

    //Educación
    ,array("Educación","","salto_linea","","","","","18","","","","","","")
    ,array("Escolaridad","escolaridad","select_x","","","|Preescolar=Preescolar|Primaria=Primaria|Secundaria=Secundaria|Preparatoria=Preparatoria|Carrera Comercial=Carrera Comercial|Licenciatura=Licenciatura|Posgrado=Posgrado","","4","VARCHAR (100)","NOT NULL","","","","")
    ,array("Grado","grado_escolar","select_x","","","|Concluida=Concluida|Trunca=Trunca","","4","VARCHAR (100)","NOT NULL","","","","")
    ,array("Licenciatura o posgrado en","licenciatura_posgrado","text","","","","","4","VARCHAR (100)","NOT NULL","","","","")
    ,array("Capacitación Técnica","cap_tecnica","select_x","","","|Si=Si|No=No","","4","VARCHAR (10)","NOT NULL","","","","")
    ,array("En que","cap_tec_en_que","textarea","","","","","12","TEXT","NOT NULL","","","","")

    //Habilidades de Empleado
    ,array("Habilidades de Empleado","","salto_linea","","","","","18","","","","","","")
    ,array("Habilidades del empleado","habilidades_empleado","textarea","","","","","12","TEXT","NOT NULL","","","","")
    ,array("Experiencia grupos parroquiales","experiencia_gpos_parroquiales","select_x","","","|Si=Si|No=No","","4","VARCHAR (10)","NOT NULL","","","","")
    ,array("Cual","cual_exp_gpos_parr","textarea","","","","","12","TEXT","NOT NULL","","","","")
 
    //Domicilio
    ,array("Domicilio","","salto_linea","","","","","18","","","","","","")
    ,array("Código Postal","cp","number","","","","min='9999' max='99999' ","2","VARCHAR (100)","NOT NULL","","","","")
    ,array("Estado donde radica","estado_radica","select_sql","tcat_estados","estado","","require","4","VARCHAR (100)","NOT NULL","","","","")
    ,array("Municipio","municipio_radica","select_sql","tcat_municipios","municipio",""," disabled","6","VARCHAR (100)","NOT NULL","","","","","WHERE id_estado='14'")
    ,array("Calle","calle","text","","","","onblur='this.value=this.value.toUpperCase()' ","4","VARCHAR (100)","NOT NULL","","","","")
    ,array("Numero","num_ext","text","","","","pattern='[0-9]*' ","2","VARCHAR (100)","NOT NULL","","","","")
    ,array("Letra","letra_ext","text","","","","onblur='this.value=this.value.toUpperCase()'","2","VARCHAR (100)","NOT NULL","","","","")
    ,array("interior","num_int","text","","","","pattern='[0-9]*'","2","VARCHAR (100)","NOT NULL","","","","")
    ,array("Letra interior","letra_int","text","","","","onblur='this.value=this.value.toUpperCase()'","2","VARCHAR (100)","NOT NULL","","","","")
    ,array("*Colonia","colonia","select_sql","tcat_colonias","colonia","","disabled","4","VARCHAR (100)","NOT NULL","","","","","WHERE id_estado='14'")
    ,array("Primera calle cruce","primer_cruce","text","","","","onblur='this.value=this.value.toUpperCase()'","4","VARCHAR (100)","NOT NULL","","","","")
    ,array("Segunda Calle cruce","segundo_cruce","text","","","","onblur='this.value=this.value.toUpperCase()'","4","VARCHAR (100)","NOT NULL","","","","")
    ,array("Teléfono (10 dígitos)","telefono","text","","","","pattern='[0-9]{10}'","4","VARCHAR (100)","NOT NULL","","","","")
    ,array("Vivienda","vivienda","select_x","","","|Propia=Propia|Rentada=Rentada|Prestada=Prestada","","4","VARCHAR (100)","NOT NULL","","","","")
    ,array("Crédito Infonavit","credito_infonavit","select_x","","","|Si=Si|No=No","","4","VARCHAR (10)","NOT NULL","","","","")

    //Vehículo
    ,array("Vehículo","","salto_linea","","","","","18","","","","","","")
    ,array("Vehículo Propio","vehiculo_propio","select_x","","","|Si=Si|No=No","","4","VARCHAR (10)","NOT NULL","","","","")
    ,array("Modelo","modelo_vehiculo","text","","","","onblur='this.value=this.value.toUpperCase()'","4","VARCHAR (100)","NOT NULL","","","","")
    ,array("Placas","placas_vehiculo","text","","","","onblur='this.value=this.value.toUpperCase()'","4","VARCHAR (100)","NOT NULL","","","","")

    //Parroquia que pertenece
    ,array("Parroquia que pertenece","","salto_linea","","","","","18","","","","","","")
    ,array("Vicaria","vicaria","select_sql","cat_vicarias","vicaria","","","4","VARCHAR (100)","NOT NULL","","","","","group by vicaria")
    ,array("Decanato","decanato","select_sql","cat_decanatos","decanato","","disabled","4","VARCHAR (100)","NOT NULL","","","","","group by decanato")
    ,array("Parroquia","parroquia","select_sql","cat_parroquias","parroquia","","disabled","4","VARCHAR (100)","NOT NULL","","","","","excel")

    //Datos Familiares
    ,array("Datos Familiares","","salto_linea","","","","","18","","","","","","")
    ,array("Estado civil","estado_civil","select_x","","","|SOLTERO(A)=SOLTERO(A)|CASADO(A)=CASADO(A)|DIVORCIADO(A)=DIVORCIADO(A)|UNION LIBRE=UNION LIBRE|VIUDO(A)=VIUDO(A)|SEPARADO(A)=SEPARADO(A)","","4","VARCHAR (100)","NOT NULL","","","","")
    ,array("Casado(a) por el civil","casado_civil","select_x","","","|Si=Si|No=No","","4","VARCHAR (20)","NOT NULL","","","","")
    ,array("Casado(a) por la iglesia","casado_iglesia","select_x","","","|Si=Si|No=No","","4","VARCHAR (20)","NOT NULL","","","","")
    ,array("Nombre del padre","nombre_padre","text","","","","onblur='this.value=this.value.toUpperCase()'","4","VARCHAR (100)","NOT NULL","","","","")
    ,array("Situación del padre","situacion_padre","select_x","","","|Vivo=Vivo|Finado=Finado","","4","VARCHAR (30)","NOT NULL","","","","")
    ,array("Nombre de la madre","nombre_madre","text","","","","onblur='this.value=this.value.toUpperCase()'","4","VARCHAR (100)","NOT NULL","","","","")
    ,array("Situación de la madre","situacion_madre","select_x","","","|Vivo=Vivo|Finado=Finado","","4","VARCHAR (30)","NOT NULL","","","","")
    ,array("Nombre del esposo(a)","nombre_esposo","text","","","","onblur='this.value=this.value.toUpperCase()'","4","VARCHAR (100)","NOT NULL","","","","")
    ,array("Situación esposo (a)","situacion_esposo","select_x","","","|Vivo=Vivo|Finado=Finado","","4","VARCHAR (30)","NOT NULL","","","","")
    ,array("Número de hijos","numero_hijos","number","","","","","4","INT (8)","NOT NULL","","","","")
    ,array("Edades de los hijos ","edades_hijos","textarea","","","","","12","TEXT","NOT NULL","","","","")
    ,array("Enfermos en casa","enfermos_casa","select_x","","","|Si=Si|No=No","","4","VARCHAR (100)","NOT NULL","","","","")
    ,array("Padecimiento","padecimiento","textarea","","","","","12","TEXT","NOT NULL","","","","")

    //Situación laboral en Cáritas
    ,array("Situación laboral en Cáritas","","salto_linea","","","","","18","","","","","","")
    ,array("Número de contrato","numero_contrado","text","","","","onblur='this.value=this.value.toUpperCase()'","4","INT (8)","NOT NULL","","","","")
    ,array("Fecha de ingreso a Cáritas ","ingreso_caritas","date","","","","","4","DATE","NOT NULL","","","","")
    ,array("Fecha de alta","fecha_alta","date","","","","","4","DATE","NOT NULL","","","","")
    ,array("Programa ","programa_alta","select_sql","c_programas","programa","","","4","VARCHAR (100)","NOT NULL","si","","","","","")
    ,array("Puesto ","puesto_alta","select_sql","c_puestos","puesto","","disabled","4","VARCHAR (100)","NOT NULL","si","","","","","WHERE id=14")
    ,array("Nivel ","nivel_alta","select_sql","c_niveles","nivel","","disabled","4","VARCHAR (100)","NOT NULL","si","","","","")

    //Prestaciones
    ,array("Prestaciones","","salto_linea","","","","","18","","","","","","")
    ,array("S.D.","sueldo_sd","pesos","","","","","4","DOUBLE","NOT NULL","","","","")
    ,array("S.D.I.","sueldo_sdi","pesos","","","","","4","DOUBLE","NOT NULL","","","","")
    ,array("Tipo de salario ","tipo_salario","select_x","","","|Fijo=Fijo","","4","VARCHAR (30)","NOT NULL","","","","")
    ,array("Alta Nomipaq ","alta_nomipaq","select_x","","","|Si=Si|No=No","","4","VARCHAR (10)","NOT NULL","","","","")
    ,array("Datos Nomipaq ","datos_nomipaq","number","","","","","4","DOUBLE","NOT NULL","","","","")
    ,array("Alta seguro social ","alta_ss","select_x","","","|Si=Si|No=No","","4","VARCHAR (10)","NOT NULL","","","","")
    ,array("Matricula IMSS ","matricula_imss","number","","","","","4","DOUBLE","NOT NULL","","","","")
    ,array("Alta huella en reloj checador ","alta_huella","select_x","","","|Si=Si|No=No","","4","VARCHAR (10)","NOT NULL","","","","")
    ,array("Alta vales de despensa ","alta_vales_desp","select_x","","","|Si=Si|No=No","","4","VARCHAR (10)","NOT NULL","","","","")
    ,array("Número tarjeta ","vales_desp_num_tarj","text","","","","","4","VARCHAR (30)","NOT NULL","","","","")
    ,array("Alta fondo de ahorro ","alta_fondo_ahorro","select_x","","","|Si=Si|No=No","","4","VARCHAR (10)","NOT NULL","","","","")
    ,array("Dato fondo ahorro ","dato_fondo_ahorro","text","","","","","4","VARCHAR (30)","NOT NULL","","","","")
    ,array("Seguro de vida ","seguro_vida","select_x","","","|Si=Si|No=No","","4","VARCHAR (5)","NOT NULL","","","","")
    ,array("Datos seguro de vida","datos_seguro_vida","text","","","","","4","VARCHAR (30)","NOT NULL","","","","")

    //Horario de trabajo
    ,array("Horario de trabajo","","salto_linea","","","","","18","","","","","","")
    ,array("Horario de Entrada","","label","","","","","4","","","","","","")
    ,array("Horario de Salida","","label","","","","","4","","","","","","")
    ,array("","","label","","","","","12","","","","","","")
    ,array("Lunes","hr_in_lunes","time","","","","required","4","TIME","NOT NULL","","","","")
    ,array("&nbsp","hr_out_lunes","time","","","","required","4","TIME","NOT NULL","","","","")
    ,array("","","label","","","","","12","","","","","","")
    ,array("Martes","hr_in_martes","time","","","","required","4","TIME","NOT NULL","","","","")
    ,array("&nbsp","hr_out_martes","time","","","","required","4","TIME","NOT NULL","","","","")
    ,array("","","label","","","","","12","","","","","","")
    ,array("Miercoles","hr_in_miercoles","time","","","","required","4","TIME","NOT NULL","","","","")
    ,array("&nbsp","hr_out_miercoles","time","","","","required","4","TIME","NOT NULL","","","","")
    ,array("","","label","","","","","12","","","","","","")
    ,array("Jueves","hr_in_jueves","time","","","","required","4","TIME","NOT NULL","","","","")
    ,array("&nbsp","hr_out_jueves","time","","","","required","4","TIME","NOT NULL","","","","")
    ,array("","","label","","","","","12","","","","","","")
    ,array("Viernes","hr_in_viernes","time","","","","required","4","TIME","NOT NULL","","","","")
    ,array("&nbsp","hr_out_viernes","time","","","","required","4","TIME","NOT NULL","","","","")
    ,array("","","label","","","","","12","","","","","","")
    ,array("Sabando","hr_in_sabado","time","","","","required","4","TIME","NOT NULL","","","","")
    ,array("&nbsp","hr_out_sabado","time","","","","required","4","TIME","NOT NULL","","","","")
    ,array("","","label","","","","","12","","","","","","")
    ,array("Domingo","hr_in_domingo","time","","","","required","4","TIME","NOT NULL","","","","")
    ,array("&nbsp","hr_out_domingo","time","","","","required","4","TIME","NOT NULL","","","","")
    ,array("","","label","","","","","12","","","","","","")

    //Inducción
    ,array("Inducción","","salto_linea","","","","","18","","","","","","")

    ,array("Inducción General","","salto_linea3","","","","","18","","","","","","")
    ,array("¿Qué es Cáritas?","induccion_que_es_caritas","select_x","","","|Si=Si|No=No","","4","VARCHAR (10)","NOT NULL","","","","")
    ,array("Historia y antecedentes.","induccion_historia","select_x","","","|Si=Si|No=No","","4","VARCHAR (10)","NOT NULL","","","","")
    ,array("Identidad, Misión, Visión y Valores.","induccion_identidad","select_x","","","|Si=Si|No=No","","4","VARCHAR (10)","NOT NULL","","","","")
    ,array("Estructura  ( Organigrama ).","induccion_estructura","select_x","","","|Si=Si|No=No","","4","VARCHAR (10)","NOT NULL","","","","")
    ,array("Descripción de la Misión y los servicios de cada Programa.","induccion_descripcion","select_x","","","|Si=Si|No=No","","4","VARCHAR (10)","NOT NULL","","","","")

    ,array("Entrega, reflexiòn estudio documentos","","salto_linea3","","","","","18","","","","","","")
    ,array("Trípticos","entrega_doc_tripticos","select_x","","","|Si=Si|No=No","","4","VARCHAR (10)","NOT NULL","","","","")
    ,array("Estatutos","entrega_doc_estatutos","select_x","","","|Si=Si|No=No","","4","VARCHAR (10)","NOT NULL","","","","")
    ,array("Reglamento Interno de Trabajo","entrega_doc_reglamento","select_x","","","|Si=Si|No=No","","4","VARCHAR (10)","NOT NULL","","","","")
    ,array("Informe Anual","entrega_doc_informe","select_x","","","|Si=Si|No=No","","4","VARCHAR (10)","NOT NULL","","","","")
    ,array("Dcto. Vivamos el amor preferencial de los pobres","entrega_doc_vivamos_amor","select_x","","","|Si=Si|No=No","","4","VARCHAR (10)","NOT NULL","","","","")

    ,array("Eventos de procuración de fondos","","salto_linea3","","","","","18","","","","","","")
    ,array("Colecta Anual","induccion_colecta_anual","select_x","","","|Si=Si|No=No","","4","VARCHAR (10)","NOT NULL","","","","")
    ,array("Semana de Cáritas","induccion_semana_caritas","select_x","","","|Si=Si|No=No","","4","VARCHAR (10)","NOT NULL","","","","")
    ,array("Raspadito","induccion_rapadito","select_x","","","|Si=Si|No=No","","4","VARCHAR (10)","NOT NULL","","","","")
    ,array("Subasta de obras de arte","induccion_subasta_arte","select_x","","","|Si=Si|No=No","","4","VARCHAR (10)","NOT NULL","","","","")
    ,array("Sorteo entre Amigos","induccion_sorteo_amigos","select_x","","","|Si=Si|No=No","","4","VARCHAR (10)","NOT NULL","","","","")
    ,array("Campaña de Cobijas y Cenas Navideñas","induccion_cobijas","select_x","","","|Si=Si|No=No","","4","VARCHAR (10)","NOT NULL","","","","")
    ,array("Campaña en Colegios","induccion_colegios","select_x","","","|Si=Si|No=No","","4","VARCHAR (10)","NOT NULL","","","","")
    ,array("Jornadas de apoyo en especie en diferentes Parroquias","induccion_jornadas","select_x","","","|Si=Si|No=No","","4","VARCHAR (10)","NOT NULL","","","","")
    ,array("Observaciones ","induccion_observaciones","textarea","","","","","12","TEXT","NOT NULL","","","","")
    ,array("Firma del empleado ","firma_empleado","textarea","","","","","12","TEXT","NOT NULL","","","","")
    ,array("","id_empleado","hiddenInsert","","","","","","INT (8)","NOT NULL","","","","")

    /*Acceso a la plataforma
    ,array("Acceso a la plataforma","","salto_linea","","","","","18","","","","","","")
    ,array("Usuario","usuario","text","","","","","12","VARCHAR (100)","NOT NULL","si","","","")
    ,array("Password","password","password","","","","","4","VARCHAR (100)","NOT NULL","","","","")
    ,array("Repite Password","repassword","password","","","","","4","","","","","","")

    ,array("Permisos en plataforma","","salto_linea3","","","","","22","","","","","","")

    ,array("","","permisos","","","","","","","","","","","")*/

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
      /*Validaciones de password
        var pass1 = $('[name=password]');
        var pass2 = $('[name=repassword]');
        var confirmacion = "Las contraseñas coinciden";
        var longitud = "La contraseña debe estar formada entre 6-10 carácteres (ambos inclusive)";
        var negacion = "No coinciden las contraseñas";
        var vacio = "La contraseña no puede estar vacía";    
        var span = $('<span></span>').insertAfter(pass2);//oculto por defecto el elemento span
        span.hide();    
        function coincidePassword(){//función que comprueba las dos contraseñas
          var valor1 = pass1.val();
          var valor2 = pass2.val();      
          span.show().removeClass();//muestro el span      
          if(valor1 != valor2){//condiciones dentro de la función
            span.text(negacion).addClass('negacion');	
          }
          if(valor1.length==0 || valor1==""){
            span.text(vacio).addClass('negacion');	
          }
          if(valor1.length<6 || valor1.length>10){
            span.text(longitud).addClass('negacion');
          }
          if(valor1.length!=0 && valor1==valor2){
            span.text(confirmacion).removeClass("negacion").addClass('confirmacion');
          }
        }    
        pass2.keyup(function(){//ejecuto la función al soltar la tecla
          coincidePassword();
        });*/
      
      //Acciones antes de enviar formulario
      $( "#validation-form" ).submit(function( event ) {
        $( "#estado_radica" ).prop( "disabled", false );
        $( "#municipio_radica" ).prop( "disabled", false );
        $( "#programa_alta" ).prop( "disabled", false );
        $( "#puesto_alta" ).prop( "disabled", false );
        $( "#nivel_alta" ).prop( "disabled", false );
        $( "#decanato" ).prop( "disabled", false );
        $( "#parroquia" ).prop( "disabled", false );
        $( "#colonia" ).prop( "disabled", false );
      });
       
      //Adaptacion al cambiar Estado Nacimiento  
      $("#estado_nac").change(function(event)
          {
            $.post('saca_datos.php',{estado_radica:$("#estado_nac").val(),opc:"2"}, function(res_mun_radica) 
            {
              $( "#municipio_nac" ).html( res_mun_radica);
              $( "#municipio_nac" ).attr('disabled', false);

            });

          });
      
      // Adaptacion al cambiar Estado Radica  
      $("#estado_radica").change(function(event)
          {
            $.post('saca_datos.php',{estado_radica:$("#estado_radica").val(),opc:"2"}, function(res_mun_radica) 
            {
              $("#municipio_radica").attr('disabled', false);
              $( "#municipio_radica" ).html( res_mun_radica);

            });

          });

      // // Adaptacion al cambiar Municipio Radica 
      $("#municipio_radica").change(function(event)
          {
            $.post('saca_datos.php',{
                municipio_radica:$("#municipio_radica").val(),
                estado_radica:$("#estado_radica").val(),
                opc:"5"
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
        $.post('saca_datos.php',{cp:$cp,opc:"32"}, function(res) 
            {
              $( "#estado_radica" ).val(res);
            });
        $.post('saca_datos.php',{cp:$cp,opc:"33"}, function(res) 
            {
              $( "#municipio_radica" ).val(res);
            });
        $.post('saca_datos.php',{cp:$cp,opc:"34"}, function(res) 
            {
              $( "#colonia" ).html(res);
              $( "#colonia" ).prop( "disabled", false );
            });
      });

      /*Adaptacion al cambiar Parroquia
      $("#parroquia").change(function(event)
          {
            $.post('saca_datos.php',{parroquia:$("#parroquia").val(),opc:"10"}, function(res_mun) 
            {
              $( "#decanato" ).html( res_mun);

            });

            $.post('saca_datos.php',{parroquia:$("#parroquia").val(),opc:"11"}, function(res_mun) 
            {
              $( "#vicaria" ).html( res_mun);

            });
          
          });*/

      //Adaptacion al cambiar Vicaria
      $("#vicaria").change(function(event)
      {
        $.post('saca_datos.php',{vicaria:$("#vicaria").val(),opc:"12"}, function(res_mun) 
        {
          $("#decanato").attr('disabled', false);
          $( "#decanato" ).html( res_mun);
          $.post('saca_datos.php',{decanato:$("#decanato").val(),opc:"13"}, function(res_mun) 
          {
            $("#parroquia").attr('disabled', false); 
            $( "#parroquia" ).html( res_mun);

          });

        });

      });
      
      //Adaptacion al cambiar Decanato	  
      $("#decanato").change(function(event)
          {
            $.post('saca_datos.php',{decanato:$("#decanato").val(),opc:"13"}, function(res_mun) 
            {
              $("#parroquia").attr('disabled', false);
              $( "#parroquia" ).html( res_mun);

            });
          });
      
      //Adaptacion al cambiar Escolaridad
      $("#escolaridad").change(function(event)
          {
            var escolaridad=$("#escolaridad").val();

            if(escolaridad=='Licenciatura'||escolaridad=='Posgrado'){
              $("#licenciatura_posgrado").attr('disabled', false);
            }else{
              $("#licenciatura_posgrado").attr('disabled', true);
            }
          });
      
      //Adaptacion al cambiar Programa
      $("#programa_alta").change(function(event)
          {
            $.post('saca_datos.php',{programa:$("#programa_alta").val(),opc:"35"}, function(res) 
            {
              $("#puesto_alta").attr('disabled', false);
              $( "#puesto_alta" ).html(res);

            });
          });
      
      //Adaptacion al cambiar Puesto
      $("#puesto_alta").change(function(event)
          {
            $.post('saca_datos.php',{puesto:$("#puesto_alta").val(),opc:"36"}, function(res) 
            {
              $( "#nivel_alta" ).val(res);

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