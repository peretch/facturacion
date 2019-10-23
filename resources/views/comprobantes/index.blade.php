@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">    
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4>Vista general de comprobantes</h4>
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
								Comprobantes
							</a>
						</li>
					</ul>
					@include('partials.menu_productos')
					
					<a id="btnFiltrarCollapse" class="btn btn-sm" href="#" data-toggle="collapse" data-target="#collapseFiltrar">
						Filtrar <i class="fa fa-filter" aria-hidden="true"></i>
					</a>
					
					<div id="collapseFiltrar" class="collapse">
						<form id="formFiltrarComprobantes" action="/comprobantes/">
							{{ csrf_field() }}
							<div class="row">
								<div class="col-md-2 form-group text-center">
									<label class="form-label">Tipo de comprobante</label>
									<select class="form-control input-sm">
										<option value=""></option>
										@foreach($tipos_comprobante as $t)
											<option value="{{$t->id}}">{{$t->nombre}}</option>
										@endforeach
									</select>
								</div>
								<div class="col-md-4 form-inline">
									<div class="col-md-12 text-center">
										<label class="form-label">Fecha de emisión</label>
									</div>
									<div class="col-md-12 text-center">
										<input class="form-control input-sm" type="date" name="fechaInicio">
										 - 
										<input class="form-control input-sm" type="date" name="fechaFin">
									</div>
								</div>
								<div class="col-md-2 form-group text-center">
									<label class="form-label">Moneda</label>
									<select name="moneda" class="form-control input-sm" disabled="true">
										<option value=""></option>
										@foreach($monedas as $moneda)
											<option value="{{$moneda->id}}">{{$moneda->nombre}} ({{$moneda->simbolo}})</option>
										@endforeach
									</select>
								</div>
								<div class="col-md-2 form-group text-center">
								</div>
								<div class="col-md-2 form-group text-center">
									<label class="form-label"></label>
									<button type="submit" class="btn btn-block btn-sm btn-primary" type="button" name="btnFiltrar" >Filtrar</button>
								</div>
							</div>
						</form>
					</div>                    
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table id="tabla_facturas" cellspacing="0" width="100%" class="table-condensed table-striped table-bordered">
							<tr>
								<th width="50px">ID</th>
								<th width="150px">Fecha emisión</th>
								<th width="150px">Tipo de factura</th>
								<th>Descripción</th>
								<th class="text-center" width="100px">Sub-total</th>
								<th class="text-center" width="100px">IVA</th>
								<th class="text-center" width="100px">Total</th>
								<th width="25px"></th>
								<th width="25px"></th>                                
							</tr>

							@foreach($facturas as $factura)
							<tr>
								<td>{{$factura->id}}</td>
								<td>{{ date('d / m / Y', strtotime($factura->fechaEmision)) }}</td>
								<td>Venta al contado</td>
								<td>
									<?php $i=0; ?>
									@foreach($factura->lineasproducto as $l)
										@if($i<2)
											x{{ $l->cantidad}}  {{$l->producto->codigo}}, 
											<?php $i++; ?>
										@elseif($i==2)
											{{$l->producto->codigo}} x{{ $l->cantidad}}
											<?php $i++; ?>
										@endif
									@endforeach
								</td>
								<td class="text-right">{{$factura->moneda->simbolo}} {{ number_format($factura->subTotal, 2) }} </td>
								<td class="text-right">{{$factura->moneda->simbolo}} {{ number_format($factura->impuestos, 2) }} </td>
								<td class="text-right">{{$factura->moneda->simbolo}} {{ number_format($factura->total, 2) }} </td>
								<td class="text-center">
									<a target="_blank" href="/facturas/imprimir/{{$factura->id}}">
										<i class="fa fa-print" aria-hidden="true"></i>
									</a>
								</td>
								<td class="text-center">
									<a href="/facturas/detalle/{{$factura->id}}">
										<i class="fa fa-info" aria-hidden="true"></i>
									</a>
								</td>
							</tr>
							@endforeach
						</table>
					</div>
					<div class="text-center">
						{{ $facturas->links() }}
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
	});
</script>
@endsection