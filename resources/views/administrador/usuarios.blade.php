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
                    <a href="{{URL::to('administrador/cambiarusuario')}}"><i class="fa fa-exchange fa-fw"></i> Cambiar
                        usuario</a>
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
    <!-- Agregar usuarios -->
    <div class="panel panel-primary">
        <div class="panel-heading" style="cursor: pointer;">
            Agregar usuarios
        </div>
        <div class="panel-body" id="demo">
            <div class="table-responsive">
                <form role="form" method="post" id="add-user-form">
                    <div class="form-group">
                        <input type="number" name="nocontrol" placeholder="No. Control"
                               class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="usuario" placeholder="Nombre de usuario"
                               class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="pass" placeholder="Contraseña" class="form-control"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Tipo de usuario:</label>
                        <select name="tipo" class="form-control" required="">
                            <option value="5">Alumno</option>
                            <option value="4">Docente</option>
                            <option value="2">Jefe de Departamento</option>
                        </select>
                    </div>
                    {{ method_field('PUT') }}
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="button" class="btn btn-primary" onclick="addUser()" id="btnShowUsers" value="Agregar">
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

                    <tr>
                        <td>#</td>
                        <td>Morse</td>
                        <td>RUdo</td>
                        <td>Carmen Elizabeth Juanita De Costa Brava Cortez</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        $(function () {
            showUsers();

        });

        function showUsers() {
            $.get("{{URL::action('AdminController@showUsers')}}", function (d, s) {
                var userData = "";

                for (var i=0;i<d.length;i++) {
                    userData += "<tr><td>#</td>";
                    userData += "<td>"+d[i].idUsu +"</td>";
                    userData += "<td>"+d[i].UsuTipo +"</td>";
                    userData += "<td>"+d[i].UsuUsuario +"</td></tr>";
                }
                $('#lista-usuarios').html(userData);
            });
        }

        function addUser() {
            if ($('#add-user-form')[0].checkValidity()) {
                $.ajax({
                    type: 'POST',
                    url: '{{URL::action('AdminController@addUser')}}',
                    data: $('#add-user-form').serialize(),
                    success: function (response) {
                        alert(response);
                        showUsers();
                    },
                    error: function (xhr, b, c) {
                        console.log("xhr=" + xhr + " b=" + b + " c=" + c);
                    }
                });
            } else {
                alert("Por favor rellena todos los campos.");
            }
        }

        /*function deleteUser(elidisillo) {
            var noc = elidisillo;
            var calf = confirm("En realidad quiere eliminar al usuario " + noc + "?", "-1");
            if (calf) {
                $.post("actions/eliminar-usuario.php", {
                    idUsu: noc,
                }, function (d, s) {
                    alert("Usuario eliminado correctamente");
                    showUsers();
                });
            }
        }

        function putIdInModal(elidisillo) {
            var nocontrol = elidisillo;
            $("#mod_nocontrol").val(nocontrol);
            $("#h_mod_nocontrol").val(nocontrol);
        }

        function modifyUser() {
            if ($('#mod-user-form')[0].checkValidity()) {
                $.ajax({
                    type: 'POST',
                    url: 'actions/modificar-usuario.php',
                    data: $('#mod-user-form').serialize(),
                    success: function (response) {
                        if (response == "1") {
                            alert("Usuario modificado correctamente.");
                            showUsers();
                        } else {
                            alert("No se pudo modificar el usuario.");
                        }
                        showUsers();
                    }
                });
            } else {
                alert("Por favor rellena todos los campos.");
            }
        }*/

    </script>
@stop
