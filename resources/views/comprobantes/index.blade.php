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
						<table id="tabla_comprobantes" cellspacing="0" width="100%" class="table-condensed table-striped table-bordered">
							<tr>								
								<th class="text-center" width="120px">Fecha emisión</th>
								<th class="text-center" width="200px">Tipo comprobante</th>
							<!--
								<th class="text-center">Descripción</th>
							-->
								<th class="text-center">Cliente</th>
								<th class="text-center" class="text-center" width="120px">Sub-total</th>
								<th class="text-center" class="text-center" width="120px">IVA</th>
								<th class="text-center" class="text-center" width="120px">Total</th>
								<th class="text-center" width="50px" colspan="2"></th>								
							</tr>

							@foreach($comprobantes as $comprobante)
							<tr>								
								<td class="text-center">{{ date('d / m / Y', strtotime($comprobante->fecha_emision)) }}</td>
								<td class="text-center">{{ $comprobante->tipo->nombre }}</td>
							<!--
								<td class="text-center">
									<?php $i=0; ?>
									@foreach($comprobante->lineasproducto as $l)
										@if($i<2)
											x {{ $l->cantidad}}  {{$l->producto->nombre}}, 
											<?php $i++; ?>
										@elseif($i==2)
											{{$l->producto->nombre}} x {{ $l->cantidad}}
											<?php $i++; ?>
										@endif
									@endforeach
								</td>
							-->
								@if($comprobante->cliente)

								<td class="text-center" title="{{$comprobante->cliente->rut}}">
									<a href="/clientes/detalle/{{$comprobante->cliente->id}}">
										{{$comprobante->cliente->nombre}} {{$comprobante->cliente->apellido}}
									</a>
								</td>

								@else

								<td class="text-center">
									{{$comprobante->nombre_cliente}}
								</td>

								@endif
								
								<td>
									&nbsp; {{$comprobante->moneda->simbolo}} 
									<span class="pull-right">
										{{ number_format($comprobante->subTotal, 2) }}
									</span>
								</td>

								<td>
									&nbsp; {{$comprobante->moneda->simbolo}} 
									<span class="pull-right">
										{{ number_format($comprobante->iva, 2) }}
									</span>
								</td>

								<td>
									&nbsp; {{$comprobante->moneda->simbolo}} 
									<span class="pull-right">
										{{ number_format($comprobante->total, 2) }}
									</span>
								</td>

								<td width="50px" class="text-center" title="Vista de impresión">
									<a target="_blank" href="/comprobantes/imprimir/{{$comprobante->id}}">
										<i class="fa fa-print" aria-hidden="true"></i>
									</a>
								</td>

								<td width="50px" class="text-center" title="Detalle del comprobante">
									<a href="/comprobantes/detalle/{{$comprobante->id}}">
										<i class="fa fa-external-link" aria-hidden="true"></i>
									</a>
								</td>
							</tr>
							@endforeach
						</table>
					</div>
					<div class="text-center">
						{{ $comprobantes->links() }}
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