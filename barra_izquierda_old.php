<div class="fixed-sidebar-left">
	<ul class="nav navbar-nav side-nav nicescroll-bar">
	

<?php 
/*
1: Modo Dios
2: 
3: Encargados de comedor (Comedores Comunitarios)
4: Nutriologos (Comedores Comunitarios)
5: Encargados de banco de alimentos 
6: Operador de Becas Indigenas (Becas Indigenas)
7: 	Operador de programas despacho del gobernador
8: 	IGUALDAD SUSTANTIVA
9:
10: Jalisco te reconoce (Captura)
11: Jalisco te reconoce
12: Validacion de archivos

19: Transporte a estudiantes.

20: ?
21: Operadores de entregas Jalisco te reconoce.

30: ?
31: ?
33: Operador de talleres de comedores Comunitarios.
34: Usuarios externos de comedores comunitarios (Solo consultas).
*/
$nivel_acceso=$_SESSION["tipo_usuario"];
	if($nivel_acceso<>10 and $nivel_acceso<>12 and  $nivel_acceso<>34){
		if($nivel_acceso==1){
			echo'
					<li>
						<a  class="active" href="javascript:void(0);" data-toggle="collapse" data-target="#dashboard_inv_cc"><i class="icon-folder mr-10"></i>Administracion<span class="pull-right"><i class="fa fa-fw fa-angle-down"></i></span></a>
						<ul id="dashboard_inv_cc" class="collapse collapse-level-1">
							
							<li>
								<a class="active" href="sincronizaciones.php">Estatus de Sincronizaciones</a>
							</li>
							<li>
								<a class="active" href="https://ssas.mx/pub2019/checador_geo.php">Ubicacion</a>
							</li>
							
							

						</ul>
					</li>

			';
		}
		?>
					
		<?php

		if($nivel_acceso==66 ||$nivel_acceso==1){
			echo'
					<li>
						<a  class="active" href="javascript:void(0);" data-toggle="collapse" data-target="#dashboard_mujeres"><i class="icon-folder mr-10"></i>Mujeres Lideres del Hogar<span class="pull-right"><i class="fa fa-fw fa-angle-down"></i></span></a>
						<ul id="dashboard_mujeres" class="collapse collapse-level-1">
							
							
							<li>
								<a class="active" href="valida_mujeres.php">Validacion Expedientes</a>
							</li>
							
							
							
							
							

						</ul>
					</li>

			';

		}

		//$nivel_acceso=$_SESSION["tipo_usuario"];
		if($nivel_acceso==6 or $nivel_acceso==1){
			echo'
					<li>
						<a  class="active" href="javascript:void(0);" data-toggle="collapse" data-target="#dashboard_am"><i class="icon-folder mr-10"></i>Adultos Mayores<span class="pull-right"><i class="fa fa-fw fa-angle-down"></i></span></a>
						<ul id="dashboard_am" class="collapse collapse-level-1">
							
							<li>
								<a class="active" href="captura_pub_inicial.php">Captura Inicial</a>
							</li>

							<li>
								<a class="active" href="captura_inicial_visor.php">Captura Inicial Visor</a>
							</li>

							<li>
								<a class="active" href="prograas_servicios_am.php">Programas / Servicios</a>
							</li>

							<li>
								<a class="active" href="prograas_servicios_am_visor.php">Programas / Servicios Visor</a>
							</li>


							
							<li>
								<a class="active" href="call_center_am.php">Call Center AM</a>
							</li>

							<li>
								<a class="active" href="carta_residencia.docx">Descargar carta de residencia</a>
							</li>

						</ul>
					</li>

					<li>
						<a  class="active" href="javascript:void(0);" data-toggle="collapse" data-target="#dashboard_becas"><i class="icon-folder mr-10"></i>Becas Indigenas<span class="pull-right"><i class="fa fa-fw fa-angle-down"></i></span></a>
						<ul id="dashboard_becas" class="collapse collapse-level-1">
							
							
							<li>
								<a class="active" href="valida_becas.php">Revalidacion de Becas</a>
							</li>
							<li>
								<a class="active" href="observador_becas.php">Revisar Validaciones realizadas</a>
							</li>
							
							
							
							

						</ul>
					</li>

			';
		}


		if($nivel_acceso==20){
			echo'
				    <li>
								<a class="active" href="reportes_jalisco.php">Reportes</a>
					</li>					
			';
		}


		?>



					<li>
						<a  class="active" href="javascript:void(0);" data-toggle="collapse" data-target="#dashboard_inv_c"><i class="icon-folder mr-10"></i>Registro Inicial / FPU<span class="pull-right"><i class="fa fa-fw fa-angle-down"></i></span></a>
						<ul id="dashboard_inv_c" class="collapse collapse-level-1">
							
							<li>
								<a class="active" href="captura_pub_inicial.php">Captura</a>
							</li>
							<li>
								<?php 
								$token=sha1(date("Y-m-d")).sha1(date("Y-m"));
		$sesion_c=$_SESSION["id_comedor"];
								?>
								<a class="active" href="genera_reporte_c.php<?php echo '?token='.$token.'&c='.$sesion_c.''; ?>">Descarga de Padron</a>
							</li>
							<li>
								<a class="active" href="captura.php">Consulta</a>
							</li>
							<li>
								<a class="active" href="actualiza_captura.php">Completar Captura</a>
							</li>
							

						</ul>
					</li>
		<?php 
		$sesion_id=$_SESSION["id_comedor"];
		if($nivel_acceso<>6){


		echo'
					<li>
						<a  class="active" href="javascript:void(0);" data-toggle="collapse" data-target="#dashboard"><i class="icon-folder mr-10"></i>Programa Comedores Comunitarios<span class="pull-right"><i class="fa fa-fw fa-angle-down"></i></span></a>
						<ul id="dashboard" class="collapse collapse-level-1">

							

							
							<li>
								<a class="active" href="comedores.php">Registro de Beneficiarios</a>
							</li>
							
							<li>
								<a class="active" href="medidas.php">Registro de Mediciones</a>
							</li>
							
							<li>
								<a class="active" href="visor_mediciones.php">Visor de Mediciones</a>
							</li>
							
							<li>
								<a class="active" href="reporte_asistencias_por_dia.php?comedor='.$sesion_id.'">Reporte de Asistencias</a>
							</li>
							';
							if($nivel_acceso==1){
								echo'

							<li>
								<a class="active" href="reportes_comedores.php">Reporte de Asistencias entre Fechas</a>
							</li>

								';
							}

							echo'
							<li>
								<a class="active" href="https://ssas.mx/pub2019/check_geo.php">Asistencias en Domicilio</a>
							</li>
							<li>
								<a class="active" href="https://ssas.mx/pub2019/talleres_actividades.php">Actividades de Talleres</a>
							</li>
							

							
							

						</ul>
					</li>


		';

		}



		?>
			<?php 		
		if($nivel_acceso==5 or $nivel_acceso==1){
			echo'
					<li>
						<a  class="active" href="javascript:void(0);" data-toggle="collapse" data-target="#dashboardfias"><i class="icon-folder mr-10"></i>FIAS<span class="pull-right"><i class="fa fa-fw fa-angle-down"></i></span></a>
						<ul id="dashboardfias" class="collapse collapse-level-1">

							

							
							<li>
								<a class="active" href="fias.php">Registro de Beneficiarios</a>
							</li>
							

							
							

						</ul>
					</li>
			';
			}
			
			
			
		if($nivel_acceso==19 or $nivel_acceso==1 or $nivel_acceso==80){
		    echo'
		    
					<li>
						<a  class="active" href="javascript:void(0);" data-toggle="collapse" data-target="#dashboardtra"><i class="icon-folder mr-10"></i>Programa Transporte<span class="pull-right"><i class="fa fa-fw fa-angle-down"></i></span></a>
						<ul id="dashboardtra" class="collapse collapse-level-1">
							<li>
								<a class="active" href="captura_pub_inicial.php">Captura</a>
							</li>
							<li>
								<a class="active" href="transporte.php">Terminar Registro Transporte</a>
							</li>		    
						</ul>
					</li>
		    ';
		}			

			
		if($nivel_acceso==33){
		    echo'
		    
					<li>
						<a  class="active" href="javascript:void(0);" data-toggle="collapse" data-target="#dashboardtras"><i class="icon-folder mr-10"></i>Administracion Talleres<span class="pull-right"><i class="fa fa-fw fa-angle-down"></i></span></a>
						<ul id="dashboardtras" class="collapse collapse-level-1">
							<li>
								<a class="active" href="talleres_captura.php">Talleres</a>
							</li>
								    
						</ul>
					</li>
		    ';
		}			


			
		if($nivel_acceso==80 or $nivel_acceso==1){
		    echo'
		    
					<li>
						<a  class="active" href="javascript:void(0);" data-toggle="collapse" data-target="#dashboardtras"><i class="icon-folder mr-10"></i>Validar Programa Transporte<span class="pull-right"><i class="fa fa-fw fa-angle-down"></i></span></a>
						<ul id="dashboardtras" class="collapse collapse-level-1">
							
							<li>
								<a class="active" href="valida_transporte.php">Validar Registro Transporte</a>
							</li>		    
						</ul>
					</li>
		    ';
		}			
			
			
			?>

					<li>
						<a  class="active" href="javascript:void(0);" data-toggle="collapse" data-target="#dashboarda"><i class="icon-folder mr-10"></i>Configuración<span class="pull-right"><i class="fa fa-fw fa-angle-down"></i></span></a>
						<ul id="dashboarda" class="collapse collapse-level-1">
							
							<li>
								<a class="active" href="cambio_password.php">Cambio de Password</a>
							</li>
							
									

						</ul>
					</li>

					<li>
						<a  class="active" href="descargas/Manual_uso.pdf">Manual de uso<span class="pull-right"><i class="fa fa-fw fa-file"></i></span></a>
						
					</li>

					<li>
						<a  class="active" href="descargas/sistema.exe">Descarga de Aplicaci&oacute;n<span class="pull-right"><i class="fa fa-fw fa-file"></i></span></a>
						
					</li>
	<?php 
	}else{
		if($nivel_acceso==11){
		echo '

					<li>
						<a  class="active" href="descargas/formulario_general.xlsx">Descarga de Formulario Excel<span class="pull-right"><i class="fa fa-fw fa-file"></i></span></a>
						
					</li>
					<li>
						<a  class="active" href="carga_masiva.php">Carga de Excel<span class="pull-right"><i class="fa fa-fw fa-file"></i></span></a>
						
					</li>
				    <li>
								<a class="active" href="actualiza_captura_jal.php">Completar Captura</a>
					</li>
				   				
				    <li>
								<a class="active" href="actualiza_captura_jal_calzado.php">Subir Medidas de Calzado</a>
					</li>
				   				
				    <li>
								<a class="active" href="actualiza_captura_jal_cons.php">Subir Constancia Medica (Beneficiarios p/ aparatos funcionales)</a>
					</li>
				   				


		';
		}
		if($nivel_acceso==12){
		    echo'
				    <li>
								<a class="active" href="valida_jal.php">Validar Expedientes</a>
					</li>					
		    
		    
		    ';
		    
		}
		if($nivel_acceso==34){
		    echo'		    
					<li>
						<a  class="active" href="javascript:void(0);" data-toggle="collapse" data-target="#dashboardtras"><i class="icon-folder mr-10"></i>Reportes Comedores Comunitarios<span class="pull-right"><i class="fa fa-fw fa-angle-down"></i></span></a>
						<ul id="dashboardtras" class="collapse collapse-level-1">
							<li>
								<a class="active" href="reporte_asistencias_por_dia.php">Reportes por día</a>
							</li>
								    
						</ul>
					</li>
		    ';
		}





	}

	?>

	</ul>
</div>