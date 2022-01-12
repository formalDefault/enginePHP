<?php
session_start();

include ("funciones.php");
include ("config.php");
$con=conectar();

date_default_timezone_set('America/Mexico_City');
$usuario=mysql_real_escape_string(obten("usuario"));
$password=mysql_real_escape_string(obten("password"));
?>
<!DOCTYPE html>

<html lang="es">
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
  <link rel="shortcut icon" href="assets/logoDIF.png">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    <!--[if lt IE 9]>

      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>

      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

    <![endif]-->  
    <!--alerts CSS -->
    <link href="vendors/bower_components/sweetalert/dist/sweetalert.css" rel="stylesheet" type="text/css">
    
    <!-- Custom CSS -->
    <link href="dist/css/style.css" rel="stylesheet" type="text/css">    
    <script src="vendors/bower_components/sweetalert/dist/sweetalert.min.js"></script>

    <script src="vendors/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    
  <!-- Data table JavaScript -->
  
  <!-- Slimscroll JavaScript -->
    <script src="vendors/bower_components/jquery/dist/jquery.min.js"></script>
    
    <!-- Bootstrap Core JavaScript -->
    <script src="vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        
    <!-- Sweet-Alert  -->
    <script src="vendors/bower_components/sweetalert/dist/sweetalert.min.js"></script>
    
    <script src="dist/js/sweetalert-data.js"></script>
    
    <!-- Slimscroll JavaScript -->
    <script src="dist/js/jquery.slimscroll.js"></script>
  
  <!-- Fancy Dropdown JS -->
  <script src="dist/js/dropdown-bootstrap-extended.js"></script>
    
    <!-- Init JavaScript -->
    <script src="dist/js/init.js"></script>

</head>

<body>
<?php
function alerta_si($titulo,$texto,$urlsi,$urlno){

  $retorno="

<div id='top'> 

<a class='btn' href='#' data-toggle='modal' data-target='#myModal'>

  

</a>

</div>

<!-- Modal -->

<div class='modal fade' id='myModal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>

  <div class='modal-dialog'>

    <div class='modal-content'>

      <div class='modal-header'>

        <a type='button' class='close' href='$urlno'>&times;</a>

        <h3 class='modal-title' id='myModalLabel'>$titulo</h3>

      </div>

      <div class='modal-body'>

        <h3>$texto</h3>

      </div>

      <div class='modal-footer'>

        <a type='button' class='btn btn-default' href='$urlsi'>Si</a>

        <a type='button' class='btn btn-default' href='$urlno'>No</a>

      </div>

    </div>

  </div>

</div>

<script>



    $(document).ready(function() {

        $('#top').find('a').trigger('click');

    });

</script>



  ";

  echo $retorno;

}
function alerta_bota($mensaje,$tipo,$url){
if($tipo=="informacion"){$tipos="info";}elseif($tipo=="error"){$tipos="error";}elseif($tipo=="alerta"){$tipos="warning";}
elseif($tipo=="correcto"){$tipos="success";}
$url='"'.$url.'"';
echo "
<script>

$( document ).ready(function() {

   swal({ 
  title: '".$tipo."',
   text: '".$mensaje."',
    type: '".$tipos."' 
  },
  function(){
    window.location.href = $url;
});
   

});

</script>


";

}

if($usuario&&$password)

