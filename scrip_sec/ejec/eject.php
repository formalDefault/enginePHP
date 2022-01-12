<?php 
include "../../funciones.php";
echo '
<head>
<meta http-equiv="refresh" content="10">
</head> 
';

$con=conectar();

$query="insert into beneficiario (id_beneficiario,id_c_programa,id_c_comedor,fecha_asignacion,nb_nombre,nb_primer_ap,nb_segundo_ap,nb_curp,fh_nacimiento,cve_estatus,usuario_alta) (select captura.id,53,alta_ben_comedores.id_comedor,'$fecha',
captura.nombre,captura.appat,captura.apmat,captura.`curp`,
captura.`fecha_nacimiento`,
'AC',1 from captura
left join alta_ben_comedores on (alta_ben_comedores.fpu=captura.id)
where vulnerabilidad<>'Seguro' and id_comedor<>'' and alta_ben_comedores.sinc='')";

if(mysql_query($query,$con)){

$upsinc="update alta_ben_comedores set sinc='si' where vulnerabilidad<>'Seguro' and id_comedor<>'' and alta_ben_comedores.sinc=''";
mysql_query($upsinc,$con);

	echo "Ok";
}

?>