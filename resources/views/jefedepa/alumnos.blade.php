	<!DOCTYPE html>
<html lang="en">
<?php require_once("../req/head.php") ?>
<body>

	<div id="wrapper">
		<!-- Navigation -->
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<?php require_once("../req/navigation.php"); ?>

			<!-- Sidebar -->
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
						<li>	<!-- class="active" -->
							<a href="alumnos.php" ><i class="fa fa-graduation-cap fa-fw"></i> Alumnos</a>
						</li>
						<li>
							<a href="docentes.php"><i class="fa fa-user fa-fw"></i> Docentes</a>
						</li>
						<li>
							<a href="horarios.php"><i class="fa fa-clock-o fa-fw"></i> Horarios</a>
						</li>
						<li>
							<a href="periodos.php"><i class="fa fa-calendar-o fa-fw"></i> Periodos</a>
						</li>
						<li>
							<a href="asesorias.php"><i class="fa fa-plus-circle fa-fw"></i> Asesorias</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>

		<!-- Page Content -->
		<div id="page-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-lg-10 col-lg-offset-1">
						<h1 class="page-header">Alumnos</h1>
					</div>
				</div>

				<!-- ... Your content goes here ... -->
				<div class="row">

					<!-- Agregar Alumnos-->
					<div class="col-lg-10 col-lg-offset-1">
						<div class="panel panel-default">
							<div class="panel-heading">
								Agregar Alumnos
							</div>
							<div class="panel-body">

									<form role= "form" action="actions/registrar_alumnos.php" method="post">
										<div class="form-group">
											<input type="text" name="Noco" placeholder="No Control" class="form-control"  required="">
										</div>
										<div class="form-group">
											<input class="form-control" placeholder="Nombre del Alumno" type="text" name="Nombre" required="">
										</div>
										<div class="form-group">
											<label for="Carrera">Carreras:</label>
											<select name="Carrera" id="Carrera" class="form-control">
												<option value="ISC">ISC</option>
												<option value="IGEM">IGEM</option>
												<option value="ITICS">ITICS</option>
												<option value="ELE">Electromecanica</option>
												<option value="TUR">Turismo</option>
												<option value="GAS">Gastronomia</option>
												<option value="ARQ">Arquitectura</option>
											</select>
										</div>
										<div class="form-group">
											<input placeholder="Grado" type="text" name="Grado" required class="form-control">
										</div>
										<div class="form-group">
											<label>Turnos:</label>
											<select name="Turno"  class="form-control">
												<option  value="M">M</option>
												<option  value="V">V</option>

											</select>
										</div>
										<div class="form-group">
											<input class="form-control" placeholder="Promedio" type="text" name="Promedio" required="">
										</div>
										<div class="form-group">
											<input type="submit"  class="btn btn-primary" value="Registrar"/>
										</div>
									</form>
								</div>

						</div>
					</div>

					<!-- Inscribir alumnos-->
					<div class="col-lg-10 col-lg-offset-1">
						<div class="panel panel-default">
							<div class="panel-heading">
								Inscribir alumnos
							</div>
							<div class="panel-body">
								<div class="table-responsive">
									<?php
									require_once("../php/Conn.php");
									?>
									<form role="form" action="actions/inscribir_alumnos.php" method="post">
										<div class="form-group">
											<label for="id_alumno">Seleccione un alumno:</label>
											<select name="id_alumno"  class="form-control">
												<?php
												try {	
													$conn = getConnection();
													$result = $conn->query("SELECT * from tbl_alumnos where status=1");
													$alumnos = $result->fetchAll();

												} catch (PDOException $e) {
													
													echo $e.getMessage();
												}
												?>
												<?php foreach ($alumnos as $u): ?> 
													<option value="<?=$u["idAlu"]?>"><?=$u["AluNombre"]?></option>
												<?php endforeach; ?>
											</select>
										</div>
										<div class="form-group">
											<label for="io_curso">Seleccione un curso:</label>
											<select name="id_curso"  class="form-control">
												<?php
												try {	
													$result = $conn->query("
														SELECT * FROM tbl_docentes_cursos where status!=0 and idCurso !=3");
													$cursos = $result->fetchAll();

												} catch (PDOException $e) {

													echo $e.getMessage();
												}
												?>
												<?php foreach ($cursos as $u): ?> 
													<option value="<?=$u["idDocente_Curso"]?>"><?=$u["CursoNombre"]?></option>
												<?php endforeach; ?>
											</select>
										</div>
										<div class="form-group">
											<input type="submit" class="btn btn-primary" value="Registrar"/>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>

					<div class="col-lg-10 col-lg-offset-1">
						<div class="panel panel-default">
							<div class="panel-heading">
								Ver todos los alumnos
							</div>
							<div class="panel-body">
								<div class="table-responsive">
									<form role="form">
									<?php
										$carreras = array("ISC", "IGEM", "ELEC", "TUR", "GAS", "ARQ", "ITICS");
									 ?>
									<label for="tabla_car">Buscar Alumnos por carrera:</label>
									<select id="tabla_car" name="tabla_uno" onchange="caBuscar()" class="form-control">
										<?php  
										foreach($carreras as $c){
											echo "<option value='$c'>$c</option>";
										}
										?>
									</select>
									</form>
									<table class="table table-hover" id="tabla_carrera">

									</table>
								</div>
							</div>
						</div>
					</div>

					<div class="col-lg-10 col-lg-offset-1">
						<div class="panel panel-default">
							<div class="panel-heading">
								Ver los alumnos de un curso
							</div>
							<div class="panel-body">
								<div class="table-responsive">
								<form role="form">
									<label for="tabla_cur">Seleccione un curso:</label>
									<select id="tabla_cur" name="tabla_dos" onchange="cuBuscar()" class="form-control">
									<?php 
										try {
											$cursos= $conn->query("SELECT * FROM tbl_docentes_cursos where status !=0");
											$result = $cursos->fetchAll();
											if($result){
												foreach($result as $r){
													?>
													<option value="<?=$r['idDocente_Curso']?>"><?=$r["CursoNombre"]?></option>
													<?php
												}
											}

										} catch (PDOException $e) {

											echo $e->getMessage();

										}
										$conn = null;
									 ?>
									</select>
									<table class="table table-hover" id="tabla_cursos">

									</table>
									</form>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div> <!-- container-fluid -->
		</div> <!-- page-wrapper --> 
	</div> <!-- wrapper -->
	<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal modify content -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modificar Alumno <span id="nte"></span></h4>
            </div>
            <div class="modal-body">
                <form role="form">
										<div class="form-group">
											<input class="form-control" placeholder="Nombre del Alumno" type="text" id="Nombre" required="">
										</div>
										<div class="form-group">
											<label for="Carrera">Carreras:</label>
											<select id="CarreraM" class="form-control">
												<option value="ISC">ISC</option>
												<option value="IGEM">IGEM</option>
												<option value="ITICS">ITICS</option>
												<option value="ELE">Electromecanica</option>
												<option value="TUR">Turismo</option>
												<option value="GAS">Gastronomia</option>
												<option value="ARQ">Arquitectura</option>
											</select>
										</div>
										<div class="form-group">
											<input placeholder="Grado" type="text" id="Grado" required class="form-control">
										</div>
										<div class="form-group">
											<label>Turnos:</label>
											<select id="Turno"  class="form-control">
												<option  value="M">M</option>
												<option  value="V">V</option>

											</select>
										</div>
										<div class="form-group">
											<input class="form-control" placeholder="Promedio" type="text" id="Promedio" required="">
										</div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="modifyAlumno();">
                    Modificar
                </button>
            </div>
        </div>
    </div>
</div>
	<!-- Todos los scripts necesarios. LAS RUTAS CAMBIAN-->
	<?php require_once("../req/scripts.php") ?> 
	<script>
	var tgr = 0;
    function selectAsTrg(t) {
        tgr = t;
        $("#nte").html(tgr);
    }
    function eliminarAlumno(idP) {
        var id = idP;
        var conf = confirm("En realidad quiere eliminar el alumno " + id + "?", "-1");
        if (conf) {
            $.post("actions/eliminar_alumnos.php", {
                idAlu: id,
            }, function (d, s) {
                window.location = "alumnos.php";
            });
        }
    }

    function modifyAlumno() {
        $.post("actions/modificar_alumnos.php", {
            Noco: tgr,
            Nombre: $("#Nombre").val(),
            Carrera: $("#CarreraM").val(),
            Grado: $("#Grado").val(),
            Turno: $("#Turno").val(),
            Promedio: $("#Promedio").val(),
        }, function (d, s) {
            window.location = "alumnos.php";
        });
    }
	window.onload = function(){

		$.post("actions/buscar_alumno.php?mode=carreras", {
			carrera_select: $("#tabla_car option:selected").val(),

		}, function(p, s) {
			$("#tabla_carrera").html(p);
		});

		$.post("actions/buscar_alumno.php?mode=cursos", {
			curso_select: $("#tabla_cur option:selected").val(),

		}, function(b, d) {
			$("#tabla_cursos").html(b);
		});
	}

	function caBuscar(){

		$.post("actions/buscar_alumno.php?mode=carreras", {
			carrera_select: $("#tabla_car option:selected").val(),

		}, function(p, s) {
			$("#tabla_carrera").html(p);
		});
	}

	function cuBuscar(){

		$.post("actions/buscar_alumno.php?mode=cursos", {
			curso_select: $("#tabla_cur option:selected").val(),

		}, function(b, d) {
			$("#tabla_cursos").html(b);
		});
	}

	</script>
</body>
</html>