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
				<a href="{{URL::to('administrador/cambiarusuario')}}"><i class="fa fa-exchange fa-fw"></i> Cambiar usuario</a>
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
USUARIOS
@stop

@section('content')
<!-- Mostrar mensajes de error -->
<div id="alerts" style="display:none">
</div>

<!-- Agregar usuarios -->
<div class="panel panel-primary">
	<div class="panel-heading">
		Agregar usuarios
	</div>
	<div class="panel-body" id="demo">
		<div class="table-responsive">

			<form role="form" id="add-user-form">

				<div class="form-group">
					<input type="number" name="idUsu" placeholder="No. Control"
					class="form-control" required>
				</div>
				<div class="form-group">
					<input type="text" name="UsuUsuario" placeholder="Nombre de usuario" class="form-control" required>
				</div>
				<div class="form-group">
					<input type="text" name="UsuCon" placeholder="Contraseña" class="form-control" required>
				</div>
				<div class="form-group">
					<label>Tipo de usuario:</label>
					<select name="UsuTipo" class="form-control" required>
						<option value="5">Alumno</option>
						<option value="4">Docente</option>
						<option value="2">Jefe de Departamento</option>
					</select>
				</div>

				<input type="hidden" name="_token" value="{{csrf_token()}}">
				<input type="button" class="btn btn-primary" value="Agregar" onclick="addUser()">
			</form>
		</div>
	</div>
</div>

<!-- Ver usuarios -->
<div class="panel panel-default">
	<div class="panel-heading">
		Todos los usuarios
	</div>
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>Clave</th>
						<th>Tipo</th>
						<th>Nombre de usuario</th>
					</tr>
				</thead>
				<tbody id="lista-usuarios">
					<?php $userTypes=array('', 'Administrador', 'Jefe de departamento', 'Coordinador', 'Docente', 'Alumno'); ?>
					@foreach ($users as $u)
					<tr>
						<td>#</td>
						<td>{{$u->idUsu}}</td>
						<td>{{$userTypes[$u->UsuTipo]}}</td>
						<td>{{$u->UsuUsuario}}</td>
						<td><a href="" data-toggle="modal" data-target="#myModal" onclick="putIdInModal({{$u->idUsu}})">Editar</a></td>
						<td><a href="javascript:;" onclick="deleteUser({{$u->idUsu}})">Eliminar</a></td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Modal modificar usuario -->
<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Modificar usuario <span id="nte"></span></h4>
			</div>
			<div class="modal-body">
				<form role="form" id="mod-user-form">
					<input type="hidden" name="idUsu" placeholder="No. Control" class="form-control">
					<div class="form-group">
						<input type="number" name="temp-idUsu" id="h_mod_idUsu" placeholder="No. Control" class="form-control" disabled>
					</div>
					<div class="form-group">
						<input type="text" name="UsuUsuario" placeholder="Nombre de usuario" class="form-control" required>
					</div>
					<div class="form-group">
						<input type="text" name="UsuCon" placeholder="Contraseña" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Tipo de usuario:</label>
						<select name="UsuTipo" class="form-control" required>
							<option value="5">Alumno</option>
							<option value="4">Docente</option>
							<option value="2">Jefe de Departamento</option>
						</select>
					</div>
					<input type="hidden" name="_token" value="{{csrf_token()}}">
				</form>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="button" class="btn btn-primary" data-dismiss="modal" onclick="modifyUser();">Modificar
				</button>
			</div>
		</div>
	</div>
</div>

@stop
@section('scripts')
<script>
	function showUsers() {
		var userTypes = ['', 'Administrador', 'Jefe de departamento', 'Coordinador', 'Docente', 'Alumno'];

		$.get("{{URL::action('AdminController@showUsers')}}", function (d, s) {
			var userData = "";
			for (var i=0;i<d.length;i++) {
				userData += "<tr><td>#</td>";
				userData += "<td>"+d[i].idUsu +"</td>";
				userData += "<td>"+userTypes[d[i].UsuTipo]+"</td>";
				userData += "<td>"+d[i].UsuUsuario +"</td>";
				userData += '<td><a href="" data-toggle="modal" data-target="#myModal" onclick="putIdInModal('+d[i].idUsu+');">Editar</a></td>'
				userData +=	'<td><a href="javascript:;" onclick="deleteUser('+d[i].idUsu+')">Eliminar</a></td></tr>';		
			}
			$('#lista-usuarios').html(userData);
		});
	}

	function addUser() {
		if ($('#add-user-form')[0].checkValidity()) {
			$.ajax({
				type: 'post',
				url: '{{URL::action('AdminController@addUser')}}',
				data: $('#add-user-form').serialize(),
				success: function (data) {
					$('#alerts').html('<div class="alert alert-'+data[0]+' fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+data[1]+'</div>');
					$('#alerts').show();
					showUsers();
				}
			});
		} else {
			alert("Por favor rellena todos los campos.");
		}
	}

	function deleteUser(id) {
		var del = confirm("¿En realidad quiere eliminar al usuario " + id + "?", "-1");
		if (del) {
			$.ajax({
				type: 'PUT',
				url: '{{URL::action('AdminController@delUser')}}',
				data: {
					idUsu: id,
					_token : '{{csrf_token()}}'
				},
				success: function (data) {
					$('#alerts').html('<div class="alert alert-'+data[0]+' fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+data[1]+'</div>');
					$('#alerts').show();
					
					showUsers();
				}
			});
		}
	}

	function putIdInModal(id, usu, con) {
		$('#mod-user-form')[0].reset();
		//$("#mod_idUsu").val(idUsu);
		//$("#h_mod_idUsu").val(idUsu);

		$("#mod-user-form :input[name='idUsu']").val(id);
		$("#mod-user-form :input[name='temp-idUsu']").val(id);
		$("#mod-user-form :input[name='UsuUsuario']").val(usu);
		$("#mod-user-form :input[name='UsuCon']").val(con);
	}

	function modifyUser() {
		if ($('#mod-user-form')[0].checkValidity()) {
			$.ajax({
				type: 'PUT',
				url: '{{URL::action('AdminController@editUser')}}',
				data: $('#mod-user-form').serialize(),
				success: function (data) {
					/*$('#alerts').html('<div class="alert alert-'+data[0]+' fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+data[1]+'</div>');
					$('#alerts').show();
					showUsers();*/
					console.log(data);
				}
			});
		} else {
			alert("Por favor rellena todos los campos.");
		}
	}
</script>
@stop


