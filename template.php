<?php
session_start();
if($_SESSION[admin_id_pub]){
include "config.php";
$pagina="Captura PUB";

//CONFIGURACION DE PAGINA
$color_form="naranja";
$color_imprimir="naranja";
$color_botones="blanco";
$url="forms/rh_emp_avisoSalida.php";
$nomb_tabla="rh_capacitacion";
$nombre_formulario="Formulario";
$titulo_boton_agregar="Agregar Reporte";
$genera_reportes="no";
$imp_id="";	//mostrar id en imprimir 

// //ELEMENTOS DE FORMULARIO Reportes
// $array_variables=array(
// //Normal: array(«Nombre de elemento»,«Campo DB»,«tipo (text,number,textarea,date)»,"","","",«Parametros HTML»,«Tamaño (2,4,6,8,12)»,«Tipo dato DB (VARCAHR(50)»,«Parametros DB (NOT NULL)»,«Se muestra en tabla (si,no)»,"","","","")
// //Seleccion: array(«Nombre de elemento»,«Campo DB»,«tipo (select_x,select_sql)»,"«si es select_sql: nombre de tabla DB»","«si es select_sql: nombre de campo DB»","«Si el select_x: Lista de elementos separada por |»",«Parametros HTML»,«Tamaño (2,4,6,8,12)»,«Tipo dato DB (VARCAHR(50)»,«Parametros DB (NOT NULL)»,«Se muestra en tabla (si,no)»,"","","","«Condicion DB (WHERE)»")
//  array("Fecha actual","fecha","date","","","","required","4","date","NOT NULL","si","","","")
// ,array("Quien realiza el reporte","quien_realiza_reporte","select_x","","","|Esposa=Esposa|Pariente=Pariente|Empleado=Empleado|Otro=otro","required","4","VARCHAR (50)","NOT NULL","si","","","")
// ,array("Quien (Otro)","quien_otro","text","","","","","4","VARCHAR (50)","NOT NULL","","","","")
// ,array("Medio de reporte", "medio_reporte", "select_x","","","|Telefono=telefono|Whatsapp=whatsapp|E-mail=email|Otro=otro","required","4","VARCHAR (50)","NOT NULL","si","","","")
// ,array("Medio de reporte (Otro)","medio_reporte_otro","text","","","","","4","VARCHAR (50)","NOT NULL","","","","")
// ,array("Causa de reporte", "causa_reporte", "select_x","","","|Enfermedad=enfermedad|Problematransporte=problema_transporte|Accidente=accidente|Otro=otro","required='required'","4","VARCHAR (50)","NOT NULL","","","","")
// ,array("Cual causa (otro)","causa_reporte_otro", "text","","","","","4","VARCHAR (50)","NOT NULL","","","","")
// ,array("Dias probables de ausencia","dias_ausencia","number","","","","","4","int (8)","NOT NULL","si","","","")
// ,array("Fecha probable Regreso","fecha_regreso","date","","","","","4","date","NOT NULL","si","","","")
// ,array("Goce de sueldo", "goce_sueldo", "select_x","","","|Si=si|No=no","","4","VARCHAR (50)","NOT NULL","si","","","")
// ,array("Comentario adicional","comentario_adicional","textarea","","","","style='resize: none'","12","text","NOT NULL","","","","")
// ,array("*Nombre de quien reporta","nombre_reporta","text","","","","required","4","VARCHAR (100)","NOT NULL","","","","")
// ,array("*Nombre De Quien Aprueba (Jefe De Departamento)","nombre_aprueba","text","","","","required","8","VARCHAR (100)","NOT NULL","","","","")
// ,array("Observaciones","observaciones","textarea","","","","style='resize: none'","12","text","NOT NULL","","","","")
// );  

// //ELEMENTOS DE FORMULARIO aviso de salida
// $array_variables=array(
// //Normal: array(«Nombre de elemento»,«Campo DB»,«tipo (text,number,textarea,date)»,"","","",«Parametros HTML»,«Tamaño (2,4,6,8,12)»,«Tipo dato DB (VARCAHR(50)»,«Parametros DB (NOT NULL)»,«Se muestra en tabla (si,no)»,"","","","")
// //Seleccion: array(«Nombre de elemento»,«Campo DB»,«tipo (select_x,select_sql)»,"«si es select_sql: nombre de tabla DB»","«si es select_sql: nombre de campo DB»","«Si el select_x: Lista de elementos separada por |»",«Parametros HTML»,«Tamaño (2,4,6,8,12)»,«Tipo dato DB (VARCAHR(50)»,«Parametros DB (NOT NULL)»,«Se muestra en tabla (si,no)»,"","","","«Condicion DB (WHERE)»")
//  array("*Fecha actual","fecha","date","","","","required='required'","4","date","NOT NULL","si","","","")
// ,array("Motivo de salida","motivo_salida","textarea","","","","required style='resize: none'","12","text","NOT NULL","","","","")
// ,array("Domicilio al que se dirige","","salto_linea","","","","","","","","","","","")//salto de linea 
// ,array("*Municipio","municipio_nac","select_sql","tcat_municipios","municipio","","required","4","VARCHAR (100)","NOT NULL","","","","","WHERE id_estado=14")
// ,array("*Colonia","colonia","select_sql","tcat_colonias","colonia","","required","4","VARCHAR (100)","NOT NULL","","","","","WHERE id=10")
// ,array("*Calle y numero","calle_numero","text","","","","required='required'","4","VARCHAR (100)","NOT NULL","","","","")
// ,array("*Codigo postal","cp","number","","","","required='required'","4","VARCHAR (100)","NOT NULL","","","","")
// ,array("*Persona que con quien se dirige","persona_dirige","date","","","","required='required'","4","VARCHAR (100)","NOT NULL","si","","","") 
// ,array("Persona que con quien (otro)","persona_dirige_otro","date","","","","","4","date","NOT NULL","","","","") 
// ,array("*Hora de salida","hora_salida","time","","","","required='required'","4","time","NOT NULL","si","","","") 
// ,array("*Hora de entrada","hora_entrada","time","","","","required='required'","4","time","NOT NULL","si","","","") 
// ,array("*Firma Autorizacion operativo","firma_autorizacion","text","","","","required='required'","4","VARCHAR (50)","NOT NULL","","","","") 
// ,array("*Firma Solicitante","firma_solicitante","text","","","","required='required'","4","VARCHAR (50)","NOT NULL","","","","") 
// ,array("*Firma Recursos Humanos","firma_rh","text","","","","required='required'","4","VARCHAR (50)","NOT NULL","","","","") 
// ,array("Observaciones","observaciones","textarea","","","","style='resize: none'","12","text","NOT NULL","si","","","") 
// );  

// //ELEMENTOS DE FORMULARIO Solicitud de Vacaciones
// $array_variables=array(
// 	array("Fecha","fecha","date","","","","require='require'","4","date","NOT NULL","si","","","")
//    ,array("Fecha De Ingreso","fecha_ingreso","date","","","","require='require'","4","date","NOT NULL","si","","","")
//    ,array("Dias a tomar","dias_a_tomar","number","","","","require='require'","4","int (2)","NOT NULL","si","","","")
//    ,array("Periodo de Vacaciones","","salto_linea","","","","","","","","","","","")//salto de linea 
//    ,array("Inicio De Vacaciones","inicio_vacaciones","date","","","","require='require'","4","date","NOT NULL","si","","","")
//    ,array("Termino De Vacaciones","termino_vacaciones","date","","","","require='require'","4","date","NOT NULL","si","","","")
//    ,array("Año De Trabajo Correspondiente","anio_trabajo_correspondiente","number","NOT NULL","","","require='require'","4","int","NOT NULL","","","","")
//    ,array("Firma Autorizacion Coordinador del programa","firma_autorizacion_coord","select_x","NOT NULL","","|Si=si|No=no","required='required'","6","VARCHAR (50)","NOT NULL","","","","")
//    ,array("Firma Empleado","firma_empleado","select_x","","","|Si=si|No=no","required='required'","6","VARCHAR (50)","NOT NULL","","","","")
//    ,array("Observaciones","observaciones","textarea","","","","style='resize: none'","12","text","NOT NULL","si","","","")
// );

// //ELEMENTOS DE FORMULARIO Solicitud de Prestamo fondo de ahorro
// $array_variables=array(
// 	array("Importe","importe","number","","","","require='require'","4","double","NOT NULL","si","","","")
//    ,array("Forma de pago","forma_pago","text","","","","require='require'","4","varchar (200)","NOT NULL","si","","","")
//    ,array("Plazo de pago","plazo_pago","text","","","","require='require'","4","varchar (200)","NOT NULL","si","","","")
//    ,array("Firma Autorizacion Coordinador","firma_autorizacion_coord","text","","","","require='require'","4","VARCHAR (50)","NOT NULL","","","","")
//    ,array("Firma Empleado","firma_empleado","select_x","","","|Si=si|No=no","require='require'","4","VARCHAR (50)","NOT NULL","","","","")
//    ,array("Firma RH","firma_rh","select_x","","","|Si=si|No=no","required='required'","4","VARCHAR (50)","NOT NULL","","","","") 
//    ,array("Observaciones","observaciones","textarea","","","","style='resize: none'","12","text","NOT NULL","si","","","")
// );

// // ELEMENTOS DE FORMULARIO atencion empleados
// $array_variables=array(
// 	array("Numero","numero","number","","","","require='require'","4","VARCHAR (100)","NOT NULL","si","","","")
//    ,array("Fecha","fecha","date","","","","require='require'","4","varchar (100)","NOT NULL","si","","","")
//    ,array("Datos Personales","","salto_linea","","","","","","","","","","","")//salto de linea
//    ,array("Nombre","nombre","text","","","","require='require'","4","varchar (100)","NOT NULL","si","","","")
//    ,array("Apellido paterno","appat","text","","","","require='require'","4","VARCHAR (100)","NOT NULL","si","","","")
//    ,array("Apellido Materno","apmat","text","","","","","4","VARCHAR (100)","NOT NULL","si","","","")
//    ,array("Fecha de nacimiento","fecha_nac","date","","","","require='require'","4","date","NOT NULL","","","","")
//    ,array("Lugar de nacimiento","","salto_linea","","","","","","","","","","","")//salto de linea
//     //lugar de nacimiento
//    ,array("Estado","estado_nac","select_sql","tcat_estados","estado","","require='require'","6","VARCHAR (100)","NOT NULL","","","","")
//    ,array("Municipio","municipio_nac","select_sql","tcat_municipios","municipio","","require='require'","6","VARCHAR (100)","NOT NULL","si","","","","WHERE id_estado=14")
//    ,array("RFC","rfc","text","","","","require='require'","4","VARCHAR (100)","NOT NULL","","","","")
//    ,array("CURP","curp","text","","","","require='require'","4","VARCHAR (100)","NOT NULL","","","","")
//    ,array("Numero de IMSS","numero_imss","number","","","","require='require'","4","VARCHAR (100)","NOT NULL","","","","")
//    ,array("Numero de clinica","numero_clinica","number","","","","require='require'","4","VARCHAR (100)","NOT NULL","","","","")
//    ,array("Tipo de Sangre","tipo_sangre","select_x","","","|A+=a+|B-=b-|AB+=ab+|AB-=ab-|O+=o+|O-=o-","require='require'","4","VARCHAR (100)","NOT NULL","si","","","")
//    ,array("En que","cap_tec_en_que","textarea","","","","style='resize: none'","12","text","NOT NULL","","","","")
//    ,array("Habilidades del empleado","habilidades_empleado","textarea","","","","style='resize: none'","12","text","NOT NULL","","","","")  
//    ,array("Exteriencia en grupos parroquiales","experiencia_gpos_parroquiales","select_x","","","|Si=si|No=no","require='require'","4","VARCHAR (100)","NOT NULL","","","","") 
//    ,array("Cual","cual_exp_gpos_parr","textarea","","","","style='resize: none'","12","text","NOT NULL","","","","")
//    ,array("Domicilio","","salto_linea","","","","","","","","","","","")//salto de linea
//    //Domicilio
//    ,array("Estado Donde Radica","estado_radica","select_sql","tcat_estados","estado","","require='require'","6","VARCHAR (100)","NOT NULL","","","","")
//    ,array("Municipio","municipio_radica","select_sql","tcat_municipios","municipio","","require='require'","6","VARCHAR (100)","NOT NULL","","","","","WHERE id_estado=14")
//    ,array("Calle","calle","text","","","","require='require'","4","VARCHAR (100)","NOT NULL","","","","")
//    ,array("Numero Exterior","num_ext","number","","","","require='require'","2","VARCHAR (100)","NOT NULL","","","","")
//    ,array("Letra Exterior","letra_ext","text","","","","","2","VARCHAR (100)","NOT NULL","","","","")
//    ,array("Numero Interior","num_int","number","","","","","2","VARCHAR (100)","NOT NULL","","","","")
//    ,array("Letra Interior","letra_int","text","","","","","2","VARCHAR (100)","NOT NULL","","","","")
//    ,array("Colonia","colonia","select_sql","tcat_colonias","colonia","","","4","VARCHAR (100)","NOT NULL","","","","","WHERE id=10")
//    ,array("Código Postal","cp","number","","","","require='require'","2","VARCHAR (100)","NOT NULL","","","","")
//    ,array("Primera Calle Cruce","primer_cruce","text","","","","","4","VARCHAR (100)","NOT NULL","","","","")
//    ,array("Segunda Calle Cruce","segundo_cruce","text","","","","","4","VARCHAR (100)","NOT NULL","","","","") 
//    ,array("Parroquia que pertenece","","salto_linea","","","","","","","","","","","")//salto de linea
//  	//Parroquia que pertenece
//    ,array("Parroquia","parroquia","select_sql","c_parroquias","nombre_parroquia","","","4","VARCHAR (100)","NOT NULL","si","","","")
//    ,array("Decanato","decanato","select_sql","c_decanatos","decanato","","","4","VARCHAR (100)","NOT NULL","","","","") 
//    ,array("Vicaria","vicaria","select_sql","c_vicarias","vicaria","","","4","VARCHAR (100)","NOT NULL","","","","") 
//    ,array("Telefono","telefono","number","","","","require","4","VARCHAR (10)","NOT NULL","","","","") 
//    ,array("Vivienda","vivienda","select_x","","","|Propia=propia|Rentada=rentada|Prestada=prestada","require","4","VARCHAR (100)","NOT NULL","","","","") 
//    ,array("Credito Infonavit","credito_infonavit","select_x","","","|SI=si|No=no","","4","VARCHAR (10)","NOT NULL","","","","") 
//    ,array("Vehiculo propio","vehiculo_propio","select_x","","","|SI=si|No=no","","4","VARCHAR (10)","NOT NULL","","","","") 
//    ,array("Modelo","modelo_vehiculo","text","","","","","4","VARCHAR (100)","NOT NULL","","","","") 
//    ,array("Placas","placas_vehiculo","text","","","","","4","VARCHAR (100)","NOT NULL","","","","") 
//    ,array("Datos familiares","","salto_linea","","","","","","","","","","","")//salto de linea
//    //Datos familiares 
//    ,array("Estado civil","estado_civil","select_x","","","|Soltero(a)=soltero(a)|Casado(a)=casado(a)|Union libre=union libre|Viudo(a)=viudo(a)|Separado(a)=separado(a)","","4","VARCHAR (100)","NOT NULL","","","","") 
//    ,array("Casado(a) por el civil","casado_civil","select_x","","","|Si=si|No=no","","4","VARCHAR (10)","NOT NULL","","","","") 
//    ,array("Casado(a) por la iglesia","casado_iglesia","select_x","","","|Si=si|No=no","","4","VARCHAR (10)","NOT NULL","","","","") 
//    ,array("Nombre Del Padre","nombre_padre","text","","","","","4","VARCHAR (100)","NOT NULL","","","","") 
//    ,array("Situación del padre","situacion_padre","select_x","","","|Vivo=vivo|Finado=finado","","4","VARCHAR (30)","NOT NULL","","","","") 
//    ,array("Nombre De La Madre","nombre_madre","text","","","","","4","VARCHAR (100)","NOT NULL","","","","") 
//    ,array("Situación de la madre","situacion_madre","select_x","","","|Vivo=vivo|Finado=finado","","4","VARCHAR (30)","NOT NULL","","","","") 
//    ,array("Nombre Del Esposo(A)","nombre_esposo","text","","","","","4","VARCHAR (100)","NOT NULL","","","","") 
//    ,array("Situación Esposo (A)","situacion_esposo","select_x","","","|Vivo=vivo|Finado=finado","","4","VARCHAR (30)","NOT NULL","","","","") 
//    ,array("Número De Hijos","numero_hijos","number","","","","","4","int (8)","NOT NULL","","","","") 
//    ,array("Edades hijos","edades_hijos","textarea","","","","style='resize: none'","12","text","NOT NULL","","","","") 
//    ,array("Enfermos en casa","enfermos_casa","select_x","","","|Si=si|No=no","","4","VARCHAR (100)","NOT NULL","","","","") 
//    ,array("Padecimiento","padecimiento","textarea","","","","style='resize: none'","12","text","NOT NULL","","","","")  
//    ,array("Ingresos","","salto_linea","","","","","","","","","","","")//salto de linea
//     // Ingresos 
//    ,array("Número De Contrato","numero_contrado","number","","","","","4","int","NOT NULL","si","","","") 
//    ,array("Fecha De Ingreso A Cáritas","ingreso_caritas","date","","","","","4","date","NOT NULL","","","","") 
//    ,array("Fecha De Alta","fecha_alta","date","","","","","4","date","NOT NULL","","","","")  
//    ,array("Programa","programa_alta","select_x","","","|Casos emergentes=Casos emergentes|C. parroquial=C. parroquial|P.F.=P.F.|Admon=admon","","4","VARCHAR (100)","NOT NULL","","","","") 
//    ,array("Puesto","puesto","text","","","","","4","VARCHAR (100)","NOT NULL","si","","","")  
//    ,array("Sueldo","","salto_linea","","","","","","","","","","","")//salto de linea
// 	//    Sueldo 
//    ,array("Tipo de salario","tipo_salario","select_x","","","|Fijo=fijo","","4","VARCHAR (30)","NOT NULL","","","","")  
//    ,array("Alta Nomipaq","alta_nomipaq","select_x","","","|Si=si|No=no","required='required'","4","VARCHAR (10)","NOT NULL","","","","")  
//    ,array("Datos Nomipaq","datos_nomipaq","number","","","","require='require'","4","double","NOT NULL","","","","")  
//    ,array("Alta seguro social","alta_ss","select_x","","","|Si=si|No=no","","4","VARCHAR (10)","NOT NULL","","","","")    
//    ,array("Matricula IMSS","matricula_imss","number","","","","","4","double","NOT NULL","","","","")  
//    ,array("Alta huella en reloj checador","alta_huella","select_x","","","|Si=si|No=no","required='required'","4","VARCHAR (10)","NOT NULL","","","","")  
//    ,array("Horarios","","salto_linea","","","","","","","","","","","")//salto de linea
   
// 	// HORARIOS (dias laborales, horarios de trabajo) 
//     //faltan Checkbox para dias de lunes a viernes 
//    ,array("Dia de descanso","dia_descanso","select_x","","","|Lunes=Lunes|Martes=Martes|Miercoles=Miercoles|Jueves=Jueves|Viernes=Viernes|Sabado=Sabado|Domingo=Domingo","require='require'","4","VARCHAR (30)","NOT NULL","","","","")  
//    ,array("Horario de entrada","hora_entrada","time","","","","","4","time","NOT NULL","","","","")   
//    ,array("Horario de salida","hora_salida","time","","","","","4","time","NOT NULL","","","","")    
//   );  

// // INDUCCIÓN GENERAL (Recursos Humanos ) 
// $array_variables=array(
//      array("¿Qué es Cáritas?","induccion_que_es_caritas","select_x","","","|Si=Si|No=No","","4","VARCHAR (10)","NOT NULL","si","","","")  
//     ,array("Historia y antecedentes.","induccion_historia","select_x","","","|Si=Si|No=No","","4","VARCHAR (10)","NOT NULL","si","","","")  
//     ,array("Identidad, Misión, Visión y Valores.","induccion_identidad","select_x","","","|Si=Si|No=No","","4","VARCHAR (30)","NOT NULL","si","","","")  
//     ,array("Estructura ( Organigrama ).","induccion_estructura","select_x","","","|Si=Si|No=No","","4","VARCHAR (10)","NOT NULL","","","","")  
//     ,array("Descripción de la Misión y los servicios de cada Programa.","induccion_descripcion","select_x","","","|Si=Si|No=No","","6","VARCHAR (10)","NOT NULL","si","","","")  
//     //Entrega, reflexiòn estudio documentos
//     ,array("Trípticos","entrega_doc_tripticos","select_x","","","|Si=Si|No=No","","4","VARCHAR (10)","NOT NULL","si","","","")  
//     ,array("Estatutos","entrega_doc_estatutos","select_x","","","|Si=Si|No=No","","4","VARCHAR (10)","NOT NULL","si","","","")  
//     ,array("Reglamento Interno de Trabajo","entrega_doc_reglamento","select_x","","","|Si=Si|No=No","","4","VARCHAR (10)","NOT NULL","si","","","")  
//     ,array("Informe Anual","entrega_doc_informe","select_x","","","|Si=Si|No=No","","4","VARCHAR (10)","NOT NULL","si","","","")  
//     ,array("Dcto. Vivamos el amor preferencial de los pobres","entrega_doc_vivamos_amor","select_x","","","|Si=Si|No=No","","4","VARCHAR (10)","NOT NULL","si","","","")  
//     // EVENTOS DE PROCURACIÓN DE FONDOS
//     ,array("Colecta Anual","induccion_colecta_anual","select_x","","","|Si=Si|No=No","","4","VARCHAR (10)","NOT NULL","","","","")  
//     ,array("Semana de Cáritas","induccion_semana_caritas","select_x","","","|Si=Si|No=No","","4","VARCHAR (10)","NOT NULL","","","","")  
//     ,array("Raspadito","induccion_rapadito","select_x","","","|Si=Si|No=No","","4","VARCHAR (10)","NOT NULL","","","","")  
//     ,array("Subasta de obras de arte","induccion_subasta_arte","select_x","","","|Si=Si|No=No","","4","VARCHAR (10)","NOT NULL","","","","")  
//     ,array("Sorteo entre Amigos","induccion_sorteo_amigos","select_x","","","|Si=Si|No=No","","4","VARCHAR (10)","NOT NULL","","","","")  
//     ,array("Campaña de Cobijas y Cenas Navideñas ","induccion_cobijas","select_x","","","|Si=Si|No=No","","4","VARCHAR (10)","NOT NULL","","","","")  
//     ,array("Campaña en Colegios","induccion_colegios","select_x","","","|Si=Si|No=No","","4","VARCHAR (10)","NOT NULL","","","","")  
//     ,array("Jornadas de apoyo en especie en diferentes Parroquias","induccion_jornadas","select_x","","","|Si=Si|No=No","","6","VARCHAR (10)","NOT NULL","","","","")  
//     ,array("Observaciones","induccion_observaciones","textarea","","","","style='resize: none'","12","text","NOT NULL","","","","")    
//     ,array("Firma del empleado","firma_empleado","textarea","","","","style='resize: none'","12","text","NOT NULL","","","","")   
//   );

// Capacitaciones
$array_variables=array(
     array("Fecha","fecha","date","","","","require","4","date","NOT NULL","si","","","")  
    ,array("Nombre De La Capacitacion","nombre_capacitacion","text","","","","require","4","VARCHAR (100)","NOT NULL","si","","","")
    ,array("Tema De La Capacitacion","tema_capacitacion","text","","","","require","4","VARCHAR (100)","NOT NULL","si","","","")
    ,array("Duracion","","salto_linea","","","","","","","","","","","")//salto de linea 
    ,array("Fecha De Inicio","inicio_vacaciones","date","","","","require","4","date","NOT NULL","si","","","")
    ,array("Fecha De Termino","termino_vacaciones","date","","","","require","4","date","NOT NULL","si","","","")
    ,array("Dias","","salto_linea","","","","","","","","","","","")//salto de linea 
    //Checkboxs con los dias de la semana
    ,array("Lunes","dia_cap_lunes","checkbox","Lunes","","","","2","varchar(20)","","si","","","")  
    ,array("Lunes","dia_cap_martes","checkbox","Martes","","","","2","varchar(20)","","si","","","")  
    ,array("Lunes","dia_cap_martes","checkbox","Martes","","","","2","varchar(20)","","si","","","")  
    ,array("Lunes","dia_cap_martes","checkbox","Martes","","","","2","varchar(20)","","si","","","")  
    ,array("Observaciones","observaciones","textarea","","","","","12","text","NOT NULL","si","","","")
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
			include "contenido_engine_template.php"; //Cambiar PHP de contenido
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