<link rel="stylesheet" href="styles/dashboard-style.css">
<nav class="navbar navbar-inverse navbar-fixed-top">
	<a id="toggle_nav_btn" class="toggle-left-nav-btn inline-block mr-20 pull-left" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
	<?php 
	$modo=$_POST["modo"];
	if(!$modo){
		$modo=$_GET["modo"];
	}
	$accion=$_GET["accion"];
	if($modo=="Captura" or $accion="captura"){
		$url_boton="index.php?modo=Captura";
	}else{
		$url_boton="index.php";
	}
	?>
		<a class="navbar-brand" href="<?php echo $url_boton; ?>">
			<img class="logo" src="img/logos.png" width="180" height="42"/>
			</a>
		<ul class="nav navbar-right top-nav pull-right">

			<!-- <li>
				<a href="javascript:void(0);" data-toggle="collapse" data-target="#site_navbar_search">
					<i class="fa fa-search top-nav-icon"></i>
				</a>
			</li> -->
			
			
			<!-- <li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell top-nav-icon"></i><span class="top-nav-icon-badge">0</span></a>
				<ul  class="dropdown-menu alert-dropdown" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
					<li>
						<div class="streamline message-box message-nicescroll-bar">
							<div class="sl-item">
								<div class="icon">
									<i class="fa fa-envelope"></i>
								</div>
								<div class="sl-content">
									<a href="javascript:void(0)" class="inline-block capitalize-font  pull-left">Mensaje nuevo</a>
									<span class="inline-block font-12  pull-right">1pm</span>
									<div class="clearfix"></div>
										<p>celia@brandid.mx</p>
									</div>
								</div>
								<hr/>		
							</div>
						</li>
					</ul>
			</li> -->

			<li class="dropdown">
				<a href="#" class="dropdown-toggle pr-0" data-toggle="dropdown">
					<img src="dist/img/user1.png" alt="user_auth" class="user-auth-img img-circle"/>
					<!-- <span class="user-online-status"></span> -->
				</a>

				<ul class="dropdown-menu user-auth-dropdown" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
					<li>
						<a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Salir</a>
					</li>
				</ul>
				
			</li>
		</ul>



		<!-- <div class="collapse navbar-search-overlap" id="site_navbar_search">
			<form role="search">
						<div class="form-group mb-0">
							<div class="input-search">
								<div class="input-group">	
									<input type="text" id="overlay_search" name="overlay-search" class="form-control pl-30" placeholder="Search">
									<span class="input-group-addon pr-30">
									<a  href="javascript:void(0)" class="close-input-overlay" data-target="#site_navbar_search" data-toggle="collapse" aria-label="Close" aria-expanded="true"><i class="fa fa-times"></i></a>
									</span> 
								</div>
							</div>
						</div>
					</form>
				</div> -->
</nav>