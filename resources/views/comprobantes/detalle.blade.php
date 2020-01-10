@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">    
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4>Detalle del comprobante</h4>
				</div>                
				<div class="panel-body">
					<span class="pull-right">
						<a class="btn btn-sm btn-success" href="/comprobantes/nuevo" class="btn btn-link">
							<i class="fa fa-plus" aria-hidden="true"></i> Nuevo comprobante
						</a>
					</span>
					<ul class="list-inline">
						<li>
							<a href="/" class="link_ruta">
								Inicio &nbsp; &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i>
							</a>
						</li>
						<li>
							<a href="/comprobantes" class="link_ruta">
								Comprobantes &nbsp; &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i>
							</a>
						</li>
						<li>
							<a href="/comprobantes/detalle/{{$comprobante->id}}" class="link_ruta">
								Detalle
							</a>
						</li>
					</ul>
					@include('partials.menu_productos')					
					<div class="row">
						<div class="col-md-4">							
							<div class="col-md-12 col-sm-12 col-xs-12">
								<legend>Detalle de la factura</legend>
							</div>
							<table class="table table-condensed table-striped table-bordered">
								<tr>
									<th class="text-center th-b" colspan="2">Información general</th>
								</tr>
								<tr>
									<td width="144px">Tipo de comprobante</td>
									<td>{{ $comprobante->tipo->nombre }}</td>									
								</tr>
								<tr>
									<td>Fecha de emisión</td>
									@if($comprobante->fecha_emision)
										
										<td>
											{{ date_format(date_create($comprobante->fecha_emision), 'd / m / Y' ) }}
										</td>
									@else
										<td style="color: #aaa;">- - -</td>
									@endif
								</tr>
								<tr>
									<td>Serie</td>
									@if($comprobante->serie)
										<td>{{ $comprobante->serie }}</td>
									@else
										<td style="color: #aaa;">- - -</td>
									@endif
								</tr>
								<tr>
									<td>Número</td>
									@if($comprobante->serie)
										<td>{{ $comprobante->numero }}</td>
									@else
										<td style="color: #aaa;">- - -</td>
									@endif
								</tr>


								@if($comprobante->factura)
									<tr>
										<th class="text-center th-b" colspan="2">Datos de la factura</th>
									</tr>
									<tr>
										<?php
											$hoy = time();
											$fecha_vencimiento = strtotime($comprobante->factura->fecha_vencimiento);
											$date_diff = $fecha_vencimiento - $hoy;
											$dias_restantes = floor($date_diff / (60 * 60 * 24)) + 1;
										?>
										<td>Vencimiento</td>									
										<td>
											{{ date_format(date_create($comprobante->factura->fecha_vencimiento), 'd / m / Y' ) }}
											@if($comprobante->factura->deuda_actual == 0)
												<span class="pull-right text-success">
													(Factura paga)
												</span>
											@elseif($dias_restantes <= 0)
												<span class="pull-right danger">
													( Vencida )
												</span>
											@elseif($dias_restantes <= 7)
												<span class="pull-right warning">
													( {{$dias_restantes}} días )
												</span>
											@else
												<span class="pull-right">
													( {{$dias_restantes}} días )
												</span>
											@endif
										</td>									
									</tr>
									<tr>
										<td>Deuda original</td>
										<td>
											{{ App\Moneda::find(config('app.monedaPreferida'))->first()->simbolo }}
											&nbsp;
											{{ $comprobante->factura->deuda_original }}
										</td>
									</tr>
									<tr>
										<td>Deuda actual</td>
										@if($comprobante->factura->deuda_actual == 0)
										<td class="text-success">
										@else
										<td>
										@endif
											{{ App\Moneda::find(config('app.monedaPreferida'))->first()->simbolo }}
											&nbsp;
											{{ $comprobante->factura->deuda_actual }}
										</td>
									</tr>
								@endif
								<tr>
									<th class="text-center th-b" colspan="2">Datos del cliente</th>
								</tr>
								<tr>
									<td>Cliente</td>
									@if($comprobante->cliente)
										<td><a href="/clientes/detalle/{{ $comprobante->cliente->id }}">{{ $comprobante->cliente->nombre }} {{ $comprobante->cliente->apellido }}</a></td>
									@else
									   <td>{{ $comprobante->nombre_cliente }}</td>
									@endif
								</tr>
								<tr>
									<td>RUT</td>
									@if($comprobante->serie)
										<td>{{ $comprobante->rut }}</td>
									@else
										<td>N/A</td>
									@endif
								</tr>
								<tr>
									<td>Dirección</td>
									@if($comprobante->direccion)
										<td>{{ $comprobante->direccion }}</td>
									@else
										<td style="color: #aaa;">- - -</td>
									@endif
								</tr>
							</table>
							@if($comprobante->factura && $comprobante->factura->deuda_actual > 0)
								<a href="/comprobantes/recibos/nuevo/{{$comprobante->cliente_id}}" target="_blank" class="btn btn-block btn-success">
									Ingresar recibo de pago 
									<span class="pull-right">
										<i class="fa fa-plus-square" aria-hidden="true"></i>
									</span>
								</a>
							@endif
							<a href="/comprobantes/imprimir/{{$comprobante->id}}" target="_blank" class="btn btn-block btn-primary">
								Imprimir
								<span class="pull-right">
									<i class="fa fa-print" aria-hidden="true"></i>
								</span>
							</a>
						</div>
						<div class="col-md-8">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<legend>Artículos</legend>
							</div>
							<div class="col-md-12 col-sm-12 col-xs-12 pre-scrollable div-detalle-comprobante">
								<table width="100%" class="table-condensed table-striped table-bordered">
									<thead>
										<tr>											
											<th class="text-center">Artículo</th>
											<th class="text-center" width="100px">precio</th>
											<th class="text-center" width="50px">Cant.</th>
											<th class="text-center" width="100px">Sub total</th>
											<th class="text-center" width="100px">IVA</th>
											<th class="text-center" width="100px">Total</th>
										</tr>
									</thead> 
									<tbody id="tablaProductos">
										@foreach($comprobante->lineasProducto as $l)
										<tr>											
											<td>
												<a href="/productos/detalle/{{ $l->producto->codigo }}">
													{{ $l->producto->nombre }}
												</a>
											</td>
											<td>
												&nbsp; {{ $comprobante->moneda->simbolo }}
												<span class="pull-right">
													{{ $l->precioUnitario }}
												</span>
											</td>
											<td class="text-center">
												{{ $l->cantidad }}
											</td>
											<td>
												&nbsp; {{ $comprobante->moneda->simbolo }}
												<span class="pull-right">
													{{ number_format($l->subTotal, 2, '.', ',') }}
												</span>
											</td>
											<td>
												&nbsp; {{ $comprobante->moneda->simbolo }}
												<span class="pull-right">
													{{ number_format($l->iva, 2, '.', ',') }}
												</span>
											</td>
											<td>
												&nbsp; {{ $comprobante->moneda->simbolo }}
												<span class="pull-right">
													{{ number_format($l->total, 2, '.', ',') }}
												</span>
											</td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>							
							<div class="col-md-6 col-md-offset-6 col-sm-6 col-sm-offset-6 col-xs-12">
								<table class="table-condensed pull-right table-striped">
									<thead id="tablaResumen">
										<tr>
											<td width="160px">SUB-TOTAL</td>
											<td>
												{{ number_format($comprobante->subTotal, 0, '.', ',') }} &nbsp;
											</td>
										</tr>
										<tr>
											<td>IVA</td>
											<td>
												{{ number_format($comprobante->iva, 0, '.', ',') }} &nbsp;
											</td>
										</tr>
										<tr>
											<td>TOTAL</td>
											<td>
												{{ number_format($comprobante->total, 0, '.', ',') }} &nbsp;
											</td>
										</tr>
									</thead>
								</table>
							</div>

							@if($comprobante->factura)
								<div class="col-md-12 col-sm-12 col-xs-12">
									<legend>Recibos de pago</legend>
								</div>
								<div class="col-md-12 col-sm-12 col-xs-12">
									<table class="table table-condensed table-striped table-bordered">
										<thead>
											<tr>
												<th class="text-center">Fecha</th>
												<th width="120px" class="text-center">Deuda inicial</th>
												<th width="120px" class="text-center">Monto recibido</th>
												<th width="120px" class="text-center">Deuda final</th>
												<th class="text-center">Usuario</th>
											</tr>
										</thead>
										<tbody>
											@foreach($comprobante->factura->recibos->sortByDesc('fecha') as $r)
												@if($r->pivot->deuda_final == 0)
												<tr class="td-success">
												@else
												<tr>
												@endif
													<td class="text-center" title="{{ date_format(date_create($r->fecha), 'd/m/Y - H:i:s') }}">
														{{ date_format(date_create($r->fecha), 'd / m / Y' ) }}
													</td>
													<td>
														&nbsp; {{ $r->moneda->simbolo }}
														<span class="pull-right">
															{{ $r->pivot->deuda_inicial }} &nbsp;
														</span>
													</td>
													<td>
														&nbsp; {{ $r->moneda->simbolo }}
														<span class="pull-right">
															{{ $r->monto }} &nbsp;
														</span>
													</td>
													<td>
														&nbsp; {{ $r->moneda->simbolo }}
														<span class="pull-right">
															{{ $r->pivot->deuda_final }} &nbsp;
														</span>
													</td>
													<td class="text-center">
														{{ $r->usuario->email }}
													</td>
												</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							@endif
						</div>
					</div>                    
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
