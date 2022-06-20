@extends("directivo.layout.main")
@section("titulohead")
	Grupos | Directivo
@endsection
@section("css")
	<!-- Bootstrap Data Table Plugin -->
	<link rel="stylesheet" href="/css/components/bs-datatable.css" type="text/css" />
@endsection

@section("titulo-pagina")
		Grupos
@endsection
@section("url")
	<li class="breadcrumb-item"><a href="{{route("directivo.inicio")}}">Inicio</a></li>
	<li class="breadcrumb-item"><a href="{{route("directivo.grupos")}}">Grupos</a></li>
@endsection

@section("contenido")

	<div class="content-wrap">
		<div class="container clearfix">
			<div class="table-responsive">
				<a href="#" class="button button-border button-rounded button-green color-naranja" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="icon-line-circle-plus"></i>Agregar Grupo</a>
				<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg">
						<div class="modal-body">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title" id="myModalLabel">Agregar nuevo Grupo</h4>
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								</div>
								<div class="modal-body">
									<p>Ingresa la siguiente información para agregar un grupo nuevo. </a>.</p>
									<form style="max-width: 100rem;" action="{{route("generales.agregar.grupo")}}" method="post">
										{{csrf_field()}}
										@foreach($errors->get("generales") as $error)
											<span class="text-danger">
												{{$error}}
											</span>
										@endforeach
										<div class="form-group">
											<label for="nombre-grupo">Nombre</label>
											<input type="text" class="form-control" id="nombre-grupo" name="nombreGrupo" placeholder="Ingresa el nombre del grupo" required="" autocomplete="off">
										</div>
										@foreach($errors->get("nombreGrupo") as $error)
											<span class="text-danger">
												{{$error}}
											</span>
										@endforeach
										<div class="form-group">
											<label for="nombre-cuatrimestre">Cuatrimestre</label>
											<select class="form-control" name="cuatrimestreId" id="nombre-cuatrimestre">
												@foreach($cuatrimestres as $cuatrimestre)
													<option value="{{$cuatrimestre->id}}">{{$cuatrimestre->nombre}}</option>
												@endforeach
											</select>
										</div>
										@foreach($errors->get("cuatrimestreId") as $error)
											<span class="text-danger">
												{{$error}}
											</span>
										@endforeach
										<div class="form-group">
											<label for="nombre-cuatrimestre">Evaluación</label>
											<select class="form-control" name="evaluacion" id="evaluacion">
												@foreach($evaluaciones as $evaluacion)
													<option value="{{$evaluacion->id}}">{{$evaluacion->nombre}}</option>
												@endforeach
											</select>
										</div>
										@foreach($errors->get("evaluacion") as $error)
											<span class="text-danger">
												{{$error}}
											</span>
										@endforeach
										<div class="form-group">
											<label for="nombre-cuatrimestre">Carrera</label>
											<select class="form-control" name="carrera" id="carrera">
												@foreach($carreras as $carrera)
													<option value="{{$carrera->id}}">{{$carrera->nombre}}</option>
												@endforeach
											</select>
										</div>
										@foreach($errors->get("carrera") as $error)
											<span class="text-danger">
												{{$error}}
											</span>
										@endforeach
										<div class="form-group">
											<label for="nombre-cuatrimestre">Plan de estudios</label>
											<select class="form-control" name="plan" id="plan">
												@foreach($planes as $plan)
													<option value="{{$plan->id}}">{{$plan->nombre}}</option>
												@endforeach
											</select>
										</div>
										@foreach($errors->get("plan") as $error)
											<span class="text-danger">
												{{$error}}
											</span>
										@endforeach
										<div class="form-group">
											<label for="nombre-anio">Año</label>
											<select class="form-control" name="anio" id="nombre-anio">
												<option value="2016">2016</option>
												<option value="2017">2017</option>
												<option value="2018">2018</option>
												<option value="2019">2019</option>
												<option value="2020">2020</option>
												<option value="2021">2021</option>
												<option value="2022">2022</option>
												<option value="2023">2023</option>
												<option value="2024">2024</option>
												<option value="2025">2025</option>
												<option value="2026">2026</option>
												<option value="2027">2027</option>
												<option value="2028">2028</option>
												<option value="2029">2029</option>
											</select>
										</div>
										@foreach($errors->get("anio") as $error)
											<span class="text-danger">
												{{$error}}
											</span>
										@endforeach
										<center>
											<button type="submit" class="button button-border button-rounded button-aqua"><i class="icon-inbox"></i>Agregar Grupo</button>
										</center>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
				@foreach($errors->get("generales") as $error)
					<span class="text-danger">
						{{$error}}
					</span>
				@endforeach
				<br><br>
				<table id="datatable1" class="table table-striped table-bordered" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>#</th>
							<th>Nombre</th>
							<th>Cuatrimestre</th>
							<th>año</th>
							<th>Estatus</th>
							<th>Ver</th>
							<th>Eliminar</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>#</th>
							<th>Nombre</th>
							<th>Cuatrimestre</th>
							<th>año</th>
							<th>Estatus</th>
							<th>Ver</th>
							<th>Eliminar</th>
						</tr>
					</tfoot>
					<tbody>
						@foreach($grupos as $grupo)
							<tr class="">
								<td>{{$loop->index + 1}}</td>
								<td>{{$grupo->nombre}}</td>
								<td>{{$grupo->cuatrimestre->nombre}}</td>
								<td>{{$grupo->anio}}</td>
								<td>
									@if($grupo->estatus == 1)
										Activo
									@else
										Inactivo
									@endif
								</td>
								<td>
									<center>
										<a href="{{route("directivo.grupo.detalle", ["slug" => $grupo->slug])}}" class="button button-mini button-rounded button-aqua"><i class="icon-edit2"></i>Ver</a>
									</center>
								</td>
								<td>
									<center>

									</center>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
				<div class="modal fade bs-example-modal-lg-editar" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg">
						<div class="modal-body">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title" id="myModalLabel">Editar </a></h4>
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								</div>
								<div class="modal-body">
									<p>Edita la siguiente información de la grupo</a>.</p>
									<form style="max-width: 100rem;">
										<div class="form-group">
											<label for="nombre">Nombre</label>
											<input type="text" class="form-control" id="editar-nombre-grupo" name="nombreGrupo" placeholder="Ingresa el nombre de la grupo " required="">
										</div>
										<div class="form-group">
											<label for="clave">Clave</label>
											<input type="text" class="form-control" id="editar-clave-grupo" name="claveGrupo" placeholder="Ingresa la clave de la grupo " required="">
											<small id="emailHelp" class="form-text text-muted">La clave es importante.</small>
										</div>
										<center>
											<button type="submit" class="button button-border button-rounded button-aqua"><i class="icon-edit2"></i>Editar</button>
										</center>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection


@section("js")
	<!-- Bootstrap Data Table Plugin -->
	<script src="/js/components/bs-datatable.js"></script>
	<script>

		$(document).ready(function() {
			$('#datatable1').dataTable({
			    language: {
			        "decimal": "",
			        "emptyTable": "No hay información",
			        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
			        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
			        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
			        "infoPostFix": "",
			        "thousands": ",",
			        "lengthMenu": "Mostrar _MENU_ Entradas",
			        "loadingRecords": "Cargando...",
			        "processing": "Procesando...",
			        "search": "Buscar:",
			        "zeroRecords": "Sin resultados encontrados",
			        "paginate": {
			            "first": "Primero",
			            "last": "Ultimo",
			            "next": "Siguiente",
			            "previous": "Anterior"
			        }
			    },			    
			});
		});

	</script>

@endsection