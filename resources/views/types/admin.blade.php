@extends('master')

@section('UsuTipo')
{{$user->UsuTipo}}	
@stop

@section('UsuUsuario')
{{$user->UsuUsuario}}	
@stop

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
				<a href="index.php"><i class="fa fa-exchange fa-fw"></i> Cambiar sesión</a>
			</li>
			<li>
				<a href="usuarios.php"><i class="fa fa-users fa-fw"></i> Usuarios</a>
			</li>
			<li>
				<a href="bitacora.php"><i class="fa fa-wpforms fa-fw"></i> Bitácora</a>
			</li>
		</ul>
	</div>
</div>
@stop

@section('content')

<div class="row">
	<div class="col-lg-10 col-lg-offset-1">


		<div class="panel panel-primary">
			<div class="panel-heading">

			</div>


			<!-- /.panel-heading -->
			<div class="panel-body">
				<div class="dataTable_wrapper">

					<table class="table table-striped  table-hover" id="dataTables-bitacora">
						<thead>
							<tr>
								<th>ID </th>
								<th>Nombre de usuario</th>
								<th>Accion</th>
								<th>Fecha</th>
								<th>Hora</th>
							</tr>
						</thead>
						<tbody class="odd gradeX">
							<?php
							/*foreach ($bitacora as $key => $v) {
								echo "<tr>
								<td>{$v['id']}</td>
								<td>{$v['usuario']}</td>
								<td>{$v['accion']}</td>
								<td>{$v['fecha']} </td>
								<td>{$v['hora']}</td></tr>";
							}*/
							?>

						</tbody>
					</table>
				</div>

			</div>

		</div>
	</div>
</div>
@stop

