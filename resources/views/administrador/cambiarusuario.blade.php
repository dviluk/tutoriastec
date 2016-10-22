@extends('master')

@section('sidebar')
<div class="navbar-default sidebar" role="navigation">
	<div class="sidebar-nav navbar-collapse">

		<ul class="nav" id="side-menu">
			<li class="sidebar-search">
				<div class="input-group custom-search-form">
					<input type="text" class="form-control" placeholder="Search...">
					<span class="input-group-btn">
						<button class="btn btn-primary" type="button">
							<i class="fa fa-search"></i>
						</button>
					</span>
				</div>
			</li>
			<li>
				<a href="{{URL::to('administrador/cambiarusuario')}}"><i class="fa fa-exchange fa-fw"></i> Cambiar sesión</a>
			</li>
			<li>
				<a href="{{URL::to('administrador/usuarios')}}"><i class="fa fa-users fa-fw"></i> Usuarios</a>
			</li>
			<li>
				<a href="{{URL::to('administrador/bitacora')}}"><i class="fa fa-wpforms fa-fw"></i> Bitácora</a>
			</li>
		</ul>
	</div>
</div>
@stop

@section('headersection')
INGRESE COMO ALGUN USUARIO
@stop

@section('content')
<div class="row">
	<div class="col-lg-10 col-lg-offset-1">
		<div class="panel panel-primary">
			<div class="panel-heading">
				Ingresar como:
			</div>
			<div class="panel-body">
				<form role="form" action="actions/cambiar-usuario.php" method="post"> <div class="form-group">
					<select class="form-control" name="type">
						<option value="5">Alumno</option>
						<option value="4">Docente</option>
						<option value="2">Jefe de departemento</option>
					</select>
				</div>
				<div class="form-group">
					<label>Introduzca clave</label>
					<input type="text" name="clave" placeholder="Clave" class="form-control">
				</div>
				<button type="submit" class="btn btn-primary">Enviar</button>
			</form>
		</div>
	</div>
</div>
</div>
@stop