{
$ip=$_SERVER['REMOTE_ADDR'];
$datos=$_SERVER['HTTP_USER_AGENT'];
$fecha=date("Y-m-d");
$hora=date("H:i:s");
$hora_inicio = date("H:i:s",strtotime("-1 hour"));

  $seguridad="select * from logsesiones where usuario='".$usuario."' and fecha='".$fecha."' and hora_i>'".$hora_inicio."' and tipo<>'Correcto'";
  $seguridad=mysql_query($seguridad,$con);
  //$rowseg=mysql_fetch_array($seguridad);
  $seguridad=mysql_num_rows($seguridad);

  //verificar si existe sesion activa

  $hora_sesion_activa = date("H:i:s",strtotime("-15 minutes"));
  $dia_sesion=date("Y-m-d");
  //echo $hora_sesion_activa;
  $ultimo=mysql_este("select max(id) as maximo from logsesiones where usuario ='$usuario' and hora_i>'$hora_sesion_activa' and fecha='$dia_sesion'","maximo",$con);
  //echo "select max(id) as maximo from logsesiones where usuario ='$usuario' and hora_i>'$hora_sesion_activa' and fecha='$dia_sesion'";
  $segver=mysql_este("select activa from logsesiones where id='$ultimo'","activa",$con);
  //echo "segver".$segver;

  //fin sesion activa

if($seguridad<300){
 $consulta="SELECT usuario.* FROM usuario
   WHERE usuario='".$usuario."'
 ";
 $result=mysql_query($consulta,$con) or die("Error en la Consulta: (" . mysql_error() . ") ");

 if($row=mysql_fetch_array($result))

 {
$salt=$usuario;
  if($row["password"]==sha1(md5(sha1($salt.$password))))

  {
      if(1==2){
      //if($segver=="si"){
      echo alerta_bota('Actualmente cuenta con una sesión activa, cierre sesion o intente en 15 minutos mas','error','index.php');

      }else{
      global $session_id;
      global $session_usuario;
      global $session_tipo;
      global $session_nombre;
      global $session_area;

      $_SESSION[$session_id]=$row["id_usuario"];
      $_SESSION[$session_usuario]=$row["email"];

      $_SESSION["usuario"]=$row["usuario"];
      $_SESSION["admindif_admin_id"]="ok";
      $_SESSION["usuario_id"]=$row["id_usuario"];
      $_SESSION["tipo_usuario"]=$row["nivel_acceso"];
      $_SESSION["id_cliente_14"]=$row["cliente"];
      $_SESSION["id_comedor"]=$row["id_comedor"];
      
      
      $_SESSION[$session_area]=$row["areas"];

      $_SESSION[$session_nombre]=trim($row["nombre"])." ".trim($row["appat"])." ".trim($row["apmat"]);

      $fecha=date("Y-m-d");
      $hora=date("H:i:s");

      $inserta_mal="insert into logsesiones (usuario,agent,ip,hora_i,fecha,tipo,activa) values ('$usuario','$datos','$ip','$hora','$fecha','Correcto','si')";
      $inserta_mal=mysql_query($inserta_mal,$con);



      echo alerta_bota('Bienvenido: '.$_SESSION[$session_nombre].'','correcto','index.php');
    }//fin de verificar sesion activa
  }//IF DE SI LA CLAVE ES LA MISMA
  else
  {
    echo alerta_bota('Verifique su Contraseña','error','login.php');
	$inserta_mal="insert into logsesiones (usuario,agent,ip,hora_i,fecha,tipo) values ('$usuario','$datos','$ip','$hora','$fecha','Error')";
	$inserta_mal=mysql_query($inserta_mal,$con);
	
    }//ELSE DE SI LA CLAVE ES LA MISMA

  }//IF DEL RESULT SI EL USUARIO ES IGUAL

  else

  {

    echo alerta_bota('Disculpe verifica tu nombre de usuario','error','login.php');
	$inserta_mal="insert into logsesiones (usuario,agent,ip,hora_i,fecha) values ('$usuario','$datos','$ip','$hora_i','$fecha','Error')";
	$inserta_mal=mysql_query($inserta_mal,$con);
	
  

  }//ELSE DEL RESULT SI EL USUARIO ES IGUAL

  mysql_close($con);

}else{
$checa=sha1(date("Y-m-d"));
$token=sha1(date("H:i:s"));
 echo alerta_bota('Inicio de sesion bloqueado por 1 hora debido a exceso de intentos fallidos.','error','login.php');
}

}

?>

</body>


</html>