<?
session_start();
if($_SESSION["admin_id_pub"]){
	header("Location: index.php");
}else{
include "config.php";

?>
<!DOCTYPE html>
<html lang="en">
	<head>

		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
			<title><?php echo $title_sitio; ?></title>
		<meta name="description" content="Kenny is a Dashboard & Admin Site Responsive Template by hencework." />
		<meta name="keywords" content="admin, admin dashboard, admin template, cms, crm, Kenny Admin, kennyadmin, premium admin templates, responsive admin, sass, panel, software, ui, visualization, web app, application" />
		<meta name="author" content="hencework"/>
		
		<!-- Favicon -->
		<link rel="shortcut icon" href="assets/logo.ico">
    <!-- Sweet-Alert  -->
    <link href="vendors/bower_components/sweetalert/dist/sweetalert.css" rel="stylesheet" type="text/css">
    
    <!-- Custom CSS -->
    <link href="dist/css/style.css" rel="stylesheet" type="text/css">    
    <script src="vendors/bower_components/sweetalert/dist/sweetalert.min.js"></script>

    <script src="vendors/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="dist/js/sweetalert-data.js"></script> 	
		<!-- vector map CSS -->
		<link href="vendors/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>
		
		
		<!-- Custom CSS -->
		<link href="dist/css/style.css" rel="stylesheet" type="text/css">
			

	</head>
	<body background="fondo.png">
		<!--Preloader-->
		<div class="preloader-it">
			<div class="la-anim-1"></div>
		</div>
		<!--/Preloader-->
		
		<div class="wrapper pa-0">
		
			<!-- Main Content -->
			<div class="page-wrapper pa-0 ma-0">
				<div class="container-fluid">
					<!-- Row -->
					<div class="table-struct full-width full-height">
						<div class="table-cell vertical-align-middle">
							<div class="auth-form  ml-auto mr-auto no-float">
								<div class="panel panel-default card-view mb-0">
									<div class="panel-heading">
										<div class="pull-left">
											<h6 class="panel-title txt-dark">Ingresar </h6>
										</div>
										<div class="clearfix"></div>
									</div>
									<div class="panel-wrapper collapse in">
										<div class="panel-body">
											<div class="row">
												<div class="col-sm-12 col-xs-12">
													<div class="form-wrap">
														<form action="val_login.php" method="POST" enctype="multipart/form-data">
															<div class="form-group">
																<label class="control-label mb-10" for="exampleInputEmail_2">Correo</label>
																<div class="input-group">
																	<input type="text" class="form-control" required="" name="usuario" autofocus id="exampleInputEmail_2" placeholder="Ingrese su correo">
																	<div class="input-group-addon"><i class="icon-envelope-open"></i></div>
																</div>
															</div>
															<div class="form-group">
																<label class="control-label mb-10" for="exampleInputpwd_2">Contrase&ntilde;a</label>
																<div class="input-group">
																	<input type="password" class="form-control" name="password" required="" id="exampleInputpwd_2" placeholder="Ingresa tu clave">
																	<div class="input-group-addon"><i class="icon-lock"></i></div>
																</div>
															</div>
															
															<div class="form-group">
																
																<!--<a class="capitalize-font txt-alert block pt-5 pull-right" href="#">Olvide mi clave</a>-->
																<div class="clearfix"></div>
															</div>
															<div class="form-group">
																<button type="submit" class="btn bg-blue btn-block">Ingresar</button>
															</div>
															
														</form>
													</div>
												</div>	
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- /Row -->	
				</div>
				
			</div>
			<!-- /Main Content -->
		
		</div>
		<!-- /#wrapper -->
		
		<!-- JavaScript -->

<?include "java.php";

}
?>		
		<!-- jQuery -->
	</body>
</html>
