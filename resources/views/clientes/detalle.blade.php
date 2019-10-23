@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4>Detalle de cliente</h4>
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
							<a href="/clientes/detalle/{{$cliente->id}}" class="link_ruta">
								{{$cliente->nombre}} {{$cliente->apellido}}
							</a>
						</li>
					</ul>
					@include('partials.menu_productos')
					<div class="row">
						<div class="container">
							<div class="col-md-4">
								<legend>
									Datos del cliente
									<span class="pull-right">
										<a class="btn btn-link btn-sm" id="editCodigo" data-toggle="modal" data-target="#modalEditarCliente">
											<i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i>
										</a>
									</span>
								</legend>								
								<div class="form-group">
									<table class="table table-condensed table-striped table-bordered" width="100%">
										<tr>
											<td width="30%">Tipo de cliente</td>
											<td width="70%">
												@if($cliente->empresa)
													Empresa
												@else
													Persona
												@endif
											</td>												
										</tr>
										<tr>
											@if($cliente->empresa)
												<td>
													Razón social
												</td>
												<td>
													{{$cliente->nombre}}
												</td>
											@else
												<td>
													Nombre
												</td>
												<td>
													{{$cliente->nombre}} {{$cliente->apellido}}
												</td>
											@endif												
										</tr>
										@if($cliente->empresa)
										<tr>
											<td>
												RUT
											</td>
											<td>
												{{$cliente->rut}}
											</td>												
										</tr>
										@endif
										<tr>
											<td>
												Mail
											</td>
											<td>
												{{$cliente->mail}}
											</td>												
										</tr>
										<tr>
											<td>
												Dirección
											</td>
											<td>
												{{$cliente->direccion}}
											</td>												
										</tr>
									</table>
								</div>								
							</div>
							<div class="col-md-8">
								<legend>Actividad del cliente</legend>
								<div class="col-md-12">
									<div class="table-responsive">
										<table width="100%" class="table table-condensed table-striped table-bordered">
											<thead>
												<tr>
													<th width="60px">Factura</th>
													<th width="120px">Fecha</th>
													<th colspan="2">Producto</th>
													<th width="60px">Cant.</th>
													<th width="100px">Total</th>
												</tr>
											</thead>
											<tbody>
												@foreach($cliente->comprobantes as $f)
													@foreach($f->lineasProducto as $l)
														<tr>
															<td>
																<a href="/facturas/detalle/{{$f->id}}">
																	{{$f->id}}
																</a>
															</td>
															<td>{{ date('d / m / Y', strtotime($f->fechaEmision)) }}</td>
															<td>
																<a href="/productos/detalle/{{$l->producto->codigo}}">
																	{{$l->producto->codigo}}
																</a>
															</td>
															<td>{{$l->producto->nombre}}</td>
															<td>x{{$l->cantidad}}</td>
															<td style="text-align: right;">
																{{$f->moneda->simbolo}} {{ number_format($l->total, 2, '.', ',') }}
															</td>
														</tr>
													@endforeach
												@endforeach
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modalEditarCliente" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4>
					Editar datos del cliente
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</h4>
			</div>

			<div class="modal-body">
				<div class="row">
					<div class="col-md-10 col-md-offset-1">
						<form id="form_editar_cliente" class="form-horizontal" role="form" method="POST" action="/clientes/guardar">
						{{ csrf_field() }}
							<input type="hidden" name="cliente_id" value="{{$cliente->id}}">
							<div class="form-group">
								<table class="table table-condensed table-striped table-bordered" width="100%">
									<tr>
										<th width="40%">Tipo de cliente</th>
										<td width="50%">
											@if($cliente->empresa)
												<input class="form-control input-sm" type="text" name="tipo_cliente" value="Emnpresa" disabled="true">
											@else
												<input class="form-control input-sm" type="text" name="tipo_cliente" value="Persona" disabled="true">
											@endif
										</td>												
									</tr>
									<tr>
										@if($cliente->empresa)
											<th>
												Razón social
											</th>
											<td>
												<input class="form-control input-sm" type="text" name="razonSocial" value="{{$cliente->nombre}}">
											</td>
										@else
											<th>
												Nombre
											</th>
											<td>
												<input class="form-control input-sm" type="text" name="nombre" value="{{$cliente->nombre}}">
											</td>
										</tr>
										<tr>
											<th>
												Apellido
											</th>
											<td>
												<input class="form-control input-sm" type="text" name="apellido" value="{{$cliente->apellido}}">
											</td>										
										@endif												
									</tr>
									@if($cliente->empresa)
									<tr>
										<th>
											RUT
										</th>
										<td>
											<input class="form-control input-sm" type="text" name="rut" value="{{$cliente->rut}}">
										</td>												
									</tr>
									@endif
									<tr>
										<th>
											Mail
										</th>
										<td>
											<input class="form-control input-sm" type="text" name="mail" value="{{$cliente->mail}}">
										</td>												
									</tr>
									<tr>
										<th>
											Dirección
										</th>
										<td>
											<input class="form-control input-sm" type="text" name="direccion" value="{{$cliente->direccion}}">
										</td>												
									</tr>
								</table>
								<input type="submit" name="" value="Guardar cambios" class="btn btn-primary btn-block">
							</div>
						</form>
					</div>
				</div>
			</div>

			<div class="modal-footer">
				
			</div>        
		</div>
	</div>
</div>
@endsection
