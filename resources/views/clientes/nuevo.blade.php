@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4>Alta de cliente</h4>
				</div>

				<div class="panel-body">
					<ul class="list-inline">
						<li>
							<a href="/" class="link_ruta">
								Inicio &nbsp; &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i>
							</a>
						</li>
						<li>
							<a href="/clientes" class="link_ruta">
								Clientes &nbsp; &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i>
							</a>
						</li>
						<li>
							<a href="/clientes/nuevo" class="link_ruta">
								Nuevo
							</a>
						</li>
					</ul>
					@include('partials.menu_productos')
					<div class="row">
						<div class="container">
							<div class="col-md-4">
								<legend>Datos del cliente</legend>
								<form method="post" action="/clientes/guardar">
									{{ csrf_field() }}
									<div class="form-group">
										<label>Tipo de cliente</label>
										<select id="select_tipo_cliente" class="form-control" name="tipo_cliente">
											<option value="persona">Persona</option>
											<option value="empresa">Empresa</option>
										</select>
									</div>
									
									<div class="form-group input-group pull-right form-persona">
										<label class="sr-only">Documento</label>
										<div style="width: 50%;" class="input-group-btn">
											<select name="tipo_documento" id="btnAgregarArticulo" class="form-control form-persona-required" oninvalid="this.setCustomValidity('Debe ingresar un tipo de documento')" required="true" oninput="setCustomValidity('')">
												<option value="" disabled selected hidden>Tipo de documento</option>
												@foreach($tipos_documento as $tipo_documento)
													<option value="{{ $tipo_documento->id }}">{{ $tipo_documento->tipo_documento }}</option>
												@endforeach
											</select>
										</div>
										<input class="form-control form-persona-required" type="text" name="documento" placeholder="N° documento" oninvalid="this.setCustomValidity('Debe ingresar un número de documento')" required="true" oninput="setCustomValidity('')">
									</div>
									<div class="form-group form-persona">
										<label class="sr-only">Género</label>
										<select class="form-control form-persona-required" name="genero" oninvalid="this.setCustomValidity('Debe ingresar un género pare el cliente')" required="true" oninput="setCustomValidity('')">
											<option value="" disabled selected hidden>Género</option>
											<option value="m">Masculino</option>
											<option value="f">Femenino</option>
										</select>
									</div>

									<div class="form-group form-persona">
										<label class="sr-only">Nombre</label>
										<input class="form-control form-persona-required" type="text" name="nombre" placeholder="Nombre" required="true" oninvalid="this.setCustomValidity('Debe ingresar un nombre de cliente')" oninput="setCustomValidity('')">
									</div>
									<div class="form-group form-persona">
										<label class="sr-only">Apellido</label>
										<input class="form-control" type="text" name="apellido" placeholder="Apellido">
									</div>

									<div class="form-group form-empresa" hidden>
										<label class="sr-only">Razón social</label>
										<input class="form-control form-empresa-required" type="text" name="razonSocial" placeholder="Razón social" oninvalid="this.setCustomValidity('Debe ingresar una razón social para el cliente')" oninput="setCustomValidity('')">
									</div>
									<div class="form-group form-empresa" hidden>
										<label class="sr-only">RUT</label>
										<input class="form-control form-empresa-required" type="text" name="rut" placeholder="RUT" oninvalid="this.setCustomValidity('Debe ingresar un RUT para el cliente')" oninput="setCustomValidity('')">
									</div>

									<div class="form-group form-persona form-empresa" >
										<label class="sr-only">Mail</label>
										<input class="form-control" type="text" name="mail" placeholder="E-mail">
									</div>
									<div class="form-group form-persona form-empresa" >
										<label class="sr-only">Dirección</label>
										<input class="form-control" type="text" name="direccion" placeholder="Dirección">
									</div>
									<div class="form-group form-persona form-empresa" >
										<label class="sr-only">Teléfono</label>
										<input class="form-control" type="text" name="telefono" placeholder="Teléfono">
									</div>

									<div class="form-group form-persona form-empresa" >
										<button type="submit" class="btn btn-block btn-primary">Guardar</button>
									</div>
								</form>
							</div>
							<div class="col-md-6 col-md-offset-1">
                				<legend>Últimos clientes registrados</legend>
                				<div class="table-responsive">
	                				<table width="97%" class="table table-striped table-bordered">
	                					<thead>
	                						<tr>
	                							<th>Nombre</th>
	                							<th>Fecha de registro</th>
	                						</tr>	                						
	                					</thead>
	                					<tbody>
	                						@foreach($clientes->sortByDesc('created_at')->take(8) as $c)
	                							<tr>
	                								<td>
	                									<a href="/clientes/detalle/{{ $c->id}}">
	                										@if($c->empresa)
	                											<i style="width: 20px;" class="fa fa-briefcase text-center" aria-hidden="true"></i>
	                										@else
	                											<i style="width: 20px;" class="fa fa-user text-center" aria-hidden="true"></i>
	                										@endif
                											{{ $c->nombre }} {{ $c->apellido }}
	                									</a>
	                								</td>
	                								@if($c->created_at != null)
	                									<td>{{ date_format( $c->created_at, 'd/m/Y H:i:s' ) }}</td>
	                								@else
	                									<td></td>
	                								@endif
	                							</tr>
	                						@endforeach
	                					</tbody>
	                				</table>
	                			</div>
                			</div>
							<div class="col-md-5 col-md-offset-2">                				

                			</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
	<script type="text/javascript">

		$(document).ready(function(){
			$("#select_tipo_cliente").on('change', function(){
				if($("#select_tipo_cliente").val() == "persona"){
					$(".form-empresa-required").prop('required',false);
					$(".form-empresa").hide();
					
					$(".form-persona-required").prop('required',true);
					$(".form-persona").show();

				}else if($("#select_tipo_cliente").val() == "empresa"){

					$(".form-persona-required").prop('required',false);
					$(".form-persona").hide();
					
					$(".form-empresa-required").prop('required',true);
					$(".form-empresa").show();
				}
			});
		});
	</script>
@endsection