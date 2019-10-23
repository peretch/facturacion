@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4>Detalle de producto</h4>
				</div>
				<div class="panel-body">					
					<ul class="list-inline">
						<li>
							<a href="/" class="link_ruta">
								Inicio &nbsp; &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i>
							</a>
						</li>
						<li>
							<a href="/productos" class="link_ruta">
								Productos &nbsp; &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i>
							</a>
						</li>
						<li>
							<a href="/productos/detalle/{{$producto->codigo}}" class="link_ruta">
								{{ $producto->nombre }}
							</a>
						</li>
					</ul>
					@include('partials.menu_productos')
					<div class="row">
						<div class="container">
							<div class="col-md-4">
								<legend>
									Detalle del producto
									<span class="pull-right">
										<a class="btn btn-link btn-sm" id="editCodigo" data-toggle="modal" data-target="#modalEditarProducto">
											<i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i>
										</a>
									</span>
								</legend>								
								<div class="form-group">
									<table class="table table-condensed table-striped table-bordered" width="100%">
										<tr>
											<td width="30%">Código</td>
											<td width="70%">
												{{ $producto->codigo }}
											</td>
										</tr>
										<tr>
											<td>Nombre</td>
											<td> 
												{{ $producto->nombre }}
											</td>
										</tr>
										<tr>
											<td>Cod. barras</td>
											<td> 
												{{ $producto->codigo_de_barras }}
											</td>												
										</tr>
										<tr>
											<td>Familia</td>
											<td> 
												{{ $producto->familia->nombre }}
											</td>
										</tr>
										<tr>
											<td>Descripción</td>
											<td> 													
												{{ str_limit(str_replace('<br />','', $producto->descripcion), 40) }}
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
												@else
													</label>
												@endif
												
											</td>
											
										</tr>
										<tr>
											<td>Precio venta</td>
											<td>
												<!-- Se obtiene moneda predeterinada --> 
												{{ App\Moneda::find(config('app.monedaPreferida'))->first()->simbolo }}
												{{ $producto->precio }}
											</td>												
										</tr>
										<tr>
											<td>Stock</td>
											<td> 
												{{ $producto->stock }}
												<span class="pull-right">
													<a href="#formStock" class="btn btn-sm" id="{{$producto->codigo}}" data-toggle="modal" data-target="#formStock" onclick='$("#form_stock").attr("action", "/productos/{{$producto->codigo}}/ModificarStock");'>
														<i class="fa fa-exchange" aria-hidden="true"></i>
													</a>
												</span>												
											</td>
										</tr>
									</table>
								</div>								
								@include('partials.movimiento_stock')
							</div>


							<div class="col-md-8">
								<legend>Últimos movimientos</legend>
								<div class="col-md-12">
									<div class="table-responsive ">
										<table class="table table-condensed table-striped table-bordered">
											<thead>
												<tr>
													<th width="70px">Fecha</th>
													<th width="70px">Hora</th>
													<th width="40px">Cant.</th>
													<th>Descripción</th>
													<th width="75px">Usuario</th>
												</tr>
											</thead>
											<tbody>
												@foreach($movimientos->sortByDesc('fecha') as $m)										
													<tr>
														<td>{{ date_format( date_create($m->fecha), 'd/m/Y' ) }}</td>		
														<td>{{ date_format( date_create($m->fecha), 'H:i:s' ) }}</td>		
														<td align="center">{{ $m->cantidad}}</td>
														<td>{{ $m->descripcion}}</td>
														<td>{{$m->usuario->name}}</td>
													</tr>
												@endforeach
											</tbody>
										</table>
									</div>
								</div>
								<div class="text-center">
									{{ $movimientos->links() }}
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<legend>Configuración del producto <i class="fa fa-cogs" aria-hidden="true"></i></legend>
							<div class="col-md-8">
								<form class="form-horizontal" role="form" method="POST" action="/productos/{{$producto->codigo}}/configuracion">
								{{ csrf_field() }}
									<div class="form-group">
										<h4>Notificaciones</h4>
										<div class="table-responsive">
											<table width="100%" class=" table">
												<tr>
													<th width="120px">
														Stock mínimo
													</th>
													<th width="80px">
														<input class="input-sm form-control" type="number" name="stockMinimo" value="{{ $producto->stock_minimo_valor }}" id="txtStockMinimo">
													</th>
													<td>
														Recibe una notificación cuando el stock del producto sea menor o igual al especificado.
													</td>
													<td  class="text-right">
														@if( $producto->stock_minimo_notificar )
															<script type="text/javascript">
																$("#txtStockMinimo").prop('disabled', false);
															</script>
															<span class="label label-success">Activado</span>
															<a href="/productos/{{$producto->codigo}}/NotifStockMin">Desactivar</a>
														@else
															<script type="text/javascript">
																$("#txtStockMinimo").prop('disabled', true);
															</script>
															<span class="label label-warning">Desactivado</span>
															<a href="/productos/{{$producto->codigo}}/NotifStockMin">Activar</a>
														@endif
													</td>
												</tr>												
											</table>
										</div>			                        	
									</div>
									<div class="form-group">
										<input class="btn btn-primary" type="submit" value="Guardar configuración">
									</div>
								</form>
							</div>
							<div class="col-md-3 col-md-offset-1">
								<div class="form-group">
									<form id="form-borrar" class="form-horizontal" role="form" method="POST" action="/productos/borrar">
										{{ csrf_field() }}
										<input type="hidden" name="producto_id" value="{{$producto->id}}">
										<h4>Eliminar producto</h4>
										<p><small>El producto no se mostrará más luego de ser borrado. Pero se mantendrá su registro histórico.</small></p>
										<input class="btn btn-danger" type="submit" name="" value="Borrar producto">
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
<div class="modal fade" id="modalEditarProducto" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4>
					Editar datos del producto
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</h4>
			</div>

			<div class="modal-body">
				<div class="row">
					<div class="col-md-10 col-md-offset-1">
						<form id="form_editar_producto" class="form-horizontal" role="form" method="POST" action="/productos/editar">
						{{ csrf_field() }}
							<input type="hidden" name="producto_id" value="{{$producto->id}}">
							<div class="form-group">
								<table class="table table-condensed table-striped table-bordered" width="100%">
									<tr>
										<th width="30%">Código</th>
										<td width="70%">									
											<input id="txtCodigo" type="text" class="form-control input-sm" name="codigo" placeholder="Código del producto" value="{{$producto->codigo}}" hidden="true" required>
										</td>										
									</tr>
									<tr>
										<th>Nombre</th>
										<td>
											<input id="txtNombre" type="text" class="form-control input-sm" name="nombre" placeholder="Nombre del producto" value="{{$producto->nombre}}" required>
										</td>
										
									</tr>
									<tr>
										<th>Código de barras</th>
										<td>
											<input id="txtCodigoDeBarras" type="text" class="form-control input-sm" name="codigo_de_barras" placeholder="Codigo de barras del producto" value="{{$producto->codigo_de_barras}}" >
										</td>
										
									</tr>
									<tr>
										<th>Familia</th>
										<td>
											<select id="selectFamilia" class="form-control input-sm" name="familia_producto">
												@foreach( $familias_producto as $f)
													@if($f->id == $producto->familia->id)
														<option value="{{ $f->id}}" selected="true">{{ $f->nombre }}</option>
													@else
														<option value="{{ $f->id}}">{{ $f->nombre }}</option>
													@endif
												@endforeach
											</select>
										</td>
										
									</tr>
									<tr>
										<th>Descripción</th>
										<td>
											<textarea class="form-control input-sm" id="txtDescripcion" rows="3" placeholder="Descripción del producto" name="descripcion">{{$producto->descripcion}}</textarea>
										</td>
										
									</tr>
									<tr>
										<th>
											Precio de venta ({{ App\Moneda::find(config('app.monedaPreferida'))->first()->simbolo }})
										</th>
										<td>
											<!-- Se obtiene moneda predeterinada --> 
											<input id="txtPrecio" class="form-control input-sm" name="precio" placeholder="Precio en U$S" value="{{$producto->precio}}">
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

@section('scripts')
<script type="text/javascript">	
	$(document).ready(function(){
		$('#form-borrar').on('submit', function(e) {			
			if(! confirm("¿Está seguro de que desea eliminar el producto?")){
				e.preventDefault();
			}
		});
	});

	$("#form_editar_producto").on('submit', function(e){    	
		var precio = $("#txtPrecio").val();
		precio = precio.replace(",", ".");      
		if(isNaN(precio)) {         
			e.preventDefault();
			alert("El precio ingresado no es válido.");
		}
	});
</script>
@endsection