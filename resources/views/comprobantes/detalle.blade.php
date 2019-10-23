@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">    
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4>Detalle de factura</h4>
				</div>                
				<div class="panel-body">
					<ul class="list-inline">
						<li>
							<a href="/" class="link_ruta">
								Inicio &nbsp; &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i>
							</a>
						</li>
						<li>
							<a href="/facturas" class="link_ruta">
								Facturas &nbsp; &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i>
							</a>
						</li>
						<li>
							<a href="/facturas/detalle/{{$factura->id}}" class="link_ruta">
								Detalle
							</a>
						</li>
					</ul>
					@include('partials.menu_productos')                    
					<div class="row">
						<div class="col-md-4">                            
							<legend>Datos de la factura</legend>                               
							<table class="table">
								<tr>
									<td>Fecha de emisión</td>
									@if($factura->fechaEmision)
										<td>{{ $factura->fechaEmision }}</td>
									@else
										<td style="color: #aaa;">Sin especificar</td>
									@endif
								</tr>
								<tr>
									<td>Serie</td>
									@if($factura->serie)
										<td>{{ $factura->serie }}</td>
									@else
										<td style="color: #aaa;">Sin especificar</td>
									@endif
								</tr>
								<tr>
									<td>Número</td>
									@if($factura->serie)
										<td>{{ $factura->numero }}</td>
									@else
										<td style="color: #aaa;">Sin especificar</td>
									@endif
								</tr>
								<tr>
									<td>Cliente</td>
									@if($factura->cliente)
										<td><a href="/clientes/detalle/{{ $factura->cliente->id }}">{{ $factura->cliente->nombre }} {{ $factura->cliente->apellido }}</a></td>
									@else
									   <td>{{ $factura->nombreCliente }}</td>
									@endif
								</tr>
								<tr>
									<td>RUT</td>
									@if($factura->serie)
										<td>{{ $factura->rut }}</td>
									@else
										<td>N/A</td>
									@endif
								</tr>
								<tr>
									<td>Dirección</td>
									@if($factura->direccion)
										<td>{{ $factura->direccion }}</td>
									@else
										<td style="color: #aaa;">Sin especificar</td>
									@endif
								</tr>
							</table>
							<a href="/facturas/imprimir/{{$factura->id}}" target="_blank" class="btn btn-block btn-primary">Imprimir <i class="fa fa-print" aria-hidden="true"></i></a>
						</div>
						<div class="col-md-8">                            
							<legend>
							<div class="row">
								<div class="col-md-4">
									Artículos
								</div>                                    
							</div>
							</legend>
							<div class="col-md-12 pre-scrollable div-detalle-factura">
								<table width="100%" class="table-condensed table-striped table-bordered">
									<thead>
										<tr>
											<th width="100px">Código</th>
											<th>Artículo</th>
											<th width="80px">precio</th>
											<th width="75px">Cant.</th>
											<th width="80px">Sub total</th>
											<th width="80px">Impuestos</th>
											<th width="80px">Total</th>
										</tr>
									</thead> 
									<tbody id="tablaProductos">
										@foreach($factura->lineasProducto as $l)
										<tr>
											<td><a href="/productos/detalle/{{ $l->producto->codigo }}">{{ $l->producto->codigo }}</a></td>
											<td>{{ $l->producto->nombre }}</td>
											<td>{{ $l->precioUnitario }}</td>
											<td>{{ $l->cantidad }}</td>
											<td>{{ number_format($l->subTotal, 2, '.', ',') }}</td>
											<td>{{ number_format($l->impuestos, 2, '.', ',') }}</td>
											<td>{{ number_format($l->total, 2, '.', ',') }}</td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
							<div class="col-md-6">
							</div>
							<div class="col-md-6">
								<table class="table-condensed pull-right table-striped">
									<thead id="tablaResumen">
										<tr>
											<td>SUB-TOTAL</td>
											<td>{{ number_format($factura->subTotal, 0, '.', ',') }}</td>
										</tr>
										<tr>
											<td>IVA</td>
											<td>{{ number_format($factura->impuestos, 0, '.', ',') }}</td>
										</tr>
										<tr>
											<td>TOTAL</td>
											<td>{{ number_format($factura->total, 0, '.', ',') }}</td>
										</tr>
									</thead>
								</table>
							</div>                            
						</div>
					</div>                    
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
