<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title></title>
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/metisMenu.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/startmin.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/font-awesome.min.css') }}">

	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open Sans">
	<style type="text/css">
		body {
			font-family: 'Open Sans', serif;
		}
	</style>
</head>
<body>

	<div id="wrapper">

		<!-- Navigation -->
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			
			<div class="navbar-header">
				<a class="navbar-brand" href="../">Tec Vallarta</a>
			</div>

			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>

			<!-- Left Menu -->
			<ul class="nav navbar-nav navbar-left navbar-top-links visible-md-block visible-lg-block" style="display:hidden">
				<li><a href="../"><i class="fa fa-home fa-fw"></i> {{ session('user')->UsuTipo}} </a></li>
			</ul>

			<!-- Right Menu -->
			<ul class="nav navbar-right navbar-top-links">
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="fa fa-user fa-fw"></i> {{ session('user')->UsuUsuario}} <b class="caret"></b>
					</a>
					<ul class="dropdown-menu dropdown-user">
						<li>
							<a href="../public/cambiar-contra.php"><i class="fa fa-gear fa-fw"></i> Cambiar contraseña</a>
						</li>
						<li class="divider"></li>
						<li>
							<a href="{{URL::action('UserController@logout')}}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
						</li>
					</ul>
				</li>
			</ul>

			<!-- Sidebar depends on user's type -->
			@yield('sidebar')
		</nav>

		<!-- Page Content -->
		<div id="page-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-lg-10 col-lg-offset-1">
						<h1 class="page-header"> @yield('headersection')</h1>
					</div>
				</div>

				<!-- Content depends on user's types -->
				@yield('content')

			</div> <!-- container-fluid -->
		</div> <!-- page-wrapper -->
	</div> <!-- wrapper -->
	
	<script src="{{ URL::asset('js/jquery.min.js') }}"></script>
	<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
	<script src="{{ URL::asset('js/metisMenu.min.js') }}"></script>
	<script src="{{ URL::asset('js/startmin.js') }}"></script>
</body>
</html>
