<?php
include "config.php";
function conectar1() 
{
global $servidordb;
global $userdb;
global $passdb;
global $nombredb;
 
 if(!($con1 = mysql_connect($servidordb,$userdb,$passdb)))
 {die("No se hizo la conexion al servidor favor de verificar");
  }
 
 return $con1;
}
function conectar2() 
{
global $servidordb;
global $userdb;
global $passdb;
global $nombredb;
 
 if(!($con2 = mysql_connect($servidordb,$userdb,$passdb)))
 {die("No se hizo la conexion al servidor favor de verificar");
  }
 if(!mysql_select_db($nombredb,$con2))
 {die("No se hizo la conexión con la base de datos favor de verificar");
  }//*/
 return $con2;
}


$accion=$_GET["accion"];
if($accion=="crear"){
$con1=conectar1();

$existe_db=mysql_select_db($nombredb,$con1);
if($existe_db){
echo"
<script>alert('La base de datos ya existe no es necesario crearla nuevamente')</script>

";

}else{
	
	$db_crea="create database $nombredb";
	mysql_query($db_crea,$con1);

	$con2=conectar2();

	$user_crea="CREATE TABLE usuarios (
  id int(8) NOT NULL auto_increment PRIMARY KEY,
  nombre varchar(100) default NULL,
  appat varchar(100) default NULL,
  apmat varchar(100) default NULL,
  email varchar(100) default NULL,
  fecha_nac date default NULL,
  password varchar(60) default NULL,
  usuario LONGTEXT default NULL,
  tipo int(4) default NULL,
  dependencia int(4) default NULL,
  area int(4) default NULL    
) ENGINE=innodb AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;";
	
	$logsesiones="CREATE TABLE logsesiones (
  id int(8) NOT NULL auto_increment PRIMARY KEY,
  usuario varchar(100) default NULL,
  agent varchar(100) default NULL,
  ip varchar(100) default NULL,
  hora time,
  fecha date
) ENGINE=innodb AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;";

$perfil="CREATE TABLE perfil (
  id int(8) NOT NULL auto_increment PRIMARY KEY,
  perfil varchar(50) default NULL
) ENGINE=innodb AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;";

mysql_query($perfil,$con2);

$inserta_perfil="INSERT INTO perfil(perfil) VALUES ('Administrador');";
mysql_query($inserta_perfil,$con2);

$inserta_perfil="INSERT INTO perfil(perfil) VALUES ('Usuario');";
mysql_query($inserta_perfil,$con2);

$insert_default="INSERT INTO usuarios(nombre,appat,apmat,email,fecha_nac,password,usuario,tipo) 
VALUES ('Administrador','del','Sistema','admin@admin.com','1990-06-14','a3c54c81921a04bc702c96a521b5cb0fecaeb84e','admin','1');
";
	//echo $insert_default;
	mysql_query($user_crea,$con2);
	mysql_query($logsesiones,$con2);
	mysql_query($insert_default,$con2);
echo'
<script>
alert("Correcto");
</script>
';
echo "<script>alert('Base de datos y tabla de usuarios creados :)')</script>
";
}
}

?>