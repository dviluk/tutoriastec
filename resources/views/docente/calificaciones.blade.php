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
				<a href="index.php"><i class="fa fa-buysellads fa-fw"></i> Calificaciones</a>
			</li>
			<li>
				<a href="solicitudes.php"><i class="fa fa-clone fa-fw"></i> Solicitudes</a>
			</li>
		</ul>
	</div>
</div>
@stop

@section('headersection')
CALIFICACIONES
@stop

@section('content')

<div class="panel panel-primary">
	<div class="panel-heading">
		Tutorias asignadas:
	</div>
	<div class="panel-body">
		<div class="table-responsive">
			<form role="form">
				Agregar tutorias asignadas
			</form>
		</div>
	</div>
</div>

<div class="panel panel-default" id="panelpos">
	<div class="panel-heading">
		Alumnos asignados:
	</div>
	<div class="panel-body">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>NoControl</th>
					<th>Nombre</th>
					<th>Calificación</th>
					<th>Acción</th>
				</tr>

			</thead>

			<tbody id="tbl-alum-asig"></tbody>
		</table>
		<input id="docente_curso" type="hidden" value="">
	</div>
</div>

<div class="panel panel-warning" id="panelneg">
	<div class="panel-heading">Usted no tiene alumnos asignados en esta materia</div>
	<div class="panel-body">...</div>
</div>

@stop

@section('scripts')
@stop