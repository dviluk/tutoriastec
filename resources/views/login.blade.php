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
	<!--<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/font-awesome.min.css') }}">-->

	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open Sans">
	<style type="text/css">
		body {
			font-family: 'Open Sans', serif;
		}
	</style>
</head>
<body style="background-image: url({{URL::asset('img/banner.jpg')}})">
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="login-panel panel panel-default" style="background-color: rgba(255, 255, 255, 0.85666)">
					<div class="panel-heading">
						<h2 class="panel-title  text-center">Inicie sesión</h2>
					</div>
					<div class="panel-body">
						@if(count($errors))
						<div class="alert alert-danger">
							<ul>
								@foreach($errors->all() as $error)
								<li>{{$error}}</li>
								@endforeach
							</ul>
						</div>
						@endif
						<hr>
						<hr>
						<form role="form" action="{{URL::action('UserController@login')}}" method="post">
							<div class="form-group">
								<img src="{{URL::asset('img/logo.png')}}" style="width: 100%">
							</div>
							<fieldset>
								<div class="form-group">
									<input type="text" class="form-control" placeholder="Clave, NoControl" name="idUsu"  autofocus required>
								</div>
								<div class="form-group">
									<input type="password" class="form-control" placeholder="Password" name="UsuCon" value="" required>
								</div>

								<input type="hidden" name="_token" value="{{csrf_token()}}">
								<input type="submit" class="btn btn-lg btn-danger btn-block" value="Login">
							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="{{ URL::asset('js/jquery.min.js') }}"></script>
	<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
	<script src="{{ URL::asset('js/metisMenu.min.js') }}"></script>
	<script src="{{ URL::asset('js/startmin.js') }}"></script>

</body>
</html>