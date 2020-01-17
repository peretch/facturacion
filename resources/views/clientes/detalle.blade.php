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
					<span class="pull-right">
						<a class="btn btn-sm btn-success" href="/clientes/nuevo" class="btn btn-link">
							<i class="fa fa-user-plus" aria-hidden="true"></i> Nuevo cliente
						</a>
					</span>
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
											<th class="text-center th-b" colspan="2">Información general</th>
										</tr>
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
											</tr>
													<tr>
													<td>
														Documento
													</td>
													<td>
														( {{$cliente->tipoDocumento->tipo_documento}} )
														{{$cliente->documento}}
													</td>												
												</tr>
											@endif												
										</tr>
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
										<tr>
											<td>
												Teléfono
											</td>
											<td>
												{{$cliente->telefono}}
											</td>												
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
												Saldo
											</td>
											<td>
												{{ App\Moneda::find(config('app.monedaPreferida'))->first()->simbolo }}
												{{ $cliente->getSaldo() }}
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
													<th class="text-center" width="120px">Fecha</th>
													<th class="text-center" width="180px">Tipo comprobante</th>
													<th class="text-center">Descripcion</th>
													<th class="text-center" width="100px">Total IVA inc.</th>
													<th></th>
												</tr>
											</thead>
											<tbody>
												@foreach($comprobantes as $c)
													<tr>
														<td>{{ date_format(date_create($c->fechaEmision), 'd / m / Y' ) }}</td>
														<td class="text-center">
															{{ $c->tipo->nombre }}
														</td>
														<td>
															{{ $c->descripcion }}
														</td>
														<td style="text-align: right;">
															{{ $c->moneda->simbolo }} {{ $c->total }}
														</td>
														<td class="text-center">
															<a href="/comprobantes/detalle/{{$c->id}}">
																<i class="fa fa-external-link"></i>
															</a>
														</td>
													</tr>													
												@endforeach
											</tbody>
										</table>
									</div>
									<div class="text-center">
										{{ $comprobantes->links() }}
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<legend>Configuración del cliente <i class="fa fa-cogs" aria-hidden="true"></i></legend>
							<div class="col-md-8">
								<form class="form-horizontal" role="form" method="POST" action="/clientes/{{$cliente->id}}/configuracion">
								{{ csrf_field() }}
								<h4>Términos de Pago</h4>
								<div class="table-responsive">
									<table width="100%" class=" table">
										<tr>
											<th width="180px">
												Descuentos
											</th>													
											<td>
												Especifique descuento a aplicar sobre las ventas o facturas nuevas del cliente. Este valor puede cambiarse para cada comprobante si el usuario tiene los permisos adecuados.
											</td>
											<td class="text-right" width="180px">
												<select class="form-control">
													<option value="">Sin descuento</option>
												</select>
											</td>
										</tr>
										<tr>
											<th>
												Plazo de factura
											</th>													
											<td>
												Especifique el plazo por defecto que tendrá una factura de venta a crédito para este cliente.
											</td>
											<td class="text-right">
												<input class="input-sm form-control" type="number" name="stockMinimo" value="" id="txtStockMinimo">
											</td>
										</tr>
									</table>
								</div>
							</div>
							<div class="col-md-3 col-md-offset-1">
								<div class="form-group">
									<form id="form-borrar" class="form-horizontal" role="form" method="POST" action="/clientes/borrar">
										{{ csrf_field() }}
										<input type="hidden" name="producto_id" value="{{$cliente->id}}">
										<h4>Eliminar cliente</h4>
										<p><small>El cliente no se mostrará más luego de ser borrado. Pero se mantendrá su registro histórico.</small></p>
										<input class="btn btn-danger" type="submit" name="" value="Borrar cliente">
									</form>
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
									<tr>
										<th>
											Teléfono
										</th>
										<td>
											<input class="form-control input-sm" type="text" name="telefono" value="{{$cliente->telefono}}">
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
