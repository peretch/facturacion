@extends('layouts.app')

@section('scriptsHeader')	
	<script src="{{ asset('js/forms/recibos.js') }}"></script>
@endsection

@section('content')
<div class="container">
	<div class="row">    
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4>Nuevo recibo</h4>
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
							<a href="/comprobantes/vencimientos" class="link_ruta">
								Vencimientos &nbsp; &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i>
							</a>
						</li>
						<li>
							<a href="/comprobantes/recibos/nuevo" class="link_ruta">
								Nuevo recibo de pago
							</a>
						</li>
					</ul>
					@include('partials.menu_productos')
					<form id="formNuevoRecibo" action="/comprobantes/recibos/guardar" method="post">
						{{ csrf_field() }}
						<input id="hidden_facturas_seleccionadas" type="hidden" name="facturas_seleccionadas" value="">
						<div class="row">						
							<div class="col-md-4">
								<div class="form-group col-md-12">
									<legend>Datos del recibo</legend>
									<label class="sr-only" for="txtFecha">Fecha de emisión</label>
									<input id="txtFecha" type="date" name="fecha" class="form-control input-sm" title="Fecha del recibo">
								</div>
								<div class="form-group col-md-6">
									<label class="sr-only" for="txtMoneda">Moneda</label>
									<select name="moneda" class="form-control input-sm" tabindex="4">
										@foreach($monedas as $moneda)
											@if($moneda->id == config('app.monedaPreferida') )
												<option value="{{$moneda->id}}" selected="true">{{$moneda->nombre}} ({{$moneda->simbolo}})</option>
											@else
												<option value="{{$moneda->id}}">{{$moneda->nombre}} ({{$moneda->simbolo}})</option>
											@endif
										@endforeach
									</select>
								</div>
								<div class="form-group col-md-6">
									<label class="sr-only" for="txtCotizacion">Cotización</label>
									<input name="cotizacion" type="text" class="form-control input-sm" id="txtCotizacion" placeholder="Cotización" tabindex="5">
								</div>

								<div class="form-group col-md-12">
									<label class="sr-only" for="txtMonto">Monto a recibir</label>
									<input name="monto" type="number" class="form-control input-sm" id="txtMonto" placeholder="Monto a recibir" tabindex="5" autofocus="true" max="{{ $total_adeudado }}">
								</div>

								<div class="form-group col-md-12">									
									<table class="table table-condensed table-striped table-bordered">
										<tr>
											<th class="th-b text-center" colspan="2">
												Datos del cliente
												<input id="hidden_cliente" type="hidden" name="cliente" value="{{ $cliente->id }}">
											</th>
										</tr>
										<tr>
											<th width="50%">Tipo de cliente</th>
											<td>
												@if($cliente->empresa)
													Empresa
												@else
													Persona
												@endif
											</td>
										</tr>
										<tr>
											<th width="150px">Nombre</th>
											<td>
												<a href="/clientes/detalle/{{ $cliente->id }}">
												@if($cliente->empresa)
													{{ $cliente->nombre }}
												@else
													{{ $cliente->nombre }} {{ $cliente->apellido }}
												@endif
												</a>
											</td>
										</tr>
										<tr>
											<th width="150px">Total atrasado</th>
											@if($total_atrasado != 0)
											<td style="color: red">
											@else
											<td style="color: green;">
											@endif
												&nbsp; {{ App\Moneda::find(config('app.monedaPreferida'))->first()->simbolo }}
												<span class="pull-right">
													{{ $total_atrasado }}
												</span>
											</td>
										</tr>
										<tr>
											<th width="150px">Total adeudado</th>
											<td>
												&nbsp; {{ App\Moneda::find(config('app.monedaPreferida'))->first()->simbolo }}
												<span class="pull-right">
													{{ $total_adeudado }}
												</span>
											</td>
										</tr>
									</table>
								</div>
							</div>							
							<div class="col-md-8">
								<legend>Facturas del cliente</legend>
								<div class="table-responsive pre-scrollable div-detalle-comprobante">
									<table id="tablaFacturas" cellspacing="0" width="100%" class="table table-condensed table-striped table-bordered">
										<thead >
											<tr>
												<th class="text-center" width="30px">
													<input class="checkboxFacturaTodas" type="checkbox" name="">
												</th>
												<th class="text-center" width="120px">Vencimiento</th>
												<th class="text-center" width="100px">Atraso (días)</th>
												<th class="text-center">Tipo de comprobante</th>
												<th class="text-center" width="100px">Deuda</th>
												<th class="text-center" width="100px">A pagar</th>
												<th class="text-center" width="100px">Saldo final</th>
											</tr>
										</thead>
										<tbody>
											@foreach($facturas as $f)
											<?php
												$hoy = time();
												$fecha_vencimiento = strtotime($f->fecha_vencimiento);
												$date_diff = $fecha_vencimiento - $hoy;
												$dias_restantes = floor($date_diff / (60 * 60 * 24)) + 1;
											?>
											<tr>
												<input class="var_factura_id" type="hidden" value="{{ $f->id }}">
												<td class="text-center">
													@if($dias_restantes <= 0)
													<input class="checkboxFactura" type="checkbox" name="" checked="true">
													@else
													<input class="checkboxFactura" type="checkbox" name="">
													@endif
												</td>
												@if($dias_restantes <= 0)
												<td class="text-center" style="color: red">
												@else
												<td class="text-center">
												@endif
													{{ date_format(date_create($f->fecha_vencimiento), 'd / m / Y' ) }}
												</td>
												<td class="text-center" style="color: red">
													@if($dias_restantes <= 0)
														{{ $dias_restantes * -1 }}
													@endif
												</td>
												<td>
													<a target="_blank" href="/comprobantes/detalle/{{ $f->comprobante->id }}">
														{{ $f->comprobante->tipo->nombre }}
													</a>
												</td>
												<td>
													&nbsp; {{ $f->comprobante->moneda->simbolo }}
													<span class="var_deuda_actual pull-right">
														{{ round($f->deuda_actual) }}
													</span>
												</td>
												<td>
													&nbsp; {{ $f->comprobante->moneda->simbolo }}
													<span id="a_pagar_{{$f->id}}" class="var_a_pagar pull-right">
														0
													</span>
												</td>
												<td>
													&nbsp; {{ $f->comprobante->moneda->simbolo }}
													<span id="saldo_final_{{$f->id}}" class="pull-right">
														{{ round($f->deuda_actual) }}
													</span>
												</td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
								<input class="btn btn-primary btn-block btn-sm" type="submit" name="" value="Confirmar">
							</div>							
						</div>						
					</form>
				</div>
			</div>				
		</div>        
	</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
$(document).ready(function(){        
	});
</script>
@endsection