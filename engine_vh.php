<?php
	include "funciones.php";
	$accion=addslashes(obten("accion"));
	$id=addslashes(obten("id"));
	include "config.php";
	global $urlbase;

	if ($accion=="agregar") echo formulario($con,$id,$url,$nombre_formulario,$nomb_tabla,$array_variables,$color_form,$color_botones,$urlbase); 
	if ($accion=="editar") echo edit($con,addslashes(obten("id_registro")),$url,$nombre_formulario,$nomb_tabla,$array_variables,$color_form,$color_botones,$urlbase,addslashes(obten("id"))); 
	if ($accion=="eliminar") echo eliminar($con,$id,$nomb_tabla,$url, addslashes(obten("id_registro")));
	if ($accion=="eliminarok") echo eliminarok($con,$id,$nomb_tabla,$url);
	if ($accion=="modificar") echo modificar($con,$id,$url,$nombre_formulario,$nomb_tabla,$array_variables, addslashes(obten("id_registro")));
	if ($accion=="aa") echo imprimir($con,$url,$nomb_tabla,$array_variables,$color_imprimir,$color_botones,$titulo_boton_agregar,$nombre_formulario,$imp_id);
	if ($accion=="insertar") echo insertar($con,$id,$url,$nombre_formulario,$nomb_tabla,$array_variables);
	if ($accion=="sql") echo sql($con,$nomb_tabla,$array_variables,$url);
	if ($accion=="menu") echo imprimir($con,$url,$nomb_tabla,$array_variables,$color_imprimir,$color_botones,$titulo_boton_agregar,$nombre_formulario,$imp_id,$urlbase,$genera_reportes,$id);
	if ($accion=="") echo imprimirLista($con,$url,$nomb_tabla,$array_variables,$color_imprimir,$color_botones,$titulo_boton_agregar,$nombre_formulario,$imp_id,$urlbase,$genera_reportes);
	if ($accion=="captura_edo_bd") echo captura_edo_bd($url,$id,$nomb_tabla); 

	// if ($accion=="alerta") echo alerta_bota();
	function sql($con,$nomb_tabla,$array_variables,$url){
		$con=conectar();
		$query_verifica="show tables";
		$query_verifica=mysql_query($query_verifica,$con);
		while($row = mysql_fetch_array($query_verifica)){$array_tablas[]=$row[0];
		}
		$contador=count($array_tablas);
		$existe="";
		for($i=0;$i<$contador;$i++){

			if($array_tablas[$i]==$nomb_tabla){
				$existe="si";
				}
			}
		if($existe=="si"){
		//LA TABLA SI EXISTE Y SE REDIRECCIONA
		echo alerta_bota('La tabla ya existe no es necesario crearla nuevamente','error',''.$url.'');
		}else{ 
		//LA TABLA NO EXISTE Y SE PROCEDE A CREAR LA TABLA	
			$contador=count($array_variables);
			for($i=0;$i<$contador;$i++){
				$arreglo=$array_variables[$i];
				$nombre=$arreglo[1];
				$caracteristicas=$arreglo[8];
				$nulo=$arreglo[9];
					if($caracteristicas){
						$final.=", ".$nombre." ".$caracteristicas." ".$nulo;
					}
				}
			$query="CREATE TABLE $nomb_tabla (
			id INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY$final) ENGINE = innodb;";
			echo $query;
			mysql_query("begin",$con);
			mysql_query($query,$con);
			mysql_query("commit",$con);
			echo alerta_bota('La tabla fue creada Exitosamente','correcto',''.$url.'');
			}

	}//FIN FUNCION SQL

	function imprimir($con,$url,$nomb_tabla,$array_variables,$color_imprimir,$color_botones,$titulo_boton_agregar,$nombre_formulario,$imp_id,$urlbase,$genera_reportes,$id){ 
		$nameEmp=addslashes(obten("name"));
		$con=conectar();
		$contador=count($array_variables);
		$query_datosVh = 'accion=menu&id='.$id.'';
		$buscador=obten("buscar"); 
		for($i=0;$i<$contador;$i++){
			$arreglo_buscar=$array_variables[$i];
			$label1=$arreglo_buscar[0];
			$name=$arreglo_buscar[1];
			$type=$arreglo_buscar[2];
			$tabla_cat=$arreglo_buscar[3];
			$campo_cat=$arreglo_buscar[4];
			$campos_x=$arreglo_buscar[5];
			$parametros=$arreglo_buscar[6];
			$columnas=$arreglo_buscar[7];
			$busqueda=$arreglo_buscar[10];
			if($busqueda){
				$arreglo_busqueda[]=array($label1,$name,$type,$tabla_cat,$campo_cat,$campos_x,$parametros,$columnas,$busqueda);
			}	
		}
		/*INICIA EL FOR DE LAS VARIABLES DEL BUSCADOR
		$contador_busq=count($arreglo_busqueda);
		for($i=0;$i<$contador_busq;$i++){
				$arreglo_busqueda=$arreglo_busqueda[$i];
				$label_busq=$arreglo_busqueda[0];
				$name_busq=$arreglo_busqueda[1];
				$type_busq=$arreglo_busqueda[2];
				}
		//FIN FOR VARIABLES BUSQUEDA*/ ; 
		$orden_lista=addslashes(obten("orden_lista"));

		if(!$orden_lista){$orden_lista_registro="ASC";}else if($orden_lista=="ASC"){$orden_lista_registro="DESC";}else if($orden_lista=="DESC"){$orden_lista_registro="ASC";}
		//VARIABLE DE LIMITE Y OBTENER VARIABLE LIMITE_REGISTRO
		$limite_registro=addslashes(obten("limite_registro"));
		$limite=25;
		if($limite_registro)
		{
			$limite=$limite_registro;
		}

		//IF DEL SELECT DE NUMERO DE REGISTROS POR PAGINA
		//ORDERNAMIENTO 
			$aux=obten("aux");
		//OBTENER VARIABLE INDICE
		$indice=obten("indice");
		echo' 
			<link href="vendors/bower_components/filament-tablesaw/dist/tablesaw.css" rel="stylesheet" type="text/css"/>
			
			<div class="" style="margin-bottom:15px;margin-top-10px">  
				<div class="flex flex-row ">   
					<a href="oa_organismos_detalles.php?'.$query_datosVh.'" class=" btn btn-primary" >
						Detalles de organismo
					</a> 
					<a href="oa_solicitudes.php?'.$query_datosVh.'" class="ml-10 btn btn-success"">
						Solicitudes
					</a>
					<a href="oa_movimientos.php?'.$query_datosVh.'" class="ml-10 btn btn-danger">
						Movimientos
					</a> 
					<a href="oa_proyectos.php?'.$query_datosVh.'" class="ml-10 btn btn-success">
						Proyectos
					</a> 
					<a href="oa_organismos.php" class="ml-10 btn btn-primary">
						Regresar al menu de organismos
					</a> 
				</div>
			</div> 					
			
		<div class="row">
			<div class="col-sm-12">	
				<div class="panel panel-default card-view">      		
					<div class="panel-heading"> 		
						<div class="pull-left">
							<i class="icon-folder-close"></i>
							<h6 class="panel-title txt-dark">'.$nombre_formulario.'</h3>
						</div> 
					</div> <!-- /widget-header -->
					<div class="panel-wrapper collapse in">
						<div class="panel-body">
							<div class="table-wrap">	
								<div class="mt-40">	
							
									<section id="buttons">'; 
									echo'
										<p align="center"><a href="'.$url.'?accion=agregar&id='.$id.' " class="btn btn-large btn-success">
										'.$titulo_boton_agregar.'</a></p> 
									'; 

									
									echo' 
									
									<section id="tables">
									<form action="'.$url.'" method="post" enctype="multipart/form-data">
		

									<div class="col-sm-6 col-md-4">
										<div class="input-group">
											<input type="text" autofocus  class="form-control" name="buscar" id="buscar" placeholder="Buscar" value="'.$buscador.'">
											<span class="input-group-btn">
											<input type="submit" class="btn btn-primary">
											</span>
										</div>
									</div>
									</form>
								
									<br /><br /><br />


									<table class="tablesaw table-striped table-hover table-bordered table" data-tablesaw-mode="columntoggle">
										<thead>
										<tr>
										'; 
							$contador_busq=count($arreglo_busqueda);
									if($imp_id){echo'<th>ID</th>';}
							for($i=0;$i<$contador_busq;$i++){
									$arreglo_bus2=$arreglo_busqueda[$i];
									$label_busq=$arreglo_bus2[0];
									echo'
									<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="'.$i.'">'.$label_busq.'</th>		
									';
									}?>
										<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">Acciones</th>
										</tr>
										</thead>
										<tbody>
								<?php
								$limite="30";
								$pagina=obten("pagina");
								if($pagina<=0)$pagina=1;
								$pagina=$limite*($pagina-1);
								$contador_busq=count($arreglo_busqueda);
									for($i=0;$i<$contador_busq;$i++){
									$arreglo_bus2=$arreglo_busqueda[$i];
									$label_busq=$arreglo_bus2[0];
									$name_busq=$arreglo_bus2[1];
									$type_busq=$arreglo_bus2[2];
									$tabla_cat=$arreglo_bus2[3];
									$campo_cat=$arreglo_bus2[4];
									$campos_x=$arreglo_bus2[5];
									$parametros=$arreglo_bus2[6];
									$columnas=$arreglo_bus2[7];
									$busqueda=$arreglo_bus2[8];

									if($type_busq=="select_sql"){
										$cruce.=" LEFT join $tabla_cat on ($nomb_tabla.$name_busq=$tabla_cat.id)";
										$concat=$campo_cat[0].$campo_cat[1].$campo_cat[2].$campo_cat[3].$campo_cat[4].$campo_cat[5].$campo_cat[6].$campo_cat[7].$campo_cat[8];

										if($concat=="CONCAT_WS" or $concat=="concat_ws"){
											$variables.=",".$campo_cat." as ".$name_busq;
											$var_array[]=array($campo_cat);
										}else{
										$variables.=",".$tabla_cat.".".$campo_cat;
											$var_array[]=array($tabla_cat.".".$campo_cat);
										}					
										}else{
										$variables.=",".$nomb_tabla.".".$name_busq;
										$var_array[]=array($nomb_tabla.".".$name_busq);
											}
									}
								//echo $consulta_sql_numero;

								for($i=0;$i<$contador_busq;$i++){
									
									if($i==0){
									$concatenador.=$var_array[$i][0];
									}else{$concatenador.=",".$var_array[$i][0];}
									}
									$current_user=$_SESSION["admindif_admin_id"];
								$fin_concat="CONCAT_WS(' ',".$concatenador.")";
								//echo $fin_concat; 
								if($url == "oa_organismos_detalles.php"){
									$query_num="SELECT $nomb_tabla.id $variables FROM $nomb_tabla $cruce WHERE $nomb_tabla.id=$id AND $nomb_tabla.id_estado != 3 AND $fin_concat like'%$buscador%'";
								} else {
									$query_num="SELECT $nomb_tabla.id $variables FROM $nomb_tabla $cruce WHERE $nomb_tabla.id_organismo=$id AND $fin_concat like'%$buscador%'";
								}
								//echo $query_num;
								$query_num_con=mysql_query($query_num,$con);
								$num_registros = mysql_num_rows($query_num_con);
								$numero_paginas=ceil($num_registros/$limite);
								$query_imprimir="$query_num order by id DESC limit $pagina, $limite";
								$query_con=mysql_query($query_imprimir,$con);
								$query_num_imprimir=mysql_num_rows($query_con);
								if($query_num_imprimir==0)echo "<h2 align='center'>No se encontraron registros</h2>"; 

								while($row=mysql_fetch_array($query_con)){ 
									echo'
									<tr>'; 
									if($imp_id){				
									echo'	<tr>
											<!--<td class="center">
												<label>
													<input type="checkbox" />
													<span class="lbl"></span>
												</label>
											</td>-->
											<td class="title tablesaw-cell-persist"><a href="javascript:void(0)">
												'.$row[id].'
											</td> 
											';
									}
											$contador_busq=count($arreglo_busqueda);
											for($i=0;$i<$contador_busq;$i++){
											$arreglo_bus2=$arreglo_busqueda[$i];
											$label_busq=$arreglo_bus2[0];
											$name_busq=$arreglo_bus2[1];
											$type_busq=$arreglo_bus2[2];
											$tabla_cat=$arreglo_bus2[3];
											$campo_cat=$arreglo_bus2[4];
											$campos_x=$arreglo_bus2[5];
											$parametros=$arreglo_bus2[6];
											$columnas=$arreglo_bus2[7];
											$busqueda=$arreglo_bus2[8];
											$mas=$arreglo_bus2[14];
											$valor=(($row[$name_busq]));
											$valorsql=$row[$campo_cat];
											if($mas){
												$plus_id=$valor;
												$plus_tabla=$tabla_cat;
												}
											
											if($type_busq=="date"){
												$valor=invierte_fecha($valor);
												}
												
											if($type_busq=="file"){
												if($valor){
													$formato=explode(".",$valor);
													$extencion=$formato[1];
													if($extencion=="jpg" or $extencion=="png" or $extencion=="JPG" or $extencion=="PNG"){
														echo'
														<td align="center"><a href='.$urlbase.$valor.'><img src="'.$urlbase.$valor.'" width="60px"></a></td>
														';}else{echo'<td align="center"><a href='.$urlbase.$valor.'><span class="btn btn-lg glyphicon glyphicon-file"></span></a></td>';
															}
												}else{echo'<td></td>';}
												
												}elseif($type_busq=="select_sql"){
													echo'
														<td class="title tablesaw-cell-persist"><a href="javascript:void(0)">'.(strip_tags($valorsql)).'</td>
													';
												}
												else{
													echo'
													<td class="title tablesaw-cell-persist"><a href="javascript:void(0)">'.(strip_tags($valor)).'</td>
													';
												}
											
											}						            
											echo'
												<td class="title tablesaw-cell-persist"><a href="javascript:void(0)">
												<a href="'.$link.'?accion=editar&id='.$id.'&id_registro='.$row[id].'" class="btn btn-medium btn-primary"><i class="icon-pencil icon-large" style="color:#fff;"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												<a onclick="valida_borrar_registro('.$row[id].', '.$id.')" class="btn btn-medium btn-danger msgbox-inverse" alt="'.$row[id].'"><i class="icon-trash icon-large" style="color:#fff;"></a> 
												</td>
												</tr>
											'; 
									}
		?>					          
										</tbody>
									</table>
									<br />
								</div>
							</div>
						</div>
								<section id="paginations">
								<div class="pull-right pagination">
									<ul class="pagination">
							<?php 
							$pagina=obten("pagina");
							if($pagina<=0)$pagina=1;
							$pagina_ant=$pagina-1;if($pagina_ant<=1)$pagina_ant=1;
							$pag_sig=$pagina+1;if($pag_sig>=$numero_paginas)$pag_sig=$numero_paginas;
							?>
								<li class="page-pre"><a href="<?php echo $link."?buscar=".$buscador."&pagina=".$pagina_ant ?>">Anterior</a></li>
							<?php
							
							for($i=1;$i<6;$i++){
								if(($pagina-2)<1){
									if($pagina==$i){
										if($i<=$numero_paginas){
												echo'
										<li class="page-number active">
										<a href="'.$url.'?buscar='.$buscador.'&pagina='.$i.'">'.$i.'</a>
										</li>';
										}
									}else{
										if($i<=$numero_paginas){ 
										echo'<li class="page-number"><a href="'.$url.'?buscar='.$buscador.'&pagina='.$i.'">'.$i.'</a></li>';
										}
								}
								}else{
								$cont=$pagina-3+$i;
									if($cont==$pagina){
										if($cont<=$numero_paginas){
										echo'
										<li class="page-number active">
										<a href="'.$url.'?buscar='.$buscador.'&pagina='.$cont.'">'.$cont.'</a>
										</li>';
										}

									}
									else{
										if($cont<=$numero_paginas){
										echo'<li class="page-number"><a href="'.$url.'?buscar='.$buscador.'&pagina='.$cont.'">'.$cont.'</a></li>';
										}
									}
								}
							}
							?>
								<li class="page-next"><a href="<?php echo $link."?buscar=".$buscador."&pagina=".$pag_sig ?>">Siguiente</a></li>

							</ul>
							</div>
						</section>
								<br />
								<br />
								</section>
							<br /><br />
						</div> <!-- /widget-content -->
					</div> <!-- /widget -->
				</div> <!-- /span12 -->
			</div> <!-- /span12 -->
			
		<?php
	}//IMPRIMIR FIN

	//imprimir tabla para seleccionar un empleado y el formulario para agregar uno nuevo
	function imprimirLista($con,$url,$nomb_tabla,$array_variables,$color_imprimir,$color_botones,$titulo_boton_agregar,$nombre_formulario,$imp_id,$urlbase){
		$con=conectar();
		$contador=count($array_variables);
		$buscador=obten("buscar"); 
		for($i=0;$i<$contador;$i++){
			$arreglo_buscar=$array_variables[$i];
			$label1=$arreglo_buscar[0];
			$name=$arreglo_buscar[1];
			$type=$arreglo_buscar[2];
			$tabla_cat=$arreglo_buscar[3];
			$campo_cat=$arreglo_buscar[4];
			$campos_x=$arreglo_buscar[5];
			$parametros=$arreglo_buscar[6];
			$columnas=$arreglo_buscar[7];
			$busqueda=$arreglo_buscar[10];
			if($busqueda){
				$arreglo_busqueda[]=array($label1,$name,$type,$tabla_cat,$campo_cat,$campos_x,$parametros,$columnas,$busqueda);
			}	
		}
		/*INICIA EL FOR DE LAS VARIABLES DEL BUSCADOR
		$contador_busq=count($arreglo_busqueda);
		for($i=0;$i<$contador_busq;$i++){
				$arreglo_busqueda=$arreglo_busqueda[$i];
				$label_busq=$arreglo_busqueda[0];
				$name_busq=$arreglo_busqueda[1];
				$type_busq=$arreglo_busqueda[2];
				}
		//FIN FOR VARIABLES BUSQUEDA*/
		$orden_lista=addslashes(obten("orden_lista"));

		if(!$orden_lista){$orden_lista_registro="ASC";}else if($orden_lista=="ASC"){$orden_lista_registro="DESC";}else if($orden_lista=="DESC"){$orden_lista_registro="ASC";}
							//VARIABLE DE LIMITE Y OBTENER VARIABLE LIMITE_REGISTRO
							$limite_registro=addslashes(obten("limite_registro"));
							$limite=25;
							if($limite_registro)
							{
								$limite=$limite_registro;
							}

							//IF DEL SELECT DE NUMERO DE REGISTROS POR PAGINA
							//ORDERNAMIENTO 
								$aux=obten("aux");
							//OBTENER VARIABLE INDICE
							$indice=obten("indice");
		echo'
		
			<link href="vendors/bower_components/filament-tablesaw/dist/tablesaw.css" rel="stylesheet" type="text/css"/> 
			<div class="" style="margin-bottom:15px;margin-top-10px">  
			 
			</div> 	
		<div class="row">
			<div class="col-sm-12">	
				<div class="panel panel-default card-view">      		
					<div class="panel-heading"> 		
						<div class="pull-left">
							<i class="icon-folder-close"></i>
							<h6 class="panel-title txt-dark">'.$nombre_formulario.'</h3>
						</div> 
					</div> <!-- /widget-header -->
					<div class="panel-wrapper collapse in">
						<div class="panel-body">
							<div class="table-wrap">	
								<div class="mt-40">	
									
									<section id="buttons">';
									// if($url){
									// echo'
									// <p align="center"><a href="'.$url.'?accion=agregar" class="btn btn-large btn-primary">
									// '.$titulo_boton_agregar.'</a></p> 
									// ';
									// }
									echo' 

										<p align="center"><a href="'.$url.'?accion=agregar" class="btn btn-large btn-success">
										'.$titulo_boton_agregar.'</a></p> 

										<section id="tables">
										<form action="'.$url.'" method="post" enctype="multipart/form-data">


										<div class="col-sm-6 col-md-4">
											<div class="input-group">
												<input type="text" autofocus  class="form-control" name="buscar" id="buscar" placeholder="Buscar" value="'.$buscador.'">
												<span class="input-group-btn">
												<input type="submit" class="btn btn-primary">
												</span>
											</div>
										</div>
										</form>
									
										<br /><br /><br />


										<table class="tablesaw table-striped table-hover table-bordered table" data-tablesaw-mode="columntoggle">
											<thead>
											<tr>
									'; 
							$contador_busq=count($arreglo_busqueda);
									if($imp_id){echo'<th>ID</th>';}
							for($i=0;$i<$contador_busq;$i++){
									$arreglo_bus2=$arreglo_busqueda[$i];
									$label_busq=$arreglo_bus2[0];
									echo'
									<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="'.$i.'">'.$label_busq.'</th>		
									';
									}?>
											<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">Acciones</th>
										</tr>
										</thead>
										<tbody>
								<?php
								$limite="30";
								$pagina=obten("pagina");
								if($pagina<=0)$pagina=1;
								$pagina=$limite*($pagina-1);
								$contador_busq=count($arreglo_busqueda);
									for($i=0;$i<$contador_busq;$i++){
										$arreglo_bus2=$arreglo_busqueda[$i];
										$label_busq=$arreglo_bus2[0];
										$name_busq=$arreglo_bus2[1];
										$type_busq=$arreglo_bus2[2];
										$tabla_cat=$arreglo_bus2[3];
										$campo_cat=$arreglo_bus2[4];
										$campos_x=$arreglo_bus2[5];
										$parametros=$arreglo_bus2[6];
										$columnas=$arreglo_bus2[7];
										$busqueda=$arreglo_bus2[8];

										if($type_busq=="select_sql"){
											$cruce.=" LEFT join $tabla_cat on ($nomb_tabla.$name_busq=$tabla_cat.id)";
											$concat=$campo_cat[0].$campo_cat[1].$campo_cat[2].$campo_cat[3].$campo_cat[4].$campo_cat[5].$campo_cat[6].$campo_cat[7].$campo_cat[8];

											if($concat=="CONCAT_WS" or $concat=="concat_ws"){
												$variables.=",".$campo_cat." as ".$name_busq;
												$var_array[]=array($campo_cat);
											}else{
											$variables.=",".$tabla_cat.".".$campo_cat;
												$var_array[]=array($tabla_cat.".".$campo_cat);
											}					
											}else{
											$variables.=",".$nomb_tabla.".".$name_busq;
											$var_array[]=array($nomb_tabla.".".$name_busq);
												}
									}

								//echo $consulta_sql_numero;
								for($i=0;$i<$contador_busq;$i++){
									
									if($i==0){
									$concatenador.=$var_array[$i][0];
									}else{$concatenador.=",".$var_array[$i][0];}
									}
									$current_user=$_SESSION["admindif_admin_id"];
								$fin_concat="CONCAT_WS(' ',".$concatenador.")";
								//echo $fin_concat;
								$query_num="SELECT $nomb_tabla.id$variables FROM $nomb_tabla $cruce where $nomb_tabla.id_estado != 3 AND $fin_concat like'%$buscador%'";
								//echo $query_num;
								$query_num_con=mysql_query($query_num,$con);
								$num_registros = mysql_num_rows($query_num_con);
								$numero_paginas=ceil($num_registros/$limite);
								$query_imprimir="$query_num order by id DESC limit $pagina, $limite";
								$query_con=mysql_query($query_imprimir,$con);
								$query_num_imprimir=mysql_num_rows($query_con);
								if($query_num_imprimir==0)echo "<h2 align='center'>No se encontraron registros</h2>";

								while($row=mysql_fetch_array($query_con)){

							echo'
							<tr>'; 
							if($imp_id){				
							echo'	<tr>
									<!--<td class="center">
										<label>
											<input type="checkbox" />
											<span class="lbl"></span>
										</label>
									</td>-->
									<td class="title tablesaw-cell-persist"><a href="javascript:void(0)">
										'.$row[id].'
									</td> 
									';
							}
									$contador_busq=count($arreglo_busqueda);
									for($i=0;$i<$contador_busq;$i++){
									$arreglo_bus2=$arreglo_busqueda[$i];
									$label_busq=$arreglo_bus2[0];
									$name_busq=$arreglo_bus2[1];
									$type_busq=$arreglo_bus2[2];
									$tabla_cat=$arreglo_bus2[3];
									$campo_cat=$arreglo_bus2[4];
									$campos_x=$arreglo_bus2[5];
									$parametros=$arreglo_bus2[6];
									$columnas=$arreglo_bus2[7];
									$busqueda=$arreglo_bus2[8];
									$mas=$arreglo_bus2[14];
									$valor=(($row[$name_busq]));
									$valorsql=$row[$campo_cat];
									if($mas){
										$plus_id=$valor;
										$plus_tabla=$tabla_cat;
										}
									
									if($type_busq=="date"){
										$valor=invierte_fecha($valor);
										}
										
									if($type_busq=="file"){
										if($valor){
											$formato=explode(".",$valor);
											$extencion=$formato[1];
											if($extencion=="jpg" or $extencion=="png" or $extencion=="JPG" or $extencion=="PNG"){
												echo'
												<td align="center"><a href='.$urlbase.$valor.'><img src="'.$urlbase.$valor.'" width="60px"></a></td>
												';}else{echo'<td align="center"><a href='.$urlbase.$valor.'><span class="btn btn-lg glyphicon glyphicon-file"></span></a></td>';
													}
										}else{echo'<td></td>';}
										
										}elseif($type_busq=="select_sql"){

										echo'
										<td class="title tablesaw-cell-persist"><a href="javascript:void(0)">'.(strip_tags($valorsql)).'</td>
										
										';
										}





										else{
									echo'
									<td class="title tablesaw-cell-persist"><a href="javascript:void(0)">'.(strip_tags($valor)).'</td>
									
									';
											}
									
									}						            
									echo'
										<td class="title tablesaw-cell-persist"><a href="javascript:void(0)">
											<a href="'.$link.'oa_organismos_detalles.php?accion=menu&id='.$row[id].'" class="btn btn-medium btn-primary"><p style="color: white">Seleccionar</p> <i class="icon-check icon-large" style="color:#fff;"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
											</td>
										</tr>
									';
		}
		?>					          
										</tbody>
									</table>
									<br />
								</div>
							</div>
						</div>
								<section id="paginations">
								<div class="pull-right pagination">
									<ul class="pagination">
							<?php 
							$pagina=obten("pagina");
							if($pagina<=0)$pagina=1;
							$pagina_ant=$pagina-1;if($pagina_ant<=1)$pagina_ant=1;
							$pag_sig=$pagina+1;if($pag_sig>=$numero_paginas)$pag_sig=$numero_paginas;
							?>
								<li class="page-pre"><a href="<?php echo $link."?buscar=".$buscador."&pagina=".$pagina_ant ?>">Anterior</a></li>
							<?php
							
							for($i=1;$i<6;$i++){
								if(($pagina-2)<1){
									if($pagina==$i){
										if($i<=$numero_paginas){
												echo'
										<li class="page-number active">
										<a href="'.$url.'?buscar='.$buscador.'&pagina='.$i.'">'.$i.'</a>
										</li>';
										}
									}else{
										if($i<=$numero_paginas){

										echo'<li class="page-number"><a href="'.$url.'?buscar='.$buscador.'&pagina='.$i.'">'.$i.'</a></li>';
										}
								}
								}else{
								$cont=$pagina-3+$i;
									if($cont==$pagina){
										if($cont<=$numero_paginas){
										echo'
										<li class="page-number active">
										<a href="'.$url.'?buscar='.$buscador.'&pagina='.$cont.'">'.$cont.'</a>
										</li>';
										}

									}
										else{
											if($cont<=$numero_paginas){

											echo'<li class="page-number"><a href="'.$url.'?buscar='.$buscador.'&pagina='.$cont.'">'.$cont.'</a></li>';
										}
									}
								}
							}
							?>
								<li class="page-next"><a href="<?php echo $link."?buscar=".$buscador."&pagina=".$pag_sig ?>">Siguiente</a></li>

							</ul>
							</div>
						</section>
								<br />
								<br />
								</section>
							<br /><br />
						</div> <!-- /widget-content -->
					</div> <!-- /widget -->
				</div> <!-- /span12 -->
			</div> <!-- /span12 -->
			
		<?php
	}//IMPRIMIR LISTA FIN

	function modificar($con,$id,$url,$nombre_formulario,$nomb_tabla,$array_variables, $id_registro){
			
		$con=conectar();	
		$id=obten("id");
		$contador=count($array_variables);
		for($i=0;$i<$contador;$i++){
		$arreglo=$array_variables[$i];
		$name=$arreglo[1];
		$tipo_input=$arreglo[2];
		$caracteristicas=$arreglo[8];
		$valida=$arreglo[11];
		$fecha_hora=$arreglo[12];
		$ubicacion=$arreglo[13];
		if($valida){
			$valores=((trim(obten($name))));
			$query_ver=mysql_este("select * from $nomb_tabla where $name = UPPER('$valores') and id <> $id_registro",$name,$con);
			//echo $query_ver;
		}
		if(!$query_ver){
			if($caracteristicas){
					if($tipo_input<>"file"){
						if($fecha_hora<>"fecha" and $fecha_hora<>"hora"){
							$valores=((trim(obten($name))));
							if($name=="password"){
							$valores=(sha1(trim(obten($name))));
							if($i==0){$modificar=$name."=('".$valores."')";}
							else{$modificar.=",".$name."=('".$valores."')";}		
							}else{
							$valores=((trim(obten($name))));
							if($i==0){$modificar=$name."=('".$valores."')";}
							else{$modificar.=",".$name."=('".$valores."')";}	
							}
						}
					}else{

						//CHECAR NOMBRE DE IMAGEN BUG DE ENGINE
						$archivo=basename($_FILES["".$name.""]['name']);
						//

						//echo alerta_bota(''.obten($name).'',"informacion",''.$url.'');
						if($archivo){
							
									
								//echo 11111;
						actualizaImagen($id_registro,$name,$nomb_tabla,$name,$ubicacion,$con,$link);
							}
					}
			}
			$array_imagen=array($nomb_tabla,$name,$ubicacion,$con,$url);
		}else{
			echo alerta_bota('Alerta','Registro repetido favor de verificar',''.$url.'?accion=menu&id='.$id.'');
		}
		}//*/
		if(!$query_ver){
			$query="UPDATE $nomb_tabla set $modificar where id = '$id_registro'";
			//echo "<pre>".$query."</pre>";
			mysql_query("begin",$con);
			mysql_set_charset('utf8');
			mysql_query($query,$con) or die (mysql_error());
			mysql_query("commit",$con);

			echo alerta_bota('Registro modificado con éxito',"informacion",''.$url.'?accion=menu&id='.$id.'');
		}//Update

			//echo "<br /><br /><br /><br /><br /><br /><h1>Hola ".$query."</h1>";
	}//MODIFICAR

	function insertar($con,$id,$url,$nombre_formulario,$nomb_tabla,$array_variables){
			/*
			foreach($_POST as $nombre_campo => $valor){
				if($i==0){$values=$nombre_campo;}else{$values.=",".$nombre_campo;}
				if($i==0){$valores="'".trim(strtoupper($valor))."'";}else{$valores.=",'".trim(strtoupper($valor))."'";}
			}*/
			echo '<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>';

				$con=conectar();
				$contador=count($array_variables);
				$cantidad_valida=0;
				for($i=0;$i<$contador;$i++)
				{
				$arreglo=$array_variables[$i];
				$name=$arreglo[1];
				$tipo_input=$arreglo[2];
				$caracteristicas=$arreglo[8];
				$valida=$arreglo[11];
				$fecha_hora=$arreglo[12];
				$ubicacion=$arreglo[13];

				if($valida)
				{
						$arreglo_repetido["nombre"][$cantidad_valida]=$name;
						$arreglo_repetido["dato"][$cantidad_valida]=((trim(obten($name))));
						$cantidad_valida++;
						//$query_ver=mysql_este("select * from $nomb_tabla where $name = UPPER('$valores')",$name,$con);
						//echo $query_ver;
				}
				/*if(!$query_ver)
				{//*/
					if($caracteristicas)
					{
						if($tipo_input<>"file")
						{
							if($fecha_hora)
							{
								if($fecha_hora=="fecha"){$valores=date("Y-m-d");}else{$valores=date("H:i:s");}
								if($i==0){$values=$name; $valor="('".$valores."')";}
								else{$values.=",".$name;  $valor.=",('".$valores."')";}	
							} 
							elseif($name=="password")
							{
								$valores=(sha1(trim(obten($name))));
								if($i==0){$values=$name; $valor="('".$valores."')";}
								else{$values.=",".$name;  $valor.=",('".$valores."')";}	
							}
							else
							{
								$valores=((trim(obten($name))));
								if($i==0){$values=$name; $valor="('".$valores."')";}
								else{$values.=",".$name;  $valor.=",('".$valores."')";}	
							}
						}

						$array_imagen=array($nomb_tabla,$name,$ubicacion,$con,$url);

					}

				/*}
				else
				{
					echo alerta_bota('Alerta','Registro repetido favor de verificar',''.$url.'');
				}//*/
			}// FIN FOR
			/*$estatus=strtoupper(addslashes(trim(obten("estatus"))));
			$medicamento=strtoupper(addslashes(trim(obten("medicamento"))));//*/
			if($cantidad_valida)
			{
				for($rep=0;$rep<$cantidad_valida;$rep++)
				{
					if($rep==0)
					{
						$arregloRep.=$arreglo_repetido["nombre"][$rep]." = '".$arreglo_repetido["dato"][$rep]."'";
					}
					else if($rep>0)
					{
						$arregloRep.=" AND ".$arreglo_repetido["nombre"][$rep]." = '".$arreglo_repetido["dato"][$rep]."'";
					}
				}
				//echo "SELECT COUNT(*) AS repetido FROM $nomb_tabla WHERE $arregloRep";
				$query_ver=mysql_este("SELECT COUNT(*) AS repetido FROM $nomb_tabla WHERE $arregloRep","repetido",$con);
			}

			if(!$query_ver){  
				if($url != "oa_organismos.php"){
					$query="INSERT INTO $nomb_tabla ($values, id_organismo) VALUES ($valor, '.$id.') "; 
				}
				else
				{
					$query="INSERT INTO $nomb_tabla ($values) VALUES ($valor)"; 
				}
				//echo $query;
				mysql_query("begin",$con);
				mysql_set_charset('utf8');
				mysql_query($query,$con) or die (mysql_error());
				mysql_query("commit",$con);
				$campo_img=$array_imagen[1];
				$nombre_imagen=$array_imagen[1];
				$ubicacion=$array_imagen[2];
				$con=$array_imagen[3];
				$link=$array_imagen[4];
				
				$contador=count($array_variables);
					for($i=0;$i<$contador;$i++){
					$arreglo=$array_variables[$i];
					$name=$arreglo[1];
					$ubicacion=$arreglo[13];
					$tipo_input=$arreglo[2];
					$ubicacion;						//echo 1111111111;

						if($tipo_input=="file"){
							$archivo=basename($_FILES[$name]['name']);
													//echo 1111111111; 
							if($archivo){
							subeImagen($name,$nomb_tabla,$name,$ubicacion,$con,$url);
							//echo 1111111111;
							}
						}
					}
				// echo alerta_bota('Registro guardado con éxito','correcto',''.$url.'?accion=menu&id='.$id.'');
				echo alerta_bota('Registro guardado con éxito','correcto',$url == 'oa_organismos.php' ? 'oa_organismos.php' : $url.'?accion=menu&id='.$id.'');
			}
			else
			{
				echo alerta_bota('Registro repetido favor de verificar','error',''.$url.'');
			}
			//*/

			//echo "<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><h4>$query</h4>";
	}//INSERTAR

	function formulario($con,$id,$url,$nombre_formulario,$nomb_tabla,$array_variables,$color_form,$color_botones,$urlbase)
	{
		$nameEmp=addslashes(obten("name"));
		$con=conectar();
		// $sql="SELECT * FROM $nomb_tabla where id = '$id' ";
		// $result = mysql_query($sql,$con) or die (mysql_error());
		// if ($row = mysql_fetch_array($result)) {
		// $accion="modificar";
		// }else{
		// 	$accion="insertar";
		// } 
		echo'
		<div class="panel panel-default">
			<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="widget stacked">
						<div class="widget-header">
							<i class="icon-check"></i>
							<h3>'.$nombre_formulario.'<br>Los campos marcados con asterisco (*) son obligatorios</h3>
						</div> <!-- /widget-header -->
						<div class="widget-content">
							<br />
							<form action="'.$url.'?id='.$id.'&accion=insertar" id="validation-form" class="form-horizontal" method="post" enctype="multipart/form-data" />
							<input type="hidden" name="accion2" id="accion2" value="'.$accion.'">
								<fieldset>';
					$contador=count($array_variables);
					for($i=0;$i<$contador;$i++){
					$arreglo=$array_variables[$i]; 
					$label=$arreglo[0];
					$name=$arreglo[1];
					$tipo=$arreglo[2];+
					$tabla_cat=$arreglo[3];
					$campo_cat=$arreglo[4];
					$campos_x=$arreglo[5];
					$parametros=$arreglo[6];
					$columnas=$arreglo[7];
					$VerRepSql=$arreglo[13];
					
					$where_sql="";
					if($accion=="insertar")
					{
						$where_sql=$arreglo[14];
					}
					if($tipo=="text" or $tipo=="time" or $tipo=="password" or $tipo=="date" or $tipo=="number" or $tipo=="email"){
						$name2=(utf8_encode($row[$name])); 
						echo''.campo($label,$columnas,$tipo,$name,$name2,$parametros,"18","100").'';
					} 
						if($tipo=="checkbox"){
							$name2=(utf8_encode($row[$name])); 
							echo''.campo($label,$columnas,$tipo,$name,$tabla_cat,$parametros,"18","100").'';
						}
						if($tipo=="label"){
							$name2=(utf8_encode($row[$name])); 
							echo''.label($label,$columnas,"18","100").'';
						} 
						elseif($tipo=="hidden"){
							$name2=(($_SESSION[realchange_usuario]));
							echo''.campo('',$columnas,$tipo,$name,$name2,$parametros,"18","100").'';
						} 
						elseif($tipo=="hiddenInsert"){ 
							$name2 = $id;
							// $name = 'id_empleado';
							echo''.hiddenInsert('',$columnas,$tipo,$name,$id,$parametros,"18","100").'';
						}//inserta id de usario a las llaves foraneas
						elseif($tipo=="textarea"){
							$name2=(($row[$name]));
							echo''.memo($label,$columnas,$name,$name2,$parametros,"5","5").'';
						}
						elseif($tipo=="wisi"){
							$name2=(utf8_encode($row[$name]));
							echo''.wisi($label,$columnas,$name,$name2,$parametros,"5","5").'';
						}
						elseif($tipo=="wisicolor"){
							$name2=(utf8_encode($row[$name]));
							echo''.wisicolor($label,$columnas,$name,$name2,$parametros,"5","5").'';
						}
						elseif($tipo=="select_sql"){
							if($VerRepSql){
									$name2=(utf8_encode($row[$name]));
									$sql='select id,'.$campo_cat.' from '.$tabla_cat.' where id not in (select id from '.$nomb_tabla.') '.$where_sql.' order by '.$campo_cat.'';
								echo''.select_sql($label,$columnas,$name,$name2,$parametros,$sql,$campo_cat,"id",$con).'';
								}else{
									$name2=(utf8_encode($row[$name]));
									$sql='select id,'.$campo_cat.' from '.$tabla_cat.' '.$where_sql.' order by '.$campo_cat.'';
									echo''.select_sql($label,$columnas,$name,$name2,$parametros,$sql,$campo_cat,"id",$con).'';
								}
						}
						elseif($tipo=="select_x"){
							$name2=(utf8_encode($row[$name]));
							$sql='select id,'.$campo_cat.' from '.$tabla_cat.' order by '.$campo_cat.'';
							echo''.select_x($label,$columnas,$name,$name2,$parametros,$campos_x).'';
						}
						elseif($tipo=="file"){
							$name2=($row[$name]);
							echo''.imagen($label,$name,$columnas,$parametros,$name2,$urlbase).'';
						}
							elseif($tipo=="salto_linea"){
							echo''.salto_linea($columnas,$label).'';
						}
					}
								if($url != 'oa_organismos.php') 
								{
									echo' 
									<div class="col-md-10">
										<div class="form-actions">
										<br />
										<button type="submit" class="btn btn-primary" alt="Registro Modificado con &eacute;xito">Guardar</button>&nbsp;&nbsp;
										<a href="'.$url.'?accion=menu&id='.$id.'" class="btn btn-default" style="color:#000;">Cancelar</a>
									';
								}
								elseif($url == 'oa_organismos.php') {
									echo' 
									<div class="col-md-10">
										<div class="form-actions">
										<br />
										<button type="submit" class="btn btn-primary" alt="Registro Modificado con &eacute;xito">Guardar</button>&nbsp;&nbsp;
										<a href="'.$url.'" class="btn btn-default" style="color:#000;">Cancelar</a>
									';
								}
									echo'
									<br /> <br />
									</div>
								</div>
								</fieldset>
								</form>
						</div> <!-- /widget-content -->
					</div> <!-- /widget -->					
				</div> <!-- /span12 -->     	
			</div> <!-- /row -->
			</div> <!-- /container -->
		</div> <!-- /main -->
		';
			}

		function captura_edo_bd ($url,$id,$nomb_tabla)
		{
			ini_set('display_errors', 'On');
			$con=conectar();
			include "simple_html_dom.php";
			$sql="SELECT * FROM $nomb_tabla where id = '$id' ";
			$result = mysql_query($sql,$con) or die (mysql_error());
			if ($row = mysql_fetch_array($result)) 
			{
				echo($row["captura"]);
				############## CAPTURA PARA BANORTE ##############
				if($row["nombre_corto"]=='1')
				{
					$table = str_get_html($row["captura"]);

					############## RECORRIDO DE LA TABLA ##############
					foreach($table->find('tr') as $tr) 
					{
						if($tr->children('0')->plaintext != 'Fecha de Operación')
						{
							$fecha_temp      = explode('/',$tr->children('0')->plaintext);
							$fecha_operacion = $fecha_temp[2].'-'.$fecha_temp[1].'-'.$fecha_temp[0];
						}

						if($tr->children('1')->plaintext != 'Fecha')
						{
							$fecha_temp = explode('/',$tr->children('1')->plaintext);
							$fecha      = $fecha_temp[2].'-'.$fecha_temp[1].'-'.$fecha_temp[0];
						}

						if($tr->children('2')->plaintext != 'Referencia')
						{
							$referencia = trim($tr->children('2')->plaintext);
						}

						if($tr->children('3')->plaintext != 'Descripción')
						{
							$descripcion = trim($tr->children('3')->plaintext);
						}

						if($tr->children('4')->plaintext != 'Cod. Transac')
						{
							$cod_transac = trim($tr->children('4')->plaintext);
						}

						if($tr->children('5')->plaintext != 'Sucursal')
						{
							$sucursal = trim($tr->children('5')->plaintext);
						}

						if($tr->children('6')->plaintext != 'Depósitos')
						{
							$cantidad_sin_dolar_dep = str_replace('$', '', $tr->children('6')->plaintext);
							$cantidad_sin_coma_dep  = str_replace(',', '', $cantidad_sin_dolar_dep);
							// $cantidad_limpia_dep = floatval($cantidad_sin_coma_dep);
							$deposito               = (trim($cantidad_sin_coma_dep) && trim($cantidad_sin_coma_dep) != '&nbsp;') ? trim($cantidad_sin_coma_dep) : '0.00';
						}

						if($tr->children('7')->plaintext != 'Retiros')
						{
							$cantidad_sin_dolar_ret = str_replace('$', '', $tr->children('7')->plaintext);
							$cantidad_sin_coma_ret  = str_replace(',', '', $cantidad_sin_dolar_ret);
							// $cantidad_limpia_ret = floatval($cantidad_sin_coma_ret);
							$retiro                 = (trim($cantidad_sin_coma_ret) && trim($cantidad_sin_coma_ret) != '&nbsp;') ? trim($cantidad_sin_coma_ret) : '0.00';
						}

						if($tr->children('8')->plaintext != 'Saldo')
						{
							$cantidad_sin_dolar_saldo = str_replace('$', '', $tr->children('8')->plaintext);
							$cantidad_sin_coma_saldo  = str_replace(',', '', $cantidad_sin_dolar_saldo);
							// $cantidad_limpia_saldo = floatval($cantidad_sin_coma_saldo);
							$saldo                   = (trim($cantidad_sin_coma_saldo) && trim($cantidad_sin_coma_saldo) != '&nbsp;') ? trim($cantidad_sin_coma_saldo) : '0.00';
						}

						if($tr->children('9')->plaintext != 'Movimiento')
						{
							$movimiento = trim($tr->children('9')->plaintext);
						}

						if($tr->children('10')->plaintext != 'Descripción Detallada')
						{
							$descrip_det = trim($tr->children('10')->plaintext);
						}

						if($tr->children('11')->plaintext != 'Cheque')
						{
							$cheque = trim($tr->children('11')->plaintext);
						}

						if($fecha_operacion)
						{
							$sql_insert_edo_cta = 'INSERT INTO captura_edo_cta '.
											'(id_captura,fecha_operacion,fecha,referencia,descripcion,cod_transac,sucursal,deposito,retiro,saldo,movimiento,descrip_det,cheque) VALUES '.
											'("'.$id.'","'.$fecha_operacion.'","'.$fecha.'","'.$referencia.'","'.$descripcion.'","'.$cod_transac.'","'.$sucursal.'","'.$deposito.'","'.$retiro.'","'.$saldo.'","'.$movimiento.'","'.$descrip_det.'","'.$cheque.'")';
							// echo $sql_insert_edo_cta.'<br>';
							mysql_query($sql_insert_edo_cta,$con);
						}
					}
					############## RECORRIDO DE LA TABLA ##############
				}
				############## CAPTURA PARA BANORTE ##############

				############## CAPTURA PARA SANTANDER ##############
				if($row["nombre_corto"]=='3')
				{
					$html = str_get_html($row["captura"]);

					############## RECORRIDO DE LA TABLA ##############
					$table = $html->find('table',1);


					foreach($table->find('tr') as $tr) 
					{
						if($tr->children('0')->plaintext != 'Fecha')
						{
							$fecha_temp = explode('/',$tr->children('0')->plaintext);
							$fecha      = $fecha_temp[2].'-'.$fecha_temp[1].'-'.$fecha_temp[0];
						}

						if($tr->children('2')->plaintext != 'Sucursal')
						{
							$sucursal = trim($tr->children('2')->plaintext);
						}
					
						if($tr->children('3')->plaintext != 'Descripción')
						{
							$descripcion = trim($tr->children('3')->plaintext);
						}
						
						if($tr->children('4')->plaintext != 'Cargo')
						{

							$cantidad_sin_dolar_ret = str_replace('$', '', $tr->children('4')->plaintext);
							$cantidad_sin_dolar_ret = str_replace('&nbsp;', '', $cantidad_sin_dolar_ret);
							$cantidad_sin_coma_ret  = str_replace(',', '', $cantidad_sin_dolar_ret);
							// $cantidad_limpia_ret = floatval($cantidad_sin_coma_ret);
							$retiro                 = (trim($cantidad_sin_coma_ret) && trim($cantidad_sin_coma_ret) != '&nbsp;') ? trim($cantidad_sin_coma_ret) : '0.00';
						}

						if($tr->children('5')->plaintext != 'Abono')
						{
							$cantidad_sin_dolar_dep = str_replace('$', '', $tr->children('5')->plaintext);
							$cantidad_sin_dolar_dep = str_replace('&nbsp;', '', $cantidad_sin_dolar_dep);
							$cantidad_sin_coma_dep  = str_replace(',', '', $cantidad_sin_dolar_dep);
							// $cantidad_limpia_dep = floatval($cantidad_sin_coma_dep);
							$deposito               = (trim($cantidad_sin_coma_dep) && trim($cantidad_sin_coma_dep) != '&nbsp;') ? trim($cantidad_sin_coma_dep) : '0.00';
						}

						if($tr->children('6')->plaintext != 'Saldo')
						{
							$cantidad_sin_dolar_saldo = str_replace('$', '', $tr->children('6')->plaintext);
							$cantidad_sin_dolar_saldo = str_replace('&nbsp;', '', $cantidad_sin_dolar_saldo);
							$cantidad_sin_coma_saldo  = str_replace(',', '', $cantidad_sin_dolar_saldo);
							// $cantidad_limpia_saldo = floatval($cantidad_sin_coma_saldo);
							$saldo                   = (trim($cantidad_sin_coma_saldo) && trim($cantidad_sin_coma_saldo) != '&nbsp;') ? trim($cantidad_sin_coma_saldo) : '0.00';
						}

						if($tr->children('7')->plaintext != 'Referencia')
						{
							$referencia = trim($tr->children('7')->plaintext);
						}

						if($tr->children('8')->plaintext != 'Concepto')
						{
							$descrip_det = trim($tr->children('8')->plaintext);
							$descrip_det = str_replace('&nbsp;', '', $descrip_det);
						}

						if($tr->children('9')->plaintext != 'Referencia Interbancaria')
						{
							$referencia_interb = trim(str_replace('&nbsp;', '', $tr->children('9')->plaintext));
						}

						if($fecha)
						{
							$sql_insert_edo_cta = 'INSERT INTO captura_edo_cta '.
											'(id_captura,fecha,sucursal,descripcion,retiro,deposito,saldo,referencia,descrip_det,referencia_interb) VALUES '.
											'("'.$id.'","'.$fecha.'","'.$sucursal.'","'.$descripcion.'","'.$retiro.'","'.$deposito.'","'.$saldo.'","'.$referencia.'","'.$descrip_det.'","'.$referencia_interb.'")';
							// echo $sql_insert_edo_cta.'<br>';
							mysql_query($sql_insert_edo_cta,$con);
						}
					}
					############## RECORRIDO DE LA TABLA ##############
				}
				############## CAPTURA PARA SANTANDER ##############
			}
		} 
		
	//funcion para borrar registro (se actualiza solo el estado a 2)
		function eliminar($con,$id,$nomb_tabla,$url,$id_registro){
			echo '<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>';
			$con=conectar();
			$fecha_reg=date("Y-m-d");  
			mysql_query("begin",$con);
			mysql_set_charset('utf8');
			if($url == "oa_organismos_detalles.php" )
			{
				$query="UPDATE $nomb_tabla SET $nomb_tabla.id_estado = 3, $nomb_tabla.fecha_baja= '$fecha_reg' where $nomb_tabla.id = '$id_registro';";
			}
			else
			{
				$query="delete from $nomb_tabla where $nomb_tabla.id = '$id_registro';";
			} 
			mysql_query($query,$con) or die (mysql_error());
			mysql_query("commit",$con);
			// echo alerta_bota('Registro eliminado con éxito','correcto',''.$url.'?accion=menu&id='.$id.''); 
			echo alerta_bota('Registro eliminado con éxito','correcto', $url == 'oa_organismos_detalles.php' ? 'oa_organismos.php' : $url.'?accion=menu&id='.$id.'');
			//echo $query;
		}//fin funcion eliminar ok

		?>
		<?php 
		function alerta($titulo,$mensaje,$tipo){
		if($tipo=="informacion"){$tipo="info";}elseif($tipo=="error"){$tipo="error";}elseif($tipo=="alerta"){$tipo="warning";}
		elseif($tipo=="correcto"){$tipo="success";}

		echo "
		<script>
		$( document ).ready(function() {
				$.msgGrowl ({
					type: '".$tipo."'
					, title: '".$titulo."'
					, text: '".$mensaje."'
				});
		});


		</script>


		";

	}

	function edit($con,$id,$url,$nombre_formulario,$nomb_tabla,$array_variables,$color_form,$color_botones,$urlbase,$id_vehiculo){

		$nameEmp=addslashes(obten("name"));
		$con=conectar();
		$sql="SELECT * FROM $nomb_tabla where id = '$id' ";
		$result = mysql_query($sql,$con) or die (mysql_error());
		if ($row = mysql_fetch_array($result)) {
		$accion="modificar";
		}else{
			$accion="insertar";
			}
		echo'
		<div class="panel panel-default">
			<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="widget stacked">
						<div class="widget-header">
							<i class="icon-check"></i>
							<h3>'.$nombre_formulario.'<br>Los campos marcados con asterisco (*) son obligatorios</h3>
						</div> <!-- /widget-header -->
						<div class="widget-content">
							<br />
							<form action="'.$url.'?id='.$id_vehiculo.'&accion='.$accion.'&id_registro='.$id.'" id="validation-form" class="form-horizontal" method="post" enctype="multipart/form-data" />
							<input type="hidden" name="accion2" id="accion2" value="'.$accion.'">
								<fieldset>';
					$contador=count($array_variables);
					for($i=0;$i<$contador;$i++){
					$arreglo=$array_variables[$i]; 
					$label=$arreglo[0];
					$name=$arreglo[1];
					$tipo=$arreglo[2];
					$tabla_cat=$arreglo[3];
					$campo_cat=$arreglo[4];
					$campos_x=$arreglo[5];
					$parametros=$arreglo[6];
					$columnas=$arreglo[7];
					$VerRepSql=$arreglo[13];
					
					$where_sql="";
					if($accion=="insertar")
					{
						$where_sql=$arreglo[14];
					}
					if($tipo=="text" or $tipo=="time" or $tipo=="password" or $tipo=="date" or $tipo=="number" or $tipo=="email"){
						$name2=(utf8_encode($row[$name])); 
						echo''.campo($label,$columnas,$tipo,$name,$name2,$parametros,"18","100").'';
					} 
						if($tipo=="checkbox"){
							$name2=(utf8_encode($row[$name])); 
							echo''.campo($label,$columnas,$tipo,$name,$tabla_cat,$parametros,"18","100").'';
						}
						if($tipo=="label"){
							$name2=(utf8_encode($row[$name])); 
							echo''.label($label,$columnas,"18","100").'';
						} 
						elseif($tipo=="hidden"){
							$name2=(($_SESSION[realchange_usuario]));
							echo''.campo('',$columnas,$tipo,$name,$name2,$parametros,"18","100").'';
						} 
						elseif($tipo=="hiddenInsert"){ 
							$name2 = $id;
							// $name = 'id_empleado';
							echo''.hiddenInsert('',$columnas,$tipo,$name,$name2,$parametros,"18","100").'';
						}//inserta id de usario a las llaves foraneas
						elseif($tipo=="textarea"){
							$name2=(($row[$name]));
							echo''.memo($label,$columnas,$name,$name2,$parametros,"5","5").'';
						}
						elseif($tipo=="wisi"){
							$name2=(utf8_encode($row[$name]));
							echo''.wisi($label,$columnas,$name,$name2,$parametros,"5","5").'';
						}
						elseif($tipo=="wisicolor"){
							$name2=(utf8_encode($row[$name]));
							echo''.wisicolor($label,$columnas,$name,$name2,$parametros,"5","5").'';
						}
						elseif($tipo=="select_sql"){
							if($VerRepSql){
									$name2=(utf8_encode($row[$name]));
									$sql='select id,'.$campo_cat.' from '.$tabla_cat.' where id not in (select id from '.$nomb_tabla.') '.$where_sql.' order by '.$campo_cat.'';
								echo''.select_sql($label,$columnas,$name,$name2,$parametros,$sql,$campo_cat,"id",$con).'';
								}else{
									$name2=(utf8_encode($row[$name]));
									$sql='select id,'.$campo_cat.' from '.$tabla_cat.' '.$where_sql.' order by '.$campo_cat.'';
									echo''.select_sql($label,$columnas,$name,$name2,$parametros,$sql,$campo_cat,"id",$con).'';
								}
						}
						elseif($tipo=="select_x"){
							$name2=(utf8_encode($row[$name]));
							$sql='select id,'.$campo_cat.' from '.$tabla_cat.' order by '.$campo_cat.'';
							echo''.select_x($label,$columnas,$name,$name2,$parametros,$campos_x).'';
						}
						elseif($tipo=="file"){
							$name2=($row[$name]);
							echo''.imagen($label,$name,$columnas,$parametros,$name2,$urlbase).'';
						}
							elseif($tipo=="salto_linea"){
							echo''.salto_linea($columnas,$label).'';
						}
					} 
									echo' 
									<div class="col-md-10">
										<div class="form-actions">
										<br />
										<button type="submit" class="btn btn-primary" alt="Registro Modificado con &eacute;xito">Guardar</button>&nbsp;&nbsp;
										<a href="'.$url.'?accion=menu&id='.$id_vehiculo.'" class="btn btn-default" style="color:#000;">Cancelar</a>
									'; 
									echo'
									<br /> <br />
									</div>
								</div>
								</fieldset>
								</form>
						</div> <!-- /widget-content -->
					</div> <!-- /widget -->					
				</div> <!-- /span12 -->     	
			</div> <!-- /row -->
			</div> <!-- /container -->
		</div> <!-- /main -->
		';
	} 

	function alerta_bota($mensaje,$tipo,$url){
		echo '

		
		';

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

?>

<script type="text/javascript">
	function valida_borrar_registro( id_registro, id) 
	{ 
		swal({
		  title: "¿Estas seguro de eliminar este registro",
		  text: "Si lo borras, jamas se recupera el registro",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonColor: "#ec4541",
		  confirmButtonText: "Si deseo borrar",
		  cancelButtonText: "No deseo borrar",
		  closeOnConfirm: false,
		  closeOnCancel: false
		},
		function(isConfirm){ 
		  if (isConfirm) {  
		      window.location.href = "<?php echo $url?>?accion=eliminar&id="+id+"&id_registro=" + id_registro; 
		    } else {

		      swal("Cancelado", "El registro no se elimino", "error");
		    }
		});
	}
</script>
