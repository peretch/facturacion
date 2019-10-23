@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4>Vista general de productos</h4>
				</div>

				<div class="panel-body">
					<span class="pull-right">
						<a class="btn btn-sm btn-success" href="/productos/nuevo" class="btn btn-link">
							<i class="fa fa-plus" aria-hidden="true"></i> Nuevo producto
						</a>
					</span>
					<ul class="list-inline">
						<li>
							<a href="/" class="link_ruta">
								Inicio &nbsp; &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i>
							</a>
						</li>
						<li>
							<a href="/productos" class="link_ruta">
								Productos
							</a>
						</li>
					</ul>
					@include('partials.menu_productos')
					<div class="row">
						<div class="container">
							<div class="table-responsive table-condensed">
								<table id="tabla_productos" cellspacing="0" width="97%" class="table-condensed table-striped table-bordered">
									<tr>
										<th width="120px">Código</th>
										<th width="15%">Nombre</th>
										<th width="15%">Familia producto</th>
										<th>Descripción</th>
										<th width="10%">Precio</th>
										<th width="10%" colspan="2">Stock</th>                                      
									</tr>

									@foreach($productos as $producto)
										<tr>
											<td><a href="/productos/detalle/{{ $producto->codigo}}">{{ $producto->codigo}}</a></td>
											<td>{{ $producto->nombre}}</td>
											<td>{{ $producto->familia->nombre}}</td>
											<!--<td>{{ $producto->descripcion}}</td>-->
											<td>
												{{ str_limit(str_replace('<br />','', $producto->descripcion), 80) }}

												@if(strlen($producto->descripcion) > 80)
												<span class="pull-right">
													<a class="btn-sm btn-link" data-toggle="modal" data-target="#myModal{{ $producto->codigo }}">
														más...
													</a>
												</span>
													<div id="myModal{{ $producto->codigo }}" class="modal fade" role="dialog">
														<div class="modal-dialog">
															<div class="modal-content">
																<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal">&times;</button>
																	<h4 class="modal-title">{{ $producto->nombre }}</h4>
																</div>
																<div class="modal-body">
																	{!! $producto->descripcion !!}
																</div>
																<div class="modal-footer">
																	<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
																</div>
															</div>
														</div>
													</div>
												@endif
											</td>
											<td>
												{{ App\Moneda::find(config('app.monedaPreferida'))->first()->simbolo }}
												{{ $producto->precio}}
											</td>
											<td width="5%" class="text-center">{{ $producto->stock}}</td>
											<td class="text-center" width="5%">
												<a href="#formStock" id="{{$producto->codigo}}" data-toggle="modal" data-target="#formStock" onclick='$("#form_stock").attr("action", "/productos/{{$producto->codigo}}/ModificarStock");'>
													<i class="fa fa-exchange" aria-hidden="true"></i>
												</a>
											</td>
										</tr>
									@endforeach                         
								</table>
							</div>
							<div class="text-center">
								{{ $productos->links() }}
							</div>
						</div>
					</div>
					@include('partials.movimiento_stock')
				</div>                
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript"> 
	$("#form_busqueda").show();
	$("#txtBusqueda").focus();  
</script>
@endsection
