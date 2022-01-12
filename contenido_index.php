<div class="page-wrapper">
<div class="container-fluid">
	<!-- Title -->
	<div class="row heading-bg bg-blue">
	  <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<a href="index.php"><h5 class="txt-light">PUB</h5></a>
		</div>
		<div  class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
			
			
			<p align="right">
				
			</p>

		</div>

			<!-- Breadcrumb -->
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<!-- <li><a href=#>Panel de Control</a></li> -->
				<li class="active"><span><?php echo $pagina;?></span></li>
			</ol>
		</div>
	</div>

		<!-- <p align="center" style="font-size: 28px;">Noticias</p><br />
		<hr style="height: 3px; background-color: #6B6B6B; color: #6B6B6B; border-top: #6B6B6B !important ;" /> -->

<?php 

$tipo_user=$_SESSION["tipo_usuario"];	

if($tipo_user==1){
$sql="SELECT COUNT(id) as contador,usuario.id_comedor,c_comedor.nombre,usuario.id_usuario FROM captura 
LEFT JOIN usuario ON (usuario.id_usuario=captura.`usuario_inserta`)
LEFT JOIN c_comedor ON (c_comedor.`id_c_comedor`=usuario.`id_comedor`)
GROUP BY id_comedor";
$con=conectar();
$sql=mysql_query($sql,$con);

while($row=mysql_fetch_array($sql)){
	$id_comedor=$row["id_comedor"];
	//$usuario_c=$row["id_usuario"];
	$aprobados=mysql_este("SELECT COUNT(id_beneficiario) as contador FROM beneficiario WHERE id_c_comedor='$id_comedor'","contador",$con);
	$encuestas=mysql_este("SELECT COUNT(id) as contador FROM alta_ben_comedores WHERE id_comedor='$id_comedor'","contador",$con);

	//echo "SELECT COUNT(id_beneficiario) as contador FROM beneficiario WHERE id_c_comedor='$usuario_c'";

echo'

<div class="col-md-4" style="margin-bottom:10px;">
<div class="main container-fluid" style="background-color:#fff; color:#fff">
					<div class="row">
						<div class="col-sm-12">
							<hr style=" border-top-color: #fff; color: #fff;background-color: #D7D7D7; height: 50px; margin-top: -35px; margin-left:-50px; margin-right:-50px;">
							<strong><h6 style="color:#000; margin-left: -40px; margin-right: -40px; margin-top: -75px;"><li>Comedor: '.$row["nombre"].'</li></h6></strong><br>
						</div>
					</div>


						<strong><p align="left" style="font-size:17px; color: #000; margin-top:10px;">Cantidad de Registros Capturados: '.number_format($row["contador"],0).'</p></strong>
						<strong><p align="left" style="font-size:17px; color: #000; margin-top:10px;">Cantidad de encuestas aplicadas: '.number_format($encuestas,0).'</p></strong>
						<strong><p align="left" style="font-size:17px; color: #000; margin-top:10px;">Cantidad de Registros Aprobados: '.number_format($aprobados,0).'</p></strong>
			      	
</div>
</div>

';

}

}


?>

	   

	    
		

	  




		<!-- Modals Traspasos pendientes  -->
		
		
<footer class="footer container-fluid pl-30 pr-30">
	<div class="row">
		<div class="col-sm-5">
			<a href="index.php" class="brand mr-30">
				<img src="assets/logo.ico" width="42" height="42"/>
			</a>
			<ul class="footer-link nav navbar-nav">
				<!-- <li class="logo-footer"><a href="#">Ayuda</a></li>
				<li class="logo-footer"><a href="#">Aviso de Privacidad</a></li> -->
			</ul>
		</div>
		<div class="col-sm-7 text-right">
			<p>2019 &copy; PUB</p>
		</div>
	</div>
</footer>