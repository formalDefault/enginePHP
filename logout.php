<?php
session_start();
include "funciones.php";
@include "config.php";

?>

<!DOCTYPE html>

<html lang="es">

<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cerrar Sesion</title>
  <link rel="shortcut icon" href="assets/logoDIF.png">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    <!--[if lt IE 9]>

      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>

      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

    <![endif]-->
    <script src="./js/libs/jquery-1.8.3.min.js"></script>

    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
    <link href="./css/ui-lightness/jquery-ui-1.10.0.custom.min.css" rel="stylesheet" />
    <link href="./js/plugins/msgGrowl/css/msgGrowl.css" rel="stylesheet" />
    <link href="./js/plugins/lightbox/themes/evolution-dark/jquery.lightbox.css" rel="stylesheet" />  
    <link href="./js/plugins/msgbox/jquery.msgbox.css" rel="stylesheet" />  
    <script src="./js/plugins/msgGrowl/js/msgGrowl.js"></script>
<script src="./js/plugins/lightbox/jquery.lightbox.min.js"></script>
<script src="./js/plugins/msgbox/jquery.msgbox.min.js"></script>

</head>

<body>

<?php
  $con=conectar();
  $usuario=$_SESSION["admin_usuario"];

  $ultimo=mysql_este("select max(id) as maximo from logsesiones where usuario ='$usuario'","maximo",$con);

  //echo $ultimo;

if (1==1)
 {  session_destroy();

  $hora_i=mysql_este("select hora_i from logsesiones where id ='$ultimo'","hora_i",$con);
  $hora_i=date("Y-m-d")." ".$hora_i;
  $hora_i=new DateTime($hora_i);
  
  $hora_f=date("H:i:s");
  $hora_f=date("Y-m-d")." ".$hora_f;
  $hora_f=new DateTime($hora_f);

  $hora_f2=date("H:i:s");

  $hora_diferencia=$hora_f->diff($hora_i);
  $diferencia=$hora_diferencia->format('%H horas %i minutos %s segundos');

  $salida="update logsesiones set activa='no', hora_f='$hora_f2',tiempo_conexion='$diferencia'  where id='$ultimo'";
  //echo $salida;
  $salida=mysql_query($salida,$con);


    unset($_SESSION[$session_id]);
    unset($_SESSION[$session_usuario]);
    unset($_SESSION[$session_dependencia]);
    unset($_SESSION[$session_nombre]);



   echo alerta_bota("Sesion cerrada correctamente","correcto","index.php");




}else{

     echo alerta_bota("Actualmente no tiene una sesión activa","correcto","index.php");

}
function alerta_bota($mensaje,$tipo,$url){
if($tipo=="informacion"){$tipo="info";}elseif($tipo=="error"){$tipo="error";}elseif($tipo=="alerta"){$tipo="warning";}
elseif($tipo=="correcto"){$tipo="success";}
$url='"'.$url.'"';
echo "
<script>
$( document ).ready(function() {



    $.msgbox('".$mensaje."', {
      type: 'confirm',
      buttons : [
        {type: 'submit', value: 'Aceptar'},
        
      ]
    }, function(result) {
      if(result){
        elimina();
      }
    });
    function elimina(){
      window.location=".$url.";
    }

});

</script>


";

}
?>

</body>

</html>